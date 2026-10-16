<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SinhVien extends Model
{
    use HasFactory;

    protected $table = 'sinh_viens';

    protected $fillable = ['lop_hoc_id', 'ho_ten', 'email', 'nganh', 'phone_number'];

    public function lopHoc(): BelongsTo
    {
        return $this->belongsTo(LopHoc::class, 'lop_hoc_id');
    }
}
