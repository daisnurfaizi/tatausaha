@extends('layouts.master')
@section('title')
    @lang('translation.starter')
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Pages
        @endslot
        @slot('title')
            Aplikasi
        @endslot
    @endcomponent

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Setting Aplikasi</h5>
        </div>
        <div class="card-body">
            <x-alert.alert />
            <div class="row">
                <div class="col-sm-3">
                    <label for="photo" class="form-label">login logo</label>
                    <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                        @if ($aplication->login_logo != '')
                            <img src="{{ URL::asset('storage/' . $aplication->login_logo) }} "
                                class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                        @else
                            <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                <div
                                    class="avatar-title border bg-light text-primary te
                                     rounded-circle text-uppercase">
                                    {{ substr(Auth::user()->name, 0, 2) }}
                                </div>
                            </div>
                        @endif
                        <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                            <form id="updatelogin_logo" action="{{ route('dashboard.aplicationupdate') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="1">
                                <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                    <input type="file" name="login_logo" id="login_logo"
                                        class="avatar-title rounded-circle bg-body text-body"
                                        style="position: absolute;width: 100%;height: 100%;left: 0;top: 0;opacity: 0;cursor: pointer;">
                                    <span class="avatar-title rounded-circle bg-body text-body">
                                        <i class="ri-camera-fill"></i>
                                    </span>
                                </label>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <label for="photo" class="form-label">SideBar logo</label>
                    <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                        @if ($aplication->sidebar_logo != '')
                            <img src="{{ URL::asset('storage/' . $aplication->sidebar_logo) }} "
                                class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                        @else
                            <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                <div
                                    class="avatar-title border bg-light text-primary te
                                     rounded-circle text-uppercase">
                                    {{ substr(Auth::user()->name, 0, 2) }}
                                </div>
                            </div>
                        @endif
                        <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                            <form id="updateSidbarLogo" action="{{ route('dashboard.aplicationupdate') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="1">
                                <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                    <input type="file" name="sidebar_logo" id="sidebar_logo"
                                        class="avatar-title rounded-circle bg-body text-body"
                                        style="position: absolute;width: 100%;height: 100%;left: 0;top: 0;opacity: 0;cursor: pointer;">
                                    <span class="avatar-title rounded-circle bg-body text-body">
                                        <i class="ri-camera-fill"></i>
                                    </span>
                                </label>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <label for="photo" class="form-label">SideBar logo small</label>
                    <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                        @if ($aplication->sidebar_logo_small != '')
                            <img src="{{ URL::asset('storage/' . $aplication->sidebar_logo_small) }} "
                                class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                        @else
                            <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                <div
                                    class="avatar-title border bg-light text-primary te
                                     rounded-circle text-uppercase">
                                    {{ substr(Auth::user()->name, 0, 2) }}
                                </div>
                            </div>
                        @endif
                        <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                            <form id="updateSideBarLogoSmall" action="{{ route('dashboard.aplicationupdate') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="1">
                                <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                    <input type="file" name="sidebar_logo_small" id="sidebar_logo_small"
                                        class="avatar-title rounded-circle bg-body text-body"
                                        style="position: absolute;width: 100%;height: 100%;left: 0;top: 0;opacity: 0;cursor: pointer;">
                                    <span class="avatar-title rounded-circle bg-body text-body">
                                        <i class="ri-camera-fill"></i>
                                    </span>
                                </label>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <form action="{{ route('dashboard.aplicationupdate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $aplication->id }}">
                    <div class="col-sm-4">
                        <x-form.input id="" type="text" label="Title" name="title"
                            value="{{ $aplication->title }}" placeholder="masukkan title" required="" />
                    </div><!--end col-->
                    <div class="col-sm-4">
                        <x-form.input id="" type="text" label="Owner" name="owner"
                            value="{{ $aplication->owner }}" placeholder="masukkan owner" required="" />
                    </div><!--end col-->
                    <div class="col-sm-4">
                        <x-form.input id="" type="text" label="Footer" name="footer"
                            value="{{ $aplication->footer }}" placeholder="masukkan footer" required="" />
                    </div><!--end col-->

                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div><!--end col-->
                </form>
            </div>
        </div>

    </div>
    <script>
        document.getElementById('login_logo').addEventListener('change', function() {
            document.getElementById('updatelogin_logo').submit();
        });
        document.getElementById('sidebar_logo').addEventListener('change', function() {
            document.getElementById('updateSidbarLogo').submit();
        });
        document.getElementById('sidebar_logo_small').addEventListener('change', function() {
            document.getElementById('updateSideBarLogoSmall').submit();
        });
    </script>
@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
