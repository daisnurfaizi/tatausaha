<?php

namespace App\Http\Service\Student;

use App\Exports\StudentExport;
use App\Exports\StudentImport;
use App\Exports\StudentTemplateExport;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

// change to your repository
class StudentExcelService
{
    public function exportStudent()
    {
        return Excel::download(new StudentExport, 'student.xlsx');
    }

    public function tempateStudent()
    {
        return Excel::download(new StudentTemplateExport, 'template_Student.xlsx');
    }

    public function importStudent($request)
    {
        try {
            $this->validationfile($request);
            Excel::import(new StudentImport, $request->file('file'));
            return redirect()->route('dashboard.student')->with('success', 'Data Berhasil Diimport');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.student')->with('error', 'Data Gagal Diimport');
        }
    }

    private function validationfile($request)
    {
        $messages = [
            'file.required' => 'File tidak boleh kosong',
            'file.mimes' => 'File harus berupa xlsx',
        ];
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx',
        ], $messages);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
    }
}
