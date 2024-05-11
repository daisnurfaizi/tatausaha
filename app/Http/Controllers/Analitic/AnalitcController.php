<?php

namespace App\Http\Controllers\Analitic;

use App\Http\Controllers\Controller;
use App\Http\Repository\Payment\PaymentRepository;
use App\Http\Repository\Student\StudentRepository;
use App\Http\Service\Payment\PaymentService;
use App\Http\Service\Student\GetDataStudentService;
use App\Http\Service\Tagihan\PembayaranService;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;

class AnalitcController extends Controller
{
    public function index()
    {
        $dataPayment = new PembayaranService();
        $dataTotalPembayaranBulanan = new PaymentService(new PaymentRepository(new Payment()));
        $totalPembayaranBulanan = $dataPayment->totalPembayaranTahunan();
        $persentasePembayaran = $dataPayment->persentasePembayaranBulanIni();
        $keseluruhanPembayaran = $totalPembayaranBulanan->total_payment;
        $totalBulanini = $dataPayment->totalPembayaranBulanan()->total_payment;
        $totalBulanLalu = $dataPayment->totalPembayaranBulanLalu()->total_payment;

        $totalsiswa  = new GetDataStudentService(new StudentRepository(new Student()));
        $totalSiswa = $totalsiswa->countAllStudent();
        $paidStudent = $this->getDataStudentPaid();
        $studentUnpaid = $this->getDataStudentNotPaid();
        $studentInstallment = $this->getStudentInstallment();
        // dd($keseluruhanPembayaran, $persentasePembayaran);
        return view('Analitic.Analitic', compact(
            'keseluruhanPembayaran',
            'persentasePembayaran',
            'totalBulanini',
            'totalBulanLalu',
            'totalSiswa',
            'paidStudent',
            'studentUnpaid',
            'studentInstallment'
        ));
    }

    public function getDataStudentPaid()
    {


        return $this->getStudentPaid('paid');
    }

    public function getDataStudentNotPaid()
    {
        // count student where payment date is null
        return $this->getStudentPaid('unpaid');
    }

    public function getStudentInstallment()
    {
        return $this->getStudentPaid('installment');
    }


    private function getStudentPaid($status)
    {
        $bulanTagihan = date('M');
        $tahunTagihan = date('Y');

        return Student::whereHas('bills', function ($query) use ($bulanTagihan, $tahunTagihan, $status) {
            $query->where('status_tagihan', $status)
                ->where('bulan_tagihan', $bulanTagihan)
                ->where('tahun_tagihan', $tahunTagihan);
        })
            ->count();
    }
}
