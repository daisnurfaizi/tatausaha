<?php

namespace App\Http\Service\Aplication;

use App\Http\Builder\AplicationEntityBuilder;
use App\Trait\UploadFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

// change to your repository
class AplicationService
{
    use UploadFile;
    protected $repository;
    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    private function builder($data, $login_logo = null, $sidebar_logo_small = null, $sidebar_logo = null)
    {
        $aplicationBuilder = new AplicationEntityBuilder;
        if (isset($login_logo)) {
            $aplicationBuilder->setLoginLogo($login_logo);
        }
        if (isset($sidebar_logo_small)) {
            $aplicationBuilder->setSidebarLogoSmall($sidebar_logo_small);
        }
        if (isset($sidebar_logo)) {
            $aplicationBuilder->setSidebarLogo($sidebar_logo);
        }
        $aplicationBuilder->setId($data->id); // change to your id (optional
        $aplicationBuilder->setTitle($data->title);
        $aplicationBuilder->setOwner($data->owner);
        $aplicationBuilder->setFooter($data->footer);
        return $aplicationBuilder->build();
    }

    private function validatephoto($data)
    {
        // Aturan Validasi Dinamis
        $rules = [
            'login_logo' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sidebar_logo_small' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
            'sidebar_logo' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
            'title' => 'sometimes|required',
            'owner' => 'sometimes|required',
            'footer' => 'sometimes|required',
        ];

        // Pesan Kesalahan Validasi Dinamis
        $message = [
            'login_logo.image' => 'The :attribute must be an image.',
            'login_logo.mimes' => 'The :attribute must be a file of type: jpeg, png, jpg, gif, svg.',
            'login_logo.max' => 'The :attribute may not be greater than :max kilobytes.',
            'title.required' => 'The :attribute field is required.',
            'owner.required' => 'The :attribute field is required.',
            'footer.required' => 'The :attribute field is required.',
        ];

        // Menyusun pesan kesalahan untuk field-file yang sesuai
        $validation = Validator::make($data->all(), $rules, $message);
        if ($validation->fails()) {
            throw new \Exception($validation->errors()->first());
        }
    }

    public function update($data)
    {
        try {
            DB::beginTransaction();
            $this->validatephoto($data);
            $login_logo = $this->uploadAsset($data->login_logo, 'aplication/Logo');
            $sidebar_logo_small = $this->uploadAsset($data->sidebar_logo_small, 'aplication/Logo');
            $sidebar_logo = $this->uploadAsset($data->sidebar_logo, 'Aplication/sidebar');
            $aplication = $this->builder($data, $login_logo, $sidebar_logo_small, $sidebar_logo);
            $this->repository->updateDetailBy($aplication, 'getId', 'id');
            DB::commit();
            return redirect()->back()->with('success', 'Aplication updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    private function uploadAsset($file, $path)
    {

        if ($file) {
            return $this->uploadFile($file, $path);
        } else {
            return null;
        }
    }
}
