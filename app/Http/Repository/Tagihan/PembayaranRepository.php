<?php

namespace App\Http\Repository\Tagihan;

use App\Http\Repository\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PembayaranRepository extends BaseRepository
{
    public function __construct($model)
    {
        parent::__construct($model);
    }

    public function totalPembayaranBulanan()
    {
        return $this->model->select(DB::raw('SUM(jumlah_pembayaran) as total_payment'))
            ->whereNull('deleted_at')
            ->whereYear('tanggal_pembayaran', Carbon::now()->format('Y'))
            ->whereMonth('tanggal_pembayaran', Carbon::now()->format('m'))
            ->first();
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

    public function totalPembayaranBulanLalu()
    {
        $lastMonth = Carbon::now()->subMonth();

        return $this->model->select(DB::raw('SUM(jumlah_pembayaran) as total_payment'))
            ->whereNull('deleted_at')
            ->whereMonth('tanggal_pembayaran', $lastMonth->format('m'))
            ->whereYear('tanggal_pembayaran', $lastMonth->format('Y'))
            ->first();
    }

    public function totalPembayaranTahunan()
    {
        return $this->model->select(DB::raw('SUM(jumlah_pembayaran) as total_payment'))
            ->whereNull('deleted_at')
            ->whereYear('tanggal_pembayaran', Carbon::now()->format('Y'))
            ->first();
    }
}
