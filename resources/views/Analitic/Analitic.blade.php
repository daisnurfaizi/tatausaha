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

                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate bg-primary">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-bold text-white-50 text-truncate mb-0">
                                            Pembayaran SPP Tahun Ini</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        {{-- <h5 class="text-white fs-14 mb-0">
                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                            +16.24 %
                                        </h5> --}}
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-bold ff-secondary text-white mb-4">Rp.<span
                                                class="counter-value" data-target="{{ $keseluruhanPembayaran }}">0</span>
                                        </h4>
                                        {{-- <a href="" class="text-decoration-underline text-white-50">View
                                            net earnings</a> --}}
                                    </div>
                                    {{-- <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-white bg-opacity-10 rounded fs-3">
                                            <i class="bx bx-dollar-circle text-white"></i>
                                        </span>
                                    </div> --}}
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate bg-secondary">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-bold text-white-50 text-truncate mb-0">
                                            Pembayaran Bulan ini</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-white fs-14 mb-0">
                                            {!! $persentasePembayaran !!}
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-bold ff-secondary text-white mb-4">Rp. <span
                                                class="counter-value" data-target="{{ $totalBulanini }}">0</span></h4>

                                    </div>

                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate bg-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-bold text-white-50 text-truncate mb-0">
                                            Pembayaran Bulan Lalu</p>
                                    </div>
                                    <div class="flex-shrink-0">

                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-bold ff-secondary text-white mb-4">Rp. <span
                                                class="counter-value" data-target="{{ $totalBulanLalu }}">0</span>
                                        </h4>

                                    </div>
                                    <div class="avatar-sm flex-shrink-0">

                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate bg-info">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-bold text-white-50 text-truncate mb-0">
                                            Jumlah Siswa</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        {{-- <h5 class="text-white fs-14 mb-0">
                                            +0.00 %
                                        </h5> --}}
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-bold ff-secondary text-white mb-4"><span class="counter-value"
                                                data-target="{{ $totalSiswa }}">0</span>
                                        </h4>

                                    </div>
                                    <div class="avatar-sm flex-shrink-0">

                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div> <!-- end row-->



            </div> <!-- end .h-100-->

        </div> <!-- end col -->


    </div>
    <div class="row">
        <div class="col-xl-4">
            <div class="card card-height-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Toal Siswa Yang Sudah Bayar pada bulan ini</h4>
                    <div class="flex-shrink-0">
                        <div class="dropdown card-header-dropdown">
                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <span class="text-muted fs-16"><i class="mdi mdi-dots-vertical align-middle"></i></span>
                            </a>

                        </div>
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <div id="siswadata" data-colors='["--vz-primary", "--vz-warning", "--vz-info"]' class="apex-charts"
                        dir="ltr"></div>

                    <div class="table-responsive mt-3">
                        <table class="table table-borderless table-sm table-centered align-middle table-nowrap mb-0">
                            <tbody class="border-0">
                                <tr>
                                    <td>
                                        <h4 class="text-truncate fs-14 mb-0"><i
                                                class="ri-stop-fill align-middle fs-18 text-primary me-2"></i>Siswa yang
                                            Sudah Bayar</h4>
                                    </td>
                                    <td>
                                        <p class="text-muted mb-0"><i data-feather="users"
                                                class="me-2 icon-sm"></i>{{ $paidStudent }}
                                        </p>
                                    </td>
                                    <td class="text-end">
                                        <p class="text-success fw-medium fs-13 mb-0"><i
                                                class="ri-arrow-up-s-fill fs-5 align-middle"></i>{{ ($paidStudent / $totalSiswa) * 100 }}%
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 class="text-truncate fs-14 mb-0"><i
                                                class="ri-stop-fill align-middle fs-18 text-warning me-2"></i>Siswa yang
                                            Belum Bayar</h4>
                                    </td>
                                    <td>
                                        <p class="text-muted mb-0"><i data-feather="users"
                                                class="me-2 icon-sm"></i>{{ $studentUnpaid }}
                                        </p>
                                    </td>
                                    <td class="text-end">
                                        <p class="text-danger fw-medium fs-13 mb-0"><i
                                                class="ri-arrow-down-s-fill fs-5 align-middle"></i>{{ ($studentUnpaid / $totalSiswa) * 100 }}%
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->



    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Data Pembayaran</h5>
        </div>
        <div class="card-body">

            <div id="filter-bulan"></div>


            <div id="filter-nama"></div>


            <table id="paymentdata" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Pembayaran</th>
                        <th>Bulan</th>
                        <th>Tanggal</th>
                        <th>Metode Pembayaran</th>
                        <th>Keterangan</th>
                        <th>Bukti Transfer</th>

                    </tr>
                </thead>
                <tbody>
                    <!-- Isi tabel di sini -->
                </tbody>
            </table>

        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Kartu Pembayaran</h5>
        </div>
        <div class="card-body">


            <table id="kartupembayaran" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Januari</th>
                        <th>Februari</th>
                        <th>Maret</th>
                        <th>April</th>
                        <th>Mei</th>
                        <th>Juni</th>
                        <th>Juli</th>
                        <th>Agustus</th>
                        <th>September</th>
                        <th>Oktober</th>
                        <th>November</th>
                        <th>Desember</th>

                    </tr>
                </thead>
                <tbody>
                    <!-- Isi tabel di sini -->
                </tbody>
            </table>

        </div>
    </div>
    <script>
        $('#paymentdata').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('dashboard.getDataPayment') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama_siswa',
                    name: 'nama_siswa'
                },
                {
                    data: 'payment_amount',
                    name: 'payment_amount'
                },
                {
                    data: 'month',
                    name: 'month'
                },
                {
                    data: 'payment_date',
                    name: 'payment_date'
                },
                {
                    data: 'payment_method',
                    name: 'payment_method'
                },
                {
                    data: 'note',
                    name: 'note'
                },
                {
                    data: 'payment_file',
                    name: 'payment_file'
                },

            ],
            // dom: 'lBfrtip', // Menampilkan elemen filter
            // buttons: [
            //     'csv', 'excel', 'pdf', // Menambahkan tombol eksport CSV, Excel, dan PDF
            //     {
            //         extend: 'print',
            //         text: 'Print',
            //         exportOptions: {
            //             modifier: {
            //                 selected: null
            //             }
            //         }
            //     }
            // ],
            // initComplete: function() {
            //     this.api().columns('1').every(function() {
            //         var column = this;
            //         var select = $('<select><option value="">Filter Nama</option></select>')
            //             .appendTo($('#filter-nama').empty())
            //             .on('change', function() {
            //                 var val = $.fn.dataTable.util.escapeRegex(
            //                     $(this).val()
            //                 );
            //                 column.search(val ? '^' + val + '$' : '', true, false).draw();
            //             });

            //         column.data().unique().sort().each(function(d, j) {
            //             select.append('<option value="' + d + '">' + d + '</option>');
            //         });
            //     });
            //     $('#filter-nama').appendTo('.dataTables_filter');
            //     // Membuat filter berdasarkan bulan
            //     this.api().columns('3').every(function() {
            //         var column = this;
            //         var select = $('<select><option value="">Filter Bulan</option></select>')
            //             .appendTo($('#filter-bulan')
            //                 .empty()) // ID filter-bulan adalah div tempat filter ditempatkan
            //             .on('change', function() {
            //                 var val = $.fn.dataTable.util.escapeRegex(
            //                     $(this).val()
            //                 );
            //                 column.search(val ? '^' + val + '$' : '', true, false).draw();
            //             });

            //         column.data().unique().sort().each(function(d, j) {
            //             select.append('<option value="' + d + '">' + d + '</option>');
            //         });
            //     });
            //     $('#filter-bulan').appendTo('.dataTables_filter');
            //     $('#filter-nama').appendTo('.dataTables_filter');
            // }


        });
        $('#kartupembayaran').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('dashboard.getKartuPembayaran') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama_siswa',
                    name: 'nama_siswa'
                },
                {
                    data: 'januari',
                    name: 'januari'
                },
                {
                    data: 'februari',
                    name: 'februari'
                },
                {
                    data: 'maret',
                    name: 'maret'
                },
                {
                    data: 'april',
                    name: 'april'
                },
                {
                    data: 'mei',
                    name: 'mei'
                },
                {
                    data: 'juni',
                    name: 'juni'
                },
                {
                    data: 'juli',
                    name: 'juli'
                },
                {
                    data: 'agustus',
                    name: 'agustus'
                },
                {
                    data: 'september',
                    name: 'september'
                },
                {
                    data: 'oktober',
                    name: 'oktober'
                },
                {
                    data: 'november',
                    name: 'november'
                },
                {
                    data: 'desember',
                    name: 'desember'
                }
            ],
        })

        function getDataSiswaBelumBayar() {
            $.ajax({
                url: "{{ route('dashboard.getDataSiswaBelumBayar') }}",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    console.log(data);
                }
            });

        }
    </script>
@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
    <script>
        var studentPaid = {{ $paidStudent }};
        var studentUnpaid = {{ $studentUnpaid }};
        console.log(studentPaid);

        function getChartColorsArray(chartId) {
            if (document.getElementById(chartId) !== null) {
                var colors = document.getElementById(chartId).getAttribute("data-colors");
                if (colors) {
                    colors = JSON.parse(colors);
                    return colors.map(function(value) {
                        var newValue = value.replace(" ", "");
                        if (newValue.indexOf(",") === -1) {
                            var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
                            if (color) return color;
                            else return newValue;;
                        } else {
                            var val = value.split(',');
                            if (val.length == 2) {
                                var rgbaColor = getComputedStyle(document.documentElement).getPropertyValue(val[0]);
                                rgbaColor = "rgba(" + rgbaColor + "," + val[1] + ")";
                                return rgbaColor;
                            } else {
                                return newValue;
                            }
                        }
                    });
                } else {
                    console.warn('data-colors atributes not found on', chartId);
                }
            }
        }
        var dountchartUserDeviceColors = getChartColorsArray("siswadata");
        if (dountchartUserDeviceColors) {
            var options = {
                series: [studentPaid, studentUnpaid],
                labels: ["Sudah Bayar", "Belum Bayar"],
                chart: {
                    type: "donut",
                    height: 219,
                },
                plotOptions: {
                    pie: {
                        size: 100,
                        donut: {
                            size: "76%",
                        },
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                legend: {
                    show: false,
                    position: 'bottom',
                    horizontalAlign: 'center',
                    offsetX: 0,
                    offsetY: 0,
                    markers: {
                        width: 20,
                        height: 6,
                        radius: 2,
                    },
                    itemMargin: {
                        horizontal: 12,
                        vertical: 0
                    },
                },
                stroke: {
                    width: 0
                },
                yaxis: {
                    labels: {
                        formatter: function(value) {
                            return value;
                        }
                    },
                    tickAmount: 4,
                    min: 0
                },
                colors: dountchartUserDeviceColors,
            };
            var chart = new ApexCharts(document.querySelector("#siswadata"), options);
            chart.render();
        }
    </script>
    <!-- dashboard init -->

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
