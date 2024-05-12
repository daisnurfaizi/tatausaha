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
            $studentBuilder = $this->studentBuilder($request)->setId($request->id)->build();
            $this->repository->updateDetailBy($studentBuilder, 'getId', 'id');
            DB::commit();
            return $this->response('success', 'Data Berhasil Diubah');
        } catch (\Exception $e) {
            return $this->response('error', $e->getMessage(), null, 400);
        }
    }
}
