<?php

namespace App\Http\Service\Surat;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Helper\GeneratePdfHelper;

// change to your repository
class SuratKeluarService extends SuratService
{

    public function __construct($repository)
    {
        parent::__construct($repository);
    }

    public function addMailOut($request)
    {
        try {
            // dd($request->all());
            DB::beginTransaction();
            $pdfPath = GeneratePdfHelper::generate('Surat.Surat', $request);
            $this->validationSuratKeluar($request);
            $suratKeluar = $this->builderSuratKeluar($request, $pdfPath);
            $this->repository->createByEntity($suratKeluar);
            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function updateMailOut($request)
    {
        try {
            DB::beginTransaction();
            $this->validationSuratKeluar($request);
            $pdfPath = GeneratePdfHelper::generate('Surat.Surat', $request);
            $suratKeluar = $this->builderSuratKeluar($request, $pdfPath);
            $this->repository->updateDetailBy($suratKeluar, 'getId', 'id');
            DB::commit();
            return redirect()->back()->with('success', 'Data surat keluar berhasil diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function deleteMailOut($id)
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

    public function getDataSuratKeluar()
    {
        $data = $this->repository->getAll();
        return DataTables::of($data)
            ->addColumn('lampiran', function ($data) {
                return '<a href="' . $data->lampiran . '" class="btn btn-primary btn-sm">Download</a>';
            })
            ->addColumn('action', function ($data) {
                // delete button
                $buttonEdit = "<button class='btn btn-warning btn-sm' onclick='editSuratKeluar(" . $data->id . ")'>Edit</button> ";
                $button = '<a href="' . route('surat.deletesuratkeluar', $data->id) . '" class="btn btn-danger btn-sm">Delete</a>';
                return $buttonEdit . ' ' . $button;
            })
            ->rawColumns(['lampiran', 'action'])
            ->make(true);
    }

    public function countMailOut()
    {
        return $this->repository->getModels()::count();
    }

    public function getDataSuratKeluarById($id)
    {
        return $this->repository->getModels()::find($id);
    }
}
