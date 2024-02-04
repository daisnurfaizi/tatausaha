{{-- @endif enderror --}}
@extends('layouts.master')
@section('title')
    @lang('translation.starter')
@endsection
@section('css')
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Pages
        @endslot
        @slot('title')
            Starter
        @endslot
    @endcomponent
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <strong> Something is very wrong! </strong> There were some problems with your input. <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <strong> Success! </strong> {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Buat User</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Nama:</label>
                            <input type="text" class="form-control" name="name" required value="{{ old('name') }}">
                        </div>
                        <div class="mb-3">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" required value="{{ old('email') }}">
                        </div>

                        <div class="mb-3">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation">Confirm Password:</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <div class="mb-3">
                            <label for="role">Role:</label>
                            <select class="form-select" name="role" required>
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
