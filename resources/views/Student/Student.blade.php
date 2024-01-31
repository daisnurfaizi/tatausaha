@extends('layouts.master')
@section('title')
    @lang('translation.starter')
@endsection
@section('css')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

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
            Pages
        @endslot
        @slot('title')
            List Student
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">List Student</h5>
                </div>
                <div class="card-body">
                    <x-alert.alert />
                    {{-- modal --}}
                    <!-- Grids in modals -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalgrid">
                        Tambah Data Siswa <i class="mdi mdi-plus-circle ms-1"></i>
                    </button>
                    {{-- endmodal --}}
                    {{-- export --}}
                    <div class="row">
                        <form action="{{ route('dashboard.studentImport') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-sm-4">
                                <div class="row">
                                    <input type="file" name="file" class="form-control">
                                    <button type="submit" class="btn btn-info">
                                        Import Data Siswa <i class="mdi mdi-file-import ms-1"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>
                    <a href="{{ route('dashboard.studentExport') }}" class="btn btn-success">
                        Export Data Siswa <i class="mdi mdi-file-export ms-1"></i>
                    </a>
                    {{-- endexport --}}
                    <br><br>
                    {{-- import --}}


                    {{-- endimport --}}
                    {{-- template --}}
                    <a href="{{ route('dashboard.studentTemplate') }}" class="btn btn-dark">
                        Template Data Siswa <i class="mdi mdi-file-document ms-1"></i>
                    </a>
                    <table id="student" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nisn</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                    </table>
                    <div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel"
                        aria-modal="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalgridLabel">Tambah Data Siswa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="row g-3">
                                        <div class="col-xxl-6">
                                            <div>
                                                <label for="nama" class="form-label">nama</label>
                                                <input type="text" class="form-control" id="nama"
                                                    placeholder="Enter firstname" name="nama">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-xxl-6">
                                            <div>
                                                <label for="nisn" class="form-label">Nisn</label>
                                                <input type="text" class="form-control" id="nisn"
                                                    placeholder="Enter nisn">
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" id="buttonmodal" class="btn btn-primary"
                                                    onclick="addStudent()">Submit</button>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#student').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('dashboard.getdatastudent') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nisn',
                    name: 'nisn'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ]

        });

        function addStudent() {
            var nisn = $('#nisn').val();
            var name = $('#nama').val();
            $.ajax({
                url: "{{ route('dashboard.savestudent') }}",
                type: "POST",
                data: {
                    nisn: nisn,
                    name: name,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#student').DataTable().ajax.reload();
                    Toastify({
                        text: "Data Berhasil Ditambahkan",
                        duration: 3000,
                        gravity: "top",
                        position: 'right',
                        backgroundColor: "#228B22",
                        stopOnFocus: true,
                    }).showToast();
                    $('#exampleModalgrid').modal('hide');
                },
                error: function(xhr, status, error) {
                    Toastify({
                        text: xhr.responseJSON.message,
                        duration: 3000,
                        gravity: "top",
                        position: 'right',
                        backgroundColor: "#FF0000",
                        stopOnFocus: true,
                    }).showToast();
                }
            });

        }

        function editStudent(id, nisn, nama) {
            $('#exampleModalgrid').modal('show');
            $('#nisn').val(nisn);
            $('#nama').val(nama);
            $('#buttonmodal').attr('onclick', 'updateStudent(' + id + ')');
            $('#exampleModalgridLabel').html('Edit Data Siswa');
            $('#buttonmodal').removeClass('btn-primary');
            $('#buttonmodal').addClass('btn-success');
            $('#buttonmodal').html('Update');
        }

        function updateStudent(id) {
            var nisn = $('#nisn').val();
            var name = $('#nama').val();
            $.ajax({
                url: "{{ route('dashboard.updatestudent') }}",
                type: "POST",
                data: {
                    id: id,
                    nisn: nisn,
                    name: name,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#student').DataTable().ajax.reload();
                    Toastify({
                        text: "Data Berhasil Diupdate",
                        duration: 3000,
                        gravity: "top",
                        position: 'right',
                        backgroundColor: "#228B22",
                        stopOnFocus: true,
                    }).showToast();
                    $('#exampleModalgrid').modal('hide');
                    $('#exampleModalgridLabel').html('Tambah Data Siswa');
                    $('#buttonmodal').removeClass('btn-success');
                    $('#buttonmodal').addClass('btn-primary');
                    $('#buttonmodal').html('Submit');

                },
                error: function(xhr, status, error) {
                    Toastify({
                        text: xhr.responseJSON.message,
                        duration: 3000,
                        gravity: "top",
                        position: 'right',
                        backgroundColor: "#FF0000",
                        stopOnFocus: true,
                    }).showToast();
                }
            });
        }
    </script>
@endsection
@section('script')
    <script src="{{ asset('/js/toastify.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
