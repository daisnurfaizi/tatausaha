<?php

namespace App\Http\Repository\Student;

use App\Http\Repository\BaseRepository;

class StudentRepository extends BaseRepository
{
    public function __construct($model)
    {
        parent::__construct($model);
    }

    public function getAllActiveStudent($offset = null, $limit = null)
    {
        if ($limit == null && $offset == null) {
            return $this->model::select('id', 'nisn', 'name')
                ->where('status', 'active')
                ->get();
        }
        return $this->model::select('id', 'nisn', 'name')
            ->where('status', 'active')
            ->offset($offset)
            ->limit($limit)
            ->get();
    }
}
