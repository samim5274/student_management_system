<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'status',
        'teacherId',
        'stdId',
        'feedback',
    ];
    
    public function teacher()
    {
        return $this->belongsTo(Admin::class, 'teacherId', 'id');
    }
}
