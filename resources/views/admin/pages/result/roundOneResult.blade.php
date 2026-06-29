@php
    use Carbon\Carbon;
    use App\Models\Theme;
    use App\Models\ExamControl;

    $theme = Theme::findOrFail(1);
    $exam = ExamControl::findOrFail(1);
    $social = json_decode($theme->social, false);

    $now = Carbon::now();
    $currentYear = $now->year;

    $resultRound1 = Carbon::parse($exam->result_published_time);
    $resultRound2 = Carbon::parse($exam->result_published_time_round_two);
    $resultRound3 = Carbon::parse($exam->result_published_time_round_third);
    $resultWinner = Carbon::parse($exam->result_published_time_round_third);

    $result1_published_time = $resultRound1->format('l, F j, Y, g:i A');
    $result2_published_time = $resultRound2->format('l, F j, Y, g:i A');
    $result3_published_time = $resultRound3->format('l, F j, Y, g:i A');
    $resultWinner_published_time = $resultWinner->format('l, F j, Y, g:i A');
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketing Olympiad Result</title>

    <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/templatemo-chain-app-dev.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animated.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.css') }}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.css" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.85), rgba(255, 255, 255, 0.85)),
                url({{ asset('frontend/assets/images/slider-left-dec.png') }});
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: left;
            background-size: contain;
        }

        .logo {
            height: 130px;
            object-fit: contain;
        }

        .intro-box,
        .support-box {
            background: #ffffff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
        }

        .section-title {
            margin-top: 55px;
            margin-bottom: 25px;
            text-align: center;
        }

        .section-title h2 {
            font-weight: 600;
            margin-bottom: 8px;
        }

        .section-title p {
            margin-bottom: 8px;
            color: #666;
        }

        .result-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            margin-bottom: 35px;
        }

        .table thead th {
            background: #f7f7f7;
            font-weight: 600;
            vertical-align: middle;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .fallback-box {
            background: #fff8e1;
            border: 1px solid #ffe08a;
            color: #856404;
            padding: 12px 16px;
            border-radius: 10px;
            text-align: center;
            font-weight: 500;
            margin: 15px auto 10px;
        }

        .countdown-box {
            background: linear-gradient(135deg, #fff7f7, #ffffff);
            border: 1px solid #ffc9c9;
            border-radius: 14px;
            padding: 24px 18px;
            text-align: center;
            margin-bottom: 35px;
            box-shadow: 0 8px 24px rgba(220, 53, 69, 0.08);
        }

        .countdown-box h4 {
            color: #dc3545;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .countdown-box p {
            color: #555;
            margin-bottom: 16px;
        }

        .countdown-timer {
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .countdown-item {
            min-width: 80px;
            background: #ffffff;
            border: 1px solid #f1d0d0;
            border-radius: 10px;
            padding: 10px;
        }

        .countdown-item strong {
            display: block;
            font-size: 24px;
            color: #222;
        }

        .countdown-item span {
            font-size: 12px;
            color: #777;
        }

        .support-box {
            margin-bottom: 50px;
        }

        .support-box a {
            color: #333;
            transition: 0.3s;
        }

        .support-box a:hover {
            color: #007bff;
            text-decoration: none;
        }

        .shape {
            width: 45px;
            height: 2px;
        }

        .intro-box p {
            color: #555;
        }
    </style>

<style>
    .modern-public-page {
        --primary: #0d6efd;
        --primary-dark: #0b5ed7;
        --border: #e7edf5;
        --muted: #6b7280;
        --text: #1f2937;
        --shadow: 0 18px 50px rgba(15, 23, 42, 0.10);
    }

    .modern-public-page .container {
        position: relative;
        z-index: 1;
    }

    .modern-public-page .card,
    .modern-public-page .bd,
    .modern-public-page .intro-card,
    .modern-public-page .support-box,
    .modern-public-page .intro-box {
        border: 1px solid var(--border) !important;
        border-radius: 22px !important;
        box-shadow: var(--shadow) !important;
        background: rgba(255, 255, 255, 0.94) !important;
        backdrop-filter: blur(10px);
    }

    .modern-public-page .btn {
        border-radius: 999px !important;
        font-weight: 700;
        padding-left: 22px;
        padding-right: 22px;
    }

    .modern-public-page input,
    .modern-public-page textarea,
    .modern-public-page select,
    .modern-public-page .form-control {
        border-radius: 12px !important;
        border-color: #d9e1ec !important;
        min-height: 44px;
    }

    .modern-public-page label {
        font-weight: 700;
        color: var(--text);
    }

    .modern-public-page table {
        border-radius: 16px;
        overflow: hidden;
        background: #ffffff;
    }

    .modern-public-page table thead th {
        background: #f8fafc;
        color: #4b5563;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .03em;
        white-space: nowrap;
    }

    .modern-public-page .section-heading h2,
    .modern-public-page h1,
    .modern-public-page h2,
    .modern-public-page h3 {
        color: var(--text);
        font-weight: 800;
    }

    .modern-public-page .exam-shell {
        background: rgba(255, 255, 255, 0.94);
        border: 1px solid var(--border);
        border-radius: 24px;
        box-shadow: var(--shadow);
        padding: 28px;
        margin-bottom: 40px;
    }

    .modern-public-page .timer-box {
        background: #ffffff;
        border: 1px solid var(--border);
        border-radius: 22px;
        box-shadow: var(--shadow);
        padding: 18px;
    }

    .modern-public-page .option-card,
    .modern-public-page .bgcolorClass {
        border-radius: 14px !important;
        border: 1px solid var(--border);
        transition: all .2s ease;
    }

    @media (max-width: 767px) {
        .modern-public-page .exam-shell,
        .modern-public-page .card,
        .modern-public-page .bd {
            padding: 18px !important;
            border-radius: 18px !important;
        }
    }
</style>

</head>

<body class="modern-public-page" class="modern-public-page">
    @include('frontend.layouts.landing-menu')
    <div style="height: 120px;"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-11 pb-5">



                <div class="intro-box">
                    <p class="mb-0">
                        After the evaluation process, the results of the Marketing Olympiad will be announced on the
                        website.
                        The winners have been selected based on their performance in the competition, including overall
                        score
                        and completion time. Participants can access their scores by logging in to their accounts.
                        Winners will also be contacted directly via email and SMS. Shortlisted top-performing
                        participants
                        will be allowed to participate in the next round.
                    </p>
                </div>

                {{-- Round 1 --}}
                <div class="section-title">
                    <h2><em>Shortlist of Round 1</em></h2>
                    <p>Shortlisted candidates will be allowed for Round 2 of the Marketing Olympiad</p>

                    @if ($now >= $resultRound1 && isset($roundOneYear) && $roundOneYear != $currentYear && $all_admin->count() > 0)
                        <div class="fallback-box">
                            The {{ $currentYear }} Marketing Olympiad has not started yet. So this is the
                            {{ $roundOneYear }} data.
                        </div>
                    @endif

                    <img class="shape" src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">
                </div>

                @if ($now >= $resultRound1)
                    <div class="card result-card">
                        @include('validate-main')

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="roundOneTable" class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th class="border">Name</th>
                                            <th class="border">University/Institute</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($all_admin as $user)
                                            <tr>
                                                <td class="border">{{ $user->first_name }} {{ $user->last_name }}</td>
                                                <td class="border">{{ $user->uniname }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-danger text-center" colspan="2">No Data Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="countdown-box" data-publish-time="{{ $resultRound1->toIso8601String() }}">
                        <h4>Result Not Published Yet</h4>
                        <p>Result will be published on <strong>{{ $result1_published_time }}</strong></p>

                        <div class="countdown-timer">
                            <div class="countdown-item"><strong class="days">00</strong><span>Days</span></div>
                            <div class="countdown-item"><strong class="hours">00</strong><span>Hours</span></div>
                            <div class="countdown-item"><strong class="minutes">00</strong><span>Minutes</span></div>
                            <div class="countdown-item"><strong class="seconds">00</strong><span>Seconds</span></div>
                        </div>
                    </div>
                @endif

                {{-- Round 2 --}}
                <div class="section-title">
                    <h2><em>Top 100</em></h2>
                    <p>The top 100 participants will be allowed for Round 3 of the Marketing Olympiad</p>

                    @if ($now >= $resultRound2 && isset($roundTwoYear) && $roundTwoYear != $currentYear && $all_admin2->count() > 0)
                        <div class="fallback-box">
                            The {{ $currentYear }} Marketing Olympiad has not started yet. So this is the
                            {{ $roundTwoYear }} data.
                        </div>
                    @endif

                    <img class="shape" src="{{ asset('frontend/assets/images/heading-line-dec.png') }}"
                        alt="">
                </div>

                @if ($now >= $resultRound2)
                    <div class="card result-card">
                        @include('validate-main')

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="roundTwoTable" class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th class="border">Name</th>
                                            <th class="border">University/Institute</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($all_admin2 as $user)
                                            <tr>
                                                <td class="border">{{ $user->first_name }} {{ $user->last_name }}</td>
                                                <td class="border">{{ $user->uniname }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-danger text-center" colspan="2">No Data Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="countdown-box" data-publish-time="{{ $resultRound2->toIso8601String() }}">
                        <h4>Result Not Published Yet</h4>
                        <p>Result will be published on <strong>{{ $result2_published_time }}</strong></p>

                        <div class="countdown-timer">
                            <div class="countdown-item"><strong class="days">00</strong><span>Days</span></div>
                            <div class="countdown-item"><strong class="hours">00</strong><span>Hours</span></div>
                            <div class="countdown-item"><strong class="minutes">00</strong><span>Minutes</span></div>
                            <div class="countdown-item"><strong class="seconds">00</strong><span>Seconds</span></div>
                        </div>
                    </div>
                @endif

                {{-- Top 10 --}}
                <div class="section-title">
                    <h2><em>Top 10</em></h2>
                    <p>The top 10 participants will reach the Grand Finale of the Marketing Olympiad</p>

                    @if ($now >= $resultRound3 && isset($topTenYear) && $topTenYear != $currentYear && $all_admin3->count() > 0)
                        <div class="fallback-box">
                            The {{ $currentYear }} Marketing Olympiad has not started yet. So this is the
                            {{ $topTenYear }} data.
                        </div>
                    @endif

                    <img class="shape" src="{{ asset('frontend/assets/images/heading-line-dec.png') }}"
                        alt="">
                </div>

                @if ($now >= $resultRound3)
                    @if ($all_admin3->count() > 0)
                        <div class="card result-card">
                            @include('validate-main')

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="topTenTable" class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th class="border">Name</th>
                                                <th class="border">University/Institute</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($all_admin3 as $user)
                                                <tr>
                                                    <td class="border">{{ $user->name }}</td>
                                                    <td class="border">{{ $user->university }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="countdown-box" data-publish-time="{{ $resultRound3->toIso8601String() }}">
                            <h4>Result Not Published Yet</h4>
                            <p>Result will be published on <strong>{{ $result3_published_time }}</strong></p>

                            <div class="countdown-timer">
                                <div class="countdown-item"><strong class="days">00</strong><span>Days</span></div>
                                <div class="countdown-item"><strong class="hours">00</strong><span>Hours</span></div>
                                <div class="countdown-item"><strong class="minutes">00</strong><span>Minutes</span>
                                </div>
                                <div class="countdown-item"><strong class="seconds">00</strong><span>Seconds</span>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="countdown-box" data-publish-time="{{ $resultRound3->toIso8601String() }}">
                        <h4>Result Not Published Yet</h4>
                        <p>Result will be published on <strong>{{ $result3_published_time }}</strong></p>

                        <div class="countdown-timer">
                            <div class="countdown-item"><strong class="days">00</strong><span>Days</span></div>
                            <div class="countdown-item"><strong class="hours">00</strong><span>Hours</span></div>
                            <div class="countdown-item"><strong class="minutes">00</strong><span>Minutes</span></div>
                            <div class="countdown-item"><strong class="seconds">00</strong><span>Seconds</span></div>
                        </div>
                    </div>
                @endif

                {{-- Winners --}}
                <div class="section-title">
                    <h2><em>Winner</em></h2>
                    <p>Winners of Marketing Olympiad</p>

                    @if ($now >= $resultWinner && isset($winnerYear) && $winnerYear != $currentYear && $all_admin4->count() > 0)
                        <div class="fallback-box">
                            The {{ $currentYear }} Marketing Olympiad has not started yet. So this is the
                            {{ $winnerYear }} data.
                        </div>
                    @endif

                    <img class="shape" src="{{ asset('frontend/assets/images/heading-line-dec.png') }}"
                        alt="">
                </div>

                @if ($now >= $resultWinner)
                    @if ($all_admin4->count() > 0)
                        <div class="card result-card">
                            @include('validate-main')

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="winnerTable" class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th class="border">Rank</th>
                                                <th class="border">Name</th>
                                                <th class="border">University/Institute</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($all_admin4 as $user)
                                                <tr>
                                                    <td class="border">
                                                        @if ($user->rank == 1)
                                                            Champion
                                                        @elseif ($user->rank == 2)
                                                            1st Runner Up
                                                        @elseif ($user->rank == 3)
                                                            2nd Runner Up
                                                        @else
                                                            Rank {{ $user->rank }}
                                                        @endif
                                                    </td>
                                                    <td class="border">{{ $user->name }}</td>
                                                    <td class="border">{{ $user->university }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="countdown-box" data-publish-time="{{ $resultWinner->toIso8601String() }}">
                            <h4>Result Not Published Yet</h4>
                            <p>Result will be published on <strong>{{ $resultWinner_published_time }}</strong></p>

                            <div class="countdown-timer">
                                <div class="countdown-item"><strong class="days">00</strong><span>Days</span></div>
                                <div class="countdown-item"><strong class="hours">00</strong><span>Hours</span></div>
                                <div class="countdown-item"><strong class="minutes">00</strong><span>Minutes</span>
                                </div>
                                <div class="countdown-item"><strong class="seconds">00</strong><span>Seconds</span>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="countdown-box" data-publish-time="{{ $resultWinner->toIso8601String() }}">
                        <h4>Result Not Published Yet</h4>
                        <p>Result will be published on <strong>{{ $resultWinner_published_time }}</strong></p>

                        <div class="countdown-timer">
                            <div class="countdown-item"><strong class="days">00</strong><span>Days</span></div>
                            <div class="countdown-item"><strong class="hours">00</strong><span>Hours</span></div>
                            <div class="countdown-item"><strong class="minutes">00</strong><span>Minutes</span></div>
                            <div class="countdown-item"><strong class="seconds">00</strong><span>Seconds</span></div>
                        </div>
                    </div>
                @endif

                {{-- Support --}}
                <div class="support-box text-center">
                    <h2><em>Support</em></h2>
                    <img class="shape" src="{{ asset('frontend/assets/images/heading-line-dec.png') }}"
                        alt="">
                    <p class="mt-3">support@marketingolympiad.com</p>

                    @if (!empty($social->facebook))
                        <a style="font-size: 28px;" href="{{ $social->facebook }}" target="_blank">
                            <i class="fab fa-facebook-f mx-2"></i>
                        </a>
                    @endif

                    @if (!empty($social->instagram))
                        <a style="font-size: 28px;" href="{{ $social->instagram }}" target="_blank">
                            <i class="fab fa-instagram mx-2"></i>
                        </a>
                    @endif

                    @if (!empty($social->linkedin))
                        <a style="font-size: 28px;" href="{{ $social->linkedin }}" target="_blank">
                            <i class="fab fa-linkedin-in mx-2"></i>
                        </a>
                    @endif

                    @if (!empty($social->youtube))
                        <a style="font-size: 28px;" href="{{ $social->youtube }}" target="_blank">
                            <i class="fab fa-youtube mx-2"></i>
                        </a>
                    @endif
                </div>

            </div>
        </div>

    </div>
    @include('frontend.layouts.footer')

    <script src="{{ asset('admin/assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('custom/admin.js') }}"></script>

    <script>
        $(document).ready(function() {
            if ($('#roundOneTable').length) {
                $('#roundOneTable').DataTable();
            }

            if ($('#roundTwoTable').length) {
                $('#roundTwoTable').DataTable();
            }

            if ($('#topTenTable').length) {
                $('#topTenTable').DataTable();
            }

            if ($('#winnerTable').length) {
                $('#winnerTable').DataTable();
            }
        });

        function initCountdowns() {
            const boxes = document.querySelectorAll('.countdown-box');

            boxes.forEach(function(box) {
                const publishTime = new Date(box.getAttribute('data-publish-time')).getTime();

                function updateCountdown() {
                    const currentTime = new Date().getTime();
                    const distance = publishTime - currentTime;

                    if (distance <= 0) {
                        box.innerHTML = `
                            <h4>Result Published</h4>
                            <p>The result is now available. Please refresh the page.</p>
                        `;
                        return;
                    }

                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    box.querySelector('.days').textContent = String(days).padStart(2, '0');
                    box.querySelector('.hours').textContent = String(hours).padStart(2, '0');
                    box.querySelector('.minutes').textContent = String(minutes).padStart(2, '0');
                    box.querySelector('.seconds').textContent = String(seconds).padStart(2, '0');
                }

                updateCountdown();
                setInterval(updateCountdown, 1000);
            });
        }

        document.addEventListener('DOMContentLoaded', initCountdowns);
    </script>
</body>

</html>
