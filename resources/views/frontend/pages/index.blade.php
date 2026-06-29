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
    {{-- <link rel="stylesheet" href="{{ asset('frontend/assets/css/css.scss') }}"> --}}
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animated.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/feathericon.min.css') }}">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-PDVVF7FEYN"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-PDVVF7FEYN');
    </script>

    <!-- Meta Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1211486769503562');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=1211486769503562&ev=PageView&noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->
    <style>
        /* Add some custom styles for the modal */
        .modal-content {
            background-color: transparent;
            border: none;
        }

        .modal-dialog {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) !important;
            max-width: 100%;
            width: auto;
            max-height: 90vh;

        }

        .modal-body {
            text-align: center;
            padding: 0;
        }

        .modal-body img {
            max-width: 100%;
            height: auto;
        }

        .exit-button {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            color: #000;
            font-size: 24px;
            z-index: 999;
        }

        @media(max-width: 768px) {
            .modal-dialog {
                min-width: 90vw;
                width: auto;
                max-height: auto;

            }
        }


        /* Premium Exam Status Section */
        .exam-status-section {
            padding: 90px 20px 80px;
            position: relative;
            overflow: hidden;
            background: radial-gradient(circle at top center, rgba(62, 201, 255, 0.20), transparent 34%),
                linear-gradient(135deg, #f8fbff 0%, #eef7ff 52%, #ffffff 100%);
        }

        .exam-status-section::before,
        .exam-status-section::after {
            content: "";
            position: absolute;
            border-radius: 999px;
            filter: blur(6px);
            opacity: 0.65;
            pointer-events: none;
        }

        .exam-status-section::before {
            width: 190px;
            height: 190px;
            top: 20px;
            left: 10%;
            background: rgba(47, 155, 255, 0.12);
            animation: premiumFloat 7s ease-in-out infinite;
        }

        .exam-status-section::after {
            width: 150px;
            height: 150px;
            right: 12%;
            bottom: 35px;
            background: rgba(110, 231, 249, 0.16);
            animation: premiumFloat 8s ease-in-out infinite reverse;
        }

        .exam-status-card {
            max-width: 610px;
            margin: auto;
            padding: 48px 38px;
            border-radius: 32px;
            background: rgba(255, 255, 255, 0.86);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            box-shadow: 0 28px 80px rgba(0, 105, 210, 0.15);
            text-align: center;
            position: relative;
            z-index: 2;
            animation: premiumFadeUp 0.9s ease forwards;
        }

        .exam-status-card::before {
            content: "";
            position: absolute;
            inset: -2px;
            border-radius: 34px;
            padding: 2px;
            background: linear-gradient(135deg, rgba(47, 155, 255, 0.75), rgba(110, 231, 249, 0.55), rgba(255, 255, 255, 0.2));
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
        }

        .exam-status-card::after {
            content: "";
            position: absolute;
            width: 135px;
            height: 5px;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 0 0 999px 999px;
            background: linear-gradient(90deg, #168cff, #32c5ff);
            box-shadow: 0 10px 35px rgba(22, 140, 255, 0.35);
        }

        .exam-glow {
            position: absolute;
            width: 280px;
            height: 280px;
            background: rgba(50, 197, 255, 0.18);
            border-radius: 50%;
            filter: blur(22px);
            top: -120px;
            left: 50%;
            transform: translateX(-50%);
            animation: premiumGlow 5s ease-in-out infinite;
            pointer-events: none;
        }

        .exam-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 20px;
            border-radius: 999px;
            background: linear-gradient(135deg, #e9f6ff, #ffffff);
            color: #147edc;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 18px;
            box-shadow: inset 0 0 0 1px rgba(22, 140, 255, 0.10);
            animation: premiumPulse 2.3s infinite;
        }

        .exam-badge::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #25c28a;
            box-shadow: 0 0 0 6px rgba(37, 194, 138, 0.12);
        }

        .exam-title {
            font-size: 44px;
            line-height: 1.1;
            font-weight: 800;
            color: #1b2635;
            margin-bottom: 12px;
            letter-spacing: -0.8px;
        }

        .exam-running {
            font-size: 30px;
            line-height: 1.3;
            font-weight: 700;
            color: #657182;
            margin-bottom: 28px;
        }

        .exam-running span::after {
            content: "";
            animation: premiumDots 1.4s infinite;
        }

        .exam-btn {
            padding: 13px 34px !important;
            border-radius: 999px !important;
            font-size: 15px !important;
            font-weight: 700 !important;
            border: none !important;
            color: #ffffff !important;
            background: linear-gradient(135deg, #168cff, #32c5ff) !important;
            box-shadow: 0 14px 34px rgba(22, 140, 255, 0.34);
            transition: all 0.28s ease;
            position: relative;
            overflow: hidden;
        }

        .exam-btn::before {
            content: "";
            position: absolute;
            top: 0;
            left: -80%;
            width: 55%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.45), transparent);
            transform: skewX(-20deg);
            animation: premiumShine 3s infinite;
        }

        .exam-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 48px rgba(22, 140, 255, 0.46);
        }

        .premium-countdown {
            margin: 30px 0 26px;
            gap: 14px;
        }

        .premium-countdown>div {
            min-width: 86px;
            padding: 16px 12px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.92);
            box-shadow: 0 14px 35px rgba(0, 123, 255, 0.10);
            border: 1px solid rgba(22, 140, 255, 0.08);
            animation: premiumScaleIn 0.7s ease both;
        }

        .premium-countdown>div:nth-child(2) {
            animation-delay: 0.08s;
        }

        .premium-countdown>div:nth-child(3) {
            animation-delay: 0.16s;
        }

        .premium-countdown>div:nth-child(4) {
            animation-delay: 0.24s;
        }

        .premium-countdown .number {
            display: block;
            font-size: 29px;
            line-height: 1;
            font-weight: 800;
            color: #168cff;
            margin-bottom: 8px;
        }

        .premium-countdown span:last-child {
            font-size: 13px;
            color: #6f7a88;
            font-weight: 600;
        }

        /* Only for image modal */
        #imageModal .modal-content {
            background-color: transparent;
            border: none;
        }

        #imageModal .modal-dialog {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) !important;
            max-width: 100%;
            width: auto;
            max-height: 90vh;
        }

        #imageModal .modal-body {
            text-align: center;
            padding: 0;
        }

        #imageModal .modal-body img {
            max-width: 100%;
            height: auto;
        }

        /* Rules modal fixed design */
        #rulesModal .modal-content {
            background: #ffffff;
            border-radius: 14px;
            border: none;
            overflow: hidden;
        }

        #rulesModal .modal-header {
            background: #0d6efd;
            color: #ffffff;
        }

        #rulesModal .btn-close {
            filter: brightness(0) invert(1);
        }

        #rulesModal .modal-body {
            padding: 20px;
            text-align: left;
            max-height: 65vh;
            overflow-y: auto;
        }

        #rulesModal .list-group-item {
            font-size: 15px;
            line-height: 1.5;
            text-align: left;
        }

        #rulesModal .modal-footer {
            background: #f8f9fa;
        }

        @keyframes premiumFadeUp {
            from {
                opacity: 0;
                transform: translateY(34px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes premiumPulse {

            0%,
            100% {
                box-shadow: inset 0 0 0 1px rgba(22, 140, 255, 0.10), 0 0 0 0 rgba(22, 140, 255, 0.20);
            }

            50% {
                box-shadow: inset 0 0 0 1px rgba(22, 140, 255, 0.10), 0 0 0 13px rgba(22, 140, 255, 0);
            }
        }

        @keyframes premiumDots {
            0% {
                content: "";
            }

            25% {
                content: ".";
            }

            50% {
                content: "..";
            }

            75%,
            100% {
                content: "...";
            }
        }

        @keyframes premiumGlow {

            0%,
            100% {
                transform: translateX(-50%) translateY(0) scale(1);
            }

            50% {
                transform: translateX(-50%) translateY(20px) scale(1.08);
            }
        }

        @keyframes premiumFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(22px);
            }
        }

        @keyframes premiumShine {
            0% {
                left: -80%;
            }

            45%,
            100% {
                left: 130%;
            }
        }

        @keyframes premiumScaleIn {
            from {
                opacity: 0;
                transform: translateY(18px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @media(max-width: 768px) {
            .exam-status-section {
                padding: 65px 15px 60px;
            }

            .exam-status-card {
                padding: 38px 20px;
                border-radius: 24px;
            }

            .exam-title {
                font-size: 34px;
            }

            .exam-running {
                font-size: 24px;
            }

            .premium-countdown {
                flex-wrap: wrap;
                gap: 12px;
            }

            .premium-countdown>div {
                min-width: 118px;
            }
        }
    </style>

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

    @include('frontend.layouts.landing-menu')


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

    {{-- <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body position-relative p-0">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                <img src="{{ asset('storage/logo/marketing-olympiad-2024.jpg') }}" alt="Marketing Olympiad 2024 Logo" class="img-fluid w-100">
            </div>
        </div>
    </div>
</div> --}}



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
                            <li class="list-group-item">Participants must be enrolled in a university at the time of
                                registration.</li>
                            <li class="list-group-item">Participants have to compete individually.</li>
                            <li class="list-group-item">Participants must register online through the official
                                Marketing Olympiad website.</li>
                            <li class="list-group-item">All participants must comply with the rules and regulations set
                                by the Marketing Olympiad organizers.</li>
                            <li style="font-weight: bold" class="list-group-item">While participating in the online
                                quiz for Marketing Olympiad, participants during the exam cannot copy the question in an
                                attempt on using unfair means. </li>
                            <li style="font-weight: bold" class="list-group-item">Participants cannot open a new tab
                                during the quiz, cannot minimize the browser, cannot lock the screen, cannot refresh the
                                page, cannot take screenshots, and cannot log in from multiple devices.</li>
                            <li style="font-weight: bold" class="list-group-item">The above-mentioned regulations are
                                applicable for any device from which the quiz is being participated (Laptop, Mobile,
                                Tablet & PC).</li>
                            <li style="font-weight: bold" class="list-group-item">Attempting any of the
                                above-mentioned will provide a warning and a second attempt will lead to a
                                disqualification.</li>
                            <li style="font-weight: bold" class="list-group-item">One participant can only attempt the
                                quiz once. </li>
                            <li class="list-group-item">Participants must abide by the competition timeline as
                                mentioned.</li>
                            <li style="font-weight: bold" class="list-group-item">Plagiarism or any other form of
                                academic misconduct is strictly prohibited and may result in disqualification.</li>
                            <li class="list-group-item">All information submitted becomes the property of the Marketing
                                Olympiad organizers.</li>
                            <li class="list-group-item">The decision of the judges is final and cannot be contested.
                            </li>
                            <li class="list-group-item">The Marketing Olympiad organizers reserve the right to
                                disqualify any participant that violates the rules and regulations or engages in any
                                unethical behavior.</li>
                            <li class="list-group-item">No negative scoring will be made on wrong answers. </li>
                            <li style="font-weight: bold" class="list-group-item">The quiz must be finished within the
                                given timeframe. </li>
                            <li class="list-group-item">Participants must be at least 18 years old to compete in
                                Marketing Olympiad.</li>
                            <li class="list-group-item">The competition is open to participants from any part of the
                                country. </li>
                            <li style="font-weight: bold" class="list-group-item">The use of any unauthorized
                                resources or external assistance is prohibited during the competition.</li>
                            <li class="list-group-item">Participants must provide accurate and complete information
                                during the registration process.</li>
                        </ol>
                        <form action="" method="post">
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    I have read, understood, and agree to abide by the Rules & Regulations.
                                </label>
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
                                {{-- <img src="https://marketingolympiad.com/public/frontend/assets/images/logo.png"
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
        <section class="exam-status-section">
            <div class="exam-glow"></div>

            <div class="container">
                <div class="exam-status-card">
                    <div class="exam-badge">Live Assessment</div>

                    <h1 class="exam-title">First Round</h1>

                    @if (Carbon::now() <= $exam_carbon)
                        <div class="countdown premium-countdown d-flex justify-content-center">
                            <div>
                                <span class="number days"></span>
                                <span>Days</span>
                            </div>
                            <div>
                                <span class="number hours"></span>
                                <span>Hours</span>
                            </div>
                            <div>
                                <span class="number minutes"></span>
                                <span>Minutes</span>
                            </div>
                            <div>
                                <span class="number seconds"></span>
                                <span>Seconds</span>
                            </div>
                        </div>
                    @else
                        <h2 class="exam-running">Exam Running<span></span></h2>
                    @endif

                    @if (Carbon::now() >= $exam_carbon && Carbon::now() <= $exam_end_carbon)
                        <a class="btn btn-primary exam-btn text-center my-3"
                            @if (Auth::guard('admin')->user()) data-bs-toggle="modal"
                                    data-bs-target="#rulesModal"
                @else
                href="{{ route('round.one') }}" @endif>Start
                            Exam</a>
                    @endif
                </div>
            </div>
        </section>
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
                        <a class="btn btn-primary mt-3"
                            href="{{ asset('storage/Marketing-Olympiad-Registration-Pictorial.pdf') }}"
                            download>Download Pictorial</a>
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
                    @if ($theme->title)
                        <div class="embed-responsive embed-responsive-16by9 ratio ratio-16x9">
                            {{-- <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/mmiLdJxgKqE"></iframe> --}}
                            <iframe class="embed-responsive-item img-fluid" src="{{ $theme->video }}"
                                allowfullscreen></iframe>
                        </div>
                    @endif
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
                        <li class="list-group-item">Participants must be enrolled in a university at the time of
                            registration.</li>
                        <li class="list-group-item">Participants have to compete individually.</li>
                        <li class="list-group-item">Participants must register online through the official Marketing
                            Olympiad website.</li>
                        <li class="list-group-item">All participants must comply with the rules and regulations set by
                            the Marketing Olympiad organizers.</li>
                        <li style="font-weight: bold" class="list-group-item">While participating in the online quiz
                            for Marketing Olympiad, participants during the exam cannot copy the question in an attempt
                            on using unfair means. </li>
                        <li style="font-weight: bold" class="list-group-item">Participants cannot open a new tab
                            during the quiz, cannot minimize the browser, cannot lock the screen, cannot refresh the
                            page, cannot take screenshots, and cannot log in from multiple devices.</li>
                        <li style="font-weight: bold" class="list-group-item">The above-mentioned regulations are
                            applicable for any device from which the quiz is being participated (Laptop, Mobile, Tablet
                            & PC).</li>
                        <li style="font-weight: bold" class="list-group-item">Attempting any of the above-mentioned
                            will provide a warning and a second attempt will lead to a disqualification.</li>
                        <li style="font-weight: bold" class="list-group-item">One participant can only attempt the
                            quiz once. </li>
                        <li class="list-group-item">Participants must abide by the competition timeline as mentioned.
                        </li>
                        <li style="font-weight: bold" class="list-group-item">Plagiarism or any other form of academic
                            misconduct is strictly prohibited and may result in disqualification.</li>
                        <li class="list-group-item">All information submitted becomes the property of the Marketing
                            Olympiad organizers.</li>
                        <li class="list-group-item">The decision of the judges is final and cannot be contested.</li>
                        <li class="list-group-item">The Marketing Olympiad organizers reserve the right to disqualify
                            any participant that violates the rules and regulations or engages in any unethical
                            behavior.</li>
                        <li class="list-group-item">No negative scoring will be made on wrong answers. </li>
                        <li style="font-weight: bold" class="list-group-item">The quiz must be finished within the
                            given timeframe. </li>
                        <li class="list-group-item">Participants must be at least 18 years old to compete in Marketing
                            Olympiad.</li>
                        <li class="list-group-item">The competition is open to participants from any part of the
                            country. </li>
                        <li style="font-weight: bold" class="list-group-item">The use of any unauthorized resources or
                            external assistance is prohibited during the competition.</li>
                        <li class="list-group-item">Participants must provide accurate and complete information during
                            the registration process.</li>
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
                                    <p>Marketing Olympiad is open to all students enrolled in universities worldwide.
                                        Participants can compete individually.</p>
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

    @if ($theme->partners)
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
                        <img class="img-fluid" src="{{ asset('storage/logo/' . $theme->partners) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    @endif
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
                                            questions and logo recognition. Shortlisted candidates will be allowed for
                                            Round 2 of the Marketing Olympiad.</p>
                                    </li>
                                    <li class="event"
                                        data-date="@if ($round2 == $round2end) {{ $round2 }}
                                    @else
                                    {{ $round2 }} - {{ $round2end }} @endif">
                                        <h4 class="mb-3 pt-3">Round Two</h4>
                                        <p>Round Two of the competition will consist of multiple-choice
                                            questions and logo recognition.Shortlisted candidates will be participate
                                            for this round of the competition.</p>
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

    @include('frontend.layouts.footer')


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
            $('#imageModal').modal('show');
        });
    </script>
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

        // Parse the start date and time string into a JavaScript Date object
        const startDate = new Date("{{ $exam->start_date_time }}");

        // Calculate time remaining until the next birthday
        const countdown = setInterval(() => {
            // Get the current date and time
            const currentDate = new Date();
            // Get the current year
            const currentYear = currentDate.getFullYear();
            // Get the birthday's month and day
            const birthdayMonth = startDate.getMonth();
            const birthdayDay = startDate.getDate();
            // Calculate the next birthday's date
            const nextBirthday = new Date(currentYear, birthdayMonth, birthdayDay);

            // If the next birthday has passed this year, calculate for next year
            if (currentDate > nextBirthday) {
                nextBirthday.setFullYear(currentYear + 1);
            }

            // Calculate the difference in milliseconds between now and the next birthday
            const diff = nextBirthday - currentDate;

            // Convert milliseconds to days, hours, minutes, and seconds
            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);

            // Display the remaining time
            document.querySelector(".days").innerHTML = days < 10 ? '0' + days : days;
            document.querySelector(".hours").innerHTML = hours < 10 ? '0' + hours : hours;
            document.querySelector(".minutes").innerHTML = minutes < 10 ? '0' + minutes : minutes;
            document.querySelector(".seconds").innerHTML = seconds < 10 ? '0' + seconds : seconds;

            // If the countdown is finished, clear the interval
            if (diff <= 0) {
                clearInterval(countdown);
                return false;
            }
        }, 1000);
    </script>
</body>

</html>
