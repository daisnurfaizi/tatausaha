<?php

namespace App\Http\Controllers\Dashboad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DasboardCotroller extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }
}
