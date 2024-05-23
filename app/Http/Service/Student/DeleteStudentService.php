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
            if ($student) {
                // Update the student's status to 'inactive'
                $student->status = 'inactive';
                $student->save();
                // Using save() instead of update()
                $student->delete();
            } else {
                // If no student found, rollback and return an error
                DB::rollBack();
                return redirect()->route('dashboard.student')->with('error', 'Data not found');
            }

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

            // Find the student including soft-deleted ones
            $student = $this->repository->getModels()::withoutGlobalScope('active')
                ->withTrashed()->where('nisn', $nisn)->first();

            if ($student) {
                // Update the status to active
                $student->status = 'active';
                $student->save();

                // Restore the student if it is soft-deleted
                if ($student->trashed()) {
                    $student->restore();
                }

                DB::commit();
                return redirect()->route('dashboard.student')->with('success', 'Data ' . $student->name . ' Berhasil Diaktifkan');
            } else {
                // If the student was not found, rollback and return error
                DB::rollBack();
                return redirect()->route('dashboard.student')->with('error', 'Data tidak ditemukan');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard.student')->with('error', 'Data Gagal Diaktifkan');
        }
    }
}
