<?php

namespace App\Http\Service\Surat;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

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
            DB::beginTransaction();
            $this->validationSuratKeluar($request);
            $suratKeluar = $this->builderSuratKeluar($request);
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
            $suratKeluar = $this->builderSuratKeluar($request);
            $this->repository->updateDetailBy($suratKeluar, 'getId', 'id');
            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil diubah');
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
            ->addColumn('action', function ($data) {
                return '<a href="' . route('surat-keluar.edit', $data->id) . '" class="btn btn-primary btn-sm">Edit</a>
                <a href="' . route('surat-keluar.delete', $data->id) . '" class="btn btn-danger btn-sm">Delete</a>';
            })
            ->make(true);
    }

    public function countMailOut()
    {
        return $this->repository->getModels()::count();
    }
}
