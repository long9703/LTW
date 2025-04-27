<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Các thuộc tính có thể được gán hàng loạt
    protected $fillable = [
        'fullname',
        'email',
        'password',
        'phone_number',
        'role_id',  // Chắc chắn rằng role_id là thuộc tính cần thiết
    ];

    // Các thuộc tính cần chuyển đổi kiểu dữ liệu
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime', 
    ];

    // Quan hệ với bảng Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Các phương thức khác như getFullnameAttribute và setPasswordAttribute
    public function getFullnameAttribute($value)
    {
        return ucfirst($value);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public function cartItems()
    {
        return $this->hasMany(Cart::class, 'user_id');
    }
}
