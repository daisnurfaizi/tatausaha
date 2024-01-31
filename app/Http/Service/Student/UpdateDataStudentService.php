<?php

namespace App\Http\Service\Student;

use Illuminate\Support\Facades\DB;

// change to your repository
class UpdateDataStudentService extends AddStudentService
{
    public function updateStudent($request)
    {
        try {
            DB::beginTransaction();

            $student = $this->repository->getModels()::where('nisn', $request->nisn)->first();
            if ($student) {
                return $this->response('error', 'NISN Sudah Digunakan', null, 400);
            }
            $studentBuilder = $this->studentBuilder($request)->setId($request->id)->build();
            $this->repository->updateDetailBy($studentBuilder, 'getId', 'id');
            DB::commit();
            return $this->response('success', 'Data Berhasil Diubah');
        } catch (\Exception $e) {
            return $this->response('error', $e->getMessage(), null, 400);
        }
    }
}
