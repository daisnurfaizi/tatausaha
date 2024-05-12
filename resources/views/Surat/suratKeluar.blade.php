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
    <script src="https://cdn.ckeditor.com/4.15.1/full-all/ckeditor.js"></script>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Pages
        @endslot
        @slot('title')
            Surat Keluar
        @endslot
    @endcomponent

    <div class="row">
        <x-card title="Surat Keluar">
            <form action="{{ route('surat.addsuratkeluar') }}" id="formSuratKeluar" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id">
                {{-- nomor surat --}}
                <x-form.input id="nomor_surat" type="text" label="Nomor Surat" name="nomor_surat" value=""
                    placeholder="Masukkan Nomor Surat" />
                <x-form.input id="tanggal_kirim" type="date" label="Tanggal Surat" name="tanggal_kirim" value=""
                    placeholder="Masukkan Tanggal Surat" />
                {{-- tujuan --}}
                <x-form.input id="tujuan" type="text" label="Tujuan" name="tujuan" value=""
                    placeholder="Masukkan Tujuan" />
                <x-form.input id="perihal" type="text" label="Perihal" name="perihal" value=""
                    placeholder="Masukkan Perihal" />
                {{-- keterangan --}}
                <x-form.input id="keterangan" type="text" label="Keterangan" name="keterangan" value=""
                    placeholder="Masukkan Keterangan" />
                <label for="content">Isi Surat</label>
                <textarea id="content" name="content">

                    </textarea>

                <div class="mt-3">
                    <button type="submit" id="buttonsuratkeluar" class="btn btn-primary">Simpan</button>
                    <button type="button" id="resetButton" class="btn btn-secondary" onclick="reset()">Reset</button>
                </div>
            </form>
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
                        <th>Aksi</th>

                    </tr>
                </thead>
                <tbody>

            </table>
        </x-card>
    </div>



    <script>
        CKEDITOR.replace('content', {
            extraPlugins: 'divarea'
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
                    data: 'tanggal_kirim',
                    name: 'tanggal_kirim'
                },

                {
                    data: 'tujuan',
                    name: 'tujuan'
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
        $(document).ready(function() {
            $('#resetButton').click(function() {
                reset(); // Call the reset function when the reset button is clicked
            });
        });

        function reset() {
            $('#nomor_surat').val('');
            $('#tanggal_kirim').val('');
            $('#tujuan').val('');
            $('#perihal').val('');
            $('#keterangan').val('');
            $('#content').val('');
            $('#id').val('');
            $('#formSuratKeluar').attr('action', "{{ route('surat.addsuratkeluar') }}");
            $('#buttonsuratkeluar').text('Simpan');
        }
    </script>
    <script>
        function editSuratKeluar(id) {
            let nomorsurat = $('#nomor_surat');
            let tanggalkirim = $('#tanggal_kirim');
            let tujuan = $('#tujuan');
            let perihal = $('#perihal');
            let keterangan = $('#keterangan');
            let content = $('#content');
            let id_surat = $('#id');


            $.ajax({
                url: "{{ url('surat/getdatasuratkeluarbyid') }}" + '/' + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    console.log(data);
                    nomorsurat.val(data.nomor_surat);
                    tanggalkirim.val(data.tanggal_kirim);
                    tujuan.val(data.tujuan);
                    perihal.val(data.perihal);
                    keterangan.val(data.keterangan);
                    // ckeditor
                    CKEDITOR.instances['content'].setData(data.content);
                    id_surat.val(data.id);
                    // Scroll to the form
                    $('html, body').animate({
                        scrollTop: $('#formSuratKeluar').offset().top
                    }, 200); // Adjust the time as needed

                }
            });
            $('#formSuratKeluar').attr('action', "{{ url('surat/updatesuratkeluar') }}");
            $('#buttonsuratkeluar').text('Update');
        }
    </script>
@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
