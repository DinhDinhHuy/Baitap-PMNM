<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public const VI_TRI = [
        'header' => 'Header',
        'sidebar' => 'Sidebar',
    ];

    protected $fillable = [
        'ten',
        'url',
        'vi_tri',
        'nhom',
        'thu_tu',
        'trang_thai',
    ];


    public function dangChon(): bool
    {
        if (str_starts_with($this->url, '#') || preg_match('/^https?:\/\//i', $this->url)) {
            return false;
        }

        $path = trim((string) parse_url($this->url, PHP_URL_PATH), '/');

        if ($path === '') {
            return $this->url === '/' && request()->is('/');
        }

        return request()->is($path, $path . '/*');
    }
}
