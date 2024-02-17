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
            List User
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">List User</h5>
                </div>
                <x-alert.alert />
                <div class="card-body">
                    <table id="users" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                @if (auth()->user()->hasRole('admin'))
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Ubah Data User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dashboard.updateuserandrole') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="idedit">
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <div>
                                    <x-form.input id="nameedit" type="text" label="Name" name="name" value=""
                                        placeholder="Masukkan data name" required="true" />
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <x-form.input id="emailedit" type="email" label="Email" name="email" value=""
                                        placeholder="Masukkan data email" required="true" />
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-12">

                                <select class="form-select" name="role" id="roleedit" required>
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" id="buttonmodal" class="btn btn-primary">Submit</button>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#users').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('dashboard.getdatauser') }}",
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'role',
                    name: 'role'
                },
                {

                    data: 'action',
                    name: 'action',
                    visible: "{{ auth()->user()->hasRole('admin') }}",
                },
            ]

        });

        function editForm(id) {
            $('#exampleModalgrid').modal('show');
            $.ajax({
                type: "GET",
                url: "{{ env('APP_URL') }}/dashboard/datauserandrole/" + id,
                success: function(response) {
                    $('#idedit').val(response.id);
                    $('#nameedit').val(response.name);
                    $('#emailedit').val(response.email);
                    $('#roleedit').val(response.roles[0].id);
                }
            });
        }
    </script>
@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
