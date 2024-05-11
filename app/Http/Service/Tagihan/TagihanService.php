<?php

namespace App\Http\Service\Tagihan;

use App\Helper\ResponseJsonFormater;
use App\Http\Builder\TagihanEntityBuilder;
use App\Http\Repository\Student\StudentRepository;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

// change to your repository
class TagihanService
{
    protected $repository;
    protected $studentRepository;
    public function __construct($repository)
    {
        $this->repository = $repository;
        $this->studentRepository = new StudentRepository(new Student());
    }

    public function generateTagihan($bulan, $jumlah)
    {
        DB::beginTransaction();
        $checkTagihan = $this->checkTagihanSudaDibuat($bulan);
        if ($checkTagihan->count() > 0) {
            throw new \Exception('Tagihan bulan ' . $bulan . ' sudah dibuat');
        }
        try {
            $offset = 0;
            do {
                $students = $this->studentRepository->getAllActiveStudent($offset, 10);
                foreach ($students as $student) {
                    $tagihan = $this->getTagihanStudentMonthYear($student->id, $bulan, date('Y'));
                    if ($tagihan) {
                        continue;
                    }
                    $this->createTagihan($student, $bulan, $jumlah);
                }
                $offset += 10;
            } while (count($students) > 0);
            DB::commit();
            return ResponseJsonFormater::success(message: 'Tagihan berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseJsonFormater::error(message: $e->getMessage());
        }
    }


    private function createTagihan($student, $bulan, $jumlah)
    {
        $tagihan = $this->tagihanBuilder();
        $datatagihan = $tagihan->setStudentId($student->id)
            ->setBulanTagihan($bulan)
            ->setTahunTagihan(date('Y'))
            ->setJumlahTagihan($jumlah)
            ->setSisaTagihan($jumlah)
            ->setStatusTagihan('unpaid')
            ->setKeterangan('Tagihan bulan ' . $bulan);
        return $this->repository->createByEntity($datatagihan);
    }

    private function getTagihanStudentMonthYear($studentId, $bulan, $tahun)
    {
        return $this->repository->getModels()::where('student_id', $studentId)
            ->where('bulan_tagihan', $bulan)
            ->where('tahun_tagihan', $tahun)
            ->first();
    }

    private function tagihanBuilder()
    {
        return (new TagihanEntityBuilder());
    }

    private function checkTagihanSudaDibuat($month)
    {
        $student = $this->studentRepository->getModels()::select('id')
            ->where('status', 'active')
            ->get();
        // where in tagihan
        $tagihan = $this->repository->getModels()::select('student_id')
            ->whereIn('student_id', $student->pluck('id')->toArray())
            ->where('bulan_tagihan', $month)
            ->where('tahun_tagihan', date('Y'))
            ->get();
        return $tagihan->pluck('student_id');
    }

    public function getTagihanByStudentId($studentId, $bulan)
    {
        // dd($studentId, $bulan);
        $tagihan = $this->repository->getModels()::where('student_id', $studentId)
            ->where(function ($query) {
                $query->where('status_tagihan', 'unpaid')
                    ->orWhere('status_tagihan', 'installment');
            })
            ->where('tahun_tagihan', date('Y'))
            ->where('bulan_tagihan', $bulan)
            ->first();



        return ResponseJsonFormater::success(data: $tagihan, message: 'Data tagihan');
    }


    public function kartuPembayaran()
    {
        $year = date('Y'); // Gunakan tahun saat ini jika tidak ada parameter

        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        $tagihan = $this->repository->getModels()::where('tahun_tagihan', $year)->get();

        $data = [];
        foreach ($tagihan as $item) {
            // Inisialisasi data siswa jika belum ada
            if (!isset($data[$item->student_id])) {
                $data[$item->student_id] = [
                    'nama_siswa' => $item->student->name
                ];

                // Inisialisasi setiap bulan dengan string kosong
                foreach ($months as $month) {
                    $data[$item->student_id][$month] = '';
                }
            }

            // Isi status tagihan untuk bulan yang ada dalam data tagihan
            $bulan = date('F', strtotime($item->bulan_tagihan)); // Ambil nama bulan dari tanggal tagihan
            if (in_array($bulan, $months)) { // Pastikan bulan ada dalam array bulan yang diinginkan
                if ($item->status_tagihan == 'unpaid') {
                    $data[$item->student_id][$bulan] = '<span class="badge bg-danger">Belum Bayar</span>';
                } elseif ($item->status_tagihan == 'installment') {
                    $data[$item->student_id][$bulan] = '<span class="badge bg-warning">Masih Ada Cicilan</span>';
                } else {
                    $data[$item->student_id][$bulan] = '<span class="badge bg-success">Lunas</span>';
                }
            }
        }

        return DataTables::of(array_values($data)) // Menggunakan array_values untuk mendapatkan nilai-nilai data tanpa kunci
            ->addIndexColumn()
            ->rawColumns($months) // Menggunakan array bulan sebagai raw columns
            ->make(true);
    }





    protected function getTagihanById($id)
    {
        return $this->repository->getModels()::select('jumlah_tagihan', 'sisa_tagihan')
            ->where('id', $id)
            ->first();
    }

    public function updateStatusTagihan($id, $status)
    {
        $tagihan = $this->repository->getModels()::find($id);
        $tagihan->status_tagihan = $status;
        $tagihan->save();
        return ResponseJsonFormater::success(message: 'Status tagihan berhasil diubah');
    }

    public function kurangiTagihan($id, $jumlah)
    {
        $tagihan = $this->repository->getModels()::find($id);
        $sisa_tagihan = $tagihan->sisa_tagihan = $tagihan->sisa_tagihan - $jumlah;
        if ($sisa_tagihan == 0) {
            $tagihan->status_tagihan = 'paid';
        } else {
            $tagihan->status_tagihan = 'installment';
        }
        $tagihan->save();
        return $tagihan;
    }

    public function getHistoryTagihan()
    {
        $months = ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'];
        $historyTagihan = $this->repository->getModels()::select('bulan_tagihan', 'tahun_tagihan')

            ->where('tahun_tagihan', date('Y'))
            ->distinct('bulan_tagihan')
            ->get();
    }
}
