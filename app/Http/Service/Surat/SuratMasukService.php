<?php

namespace App\Http\Service\Surat;

use App\Trait\UploadFile;
use Illuminate\Support\Facades\DB;

// change to your repository
class SuratMasukService extends SuratService
{
    use UploadFile;
    public function addMailIn($request)
    {
        try {
            DB::beginTransaction();
            $this->validationSuratMasuk($request);
            if ($request->hasFile('lampiran')) {
                $this->uploadFile($request->lampiran, 'lampiran/surat_masuk');
            }
            $suratMasuk = $this->builderSuratMasuk($request);
            $this->repository->createByEntity($suratMasuk);
            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function updateMailIn($request)
    {
        try {
            DB::beginTransaction();
            $this->validationSuratMasuk($request);
            if ($request->hasFile('lampiran')) {
                $this->uploadFile($request->lampiran, 'lampiran/surat_masuk');
            }
            $suratMasuk = $this->builderSuratMasuk($request);
            $this->repository->updateByEntity($suratMasuk);
            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deleteMailIn($id)
    {
        try {
            DB::beginTransaction();
            $this->repository->delete($id);
            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
