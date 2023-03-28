<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:53 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>{{ $theme->title }} - Register</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('storage/logo/' . $theme->favicon) }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/font-awesome.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">

    <!--[if lt IE 9]>
   <script src="assets/js/html5shiv.min.js"></script>
   <script src="assets/js/respond.min.js"></script>
  <![endif]-->
</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">

                    <div class="login-left" style="padding: 0px !important;
                    width: 5px !important;">
                    </div>
                    <div class="login-right" style="width: 100% !important;">
                        <div class="login-right-wrap">
                            <div class="text-center">
                                <img style="max-width: 15%" class="img-fluid" src="{{ url('storage/logo/' . $theme->logo) }}"
                                alt="{{ $theme->title }}">
                            </div>
                            <hr>
                            <h1>Register</h1>
                            <p class="account-subtitle">Access to our dashboard</p>
                            @include('validate')
                            <!-- Form -->
                            <form action="{{ route('student-register.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="d-flex">
                                        <input class="form-control mr-2" name="first_name" type="text"
                                            value="{{ old('first_name') }}" placeholder="First Name">
                                        <input class="form-control" name="last_name" value="{{ old('last_name') }}"
                                            type="text" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="email" value="{{ old('email') }}"
                                        type="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="cell" value="{{ old('cell') }}"
                                        type="text" placeholder="Phone">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="address" value="{{ old('address') }}"
                                        type="text" placeholder="Address">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="city" value="{{ old('city') }}"
                                        type="text" placeholder="City">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="state" value="{{ old('state') }}"
                                        type="text" placeholder="State">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="country" value="{{ old('country') }}"
                                        type="text" placeholder="Country">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="zip" value="{{ old('zip') }}"
                                        type="text" placeholder="Zip">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="uniname" value="{{ old('uniname') }}"
                                        type="text" placeholder="University Name">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="nid" value="{{ old('nid') }}"
                                        type="text" placeholder="NID Number">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="stuid" type="text"
                                        value="{{ old('stuid') }}" placeholder="Student ID Number">
                                </div>
                                <div class="form-group">
                                    <label for="">Birth Date</label>
                                    <input class="form-control" name="dob" value="{{ old('dob') }}"
                                        type="date" placeholder="Date Of Birth">
                                </div>
                                <div class="form-group">
                                    <hr>
                                    <label>Your Photo</label><br>
                                    <img style="max-width: 25%;" id="profile-photo-preview" src=""
                                        alt="">
                                    <br>
                                    <input class="d-none" id="profile-photo" name="photo" type="file"
                                        class="form-control">
                                    <label for="profile-photo"><img style="cursor: pointer;width: 50px !important"  class="w-25"
                                            src="{{ url('admin\assets\img\upload.gif') }}" alt=""></label>
                                </div>

                                <div class="form-group">
                                    <hr>
                                    <label>NID Front</label><br>
                                    <img style="max-width: 25%;" id="nidf-photo-preview" src=""
                                        alt="">
                                    <br>
                                    <input class="d-none" id="nidf-photo" name="nidphotofront" type="file"
                                        class="form-control">
                                    <label for="nidf-photo"><img style="cursor: pointer;width: 50px !important" class="w-25"
                                            src="{{ url('admin\assets\img\upload.gif') }}" alt=""></label>

                                    <hr>
                                    <label>NID Back</label><br>
                                    <img style="max-width: 25%;" id="nidb-photo-preview" src=""
                                        alt="">
                                    <br>
                                    <input class="d-none" id="nidb-photo" name="nidphotoback" type="file"
                                        class="form-control">
                                    <label for="nidb-photo"><img style="cursor: pointer;width: 50px !important" class="w-25"
                                            src="{{ url('admin\assets\img\upload.gif') }}" alt=""></label>
                                    <hr>


                                </div>
                                <div class="form-group">
                                    <hr>
                                    <label>Student ID Front</label><br>
                                    <img style="max-width: 25%;" id="sidf-photo-preview" src=""
                                        alt="">
                                    <br>
                                    <input class="d-none" id="sidf-photo" name="stuphotofront" type="file"
                                        class="form-control">
                                    <label for="sidf-photo"><img style="cursor: pointer;width: 50px !important" class="w-25"
                                            src="{{ url('admin\assets\img\upload.gif') }}" alt=""></label>

                                    <hr>
                                    <label>Student ID Back</label><br>
                                    <img style="max-width: 25%;" id="sidb-photo-preview" src=""
                                        alt="">
                                    <br>
                                    <input class="d-none" id="sidb-photo" name="stuphotoback" type="file"
                                        class="form-control">
                                    <label for="sidb-photo"><img style="cursor: pointer;width: 50px !important" class="w-25"
                                            src="{{ url('admin\assets\img\upload.gif') }}" alt=""></label>
                                    <hr>


                                </div>

                                <div class="form-group mb-0">
                                    <button class="btn btn-primary btn-block" type="submit">Register</button>
                                </div>
                            </form>
                            <!-- /Form -->

                            <div class="login-or">
                                <span class="or-line"></span>
                                <span class="span-or">or</span>
                            </div>

                            <div class="text-center dont-have">Already have an account? <a
                                    href="{{ route('admin.login.page') }}">Login</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('admin/assets/js/jquery-3.2.1.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('admin/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/bootstrap.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('admin/assets/js/script.js') }}"></script>
    <script src="{{ asset('custom/admin.js') }}"></script>

</body>

<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:53 GMT -->

</html>
