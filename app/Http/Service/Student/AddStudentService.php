<?php

namespace App\Http\Service\Student;

use App\Helper\ResponseJsonFormater;
use App\Http\Builder\StudentEntityBuilder;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

// change to your repository
class AddStudentService
{
    protected $repository;
    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function addStudent($request)
    {
        try {
            DB::beginTransaction();
            $this->validate($request);
            $dataStudent = $this->studentBuilder($request)->build();
            $this->repository->createByEntity($dataStudent,);
            DB::commit();
            return $this->response('success', 'Data Berhasil Ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->response('error', $e->getMessage(), null, 400);
        }
    }

    protected function validate($request)
    {
        $messages = [
            'nisn.required' => 'NISN tidak boleh kosong',
            'nisn.unique' => 'NISN sudah terdaftar',
            'name.required' => 'Nama tidak boleh kosong',
            'nisn.numeric' => 'NISN harus berupa angka',
            'nisn.min' => 'NISN minimal 10 digit',
        ];
        $validator = Validator::make($request->all(), [
            'nisn' => 'required|unique:students|numeric|min:10',
            'name' => 'required',
        ], $messages);


        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
    }

    protected function response($status = 'success', $message, $data = null, $code = 200)
    {
        if ($status == 'success') {
            return ResponseJsonFormater::success($message, $data);
        } else {
            return ResponseJsonFormater::error($message, $code);
        }
    }

    protected function studentBuilder($request)
    {
        $dataStudent = (new StudentEntityBuilder)
            ->setNisn($request->nisn)
            ->setName($request->name);

        return $dataStudent;
    }
}
