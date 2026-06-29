@php
    use App\Models\Theme;

    $theme = Theme::findOrFail(1);

    $round = $round ?? request('round');
    $status = $status ?? request('status', 'submitted');
    $reason = $reason ?? request('reason');
    $duration = $duration ?? request('duration');
    $correctAnswers = $correctAnswers ?? request('correctAnswers', 0);
    $totalSubmitted = $totalSubmitted ?? request('totalSubmitted', 0);

    $isDisqualified = $status === 'disqualified';

    $seconds = is_numeric($duration) ? (int) $duration : 0;
    $minutes = floor($seconds / 60);
    $remainingSeconds = $seconds % 60;

    $timeText =
        $minutes .
        ' Minute' .
        ($minutes != 1 ? 's' : '') .
        ' ' .
        $remainingSeconds .
        ' Second' .
        ($remainingSeconds != 1 ? 's' : '');
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $isDisqualified ? 'Exam Disqualified' : 'Submission Successful' }} | Marketing Olympiad</title>

    <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/templatemo-chain-app-dev.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animated.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.css') }}">

    <style>
        html,
        body {
            width: 100%;
            min-height: 100%;
            margin: 0;
            overflow-x: hidden;
            background: #f8fbff;
            color: #0f172a;
        }

        header,
        .header-area,
        .main-nav,
        .navbar,
        nav {
            position: relative;
            z-index: 9999 !important;
            overflow: visible !important;
        }

        .dropdown,
        .dropdown-menu,
        .profile-dropdown,
        .user-dropdown {
            z-index: 10000 !important;
        }

        .dropdown-menu {
            position: absolute !important;
            right: 0;
            left: auto;
            top: 100%;
            display: none;
            min-width: 180px;
            padding: 8px 0;
            margin-top: 10px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.16);
        }

        .dropdown.show .dropdown-menu,
        .dropdown-menu.show {
            display: block !important;
        }

        .dropdown-menu a,
        .dropdown-menu .dropdown-item {
            display: block;
            width: 100%;
            padding: 10px 16px;
            color: #0f172a !important;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
        }

        .dropdown-menu a:hover,
        .dropdown-menu .dropdown-item:hover {
            background: #f1f5f9;
            color: #2563eb !important;
        }

        .exam-result-wrap {
            width: 100%;
            min-height: calc(100vh - 90px);
            padding: 70px 16px 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(circle at 12% 18%, rgba(37, 99, 235, 0.14), transparent 30%),
                radial-gradient(circle at 88% 16%, rgba(249, 115, 22, 0.14), transparent 28%),
                linear-gradient(135deg, #f8fbff 0%, #eef5ff 100%);
        }

        .exam-result-wrap.is-danger {
            background:
                radial-gradient(circle at 12% 18%, rgba(239, 68, 68, 0.14), transparent 30%),
                radial-gradient(circle at 88% 16%, rgba(249, 115, 22, 0.12), transparent 28%),
                linear-gradient(135deg, #fff7f7 0%, #fff1f2 100%);
        }

        .exam-result-card {
            width: 100%;
            max-width: 820px;
            background: rgba(255, 255, 255, 0.3);
            border: 1px solid rgba(226, 232, 240, 0.95);
            border-radius: 30px;
            padding: 56px 42px;
            text-align: center;
            box-shadow: 0 28px 80px rgba(15, 23, 42, 0.14);
            position: relative;
            z-index: 5;
            backdrop-filter: blur(14px);
        }

        .result-icon {
            width: 96px;
            height: 96px;
            margin: 0 auto 22px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            font-weight: 900;
            color: #ffffff;
            background: linear-gradient(135deg, #16a34a, #22c55e);
            box-shadow: 0 18px 40px rgba(34, 197, 94, 0.28);
        }

        .result-icon.is-danger {
            background: linear-gradient(135deg, #dc2626, #ef4444);
            box-shadow: 0 18px 40px rgba(239, 68, 68, 0.28);
        }

        .round-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            padding: 8px 18px;
            border-radius: 999px;
            background: #eef6ff;
            color: #2563eb;
            font-size: 14px;
            font-weight: 800;
        }

        .round-pill.is-danger {
            background: #fef2f2;
            color: #dc2626;
        }

        .exam-result-card h1 {
            margin: 0 0 14px;
            font-size: 42px;
            line-height: 1.18;
            font-weight: 900;
            color: #0f172a;
        }

        .exam-result-card p {
            max-width: 640px;
            margin: 0 auto 30px;
            font-size: 17px;
            line-height: 1.75;
            color: #475569;
        }

        .summary-grid {
            max-width: 620px;
            margin: 0 auto 24px;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .summary-box {
            padding: 22px 18px;
            border-radius: 22px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
        }

        .summary-box.score {
            background: #f0fdf4;
            border-color: #bbf7d0;
            color: #166534;
        }

        .summary-box.score.is-danger {
            background: #fff7ed;
            border-color: #fed7aa;
            color: #c2410c;
        }

        .summary-box strong {
            display: block;
            margin-bottom: 8px;
            font-size: 24px;
            line-height: 1.1;
            font-weight: 900;
            color: inherit;
        }

        .summary-box span {
            display: block;
            font-size: 14px;
            line-height: 1.45;
            font-weight: 700;
            color: inherit;
        }

        .reason-box {
            max-width: 620px;
            margin: 0 auto 30px;
            padding: 18px 22px;
            border-radius: 22px;
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .reason-box span {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .reason-box strong {
            display: block;
            font-size: 17px;
            line-height: 1.5;
            font-weight: 800;
        }

        .btn-home {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 160px;
            padding: 14px 32px;
            border-radius: 999px;
            background: #0f172a;
            color: #ffffff;
            text-decoration: none;
            font-weight: 800;
            transition: 0.25s ease;
        }

        .btn-home:hover {
            color: #ffffff;
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(15, 23, 42, 0.22);
        }

        .confetti-layer {
            position: fixed;
            inset: 0;
            pointer-events: none;
            overflow: hidden;
            z-index: 2;
        }

        .confetti-piece {
            position: absolute;
            top: -40px;
            opacity: 0.95;
            animation-name: confetti-fall;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
            will-change: transform;
        }

        @keyframes confetti-fall {
            0% {
                transform: translate3d(0, -40px, 0) rotate(0deg);
            }

            100% {
                transform: translate3d(var(--drift), 110vh, 0) rotate(900deg);
            }
        }

        @media (max-width: 576px) {
            .exam-result-wrap {
                min-height: calc(100vh - 80px);
                padding: 110px 14px 50px;
            }

            .exam-result-card {
                padding: 42px 22px;
                border-radius: 24px;
            }

            .result-icon {
                width: 82px;
                height: 82px;
                font-size: 42px;
            }

            .exam-result-card h1 {
                font-size: 30px;
            }

            .exam-result-card p {
                font-size: 16px;
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    @include('frontend.layouts.landing-menu')

    @if (!$isDisqualified)
        <div class="confetti-layer" id="confettiLayer"></div>
    @endif

    <main class="exam-result-wrap {{ $isDisqualified ? 'is-danger' : '' }}">
        <section class="exam-result-card">
            <div class="result-icon {{ $isDisqualified ? 'is-danger' : '' }}">
                {{ $isDisqualified ? '!' : '✓' }}
            </div>

            <div class="round-pill {{ $isDisqualified ? 'is-danger' : '' }}">
                {{ !empty($round) ? 'Round ' . $round : 'Exam' }}
                {{ $isDisqualified ? 'Disqualified' : 'Submitted' }}
            </div>

            <h1>{{ $isDisqualified ? 'You Have Been Disqualified' : 'Congratulations!' }}</h1>

            <p>
                @if ($isDisqualified)
                    Your exam has been submitted with the answers saved before disqualification.
                    Please review the summary below.
                @else
                    Your {{ !empty($round) ? 'Round ' . $round : 'exam' }} answer script has been submitted
                    successfully.
                    Thank you for participating in Marketing Olympiad. Please wait for the official result announcement.
                @endif
            </p>

            <div class="summary-grid">
                <div class="summary-box score {{ $isDisqualified ? 'is-danger' : '' }}">
                    <strong>{{ $correctAnswers }}</strong>
                    <span>correct answers out of {{ $totalSubmitted }} submitted</span>
                </div>

                <div class="summary-box">
                    <strong>{{ $timeText }}</strong>
                    <span>time spent</span>
                </div>
            </div>

            @if ($isDisqualified && !empty($reason))
                <div class="reason-box">
                    <span>Disqualification Reason</span>
                    <strong>{{ $reason }}</strong>
                </div>
            @endif

            <a href="{{ route('home.page') }}" class="btn-home">Go to Home</a>
        </section>
    </main>

    @if (!$isDisqualified)
        <script>
            (function() {
                var layer = document.getElementById('confettiLayer');
                if (!layer) return;

                var colors = [
                    '#f97316', '#22c55e', '#3b82f6',
                    '#eab308', '#ec4899', '#8b5cf6',
                    '#ef4444', '#14b8a6'
                ];

                var shapes = ['2px', '50%', '0'];

                for (var i = 0; i < 180; i++) {
                    var piece = document.createElement('span');
                    var size = 6 + Math.random() * 9;
                    var height = 10 + Math.random() * 18;
                    var duration = 4 + Math.random() * 5;
                    var delay = Math.random() * 3.5;
                    var drift = (Math.random() * 220 - 110) + 'px';

                    piece.className = 'confetti-piece';
                    piece.style.left = Math.random() * 100 + 'vw';
                    piece.style.width = size + 'px';
                    piece.style.height = height + 'px';
                    piece.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                    piece.style.borderRadius = shapes[Math.floor(Math.random() * shapes.length)];
                    piece.style.animationDuration = duration + 's';
                    piece.style.animationDelay = delay + 's';
                    piece.style.setProperty('--drift', drift);

                    if (Math.random() > 0.65) {
                        piece.style.clipPath = 'polygon(50% 0%, 0% 100%, 100% 100%)';
                    }

                    layer.appendChild(piece);
                }
            })();
        </script>
    @endif
</body>

</html>
