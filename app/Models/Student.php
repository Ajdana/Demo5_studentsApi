<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;//мягкое удаление

    //калонки разрешенные к заполнению
    protected $fillable = [
        'name',
        'age',
        'group',
        'email',
        'avatar_url',
    ];
}
