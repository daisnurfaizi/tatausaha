<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    // soft delete
    use SoftDeletes;

    protected $table = "students";

    protected $fillable = [
        'name',
        'nisn',
    ];

    // soft delete
    protected $dates = ['deleted_at'];
}
