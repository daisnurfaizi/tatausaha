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
        // dd($keseluruhanPembayaran, $persentasePembayaran);
        return view('Analitic.Analitic', compact(
            'keseluruhanPembayaran',
            'persentasePembayaran',
            'totalBulanini',
            'totalBulanLalu',
            'totalSiswa'
        ));
    }
}
