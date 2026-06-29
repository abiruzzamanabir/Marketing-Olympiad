@php
    use App\Models\ExamControl;
    use App\Models\Theme;
    use Carbon\Carbon;

    $theme = $theme ?? Theme::findOrFail(1);
    $exam = $exam ?? ExamControl::findOrFail(1);
    $exam_carbon = $exam_carbon ?? Carbon::parse($exam->start_date_time);
    $exam_end_carbon = $exam_end_carbon ?? Carbon::parse($exam->end_date_time);
    $start_exam_carbon = $start_exam_carbon ?? Carbon::parse($exam->next_round_date);
    $end_exam_carbon = $end_exam_carbon ?? Carbon::parse($exam->next_round_end_date);
    $third_start_exam_carbon = $third_start_exam_carbon ?? Carbon::parse($exam->third_round_date);
    $third_end_exam_carbon = $third_end_exam_carbon ?? Carbon::parse($exam->third_round_end_date);
@endphp
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
                        <li class="scroll-to-section"><a href="{{ route('home.page') }}#about">About</a></li>
                        {{-- <li class="scroll-to-section"><a href="#whyparticipate">Why Participate</a></li> --}}
                        {{-- <li class="scroll-to-section"><a href="#whoparticipate">Who Participate</a></li> --}}
                        <li class="scroll-to-section"><a href="{{ route('home.page') }}#guidelines">Guidelines</a></li>
                        <li class="scroll-to-section"><a href="{{ route('home.page') }}#rules">Rules & Regulation</a>
                        </li>
                        {{-- <li class="scroll-to-section"><a href="#faq">FAQ</a></li> --}}
                        {{-- <li class="scroll-to-section"><a href="#partner">Partners</a></li> --}}
                        <li class="scroll-to-section"><a href="{{ route('home.page') }}#calender">Calender</a></li>
                        <li class="nav-item dropdown has-arrow"><a href="{{ route('student.result.2024') }}">Result</a>
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
                                        <span class="user-img"><img style="width: 40px; height: 40px; object-fit: cover"
                                                class="rounded-circle" src="{{ asset('storage/admins/avatar.png') }}"
                                                width="31"
                                                alt="{{ Auth::guard('admin')->user()->first_name }}"></span>
                                    </a>
                                @else
                                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                                        <span class="user-img"><img style="width: 40px; height: 40px; object-fit: cover"
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
