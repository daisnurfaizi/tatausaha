@extends('layouts.master')
@section('title')
    @lang('translation.starter')
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
@endsection
@section('content')
    @php
    @endphp
    @component('components.breadcrumb')
        @slot('li_1')
            Pages
        @endslot
        @slot('title')
            Payment
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Input Data Tagihan</h5>
                </div>
                <div class="card-body">
                    <button type="button" id="createTagihan" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#tagihanModalgrid">Buat
                        Tagihan Bulan Ini Kepada Seluruh
                        Siswa</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#exampleModalgrid">
                        Buat Tagihan Bersarkan Bulan <i class="mdi mdi-plus-circle ms-1"></i>
                    </button>
                    <x-alert.alert />

                </div>
            </div>
            <x-history.historytagihan />

            <x-history.historytagihanbatal />

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Kartu Pembayaran</h5>
                </div>
                <div class="card-body">
                    <x-kartu.kartupembayaran />
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="paymentedit" tabindex="-1" aria-labelledby="paymentediteditlabel" aria-modal="true">
        <form id="editdatapaymentsiswa" action="{{ route('dashboard.updatepayment') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="idedit" name="id" value="">
            <input type="hidden" id="nisnedit" name="nisn" value="">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paymentediteditlabel">Edit Data Spp</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <div>
                                    <x-form.input id="namasiswaedit" type="text" label="Nama" name="name"
                                        placeholder="Masukkan nama" readonly="true" />
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <x-form.input id="jumlahpembayaranedit" type="text" label="Jumlah Pembayaran"
                                        name="payment_amount" placeholder="Enter jumlah pembayaran" required="true" />
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    {{-- bulan --}}
                                    <x-form.input id="bulanedit" type="select" label="Bulan" name="month" required=true
                                        :options="[
                                            'januari' => 'Januari',
                                            'februari' => 'Februari',
                                            'maret' => 'Maret',
                                            'april' => 'April',
                                            'mei' => 'Mei',
                                            'juni' => 'Juni',
                                            'juli' => 'Juli',
                                            'agustus' => 'Agustus',
                                            'september' => 'September',
                                            'oktober' => 'Oktober',
                                            'november' => 'November',
                                            'desember' => 'Desember',
                                        ]" />
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <x-form.input id="dateedit" type="date" label="Tanggal" name="payment_date"
                                        placeholder="Enter date" required="true" />
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    {{-- metode pembayaran --}}
                                    <x-form.input id="metodepembayaranedit" type="select" label="Metode Pembayaran"
                                        name="payment_method" :options="['cash' => 'Cash', 'transfer' => 'Transfer']" />
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    {{-- keterangan --}}
                                    <x-form.input id="keteranganedit" type="textarea" label="Keterangan" name="note"
                                        placeholder="Enter keterangan" />
                                </div>
                            </div><!--end col-->
                            {{-- upload bukti transfer --}}
                            <div class="col-xxl-6">
                                <div>
                                    <x-form.input id="buktitransferedit" type="file" label="Bukti Transfer"
                                        name="payment_file" placeholder="Enter bukti transfer" />
                                </div>
                            </div><!--end col-->
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" id="buttonmodal" class="btn btn-primary">Submit</button>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel"
        aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Buat Tagihan Bulan Spesifik</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row g-3">
                        <div class="col-xxl-6">
                            <div>
                                <label for="Bulan" class="form-label">Pilih Bulan</label>
                                <input type="month" class="form-control" id="bulantagihan" placeholder="Enter bulan">

                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="nisn" class="form-label">Tagihan</label>
                                <input type="text" class="form-control" id="tagihanbulanini"
                                    placeholder="Masukkan tagihan bulan ini">
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="buttonmodal" class="btn btn-primary"
                                    onclick="createTagihanBulanSpesifik()">Submit</button>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="tagihanModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel"
        aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Buat Tagihan Bulan ini Kepada Seluruh Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row g-3">
                        <div class="col-xxl-6">
                            <div>
                                <label for="nisn" class="form-label">Tagihan</label>
                                <input type="text" class="form-control" id="jumlahtagihanbulanini"
                                    placeholder="Masukkan tagihan bulan ini">
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="buttonmodal" class="btn btn-primary"
                                    onclick="createTagihanBulanan()">Submit</button>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
            </div>
        </div>
    </div>

    {{-- modal pembayaran edit --}}
    <div class="modal fade" id="editPembayaranModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel"
        aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idpembayaran" name="id" value="">
                    <div class="row g-3">
                        <div class="col-xxl-6">
                            <div>
                                <label for="nisn" class="form-label">Pembayaran</label>
                                <input type="text" class="form-control" id="editJumlahTagihan"
                                    placeholder="Masukkan tagihan bulan ini">
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="tglpembayaranedit" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tglpembayaranedit"
                                    placeholder="Masukkan tagihan bulan ini" value="{{ date('Y-m-d') }}">
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="metodepembayaranedit" class="form-label">Metode Pembayaran</label>
                                <select class="form-select" id="metodepembayaranedit">
                                    <option value="cash">Cash</option>
                                    <option value="transfer">Transfer</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <div>
                                <label for="keteranganedit"
                                    class="form-label
                                    ">Keterangan</label>
                                <textarea class="form-control" id="keteranganedit" rows="3" placeholder="Enter keterangan"></textarea>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="buttonmodal" class="btn btn-primary"
                                    onclick="prosesEditPembayaran()">Submit</button>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
            </div>
        </div>
    </div>

    <script>
        var base_url = window.location.origin;
    </script>
@endsection
@section('script')
    <script src="{{ URL::asset('Tagihan/tagihan.init.js') }}"></script>
    <script src="{{ URL::asset('js/component.js') }}"></script>
    <script src="{{ URL::asset('js/payment.js') }}"></script>
    <script src="{{ URL::asset('js/billing.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/select2.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
