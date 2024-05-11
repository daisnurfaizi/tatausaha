<?php

namespace App\Http\Controllers;

use App\Http\Repository\Tagihan\TagihanRepository;
use App\Http\Requests\Tagihan\TagihanRequest;
use App\Http\Service\Tagihan\PembayaranService;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public $pembayaranService;
    public function __construct()
    {
        $this->pembayaranService = new PembayaranService();
    }

    public function createPayment(TagihanRequest $request)
    {
        return $this->pembayaranService->createPembayaran($request);
    }

    public function getAllPembayaran()
    {
        return $this->pembayaranService->getAllDataPembayaran();
    }

    public function getTotalPembayaranBulanan()
    {
        return $this->pembayaranService->totalPembayaranBulanan();
    }

    public function cancelPembayaran($id)
    {
        return $this->pembayaranService->cancelPembayaran($id);
    }

    public function editPembayaran(Request $request)
    {
        return $this->pembayaranService->editPembayaran($request);
    }

    public function getDataPembayaranBatal()
    {
        return $this->pembayaranService->getAllDataPembayaranBatal();
    }
}
