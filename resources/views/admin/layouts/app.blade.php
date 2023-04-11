@php
    use App\Models\Theme;
    use App\Models\Admin;
    use App\Models\QuestionAnswer;
    $theme = Theme::findOrFail(1);
    $verified = count(
        Admin::orderBy('first_name', 'asc')
            ->where('status', true)
            ->where('blocked', false)
            ->where('role_id', 3)
            ->where('trash', false)
            ->get(),
    );
    $unverified = count(
        Admin::orderBy('first_name', 'asc')
            ->where('status', false)
            ->where('blocked', false)
            ->where('role_id', 3)
            ->where('trash', false)
            ->get(),
    );
    $examdone = count(
        Admin::where('round_one_status', true)->where('blocked', false)->where('role_id', 3)->where('trash', false)->get(),
    );
    $question = count(QuestionAnswer::get());
    $totalStudent = $verified + $unverified;

@endphp
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    {{-- <title>{{ $theme->title }} - {{ $theme->tagline }}</title> --}}
    <title>{{ $theme->title }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/logo/' . $theme->favicon) }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/font-awesome.min.css') }}">

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/feathericon.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="{{ asset('admin/assets/plugins/morris/morris.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('admin/assets/icon/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.css" />

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">

    <!--[if lt IE 9]>
   <script src="admin/assets/js/html5shiv.min.js"></script>
   <script src="admin/assets/js/respond.min.js"></script>
  <![endif]-->
</head>

<body @if (Auth::guard('admin')->user()->role_id === 3)
class="mini-sidebar"
@endif>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        @include('admin.layouts.header')
        @if (Auth::guard('admin')->user()->role_id !== 3)
        @include('admin.layouts.sidebar')
@endif


    <!-- ========== Rule & Regulation Modal ========== -->
    <div class="modal fade" id="rulesModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="rulesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rulesModalLabel">Rules & Regulation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
                    <p class="text-dark">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Modi, dolorem, quas
                        praesentium omnis vitae eligendi nisi iure perspiciatis accusamus consectetur voluptates dolores
                        debitis ad accusantium reiciendis voluptate rerum cumque eaque?
                        Corporis magnam voluptatem laudantium nostrum iusto sint quisquam dolores tenetur, hic neque
                        atque optio. Distinctio voluptate recusandae, consectetur at dolorum odit, adipisci ipsa quam
                        quidem officia libero tempora laudantium temporibus?
                        Accusamus facilis, exercitationem quaerat recusandae voluptas libero, sed quasi nisi, maiores
                        explicabo deleniti fuga delectus quidem sunt maxime officia! Assumenda, aliquam accusamus
                        numquam quas et dolorum magnam velit temporibus modi?
                        Atque quod delectus sapiente ab consectetur obcaecati, distinctio ipsum repudiandae. Expedita
                        maiores sint cumque perspiciatis quod sed ipsa porro vitae at vel, ratione provident? Quo beatae
                        totam illo ullam consequatur.
                        Ducimus fuga iure voluptatem, ullam possimus, autem mollitia voluptatibus unde quidem et
                        reprehenderit ex repudiandae temporibus, quod numquam soluta corrupti at similique aliquid
                        dolore dignissimos alias tempora laborum esse? Porro.</p>
                    <form action="" method="post">
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                I Agree </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a id="startexam" class="d-none" href="{{ route('round.one') }}"><button type="button"
                            class="btn btn-primary">Start Exam</button></a>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== Rule & Regulation Modal ========== -->

        <!-- Page Wrapper -->
        <div class="page-wrapper">

            <div class="content container-fluid">
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
                            <div>
                                @php
                                    $mac = 'UNKNOWN';
                                    foreach (explode("\n", str_replace(' ', '', trim(`getmac`, "\n"))) as $i) {
                                        if (strpos($i, 'Tcpip') > -1) {
                                            $mac = substr($i, 0, 17);
                                            break;
                                        }
                                    }

                                @endphp
                                {{-- @if (!empty(Auth::guard('admin')->user()->mac))
                                    @if (Auth::guard('admin')->user()->mac === $mac)
                                        {{ 'MAC Address:' . ' ' . $mac }}
                                    @else
                                        {{ 'Another PC' }}
                                    @endif
                                @else
                                    {{ 'MAC Unavailable' }}

                                @endif --}}
                                <b class="text-muted">{{ 'MAC Address:' . ' ' }}</b><b
                                    class="@if ($mac === 'UNKNOWN') text-danger
                                    @else
                                    text-muted @endif">{{ $mac }}</b>
                                <p class="text-muted">Time: <span id="time">00:00:00 XX</span></p>
                            </div>
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
    {{-- <script src="{{ asset('admin/assets/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/chart.morris.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdn.ckeditor.com/4.19.1/basic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('admin/assets/js/script.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('custom/admin.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('input[type="checkbox"]').click(function() {
                if ($(this).prop("checked") == true) {
                    $('#startexam').removeClass('d-none');
                } else if ($(this).prop("checked") == false) {
                    $('#startexam').addClass('d-none');
                }
            });
        });
    </script>
    <script>
        let myVar = setInterval(myTimer, 1000);

        function myTimer() {
            const d = new Date();
            document.getElementById("time").innerHTML = d.toLocaleTimeString();
        }
    </script>
    @include('forcejs')

@stack('script')
</body>


</html>
