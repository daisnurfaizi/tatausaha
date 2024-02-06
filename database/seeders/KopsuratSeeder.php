<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KopsuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kop = new \App\Models\Surat\Template();
        $kop->name = 'kop';
        $kop->content = '<div>
        <div class="row">
        <div class="col-md-3" id="img"><img id="logo" src="https://getasanbersinar.files.wordpress.com/2016/02/logo-kabupaten-semarang-jawa-tengah.png" style="height:160px; width:140px" /></div>
        
        <div class="col-md-9" id="text-header">
        <h3>PEMERINTAH KABUPATEN SEMARANG</h3>
        
        <h1><strong>KECAMATAN BERGAS</strong></h1>
        
        <h6>Jl. Soekarno-Hatta, No. 68, Telepon/Faximile (0298) 523024</h6>
        
        <h5><strong>BERGAS 50552</strong></h5>
        </div>
        </div>
        
        <div class="container">
        <hr />
        <div class="row" id="alamat">
        <div class="col-md-6" id="lampiran">&nbsp;</div>
        </div>
        </div>
        </div>';
        $kop->save();
    }
}
