<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:53 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Doccure - Forgot Password</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin/assets/img/favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/font-awesome.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">

    <!--[if lt IE 9]>
			<script src="admin/assets/js/html5shiv.min.js"></script>
			<script src="admin/assets/js/respond.min.js"></script>
		<![endif]-->
</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-left">
                        <img class="img-fluid" src="{{ asset('admin/assets/img/logo-white.png') }}" alt="Logo">
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Forgot Password?</h1>
                            <p class="account-subtitle">Enter your new password</p>

                            <!-- Forgot Password Form -->
                            <form action="{{ route('reset.password') }}" method="POST">
                                @csrf
                                @include('validate')
                                <div class="form-group form-focus">
                                    <input name="email" value="{{$email}}" type="hidden" class="form-control floating">
                                    <input name="password" type="password" class="form-control floating">
                                    <label class="focus-label">Password</label>
                                </div>
                                <div class="form-group form-focus">
                                    <input name="password_confirmation" type="password" class="form-control floating">
                                    <label class="focus-label">Confirm Password</label>
                                </div>
                                <div class="text-right">
                                    <a class="forgot-link" href="{{ route('admin.login.page') }}">Remember your
                                        password?</a>
                                </div>
                                <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Reset
                                    Password</button>
                            </form>
                            <!-- /Forgot Password Form -->

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

</body>

<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:53 GMT -->

</html>