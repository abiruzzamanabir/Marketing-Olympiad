@php
    use App\Models\ExamControl;
    use App\Models\Theme;
    use Carbon\Carbon;
    $exam = ExamControl::findOrFail(1);
    $theme = Theme::findOrFail(1);
    $social = json_decode($theme->social, false);

    // $examstarttime = $exam->start_date_time;
    // $exam_start_carbon = Carbon::parse($examstarttime);
    // $exam_start = $exam_start_carbon->format('d');

    // $examendime = $exam->end_date_time;
    // $exam_end_carbon = Carbon::parse($examendime);
    // $exam_end = $exam_end_carbon->format('d');

    // $examtime = $exam->next_round_date;
    // $exam_carbon = Carbon::parse($examtime);

    // $exam_date = $exam_carbon->format('d'); // Output: 13
    // $exam_end_time = $exam->next_round_end_date;
    // $exam_end_carbon = Carbon::parse($exam_end_time);
    // $exam_end_date = $exam_end_carbon->format('d');
    // $exam_month = $exam_carbon->format('m'); // Output: 04
    // $exam_year = $exam_carbon->format('Y'); // Output: 2023

    // // echo "Date: $exam_date, Month: $exam_month, Year: $exam_year";
    // $currentdatetime = now();
    // $carbon = Carbon::parse($currentdatetime);

    // $date = $carbon->format('d'); // Output: 13
    // $month = $carbon->format('m'); // Output: 04
    // $year = $carbon->format('Y'); // Output: 2023

    // // echo "Date: $date, Month: $month, Year: $year";

    $exam_carbon = Carbon::parse($exam->start_date_time);
    $exam_end_carbon = Carbon::parse($exam->end_date_time);
    $start_exam_carbon = Carbon::parse($exam->next_round_date);
    $end_exam_carbon = Carbon::parse($exam->next_round_end_date);
    $third_start_exam_carbon = Carbon::parse($exam->third_round_date);
    $third_end_exam_carbon = Carbon::parse($exam->third_round_end_date);

@endphp
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="facebook-domain-verification" content="vqvvq8hs1jel1j5mtvmslerjxost12" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;40logo0;500;700;900&display=swap"
        rel="stylesheet">

    <link href=" https://cdn.jsdelivr.net/npm/gotham-fonts@1.0.3/css/gotham-rounded.min.css " rel="stylesheet">

    <title>{{ $theme->title }}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/logo/' . $theme->favicon) }}">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/templatemo-chain-app-dev.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('frontend/assets/css/css.scss') }}"> --}}
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animated.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/feathericon.min.css') }}">
<!-- Google tag (gtag.js) --> <script async src="https://www.googletagmanager.com/gtag/js?id=G-PDVVF7FEYN"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-PDVVF7FEYN'); </script>

<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1211486769503562');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1211486769503562&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->

</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="{{ route('home.page') }}" class="logo">
                            <img class="img-fluid" style="max-height: 70px; width: auto"
                                src="{{ asset('storage/logo/logo_landing.png') }}" alt="Chain App Dev">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="{{ route('home.page') }}" class="active">Home</a>
                            </li>
                            <li class="scroll-to-section"><a href="#about">About</a></li>
                            {{-- <li class="scroll-to-section"><a href="#whyparticipate">Why Participate</a></li> --}}
                            {{-- <li class="scroll-to-section"><a href="#whoparticipate">Who Participate</a></li> --}}
                            <li class="scroll-to-section"><a href="#guidelines">Guidelines</a></li>
                            <li class="scroll-to-section"><a href="#rules">Rules & Regulation</a></li>
                            {{-- <li class="scroll-to-section"><a href="#faq">FAQ</a></li> --}}
                            {{-- <li class="scroll-to-section"><a href="#partner">Partners</a></li> --}}
                            <li class="scroll-to-section"><a href="#calender">Calender</a></li>
                            <li class="nav-item dropdown has-arrow"><a
                                    href="{{ route('student.round.one.final.result') }}" target="_blank">Result</a>
                            </li>
                            {{-- <li class="scroll-to-section"><a href="#">knowledge hub</a></li>

                            @if (Auth::guard('admin')->user() && Auth::guard('admin')->user()->role_id == 3)
                                <li class="nav-item dropdown has-arrow">
                                    @php
                                        $notificationControllerObj = new \App\Http\Controllers\NotificationController();
                                    @endphp
                                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                                        <span class="user-img"><i class="fa fa-bell position-relative"
                                                aria-hidden="true">
                                                <span
                                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                    {{ $notificationControllerObj->CountNotification() }}
                                                </span>
                                            </i></span>
                                    </a>
                                    <div class="dropdown-menu" style="width: 20rem !important;">

                                        <div class="overflow-auto" style="max-height: 500px;">
                                            @if (!empty($notificationControllerObj->getSomeNotificatinData()))
                                                @foreach ($notificationControllerObj->getSomeNotificatinData() as $key => $notify)
                                                    <div class="px-2">
                                                        <u>
                                                            <h6>{{ $notify->title }}</h6>
                                                        </u>
                                                        <p class="text-dark"
                                                            style="ine-height: 1.5;text-align: justify;">
                                                            {{ $notify->details }}</p>
                                                        <p class="text-muted">
                                                            {{ $notify->created_at->diffForHumans() }}</p> --}}
                            {{-- <p class="text-muted">@php
                                                $to_time = strtotime($notify->created_at);
                                                $from_time = strtotime(\Carbon\Carbon::now());
                                                echo round(abs($to_time - $from_time) / 60, 0) . ' minute';
                                            @endphp
                                            min ago</p> --}}
                            {{-- </div>
                                                    @if (!$loop->last)
                                                        <hr>
                                                    @endif
                                                @endforeach
                                            @endif

                                        </div>
                                    </div>
                                </li>
                            @endif --}}

                            <!-- Notifications -->
                            {{-- <li class="nav-item dropdown noti-dropdown">
                                @php
                                    $notificationControllerObj = new \App\Http\Controllers\NotificationController();
                                @endphp
                                <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                                    <i class="fe fe-bell"></i> <span
                                        class="badge badge-pill">{{ $notificationControllerObj->CountNotification() }}</span>
                                </a>
                                <div class="dropdown-menu notifications">
                                    <div class="topnav-dropdown-header">
                                        <span class="notification-title">Notifications</span>
                                    </div>
                                    <div class="noti-content">
                                        <ul class="notification-list">
                                            @if (!empty($notificationControllerObj->getSomeNotificatinData()))
                                                @foreach ($notificationControllerObj->getSomeNotificatinData() as $key => $notify)
                                                    <li>
                                                        <div class="icon">
                                                            <img src="{{ asset('frontend/assets/images/bg/company-logo/notifacion-1.png') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="content">
                                                            <h6>
                                                                <a href="#">{{ $notify->title }}.</a>
                                                                <p>{{ $notify->details }}</p>
                                                            </h6>
                                                            <span><img
                                                                    src="{{ asset('frontend/assets/images/icon/clock-1.svg') }}"
                                                                    alt="">
                                                                @php
                                                                    $to_time = strtotime($notify->created_at);
                                                                    $from_time = strtotime(\Carbon\Carbon::now());
                                                                    echo round(abs($to_time - $from_time) / 60, 0) . ' minute';
                                                                @endphp
                                                                min ago</span>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>

                                </div>
                            </li> --}}
                            <!-- /Notifications -->

                            @if (Auth::guard('admin')->user())
                                <!-- User Menu -->
                                <li class="nav-item dropdown has-arrow">
                                    @if (Auth::guard('admin')->user()->photo == 'avatar.png')
                                        <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                                            <span class="user-img"><img
                                                    style="width: 40px; height: 40px; object-fit: cover"
                                                    class="rounded-circle"
                                                    src="{{ asset('storage/admins/avatar.png') }}" width="31"
                                                    alt="{{ Auth::guard('admin')->user()->first_name }}"></span>
                                        </a>
                                    @else
                                        <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                                            <span class="user-img"><img
                                                    style="width: 40px; height: 40px; object-fit: cover"
                                                    class="rounded-circle"
                                                    src="{{ asset('storage/admins/' . Auth::guard('admin')->user()->photo) }}"
                                                    width="31"
                                                    alt="{{ Auth::guard('admin')->user()->first_name }}"></span>
                                        </a>
                                    @endif
                                    <div class="dropdown-menu" style="width: 20rem !important;">
                                        <div class="user-header">
                                            @if (Auth::guard('admin')->user()->photo == 'avatar.png')
                                                <div class="avatar avatar-sm">
                                                    <img style="width: 40px; height: 40px; object-fit: cover"
                                                        src="{{ asset('storage/admins/avatar.png') }}" alt="User Image"
                                                        class="avatar-img rounded-circle">
                                                </div>
                                            @else
                                                <img style="width: 40px; height: 40px; object-fit: cover"
                                                    src="{{ asset('storage/admins/' . Auth::guard('admin')->user()->photo) }}"
                                                    alt="User Image" class="avatar-img rounded-circle">
                                            @endif
                                            <div class="user-text">
                                                <h6>{{ Auth::guard('admin')->user()->first_name . ' ' . Auth::guard('admin')->user()->last_name }}
                                                </h6>
                                                <p class="text-muted mb-0">
                                                    {{ Auth::guard('admin')->user()->role->name }}</p>
                                            </div>
                                        </div>
                                        @if (Auth::guard('admin')->user()->role_id == 3)
                                            <a class="dropdown-item"
                                                href="{{ route('admin.dashboard.page') }}">Dashboard</a>
                                        @endif
                                        <a class="dropdown-item" href="{{ route('admin.profile.page') }}">My
                                            Profile</a>
                                        @if (Carbon::now() >= $exam_carbon && Carbon::now() <= $exam_end_carbon)
                                            @if (Auth::guard('admin')->user()->round_one_status == false)
                                                @if (in_array('round-1', json_decode(Auth::guard('admin')->user()->role->permission)))
                                                    <a class="dropdown-item"
                                                        @if (Auth::guard('admin')->user()->round_one_status == false) style="cursor:pointer;" data-bs-toggle="modal"
                                            data-bs-target="#rulesModal" @else href="{{ route('round.one') }}" @endif>Round
                                                        One</a>
                                                @endif
                                            @endif
                                        @endif
                                        @if (Carbon::now() >= $start_exam_carbon && Carbon::now() <= $end_exam_carbon)
                                            @if (Auth::guard('admin')->user()->round_two_status == false)
                                                @if (in_array('round-2', json_decode(Auth::guard('admin')->user()->role->permission)) &&
                                                        Auth::guard('admin')->user()->selected == true)
                                                    <a class="dropdown-item"
                                                        @if (Auth::guard('admin')->user()->round_two_status == false) style="cursor:pointer;" data-bs-toggle="modal"
                                            data-bs-target="#rulesModal" @else href="{{ route('round.two') }}" @endif>Round
                                                        Two</a>
                                                @endif
                                            @endif
                                        @endif
                                        @if (Carbon::now() >= $third_start_exam_carbon && Carbon::now() <= $third_end_exam_carbon)
                                            @if (in_array('round-3', json_decode(Auth::guard('admin')->user()->role->permission)) &&
                                                    Auth::guard('admin')->user()->selectedTwo == true &&
                                                    empty(Auth::guard('admin')->user()->file_name))
                                                <a class="dropdown-item" href="{{ route('round.three') }}">Round
                                                    Three</a>
                                            @endif
                                        @endif
                                        {{-- @if (Auth::guard('admin')->user()->round_one_status == true)
                                            <a class="dropdown-item" href="{{ route('result.index') }}">Result</a>
                                        @endif --}}
                                        @if (in_array('setting', json_decode(Auth::guard('admin')->user()->role->permission)))
                                            <a class="dropdown-item" href="settings.html">Settings</a>
                                        @endif
                                        @if (Auth::guard('admin')->user()->round_one_status == true)
                                            <a class="dropdown-item" href="{{ route('get.certificate') }}">Download
                                                Certificate</a>
                                        @endif
                                        <a class="dropdown-item" href="{{ route('admin.logout.page') }}">Logout</a>
                                    </div>
                                </li>
                                <!-- /User Menu -->
                            @else
                                <li>
                                    <div class="gradient-button"><a href="{{ route('admin.login.page') }}"><i
                                                class="fa fa-sign-in-alt"></i> Login</a>
                                    </div>
                                    {{-- <div class="gradient-button"><a id="modal_trigger" href="#modal"><i
                                                class="fa fa-sign-in-alt"></i> Login</a>
                                    </div> --}}
                                </li>
                            @endif


                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
                @include('validatefront')

            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <div id="modal" class="popupContainer" style="display:none;">
        <div class="popupHeader">
            <span class="header_title">Login</span>
            <span class="modal_close"><i class="fa fa-times"></i></span>
        </div>

        <section class="popupBody">
            <!-- Social Login -->
            <div class="social_login">
                <!-- <div class="">
                <a href="#" class="social_box fb">
                    <span class="icon"><i class="fab fa-facebook"></i></span>
                    <span class="icon_title">Connect with Facebook</span>

                </a>

                <a href="#" class="social_box google">
                    <span class="icon"><i class="fab fa-google-plus"></i></span>
                    <span class="icon_title">Connect with Google</span>
                </a>
            </div>

            <div class="centeredText">
                <span>Or use your Email address</span>
            </div> -->

                <div class="action_btns">
                    {{-- <div class="one_half"><a href="#" id="login_form" class="btn">Login</a></div> --}}
                    {{-- <div class="one_half"><a href="{{ route('admin.login.page') }}" class="btn">Login</a></div> --}}
                    {{-- <div class="one_half last"><a href="{{ route('student-register.index') }}" class="btn">Sign
                            up</a></div> --}}
                </div>
            </div>

            {{-- Username & Password Login form --}}
            <div class="user_login">
                <form action="{{ route('admin.login') }}" method="POST">
                    @csrf
                    <label>Email / Username / Phone</label>
                    <input name="email_cell_username" type="text" />
                    <br />

                    <label>Password</label>
                    <input type="password" name="password" />
                    <br />

                    <!-- <div class="checkbox">
                    <input id="remember" type="checkbox" />
                    <label for="remember">Remember me on this computer</label>
                </div> -->

                    <div class="action_btns">
                        <div class="one_half"><button type="submit" class="btn btn_red">Login <i
                                    class="fa fa-angle-double-right"></i></button></div>
                        <div class="one_half last"><a href="{{ route('student-register.index') }}"
                                class="btn btn_red">Sign
                                up</a></div>
                        {{-- <div class="one_half"><a href="{{ route('student-register.index') }}" class="btn">Sign
                            up</a></div> --}}
                    </div>
                </form>

                <a href="{{ route('forget.password.page') }}" class="forgot_password">Forgot password?</a>
            </div>

            {{-- Register Form --}}
            <div class="user_register">
                <form>
                    <label>Full Name</label>
                    <input type="text" />
                    <br />

                    <label>Email Address</label>
                    <input type="email" />
                    <br />

                    <label>Password</label>
                    <input type="password" />
                    <br />

                    <div class="checkbox">
                        <input id="send_updates" type="checkbox" />
                        <label for="send_updates">Send me occasional email updates</label>
                    </div>

                    <div class="action_btns">
                        <div class="one_half"><a href="#" class="btn back_btn"><i
                                    class="fa fa-angle-double-left"></i> Back</a></div>
                        <div class="one_half last"><a href="#" class="btn btn_red">Register</a></div>
                    </div>
                </form>
            </div>
        </section>
    </div>


    <!-- ========== Rule & Regulation Modal ========== -->
    @if (Auth::guard('admin')->user())
        <div class="modal fade" id="rulesModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="rulesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rulesModalLabel">Rules & Regulation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ol class="list-group">
                            <li class="list-group-item">Participants must be enrolled in a university at the time of registration.</li>
                            <li class="list-group-item">Participants have to compete individually.</li>
                            <li class="list-group-item">Participants must register online through the official Marketing Olympiad website.</li>
                            <li class="list-group-item">All participants must comply with the rules and regulations set by the Marketing Olympiad organizers.</li>
                            <li style="font-weight: bold" class="list-group-item">While participating in the online quiz for Marketing Olympiad, participants during the exam cannot copy the question in an attempt on using unfair means. </li>
                            <li style="font-weight: bold" class="list-group-item">Participants cannot open a new tab during the quiz, cannot minimize the browser, cannot lock the screen, cannot refresh the page, cannot take screenshots, and cannot log in from multiple devices.</li>
                            <li style="font-weight: bold" class="list-group-item">The above-mentioned regulations are applicable for any device from which the quiz is being participated (Laptop, Mobile, Tablet & PC).</li>
                            <li style="font-weight: bold" class="list-group-item">Attempting any of the above-mentioned will provide a warning and a second attempt will lead to a disqualification.</li>
                            <li style="font-weight: bold" class="list-group-item">One participant can only attempt the quiz once. </li>
                            <li class="list-group-item">Participants must abide by the competition timeline as mentioned.</li>
                            <li style="font-weight: bold" class="list-group-item">Plagiarism or any other form of academic misconduct is strictly prohibited and may result in disqualification.</li>
                            <li class="list-group-item">All information submitted becomes the property of the Marketing Olympiad organizers.</li>
                            <li class="list-group-item">The decision of the judges is final and cannot be contested.</li>
                            <li class="list-group-item">The Marketing Olympiad organizers reserve the right to disqualify any participant that violates the rules and regulations or engages in any unethical behavior.</li>
                            <li class="list-group-item">No negative scoring will be made on wrong answers. </li>
                            <li style="font-weight: bold" class="list-group-item">The quiz must be finished within the given timeframe. </li>
                            <li class="list-group-item">Participants must be at least 18 years old to compete in Marketing Olympiad.</li>
                            <li class="list-group-item">The competition is open to participants from any part of the country. </li>
                            <li style="font-weight: bold" class="list-group-item">The use of any unauthorized resources or external assistance is prohibited during the competition.</li>
                            <li class="list-group-item">Participants must provide accurate and complete information during the registration process.</li>
                        </ol>
                        <form action="" method="post">
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    I Agree </label>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a id="startexam" class="d-none"
                            @if (Auth::guard('admin')->user()->selected == true ?? '') href="{{ route('round.two') }}"
            @else
            href="{{ route('round.one') }}" @endif><button
                                type="button" class="btn btn-primary">Start Exam</button></a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- ========== Rule & Regulation Modal ========== -->


    <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 align-self-center">
                            <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s"
                                data-wow-delay="1s">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h2 class="text-uppercase">Marketing Olympiad</h2>
                                        <!-- <marquee behavior="scroll" direction="left" width="50%" height="20%"><p class="text-uppercase text-white">Marketing OLympiad</p></marquee> -->
                                        {{-- <p>Marketing OLympiad Tagline</p> --}}
                                    </div>
                                    @if (Auth::guard('admin')->user())
                                        @if (Carbon::now() >= $exam_carbon && Carbon::now() <= $exam_end_carbon)
                                            @if (Auth::guard('admin')->user()->round_one_status == false)
                                                <div class="white-button scroll-to-section">
                                                    <a
                                                        @if (Auth::guard('admin')->user()->round_one_status == false) style="cursor:pointer;" data-bs-toggle="modal"
                                                    data-bs-target="#rulesModal" @else href="{{ route('round.one') }}" @endif>Start
                                                        Exam</a>
                                                </div>
                                            @endif
                                        @endif
                                        @if (Carbon::now() >= $start_exam_carbon && Carbon::now() <= $end_exam_carbon)
                                            @if (Auth::guard('admin')->user()->round_two_status == false)
                                                <div class="white-button scroll-to-section">
                                                    <a
                                                        @if (Auth::guard('admin')->user()->round_two_status == false) style="cursor:pointer;" data-bs-toggle="modal"
                                                    data-bs-target="#rulesModal" @else href="{{ route('round.two') }}" @endif>Start
                                                        Exam</a>
                                                </div>
                                            @endif
                                        @endif
                                        @if (Carbon::now() >= $third_start_exam_carbon && Carbon::now() <= $third_end_exam_carbon)
                                            @if (Auth::guard('admin')->user()->selectedTwo == true)
                                                <div class="white-button scroll-to-section">
                                                    <a href="{{ route('round.three') }}">Start
                                                        Exam</a>
                                                </div>
                                            @endif
                                        @endif
                                    @else
                                        <div class="col-lg-12">
                                            <div class="white-button scroll-to-section">
                                                <a href="{{ route('admin.login.page') }}">Sign In</a>
                                            </div>
                                            <div class="white-button scroll-to-section">
                                                <a href="{{ route('student-register.index') }}">Sign Up</a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="right-image wow fadeInRight ms-5" data-wow-duration="1s"
                                data-wow-delay="0.5s">
                                <img src="{{ asset('frontend/assets/images/logo.png') }}" alt="">
                                {{-- <img src="https://bbf.digital/marketing-olympiad/public/frontend/assets/images/logo.png"
                                    alt=""> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div id="services" class="services section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
            <h4>Amazing <em>Services &amp; Features</em> for you</h4>
            <img src="assets/images/heading-line-dec.png" alt="">
            <p>If you need the greatest collection of HTML templates for your business, please visit <a rel="nofollow" href="https://www.toocss.com/" target="_blank">TooCSS</a> Blog. If you need to have a contact form PHP script, go to <a href="https://templatemo.com/contact" target="_parent">our contact page</a> for more information.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <div class="service-item first-service">
            <div class="icon"></div>
            <h4>App Maintenance</h4>
            <p>You are not allowed to redistribute this template ZIP file on any other website.</p>
            <div class="text-button">
              <a href="#">Read More <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="service-item second-service">
            <div class="icon"></div>
            <h4>Rocket Speed of App</h4>
            <p>You are allowed to use the Chain App Dev HTML template. Feel free to modify or edit this layout.</p>
            <div class="text-button">
              <a href="#">Read More <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="service-item third-service">
            <div class="icon"></div>
            <h4>Multi Workflow Idea</h4>
            <p>If this template is beneficial for your work, please support us <a rel="nofollow" href="https://paypal.me/templatemo" target="_blank">a little via PayPal</a>. Thank you.</p>
            <div class="text-button">
              <a href="#">Read More <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="service-item fourth-service">
            <div class="icon"></div>
            <h4>24/7 Help &amp; Support</h4>
            <p>Lorem ipsum dolor consectetur adipiscing elit sedder williamsburg photo booth quinoa and fashion axe.</p>
            <div class="text-button">
              <a href="#">Read More <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->

    @if (Carbon::now() <= $exam_end_carbon)
        <div style="padding-top: 50px;" class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <h4 class="card-title">
                        <h1>First Round</h1>
                    </h4>
                    @if (Carbon::now() <= $exam_carbon)
                        <div class="countdown d-flex justify-content-center">
                            <div class="mx-3">
                                <span class="number days"></span>
                                <span>Days</span>
                            </div>
                            <div class="mx-3">
                                <span class="number hours"></span>
                                <span>Hours</span>
                            </div>
                            <div class="mx-3">
                                <span class="number minutes"></span>
                                <span>Minutes</span>
                            </div>
                            <div class="mx-3">
                                <span class="number seconds"></span>
                                <span>Seconds</span>
                            </div>
                        </div>
                    @else
                        <h2 class="text-center text-muted">Exam Running.....</h2>
                    @endif
                    @if (Carbon::now() >= $exam_carbon && Carbon::now() <= $exam_end_carbon)
                        <a class="btn btn-primary btn-sm text-center my-3"
                            @if (Auth::guard('admin')->user()) data-bs-toggle="modal"
                                    data-bs-target="#rulesModal"
                @else
                href="{{ route('round.one') }}" @endif>Start
                            Exam</a>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <div style="padding-top: 50px !important;" id="whyparticipate" class="participate section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 align-self-center">
                    <div class="section-heading">
                        <h4><em>Why Participate?</em></h4>
                        <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">

                        <p class="text-dark">Participating in the Marketing Olympiad is a great way for university
                            students to gain experience
                            and showcase their knowledge and skills in the field of marketing. By taking part in this
                            competition, students can test their abilities and get valuable feedback from experienced
                            marketing professionals. They can also gain insights into the latest trends and practices in
                            marketing by studying the competition cases and evaluating their peers&#39; work.
                            Additionally,
                            winners of the Marketing Olympiad can earn recognition and prizes, which can help them stand
                            out in the competitive job market and increase their chances of landing a job in the
                            marketing
                            field. Moreover, participating in such an event can help students build their confidence,
                            leadership skills, and team working abilities, which are all valuable qualities in the
                            workforce. It
                            also allows them to make new connections with other students, professionals, and
                            organizations
                            in the industry, which can provide them with valuable networking opportunities.</p>
                    </div>

                </div>
                <div class="col-lg-5">
                    <div class="right-image d-none d-lg-block">
                        <img src="https://images.squarespace-cdn.com/content/v1/5d5d7b7d27fded0001075c87/1588710061030-Y221V3BQB0N6JWUNISTQ/bigstock-Question-Mark-114454214.jpg"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 text-center" style="float:none;margin:auto;">
                    <img class="img-fluid" src="{{ asset('storage/logo/prize_pool.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>

    <div id="whoparticipate" class="pt-5 section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="right-image d-none d-lg-block">
                        <img src="https://static.vecteezy.com/system/resources/previews/010/893/912/original/person-people-question-mark-answer-illustration-concept-action-advice-ask-business-cartoon-faq-help-man-and-woman-background-problem-idea-confusion-human-think-banner-support-conversation-vector.jpg"
                            alt="">
                    </div>
                </div>
                <div class="col-lg-7 align-self-center">
                    <div class="section-heading">
                        <h4><em>Who Can Participate?</em></h4>
                        <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">

                        <p class="text-dark">The Marketing Olympiad is open to all-level University students across the
                            country who have a passion for marketing and are interested in showcasing their skills.
                            Students from any academic background can participate, as long as they have a good
                            understanding of marketing principles and concepts. This competition is designed to provide
                            students with a platform to showcase their creativity, innovation, and marketing skills,
                            regardless of their background. It also encourages diversity and inclusion, as it welcomes
                            students from all regions and demographics to participate. The only eligibility criteria are
                            that the participants must be currently enrolled in a university and should be at
                            least 18 years old at the time of registration.</p>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <div id="guidelines" class="participate section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 align-self-center">
                    <div class="section-heading">
                        <h4><em>Guidelines for Participating</em></h4>
                        <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">
                        <ol class="list-group">
                            <li class="list-group-item">Review and understand the rules and regulations before
                                registering for the competition.</li>
                            <li class="list-group-item">Register online through the official Marketing Olympiad
                                website.</li>
                            <li class="list-group-item">Provide accurate and complete information during the
                                registration process.</li>
                            <li class="list-group-item">Participate in the online quiz competition on the designated
                                date and time.</li>
                            <li class="list-group-item">Answer the quiz questions to the best of your ability.</li>
                            <li class="list-group-item">Adhere to the code of conduct and professional standards
                                expected of marketing professionals throughout the competition.</li>
                            <li class="list-group-item">The decision of the judges is final and cannot be contested.
                            </li>
                            <li class="list-group-item">Participants should ensure that they have a stable internet
                                connection and a suitable device to take the quiz.</li>
                            <li class="list-group-item">Participants should log in to the quiz platform at least 10
                                minutes before the start of the competition.</li>
                            <li class="list-group-item">Participants should read the instructions carefully and
                                understand the rules of the quiz before starting.</li>
                            <li class="list-group-item">Participants should avoid any form of cheating, including using
                                external resources or collaborating with others during the quiz.</li>
                            <li class="list-group-item">Participants should answer each question to the best of their
                                ability within the time limit provided.</li>
                            <li class="list-group-item">Participants should ensure that their answers are submitted
                                before the deadline.</li>
                            <li class="list-group-item">Participants should avoid discussing the quiz questions or
                                answers with others, as this could compromise the integrity of the competition.</li>
                            <li class="list-group-item">Participants should remain professional and courteous
                                throughout the competition, even if they experience technical difficulties or other
                                issues.</li>
                            <li class="list-group-item">Participants should understand that the quiz questions may
                                cover a wide range of marketing topics, and they should prepare accordingly by reviewing
                                marketing concepts and industry trends.</li>
                            <li class="list-group-item">Participants should take advantage of any resources or study
                                materials provided by the Marketing Olympiad organizers to help them prepare for the
                                quiz.</li>
                            </ol>
                            <a class="btn btn-primary mt-3" href="{{ asset('storage/Marketing-Olympiad-Registration-Pictorial.pdf') }}" download >Download Pictorial</a>
                    </div>

                </div>
                <div class="col-lg-5">
                    <div class="right-image">
                        <img src="https://static.vecteezy.com/system/resources/previews/001/991/640/original/guides-flat-design-concept-illustration-icon-user-manual-drafting-the-contract-how-to-requirements-specifications-document-abstract-metaphor-can-use-for-landing-page-mobile-app-free-vector.jpg"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="the-clients">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="section-heading">
                        <h4><em>Marketing Olympiad</em></h4>
                        <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">
                        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eismod tempor incididunt ut labore et dolore magna.</p> -->
                    </div>
                </div>
                {{-- <div class="col-lg-12 text-center">
                    <iframe width="1000" height="600" src="https://www.youtube.com/embed/mmiLdJxgKqE"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div> --}}

                <div class="col-md-8 text-center" style="float:none;margin:auto;">
                    <div class="embed-responsive embed-responsive-16by9 ratio ratio-16x9">
                        {{-- <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/mmiLdJxgKqE"></iframe> --}}
                        <iframe class="embed-responsive-item img-fluid"
                            src="https://www.youtube.com/embed/rC5AhYBpqgk" allowfullscreen></iframe>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div id="rules" class="the-clients">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="section-heading">
                        <h4><em>Rules & Regulation</em></h4>
                        <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">
                        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eismod tempor incididunt ut labore et dolore magna.</p> -->
                    </div>
                </div>
                <div class="col-lg-12">
                    <ol class="list-group">
                        <li class="list-group-item">Participants must be enrolled in a university at the time of registration.</li>
                            <li class="list-group-item">Participants have to compete individually.</li>
                            <li class="list-group-item">Participants must register online through the official Marketing Olympiad website.</li>
                            <li class="list-group-item">All participants must comply with the rules and regulations set by the Marketing Olympiad organizers.</li>
                            <li style="font-weight: bold" class="list-group-item">While participating in the online quiz for Marketing Olympiad, participants during the exam cannot copy the question in an attempt on using unfair means. </li>
                            <li style="font-weight: bold" class="list-group-item">Participants cannot open a new tab during the quiz, cannot minimize the browser, cannot lock the screen, cannot refresh the page, cannot take screenshots, and cannot log in from multiple devices.</li>
                            <li style="font-weight: bold" class="list-group-item">The above-mentioned regulations are applicable for any device from which the quiz is being participated (Laptop, Mobile, Tablet & PC).</li>
                            <li style="font-weight: bold" class="list-group-item">Attempting any of the above-mentioned will provide a warning and a second attempt will lead to a disqualification.</li>
                            <li style="font-weight: bold" class="list-group-item">One participant can only attempt the quiz once. </li>
                            <li class="list-group-item">Participants must abide by the competition timeline as mentioned.</li>
                            <li style="font-weight: bold" class="list-group-item">Plagiarism or any other form of academic misconduct is strictly prohibited and may result in disqualification.</li>
                            <li class="list-group-item">All information submitted becomes the property of the Marketing Olympiad organizers.</li>
                            <li class="list-group-item">The decision of the judges is final and cannot be contested.</li>
                            <li class="list-group-item">The Marketing Olympiad organizers reserve the right to disqualify any participant that violates the rules and regulations or engages in any unethical behavior.</li>
                            <li class="list-group-item">No negative scoring will be made on wrong answers. </li>
                            <li style="font-weight: bold" class="list-group-item">The quiz must be finished within the given timeframe. </li>
                            <li class="list-group-item">Participants must be at least 18 years old to compete in Marketing Olympiad.</li>
                            <li class="list-group-item">The competition is open to participants from any part of the country. </li>
                            <li style="font-weight: bold" class="list-group-item">The use of any unauthorized resources or external assistance is prohibited during the competition.</li>
                            <li class="list-group-item">Participants must provide accurate and complete information during the registration process.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div id="faq" class="the-clients">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="section-heading">
                        <h4><em>FAQ</em></h4>
                        <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">
                        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eismod tempor incididunt ut labore et dolore magna.</p> -->
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapse" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    What is Marketing Olympiad?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Marketing Olympiad is an annual competition that tests the marketing skills and
                                        knowledge of students from universities worldwide. It aims to
                                        provide a platform for students to showcase their marketing talent and learn
                                        from industry professionals.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Who can participate in Marketing Olympiad?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Marketing Olympiad is open to all students enrolled in universities worldwide. Participants can compete individually.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    How do I register for Marketing Olympiad?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Registration for Marketing Olympiad is done online through the official website.
                                        Interested participants can visit the website, create an account, and follow the
                                        registration process.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false"
                                    aria-controls="collapseFour">
                                    What are the competition categories in Marketing Olympiad?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Marketing Olympiad has several categories, including marketing strategy, digital
                                        marketing, brand management, advertising, and market research.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive" aria-expanded="false"
                                    aria-controls="collapseFive">
                                    How is the competition structured?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>The competition is divided into several rounds. The preliminary round is
                                        conducted online, and participants are required to complete a marketing case
                                        study within a specific time frame. The top-scoring participants from
                                        the preliminary round proceed to the semifinals, where they are given a more
                                        challenging marketing problem to solve. The finalists compete in a live event,
                                        where they present their marketing solutions to a panel of judges.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    What are the prizes for the winners?
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>The prizes for Marketing Olympiad vary depending on the category and level of
                                        competition. Cash prizes, certificates, and job offers from partner companies
                                        are some of the rewards given to the winners.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSeven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSeven" aria-expanded="false"
                                    aria-controls="collapseSeven">
                                    Who are the judges for Marketing Olympiad?
                                </button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse"
                                aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>The judges for Marketing Olympiad are industry professionals with expertise in
                                        marketing and related fields. They are selected based on their knowledge and
                                        experience in the industry.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingEight">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseEight" aria-expanded="false"
                                    aria-controls="collapseEight">
                                    How can I become a sponsor or partner of the Marketing Olympiad?
                                </button>
                            </h2>
                            <div id="collapseEight" class="accordion-collapse collapse"
                                aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Interested companies can contact the Marketing Olympiad team through the
                                        official website to inquire about sponsorship or partnership opportunities.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingNine">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseNine" aria-expanded="false"
                                    aria-controls="collapseNine">
                                    How can I prepare for Marketing Olympiad?
                                </button>
                            </h2>
                            <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Participants can prepare for Marketing Olympiad by studying marketing concepts
                                        and theories, practicing problem-solving skills, and keeping up with the latest
                                        trends in the industry.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTen">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                    Is there a fee to participate in Marketing Olympiad?
                                </button>
                            </h2>
                            <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>No, there is no fee to participate in Marketing Olympiad.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="about" class="about-us section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="section-heading">
                        <h4><em>About Marketing Olympiad</em></h4>
                        <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">

                        <p class="text-dark">The Marketing Olympiad is a national-level competition designed to promote
                            marketing knowledge and skills among university students. The competition evaluates
                            students' understanding of marketing principles and concepts, as well as their ability to
                            apply these concepts to real-life scenarios. The Marketing Olympiad is organized by a team
                            of experienced marketing professionals and educators who are passionate about promoting
                            marketing education and careers.</p>
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="right-image">
                        <img src="{{ asset('frontend/assets/images/banner.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="partner" class="the-clients">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="section-heading">
                        <h4><em>Partners</em></h4>
                        <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">
                        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eismod tempor incididunt ut labore et dolore magna.</p> -->
                    </div>
                </div>
                <div class="col-md-11 col-sm-12 text-center" style="float:none;margin:auto;">
                    <img class="img-fluid" src="{{ asset('storage/logo/logo_panel_8.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>

    <div id="calender" class="pricing-tables">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="section-heading">
                        <h4><em>Calender</em></h4>
                        <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">
                        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eismod tempor incididunt ut labore et dolore magna.</p> -->
                    </div>
                </div>
                @php
                    $round1 = strtoupper(date('j F', strtotime($exam->start_date_time)));
                    $round1end = strtoupper(date('j F', strtotime($exam->end_date_time)));
                    $round2 = strtoupper(date('j F', strtotime($exam->next_round_date)));
                    $round2end = strtoupper(date('j F', strtotime($exam->next_round_end_date)));
                    $botcamp = strtoupper(date('j F', strtotime($exam->bootcamp_date)));
                    $botcampend = strtoupper(date('j F', strtotime($exam->bootcamp_end_date)));
                    $round3 = strtoupper(date('j F', strtotime($exam->third_round_date)));
                    $round3end = strtoupper(date('j F', strtotime($exam->third_round_end_date)));
                @endphp
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="content">
                                <ul class="timeline-1 text-black">
                                    {{-- <li class="event" data-date="{{$round1}} - {{$round1end}}"> --}}
                                    <li class="event"
                                        data-date="@if ($round1 == $round1end) {{ $round1 }}
                                    @else
                                    {{ $round1 }} - {{ $round1end }} @endif">
                                        <h4 class="mb-3">Round One</h4>
                                        <p>Round one of the competition will consist of multiple-choice
                                            questions and logo recognition. Shortlisted candidates will be allowed for Round 2 of the Marketing Olympiad.</p>
                                    </li>
                                    <li class="event"
                                        data-date="@if ($round2 == $round2end) {{ $round2 }}
                                    @else
                                    {{ $round2 }} - {{ $round2end }} @endif">
                                        <h4 class="mb-3 pt-3">Round Two</h4>
                                        <p>Round Two of the competition will consist of multiple-choice
                                            questions and logo recognition.Shortlisted candidates will be participate for this round of the competition.</p>
                                    </li>
                                    <li class="event"
                                        data-date="@if ($botcamp == $botcampend) {{ $botcamp }}
                                    @else
                                    {{ $botcamp }} - {{ $botcampend }} @endif">
                                        <h4 class="mb-3 pt-3">Bootcamp</h4>
                                        <p>The top 100 Participants will get an opportunity to attend
                                            Marketing Olympiad Bootcamp, where they will be learning
                                            presentation grooming, voice coaching, case brief, report preparation &
                                            marketing-based theories and applications.</p>
                                    </li>
                                    <li class="event"
                                        data-date="@if ($round3 == $round3end) {{ $round3 }}
                                    @else
                                    {{ $round3 }} - {{ $round3end }} @endif">
                                        <h4 class="mb-3 pt-3">Round Three</h4>
                                        <p class="mb-0">The Top 100 Participants will submit a solution based on a
                                            given case-based problem.</p>
                                    </li>
                                    <li class="event" data-date="27 MAY">
                                        <h4 class="mb-3 pt-3">Grand Finale</h4>
                                        <p class="mb-0">The top 10 Participants will go through an eccentric gala
                                            round of the Marketing Olympiad. Winners will be declared through
                                            an extensive buzzer round.</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer id="newsletter">
        <div class="container">
            {{-- <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="section-heading">
                        <h4 class="border p-3">Marketing Olympiad</h4>
                    </div>
                </div> --}}
            <!-- <div class="col-lg-6 offset-lg-3">
          <form id="search" action="#" method="GET">
            <div class="row">
              <div class="col-lg-6 col-sm-6">
                <fieldset>
                  <input type="address" name="address" class="email" placeholder="Email Address..." autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-6 col-sm-6">
                <fieldset>
                  <button type="submit" class="main-button">Subscribe Now <i class="fa fa-angle-right"></i></button>
                </fieldset>
              </div>
            </div>
          </form>
        </div> -->
            {{-- </div> --}}
            <div class="row justify-content-between pt-5 mt-5">
                {{-- <div class="col-lg-3">
                    <div class="footer-widget"> --}}
                {{-- <h4>Map</h4> --}}
                <!-- <div class="logo">
              <img src="assets/images/logo.png" alt="">
            </div> -->
                {{-- <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.7511550848762!2d90.4098196146581!3d23.79187409310831!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c74647ffa317%3A0x1cad1ee337675c10!2sBangladesh%20BRAND%20FORUM!5e0!3m2!1sen!2sbd!4v1680415814060!5m2!1sen!2sbd"
                            width="400" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div> --}}
                <div class="col-lg-3 f">
                    <div class="footer-widget">
                        <h4>Contact Us</h4>
                        <p>Apartment No-9/A (Level-9), House No - 30 CWN (A), Road No - 42/43 Gulshan-2, Dhaka-1212,
                            Bangladesh</p>
                        <!--<p><a href="tel:+880 1712-732124">+880 1712-732124</a></p>-->
                        <p><a href="mailto:support@marketingolympiad.com">support@marketingolympiad.com</a></p>
                    </div>
                </div>
                <div class="col-lg-3 border-end h-50">
                    <div class="footer-widget">
                        <h4>About Us</h4>
                        <ul>
                            <li><a href="#top">Home</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#guidelines">Guidelines</a></li>
                            <li><a href="#rules">Rules & Regulation</a></li>
                        </ul>
                    </div>
                </div>

                <!-- <div class="col-lg-3">
          <div class="footer-widget">
            <h4>Useful Links</h4>
            <ul>
              <li><a href="#">Free Apps</a></li>
              <li><a href="#">App Engine</a></li>
              <li><a href="#">Programming</a></li>
              <li><a href="#">Development</a></li>
              <li><a href="#">App News</a></li>
            </ul>
            <ul>
              <li><a href="#">App Dev Team</a></li>
              <li><a href="#">Digital Web</a></li>
              <li><a href="#">Normal Apps</a></li>
            </ul>
          </div>
        </div> -->

                <div class="col-lg-3">
                    <div class="footer-widget">
                        {{-- <h4>About Us</h4> --}}
                        <ul>
                            <li><a href="#calender">Calender</a></li>
                            <li><a href="{{ route('student.round.one.final.result') }}" target="_blank">Result</a></li>
                            <!--<li><a href="#rules">Rules & Regulation</a></li>-->
                            <!--<li><a href="#calender">Calender</a></li>-->
                        </ul>
                        <!-- <ul>
              <li><a href="#">About</a></li>
              <li><a href="#">Testimonials</a></li>
              <li><a href="#">Pricing</a></li>
            </ul> -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        @if (!empty($social->facebook))
                            <a style="font-size: 30px;color: white;" href="{{ $social->facebook }}"
                                target="_blank"><i class="fab fa-facebook-f mx-2" aria-hidden="true"></i></a>
                        @endif
                        @if (!empty($social->instagram))
                            <a style="font-size: 30px;color: white;" href="{{ $social->instagram }}"
                                target="_blank"><i class="fab fa-instagram mx-2"></i></a>
                        @endif
                        @if (!empty($social->linkedin))
                            <a style="font-size: 30px;color: white;" href="{{ $social->linkedin }}"
                                target="_blank"><i class="fab fa-linkedin-in mx-2" aria-hidden="true"></i></a>
                        @endif
                        @if (!empty($social->youtube))
                            <a style="font-size: 30px;color: white;" href="{{ $social->youtube }}"
                                target="_blank"><i class="fab fa-youtube mx-2" aria-hidden="true"></i></a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="copyright-text">
                        <p>{{ $theme->copyright }}</p>
                        <!-- <br>Design: <a href="https://templatemo.com/" target="_blank" title="css templates">TemplateMo</a></p> -->
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="copyright-text">
                        <p style="margin-top:15px !important" class="text-uppercase">Design & Developed by <a href="https://webolutionbd.com/" target="_blank"><u>Webolution BD</u></a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!-- Scripts -->
    <script src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/animation.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/imagesloaded.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/popup.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('admin/assets/js/script.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/custom.js') }}"></script>
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

        // my next birthday
        const newDate = new Date("{{ $exam->start_date_time }}").getTime()
        const countdown = setInterval(() => {

            const date = new Date().getTime()
            const diff = newDate - date

            if (diff <= 0) {
                clearInterval(countdown);
                return false;
            }

            // const month = Math.floor((diff % (1000 * 60 * 60 * 24 * (365.25 / 12) * 365)) / (1000 * 60 * 60 * 24 * (
            //     365.25 / 12)))
            const days = Math.floor(diff % (1000 * 60 * 60 * 24 * (365.25 / 12)) / (1000 * 60 * 60 * 24))
            const hours = Math.floor(diff % (1000 * 60 * 60 * 24) / (1000 * 60 * 60))
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60))
            const seconds = Math.floor((diff % (1000 * 60)) / 1000)

            document.querySelector(".seconds").innerHTML = seconds < 10 ? '0' + seconds : seconds
            document.querySelector(".minutes").innerHTML = minutes < 10 ? '0' + minutes : minutes
            document.querySelector(".hours").innerHTML = hours < 10 ? '0' + hours : hours
            document.querySelector(".days").innerHTML = days < 10 ? '0' + days : days
            // document.querySelector(".months").innerHTML = month < 10 ? '0' + month : month
        }, 1000)
    </script>
</body>

</html>
