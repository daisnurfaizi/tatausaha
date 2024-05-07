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
            $this->repository->getModels()::where('nisn', $nisn)->update(['status' => 'inactive']);
            $student = $this->repository->getModels()::where('nisn', $nisn)->first();
            $student->delete();
            DB::commit();
            return redirect()->route('dashboard.student')->with('success', 'Data' . $student->name . ' Berhasil Dinonaktifkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard.student')->with('error', 'Data Gagal Dihapus');
        }
    }

    public function activateStudent($nisn)
    {
        try {
            DB::beginTransaction();
            $this->repository->getModels()::where('nisn', $nisn)->withTrashed()->update(['status' => 'active']);

            $student = $this->repository->getModels()::where('nisn', $nisn)->withTrashed()->first();
            // Perbarui deleted_at menjadi null untuk mengaktifkan kembali data yang dihapus secara lunak
            if ($student->deleted_at != null) {
                $student->restore();
            }

            DB::commit();
            return redirect()->route('dashboard.student')->with('success', 'Data ' . $student->name . ' Berhasil Diaktifkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard.student')->with('error', 'Data Gagal Diaktifkan');
        }
    }
}
