<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>{{ $theme->title }} - Login</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/logo/' . $theme->favicon) }}">

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

    <style>
        .login-right {
            background: #f8fafc;
        }

        .login-right-wrap {
            max-width: 430px;
            margin: 0 auto;
            padding: 44px 38px;
            background: #ffffff;
            border-radius: 18px;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
        }

        .login-form-header {
            margin-bottom: 28px;
        }

        .login-form-header h1 {
            margin-bottom: 8px;
            font-size: 30px;
            font-weight: 700;
            color: #111827;
        }

        .login-form-header p {
            margin-bottom: 0;
            color: #6b7280;
            font-size: 15px;
            line-height: 1.6;
        }

        .login-right-wrap label {
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .login-right-wrap .form-control {
            min-height: 48px;
            border-radius: 10px;
            border: 1px solid #d8dee9;
            padding: 10px 14px;
            font-size: 15px;
        }

        .login-right-wrap .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.18rem rgba(13, 110, 253, 0.12);
        }

        .login-right-wrap .btn-primary {
            min-height: 48px;
            border-radius: 10px;
            font-weight: 700;
            letter-spacing: 0.2px;
        }

        .forgotpass {
            margin-top: 16px;
        }

        .forgotpass a,
        .dont-have a {
            font-weight: 600;
        }

        .login-or {
            margin: 26px 0 20px;
        }

        .dont-have {
            color: #6b7280;
            font-size: 15px;
        }

        @media only screen and (max-width: 767px) {
            .login-right-wrap {
                padding: 32px 22px;
                border-radius: 14px;
                box-shadow: none;
            }

            .login-form-header h1 {
                font-size: 26px;
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
                    <div class="login-left"
                        style="background-image: url('{{ asset('admin/assets/img/MO1.png') }}');background-size:cover;background-repeat:no-repeat;background-position: center;">
                        <a href="{{ route('home.page') }}"> <img class="img-fluid"
                                src="{{ asset('storage/logo/' . $theme->logo) }}" alt="{{ $theme->title }}">
                        </a>
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <div class="text-center">
                                <a href="{{ route('home.page') }}"><img style="max-width: 40%;display: none"
                                        class="img-fluid login-img" src="{{ asset('storage/logo/' . $theme->logo) }}"
                                        alt="{{ $theme->title }}"></a>
                            </div>

                            <div class="login-form-header text-center">
                                <h1>Welcome Back</h1>
                                <p>Login to access your dashboard and continue your Olympiad journey.</p>
                            </div>

                            @include('validate')

                            <!-- Form -->
                            <form action="{{ route('admin.login') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="email_cell_username">Email / Phone / Username</label>
                                    <input id="email_cell_username" class="form-control" name="email_cell_username"
                                        type="text" placeholder="Enter your email, phone, or username"
                                        value="{{ old('email_cell_username') }}">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" class="form-control" type="password" name="password"
                                        placeholder="Enter your password">
                                </div>
                                <div class="form-group mb-0">
                                    <button class="btn btn-primary btn-block" type="submit">Login</button>
                                </div>
                            </form>
                            <!-- /Form -->

                            <div class="text-center forgotpass"><a href="{{ route('forget.password.page') }}">Forgot
                                    Password?</a></div>
                            <div class="login-or">
                                <span class="or-line"></span>
                                <span class="span-or">or</span>
                            </div>
                            <div class="text-center dont-have">Don’t have an account? <a
                                    href="{{ route('student-register.index') }}">Register</a></div>
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

</html>
