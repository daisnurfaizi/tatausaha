<?php

namespace App\Http\Controllers;

use App\Http\Repository\Payment\PaymentRepository;
use App\Http\Repository\Student\StudentRepository;
use App\Http\Service\Payment\PaymentService;
use App\Http\Service\Student\GetDataStudentService;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $datasiswa = new GetDataStudentService(new StudentRepository(new Student()));
        $data = $datasiswa->getAllStudent(datatable: false);
        return view('Payment.Dashboard', compact('data'));
    }

    public function billing()
    {
        $datasiswa = new GetDataStudentService(new StudentRepository(new Student()));
        $data = $datasiswa->getAllStudent(datatable: false);
        return view('Payment.Payment', compact('data'));
    }

    public function addPayment(Request $request)
    {
        $payment = new PaymentService(new PaymentRepository(new Payment()));

        return $payment->createPayment($request);
    }

    public function getDataPayment()
    {
        $payment = new PaymentService(new PaymentRepository(new Payment()));
        return $payment->getAllDataPayment(datatable: true);
    }

    public function deletePayment($id)
    {
        $payment = new PaymentService(new PaymentRepository(new Payment()));
        return $payment->deletePayment($id);
    }

    public function getDataPaymentByID($id)
    {
        $payment = new PaymentService(new PaymentRepository(new Payment()));
        return $payment->getDataPaymentByID($id);
    }

    public function updatePayment(Request $request)
    {
        $payment = new PaymentService(new PaymentRepository(new Payment()));
        return $payment->updatePayment($request);
    }

    public function getKartuPembayaran()
    {
        $kartuPembayaran = new PaymentService(new PaymentRepository(new Payment()));
        return $kartuPembayaran->kartuPembayaran();
    }

    public function getTotalPembayaranBulanan()
    {
        $totalPembayaranBulanan = new PaymentService(new PaymentRepository(new Payment()));
        return $totalPembayaranBulanan->totalPembayaran();
    }

    public function getTotalPembayaranTahunan()
    {
        $totalPembayaranTahunan = new PaymentService(new PaymentRepository(new Payment()));
        return $totalPembayaranTahunan->totalPembayaranTahunan();
    }
}
