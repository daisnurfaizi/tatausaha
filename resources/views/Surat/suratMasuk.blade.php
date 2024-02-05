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
            Surat Masuk
        @endslot
    @endcomponent

    <div class="row">
        <x-card title="Surat Masuk">
            <form action="{{ route('surat.addsurat') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <x-form.input id="nomor_surat" type="text" label="Nomor Surat" name="nomor_surat" value=""
                    placeholder="Masukkan Nomor Surat" />
                <x-form.input id="tanggal_terima" type="date" label="Tanggal Surat" name="tanggal_terima" value=""
                    placeholder="Masukkan Tanggal Surat" />
                <x-form.input id="pengirim" type="text" label="Pengirim" name="pengirim" value=""
                    placeholder="Masukkan Pengirim" />
                <x-form.input id="perihal" type="text" label="Perihal" name="perihal" value=""
                    placeholder="Masukkan Perihal" />
                <x-form.input id="file" type="file" label="File" name="lampiran" value=""
                    placeholder="Masukkan File" />
                <x-form.input id="keterangan" type="text" label="Keterangan" name="keterangan" value=""
                    placeholder="Masukkan Keterangan" />
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </x-card>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

            </table>
        </x-card>
    </div>
    <div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Update Data Surat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('surat.updatesurat') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="idedit" name="id" value="">
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <div>
                                    <x-form.input id="nomorsuratedit" type="text" label="Nomor Surat"
                                        name="nomor_surat" />
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <x-form.input id="tanggalterimaedit" type="date" label="Tanggal Terima"
                                        name="tanggal_terima" />
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <x-form.input id="pengirimedit" type="text" label="Pengirim" name="pengirim" />
                                </div>
                            </div>
                            <div class="col-xxl-6">
                                <div>
                                    <x-form.input id="perihaledit" type="text" label="Perihal" name="perihal" />
                                </div>
                            </div>
                            <div class="col-xxl-6">
                                <div>
                                    <x-form.input id="lampiranedit" type="file" label="Lampiran" name="lampiran" />
                                </div>
                            </div>
                            <div class="col-xxl-6">
                                <div>
                                    <x-form.input id="keteranganedit" type="text" label="Keterangan"
                                        name="keterangan" />
                                </div>
                            </div>
                        </div><!--end row-->
                        <div class="col-lg-12 mt-3">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="buttonmodal" class="btn btn-primary">Submit</button>
                            </div>
                        </div><!--end col-->
                    </form>
                </div><!--end row-->

            </div>
        </div>
    </div>
    </div>

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
                {
                    data: 'action',
                    name: 'action'
                }
            ]

        });

        function editSuratMasuk(id) {
            $('#exampleModalgrid').modal('show');
            $.ajax({
                url: "{{ env('APP_URL') }}/surat/getdatasuratmasukByid/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(resrponse) {
                    var data = resrponse.data;
                    $('#idedit').val(data.id);
                    $('#nomorsuratedit').val(data.nomor_surat);
                    $('#tanggalterimaedit').val(data.tanggal_terima);
                    $('#pengirimedit').val(data.pengirim);
                    $('#perihaledit').val(data.perihal);
                    $('#keteranganedit').val(data.keterangan);
                }
            });
        }
    </script>
@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
