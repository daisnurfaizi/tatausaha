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
    <div class="position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg profile-setting-img">
            <img src="{{ URL::asset('build/images/profile-bg.jpg') }}" class="profile-wid-img" alt="">
            <div class="overlay-content">
                <div class="text-end p-3">
                    <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                        <input id="profile-foreground-img-file-input" type="file"
                            class="profile-foreground-img-file-input">
                        <label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light">
                            <i class="ri-image-edit-line align-bottom me-1"></i> Change Cover
                        </label>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <div class="row">
        <div class="col-xxl-3">
            <div class="card mt-n5">
                <div class="card-body p-4">
                    <div class="text-center">
                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                            @if (Auth::user()->photo != '')
                                <img src="{{ URL::asset('storage/' . Auth::user()->photo) }} "
                                    class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                    alt="user-profile-image">
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
                                <form id="updatePhotoForm" action="{{ route('profile.updatePhoto') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                    <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                                    <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                        <input type="file" name="photo" id="photo"
                                            class="avatar-title rounded-circle bg-body text-body"
                                            style="position: absolute;width: 100%;height: 100%;left: 0;top: 0;opacity: 0;cursor: pointer;">
                                        <span class="avatar-title rounded-circle bg-body text-body">
                                            <i class="ri-camera-fill"></i>
                                        </span>
                                    </label>
                                </form>

                            </div>

                        </div>
                        <h5 class="mb-1">{{ Auth::user()->name }}</h5>
                        <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
            <!--end card-->
            <!--end card-->
        </div>
        <!--end col-->

        <div class="col-xxl-9">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                <i class="fas fa-home"></i>
                                Personal Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                <i class="far fa-user"></i>
                                Change Password
                            </a>
                        </li>

                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                            <x-alert.alert />
                            <form action="{{ 'updateProfile' }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="firstnameInput" class="form-label">Your
                                                Name</label>
                                            <input type="text" class="form-control" id="firstnameInput" name="name"
                                                placeholder="Enter your firstname"
                                                value="{{ old('name') ?? Auth::user()->name }}">
                                        </div>
                                    </div>
                                    <!--end col-->


                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Email
                                                Address</label>
                                            <input type="email" class="form-control" id="emailInput" name="email"
                                                placeholder="Enter your email"
                                                value="{{ old('email') ?? Auth::user()->email }}">
                                        </div>
                                    </div>
                                    <!--end col-->


                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-primary">Updates</button>
                                            <button type="button" class="btn btn-soft-success">Cancel</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane" id="changePassword" role="tabpanel">
                            <x-alert.alert />

                            <form action="{{ route('profile.updatePassword') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                <div class="row g-2">
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="oldpasswordInput" class="form-label">Old
                                                Password*</label>
                                            <input type="password" class="form-control" id="oldpasswordInput"
                                                name="old_password" placeholder="Enter current password">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="newpasswordInput" class="form-label">New
                                                Password*</label>
                                            <input type="password" class="form-control" id="newpasswordInput"
                                                name="password" placeholder="Enter new password">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="confirmpasswordInput" class="form-label">Confirm
                                                Password*</label>
                                            <input type="password" class="form-control" id="confirmpasswordInput"
                                                name="password_confirmation" placeholder="Confirm password">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <a href="{{ route('password.request') }}"
                                                class="link-primary text-decoration-underline">Forgot
                                                Password ?</a>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-success">Change
                                                Password</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>

                        </div>
                        <!--end tab-pane-->


                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
    <script>
        document.getElementById('photo').addEventListener('change', function() {
            document.getElementById('updatePhotoForm').submit();
        });
    </script>
@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
