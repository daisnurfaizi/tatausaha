<?php

namespace App\Http\Controllers\Surat;

use App\Http\Controllers\Controller;
use App\Http\Repository\Surat\SuratRepository;
use App\Http\Repository\Surat\TemplateSuratRepository;
use App\Http\Service\Surat\SuratKeluarService;
use App\Http\Service\Surat\SuratMasukService;
use App\Http\Service\Surat\TemplateSuratService;
use App\Models\Surat\Template;
use App\Models\SuratKeluarModel;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index()
    {
        $datasuratMasuk =  $this->countSuratMasuk();
        $dataSuratKeluar = $this->countSuratKeluar();
        return view('Surat.index', compact('datasuratMasuk', 'dataSuratKeluar'));
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
        $kop = Template::where('name', 'kop')->first();
        return view('Surat.suratKeluar', compact('kop'));
    }

    public function addSurat(Request $request)
    {
        $surat = new SuratMasukService(new SuratRepository(new SuratMasuk()));
        return $surat->addMailIn($request);
    }

    public function getDataSuratMasuk()
    {
        $surat = new SuratMasukService(new SuratRepository(new SuratMasuk()));
        return $surat->getDataSuratMasuk();
    }

    public function updateSurat(Request $request)
    {
        $surat = new SuratMasukService(new SuratRepository(new SuratMasuk()));
        return $surat->updateMailIn($request);
    }

    public function deleteSuratMasuk($id)
    {
        $surat = new SuratMasukService(new SuratRepository(new SuratMasuk()));
        return $surat->deleteMailIn($id);
    }

    public function getDataSuratMasukById($id)
    {
        $surat = new SuratMasukService(new SuratRepository(new SuratMasuk()));
        return $surat->getDataSuratMasukById($id);
    }

    public function upupdatesurat(Request $request)
    {
        $surat = new SuratMasukService(new SuratRepository(new SuratMasuk()));
        return $surat->updateMailIn($request);
    }

    public function countSuratMasuk()
    {
        $surat = new SuratMasukService(new SuratRepository(new SuratMasuk()));
        return $surat->countSuratMasuk();
    }

    // surat keluar
    public function countSuratKeluar()
    {
        $surat = new SuratKeluarService(new SuratRepository(new SuratKeluarModel()));
        return $surat->countMailOut();
    }

    public function getDataSuratkeluar()
    {
        $surat = new SuratKeluarService(new SuratRepository(new SuratKeluarModel()));
        return $surat->getDataSuratKeluar();
    }

    public function addSuratKeluar(Request $request)
    {
        $surat = new SuratKeluarService(new SuratRepository(new SuratKeluarModel()));
        return $surat->addMailOut($request);
    }

    public function deleteSuratKeluar($id)
    {
        $surat = new SuratKeluarService(new SuratRepository(new SuratKeluarModel()));
        return $surat->deleteMailOut($id);
    }
    // get data surat keluar by id
    public function getDataSuratKeluarById($id)
    {
        $surat = new SuratKeluarService(new SuratRepository(new SuratKeluarModel()));
        return $surat->getDataSuratKeluarById($id);
    }
    // update surat keluar

    public function updateSuratKeluar(Request $request)
    {
        $surat = new SuratKeluarService(new SuratRepository(new SuratKeluarModel()));
        return $surat->updateMailOut($request);
    }
}
