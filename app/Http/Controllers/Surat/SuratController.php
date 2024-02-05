<?php

namespace App\Http\Controllers\Surat;

use App\Http\Controllers\Controller;
use App\Http\Repository\Surat\SuratRepository;
use App\Http\Repository\Surat\TemplateSuratRepository;
use App\Http\Service\Surat\SuratMasukService;
use App\Http\Service\Surat\TemplateSuratService;
use App\Models\Surat\Template;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index()
    {
        return view('Surat.index');
    }
    public function createKop(Request $request)
    {
        $surat = new TemplateSuratService(new TemplateSuratRepository(new Template()));
        return $surat->createKop($request);
    }

    public function suratMasuk()
    {
        return view('Surat.suratMasuk');
    }

    public function suratKeluar()
    {
        return view('Surat.suratKeluar');
    }

    public function addSurat(Request $request)
    {
        $surat = new SuratMasukService(new SuratRepository(new SuratMasuk()));
        return $surat->addMailIn($request);
    }
}
