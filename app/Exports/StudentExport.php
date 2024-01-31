<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Student::select('name', 'nisn')->orderBy('name', 'ASC')->get();
    }

    public function headings(): array
    {
        return [
            'NISN',
            'Nama',
        ];
    }

    public function map($student): array
    {
        return [
            $student->nisn,
            $student->name,
        ];
    }
}
