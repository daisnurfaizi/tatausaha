<?php

namespace App\Http\Controllers\Aplication;

use App\Helper\AplicationHelper;
use App\Http\Controllers\Controller;
use App\Http\Repository\Aplication\AplicationRepository;
use App\Http\Service\Aplication\AplicationService;
use App\Models\Aplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AplicationController extends Controller
{
    public function index()
    {
        $aplication = AplicationHelper::getAplication();

        View::share('aplication', $aplication);
        return view('Aplication.index');
    }

    public function update(Request $request)
    {
        $aplication = new AplicationService(new AplicationRepository(new Aplication()));
        return $aplication->update($request);
    }
}
