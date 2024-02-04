<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Models\Surat\Template;
use Illuminate\Http\Request;

class Mailcontroller extends Controller
{
    public function index()
    {
        $kop = Template::where('name', 'kop')->first();
        return view('Mail.Mail', compact('kop'));
    }
}
