<?php

namespace App\Http\Service\Payment;

use App\Http\Builder\PaymentEntityBuilder;
use App\Models\Student;
use App\Trait\UploadFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

// change to your repository
class PaymentService
{
    protected $repository;
    use UploadFile;
    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function createPayment($request)
    {
        DB::beginTransaction();
        try {
            $this->validatePayment($request);
            $this->chekPyment($request->nisn, $request->month, $request->payment_date);
            $paymentData = $this->builderPayment($request);
            $this->repository->createByEntity($paymentData);

            DB::commit();
            return redirect()->route('dashboard.payment')->with('success', 'Pembayaran berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard.payment')->withErrors($e->getMessage());
        }
    }

    private function validatePayment($request)
    {
        $rules = [
            'nisn' => 'required',
            'payment_date' => 'required',
            'month' => 'required',
            'payment_amount' => 'required',
            'payment_method' => 'required',
            'payment_file' => 'mimes:jpg,jpeg,png,pdf|max:2048',
        ];
        $messages = [
            'nisn.required' => 'NISN harus diisi atau pilih siswa',
            'payment_date.required' => 'Tanggal pembayaran harus diisi',
            'month.required' => 'Bulan pembayaran harus diisi',
            'payment_amount.required' => 'Jumlah pembayaran harus diisi',
            'payment_method.required' => 'Metode pembayaran harus diisi',
            'payment_file.mimes' => 'File harus berupa gambar atau pdf',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
    }

    // change payment_amount to double
    private function formatPaymentAmount($paymentAmount)
    {
        // Remove 'Rp. ', dots, and commas
        $paymentAmount = str_replace(['Rp. ', '.', ','], '', $paymentAmount);

        return $paymentAmount;
    }

    public function getAllDataPayment($datatable = true)
    {
        $payment = $this->repository->getAll('payment_date', 'desc');

        if ($datatable) {
            return DataTables::of($payment)
                ->addColumn('nama_siswa', function ($payment) {
                    return $payment->student->name;
                })
                ->addColumn('payment_amount', function ($payment) {
                    return 'Rp. ' . number_format($payment->payment_amount, 0, ',', '.');
                })
                ->addColumn('payment_file', function ($payment) {
                    if ($payment->payment_file) {
                        return '<a href="' . asset('storage/' . $payment->payment_file) . '" target="_blank">Lihat</a>';
                    } else {
                        return '-';
                    }
                })
                // ->addColumn('user', function ($payment) {
                //     return is_object($payment->user) ? $payment->user->name : '-';
                // })
                ->addColumn('action', function ($payment) {
                    $editButton = '<button class="btn btn-sm btn-warning" onclick="editPayment(' . $payment->id . ')">Edit</button>';
                    $deleteButton = '<a href="' . route('dashboard.deletepayment', $payment->id) . '" class="btn btn-sm btn-danger">Delete</a>';

                    return $editButton . ' ' . $deleteButton;
                })
                ->addIndexColumn()
                ->rawColumns(['action', 'payment_file'])
                ->make(true);
        } else {
            return $payment;
        }
    }

    public function deletePayment($id)
    {
        DB::beginTransaction();
        try {
            $payment = $this->repository->getModels()::where('id', $id)->first();
            $payment->delete();
            DB::commit();
            return redirect()->route('dashboard.payment')->with('success', 'Pembayaran berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard.payment')->with('error', $e->getMessage());
        }
    }

    public function getDataPaymentByID($id)
    {
        $payment = $this->repository->getModels()::with('student')->select(
            'id',
            'nisn',
            'payment_date',
            'month',
            DB::raw('format(payment_amount, 0) as payment_amount'),
            'payment_method',
            'note',
        )->where('id', $id)->first();
        return $payment;
    }

    public function updatePayment($request)
    {
        DB::beginTransaction();
        try {
            $this->validatePayment($request);
            // $this->chekPyment($request->nisn, $request->month, $request->payment_date);
            $paymentData = $this->builderPayment($request);
            $this->repository->updateDetailBy($paymentData, 'getId', 'id');
            DB::commit();
            return redirect()->route('dashboard.payment')->with('success', 'Pembayaran berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    private function builderPayment($request)
    {
        $paymentData = (new PaymentEntityBuilder)
            ->setNisn($request->nisn)
            ->setPaymentDate($request->payment_date)
            ->setMonth($request->month)
            ->setPaymentAmount($this->formatPaymentAmount($request->payment_amount))
            ->setPaymentMethod($request->payment_method)
            ->setNote($request->note)
            ->setUser(Auth::user()->id)
            ->setPaymentFile($request->payment_file ?? null);
        if (!empty($request->id)) {
            $paymentData->setId($request->id);
        }

        if ($request->hasFile('payment_file')) {
            $paymentData->setPaymentFile($this->uploadFile($request->file('payment_file'), 'payment'));
        }
        return $paymentData->build();
    }

    private function chekPyment($nisn, $month, $date)
    {
        $dataPembayaran = $this->repository->checkPayment($nisn, $month, $date);
        if ($dataPembayaran) {
            throw new \Exception('Siswa sudah membayar tagihan bulan ' . $dataPembayaran->month);
        }
    }


    public function kartuPembayaran()
    {
        $year = $year ?? date('Y'); // Gunakan tahun saat ini jika tidak ada parameter
        $months = ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'];

        $students = Student::with(['payments' => function ($query) use ($year, $months) {
            $query->whereYear('payment_date', $year)
                ->whereIn('month', $months)
                ->whereNull('deleted_at');
        }])->get();

        $datatable = DataTables::of($students)
            ->addColumn('nama_siswa', function ($student) {
                return $student->name;
            });

        foreach ($months as $month) {
            $datatable->addColumn($month, function ($student) use ($month) {
                // Jika ada pembayaran
                if ($student->payments->where('month', $month)->first()) {
                    return '<span class="badge bg-success">Lunas</span>';
                } else {
                    return '<i class="fa fa-times text-danger"></i>';
                }
            });
        }

        $datatable->addColumn('action', function ($student) {
            return '<a href="" class="btn btn-sm btn-primary">Lihat</a>';
        })
            ->addIndexColumn()
            ->rawColumns(['action', 'januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember']);

        return $datatable->make(true);
    }

    public function totalPembayaran()
    {
        return $this->repository->totalKeseluahanPembayaran();
    }

    public function totalPembayaranBulanan()
    {
        return $this->repository->totalPembayaranBulanan();
    }

    public function totalPembayaranBulanLalu()
    {
        return $this->repository->totalPembayaranBulanLalu();
    }

    public function totalPembayaranTahunan()
    {
        return $this->repository->totalPembayaranTahunan();
    }

    public function totalPesentasiBulanIni()
    {
        $bulanini = floatval($this->repository->totalPembayaranBulanan()->total_payment);
        $bulanlalu = floatval($this->repository->totalPembayaranBulanLalu()->total_payment);

        if ($bulanini < $bulanlalu) {
            $persentase = ($bulanini - $bulanlalu) / $bulanlalu * 100;
            return "<i class='ri-arrow-right-down-line fs-13 align-middle'></i> " . $persentase . " %";
        } elseif ($bulanini == $bulanlalu) {
            return "<i class='fs-13 align-middle'></i> + 0 %";
        } else {
            if ($bulanlalu == 0) {
                return "<i class='ri-arrow-right-up-line fs-13 align-middle'></i> + 100 %";
            }
            $persentase = ($bulanini - $bulanlalu) / $bulanlalu * 100;
            return "<i class='ri-arrow-right-up-line fs-13 align-middle'></i> +" . $persentase . " %";
        }
    }

    public function totalPesentasiBulanLalu()
    {
        $bulanini = floatval($this->repository->totalPembayaranBulanan()->total_payment);
        $bulanlalu = floatval($this->repository->totalPembayaranBulanLalu()->total_payment);

        if ($bulanini < $bulanlalu) {
            $persentase = ($bulanini - $bulanlalu) / $bulanlalu * 100;
            return "<i class='ri-arrow-right-down-line fs-13 align-middle'></i> -" . $persentase . " %";
        } elseif ($bulanini == $bulanlalu) {
            return "<i class='fs-13 align-middle'></i> + 0 %";
        } else {
            if ($bulanini == 0) {
                return "<i class='ri-arrow-right-up-line fs-13 align-middle'></i> + 100 %";
            }
            $persentase = ($bulanini - $bulanlalu) / $bulanlalu * 100;
            return "<i class='ri-arrow-right-up-line fs-13 align-middle'></i> +" . $persentase . " %";
        }
    }
}
