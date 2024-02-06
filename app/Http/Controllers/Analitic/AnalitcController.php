<?php

namespace App\Http\Controllers\Analitic;

use App\Http\Controllers\Controller;
use App\Http\Repository\Payment\PaymentRepository;
use App\Http\Repository\Student\StudentRepository;
use App\Http\Service\Payment\PaymentService;
use App\Http\Service\Student\GetDataStudentService;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;

class AnalitcController extends Controller
{
    public function index()
    {
        $dataTotalPembayaranBulanan = new PaymentService(new PaymentRepository(new Payment()));
        $totalPembayaranBulanan = $dataTotalPembayaranBulanan->totalPembayaranTahunan();
        $persentasePembayaran = $dataTotalPembayaranBulanan->totalPesentasiBulanIni();
        $keseluruhanPembayaran = $totalPembayaranBulanan->total_payment;
        $totalBulanini = $dataTotalPembayaranBulanan->totalPembayaranBulanan()->total_payment;
        $totalBulanLalu = $dataTotalPembayaranBulanan->totalPembayaranBulanLalu()->total_payment;

        $totalsiswa  = new GetDataStudentService(new StudentRepository(new Student()));
        $totalSiswa = $totalsiswa->countAllStudent();
        $paidStudent = $this->getDataStudentPaid();
        $studentUnpaid = $this->getDataStudentNotPaid();
        // dd($keseluruhanPembayaran, $persentasePembayaran);
        return view('Analitic.Analitic', compact(
            'keseluruhanPembayaran',
            'persentasePembayaran',
            'totalBulanini',
            'totalBulanLalu',
            'totalSiswa',
            'paidStudent',
            'studentUnpaid'
        ));
    }

    public function getDataStudentPaid()
    {
        // couunt payment where month now and payment date is not null and payment date is this month
        return  Student::with('payments')->whereHas('payments', function ($query) {
            $query->whereMonth('payment_date', date('m'))->whereYear('payment_date', date('Y'));
        })->count();
    }

    public function getDataStudentNotPaid()
    {
        // count student where payment date is null
        return Student::with('payments')->whereDoesntHave('payments', function ($query) {
            $query->whereMonth('payment_date', date('m'))->whereYear('payment_date', date('Y'));
        })->count();
    }
}
