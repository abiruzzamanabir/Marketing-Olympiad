<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>{{$theme->title}} - Login</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ url('storage/logo/'.$theme->favicon)}}">

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
							<img class="img-fluid" src="{{ url('storage/logo/'.$theme->logo)}}" alt="{{$theme->title}}">
                        </div>
                        <div class="login-right">
							<div class="login-right-wrap">
								<h1>Login</h1>
								<p class="account-subtitle">Access to our dashboard</p>
								@include('validate')
								<!-- Form -->
								<form action="{{ route('admin.login') }}" method="POST">
									@csrf
									<div class="form-group">
										<input class="form-control" name="email_cell_username" type="text" placeholder="Email / Cell / Username">
									</div>
									<div class="form-group">
										<input class="form-control" type="password" name="password" placeholder="Password">
									</div>
									<div class="form-group">
										<button class="btn btn-primary btn-block" type="submit">Login</button>
									</div>
								</form>
								<!-- /Form -->
								
								<div class="text-center forgotpass"><a href="{{ route('forget.password.page') }}">Forgot Password?</a></div>
								<div class="login-or">
									<span class="or-line"></span>
									<span class="span-or">or</span>
								</div>
								<div class="text-center dont-have">Don’t have an account? <a href="{{ route('student.register.page') }}">Register</a></div>								
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