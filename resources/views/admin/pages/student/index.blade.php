@extends('admin.layouts.app')
@section('main')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">
                        @if ($voruv == 'v')
                            Total Students
                        @elseif($voruv == 'uv')
                            Unverified Student
                        @else
                        @endif
                    </h4>
                    <div>
                        <a class="btn btn-sm btn-warning" href="{{ route('student.block') }}">Ban Student <i
                                class="fa fa-ban ml-2" aria-hidden="true"></i></a>
                        <a class="btn btn-sm btn-danger" href="{{ route('student.trash') }}">Trash Student <i
                                class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>
                        <a type="button" href="{{ route('all.student.export') }}"
                            class="btn btn-sm btn-primary my-2">Download All Students Details</a>

                    </div>
                </div>
                @include('validate-main')
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="listRender" class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Universit/Institution</th>
                                    <th>Cell</th>
                                    <th>Photo</th>
                                    @if ($form_type == 'create')
                                        <th>Created At</th>
                                    @endif
                                    @if ($form_type == 'edit')
                                        <th>Updated At</th>
                                    @endif
                                    <!--<th>Status</th>-->
                                    <th>Last Active</th>
                                    <!--<th>Selected</th>-->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            var table = $('#listRender').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('student.verified') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'fullName', name: 'fullName'},
                    {data: 'email', name: 'email'},
                    {data: 'uniname', name: 'uniname'},
                    {data: 'cell', name: 'cell'},
                    {data: 'image', name: 'image'},
                    {data: 'createdAt', name: 'createdAt'},
                    {data: 'lastActive', name: 'lastActive'},
                    {data: 'action', name: 'action'}
                ]
            });
        });
    </script>
@endpush
