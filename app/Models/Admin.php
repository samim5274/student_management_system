<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'phone',
        'address',
        'dob',
        'departmentId',
        'status',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'departmentId', 'id');
    }

    public function task()
    {
        return $this->hasMany(Admin::class, 'teacherId', 'id');
    }
    
}
