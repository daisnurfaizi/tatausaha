<?php

namespace App\Http\Service\Student;

use Illuminate\Support\Facades\DB;

// change to your repository
class DeleteStudentService
{
    protected $repository;
    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function deleteStudent($nisn)
    {
        try {
            DB::beginTransaction();
            $student = $this->repository->getModels()::where('nisn', $nisn)->first();
            $student->delete();
            DB::commit();
            return redirect()->route('dashboard.student')->with('success', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard.student')->with('error', 'Data Gagal Dihapus');
        }
    }
}
