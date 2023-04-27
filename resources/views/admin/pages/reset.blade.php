@php
    use App\Models\Theme;
    $theme = Theme::findOrFail(1);

@endphp
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
                        <img class="img-fluid" src="{{ asset('storage/logo/' . $theme->logo) }}"
                            alt="{{ $theme->title }}">
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Forgot Password?</h1>
                            <p class="account-subtitle">Enter your new password</p>

                            <!-- Forgot Password Form -->
                            <form action="{{ route('reset.password') }}" method="POST">
                                @csrf
                                @include('validate')
                                <label class="focus-label">Password</label>
                                <div class="input-group form-focus mb-4">
                                    <input name="email" value="{{ $email }}" type="hidden"
                                        class="form-control floating">
                                    <input name="password" id="password" type="password" class="form-control floating">
                                    <span class="input-group-text" style="border-radius: 0">
                                        <i class="fa fa-eye" id="togglePassword" style="cursor: pointer"></i>
                                    </span>
                                </div>
                                <label class="focus-label">Confirm Password</label>
                                <div class="input-group form-focus mb-4">
                                    <input name="password_confirmation" id="passwordConf" type="password" class="form-control floating">
                                    <span class="input-group-text" style="border-radius: 0">
                                        <i class="fa fa-eye" id="togglePasswordConf" style="cursor: pointer"></i>
                                    </span>
                                </div>
                                {{-- <div class="text-right">
                                    <a class="forgot-link" href="{{ route('admin.login.page') }}">Remember your
                                        password?</a>
                                </div> --}}
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
    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function() {

            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            // toggle the eye icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
        const togglePasswordConf = document.querySelector("#togglePasswordConf");
        const passwordConf = document.querySelector("#passwordConf");

        togglePasswordConf.addEventListener("click", function() {

            // toggle the type attribute
            const type = passwordConf.getAttribute("type") === "password" ? "text" : "password";
            passwordConf.setAttribute("type", type);
            // toggle the eye icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>

</body>

<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:53 GMT -->

</html>
