@extends('admin.layouts.app')

@section('main')

@php
    $admin = Auth::guard('admin')->user();
@endphp

<div class="row">
    <div class="col-md-12">

        <div class="profile-header">
            <div class="row align-items-center">
                <div class="col-auto profile-image">
                    <a href="#">
                        @if ($admin->photo == 'avatar.png')
                            <img class="rounded-circle" alt="User Image" src="{{ asset('storage/admins/' . $admin->avatarFile()) }}">
                        @else
                            <img style="width: 120px; height: 120px; object-fit: cover"
                                 class="rounded-circle"
                                 alt="User Image"
                                 src="{{ asset('storage/admins/' . $admin->photo) }}">
                        @endif
                    </a>
                </div>

                <div class="col ml-md-n2 profile-user-info">
                    <h4 class="user-name mb-0">{{ $admin->first_name . ' ' . $admin->last_name }}</h4>
                    <h6 class="text-muted">{{ $admin->email }}</h6>

                    @if ($admin->state && $admin->country)
                        <div class="user-Location text-uppercase">
                            <i class="fa fa-map-marker"></i> {{ $admin->state }}, {{ $admin->country }}
                        </div>
                    @endif

                    <div class="about-text">{{ $admin->uniname }}</div>
                </div>
            </div>
        </div>

        <div class="profile-menu">
            <ul class="nav nav-tabs nav-tabs-solid">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#per_details_tab">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#password_tab">Password</a>
                </li>
            </ul>
        </div>

        <div class="tab-content profile-tab-cont">

            <div class="tab-pane fade show active" id="per_details_tab">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">

                                <h5 class="card-title d-flex justify-content-between">
                                    <span>Personal Details</span>

                                    @if ($admin->role_id != 3)
                                        <a class="edit-link" data-toggle="modal" href="#edit_personal_details">
                                            <i class="fa fa-edit mr-1"></i>Edit
                                        </a>
                                    @endif
                                </h5>

                                @include('validate')

                                <div class="row">
                                    <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Name</p>
                                    <p class="col-sm-10">{{ $admin->first_name . ' ' . $admin->last_name }}</p>
                                </div>

                                @if ($admin->dob)
                                    <div class="row">
                                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Date of Birth</p>
                                        <p class="col-sm-10">{{ date('j F Y', strtotime($admin->dob)) }}</p>
                                    </div>
                                @endif

                                <div class="row">
                                    <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Email ID</p>
                                    <p class="col-sm-10">{{ $admin->email }}</p>
                                </div>

                                <div class="row">
                                    <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Mobile</p>
                                    <p class="col-sm-10">{{ $admin->cell }}</p>
                                </div>

                                <div class="row">
                                    <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Gender</p>
                                    <p class="col-sm-10">{{ $admin->gender ?? '-' }}</p>
                                </div>

                                @if ($admin->address && $admin->city && $admin->state && $admin->zip && $admin->country)
                                    <div class="row">
                                        <p class="col-sm-2 text-muted text-sm-right mb-0">Address</p>
                                        <p class="col-sm-10 mb-0">
                                            {{ $admin->address }},<br>
                                            {{ $admin->city }},<br>
                                            {{ $admin->state }} - {{ $admin->zip }},<br>
                                            {{ $admin->country }}.
                                        </p>
                                    </div>
                                @endif

                                @if ($admin->role_id == 3)
                                    <div class="row mt-3">
                                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">
                                            NID / Passport / Birth Certificate
                                        </p>
                                        <p class="col-sm-10">{{ $admin->nid }}</p>
                                    </div>

                                    <div class="row">
                                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Student ID</p>
                                        <p class="col-sm-10">{{ $admin->stuid }}</p>
                                    </div>

                                    @if ($admin->nidphotofront)
                                        <div class="row">
                                            <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">
                                                NID / Passport / Birth Certificate
                                            </p>
                                            <img class="col-sm-2 my-2"
                                                 alt="NID / Passport / Birth Certificate"
                                                 src="{{ asset('storage/studentNidFront/' . $admin->nidphotofront) }}">
                                        </div>
                                    @endif

                                    @if ($admin->stuphotofront)
                                        <div class="row">
                                            <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Student ID</p>
                                            <img class="col-sm-2 my-2"
                                                 alt="Student ID"
                                                 src="{{ asset('storage/studentSidFront/' . $admin->stuphotofront) }}">
                                        </div>
                                    @endif
                                @endif

                            </div>
                        </div>

                        <div class="modal fade" id="edit_personal_details" aria-hidden="true" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">Personal Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <form action="{{ route('admin.profile.update') }}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <div class="row form-row">

                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>First Name</label>
                                                        <input name="first_name"
                                                               type="text"
                                                               class="form-control"
                                                               value="{{ $admin->first_name }}"
                                                               required>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Last Name</label>
                                                        <input name="last_name"
                                                               type="text"
                                                               class="form-control"
                                                               value="{{ $admin->last_name }}"
                                                               required>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Date of Birth</label>
                                                        <div class="cal-icon">
                                                            <input name="dob"
                                                                   type="date"
                                                                   class="form-control"
                                                                   value="{{ $admin->dob }}"
                                                                   required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-7">
                                                    <div class="form-group">
                                                        <label>Email ID</label>
                                                        <input name="email"
                                                               type="email"
                                                               class="form-control"
                                                               value="{{ $admin->email }}"
                                                               required
                                                               readonly>
                                                        <small class="text-danger">
                                                            ( You have no permission to change it. )
                                                        </small>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-5">
                                                    <div class="form-group">
                                                        <label>Mobile</label>
                                                        <input name="cell"
                                                               type="text"
                                                               value="{{ $admin->cell }}"
                                                               class="form-control"
                                                               required>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Gender</label>
                                                        <select name="gender" class="form-control" required>
                                                            <option value="">Select gender</option>
                                                            <option value="Male" {{ $admin->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                            <option value="Female" {{ $admin->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Upload Image</label><br>
                                                        <input type="file" name="new_photo" accept="image/*">
                                                        <input type="hidden" value="{{ $admin->photo }}" name="old_photo">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <h5 class="form-title"><span>Address</span></h5>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input name="address"
                                                               type="text"
                                                               class="form-control"
                                                               value="{{ $admin->address }}"
                                                               required>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>City</label>
                                                        <input name="city"
                                                               type="text"
                                                               class="form-control"
                                                               value="{{ $admin->city }}"
                                                               required>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>State</label>
                                                        <input name="state"
                                                               type="text"
                                                               class="form-control"
                                                               value="{{ $admin->state }}"
                                                               required>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Zip Code</label>
                                                        <input name="zip"
                                                               type="text"
                                                               class="form-control"
                                                               value="{{ $admin->zip }}"
                                                               required>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Country</label>
                                                        <input name="country"
                                                               type="text"
                                                               class="form-control"
                                                               value="{{ $admin->country }}"
                                                               required>
                                                    </div>
                                                </div>

                                            </div>

                                            <button type="submit" class="btn btn-primary btn-block">
                                                Save Changes
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div id="password_tab" class="tab-pane fade">
                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title">Change Password</h5>

                        <div class="row">
                            <div class="col-md-10 col-lg-6">

                                @include('validate')

                                <form action="{{ route('admin.password.update') }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label>Old Password</label>
                                        <input name="old_password"
                                               type="password"
                                               class="form-control"
                                               required>
                                    </div>

                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input name="password"
                                               type="password"
                                               class="form-control"
                                               required>
                                    </div>

                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input name="password_confirmation"
                                               type="password"
                                               class="form-control"
                                               required>
                                    </div>

                                    <button class="btn btn-primary" type="submit">
                                        Save Changes
                                    </button>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
