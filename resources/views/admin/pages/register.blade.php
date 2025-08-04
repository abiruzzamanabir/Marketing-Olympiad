@php
    use Carbon\Carbon;
    use App\Models\ExamControl;
    $exam = ExamControl::findOrFail(1);
    $examtime = $exam->start_date_time;
    $exam_carbon = Carbon::parse($examtime);

    $exam_date = $exam_carbon->format('d'); // Output: 13
    $exam_month = $exam_carbon->format('m'); // Output: 04
    $exam_year = $exam_carbon->format('Y'); // Output: 2023

    // echo "Date: $exam_date, Month: $exam_month, Year: $exam_year";
    $currentdatetime = now();
    $carbon = Carbon::parse($currentdatetime);

    $date = $carbon->format('d'); // Output: 13
    $month = $carbon->format('m'); // Output: 04
    $year = $carbon->format('Y'); // Output: 2023

    $closed = Carbon::parse($exam->start_date_time);

    // echo "Date: $date, Month: $month, Year: $year";

@endphp

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:53 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>{{ $theme->title }} - Register</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/logo/' . $theme->favicon) }}">

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

  <style>
    @media only screen and (max-width: 767px){
        .registration-close{
            font-size: 35px !important;
        }
    }
  </style>
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
                            @if (Carbon::now() >= $closed)
<<<<<<< HEAD
                            <div class="text-center">
                                <a href="{{ route('home.page') }}"><img style="max-width: 35%" class="img-fluid"
                                        src="{{ asset('storage/logo/' . $theme->logo) }}"
                                        alt="{{ $theme->title }}"></a>
                            </div>
                                <h1 class="text-danger registration-close" style="font-size: 50px">Registration window is closed!</h1>
=======
                                <h1>Registration window is closed!</h1>
>>>>>>> e953e31f70933353be58a4715f9c7781ff93376d
                            @else
                                <div class="text-center">
                                    <a href="{{ route('home.page') }}"><img style="max-width: 15%" class="img-fluid"
                                            src="{{ asset('storage/logo/' . $theme->logo) }}"
                                            alt="{{ $theme->title }}"></a>
                                </div>
                                <hr>
                                {{-- <h1>Register</h1> --}}
                                {{-- <p class="account-subtitle">Access to our dashboard</p> --}}
                                @include('validate')
                                <!-- Form -->
                                <form action="{{ route('student-register.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <div class="d-flex">
                                            <input
                                                class="form-control mr-2 {{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                                name="first_name" type="text" value="{{ old('first_name') }}"
<<<<<<< HEAD
                                                placeholder="First Name (Required)">
                                            <input
                                                class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                                name="last_name" value="{{ old('last_name') }}" type="text"
                                                placeholder="Last Name (Required)">
=======
                                                placeholder="First Name">
                                            <input
                                                class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                                name="last_name" value="{{ old('last_name') }}" type="text"
                                                placeholder="Last Name">
>>>>>>> e953e31f70933353be58a4715f9c7781ff93376d
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            name="email" value="{{ old('email') }}" type="email"
<<<<<<< HEAD
                                            placeholder="Email (Required)">
=======
                                            placeholder="Email">
>>>>>>> e953e31f70933353be58a4715f9c7781ff93376d
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control {{ $errors->has('cell') ? ' is-invalid' : '' }}"
                                            name="cell" value="{{ old('cell') }}" type="text"
<<<<<<< HEAD
                                            placeholder="Phone (Required)">
=======
                                            placeholder="Phone">
>>>>>>> e953e31f70933353be58a4715f9c7781ff93376d
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}"
                                            name="address" value="{{ old('address') }}" type="text"
<<<<<<< HEAD
                                            placeholder="Address (Required)">
=======
                                            placeholder="Address">
>>>>>>> e953e31f70933353be58a4715f9c7781ff93376d
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control {{ $errors->has('city') ? ' is-invalid' : '' }}"
                                            name="city" value="{{ old('city') }}" type="text"
<<<<<<< HEAD
                                            placeholder="City (Required)">
=======
                                            placeholder="City">
>>>>>>> e953e31f70933353be58a4715f9c7781ff93376d
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control {{ $errors->has('state') ? ' is-invalid' : '' }}"
                                            name="state" value="{{ old('state') }}" type="text"
<<<<<<< HEAD
                                            placeholder="State (Required)">
=======
                                            placeholder="State">
>>>>>>> e953e31f70933353be58a4715f9c7781ff93376d
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control {{ $errors->has('country') ? ' is-invalid' : '' }}"
                                            name="country" value="{{ old('country') }}" type="text"
<<<<<<< HEAD
                                            placeholder="Country (Required)">
=======
                                            placeholder="Country">
>>>>>>> e953e31f70933353be58a4715f9c7781ff93376d
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control {{ $errors->has('zip') ? ' is-invalid' : '' }}"
                                            name="zip" value="{{ old('zip') }}" type="text"
<<<<<<< HEAD
                                            placeholder="Zip (Required)">
=======
                                            placeholder="Zip">
>>>>>>> e953e31f70933353be58a4715f9c7781ff93376d
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control {{ $errors->has('uniname') ? ' is-invalid' : '' }}"
                                            name="uniname" value="{{ old('uniname') }}" type="text"
<<<<<<< HEAD
                                            placeholder="University / Institute Name (Required)">
=======
                                            placeholder="University / Institute Name">
>>>>>>> e953e31f70933353be58a4715f9c7781ff93376d
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control {{ $errors->has('nid') ? ' is-invalid' : '' }}"
                                            name="nid" value="{{ old('nid') }}" type="text"
<<<<<<< HEAD
                                            placeholder="NID / Passport / Birth Certificate Number (Required)">
=======
                                            placeholder="NID / Passport / Birth Certificate Number">
>>>>>>> e953e31f70933353be58a4715f9c7781ff93376d
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control {{ $errors->has('stuid') ? ' is-invalid' : '' }}"
                                            name="stuid" type="text" value="{{ old('stuid') }}"
<<<<<<< HEAD
                                            placeholder="Student ID Number (Required)">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Birth Date <span class="text-danger">*</span></label>
=======
                                            placeholder="Student ID Number">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Birth Date</label>
>>>>>>> e953e31f70933353be58a4715f9c7781ff93376d
                                        <input class="form-control {{ $errors->has('dob') ? ' is-invalid' : '' }}"
                                            name="dob" value="{{ old('dob') }}" type="date"
                                            placeholder="Date Of Birth">
                                    </div>
                                    <div class="form-group">
                                        <hr>
                                        <label>Your Photo <span class="text-danger">*</span></label><br>
                                        <p></p>
                                        <img style="max-width: 25%;" id="profile-photo-preview" src=""
                                            alt="">
                                        <br>
                                        <input class="d-none" id="profile-photo" name="photo" type="file"
                                            class="form-control">
                                        <label for="profile-photo"><img style="cursor: pointer;width: 50px !important"
                                                class="w-25" src="{{ asset('admin\assets\img\upload.gif') }}"
                                                alt=""></label>
                                        <br>
                                        @if ($errors->has('photo'))
                                            <span class="text-danger"> {{ $errors->first('photo') }} </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <hr>
                                        <label>NID / Passport / Birth Certificate <span class="text-danger">*</span></label><br>
                                        <img style="max-width: 25%;" id="nidf-photo-preview" src=""
                                            alt="">
                                        <br>
                                        <input class="d-none" id="nidf-photo" name="nidphotofront" type="file"
                                            class="form-control">
                                        <label for="nidf-photo"><img style="cursor: pointer;width: 50px !important"
                                                class="w-25" src="{{ asset('admin\assets\img\upload.gif') }}"
                                                alt=""></label>
                                        <br>
                                        @if ($errors->has('nidphotofront'))
                                            <span class="text-danger"> {{ $errors->first('nidphotofront') }} </span>
                                        @endif

                                        <hr>
                                        {{-- <label class="">NID / Passport / Birth Certificate Back <span class="text-danger">*</span></label><br>
                                        <img style="max-width: 25%;" id="nidb-photo-preview" src=""
                                            alt="">
                                        <br>
                                        <input class="d-none" id="nidb-photo" name="nidphotoback" type="file"
                                            class="form-control">
                                        <label for="nidb-photo"><img style="cursor: pointer;width: 50px !important"
                                                class="w-25" src="{{ asset('admin\assets\img\upload.gif') }}"
                                                alt=""></label>
                                        <br>
                                        @if ($errors->has('nidphotoback'))
                                            <span class="text-danger"> {{ $errors->first('nidphotoback') }} </span>
                                        @endif
                                        <hr> --}}


                                    </div>
                                    <div class="form-group">
                                        <hr>
                                        <label>Student ID <span>(Optional)</span></label><br>
                                        <img style="max-width: 25%;" id="sidf-photo-preview" src=""
                                            alt="">
                                        <br>
                                        <input class="d-none" id="sidf-photo" name="stuphotofront" type="file"
                                            class="form-control">
                                        <label for="sidf-photo"><img style="cursor: pointer;width: 50px !important"
                                                class="w-25" src="{{ asset('admin\assets\img\upload.gif') }}"
                                                alt=""></label>
                                        <br>
                                        @if ($errors->has('stuphotofront'))
                                            <span class="text-danger"> {{ $errors->first('stuphotofront') }} </span>
                                        @endif

                                        <hr>
<<<<<<< HEAD
                                        {{-- <label>Student ID Back <span>(Optional)</span></label><br>
=======
                                        <label>Student ID Back</label><br>
>>>>>>> e953e31f70933353be58a4715f9c7781ff93376d
                                        <img style="max-width: 25%;" id="sidb-photo-preview" src=""
                                            alt="">
                                        <br>
                                        <input class="d-none" id="sidb-photo" name="stuphotoback" type="file"
                                            class="form-control">
                                        <label class="" for="sidb-photo"><img
                                                style="cursor: pointer;width: 50px !important" class="w-25"
                                                src="{{ asset('admin\assets\img\upload.gif') }}"
                                                alt=""></label>
                                        <br>
                                        @if ($errors->has('stuphotoback'))
                                            <span class="text-danger"> {{ $errors->first('stuphotoback') }} </span>
                                        @endif
                                        <hr> --}}
                                    </div>
                                    <div class="form-check my-4">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="defaultCheck1" required>
                                        <label class="form-check-label" for="defaultCheck1">
                                            <span class="text-uppercase">I agree to <a href="{{ route('tc.page') }}"
                                                    target="_blank">terms and conditions</a></span>
                                        </label>
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
                            @endif
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
