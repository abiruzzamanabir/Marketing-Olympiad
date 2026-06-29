<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>{{ $theme->title }} - Forgot Password</title>

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
            background: #ffffff;
        }

        .login-right-wrap {
            max-width: 430px;
            margin: 0 auto;
            padding: 44px 34px;
        }

        .forgot-header {
            margin-bottom: 28px;
        }

        .forgot-eyebrow {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 14px;
            border-radius: 30px;
            background: rgba(0, 123, 255, 0.08);
            color: #007bff;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .forgot-title {
            margin-bottom: 10px;
            color: #1f2937;
            font-size: 30px;
            font-weight: 700;
            line-height: 1.2;
        }

        .forgot-subtitle {
            margin-bottom: 0;
            color: #6b7280;
            font-size: 15px;
            line-height: 1.6;
        }

        .form-group label {
            margin-bottom: 8px;
            color: #374151;
            font-size: 14px;
            font-weight: 600;
        }

        .form-control {
            height: 48px;
            border: 1px solid #d9dee8;
            border-radius: 10px;
            color: #1f2937;
            font-size: 15px;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.18rem rgba(0, 123, 255, 0.12);
        }

        .reset-helper {
            margin-top: 8px;
            color: #7b8494;
            font-size: 13px;
            line-height: 1.5;
        }

        .btn-primary {
            height: 48px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
        }

        .back-login {
            margin-top: 26px;
            color: #6b7280;
            font-size: 14px;
        }

        .back-login a {
            color: #007bff;
            font-weight: 700;
        }

        @media only screen and (max-width: 767px) {
            .login-right-wrap {
                padding: 34px 22px;
            }

            .forgot-title {
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
                        <a href="{{ route('home.page') }}">
                            <img class="img-fluid" src="{{ asset('storage/logo/' . $theme->logo) }}"
                                alt="{{ $theme->title }}">
                        </a>
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <div class="forgot-header">
                                <span class="forgot-eyebrow">Account Recovery</span>
                                <h1 class="forgot-title">Forgot Password?</h1>
                                <p class="forgot-subtitle">Enter your registered email address and we will send you a
                                    password reset link.</p>
                            </div>

                            @include('validate')

                            <!-- Form -->
                            <form action="{{ route('forget.password') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email Address <span class="text-danger">*</span></label>
                                    <input id="email" name="email" class="form-control" type="email"
                                        value="{{ old('email') }}" placeholder="Enter your email address" required>
                                    <p class="reset-helper">Use the email address connected to your account.</p>
                                </div>
                                <div class="form-group mb-0">
                                    <button class="btn btn-primary btn-block" type="submit">Send Reset Link</button>
                                </div>
                            </form>
                            <!-- /Form -->

                            <div class="text-center back-login">Remember your password? <a
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

</body>

</html>
