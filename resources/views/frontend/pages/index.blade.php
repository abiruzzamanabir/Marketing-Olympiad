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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
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
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/css.scss') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animated.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/feathericon.min.css') }}">

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
                            <img src="{{ asset('storage/logo/logo_landing.png') }}" height="70px" alt="Chain App Dev">
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
                                            @if (in_array('round-2', json_decode(Auth::guard('admin')->user()->role->permission)) &&
                                                    Auth::guard('admin')->user()->selected == true)
                                                <a class="dropdown-item"
                                                    @if (Auth::guard('admin')->user()->round_two_status == false) style="cursor:pointer;" data-bs-toggle="modal"
                                            data-bs-target="#rulesModal" @else href="{{ route('round.two') }}" @endif>Round
                                                    Two</a>
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
                        <div class="one_half last"><a href="{{ route('student-register.index') }}" class="btn btn_red">Sign
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
                        <p class="text-dark">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Modi, dolorem,
                            quas
                            praesentium omnis vitae eligendi nisi iure perspiciatis accusamus consectetur voluptates
                            dolores
                            debitis ad accusantium reiciendis voluptate rerum cumque eaque?
                            Corporis magnam voluptatem laudantium nostrum iusto sint quisquam dolores tenetur, hic neque
                            atque optio. Distinctio voluptate recusandae, consectetur at dolorum odit, adipisci ipsa
                            quam
                            quidem officia libero tempora laudantium temporibus?
                            Accusamus facilis, exercitationem quaerat recusandae voluptas libero, sed quasi nisi,
                            maiores
                            explicabo deleniti fuga delectus quidem sunt maxime officia! Assumenda, aliquam accusamus
                            numquam quas et dolorum magnam velit temporibus modi?
                            Atque quod delectus sapiente ab consectetur obcaecati, distinctio ipsum repudiandae.
                            Expedita
                            maiores sint cumque perspiciatis quod sed ipsa porro vitae at vel, ratione provident? Quo
                            beatae
                            totam illo ullam consequatur.
                            Ducimus fuga iure voluptatem, ullam possimus, autem mollitia voluptatibus unde quidem et
                            reprehenderit ex repudiandae temporibus, quod numquam soluta corrupti at similique aliquid
                            dolore dignissimos alias tempora laborum esse? Porro.</p>
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

                        <p class="text-dark">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt, facilis
                            reprehenderit facere voluptatem aut exercitationem rem soluta id est, illum ex harum numquam
                            beatae! Vero quos impedit aut et necessitatibus?
                            Magni deleniti atque debitis rem voluptas sapiente necessitatibus sunt unde ad sed? Veniam
                            eius quod facilis nihil mollitia recusandae hic expedita reprehenderit delectus aspernatur,
                            tenetur ut sed soluta, incidunt repellat.
                            Non ratione quae laboriosam excepturi dolorum officiis ducimus fugit iusto, harum deserunt
                            cum nulla odio, saepe inventore minus, ipsa ex delectus nihil dignissimos sequi? Quam et
                            aperiam cum impedit fuga.
                            Corrupti perferendis sequi quaerat nulla neque! Recusandae et a voluptatem nobis ratione
                            inventore, voluptatum aut aperiam sapiente eligendi assumenda tempore quaerat itaque placeat
                            unde ipsa facilis cupiditate voluptatibus perspiciatis beatae!
                            Autem aliquid doloremque, veniam fuga, reiciendis molestiae sunt optio tempore aperiam,
                            maiores ad quasi obcaecati deserunt quam quisquam voluptates ipsum in quos soluta rerum
                            nobis ea. Minus tempora magnam molestias!</p>
                    </div>

                </div>
                <div class="col-lg-5">
                    <div class="right-image">
                        <img src="https://images.squarespace-cdn.com/content/v1/5d5d7b7d27fded0001075c87/1588710061030-Y221V3BQB0N6JWUNISTQ/bigstock-Question-Mark-114454214.jpg"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="whoparticipate" class="participate section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="right-image">
                        <img src="https://static.vecteezy.com/system/resources/previews/010/893/912/original/person-people-question-mark-answer-illustration-concept-action-advice-ask-business-cartoon-faq-help-man-and-woman-background-problem-idea-confusion-human-think-banner-support-conversation-vector.jpg"
                            alt="">
                    </div>
                </div>
                <div class="col-lg-7 align-self-center">
                    <div class="section-heading">
                        <h4><em>Who Can Participate?</em></h4>
                        <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">

                        <p class="text-dark">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt, facilis
                            reprehenderit facere voluptatem aut exercitationem rem soluta id est, illum ex harum numquam
                            beatae! Vero quos impedit aut et necessitatibus?
                            Magni deleniti atque debitis rem voluptas sapiente necessitatibus sunt unde ad sed? Veniam
                            eius quod facilis nihil mollitia recusandae hic expedita reprehenderit delectus aspernatur,
                            tenetur ut sed soluta, incidunt repellat.
                            Non ratione quae laboriosam excepturi dolorum officiis ducimus fugit iusto, harum deserunt
                            cum nulla odio, saepe inventore minus, ipsa ex delectus nihil dignissimos sequi? Quam et
                            aperiam cum impedit fuga.
                            Corrupti perferendis sequi quaerat nulla neque! Recusandae et a voluptatem nobis ratione
                            inventore, voluptatum aut aperiam sapiente eligendi assumenda tempore quaerat itaque placeat
                            unde ipsa facilis cupiditate voluptatibus perspiciatis beatae!
                            Autem aliquid doloremque, veniam fuga, reiciendis molestiae sunt optio tempore aperiam,
                            maiores ad quasi obcaecati deserunt quam quisquam voluptates ipsum in quos soluta rerum
                            nobis ea. Minus tempora magnam molestias!</p>
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
                        <p class="text-dark">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt, facilis
                            reprehenderit facere voluptatem aut exercitationem rem soluta id est, illum ex harum numquam
                            beatae! Vero quos impedit aut et necessitatibus?
                            Magni deleniti atque debitis rem voluptas sapiente necessitatibus sunt unde ad sed? Veniam
                            eius quod facilis nihil mollitia recusandae hic expedita reprehenderit delectus aspernatur,
                            tenetur ut sed soluta, incidunt repellat.
                            Non ratione quae laboriosam excepturi dolorum officiis ducimus fugit iusto, harum deserunt
                            cum nulla odio, saepe inventore minus, ipsa ex delectus nihil dignissimos sequi? Quam et
                            aperiam cum impedit fuga.
                            Corrupti perferendis sequi quaerat nulla neque! Recusandae et a voluptatem nobis ratione
                            inventore, voluptatum aut aperiam sapiente eligendi assumenda tempore quaerat itaque placeat
                            unde ipsa facilis cupiditate voluptatibus perspiciatis beatae!
                            Autem aliquid doloremque, veniam fuga, reiciendis molestiae sunt optio tempore aperiam,
                            maiores ad quasi obcaecati deserunt quam quisquam voluptates ipsum in quos soluta rerum
                            nobis ea. Minus tempora magnam molestias!</p>
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
                        <h4><em>Tips & Tricks for Marketing Olympiad</em></h4>
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

                <div class="col-md-12 text-center">
                    <div class="embed-responsive embed-responsive-16by9 ratio ratio-16x9">
                        {{-- <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/mmiLdJxgKqE"></iframe> --}}
                        <iframe class="embed-responsive-item img-fluid"
                            src="https://www.youtube.com/embed/mmiLdJxgKqE" allowfullscreen></iframe>
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
                    <p style="text-align: justify !important" class="text-dark">Lorem ipsum dolor sit amet consectetur
                        adipisicing elit. Eaque sed libero
                        deserunt totam, ab sit unde asperiores tenetur vero, sequi excepturi sunt labore voluptatem
                        cumque? Ratione officia quisquam excepturi porro.
                        Debitis dolor harum consectetur. Incidunt fugit, id quia perferendis officia cumque quos
                        explicabo quas, pariatur ipsa, vero iusto laborum deserunt quaerat? Ab enim molestias ipsum
                        ullam magni. Dignissimos, mollitia nihil!
                        Laboriosam natus culpa, rerum commodi, rem consequatur adipisci fugiat ratione ea itaque
                        voluptatum non beatae eius quia excepturi, repudiandae veritatis quaerat magni unde aperiam sit
                        aliquam expedita eveniet sequi. Dolore.
                        Inventore, excepturi quasi? Nemo, omnis officiis? Quia doloribus reprehenderit est provident
                        esse reiciendis eum ratione, eius fugit suscipit numquam molestias illo animi excepturi iure
                        laudantium unde? Rem inventore asperiores molestias?
                        Iusto, architecto nam blanditiis praesentium exercitationem aperiam. Quidem, recusandae ab? Sint
                        qui maiores ullam fuga debitis autem odio quasi similique inventore dicta officiis
                        necessitatibus iusto distinctio libero maxime, aliquid quam?
                        Accusantium tempore laudantium quam suscipit obcaecati, reprehenderit animi fugiat consectetur
                        ea, alias quis natus ex tempora itaque cumque quos ut sint sapiente incidunt dolores debitis
                        unde. Tempora inventore eos eligendi.
                        Eius reiciendis iste rerum atque est, nam minus officiis ratione! Natus obcaecati, voluptatum
                        quis dignissimos soluta veritatis fugit hic harum temporibus aspernatur tempora, quidem dolore
                        asperiores impedit provident dolor optio.
                        Ab sit velit eligendi at harum rem, libero sapiente ex officia, distinctio aut! Nostrum
                        voluptate perspiciatis accusamus est sit! Minus amet odit fuga sunt dolor deleniti, hic porro
                        vero fugiat!
                        Suscipit magni tenetur ullam saepe dolorem quisquam quod nulla nemo labore! Ratione illum iste
                        facere quam cumque deserunt, est odit provident error placeat doloribus, fugit consequatur
                        inventore, delectus mollitia? Debitis?
                        Omnis eos minus facere adipisci tenetur aspernatur laboriosam eligendi fuga numquam voluptatem
                        vero quia reprehenderit eius repudiandae consequatur, commodi odit accusantium aut et
                        dignissimos illum ex neque? Sint, voluptatibus quisquam.</p>
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
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    FAQ 1
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia minima
                                        aspernatur alias quas accusamus ad illum rem. Omnis recusandae doloribus nulla,
                                        quidem molestiae reprehenderit magnam ipsum, ea odit voluptas sequi.
                                        Quod tempore eum soluta inventore vel quas, nisi at doloribus suscipit hic vitae
                                        ipsum quaerat, laborum commodi dolorum tempora assumenda et voluptates
                                        aspernatur rerum ea! Soluta iste dicta molestiae rerum?
                                        Nam, sequi dicta consectetur atque esse, voluptatum dolorem porro fugit maxime
                                        nemo eveniet rerum natus, beatae ipsum quas? Odit excepturi, perferendis
                                        corrupti autem dignissimos sunt sapiente architecto magni? Nesciunt, libero.
                                        Porro quas nesciunt nostrum culpa fuga laborum accusamus, ratione sed quo
                                        adipisci eos aspernatur sunt repellendus? Dicta libero, magni facilis
                                        asperiores, quisquam dolor doloribus dignissimos quaerat sit impedit praesentium
                                        tenetur.
                                        Placeat tempora sint perferendis ex ullam labore hic qui. Veritatis, iure
                                        perspiciatis! Eaque quae hic, cupiditate quis, et maxime cum perspiciatis dolore
                                        fugiat reprehenderit ratione! Tenetur quasi amet iure! Animi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    FAQ 2
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia minima
                                        aspernatur alias quas accusamus ad illum rem. Omnis recusandae doloribus nulla,
                                        quidem molestiae reprehenderit magnam ipsum, ea odit voluptas sequi.
                                        Quod tempore eum soluta inventore vel quas, nisi at doloribus suscipit hic vitae
                                        ipsum quaerat, laborum commodi dolorum tempora assumenda et voluptates
                                        aspernatur rerum ea! Soluta iste dicta molestiae rerum?
                                        Nam, sequi dicta consectetur atque esse, voluptatum dolorem porro fugit maxime
                                        nemo eveniet rerum natus, beatae ipsum quas? Odit excepturi, perferendis
                                        corrupti autem dignissimos sunt sapiente architecto magni? Nesciunt, libero.
                                        Porro quas nesciunt nostrum culpa fuga laborum accusamus, ratione sed quo
                                        adipisci eos aspernatur sunt repellendus? Dicta libero, magni facilis
                                        asperiores, quisquam dolor doloribus dignissimos quaerat sit impedit praesentium
                                        tenetur.
                                        Placeat tempora sint perferendis ex ullam labore hic qui. Veritatis, iure
                                        perspiciatis! Eaque quae hic, cupiditate quis, et maxime cum perspiciatis dolore
                                        fugiat reprehenderit ratione! Tenetur quasi amet iure! Animi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    FAQ 3
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia minima
                                        aspernatur alias quas accusamus ad illum rem. Omnis recusandae doloribus nulla,
                                        quidem molestiae reprehenderit magnam ipsum, ea odit voluptas sequi.
                                        Quod tempore eum soluta inventore vel quas, nisi at doloribus suscipit hic vitae
                                        ipsum quaerat, laborum commodi dolorum tempora assumenda et voluptates
                                        aspernatur rerum ea! Soluta iste dicta molestiae rerum?
                                        Nam, sequi dicta consectetur atque esse, voluptatum dolorem porro fugit maxime
                                        nemo eveniet rerum natus, beatae ipsum quas? Odit excepturi, perferendis
                                        corrupti autem dignissimos sunt sapiente architecto magni? Nesciunt, libero.
                                        Porro quas nesciunt nostrum culpa fuga laborum accusamus, ratione sed quo
                                        adipisci eos aspernatur sunt repellendus? Dicta libero, magni facilis
                                        asperiores, quisquam dolor doloribus dignissimos quaerat sit impedit praesentium
                                        tenetur.
                                        Placeat tempora sint perferendis ex ullam labore hic qui. Veritatis, iure
                                        perspiciatis! Eaque quae hic, cupiditate quis, et maxime cum perspiciatis dolore
                                        fugiat reprehenderit ratione! Tenetur quasi amet iure! Animi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false"
                                    aria-controls="collapseFour">
                                    FAQ 4
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia minima
                                        aspernatur alias quas accusamus ad illum rem. Omnis recusandae doloribus nulla,
                                        quidem molestiae reprehenderit magnam ipsum, ea odit voluptas sequi.
                                        Quod tempore eum soluta inventore vel quas, nisi at doloribus suscipit hic vitae
                                        ipsum quaerat, laborum commodi dolorum tempora assumenda et voluptates
                                        aspernatur rerum ea! Soluta iste dicta molestiae rerum?
                                        Nam, sequi dicta consectetur atque esse, voluptatum dolorem porro fugit maxime
                                        nemo eveniet rerum natus, beatae ipsum quas? Odit excepturi, perferendis
                                        corrupti autem dignissimos sunt sapiente architecto magni? Nesciunt, libero.
                                        Porro quas nesciunt nostrum culpa fuga laborum accusamus, ratione sed quo
                                        adipisci eos aspernatur sunt repellendus? Dicta libero, magni facilis
                                        asperiores, quisquam dolor doloribus dignissimos quaerat sit impedit praesentium
                                        tenetur.
                                        Placeat tempora sint perferendis ex ullam labore hic qui. Veritatis, iure
                                        perspiciatis! Eaque quae hic, cupiditate quis, et maxime cum perspiciatis dolore
                                        fugiat reprehenderit ratione! Tenetur quasi amet iure! Animi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive" aria-expanded="false"
                                    aria-controls="collapseFive">
                                    FAQ 5
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia minima
                                        aspernatur alias quas accusamus ad illum rem. Omnis recusandae doloribus nulla,
                                        quidem molestiae reprehenderit magnam ipsum, ea odit voluptas sequi.
                                        Quod tempore eum soluta inventore vel quas, nisi at doloribus suscipit hic vitae
                                        ipsum quaerat, laborum commodi dolorum tempora assumenda et voluptates
                                        aspernatur rerum ea! Soluta iste dicta molestiae rerum?
                                        Nam, sequi dicta consectetur atque esse, voluptatum dolorem porro fugit maxime
                                        nemo eveniet rerum natus, beatae ipsum quas? Odit excepturi, perferendis
                                        corrupti autem dignissimos sunt sapiente architecto magni? Nesciunt, libero.
                                        Porro quas nesciunt nostrum culpa fuga laborum accusamus, ratione sed quo
                                        adipisci eos aspernatur sunt repellendus? Dicta libero, magni facilis
                                        asperiores, quisquam dolor doloribus dignissimos quaerat sit impedit praesentium
                                        tenetur.
                                        Placeat tempora sint perferendis ex ullam labore hic qui. Veritatis, iure
                                        perspiciatis! Eaque quae hic, cupiditate quis, et maxime cum perspiciatis dolore
                                        fugiat reprehenderit ratione! Tenetur quasi amet iure! Animi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    FAQ 6
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia minima
                                        aspernatur alias quas accusamus ad illum rem. Omnis recusandae doloribus nulla,
                                        quidem molestiae reprehenderit magnam ipsum, ea odit voluptas sequi.
                                        Quod tempore eum soluta inventore vel quas, nisi at doloribus suscipit hic vitae
                                        ipsum quaerat, laborum commodi dolorum tempora assumenda et voluptates
                                        aspernatur rerum ea! Soluta iste dicta molestiae rerum?
                                        Nam, sequi dicta consectetur atque esse, voluptatum dolorem porro fugit maxime
                                        nemo eveniet rerum natus, beatae ipsum quas? Odit excepturi, perferendis
                                        corrupti autem dignissimos sunt sapiente architecto magni? Nesciunt, libero.
                                        Porro quas nesciunt nostrum culpa fuga laborum accusamus, ratione sed quo
                                        adipisci eos aspernatur sunt repellendus? Dicta libero, magni facilis
                                        asperiores, quisquam dolor doloribus dignissimos quaerat sit impedit praesentium
                                        tenetur.
                                        Placeat tempora sint perferendis ex ullam labore hic qui. Veritatis, iure
                                        perspiciatis! Eaque quae hic, cupiditate quis, et maxime cum perspiciatis dolore
                                        fugiat reprehenderit ratione! Tenetur quasi amet iure! Animi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSeven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSeven" aria-expanded="false"
                                    aria-controls="collapseSeven">
                                    FAQ 7
                                </button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse"
                                aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia minima
                                        aspernatur alias quas accusamus ad illum rem. Omnis recusandae doloribus nulla,
                                        quidem molestiae reprehenderit magnam ipsum, ea odit voluptas sequi.
                                        Quod tempore eum soluta inventore vel quas, nisi at doloribus suscipit hic vitae
                                        ipsum quaerat, laborum commodi dolorum tempora assumenda et voluptates
                                        aspernatur rerum ea! Soluta iste dicta molestiae rerum?
                                        Nam, sequi dicta consectetur atque esse, voluptatum dolorem porro fugit maxime
                                        nemo eveniet rerum natus, beatae ipsum quas? Odit excepturi, perferendis
                                        corrupti autem dignissimos sunt sapiente architecto magni? Nesciunt, libero.
                                        Porro quas nesciunt nostrum culpa fuga laborum accusamus, ratione sed quo
                                        adipisci eos aspernatur sunt repellendus? Dicta libero, magni facilis
                                        asperiores, quisquam dolor doloribus dignissimos quaerat sit impedit praesentium
                                        tenetur.
                                        Placeat tempora sint perferendis ex ullam labore hic qui. Veritatis, iure
                                        perspiciatis! Eaque quae hic, cupiditate quis, et maxime cum perspiciatis dolore
                                        fugiat reprehenderit ratione! Tenetur quasi amet iure! Animi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingEight">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseEight" aria-expanded="false"
                                    aria-controls="collapseEight">
                                    FAQ 8
                                </button>
                            </h2>
                            <div id="collapseEight" class="accordion-collapse collapse"
                                aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia minima
                                        aspernatur alias quas accusamus ad illum rem. Omnis recusandae doloribus nulla,
                                        quidem molestiae reprehenderit magnam ipsum, ea odit voluptas sequi.
                                        Quod tempore eum soluta inventore vel quas, nisi at doloribus suscipit hic vitae
                                        ipsum quaerat, laborum commodi dolorum tempora assumenda et voluptates
                                        aspernatur rerum ea! Soluta iste dicta molestiae rerum?
                                        Nam, sequi dicta consectetur atque esse, voluptatum dolorem porro fugit maxime
                                        nemo eveniet rerum natus, beatae ipsum quas? Odit excepturi, perferendis
                                        corrupti autem dignissimos sunt sapiente architecto magni? Nesciunt, libero.
                                        Porro quas nesciunt nostrum culpa fuga laborum accusamus, ratione sed quo
                                        adipisci eos aspernatur sunt repellendus? Dicta libero, magni facilis
                                        asperiores, quisquam dolor doloribus dignissimos quaerat sit impedit praesentium
                                        tenetur.
                                        Placeat tempora sint perferendis ex ullam labore hic qui. Veritatis, iure
                                        perspiciatis! Eaque quae hic, cupiditate quis, et maxime cum perspiciatis dolore
                                        fugiat reprehenderit ratione! Tenetur quasi amet iure! Animi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingNine">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseNine" aria-expanded="false"
                                    aria-controls="collapseNine">
                                    FAQ 9
                                </button>
                            </h2>
                            <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia minima
                                        aspernatur alias quas accusamus ad illum rem. Omnis recusandae doloribus nulla,
                                        quidem molestiae reprehenderit magnam ipsum, ea odit voluptas sequi.
                                        Quod tempore eum soluta inventore vel quas, nisi at doloribus suscipit hic vitae
                                        ipsum quaerat, laborum commodi dolorum tempora assumenda et voluptates
                                        aspernatur rerum ea! Soluta iste dicta molestiae rerum?
                                        Nam, sequi dicta consectetur atque esse, voluptatum dolorem porro fugit maxime
                                        nemo eveniet rerum natus, beatae ipsum quas? Odit excepturi, perferendis
                                        corrupti autem dignissimos sunt sapiente architecto magni? Nesciunt, libero.
                                        Porro quas nesciunt nostrum culpa fuga laborum accusamus, ratione sed quo
                                        adipisci eos aspernatur sunt repellendus? Dicta libero, magni facilis
                                        asperiores, quisquam dolor doloribus dignissimos quaerat sit impedit praesentium
                                        tenetur.
                                        Placeat tempora sint perferendis ex ullam labore hic qui. Veritatis, iure
                                        perspiciatis! Eaque quae hic, cupiditate quis, et maxime cum perspiciatis dolore
                                        fugiat reprehenderit ratione! Tenetur quasi amet iure! Animi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTen">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                    FAQ 10
                                </button>
                            </h2>
                            <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia minima
                                        aspernatur alias quas accusamus ad illum rem. Omnis recusandae doloribus nulla,
                                        quidem molestiae reprehenderit magnam ipsum, ea odit voluptas sequi.
                                        Quod tempore eum soluta inventore vel quas, nisi at doloribus suscipit hic vitae
                                        ipsum quaerat, laborum commodi dolorum tempora assumenda et voluptates
                                        aspernatur rerum ea! Soluta iste dicta molestiae rerum?
                                        Nam, sequi dicta consectetur atque esse, voluptatum dolorem porro fugit maxime
                                        nemo eveniet rerum natus, beatae ipsum quas? Odit excepturi, perferendis
                                        corrupti autem dignissimos sunt sapiente architecto magni? Nesciunt, libero.
                                        Porro quas nesciunt nostrum culpa fuga laborum accusamus, ratione sed quo
                                        adipisci eos aspernatur sunt repellendus? Dicta libero, magni facilis
                                        asperiores, quisquam dolor doloribus dignissimos quaerat sit impedit praesentium
                                        tenetur.
                                        Placeat tempora sint perferendis ex ullam labore hic qui. Veritatis, iure
                                        perspiciatis! Eaque quae hic, cupiditate quis, et maxime cum perspiciatis dolore
                                        fugiat reprehenderit ratione! Tenetur quasi amet iure! Animi.</p>
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

                        <p class="text-dark">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt, facilis
                            reprehenderit facere voluptatem aut exercitationem rem soluta id est, illum ex harum numquam
                            beatae! Vero quos impedit aut et necessitatibus?
                            Magni deleniti atque debitis rem voluptas sapiente necessitatibus sunt unde ad sed? Veniam
                            eius quod facilis nihil mollitia recusandae hic expedita reprehenderit delectus aspernatur,
                            tenetur ut sed soluta, incidunt repellat.
                            Non ratione quae laboriosam excepturi dolorum officiis ducimus fugit iusto, harum deserunt
                            cum nulla odio, saepe inventore minus, ipsa ex delectus nihil dignissimos sequi? Quam et
                            aperiam cum impedit fuga.
                            Corrupti perferendis sequi quaerat nulla neque! Recusandae et a voluptatem nobis ratione
                            inventore, voluptatum aut aperiam sapiente eligendi assumenda tempore quaerat itaque placeat
                            unde ipsa facilis cupiditate voluptatibus perspiciatis beatae!
                            Autem aliquid doloremque, veniam fuga, reiciendis molestiae sunt optio tempore aperiam,
                            maiores ad quasi obcaecati deserunt quam quisquam voluptates ipsum in quos soluta rerum
                            nobis ea. Minus tempora magnam molestias!</p>
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
                <div class="col-lg-12 text-center">
                    <img style="height: 100px; width: auto" src="{{ asset('storage/logo/logo_panel.png') }}"
                        alt="">
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
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="content">
                                <ul class="timeline-1 text-black">
                                    <li class="event" data-date="1 MAY">
                                        <h4 class="mb-3">Registration</h4>
                                        <p>Get here on time, it's first come first serve. Be late, get turned away.</p>
                                    </li>
                                    <li class="event" data-date="2 MAY">
                                        <h4 class="mb-3 pt-3">Opening Ceremony</h4>
                                        <p>Get ready for an exciting event, this will kick off in amazing fashion with
                                            MOP &amp; Busta
                                            Rhymes as an opening show.</p>
                                    </li>
                                    <li class="event" data-date="3 MAY">
                                        <h4 class="mb-3 pt-3">Main Event</h4>
                                        <p>This is where it all goes down. You will compete head to head with your
                                            friends and rivals. Get
                                            ready!</p>
                                    </li>
                                    <li class="event" data-date="4 MAY">
                                        <h4 class="mb-3 pt-3">Closing Ceremony</h4>
                                        <p class="mb-0">See how is the victor and who are the losers. The big stage
                                            is where the winners
                                            bask in their
                                            own glory.</p>
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
                        <p><a href="tel:+880 1712-732124">+880 1712-732124</a></p>
                        <p><a href="mailto:support@marketingolympiad.com">support@marketingolympiad.com</a></p>
                    </div>
                </div>
                <div class="col-lg-3 border-end h-50">
                    <div class="footer-widget">
                        <h4>About Us</h4>
                        <ul>
                            <li><a href="#top">Home</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#rules">Guidelines</a></li>
                            <li><a href="#calender">Rules & Regulation</a></li>
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
                            <li><a href="#top">Calender</a></li>
                            <li><a href="#about">Result</a></li>
                            <li><a href="#rules">Rules & Regulation</a></li>
                            <li><a href="#calender">Calender</a></li>
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
                            <a style="font-size: 30px;color: white;" href="{{ $social->facebook }}" target="_blank"><i
                                    class="fab fa-facebook-f mx-2" aria-hidden="true"></i></a>
                        @endif
                        @if (!empty($social->instagram))
                        <a style="font-size: 30px;color: white;" href="{{ $social->instagram }}" target="_blank"><i
                            class="fab fa-instagram mx-2"></i></a>
                        @endif
                        @if (!empty($social->linkedin))
                        <a style="font-size: 30px;color: white;" href="{{ $social->linkedin }}" target="_blank"><i class="fab fa-linkedin-in mx-2"
                            aria-hidden="true"></i></a>
                        @endif
                        @if (!empty($social->youtube))
                        <a style="font-size: 30px;color: white;" href="{{ $social->youtube }}" target="_blank"><i class="fab fa-youtube mx-2"
                            aria-hidden="true"></i></a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="copyright-text">
                        <p>Copyright © 2023 Marketing Olympiad. All Rights Reserved.
                            <!-- <br>Design: <a href="https://templatemo.com/" target="_blank" title="css templates">TemplateMo</a></p> -->
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

            if (diff == 0) {
                clearInterval(countdown)
                document.querySelector(".countdown").innerHTML = 'Exam Running'
            }

        }, 1000)
    </script>
</body>

</html>
