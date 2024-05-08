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
            Kop Surat
        @endslot
    @endcomponent

    <div class="row">
        <x-card title="Surat Keluar">
            <form method="post" action="{{ route('kop.createkop') }}">
                @csrf

                <textarea id="editor" name="content">
                    @if ($kop != null)
{!! $kop->content !!}
@endif
                </textarea>

                <!-- Add any other form fields if needed -->

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </x-card>
    </div>



    <script>
        CKEDITOR.replace('editor', {
            extraPlugins: 'divarea'
        });
    </script>
@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
