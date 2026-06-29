@php
    use App\Models\Theme;

    $theme = Theme::find(1);
    $resetEmail = $email ?? old('email');
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>{{ $theme->title ?? 'Admin' }} - Reset Password</title>

    <link rel="shortcut icon" type="image/x-icon"
        href="{{ !empty($theme?->favicon) ? asset('storage/logo/' . $theme->favicon) : asset('admin/assets/img/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">

    <style>
        .login-right {
            background: #ffffff;
        }

        .login-right-wrap {
            max-width: 430px;
            margin: 0 auto;
            padding: 44px 34px;
        }

        .reset-header {
            margin-bottom: 28px;
        }

        .reset-eyebrow {
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

        .reset-title {
            margin-bottom: 10px;
            color: #1f2937;
            font-size: 30px;
            font-weight: 700;
            line-height: 1.2;
        }

        .reset-subtitle {
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

        .password-field {
            position: relative;
        }

        .password-field .form-control {
            padding-right: 48px;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 14px;
            z-index: 5;
            transform: translateY(-50%);
            border: 0;
            background: transparent;
            color: #6b7280;
            cursor: pointer;
            padding: 0;
        }

        .password-toggle:focus {
            outline: none;
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

            .reset-title {
                font-size: 26px;
            }
        }
    </style>
</head>

<body>

    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">

                    <div class="login-left"
                        style="background-image: url('{{ asset('admin/assets/img/MO1.png') }}');background-size:cover;background-repeat:no-repeat;background-position: center;">
                        <a href="{{ route('home.page') }}">
                            @if (!empty($theme?->logo))
                                <img class="img-fluid" src="{{ asset('storage/logo/' . $theme->logo) }}"
                                    alt="{{ $theme->title ?? 'Logo' }}">
                            @else
                                <img class="img-fluid" src="{{ asset('admin/assets/img/logo-white.png') }}"
                                    alt="Logo">
                            @endif
                        </a>
                    </div>

                    <div class="login-right">
                        <div class="login-right-wrap">

                            <div class="reset-header">
                                <span class="reset-eyebrow">Account Recovery</span>
                                <h1 class="reset-title">Reset Password</h1>
                                <p class="reset-subtitle">Create a new password for your account and continue securely.
                                </p>
                            </div>

                            @include('validate')

                            <form action="{{ route('reset.password') }}" method="POST">
                                @csrf

                                <input type="hidden" name="email" value="{{ $resetEmail }}">

                                <div class="form-group">
                                    <label for="password">New Password <span class="text-danger">*</span></label>

                                    <div class="password-field">
                                        <input name="password" id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Enter new password" required autocomplete="new-password">

                                        <button type="button" class="password-toggle"
                                            onclick="togglePasswordVisibility('password', 'togglePassword')">
                                            <i class="fa fa-eye" id="togglePassword"></i>
                                        </button>
                                    </div>

                                    <p class="reset-helper">Use a strong password that you have not used before.</p>
                                </div>

                                <div class="form-group">
                                    <label for="passwordConf">Confirm Password <span
                                            class="text-danger">*</span></label>

                                    <div class="password-field">
                                        <input name="password_confirmation" id="passwordConf" type="password"
                                            class="form-control" placeholder="Confirm new password" required
                                            autocomplete="new-password">

                                        <button type="button" class="password-toggle"
                                            onclick="togglePasswordVisibility('passwordConf', 'togglePasswordConf')">
                                            <i class="fa fa-eye" id="togglePasswordConf"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="form-group mb-0">
                                    <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
                                </div>
                            </form>

                            <div class="text-center back-login">
                                Remember your password?
                                <a href="{{ route('admin.login.page') }}">Login</a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/script.js') }}"></script>

    <script>
        function togglePasswordVisibility(inputId, toggleId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(toggleId);

            if (!passwordInput || !toggleIcon) return;

            const isPassword = passwordInput.type === 'password';

            passwordInput.type = isPassword ? 'text' : 'password';

            toggleIcon.classList.toggle('fa-eye', !isPassword);
            toggleIcon.classList.toggle('fa-eye-slash', isPassword);
        }
    </script>

</body>

</html>
