<?php

namespace App\Http\Service\Surat;

use App\Helper\ResponseJsonFormater;
use App\Trait\UploadFile;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

// change to your repository
class SuratMasukService extends SuratService
{
    use UploadFile;
    public function __construct($repository)
    {
        parent::__construct($repository);
    }
    public function addMailIn($request)
    {
        try {
            DB::beginTransaction();
            $this->validationSuratMasuk($request);
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
            $this->repository->updateDetailBy($suratMasuk, 'getId', 'id');
            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage())->withInput();
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

    public function getDataSuratMasuk()
    {
        $data = $this->repository->getAll();
        return DataTables::of($data)
            ->addColumn('lampiran', function ($data) {
                return "<a href='" . asset('storage/' . $data->lampiran) . "' target='_blank'>Lihat Lampiran</a>";
            })
            ->addColumn('action', function ($data) {
                $buttonEdit = "<button class='btn btn-warning btn-sm' onclick='editSuratMasuk(" . $data->id . ")'>Edit</button> ";
                $buttonDelete = "<a href='" . route('surat.deletesuratmasuk', $data->id) . "' class='btn btn-danger btn-sm' onclick='return confirm(`Apakah anda yakin ingin menghapus data ini?`)'>Hapus</a>";
                return $buttonEdit . $buttonDelete;
            })
            ->rawColumns(['lampiran', 'action'])
            ->make(true);
    }

    public function getDataSuratMasukById($id)
    {
        $data = $this->repository->show($id);
        return ResponseJsonFormater::success($data, 'Data berhasil diambil');
    }

    public function countSuratMasuk()
    {
        return $this->repository->getModels()::count();
    }
}
