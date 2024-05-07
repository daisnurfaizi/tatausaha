<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Repository\Student\StudentRepository;
use App\Http\Requests\Student\StudentRequest;
use App\Http\Service\Student\AddStudentService;
use App\Http\Service\Student\DeleteStudentService;
use App\Http\Service\Student\GetDataStudentService;
use App\Http\Service\Student\StudentExcelService;
use App\Http\Service\Student\UpdateDataStudentService;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('Student.Student');
    }

    public function getDataStudent()
    {
        $studentService = new GetDataStudentService(new StudentRepository(new Student()));
        return $studentService->getAllStudent();
    }

    public function deleteStudent($nisn)
    {
        $studentService = new DeleteStudentService(new StudentRepository(new Student()));
        return $studentService->deleteStudent($nisn);
    }

    public function savestudent(Request $request)
    {
        $studentService = new AddStudentService(new StudentRepository(new Student()));
        return $studentService->addStudent($request);
    }

    public function updateStudent(Request $request)
    {
        $studentService = new UpdateDataStudentService(new StudentRepository(new Student()));
        return $studentService->updateStudent($request);
    }

    public function studentExport()
    {
        $sudentExcel = new StudentExcelService();
        return $sudentExcel->exportStudent();
    }

    public function studentTemplate()
    {
        $sudentExcel = new StudentExcelService();
        return $sudentExcel->tempateStudent();
    }

    public function studentImport(Request $request)
    {
        $sudentExcel = new StudentExcelService();
        return $sudentExcel->importStudent($request);
    }

    public function activateStudent($nisn)
    {
        $studentService = new DeleteStudentService(new StudentRepository(new Student()));
        return $studentService->activateStudent($nisn);
    }
}
