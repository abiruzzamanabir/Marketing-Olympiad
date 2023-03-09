@extends('admin.layouts.app')
@section('main')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Student</h4>
                    <div>
                        <a class="btn btn-sm btn-warning" href="{{ route('student.block') }}">Ban Student <i
                                class="fa fa-ban ml-2" aria-hidden="true"></i></a>
                        <a class="btn btn-sm btn-danger" href="{{ route('student.trash') }}">Trash Student <i
                                class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>
                    </div>
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
                                            <td>{{ $user->first_name . ' ' . $user->last_name ?? '' }}</td>
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
                                                    <span class="badge badge-success">Verified</span>
                                                    @if (Auth::guard('admin')->user()->role->name == 'Super Admin')
                                                        <a class="text-danger"
                                                            href="{{ route('student.status.update', $user->id) }}"><i
                                                                class="fa fa-times" aria-hidden="true"></i></a>
                                                    @else
                                                    @endif
                                                @else
                                                    <span class="badge badge-danger">Unverified</span>
                                                    @if (Auth::guard('admin')->user()->role->name == 'Super Admin')
                                                        <a class="text-success"
                                                            href="{{ route('student.status.update', $user->id) }}"><i
                                                                class="fa fa-check" aria-hidden="true"></i></a>
                                                    @else
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                {{-- <a class="btn btn-sm btn-info" href=""><i class="fa fa-eye"
                                            aria-hidden="true"></i></a> --}}
                                                <a class="btn btn-sm btn-primary" data-toggle="modal"
                                                    href="#view_student_details{{ $user->id }}"
                                                    data-id="{{ $user->id }}"><i class="fa fa-eye mr-1"></i></a>
                                                <a class="btn btn-sm btn-warning"
                                                    href="{{ route('student.ban', $user->id) }}"><i class="fa fa-ban"
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
        {{-- <div class="col-md-4">
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
                                <input name="first_name" type="text" value="{{ old('first_name') }}" class="form-control"
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
                                <input name="first_name" value="{{ $edit->first_name }}" type="text" class="form-control"
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
        </div> --}}
    </div>
    @forelse ($all_admin as $user)
        <!-- Edit Details Modal -->
        <div class="modal fade" id="view_student_details{{ $user->id }}" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Information Of <span
                                class="text-bold text-uppercase text-primary">{{ $user->first_name ?? '' }}
                                {{ $user->last_name ?? '' }}</span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="text-center mt-2">
                        <img style="width: 120px; height: 120px; object-fit: cover" class="rounded-circle" alt="User Image"
                            src="{{ url('storage/admins/' . $user->photo) }}">
                    </div>
                    <div class="modal-body">
                        <form action="" method="">
                            <div class="row form-row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input name="first_name" type="text" class="form-control"
                                            value="{{ $user->first_name ?? '' }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input name="last_name" type="text" class="form-control"
                                            value="{{ $user->last_name ?? '' }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Bio</label>
                                        <input name="bio" type="text" class="form-control"
                                            value="{{ $user->bio ?? '' }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <div class="cal-icon">
                                            <input name="dob" type="date" class="form-control"
                                                value="{{ $user->dob ?? '' }}" required readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <div class="form-group">
                                        <label>Email ID</label>
                                        <input name="email" type="email" class="form-control"
                                            value="{{ $user->email ?? '' }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-5">
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <input name="cell" type="text" value="{{ $user->cell ?? '' }}"
                                            class="form-control" required readonly>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>NID (<span class="text-danger">{{ $user->nid ?? '' }}</span>)</label>
                                        @if ($user->status)
                                            @if (Auth::guard('admin')->user()->role->name == 'Super Admin')
                                                <a class="text-danger"
                                                    href="{{ route('student.status.update', $user->id) }}"><span
                                                        class="badge badge-success">Verified</span></a>
                                            @else
                                            @endif
                                        @else
                                            @if (Auth::guard('admin')->user()->role->name == 'Super Admin')
                                                <a class="text-success"
                                                    href="{{ route('student.status.update', $user->id) }}"><span
                                                        class="badge badge-danger">Unverified</span></a>
                                            @else
                                            @endif
                                        @endif
                                        <br>
                                        <div class="text-center">
                                            <img class="col-sm-10 my-2 border border-dark p-2 bg-dark shadow-sm"
                                                alt="User Image"
                                                src="{{ url('storage/studentNidFront/' . $user->nidphotofront) }}">
                                            <img class="col-sm-10 my-2 border border-dark p-2 bg-dark shadow-sm"
                                                alt="User Image"
                                                src="{{ url('storage/studentNidBack/' . $user->nidphotoback) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Student ID (<span
                                                class="text-danger">{{ $user->stuid ?? '' }}</span>)</label>
                                        @if ($user->status)
                                            @if (Auth::guard('admin')->user()->role->name == 'Super Admin')
                                                <a class="text-danger"
                                                    href="{{ route('student.status.update', $user->id) }}"><span
                                                        class="badge badge-success">Verified</span></a>
                                            @else
                                            @endif
                                        @else
                                            @if (Auth::guard('admin')->user()->role->name == 'Super Admin')
                                                <a class="text-success"
                                                    href="{{ route('student.status.update', $user->id) }}"><span
                                                        class="badge badge-danger">Unverified</span></a>
                                            @else
                                            @endif
                                        @endif
                                        <br>
                                        <div class="text-center">
                                            <img class="col-sm-10 my-2 border border-dark p-2 bg-dark shadow-sm"
                                                alt="User Image"
                                                src="{{ url('storage/studentSidFront/' . $user->stuphotofront) }}">
                                            <img class="col-sm-10 my-2 border border-dark p-2 bg-dark shadow-sm"
                                                alt="User Image"
                                                src="{{ url('storage/studentSidBack/' . $user->stuphotoback) }}">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <h5 class="form-title"><span>Address</span></h5>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input name="address" type="text" class="form-control"
                                            value="{{ $user->address ?? '' }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input name="city" type="text" class="form-control"
                                            value="{{ $user->city ?? '' }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>State</label>
                                        <input name="state" type="text" class="form-control"
                                            value="{{ $user->state ?? '' }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Zip Code</label>
                                        <input name="zip" type="text" class="form-control"
                                            value="{{ $user->zip ?? '' }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <input name="country" type="text" class="form-control"
                                            value="{{ $user->country ?? '' }}" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a class="btn btn-sm btn-warning" href="{{ route('student.ban', $user->id) }}"><i
                                        class="fa fa-ban" aria-hidden="true"></i></a>
                                <a class="btn btn-sm btn-danger" href="{{ route('admin.trash.update', $user->id) }}"><i
                                        class="fa fa-trash" aria-hidden="true"></i></a>
                            </div>
                            {{-- <button type="submit" class="btn btn-primary btn-block">Save
                            Changes</button> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Details Modal -->
    @endforeach
@endsection
