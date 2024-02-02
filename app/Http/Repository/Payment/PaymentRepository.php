<?php

namespace App\Http\Repository\Payment;

use App\Http\Repository\BaseRepository;
use Illuminate\Support\Facades\DB;

class PaymentRepository extends BaseRepository
{
    public function __construct($model)
    {
        parent::__construct($model);
    }

    public function totalPembayaranBulanan()
    {
        return $this->model->select(DB::raw('MONTH(payment_date) as month'), DB::raw('SUM(payment_amount) as total_payment'))
            ->groupBy(DB::raw('MONTH(payment_date)'))
            ->orderBy(DB::raw('MONTH(payment_date)'))
            ->get();
    }

    public function averagePaymentPerStudent()
    {
        return $this->model->select('students.nisn', 'students.name', DB::raw('AVG(payment_amount) as average_payment'))
            ->join('students', 'payments.nisn', '=', 'students.nisn')
            ->groupBy('students.nisn', 'students.name')
            ->get();
    }
}
