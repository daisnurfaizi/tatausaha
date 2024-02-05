<?php

namespace App\Http\Service\Surat;

use App\Http\Builder\SuratKeluarModelEntityBuilder;
use App\Http\Builder\SuratMasukEntityBuilder;
use App\Http\Entity\SuratKeluarModelEntity;
use App\Http\Entity\SuratMasukEntity;
use App\Trait\UploadFile;
use Illuminate\Support\Facades\Validator;

// change to your repository
class SuratService
{
    protected $repository;
    use UploadFile;
    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    protected function validationSuratMasuk($request)
    {
        $rule = [
            'id' => 'sometimes|required',
            'nomor_surat' => 'required|unique:surat_masuk,nomor_surat,' . $request->id . ',id',
            'tanggal_terima' => 'required',
            'pengirim' => 'required',
            'perihal' => 'required',
            'keterangan' => 'sometimes',
            'lampiran' => 'sometimes|required|mimes:pdf,doc,docx,png,jpg|max:2048',
        ];
        $message = [
            'id.required' => 'Id tidak boleh kosong',
            'nomor_surat.required' => 'Nomor Surat tidak boleh kosong',
            'nomor_surat.unique' => 'Nomor Surat sudah ada',
            'tanggal_terima.required' => 'Tanggal Terima tidak boleh kosong atau isi dengan -',
            'pengirim.required' => 'Pengirim tidak boleh kosong ',
            'perihal.required' => 'Perihal tidak boleh kosong atau isi dengan -',
            'lampiran.required' => 'Lampiran tidak boleh kosong',
            'lampiran.mimes' => 'Lampiran harus berupa file: pdf, doc, docx, png, jpg',
            'lampiran.max' => 'Ukuran file maksimal 2MB'

        ];
        $validaror = Validator::make($request->all(), $rule, $message);

        if ($validaror->fails()) {
            return throw new \Exception($validaror->errors()->first());
        }
    }

    protected function validationSuratKeluar($request)
    {
        $rule = [
            'nomor_surat' => 'required',
            'tanggal_kirim' => 'required',
            'tujuan' => 'required',
            'perihal' => 'required',
            'keterangan' => 'sometimes',
            'lampiran' => 'required|mimes:pdf,doc,docx,png,jpg' | 'max:2048',
            'status' => 'required'
        ];
        $message = [
            'nomor_surat.required' => 'Nomor Surat tidak boleh kosong',
            'tanggal_kirim.required' => 'Tanggal Kirim tidak boleh kosong',
            'tujuan.required' => 'Tujuan tidak boleh kosong ',
            'perihal.required' => 'Perihal tidak boleh kosong atau isi dengan -',
            'lampiran.required' => 'Lampiran tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
            'lampiran.mimes' => 'Lampiran harus berupa file: pdf, doc, docx, png, jpg',
            'lampiran.max' => 'Ukuran file maksimal 2MB'


        ];
        $validaror = Validator::make($request->all(), $rule, $message);

        if ($validaror->fails()) {
            return throw new \Exception($validaror->errors()->first());
        }
    }

    protected function builderSuratKeluar($request): SuratKeluarModelEntity
    {
        $suratBuilder = (new SuratKeluarModelEntityBuilder);
        if (!empty($request->id)) {
            $suratBuilder->setId($request->id);
        }
        if ($request->hasFile('lampiran')) {
            $lampiran = $this->uploadFile($request->lampiran, 'lampiran/surat_masuk');
            $suratBuilder->setLampiran($lampiran);
        }
        $suratBuilder->setNomorSurat($request->nomor_surat)
            ->setTanggalKirim($request->tanggal_kirim)
            ->setTujuan($request->tujuan)
            ->setPerihal($request->perihal)
            ->setKeterangan($request->keterangan)

            ->setStatus($request->status);
        return $suratBuilder->build();
    }

    public function builderSuratMasuk($request): SuratMasukEntity
    {
        $suratBuilder  = (new SuratMasukEntityBuilder);
        if (!empty($request->id)) {
            $suratBuilder->setId($request->id);
        }
        if ($request->hasFile('lampiran')) {
            $lampiran = $this->uploadFile($request->lampiran, 'lampiran/surat_masuk');
            $suratBuilder->setLampiran($lampiran);
        }
        $suratBuilder->setNomorSurat($request->nomor_surat)
            ->setTanggalTerima($request->tanggal_terima)
            ->setPengirim($request->pengirim)
            ->setPerihal($request->perihal)
            ->setKeterangan($request->keterangan);
        return $suratBuilder->build();
    }
}
