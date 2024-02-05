@extends('layouts.master')
@section('title')
    @lang('translation.analytics')
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet">
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
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboards
        @endslot
        @slot('title')
            Analytics
        @endslot
    @endcomponent
    <div class="row">
        <div class="col">
            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">Welcome, {{ Auth::user()->name }}!</h4>
                                <p class="text-muted mb-0">Here's what's happening with your school
                                    today.</p>
                            </div>

                        </div><!-- end card header -->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div> <!-- end .h-100-->
        </div> <!-- end col -->
    </div>
    <div class="row project-wrapper">
        <div class="col-xxl-8">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                        <i data-feather="mail" class="text-primary"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden ms-3">
                                    <p class="text-uppercase fw-semibold text-muted text-truncate mb-3">Surat Masuk</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                                data-target="{{ $datasuratMasuk }}">0</span></h4>
                                    </div>

                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </div><!-- end col -->

                <div class="col-xl-4">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-warning-subtle text-warning rounded-2 fs-2">
                                        <i data-feather="mail" class="text-warning"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-uppercase fw-semibold text-truncate text-muted mb-3">Surat Keluar</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                                data-target="{{ $dataSuratKeluar }}">0</span></h4>

                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </div><!-- end col -->


            </div><!-- end row -->


        </div><!-- end col -->
    </div><!-- end row -->
    <x-card title="Data Surat Masuk">
        <table id="suratmasuk" class="table table-bordered dt-responsive nowrap table-striped align-middle"
            style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Surat</th>
                    <th>Tangal Terima</th>
                    <th>Pengirim</th>
                    <th>Perihal</th>
                    <th>File</th>
                    <th>Keterangan</th>

                </tr>
            </thead>
            <tbody>

        </table>
    </x-card>
    <x-card title="Data Surat Keluar">
        <table id="suratkeluar" class="table table-bordered dt-responsive nowrap table-striped align-middle"
            style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Surat</th>
                    <th>Tangal kirim</th>
                    <th>Tujuan</th>
                    <th>Perihal</th>
                    <th>Lampiran</th>
                    <th>Keterangan</th>

                </tr>
            </thead>
            <tbody>

        </table>
    </x-card>
    <script>
        $('#suratmasuk').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('surat.getdatasuratmasuk') }}",
            columns: [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'nomor_surat',
                    name: 'nomor_surat'
                },
                {
                    data: 'tanggal_terima',
                    name: 'tanggal_terima'
                },

                {
                    data: 'pengirim',
                    name: 'pengirim'
                },
                {
                    data: 'perihal',
                    name: 'perihal'
                },
                {
                    data: 'lampiran',
                    name: 'lampiran'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },

            ]

        });
        $('#suratkeluar').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('surat.getdatasuratkeluar') }}",
            columns: [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'nomor_surat',
                    name: 'nomor_surat'
                },
                {
                    data: 'tanggal_terima',
                    name: 'tanggal_terima'
                },

                {
                    data: 'pengirim',
                    name: 'pengirim'
                },
                {
                    data: 'perihal',
                    name: 'perihal'
                },
                {
                    data: 'lampiran',
                    name: 'lampiran'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },

            ]

        });
    </script>
@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <!-- dashboard init -->
    <script src="{{ URL::asset('build/js/pages/dashboard-analytics.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
