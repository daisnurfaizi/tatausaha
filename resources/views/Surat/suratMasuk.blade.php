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

    </div>

    <script></script>
@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
