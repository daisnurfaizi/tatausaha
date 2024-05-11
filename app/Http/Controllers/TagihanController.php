<?php

namespace App\Http\Controllers;

use App\Http\Repository\Tagihan\TagihanRepository;
use App\Http\Service\Tagihan\TagihanService;

use App\Models\Tagihan;
use Illuminate\Http\Request;


class TagihanController extends Controller
{
    protected $tagihanService;

    public function __construct()
    {
        $this->tagihanService = new TagihanService(new TagihanRepository(new Tagihan()));
    }

    public function generateTagihan(Request $request)
    {
        $bulan = $request->bulan;
        $jumlah = $request->jumlah;
        return  $this->tagihanService->generateTagihan($bulan, $jumlah);
    }

    public function getTagihanbyStudentId($studentId, $bulan)
    {
        return $this->tagihanService->getTagihanByStudentId($studentId, $bulan);
    }

    public function getKartuPembayaran()
    {
        return $this->tagihanService->kartuPembayaran();
    }
}
