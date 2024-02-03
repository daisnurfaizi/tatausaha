<?php

namespace App\Http\Service\Student;

use Yajra\DataTables\Facades\DataTables;

// change to your repository
class GetDataStudentService
{
    protected $repository;
    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function getAllStudent($datatable = true)
    {
        $student = $this->repository->getAll('name', 'asc');

        if ($datatable) {
            return DataTables::of($student)
                ->addColumn('action', function ($student) {
                    $editButton = '<button class="btn btn-sm btn-warning" onclick="editStudent(' . $student->id . ',\'' . $student->nisn . '\',\'' . $student->name . '\')">Edit</button>';
                    $deleteButton = '<a href="' . route('dashboard.deletestudent', $student->nisn) . '" class="btn btn-sm btn-danger">Delete</a>';

                    return $editButton . ' ' . $deleteButton;
                })

                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        } else {
            return $student;
        }
    }

    // count all student
    public function countAllStudent()
    {
        return $this->repository->getModels()::select('nisn')
            ->whereNull('deleted_at')
            ->count();
    }
}
