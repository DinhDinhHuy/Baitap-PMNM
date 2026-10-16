<?php

namespace Tests\Feature;

use App\Models\LopHoc;
use App\Models\SinhVien;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AccessAndApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Carbon::setTestNow(now()->setTime(10, 0));
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    public function test_users_can_sign_in_with_a_valid_password(): void
    {
        $user = User::factory()->create(['email' => 'login@example.test', 'password' => 'secret123']);

        $this->get(route('login'))->assertOk();
        $this->post(route('login.post'), [
            'email' => $user->email,
            'password' => 'secret123',
        ])->assertRedirect(route('lophoc.index'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_database_seeder_creates_both_roles_and_related_sample_data(): void
    {
        $this->seed();

        $admin = User::where('email', 'admin@example.com')->firstOrFail();
        $lecturer = User::where('email', 'giangvien@example.com')->firstOrFail();

        $this->assertSame('admin', $admin->role);
        $this->assertSame('lecturer', $lecturer->role);
        $this->assertTrue(Hash::check('password123', $admin->password));
        $this->assertGreaterThan(0, LopHoc::count());
        $this->assertGreaterThan(0, SinhVien::count());
        $this->assertDatabaseHas('menus', ['url' => '/lophoc', 'vi_tri' => 'sidebar']);
    }

    public function test_lecturers_can_manage_classes_and_students_but_not_admin_features(): void
    {
        $lecturer = User::factory()->create(['role' => 'lecturer']);
        $this->actingAs($lecturer);

        $this->get(route('lophoc.index'))->assertOk();
        $this->get(route('lophoc.create'))->assertOk();
        $this->get(route('sinhvien.index'))->assertOk();
        $this->get(route('sinhvien.add'))->assertOk();
        $this->get(route('menu.index'))->assertForbidden();
        $this->get(route('users.index'))->assertForbidden();
    }

    public function test_lecturers_can_only_update_their_own_account(): void
    {
        $lecturer = User::factory()->create(['role' => 'lecturer', 'password' => 'oldpassword123']);
        $other = User::factory()->create(['role' => 'lecturer']);
        $this->actingAs($lecturer);

        $this->get(route('account.edit'))->assertOk();
        $this->put(route('account.update'), [
            'name' => 'Updated Lecturer',
            'email' => $lecturer->email,
            'password' => 'newsecret123',
            'password_confirmation' => 'newsecret123',
        ])->assertRedirect(route('account.edit'));
        $this->assertDatabaseHas('users', ['id' => $lecturer->id, 'role' => 'lecturer', 'name' => 'Updated Lecturer']);
        $this->assertTrue(Hash::check('newsecret123', $lecturer->fresh()->password));

        $this->put(route('users.update', $other), [
            'name' => 'Changed',
            'email' => $other->email,
            'password' => '',
        ])->assertForbidden();
    }

    public function test_admin_can_update_their_own_account_and_change_password(): void
    {
        $admin = User::factory()->create(['role' => 'admin', 'password' => 'adminold123']);
        $this->actingAs($admin);

        $this->get(route('account.edit'))->assertOk();
        $this->put(route('account.update'), [
            'name' => 'Admin Updated',
            'email' => $admin->email,
            'password' => 'adminnew123',
            'password_confirmation' => 'adminnew123',
        ])->assertRedirect(route('account.edit'))->assertSessionHasNoErrors();

        $this->assertDatabaseHas('users', ['id' => $admin->id, 'role' => 'admin', 'name' => 'Admin Updated']);
        $this->assertTrue(Hash::check('adminnew123', $admin->fresh()->password));
    }

    public function test_admins_can_open_menu_and_user_management(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $this->get(route('menu.index'))->assertOk();
        $this->get(route('users.index'))->assertOk();
        $this->get(route('users.create'))->assertOk();
        $this->get(route('users.edit', User::factory()->create(['role' => 'lecturer'])))->assertOk();
        $this->post(route('users.store'), [
            'name' => 'Duplicate',
            'email' => $admin->email,
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'role' => 'lecturer',
        ])->assertSessionHasErrors('email');
    }

    public function test_students_can_be_created_updated_filtered_and_deleted(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'lecturer']));
        $class = LopHoc::factory()->create();
        $payload = [
            'lop_hoc_id' => $class->id,
            'ho_ten' => 'Nguyễn Thị Mai',
            'email' => 'mai@example.test',
            'nganh' => 'Công nghệ thông tin',
            'phone_number' => '0901234567',
        ];

        $this->post(route('sinhvien.store'), $payload)->assertRedirect(route('sinhvien.index'));
        $student = SinhVien::where('email', $payload['email'])->firstOrFail();
        $this->get(route('sinhvien.edit', $student))->assertOk();
        $this->get(route('sinhvien.index', ['lop_hoc_id' => $class->id, 'sort' => 'ho_ten']))
            ->assertOk()
            ->assertSee('Nguyễn Thị Mai')
            ->assertSee($class->ten_lop);
        $this->put(route('sinhvien.update', $student), array_merge($payload, ['ho_ten' => 'Nguyễn Thị Mai Updated']))
            ->assertRedirect(route('sinhvien.index'));
        $this->delete(route('sinhvien.destroy', $student))->assertRedirect(route('sinhvien.index'));
        $this->assertDatabaseMissing('sinh_viens', ['id' => $student->id]);
    }

    public function test_class_and_student_api_requires_bearer_token_and_supports_crud(): void
    {
        $this->getJson('/api/lophoc')->assertUnauthorized();

        $user = User::factory()->create(['email' => 'api@example.test', 'password' => 'password123']);
        $tokenResponse = $this->postJson('/api/login', [
            'email' => 'api@example.test',
            'password' => 'password123',
        ])->assertOk()->assertJsonPath('token_type', 'Bearer');
        $token = $tokenResponse->json('token');

        $classResponse = $this->withToken($token)->postJson('/api/lophoc', [
            'ten_lop' => 'API Class',
            'ma_lop' => 'API-001',
            'giao_vien' => 'API Lecturer',
            'so_dien_thoai' => '0900000000',
            'si_so' => 20,
            'trang_thai' => 'Hoạt động',
        ])->assertCreated();
        $classId = $classResponse->json('id');

        $studentResponse = $this->withToken($token)->postJson('/api/sinhvien', [
            'lop_hoc_id' => $classId,
            'ho_ten' => 'API Student',
            'email' => 'student-api@example.test',
            'nganh' => 'Kỹ thuật',
            'phone_number' => '0900000001',
        ])->assertCreated()->assertJsonPath('lop_hoc.id', $classId);

        $this->withToken($token)->getJson('/api/lophoc?sort=ma_lop')
            ->assertOk()
            ->assertJsonPath('data.0.ma_lop', 'API-001');
        $this->withToken($token)->deleteJson('/api/sinhvien/'.$studentResponse->json('id'))->assertNoContent();
        $this->assertDatabaseMissing('sinh_viens', ['email' => 'student-api@example.test']);
    }
}
