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
        $student = $this->repository->getModels()::withoutGlobalScope('active')
            ->select('id', 'nisn', 'name', 'status', 'deleted_at')
            ->withTrashed()
            ->get();


        if ($datatable) {
            return DataTables::of($student)
                ->addColumn('action', function ($student) {
                    $editButton = '<button class="btn btn-sm btn-warning" onclick="editStudent(' . $student->id . ',\'' . $student->nisn . '\',\'' . $student->name . '\')">Edit</button>';
                    if ($student->status == 'active') {
                        $deleteButton = '<a href="' . route('dashboard.deletestudent', $student->nisn) . '" class="btn btn-sm btn-danger">Non Active</a>';
                    } else {
                        $deleteButton = '<a href="' . route('dashboard.activatestudent', $student->nisn) . '" class="btn btn-sm btn-success">Active</a>';
                    }

                    return $editButton . ' ' . $deleteButton;
                })
                ->addColumn('status', function ($student) {
                    return '<span class="badge bg-' . ($student->status == 'active' ? 'success' : 'danger') . '">' . $student->status . '</span>';
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'status'])
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
