<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'login_logo',
        'sidebar_logo_small',
        'sidebar_logo',
        'title',
        'owner',
        'footer',
    ];
}
