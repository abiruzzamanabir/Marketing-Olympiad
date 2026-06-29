@php
    use Carbon\Carbon;
    use App\Models\Theme;
    use App\Models\ExamControl;

    $theme = Theme::findOrFail(1);
    $exam = ExamControl::findOrFail(1);
    $social = json_decode($theme->social, false);
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
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.82), rgba(255, 255, 255, 0.82)),
                url({{ asset('frontend/assets/images/slider-left-dec.png') }});
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: left;
            background-size: contain;
        }

        .logo-img {
            height: 140px;
            object-fit: contain;
        }

        .intro-card {
            background: #fff;
            border-radius: 14px;
            padding: 24px;
            border: 1px solid #e8e8e8;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
            line-height: 1.8;
            color: #444;
        }

        .section-heading {
            text-align: center;
            margin: 55px 0 25px;
        }

        .section-heading h2 {
            font-weight: 700;
        }

        .section-heading p {
            color: #666;
            margin-bottom: 10px;
        }

        .year-badge {
            display: inline-block;
            background: #f1f3f5;
            color: #495057;
            padding: 6px 16px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 12px;
        }

        .result-card {
            border: none;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            margin-bottom: 35px;
        }

        .result-card .card-body {
            padding: 24px;
        }

        .table thead th {
            background: #f8f9fa;
            font-weight: 600;
            color: #333;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .rank-badge {
            display: inline-block;
            background: #f8f9fa;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 13px;
        }

        .empty-result {
            background: #fff5f5;
            color: #dc3545;
            border: 1px solid #f5c2c7;
            border-radius: 12px;
            padding: 16px;
            text-align: center;
            font-weight: 500;
            margin-bottom: 35px;
        }

        .support-box {
            background: #fff;
            border-radius: 14px;
            padding: 32px 20px;
            margin: 45px 0 30px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .support-box a {
            font-size: 28px;
            color: #333;
            transition: 0.3s;
        }

        .support-box a:hover {
            color: #007bff;
            text-decoration: none;
        }

        @media (max-width: 767px) {
            .logo-img {
                height: 110px;
            }

            .intro-card {
                padding: 18px;
            }

            .result-card .card-body {
                padding: 16px;
            }
        }

        .shape {
            width: 45px;
            height: 2px;
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
    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-11">

                <div class="intro-card">
                    After the evaluation process, the results of the Marketing Olympiad will be announced on the
                    website.
                    The winners have been selected based on their performance in the competition, which includes the
                    overall
                    score of the participant and time. The results will be published on the website, and participants
                    can
                    access their scores by logging in to their accounts. The winners will also be contacted directly via
                    email and SMS. Shortlisted top-performing participants will be allowed to participate in the next
                    round.
                </div>

                {{-- Top 10 --}}
                <div class="section-heading">
                    <h2><em>Top 10</em></h2>
                    <p>The top 10 participants will reach the Grand Finale of the Marketing Olympiad 2023</p>

                    @if (isset($topTenYear) && $all_admin3->count() > 0)
                        <div class="year-badge">Showing Result of {{ $topTenYear }}</div>
                    @endif

                    <br>
                    <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">
                </div>

                @if ($all_admin3->count() > 0)
                    <div class="card result-card">
                        @include('validate-main')

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="topTenTable" class="table table-hover table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 80px;">#</th>
                                            <th>Name</th>
                                            <th>University / Institute</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($all_admin3 as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->university }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="empty-result">
                        Top 10 Result Not Published Yet.
                    </div>
                @endif

                {{-- Winner --}}
                <div class="section-heading">
                    <h2><em>Winner</em></h2>
                    <p>Winners of Marketing Olympiad 2023</p>

                    @if (isset($winnerYear) && $all_admin4->count() > 0)
                        <div class="year-badge">Showing Result of {{ $winnerYear }}</div>
                    @endif

                    <br>
                    <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">
                </div>

                @if ($all_admin4->count() > 0)
                    <div class="card result-card">
                        @include('validate-main')

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="winnerTable" class="table table-hover table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 180px;">Rank</th>
                                            <th>Name</th>
                                            <th>University / Institute</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($all_admin4 as $user)
                                            <tr>
                                                <td>
                                                    <span class="rank-badge">
                                                        @if ($user->rank == 1)
                                                            Champion
                                                        @elseif($user->rank == 2)
                                                            1st Runner Up
                                                        @elseif($user->rank == 3)
                                                            2nd Runner Up
                                                        @else
                                                            Rank {{ $user->rank }}
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->university }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="empty-result">
                        Winner Result Not Published Yet.
                    </div>
                @endif

                {{-- Support --}}
                <div class="support-box text-center">
                    <h2><em>Support</em></h2>
                    <img class="shape" src="{{ asset('frontend/assets/images/heading-line-dec.png') }}"
                        alt="">
                    <p class="mt-3">support@marketingolympiad.com</p>

                    @if (!empty($social->facebook))
                        <a href="{{ $social->facebook }}" target="_blank">
                            <i class="fab fa-facebook-f mx-2"></i>
                        </a>
                    @endif

                    @if (!empty($social->instagram))
                        <a href="{{ $social->instagram }}" target="_blank">
                            <i class="fab fa-instagram mx-2"></i>
                        </a>
                    @endif

                    @if (!empty($social->linkedin))
                        <a href="{{ $social->linkedin }}" target="_blank">
                            <i class="fab fa-linkedin-in mx-2"></i>
                        </a>
                    @endif

                    @if (!empty($social->youtube))
                        <a href="{{ $social->youtube }}" target="_blank">
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
            if ($('#topTenTable').length) {
                $('#topTenTable').DataTable({
                    pageLength: 10,
                    ordering: false
                });
            }

            if ($('#winnerTable').length) {
                $('#winnerTable').DataTable({
                    paging: false,
                    searching: false,
                    ordering: false,
                    info: false
                });
            }
        });
    </script>
</body>

</html>
