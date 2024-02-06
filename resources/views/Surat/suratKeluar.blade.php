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
            <form action="{{ route('surat.addsuratkeluar') }}" method="POST" enctype="multipart/form-data">
                @csrf
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
                <x-form.input id="keterangan" type="text" label="Keterangan" name="keterangan" value=""
                    placeholder="Masukkan Keterangan" />
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </x-card>
        <x-card title="Data Surat Keluar">

        </x-card>
    </div>



    <script>
        CKEDITOR.replace('content', {
            extraPlugins: 'divarea'
        });
    </script>
@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
