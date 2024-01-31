<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        if (!isset($row['nisn'])) {
            return null;
        }
        $exist = Student::where('nisn', $row['nisn'])->first();
        if ($exist) {
            return null;
        } else {
            $newRecord = new Student([
                'nisn' => $row['nisn'],
                'name' => $row['nama'],
            ]);
            $newRecord->save();
        }
        return null;
    }

    public function headings(): array
    {
        return [
            'NISN',
            'Nama',
        ];
    }
}
