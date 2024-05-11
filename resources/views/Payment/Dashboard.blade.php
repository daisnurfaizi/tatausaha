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
                    <h5 class="card-title mb-0">Input Pembayaran</h5>
                </div>
                <div class="card-body">
                    <x-alert.alert />
                    <form action="{{ route('pembayaran.createPayment') }}" method="POST" enctype="multipart/form-data"
                        id="form">
                        @csrf
                        <input type="hidden" name="idtagihan" id="idtagihan">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="nisn" class="form-label">Nama Siswa</label>
                                    <select class="js-example-basic-single"id="siswa" name="siswa">
                                        <option value="" selected>Pilih Nama Siswa</option>
                                        @foreach ($data as $siswa)
                                            <option value="{{ $siswa->id }}">{{ $siswa->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    {{-- bulan --}}
                                    <x-form.input id="bulan" type="select" label="Bulan" name="month" required=true
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
                            <div class="col-6">
                                <div class="mb-3">
                                    <x-form.input id="jumlahtagihan" type="text" label="Jumlah Tagihan"
                                        name="jumlah_tagihan" placeholder="Enter jumlah pembayaran" required="true"
                                        readonly="true" />

                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <x-form.input id="jumlahpembayaran" type="text" label="Jumlah Yang Dibayarkan"
                                        name="payment_amount" placeholder="Enter jumlah pembayaran" required="true" />

                                </div>
                            </div><!--end col-->

                            <div class="col-6">
                                <div class="mb-3">
                                    <x-form.input id="date" type="date" label="Tanggal" name="payment_date"
                                        placeholder="Enter date" required="true" />
                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    {{-- metode pembayaran --}}
                                    <x-form.input id="metodepembayaran" type="select" label="Metode Pembayaran"
                                        name="payment_method" :options="['cash' => 'Cash', 'transfer' => 'Transfer']" />

                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    {{-- keterangan --}}
                                    <x-form.input id="keterangan" type="textarea" label="Keterangan" name="note"
                                        placeholder="Enter keterangan" />
                                </div>
                            </div><!--end col-->
                            {{-- upload bukti transfer --}}
                            <div class="col-6">
                                <div class="mb-3">
                                    <x-form.input id="buktitransfer" type="file" label="Bukti Transfer"
                                        name="payment_file" placeholder="Enter bukti transfer" />
                                </div>
                            </div><!--end col-->
                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </form>
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
                                    <x-form.input id="bulanedit" type="select" label="Bulan" name="month"
                                        required=true :options="[
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

    <script>
        function createTagihanBulanan() {
            $.ajax({
                url: "{{ route('tagihan.generateTagihan') }}",
                type: "POST",
                dataType: "JSON",
                data: {
                    _token: "{{ csrf_token() }}",
                    bulan: "{{ date('M') }}",
                    jumlah: 250000
                },
                success: function(data) {
                    if (data.status == 'success') {
                        alert('Tagihan bulan ini berhasil dibuat');
                    } else {
                        alert('Tagihan bulan ini gagal dibuat');
                    }
                },
                error: function(data) {
                    alert(data.responseJSON.message)
                }
            });
        }
    </script>
    <script>
        var base_url = window.location.origin;
    </script>
@endsection
@section('script')
    <script src="{{ URL::asset('Tagihan/tagihan.init.js') }}"></script>
    <script src="{{ URL::asset('js/component.js') }}"></script>
    <script src="{{ URL::asset('js/payment.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/select2.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
