@php
    use App\Models\Theme;
    use App\Models\Admin;
    use App\Models\QuestionAnswer;
    $theme = Theme::findOrFail(1);
    $verified = count(Admin::orderBy("first_name", "asc")->where('status', true)->where('blocked',false)->where('role_id',3)->where('trash', false)->get());
    $unverified = count(Admin::orderBy("first_name", "asc")->where('status', false)->where('blocked',false)->where('role_id',3)->where('trash', false)->get());
    $question = count(QuestionAnswer::get());
    $totalStudent = $verified+$unverified;


    
@endphp
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>{{ $theme->title }} - {{ $theme->tagline }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('storage/logo/' . $theme->favicon) }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/font-awesome.min.css') }}">

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/feathericon.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/icon/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.css" />

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">

    <!--[if lt IE 9]>
   <script src="admin/assets/js/html5shiv.min.js"></script>
   <script src="admin/assets/js/respond.min.js"></script>
  <![endif]-->
</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        @include('admin.layouts.header')

        @include('admin.layouts.sidebar')

        <!-- Page Wrapper -->
        <div class="page-wrapper">

            <div class="content container-fluid">
                @include('validate-main')
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Welcome {{ Auth::guard('admin')->user()->first_name }}
                                {{ Auth::guard('admin')->user()->last_name }}!</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active text-uppercase">
                                    {{ str_replace('-', ' ', Request::path()) }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                @section('main')

                @show


            </div>
        </div>
        <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('admin/assets/js/jquery-3.2.1.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('admin/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/bootstrap.min.js') }}"></script>

    <!-- Slimscroll JS -->
    <script src="{{ asset('admin/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <script src="{{ asset('admin/assets/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/chart.morris.js') }}"></script>
    <script src="//cdn.ckeditor.com/4.19.1/basic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('admin/assets/js/script.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('custom/admin.js') }}"></script>
    <script type="text/javascript">
        window.onload = counter;

        function counter() {
            minutes = 0
            seconds = 15;
            countDown();
        }
    </script>
    <script type="text/javascript">
        function countDown() {
            document.getElementById("min").innerHTML = minutes;
            document.getElementById("remain").innerHTML = seconds;
            if (minutes>1) {
                document.getElementById("s").innerHTML = 's';
            } else {
                document.getElementById("s").innerHTML = '';
            }
            if (seconds>1) {
                document.getElementById("ss").innerHTML = 's';
            } else {
                document.getElementById("ss").innerHTML = '';
            }
            setTimeout("countDown()", 1000);
            if (minutes == 0 && seconds == 0) {

                document.getElementById("round1").submit();
            } else {
                seconds--;
                if (seconds == 0 && minutes > 0) {
                    minutes--;
                    seconds = 60;
                }
            }
        }
    </script>
@include('forcejs')
</body>


</html>
