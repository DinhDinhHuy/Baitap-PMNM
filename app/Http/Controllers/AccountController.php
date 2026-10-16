<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveAccountRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function editOwn(Request $request)
    {
        return view('users.form', ['user' => $request->user(), 'isOwnAccount' => true]);
    }

    public function updateOwn(SaveAccountRequest $request)
    {
        $request->user()->update($request->validatedAccount());

        return redirect()->route('account.edit')->with('success', 'Tài khoản của bạn đã được cập nhật.');
    }

    public function index(Request $request)
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'role' => ['nullable', 'in:admin,lecturer'],
            'sort' => ['nullable', 'in:id,name,email,role,created_at'],
            'direction' => ['nullable', 'in:asc,desc'],
            'per_page' => ['nullable', 'integer', 'in:5,10,25,50'],
        ]);

        $users = User::query()
            ->when(isset($filters['q']), fn ($q) => $q->where(fn ($q) => $q->where('name', 'like', '%'.$filters['q'].'%')->orWhere('email', 'like', '%'.$filters['q'].'%')))
            ->when(isset($filters['role']), fn ($q) => $q->where('role', $filters['role']))
            ->orderBy($filters['sort'] ?? 'id', $filters['direction'] ?? 'asc')
            ->paginate($filters['per_page'] ?? 10)
            ->withQueryString();

        return view('users.index', compact('users', 'filters'));
    }

    public function create()
    {
        return view('users.form', ['user' => new User, 'isOwnAccount' => false]);
    }

    public function store(SaveAccountRequest $request)
    {
        $data = $request->validatedAccount();
        User::create($data);

        return redirect()->route('users.index')->with('success', 'Tạo tài khoản thành công.');
    }

    public function edit(User $user)
    {
        return view('users.form', ['user' => $user, 'isOwnAccount' => false]);
    }

    public function update(SaveAccountRequest $request, User $user)
    {
        abort_unless($request->user()->isAdmin() || $request->user()->is($user), 403);
        abort_if(
            $user->isAdmin()
                && $request->input('role') === 'lecturer'
                && User::where('role', 'admin')->count() <= 1,
            422,
            'Không thể hạ quyền của quản trị viên cuối cùng.',
        );
        $user->update($request->validatedAccount());

        return redirect()->route($request->user()->isAdmin() ? 'users.index' : 'account.edit')
            ->with('success', 'Cập nhật tài khoản thành công.');
    }

    public function destroy(User $user)
    {
        abort_if($user->isAdmin() && User::where('role', 'admin')->count() <= 1, 422, 'Không thể xóa quản trị viên cuối cùng.');
        abort_if(auth()->id() === $user->id, 422, 'Không thể tự xóa tài khoản đang đăng nhập.');
        $user->delete();

        return back()->with('success', 'Đã xóa tài khoản.');
    }
}
