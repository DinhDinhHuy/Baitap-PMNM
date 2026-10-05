<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SinhVien extends Model
{
    protected $table = 'sinh_viens';
    protected $fillable = ['ho_ten', 'email', 'nganh', 'phone_number'];
}
