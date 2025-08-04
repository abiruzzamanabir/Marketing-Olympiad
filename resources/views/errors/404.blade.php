<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>404 Page Not Found!</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Maven+Pro:400,900" rel="stylesheet">

	<!-- Custom stlylesheet -->
	{{-- <link type="text/css" rel="stylesheet" href="css/style.css" /> --}}

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
<style>
    * {
  -webkit-box-sizing: border-box;
          box-sizing: border-box;
}

body {
  padding: 0;
  margin: 0;
}

#notfound {
  position: relative;
  height: 100vh;
}

#notfound .notfound {
  position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
}

.notfound {
  max-width: 920px;
  width: 100%;
  line-height: 1.4;
  text-align: center;
  padding-left: 15px;
  padding-right: 15px;
}

.notfound .notfound-404 {
  position: absolute;
  height: 100px;
  top: 0;
  left: 50%;
  -webkit-transform: translateX(-50%);
      -ms-transform: translateX(-50%);
          transform: translateX(-50%);
  z-index: -1;
}

.notfound .notfound-404 h1 {
  font-family: 'Maven Pro', sans-serif;
  color: #ececec;
  font-weight: 900;
  font-size: 276px;
  margin: 0px;
  position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
}

.notfound h2 {
  font-family: 'Maven Pro', sans-serif;
  font-size: 46px;
  color: #000;
  font-weight: 900;
  text-transform: uppercase;
  margin: 0px;
}

.notfound p {
  font-family: 'Maven Pro', sans-serif;
  font-size: 16px;
  color: #000;
  font-weight: 400;
  text-transform: uppercase;
  margin-top: 15px;
}

.notfound a {
  font-family: 'Maven Pro', sans-serif;
  font-size: 14px;
  text-decoration: none;
  text-transform: uppercase;
  background: #189cf0;
  display: inline-block;
  padding: 16px 38px;
  border: 2px solid transparent;
  border-radius: 40px;
  color: #fff;
  font-weight: 400;
  -webkit-transition: 0.2s all;
  transition: 0.2s all;
}

.notfound a:hover {
  background-color: #fff;
  border-color: #189cf0;
  color: #189cf0;
}

@media only screen and (max-width: 480px) {
  .notfound .notfound-404 h1 {
    font-size: 162px;
  }
  .notfound h2 {
    font-size: 26px;
  }
}

</style>
</head>

<body>

	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>404</h1>
			</div>
			<h2>We are sorry, Page not found!</h2>
			<p>The page you are looking for might have been removed had its name changed or is temporarily unavailable.</p>
			<a href="{{ route('home.page') }}">Back To Homepage</a>
		</div>
	</div>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
