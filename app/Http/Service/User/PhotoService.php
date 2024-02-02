<?php

namespace App\Http\Service\User;

use App\Http\Builder\UserEntityBuilder;
use App\Trait\UploadFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

// change to your repository
class PhotoService
{
    protected $repository;
    use UploadFile;
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

            // set file pat

            // upload file
            $filePath = $this->uploadFile($file, 'avatar');
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
