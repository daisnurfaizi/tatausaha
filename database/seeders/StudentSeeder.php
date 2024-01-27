<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Testing\Fakes\Fake;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 100; $i++) {
            // Membuat instance baru dari Student dengan urutan nisn dulu baru nama
            $student = new Student([
                'nisn' => $this->generateUniqueNisn(),
                'name' => $faker->firstName() . ' ' . $faker->lastName(),
                // Atribut lainnya jika ada
            ]);

            // Menyimpan instance ke database
            $student->save();
        }
    }


    private function generateUniqueNisn(): string
    {
        $nisn = mt_rand(1000000000, 9999999999);
        if (Student::where('nisn', $nisn)->exists()) {
            return $this->generateUniqueNisn();
        }

        return (string) $nisn;
    }
}
