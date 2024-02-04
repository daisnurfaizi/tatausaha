<?php

namespace App\Models\Surat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $table = 'template';
    protected $fillable = ['name', 'content'];
}
