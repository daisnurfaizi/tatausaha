<?php

namespace App\Http\Service\User;

use App\Http\Builder\UserEntityBuilder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

// change to your repository
class PhotoService
{
    protected $repository;
    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function updatePhoto($request)
    {
        try {

            DB::beginTransaction();
            // get file photo
            $this->validateFile($request->file('photo'), 'photo');
            $file = $request->file('photo');
            // validate file
            // get file extension
            $extension = $file->getClientOriginalExtension();
            // set file name
            $fileName = time() . '.' . $extension;
            // set file path
            $filePath = 'avatar/' . $fileName;

            // upload file
            $this->uploadFile($file, $filePath);
            // update photo in database
            $dataUser = (new UserEntityBuilder)
                ->setId($request->id)
                ->setPhoto($filePath)
                ->build();

            $this->repository->updateDetailBy($dataUser, 'getId', 'id');
            DB::commit();
            return redirect()->route('profile.profile')->with('success', 'Update Photo Success');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Update Photo Failed');
        }
    }

    private function uploadFile($file, $filePath)
    {
        // jika folder avatar tidak ada maka buat folder avatar
        if (!Storage::disk('public')->exists('avatar')) {
            dd('masuk');
            Storage::disk('public')->makeDirectory('avatar');
        }
        Storage::disk('public')->put($filePath, file_get_contents($file));
        // update photo in database
    }

    private function deleteFile($filePath)
    {
        // delete file in storage
        Storage::disk('public')->delete($filePath);
    }

    private function validateFile($file, $name)
    {
        $validator = Validator::make([$name => $file], [
            $name => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            // Menggunakan session flash untuk menampilkan pesan kesalahan
            session()->flash('error', 'Update Photo Failed');
            // Melempar exception untuk menangani rollback transaksi
            throw new \Exception('Update Photo Failed');
        }
    }
}
