<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    
    public function students()
    {
        return $this->hasMany(Admin::class, 'departmentId', 'id');
    }
    public function teachers()
    {
        return $this->hasMany(Admin::class, 'departmentId', 'id');
    }
}
