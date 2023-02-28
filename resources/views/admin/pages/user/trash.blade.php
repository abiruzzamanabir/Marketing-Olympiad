@extends('admin.layouts.app')
@section('main')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">Trash Users</h4>
                <a class="btn btn-sm btn-success" href="{{ route('admin-user.index') }}">Active users <i
                        class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>
            </div>
            @include('validate-main')
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>name</th>
                                <th>Photo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($all_admin as $user)
                            @if($user->name !== 'Provider')
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$user->fast_name}} {{$user->last_name}} </td>
                                <td>
                                    @if ($user->photo == 'avatar.png')
                                    <img class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover"
                                        src="{{ url('storage/admins/avatar.png') }}" alt="Profile Picture">
                                    @else
                                    <img class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover"
                                        src="{{ url('storage/admins/'. $user->photo)}}" alt="Profile Picture">

                                    @endif
                                </td>
                                <td>
                                    {{-- <a class="btn btn-sm btn-info" href=""><i class="fa fa-eye"
                                            aria-hidden="true"></i></a> --}}
                                    <a class="btn btn-sm btn-info"
                                        href="{{ route('admin.trash.update', $user->id) }}">Restore user</a>
                                    @if ($form_type=='trash')
                                    <form class="d-inline delete-form"
                                        action="{{ route('admin-user.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete forever</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endif
                            @empty
                            <tr>
                                <td class="text-danger text-center" colspan="3">No Data Found</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection