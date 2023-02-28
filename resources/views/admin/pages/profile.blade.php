@extends('admin.layouts.app')
@section('main')

<div class="row">
    <div class="col-md-12">
        <div class="profile-header">
            <div class="row align-items-center">
                <div class="col-auto profile-image">
                    @if (Auth::guard('admin')->user()->photo == 'avatar.png')
                    <a href="#">
                        <img class="rounded-circle" alt="User Image" src="{{ url('storage/admins/avatar.png') }}">
                    </a>
                    @else
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <img style="width: 120px; height: 120px; object-fit: cover" class="rounded-circle"
                            alt="User Image" src="{{ url('storage/admins/' . Auth::guard('admin')->user()->photo)}}">
                    </a>
                    @endif

                </div>
                <div class="col ml-md-n2 profile-user-info">
                    <h4 class="user-name mb-0">{{Auth::guard('admin')->user()->fast_name .' '.
                        Auth::guard('admin')->user()->last_name}}</h4>
                    <h6 class="text-muted">{{Auth::guard('admin')->user()->email}}</h6>
                    @if (Auth::guard('admin')->user()->state != null && Auth::guard('admin')->user()->country != null)
                    <div class="user-Location"><i class="fa fa-map-marker"></i> {{Auth::guard('admin')->user()->state}}
                        , {{Auth::guard('admin')->user()->country}}</div>
                    @else

                    @endif
                    <div class="about-text">{{Auth::guard('admin')->user()->bio}}</div>
                </div>
                {{-- <div class="col-auto profile-btn">

                    <a href="#" class="btn btn-primary">
                        Edit
                    </a>
                </div> --}}
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

            <!-- Personal Details Tab -->
            <div class="tab-pane fade show active" id="per_details_tab">

                <!-- Personal Details -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title d-flex justify-content-between">
                                    <span>Personal Details</span>
                                    <a class="edit-link" data-toggle="modal" href="#edit_personal_details"><i
                                            class="fa fa-edit mr-1"></i>Edit</a>
                                </h5>
                                @include('validate')
                                <div class="row">
                                    <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Name</p>
                                    <p class="col-sm-10">{{Auth::guard('admin')->user()->fast_name .' '.
                                        Auth::guard('admin')->user()->last_name}}</p>
                                </div>
                                @if (Auth::guard('admin')->user()->dob != null)
                                <div class="row">
                                    <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Date of Birth</p>
                                    <p class="col-sm-10">{{Auth::guard('admin')->user()->dob}}</p>
                                </div>
                                @else

                                @endif
                                <div class="row">
                                    <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Email ID</p>
                                    <p class="col-sm-10">{{Auth::guard('admin')->user()->email}}</p>
                                </div>
                                <div class="row">
                                    <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Mobile</p>
                                    <p class="col-sm-10">{{Auth::guard('admin')->user()->cell}}</p>
                                </div>
                                <div class="row">
                                    @if (Auth::guard('admin')->user()->address != null &&
                                    Auth::guard('admin')->user()->city != null &&
                                    Auth::guard('admin')->user()->state != null &&
                                    Auth::guard('admin')->user()->zip != null &&
                                    Auth::guard('admin')->user()->country != null)
                                    <p class="col-sm-2 text-muted text-sm-right mb-0">Address</p>
                                    <p class="col-sm-10 mb-0">{{Auth::guard('admin')->user()->address}},<br>
                                        {{Auth::guard('admin')->user()->city}},<br>
                                        {{Auth::guard('admin')->user()->state}} -
                                        {{Auth::guard('admin')->user()->zip}},<br>
                                        {{Auth::guard('admin')->user()->country}}.</p>
                                    @else

                                    @endif

                                </div>
                            </div>
                        </div>

                        <!-- Edit Details Modal -->
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
                                        <form action="{{ route('admin.profile.update') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row form-row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>First Name</label>
                                                        <input name="fast_name" type="text" class="form-control"
                                                            value="{{Auth::guard('admin')->user()->fast_name}}"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Last Name</label>
                                                        <input name="last_name" type="text" class="form-control"
                                                            value="{{Auth::guard('admin')->user()->last_name}}"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Bio</label>
                                                        <input name="bio" type="text" class="form-control"
                                                            value="{{Auth::guard('admin')->user()->bio}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Date of Birth</label>
                                                        <div class="cal-icon">
                                                            <input name="dob" type="date" class="form-control"
                                                                value="{{Auth::guard('admin')->user()->dob}}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-7">
                                                    <div class="form-group">
                                                        <label>Email ID</label>
                                                        <input name="email" type="email" class="form-control"
                                                            value="{{Auth::guard('admin')->user()->email}}" required readonly>
                                                            <small class="text-danger">( You have no permission to change it. )</small>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-5">
                                                    <div class="form-group">
                                                        <label>Mobile</label>
                                                        <input name="cell" type="text"
                                                            value="{{Auth::guard('admin')->user()->cell}}"
                                                            class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Upload Image</label><br>
                                                    <input type="file" name="new_photo">
                                                    <input type="hidden" value="{{Auth::guard('admin')->user()->photo}}"
                                                        name="old_photo">

                                                </div>
                                                <div class="col-12">
                                                    <h5 class="form-title"><span>Address</span></h5>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input name="address" type="text" class="form-control"
                                                            value="{{Auth::guard('admin')->user()->address}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>City</label>
                                                        <input name="city" type="text" class="form-control"
                                                            value="{{Auth::guard('admin')->user()->city}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>State</label>
                                                        <input name="state" type="text" class="form-control"
                                                            value="{{Auth::guard('admin')->user()->state}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Zip Code</label>
                                                        <input name="zip" type="text" class="form-control"
                                                            value="{{Auth::guard('admin')->user()->zip}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Country</label>
                                                        <input name="country" type="text" class="form-control"
                                                            value="{{Auth::guard('admin')->user()->country}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block">Save
                                                Changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Edit Details Modal -->

                    </div>


                </div>
                <!-- /Personal Details -->

            </div>
            <!-- /Personal Details Tab -->

            <!-- Change Password Tab -->
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
                                        <input name="old_password" type="password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input name="password" type="password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input name="password_confirmation" type="password" class="form-control">
                                    </div>
                                    <button class="btn btn-primary" type="submit">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Change Password Tab -->

        </div>
    </div>
</div>
@endsection