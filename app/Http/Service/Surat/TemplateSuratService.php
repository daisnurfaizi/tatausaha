<?php

namespace App\Http\Service\Surat;

use Illuminate\Support\Facades\DB;

// change to your repository
class TemplateSuratService
{
    protected $repository;
    public function __construct($repository)
    {
        $this->repository = $repository;
    }


    public function createKop($request)
    {
        try {

            DB::beginTransaction();
            $kop = $this->repository->getModels()->where('name', 'kop')->first();
            if ($kop) {
                $kop->update(['content' => $request->content]);
                DB::commit();
                return redirect()->back()->with('success', 'Data berhasil diupdate');
            } else {
                $data = [
                    'name' => 'kop',
                    'content' => $request->content
                ];
                $this->repository->create($data);
                DB::commit();
                return redirect()->back()->with('success', 'Data berhasil disimpan');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('error', 'Data gagal disimpan');
        }
    }
}
