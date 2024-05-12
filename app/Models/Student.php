<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    protected static function booted()
    {
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('status', 'active');
        });
    }

    // soft delete
    protected $dates = ['deleted_at'];

    public function payments()
    {
        return $this->hasMany(Payment::class, 'nisn', 'nisn');
    }

    public function bills()
    {
        return $this->hasMany(Tagihan::class, 'student_id', 'id');
    }
}
