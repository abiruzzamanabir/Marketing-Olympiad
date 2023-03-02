@extends('admin.layouts.app')
@section('main')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Admin User</h4>
                    <a class="btn btn-sm btn-danger" href="{{ route('admin.trash') }}">Trash Users <i
                            class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>
                </div>
                @include('validate-main')
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Photo</th>
                                    @if ($form_type == 'create')
                                        <th>Created At</th>
                                    @endif
                                    @if ($form_type == 'edit')
                                        <th>Updated At</th>
                                    @endif
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($all_admin as $user)
                                    @if ($user->name !== 'Provider')
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $user->fast_name }}</td>
                                            <td>
                                                @if (isset($user->role->name))
                                                    {{ $user->role->name }}
                                                @else
                                                    No Role Found
                                                @endif
                                            </td>
                                            <td>
                                                @if ($user->photo == 'avatar.png')
                                                    <img class="rounded-circle"
                                                        style="width: 40px; height: 40px; object-fit: cover"
                                                        src="{{ url('storage/admins/avatar.png') }}" alt="Profile Picture">
                                                @else
                                                    <img class="rounded-circle"
                                                        style="width: 40px; height: 40px; object-fit: cover"
                                                        src="{{ url('storage/admins/' . $user->photo) }}"
                                                        alt="Profile Picture">
                                                @endif
                                            </td>
                                            @if ($form_type == 'create')
                                                <td>{{ $user->created_at->diffForHumans() }}</td>
                                            @endif
                                            @if ($form_type == 'edit')
                                                <td>{{ $user->updated_at->diffForHumans() }}</td>
                                            @endif
                                            <td>
                                                @if ($user->status)
                                                    <span class="badge badge-success">Active User</span>
                                                    @if (Auth::guard('admin')->user()->role->name == 'Admin')
                                                        <a class="text-danger"
                                                            href="{{ route('admin.status.update', $user->id) }}"><i
                                                                class="fa fa-times" aria-hidden="true"></i></a>
                                                    @else
                                                    @endif
                                                @else
                                                    <span class="badge badge-danger">Blocked User</span>
                                                    @if (Auth::guard('admin')->user()->role->name == 'Admin')
                                                        <a class="text-success"
                                                            href="{{ route('admin.status.update', $user->id) }}"><i
                                                                class="fa fa-check" aria-hidden="true"></i></a>
                                                    @else
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                {{-- <a class="btn btn-sm btn-info" href=""><i class="fa fa-eye"
                                            aria-hidden="true"></i></a> --}}
                                                <a class="btn btn-sm btn-warning"
                                                    href="{{ route('admin-user.edit', $user->id) }}"><i class="fa fa-edit"
                                                        aria-hidden="true"></i></a>
                                                @if ($form_type == 'create')
                                                    {{-- <form class="d-inline delete-form"
                                        action="{{ route('admin-user.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fa fa-trash"
                                                aria-hidden="true"></i></button>
                                    </form> --}}
                                                    <a class="btn btn-sm btn-danger"
                                                        href="{{ route('admin.trash.update', $user->id) }}"><i
                                                            class="fa fa-trash" aria-hidden="true"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td class="text-danger text-center" colspan="5">No Data Found</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @if ($form_type == 'create')
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add new user</h4>
                    </div>
                    @include('validate')
                    <div class="card-body">
                        <form action="{{ route('admin-user.store') }}" method="POST">
                            @csrf
                            <div class="form-group order">
                                <label>Name</label>
                                <input name="fast_name" type="text" value="{{ old('fast_name') }}" class="form-control"
                                    autofocus>
                            </div>
                            <div class="form-group order">
                                <label>Email</label>
                                <input name="email" type="email" value="{{ old('email') }}" class="form-control"
                                    autofocus>
                            </div>
                            <div class="form-group order">
                                <label>User name</label>
                                <input name="username" type="text" value="{{ old('username') }}" class="form-control"
                                    autofocus>
                            </div>
                            <div class="form-group order">
                                <label>Mobile</label>
                                <input name="cell" type="text" value="{{ old('mobile') }}" class="form-control"
                                    autofocus>
                            </div>
                            <div class="form-group order">
                                <select class="form-control" name="role_id" id="">
                                    <option value="">Select</option>
                                    @foreach ($roles as $role)
                                        @if ($role->id == 1)
                                        @else
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
            @if ($form_type == 'edit')
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit user</h4>
                    </div>
                    @include('validate')
                    <div class="card-body">
                        <form action="{{ route('admin-user.update', $edit->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Name</label>
                                <input name="fast_name" value="{{ $edit->fast_name }}" type="text" class="form-control"
                                    autofocus>
                            </div>
                            <div class="form-group">
                                <label>Email <small class="text-danger">( You have no permission to change it
                                        )</small></label>
                                <input name="email" value="{{ $edit->email }}" type="text" class="form-control"
                                    readonly autofocus>
                            </div>
                            <div class="form-group">
                                <label>User name <small class="text-danger">( You have no permission to change it
                                        )</small></label>
                                <input name="username" value="{{ $edit->username }}" type="text" class="form-control"
                                    readonly autofocus>
                            </div>
                            <div class="form-group">
                                <label>Cell</label>
                                <input name="cell" value="{{ $edit->cell }}" type="text" class="form-control"
                                    autofocus>
                            </div>
                            <div class="form-group order">
                                <select class="form-control" name="role_id" id="">
                                    <option value="">Select</option>
                                    @foreach ($roles as $role)
                                        <option @if ($role->id == $edit->role_id) selected @endif
                                            value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-right">
                                <a class="btn btn-info" href="{{ route('admin-user.index') }}">Back</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
