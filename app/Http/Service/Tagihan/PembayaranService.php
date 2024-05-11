<?php

namespace App\Http\Service\Tagihan;

use App\Helper\FormatPaymentAmount;
use App\Helper\ResponseJsonFormater;
use App\Http\Builder\PembayaranEntityBuilder;
use App\Http\Repository\Tagihan\PembayaranRepository;
use App\Http\Repository\Tagihan\TagihanRepository;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use App\Trait\UploadFile;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Format;
use Yajra\DataTables\DataTables;

// change to your repository
class PembayaranService extends TagihanService
{
    protected $pembayaranRepository;
    use UploadFile;

    public function __construct()
    {
        parent::__construct(new TagihanRepository(new Tagihan()));
        $this->pembayaranRepository = new PembayaranRepository(new Pembayaran());
    }

    public function createPembayaran($request)
    {
        try {
            DB::beginTransaction();
            $tagihan = $this->getJumlahTagihan($request->idtagihan);
            $jumlahTagihanSiswa = (float)$tagihan->jumlah_tagihan;
            $jumlahSisaTagihan = (float)$tagihan->sisa_tagihan;
            $payment = (float)FormatPaymentAmount::format($request->payment_amount);
            switch ($payment) {
                case $payment > $jumlahSisaTagihan:
                    throw new \Exception('Pembayaran melebihi jumlah tagihan');
                    break;
                case $payment < $jumlahSisaTagihan:
                    $pembayaran = $this->pembayaranBuilder($request, $jumlahTagihanSiswa);
                    $datapembayaran = $this->pembayaranRepository->createByEntity($pembayaran);
                    $this->kurangiTagihan($request->idtagihan, FormatPaymentAmount::format($request->payment_amount));
                    $datasisapembayaran = $this->pembayaranRepository->getModels()::where('id', $datapembayaran->id)->first();
                    $datasisapembayaran->sisa_tagihan = $jumlahSisaTagihan - $payment;
                    $datasisapembayaran->save();
                    break;
                default:
                    $pembayaran = $this->pembayaranBuilder($request);
                    $this->pembayaranRepository->createByEntity($pembayaran);
                    $this->kurangiTagihan($request->idtagihan, FormatPaymentAmount::format($request->payment_amount));
                    break;
            }

            DB::commit();
            return redirect()->back()->with('success', 'Pembayaran berhasil');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard.payment')->with('error', 'Pembayaran gagal. Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    protected function pembayaranBuilder($request)
    {
        $tagihandata =  (new PembayaranEntityBuilder)
            ->setTagihanId($request->idtagihan)
            ->setJumlahPembayaran(FormatPaymentAmount::format($request->payment_amount))
            ->setTanggalPembayaran($request->payment_date)
            ->setMetodePembayaran($request->payment_method)
            ->setKeterangan($request->note);
        if ($request->hasFile('payment_file')) {
            $tagihandata->setBuktiPembayaran($this->uploadFile($request->file('payment_file'), 'payment'));
        }
        return $tagihandata->build();
    }

    private function getJumlahTagihan($tagihanId)
    {
        $tagihan = $this->getTagihanById($tagihanId);
        return $tagihan;
    }

    public function getAllDataPembayaran()
    {
        $dataPembayaran = $this->pembayaranRepository->getModels()::with('tagihan')->orderBy('created_at', 'desc')->get();

        return DataTables::of($dataPembayaran)
            ->addIndexColumn()
            ->addColumn('student_name', function ($data) {
                return $data->tagihan->student->name;
            })
            ->addColumn('bulan_tagihan', function ($data) {
                return $data->tagihan->bulan_tagihan;
            })
            ->addColumn('tahun_tagihan', function ($data) {
                return $data->tagihan->tahun_tagihan;
            })
            ->addColumn('jumlah_tagihan', function ($data) {
                $tagihan = $data->tagihan->jumlah_tagihan;
                return 'Rp. ' . number_format((float)$tagihan, 0, ',', '.');
            })
            ->addColumn('tanggal_pembayaran', function ($data) {
                // return $data->tanggal_pembayaran;
                return date('d-M-Y', strtotime($data->tanggal_pembayaran));
            })
            ->addColumn('metode_pembayaran', function ($data) {
                return $data->metode_pembayaran;
            })
            ->addColumn('jumlah_pembayaran', function ($data) {
                return 'Rp. ' . number_format((float)$data->jumlah_pembayaran, 0, ',', '.');
            })
            ->addColumn('sisatagihan', function ($data) {
                return 'Rp. ' . number_format((float)$data->tagihan->sisa_tagihan, 0, ',', '.');
            })
            ->addColumn('bukti_pembayaran', function ($data) {
                if ($data->bukti_pembayaran) {
                    return '<a href="' . asset('storage/' . $data->bukti_pembayaran) . '" target="_blank">Lihat</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('keterangan', function ($data) {
                return $data->keterangan;
            })
            ->addColumn('action', function ($data) {
                if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('admin spp')) {
                    return '<button class="btn btn-sm btn-danger" onclick="cancelPembayaran(' . $data->id . ')">Batal</button>';
                }
                return '';
            })

            ->rawColumns(['action', 'bukti_pembayaran'])
            ->make(true);
    }

    public function totalPembayaranBulanan()
    {
        return $this->pembayaranRepository->totalPembayaranBulanan();
    }

    public function persentasePembayaranBulanIni()
    {
        $bulanini = floatval($this->pembayaranRepository->totalPembayaranBulanan()->total_payment);
        $bulanlalu = floatval($this->pembayaranRepository->totalPembayaranBulanLalu()->total_payment);

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

    public function totalPembayaranBulanLalu()
    {
        return $this->pembayaranRepository->totalPembayaranBulanLalu();
    }

    public function totalPembayaranTahunan()
    {
        return $this->pembayaranRepository->totalPembayaranTahunan();
    }

    public function cancelPembayaran($id)
    {
        $pembayaran = $this->pembayaranRepository->getModels()::find($id);
        $tagihan = $this->getTagihanById($pembayaran->tagihan_id);
        $sisatagihan = $tagihan->sisa_tagihan + $pembayaran->jumlah_pembayaran;

        $kembalikanTagihan = $this->repository->getModels()::where('id', $pembayaran->tagihan_id)->first();
        $kembalikanTagihan->sisa_tagihan = $sisatagihan;
        if ($sisatagihan == $kembalikanTagihan->jumlah_tagihan) {
            $kembalikanTagihan->status_tagihan = 'unpaid';
        } elseif ($sisatagihan > 0) {
            $kembalikanTagihan->status_tagihan = 'installment';
        } else {
            $kembalikanTagihan->status_tagihan = 'paid';
        }
        $kembalikanTagihan->save();
        // soft delete pembayaran
        $pembayaran->delete();
        return ResponseJsonFormater::success(message: 'Pembayaran berhasil dibatalkan');
    }

    public function editPembayaran($request)
    {
        try {
            DB::beginTransaction();

            $pembayaran = $this->pembayaranRepository->getModels()::find($request->tagihan_id);
            $tagihan = $this->getTagihanById($pembayaran->tagihan_id);

            // Hitung sisa tagihan baru
            $sisaTagihan = $tagihan->sisa_tagihan + $request->jumlah_pembayaran - $pembayaran->jumlah_pembayaran;

            // Perbarui atribut pembayaran
            $pembayaran->jumlah_pembayaran = $request->jumlah_pembayaran;
            $pembayaran->sisa_tagihan = $sisaTagihan;
            $pembayaran->keterangan = $request->keterangan;
            $pembayaran->metode_pembayaran = $request->metode;
            $pembayaran->save();

            // Perbarui sisa tagihan pada tagihan
            $tagihan->sisa_tagihan = $sisaTagihan;

            // Perbarui status tagihan
            $tagihan->status_tagihan = ($sisaTagihan == 0) ? 'paid' : 'installment';

            $tagihan->save();

            DB::commit();

            return ResponseJsonFormater::success(message: 'Pembayaran berhasil diedit');
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseJsonFormater::error(message: 'Pembayaran gagal diedit. Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function getAllDataPembayaranBatal()
    {
        $dataPembayaran = $this->pembayaranRepository->getModels()::with('tagihan')
            ->withTrashed()
            ->whereNotNull('deleted_at')
            ->orderBy('created_at', 'desc')->get();

        return DataTables::of($dataPembayaran)
            ->addIndexColumn()
            ->addColumn('student_name', function ($data) {
                return $data->tagihan->student->name;
            })
            ->addColumn('bulan_tagihan', function ($data) {
                return $data->tagihan->bulan_tagihan;
            })
            ->addColumn('tahun_tagihan', function ($data) {
                return $data->tagihan->tahun_tagihan;
            })
            ->addColumn('jumlah_tagihan', function ($data) {
                $tagihan = $data->tagihan->jumlah_tagihan;
                return 'Rp. ' . number_format((float)$tagihan, 0, ',', '.');
            })
            ->addColumn('tanggal_pembayaran', function ($data) {
                // return $data->tanggal_pembayaran;
                return date('d-M-Y', strtotime($data->tanggal_pembayaran));
            })
            ->addColumn('metode_pembayaran', function ($data) {
                return $data->metode_pembayaran;
            })
            ->addColumn('jumlah_pembayaran', function ($data) {
                return 'Rp. ' . number_format((float)$data->jumlah_pembayaran, 0, ',', '.');
            })
            ->addColumn('sisatagihan', function ($data) {
                return 'Rp. ' . number_format((float)$data->tagihan->sisa_tagihan, 0, ',', '.');
            })
            ->addColumn('bukti_pembayaran', function ($data) {
                if ($data->bukti_pembayaran) {
                    return '<a href="' . asset('storage/' . $data->bukti_pembayaran) . '" target="_blank">Lihat</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('keterangan', function ($data) {
                return $data->keterangan;
            })


            ->rawColumns(['bukti_pembayaran'])
            ->make(true);
    }
}
