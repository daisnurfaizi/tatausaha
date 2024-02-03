<?php

namespace App\Http\Repository\Payment;

use App\Http\Repository\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PaymentRepository extends BaseRepository
{
    public function __construct($model)
    {
        parent::__construct($model);
    }

    public function totalPembayaranBulanan()
    {
        return $this->model->select(DB::raw('SUM(payment_amount) as total_payment'))
            ->whereNull('deleted_at')
            ->whereYear('payment_date', Carbon::now()->format('Y'))
            ->whereMonth('payment_date', Carbon::now()->format('m'))
            ->first();
    }

    public function averagePaymentPerStudent()
    {
        return $this->model->select('students.nisn', 'students.name', DB::raw('AVG(payment_amount) as average_payment'))
            ->join('students', 'payments.nisn', '=', 'students.nisn')
            ->groupBy('students.nisn', 'students.name')
            ->get();
    }

    // cek siswa tidak boleh membayar bulan yang sama dalam tahun yang sama
    public function checkPayment($nisn, $month, $year)
    {
        return $this->model->where('nisn', $nisn)
            ->where('month', $month)
            ->whereYear('payment_date', Carbon::parse($year)->format('Y'))
            ->first();
    }

    public function totalPembayaranTahunan()
    {
        return $this->model->select(DB::raw('SUM(payment_amount) as total_payment'))
            ->whereNull('deleted_at')
            ->whereYear('payment_date', Carbon::now()->format('Y'))
            ->first();
    }


    public function totalPembayaranBulanLalu()
    {
        $lastMonth = Carbon::now()->subMonth();

        return $this->model->select(DB::raw('SUM(payment_amount) as total_payment'))
            ->whereNull('deleted_at')
            ->whereMonth('payment_date', $lastMonth->format('m'))
            ->whereYear('payment_date', $lastMonth->format('Y'))
            ->first();
    }

    public function persentaasePembayaranBulanLalu()
    {
        $totalPembayaranBulanLalu = $this->totalPembayaranBulanLalu();
        $totalPembayaranBulanIni = $this->totalPembayaranBulanan();
        dd($totalPembayaranBulanLalu, $totalPembayaranBulanIni);
        if ($totalPembayaranBulanLalu && $totalPembayaranBulanLalu->total_payment == 0) {
            return 0;
        } elseif ($totalPembayaranBulanIni->total_payment == 0) {
            return null; // or handle the case when total_payment for this month is 0
        }

        return ($totalPembayaranBulanLalu->total_payment / $totalPembayaranBulanIni->total_payment) * 100;
    }


    public function persentasePembayaranBulanIni()
    {
        $totalPembayaranBulanLalu = $this->totalPembayaranBulanLalu()->total_payment;
        $totalPembayaranBulanIni = $this->totalPembayaranBulanan()->total_payment;

        if ($totalPembayaranBulanIni == 0) {
            return 0;
        }

        return ($totalPembayaranBulanLalu / $totalPembayaranBulanIni) * 100;
    }
}
