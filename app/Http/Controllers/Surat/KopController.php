<?php

namespace App\Http\Controllers\Surat;

use App\Http\Controllers\Controller;
use App\Http\Repository\Surat\TemplateSuratRepository;
use App\Http\Service\Surat\TemplateSuratService;
use App\Models\Surat\Template;
use Illuminate\Http\Request;

class KopController extends Controller
{
    public function index()
    {
        $kop = Template::where('name', 'kop')->first();
        return view('Surat.KopSurat', compact('kop'));
    }
    public function createKop(Request $request)
    {
        $surat = new TemplateSuratService(new TemplateSuratRepository(new Template()));
        return $surat->createKop($request);
    }

    public function showKop()
    {
        $kop = Template::where('name', 'kop')->first();
        return view('Surat.Surat', compact('kop'));
    }
}
