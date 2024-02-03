<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Aplication::create([
            'title' => 'Sistem Informasi Sekolah',
            'owner' => 'SMK Negeri 1 Cimahi',
            'footer' => 'Sistem Informasi Sekolah',
        ]);
    }
}
