@extends('admin.layouts.app')

@section('main')
    @php
        use App\Models\Admin;
        use App\Models\ExamControl;
        use Carbon\Carbon;
        use Illuminate\Support\Facades\DB;

        $user = Auth::guard('admin')->user();
        $now = Carbon::now();

        $exam = ExamControl::findOrFail(1);

        /*
        |--------------------------------------------------------------------------
        | Admin Dashboard Data
        |--------------------------------------------------------------------------
        */

        $studentQuery = Admin::query()->where('role_id', 3);
        $activeStudentQuery = Admin::query()->where('role_id', 3)->where('blocked', false)->where('trash', false);

        $verified = (clone $activeStudentQuery)->where('status', true)->count();
        $unverified = (clone $activeStudentQuery)->where('status', false)->count();

        $blockedStudents = (clone $studentQuery)->where('blocked', true)->count();
        $trashedStudents = (clone $studentQuery)->where('trash', true)->count();

        $totalStudent = $verified + $unverified;

        $participate = (clone $activeStudentQuery)->where('status', true)->where('round_one_status', true)->count();
        $participate2 = (clone $activeStudentQuery)->where('status', true)->where('round_two_status', true)->count();

        $selected = (clone $activeStudentQuery)
            ->where('status', true)
            ->where('round_one_status', true)
            ->where('selected', true)
            ->count();

        $selected2 = (clone $activeStudentQuery)
            ->where('status', true)
            ->where('round_two_status', true)
            ->where('selectedTwo', true)
            ->count();

        $unselected = $participate - $selected;
        $unselected2 = $participate2 - $selected2;

        $roundOneNotStarted = $verified - $participate;
        $roundTwoNotStarted = $selected - $participate2;

        $roundOneHighest = (clone $activeStudentQuery)->where('round_one_status', true)->max('round_one_result');
        $roundTwoHighest = (clone $activeStudentQuery)->where('round_two_status', true)->max('round_two_result');

        $roundOneLowest = (clone $activeStudentQuery)
            ->where('round_one_status', true)
            ->whereNotNull('round_one_result')
            ->min('round_one_result');

        $roundTwoLowest = (clone $activeStudentQuery)
            ->where('round_two_status', true)
            ->whereNotNull('round_two_result')
            ->min('round_two_result');

        $roundOneAverage = (clone $activeStudentQuery)->where('round_one_status', true)->avg('round_one_result');
        $roundTwoAverage = (clone $activeStudentQuery)->where('round_two_status', true)->avg('round_two_result');

        $roundOneZeroMark = (clone $activeStudentQuery)
            ->where('round_one_status', true)
            ->where('round_one_result', 0)
            ->count();

        $roundTwoZeroMark = (clone $activeStudentQuery)
            ->where('round_two_status', true)
            ->where('round_two_result', 0)
            ->count();

        $roundOnePassPercentage = $participate > 0 ? number_format(($selected / $participate) * 100, 2) : 0;
        $roundTwoPassPercentage = $participate2 > 0 ? number_format(($selected2 / $participate2) * 100, 2) : 0;

        $roundOneFailPercentage = $participate > 0 ? number_format(($unselected / $participate) * 100, 2) : 0;
        $roundTwoFailPercentage = $participate2 > 0 ? number_format(($unselected2 / $participate2) * 100, 2) : 0;

        $roundOneFastest = (clone $activeStudentQuery)
            ->where('round_one_status', true)
            ->whereNotNull('duration')
            ->where('duration', '>', 0)
            ->min('duration');

        $roundTwoFastest = (clone $activeStudentQuery)
            ->where('round_two_status', true)
            ->whereNotNull('durationTwo')
            ->where('durationTwo', '>', 0)
            ->min('durationTwo');

        $roundOneSlowest = (clone $activeStudentQuery)
            ->where('round_one_status', true)
            ->whereNotNull('duration')
            ->where('duration', '>', 0)
            ->max('duration');

        $roundTwoSlowest = (clone $activeStudentQuery)
            ->where('round_two_status', true)
            ->whereNotNull('durationTwo')
            ->where('durationTwo', '>', 0)
            ->max('durationTwo');

        $roundOneAverageDuration = (clone $activeStudentQuery)
            ->where('round_one_status', true)
            ->whereNotNull('duration')
            ->where('duration', '>', 0)
            ->avg('duration');

        $roundTwoAverageDuration = (clone $activeStudentQuery)
            ->where('round_two_status', true)
            ->whereNotNull('durationTwo')
            ->where('durationTwo', '>', 0)
            ->avg('durationTwo');

        /*
        |--------------------------------------------------------------------------
        | Exam Dates
        |--------------------------------------------------------------------------
        */

        $r1s = Carbon::parse($exam->start_date_time);
        $r1e = Carbon::parse($exam->end_date_time);
        $r1r = Carbon::parse($exam->result_published_time);

        $r2s = Carbon::parse($exam->next_round_date);
        $r2e = Carbon::parse($exam->next_round_end_date);
        $r2r = Carbon::parse($exam->result_published_time_round_two);

        $r3s = Carbon::parse($exam->third_round_date);
        $r3e = Carbon::parse($exam->third_round_end_date);
        $r3r = Carbon::parse($exam->result_published_time_round_third);

        $dateFormat = 'l, F j, Y, g:i A';

        $start_time = $r1s->format($dateFormat);
        $end_time = $r1e->format($dateFormat);
        $result = $r1r->format($dateFormat);

        $start_time2 = $r2s->format($dateFormat);
        $end_time2 = $r2e->format($dateFormat);
        $result2 = $r2r->format($dateFormat);

        $start_time3 = $r3s->format($dateFormat);
        $end_time3 = $r3e->format($dateFormat);
        $result3 = $r3r->format($dateFormat);

        /*
                |--------------------------------------------------------------------------
                | Result Visibility
                |--------------------------------------------------------------------------
                | Student results, qualification status, scores, accuracy and answer review
                | will be shown only after each round's published date/time.
        */

$showRoundOneResult = $now->gte($r1r);
$showRoundTwoResult = $now->gte($r2r);
$showRoundThreeResult = $now->gte($r3r);

$bootcamp = Carbon::parse($exam->bootcamp_date)->format($dateFormat);

/*
        |--------------------------------------------------------------------------
        | Helpers
        |--------------------------------------------------------------------------
        */

$formatDuration = function ($duration) {
    if (!$duration || $duration <= 0) {
        return 'N/A';
    }

    $duration = (int) $duration;
    $minutes = floor($duration / 60);
    $seconds = $duration % 60;

    return $minutes . ' min ' . $seconds . ' sec';
};

$getRoundStatus = function ($start, $end, $now) {
    if ($now->lt($start)) {
        return ['label' => 'Upcoming', 'class' => 'badge-warning'];
    }

    if ($now->between($start, $end)) {
        return ['label' => 'Live', 'class' => 'badge-success'];
    }

    return ['label' => 'Closed', 'class' => 'badge-danger'];
};

$compareAnswer = function ($studentAnswer, $correctAnswer) {
    return strtolower(trim((string) $studentAnswer)) === strtolower(trim((string) $correctAnswer));
};

$decodeOptions = function ($options) {
    $decoded = json_decode($options, true);

    if (is_array($decoded)) {
        return $decoded;
    }

    return [];
};

$getQuestionImageUrl = function ($image, $round = 1) {
    if (empty($image)) {
        return null;
    }

    if (filter_var($image, FILTER_VALIDATE_URL)) {
        return $image;
    }

    $image = ltrim($image, '/');

    if (str_starts_with($image, 'storage/') || str_starts_with($image, 'uploads/')) {
        return asset($image);
    }

    if ($round == 2) {
        return asset('storage/questionTwo/' . $image);
    }

    return asset('storage/question/' . $image);
};

$getEligibilityText = function ($eligible) {
    return $eligible ? 'Eligible' : 'Not Eligible';
};

$getEligibilityClass = function ($eligible) {
    return $eligible ? 'badge-success' : 'badge-danger';
};

$roundOneStatus = $getRoundStatus($r1s, $r1e, $now);
$roundTwoStatus = $getRoundStatus($r2s, $r2e, $now);
$roundThreeStatus = $getRoundStatus($r3s, $r3e, $now);

$roundOneDuration = $formatDuration($user->duration ?? 0);
$roundTwoDuration = $formatDuration($user->durationTwo ?? 0);

$roundOneCompleted = $user->round_one_status;
$roundTwoCompleted = $user->round_two_status;

/*
        |--------------------------------------------------------------------------
        | Student Dashboard Data
        |--------------------------------------------------------------------------
        | Correct DB structure based on screenshot:
        | Round 1:
        | - answerd_questions.question_id = question_answers.id
        | - question_answers.question = question
        | - question_answers.option = JSON options
        | - question_answers.answer = correct answer
        |
        | Round 2:
        | - answerd_question_twos.question_id = question_answer_twos.id
        | - question_answer_twos.question = question
        | - question_answer_twos.option = JSON options
        | - question_answer_twos.answer = correct answer
        */

$roundOneEligible = false;
$roundTwoEligible = false;
$roundThreeEligible = false;

$studentNextStep = 'Please wait for the next update.';
$studentProgress = 0;

$roundOneAnswers = collect();
$roundTwoAnswers = collect();

$roundOneAnsweredCount = 0;
$roundOneCorrectCount = 0;
$roundOneWrongCount = 0;
$roundOneAccuracy = 0;
$roundOneTotalQuestions = 0;

$roundTwoAnsweredCount = 0;
$roundTwoCorrectCount = 0;
$roundTwoWrongCount = 0;
$roundTwoAccuracy = 0;
$roundTwoTotalQuestions = 0;

if ($user->role_id == 3) {
    $roundOneEligible = $user->status && !$user->blocked && !$user->trash;
    $roundTwoEligible = $user->selected;
    $roundThreeEligible = $user->selectedTwo;

    if (!$user->status) {
        $studentNextStep = 'Your profile is pending verification.';
    } elseif ($now->between($r1s, $r1e) && !$user->round_one_status) {
        $studentNextStep = 'Round 1 is live. You can start your exam now.';
    } elseif ($user->round_one_status && !$showRoundOneResult) {
        $studentNextStep = 'You have completed Round 1. Result will be published on ' . $result . '.';
    } elseif ($showRoundOneResult && $user->round_one_status && !$user->selected) {
        $studentNextStep = 'You have completed Round 1. You are not eligible for Round 2.';
    } elseif ($showRoundOneResult && $user->selected && !$user->round_two_status && $now->between($r2s, $r2e)) {
        $studentNextStep = 'Round 2 is live. You can start your exam now.';
    } elseif ($user->round_two_status && !$showRoundTwoResult) {
        $studentNextStep = 'You have completed Round 2. Result will be published on ' . $result2 . '.';
    } elseif ($showRoundTwoResult && $user->round_two_status && !$user->selectedTwo) {
        $studentNextStep = 'You have completed Round 2. You are not eligible for the final round.';
    } elseif ($showRoundTwoResult && $user->selectedTwo && $now->between($r3s, $r3e)) {
        $studentNextStep = 'Final round is live. You can start your exam now.';
    } elseif ($showRoundTwoResult && $user->selectedTwo) {
        $studentNextStep = 'You are eligible for the final round.';
    } elseif ($showRoundOneResult && $user->selected) {
        $studentNextStep = 'You are eligible for Round 2.';
    }

    if ($user->status) {
        $studentProgress += 20;
    }

    if ($user->round_one_status) {
        $studentProgress += 25;
    }

    if ($user->selected) {
        $studentProgress += 15;
    }

    if ($user->round_two_status) {
        $studentProgress += 25;
    }

    if ($user->selectedTwo) {
        $studentProgress += 15;
    }

    $studentProgress = min($studentProgress, 100);

    $roundOneTotalQuestions = (int) \App\Models\Category::where('status', 1)
        ->where('is_archive', 0)
        ->sum('question_size');

    $roundTwoTotalQuestions = (int) \App\Models\CategoryTwo::where('status', 1)
        ->where('is_archive', 0)
        ->sum('question_size');

    if ($user->round_one_status) {
        $roundOneAnswers = DB::table('answerd_questions')
            ->join('question_answers', 'question_answers.id', '=', 'answerd_questions.question_id')
            ->where('answerd_questions.user_id', $user->id)
            ->select(
                'question_answers.id as question_id',
                'answerd_questions.id as answered_id',
                'answerd_questions.answer as student_answer',
                'question_answers.category_id',
                'question_answers.question',
                'question_answers.image_question',
                'question_answers.option',
                'question_answers.answer as correct_answer',
            )
            ->orderBy('answerd_questions.id', 'asc')
            ->get();

        $roundOneAnsweredCount = $roundOneAnswers->count();

        $roundOneCorrectCount = $roundOneAnswers
            ->filter(function ($item) use ($compareAnswer) {
                return $compareAnswer($item->student_answer, $item->correct_answer);
            })
            ->count();

        $roundOneWrongCount = max($roundOneAnsweredCount - $roundOneCorrectCount, 0);
        $roundOneAccuracy =
            $roundOneAnsweredCount > 0
                ? number_format(($roundOneCorrectCount / $roundOneAnsweredCount) * 100, 2)
                : 0;
    }

    if ($user->round_two_status) {
        $roundTwoAnswers = DB::table('answerd_question_twos')
            ->join('question_answer_twos', 'question_answer_twos.id', '=', 'answerd_question_twos.question_id')
            ->where('answerd_question_twos.user_id', $user->id)
            ->select(
                'question_answer_twos.id as question_id',
                'answerd_question_twos.id as answered_id',
                'answerd_question_twos.answer as student_answer',
                'question_answer_twos.category_id',
                'question_answer_twos.question',
                'question_answer_twos.image_question',
                'question_answer_twos.option',
                'question_answer_twos.answer as correct_answer',
            )
            ->orderBy('answerd_question_twos.id', 'asc')
                    ->get();

                $roundTwoAnsweredCount = $roundTwoAnswers->count();

                $roundTwoCorrectCount = $roundTwoAnswers
                    ->filter(function ($item) use ($compareAnswer) {
                        return $compareAnswer($item->student_answer, $item->correct_answer);
                    })
                    ->count();

                $roundTwoWrongCount = max($roundTwoAnsweredCount - $roundTwoCorrectCount, 0);
                $roundTwoAccuracy =
                    $roundTwoAnsweredCount > 0
                        ? number_format(($roundTwoCorrectCount / $roundTwoAnsweredCount) * 100, 2)
                        : 0;
            }
        }

$roundOneScoreMessage = 'Score, duration and accuracy will appear after Round 1 exam submission.';
$roundOneAccuracyMessage = 'Accuracy will appear after Round 1 exam submission.';
$roundOneResultMessage = 'Score, duration and accuracy will appear after Round 1 exam submission. Result will be published on <b>' . $result . '</b>.';

if (!$user->status) {
    $roundOneScoreMessage = 'Your profile is pending verification.';
    $roundOneAccuracyMessage = 'Your profile is pending verification.';
    $roundOneResultMessage = 'Your profile is pending verification. After approval, you can participate in Round 1.';
} elseif ($now->lt($r1s)) {
    $roundOneScoreMessage = 'Round 1 has not started yet.';
    $roundOneAccuracyMessage = 'Round 1 has not started yet.';
    $roundOneResultMessage = 'Round 1 has not started yet. Exam will begin on <b>' . $start_time . '</b>.';
} elseif ($now->between($r1s, $r1e) && !$roundOneCompleted) {
    $roundOneScoreMessage = 'Round 1 is live. Submit your exam to see score and duration.';
    $roundOneAccuracyMessage = 'Round 1 is live. Submit your exam to see accuracy.';
    $roundOneResultMessage = 'Round 1 is live. Submit your exam to see score, duration and accuracy.';
}

$roundTwoScoreMessage = 'Round 2 has not started yet.';
$roundTwoAccuracyMessage = 'Round 2 has not started yet.';
$roundTwoResultMessage = 'Round 2 has not started yet.';

if ($showRoundOneResult && !$roundTwoEligible) {
    $roundTwoScoreMessage = 'Round 2 is available only for eligible students.';
    $roundTwoAccuracyMessage = 'Round 2 is available only for eligible students.';
    $roundTwoResultMessage = 'Round 2 is available only for students eligible after Round 1 result publication.';
} elseif (!$showRoundOneResult) {
    $roundTwoScoreMessage = 'Round 2 will open after Round 1 result publication.';
    $roundTwoAccuracyMessage = 'Round 2 will open after Round 1 result publication.';
    $roundTwoResultMessage = 'Round 2 will open after Round 1 result publication.';
} elseif ($roundTwoEligible && $now->lt($r2s)) {
    $roundTwoScoreMessage = 'Round 2 has not started yet.';
    $roundTwoAccuracyMessage = 'Round 2 has not started yet.';
    $roundTwoResultMessage = 'Round 2 has not started yet. Exam will begin on <b>' . $start_time2 . '</b>.';
} elseif ($roundTwoEligible && $now->between($r2s, $r2e) && !$roundTwoCompleted) {
    $roundTwoScoreMessage = 'Round 2 is live. Submit your exam to see score and duration.';
    $roundTwoAccuracyMessage = 'Round 2 is live. Submit your exam to see accuracy.';
    $roundTwoResultMessage = 'Round 2 is live. Submit your exam to see score, duration and accuracy.';
} elseif ($roundTwoEligible && !$roundTwoCompleted) {
    $roundTwoScoreMessage = 'Score and duration will appear after Round 2 exam submission.';
    $roundTwoAccuracyMessage = 'Accuracy will appear after Round 2 exam submission.';
    $roundTwoResultMessage = 'Score, duration and accuracy will appear after Round 2 exam submission. Result will be published on <b>' . $result2 . '</b>.';
}

    @endphp

    <style>
        .dashboard-page {
            --dark: #101827;
            --title: #0f172a;
            --muted: #667085;
            --border: #e6ebf2;
            --soft: #f7f9fc;
            --soft-2: #eef4ff;
            --primary: #1d4ed8;
            --primary-2: #2563eb;
            --primary-soft: #eaf1ff;
            --success: #ffffff;
            --success-soft: #e9f9ef;
            --danger: #ffffff;
            --danger-soft: #fff1f2;
            --warning: #d97706;
            --warning-soft: #fff7e6;
            --card-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
            --soft-shadow: 0 10px 28px rgba(15, 23, 42, 0.06);
            background:
                radial-gradient(circle at top left, rgba(37, 99, 235, 0.08), transparent 32%),
                radial-gradient(circle at top right, rgba(14, 165, 233, 0.06), transparent 28%);
            padding-bottom: 30px;
        }

        .dashboard-page .dashboard-hero,
        .dashboard-page .data-card,
        .dashboard-page .info-box,
        .dashboard-page .student-profile-card {
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(230, 235, 242, 0.9);
            border-radius: 24px;
            box-shadow: var(--card-shadow);
            backdrop-filter: blur(10px);
        }

        .dashboard-page .dashboard-hero {
            position: relative;
            overflow: hidden;
            background:
                linear-gradient(135deg, rgba(255, 255, 255, 0.97) 0%, rgba(245, 248, 255, 0.98) 55%, rgba(238, 244, 255, 0.95) 100%);
            padding: 30px;
            margin-bottom: 28px;
        }

        .dashboard-page .dashboard-hero:before {
            content: "";
            position: absolute;
            width: 210px;
            height: 210px;
            right: -70px;
            top: -90px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.16), transparent 68%);
            border-radius: 50%;
        }

        .dashboard-page .student-hero {
            border-left: 7px solid var(--primary);
        }

        .dashboard-page .dashboard-hero h3 {
            position: relative;
            font-size: 30px;
            line-height: 1.15;
            font-weight: 900;
            color: var(--title);
            margin-bottom: 8px;
            letter-spacing: -0.03em;
        }

        .dashboard-page .dashboard-hero p,
        .dashboard-page .small-text {
            color: var(--muted);
            margin-bottom: 0;
            line-height: 1.6;
        }

        .dashboard-page .data-card {
            position: relative;
            overflow: hidden;
            padding: 22px;
            margin-bottom: 24px;
            height: calc(100% - 24px);
            transition: all .25s ease;
        }

        .dashboard-page .data-card:before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            height: 4px;
            width: 100%;
            background: linear-gradient(90deg, var(--primary), rgba(14, 165, 233, 0.65));
            opacity: 0;
            transition: opacity .25s ease;
        }

        .dashboard-page .data-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 22px 50px rgba(15, 23, 42, 0.10);
        }

        .dashboard-page .data-card:hover:before {
            opacity: 1;
        }

        .dashboard-page .label {
            color: var(--muted);
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .dashboard-page .value {
            font-size: 31px;
            line-height: 1.15;
            font-weight: 900;
            color: var(--title);
            margin-bottom: 0;
            letter-spacing: -0.03em;
        }

        .dashboard-page .small-text {
            font-size: 13px;
            margin-top: 8px;
        }

        .dashboard-page .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 21px;
            font-weight: 900;
            color: var(--title);
            margin: 16px 0 18px;
            letter-spacing: -0.02em;
        }

        .dashboard-page .section-title:before {
            content: "";
            width: 7px;
            height: 22px;
            border-radius: 999px;
            background: linear-gradient(180deg, var(--primary), #38bdf8);
        }

        .dashboard-page .info-box {
            padding: 24px;
            margin-bottom: 24px;
        }

        .dashboard-page .info-box h4 {
            color: var(--title);
            font-size: 19px;
            font-weight: 900;
            margin-bottom: 16px;
            letter-spacing: -0.02em;
        }

        .dashboard-page .result-box {
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 18px;
            background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
            margin-bottom: 16px;
            box-shadow: var(--soft-shadow);
        }

        .dashboard-page .result-box p {
            margin-bottom: 8px;
            color: #344054;
            line-height: 1.55;
        }

        .dashboard-page .result-box h5,
        .dashboard-page .result-box h6 {
            font-weight: 900;
            color: var(--title);
            margin-bottom: 12px;
            letter-spacing: -0.02em;
        }

        .dashboard-page .quick-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .dashboard-page .btn {
            border-radius: 12px;
            font-weight: 800;
            padding: 9px 15px;
            box-shadow: none;
        }

        .dashboard-page .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-2) 100%);
            border-color: var(--primary);
            box-shadow: 0 12px 24px rgba(37, 99, 235, 0.18);
        }

        .dashboard-page .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 28px rgba(37, 99, 235, 0.24);
        }

        .dashboard-page .badge {
            font-size: 12px;
            border-radius: 999px;
            padding: 7px 11px;
            font-weight: 800;
            letter-spacing: .01em;
        }

        .dashboard-page .student-hero .badge {
            font-size: 14px;
            padding: 9px 15px;
        }

        .dashboard-page .badge-success {
            background: var(--success-soft);
            color: var(--success);
        }

        .dashboard-page .badge-danger {
            background: var(--danger-soft);
            color: var(--danger);
        }

        .dashboard-page .badge-warning {
            background: var(--warning-soft);
            color: var(--warning);
        }

        .dashboard-page .badge-primary {
            background: var(--primary-soft);
            color: #fff;
        }

        .dashboard-page .badge-light {
            background: rgba(255, 255, 255, 0.24);
            color: inherit;
        }

        .dashboard-page .list-group-item {
            font-weight: 800;
            font-size: 13px;
            border-color: var(--border);
            color: #344054;
        }

        .dashboard-page .list-group-item.active {
            background: linear-gradient(135deg, var(--primary), var(--primary-2));
            border-color: var(--primary);
            color: #ffffff;
        }

        .dashboard-page .tab-content {
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 20px;
            background: #ffffff;
            min-height: 210px;
            box-shadow: var(--soft-shadow);
        }

        .dashboard-page .progress-wrap {
            background: #dbeafe;
            border-radius: 999px;
            height: 12px;
            overflow: hidden;
            margin-top: 16px;
            box-shadow: inset 0 1px 3px rgba(15, 23, 42, 0.08);
        }

        .dashboard-page .progress-fill {
            background: linear-gradient(90deg, var(--primary), #38bdf8);
            height: 12px;
            border-radius: 999px;
            box-shadow: 0 8px 18px rgba(37, 99, 235, 0.20);
        }

        .dashboard-page .profile-initial {
            width: 68px;
            height: 68px;
            border-radius: 22px;
            background: linear-gradient(135deg, var(--primary), #38bdf8);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: 900;
            margin-bottom: 14px;
            box-shadow: 0 16px 30px rgba(37, 99, 235, 0.20);
        }

        .dashboard-page .profile-name {
            font-size: 21px;
            font-weight: 900;
            color: var(--title);
            margin-bottom: 4px;
            letter-spacing: -0.02em;
        }

        .dashboard-page .profile-meta {
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 8px;
            line-height: 1.5;
        }

        .dashboard-page .timeline {
            list-style: none;
            padding-left: 0;
            margin-bottom: 0;
        }

        .dashboard-page .timeline li {
            display: flex;
            gap: 13px;
            align-items: flex-start;
            padding: 14px 0;
            border-bottom: 1px solid var(--border);
            color: #344054;
            font-weight: 800;
        }

        .dashboard-page .timeline li:last-child {
            border-bottom: none;
        }

        .dashboard-page .timeline-dot {
            width: 28px;
            height: 28px;
            min-width: 28px;
            border-radius: 50%;
            background: var(--primary-soft);
            color: var(--primary);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 900;
            box-shadow: 0 8px 16px rgba(37, 99, 235, 0.10);
        }

        .dashboard-page .timeline-dot.done {
            background: var(--success-soft);
            color: var(--success);
            box-shadow: 0 8px 16px rgba(21, 128, 61, 0.10);
        }

        .dashboard-page .accordion-card {
            border: 1px solid var(--border);
            border-radius: 22px;
            overflow: hidden;
            margin-bottom: 18px;
            background: #ffffff;
            box-shadow: var(--card-shadow);
        }

        .dashboard-page .accordion-header {
            padding: 18px 22px;
            background: linear-gradient(135deg, #ffffff, #f7faff);
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            border-bottom: 1px solid var(--border);
        }

        .dashboard-page .accordion-header h4 {
            margin: 0;
            font-size: 18px;
            font-weight: 900;
            color: var(--title);
            letter-spacing: -0.02em;
        }

        .dashboard-page .accordion-body {
            padding: 22px;
        }

        .dashboard-page .qa-box {
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 18px;
            background: #ffffff;
            margin-bottom: 16px;
            box-shadow: var(--soft-shadow);
        }

        .dashboard-page .qa-question {
            font-weight: 900;
            color: var(--title);
            margin-bottom: 14px;
            line-height: 1.65;
            letter-spacing: -0.01em;
        }

        .dashboard-page .option-list {
            margin: 14px 0;
        }

        .dashboard-page .option-item {
            border: 1px solid var(--border);
            border-radius: 15px;
            padding: 12px 14px;
            margin-bottom: 9px;
            background: #ffffff;
            color: #344054;
            display: flex;
            gap: 10px;
            align-items: flex-start;
            justify-content: space-between;
            transition: all .2s ease;
        }

        .dashboard-page .option-item:hover {
            border-color: #c9d7ee;
            background: #fbfdff;
        }

        .dashboard-page .option-item.correct-option {
            border-color: #86efac;
            background: linear-gradient(135deg, #f0fdf4, #ffffff);
        }

        .dashboard-page .option-item.wrong-option {
            border-color: #fecaca;
            background: linear-gradient(135deg, #fff1f2, #ffffff);
        }

        .dashboard-page .option-text {
            font-weight: 700;
            line-height: 1.55;
        }

        .dashboard-page .option-tags {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .dashboard-page .answer-line {
            background: linear-gradient(180deg, #ffffff, #f8fbff);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 12px 14px;
            margin-bottom: 8px;
        }

        .dashboard-page .answer-label {
            font-weight: 900;
            color: var(--muted);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .08em;
            display: block;
            margin-bottom: 5px;
        }

        .dashboard-page .qa-scroll {
            max-height: 760px;
            overflow-y: auto;
            padding-right: 5px;
        }

        .dashboard-page .qa-review-modal .modal-dialog {
            max-width: 1180px;
        }

        .dashboard-page .qa-review-modal .modal-content {
            border: 0;
            border-radius: 26px;
            overflow: hidden;
            box-shadow: 0 30px 90px rgba(15, 23, 42, 0.22);
        }

        .dashboard-page .qa-review-modal .modal-header {
            background:
                radial-gradient(circle at top right, rgba(56, 189, 248, 0.18), transparent 34%),
                linear-gradient(135deg, #ffffff 0%, #f4f7ff 100%);
            border-bottom: 1px solid var(--border);
            padding: 24px 28px;
        }

        .dashboard-page .qa-review-modal .modal-title {
            font-weight: 900;
            color: var(--title);
            letter-spacing: -0.03em;
            font-size: 23px;
        }

        .dashboard-page .qa-review-modal .modal-body {
            background:
                radial-gradient(circle at top left, rgba(37, 99, 235, 0.06), transparent 30%),
                #f8fbff;
            padding: 26px;
        }

        .dashboard-page .qa-review-modal .modal-footer {
            border-top: 1px solid var(--border);
            padding: 18px 26px;
            background: #ffffff;
        }

        .dashboard-page .qa-modal-tabs .nav-link {
            border-radius: 999px;
            font-weight: 900;
            color: var(--title);
            background: #ffffff;
            border: 1px solid var(--border);
            margin-right: 10px;
            padding: 10px 16px;
            box-shadow: var(--soft-shadow);
        }

        .dashboard-page .qa-modal-tabs .nav-link.active {
            background: linear-gradient(135deg, var(--primary), var(--primary-2));
            border-color: var(--primary);
            color: #ffffff;
            box-shadow: 0 14px 28px rgba(37, 99, 235, 0.22);
        }

        .dashboard-page .qa-summary-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 18px;
            margin-bottom: 12px;
            box-shadow: var(--soft-shadow);
        }

        .dashboard-page .qa-summary-card span {
            display: block;
            color: var(--muted);
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .08em;
            margin-bottom: 6px;
        }

        .dashboard-page .qa-summary-card strong {
            font-size: 26px;
            color: var(--title);
            font-weight: 900;
            letter-spacing: -0.03em;
        }


        .dashboard-page .question-image-box {
            margin: 14px 0 16px;
            border: 1px solid var(--border);
            border-radius: 18px;
            background: linear-gradient(180deg, #ffffff, #f8fbff);
            padding: 16px;
            text-align: center;
            box-shadow: var(--soft-shadow);
        }

        .dashboard-page .question-image-box img {
            max-width: 100%;
            max-height: 150px;
            object-fit: contain;
            border-radius: 14px;
        }

        @media (max-width: 767px) {

            .dashboard-page .dashboard-hero,
            .dashboard-page .data-card,
            .dashboard-page .info-box {
                padding: 18px;
            }

            .dashboard-page .dashboard-hero h3 {
                font-size: 24px;
            }

            .dashboard-page .notice-tabs .col-4,
            .dashboard-page .notice-tabs .col-8 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .dashboard-page .tab-content {
                margin-top: 15px;
            }

            .dashboard-page .option-item {
                display: block;
            }

            .dashboard-page .option-tags {
                margin-top: 8px;
                justify-content: flex-start;
            }

            .dashboard-page .qa-review-modal .modal-body {
                padding: 18px;
            }
        }
    </style>

    <div class="dashboard-page">
        @include('validate-main')

        @if ($user->role_id == 3)
            @if ($now->between($r1s, $r1e) && !$user->round_one_status && $roundOneEligible)
                <a class="btn btn-primary mb-4" data-toggle="modal" data-target="#rulesModal" style="cursor:pointer;">
                    Start Round 1 Exam
                </a>
            @endif

            @if ($now->between($r2s, $r2e) && !$user->round_two_status && $roundTwoEligible)
                <a class="btn btn-primary mb-4" data-toggle="modal" data-target="#rulesModal" style="cursor:pointer;">
                    Start Round 2 Exam
                </a>
            @endif

            @if ($now->between($r3s, $r3e) && $roundThreeEligible)
                <a class="btn btn-primary mb-4" href="{{ route('round.three') }}">
                    Start Final Round Exam
                </a>
            @endif
        @endif

        @if ($user->role_id == 1)
            <div class="dashboard-hero">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h3>Olympiad Admin Dashboard</h3>
                        <p>Monitor registration, participation, qualification, exam status, and performance insights.</p>
                    </div>

                    <div class="col-lg-4 text-lg-right mt-3 mt-lg-0">
                        <div class="quick-actions justify-content-lg-end">
                            <a href="{{ route('round.one.export') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-download mr-1"></i> Round 1 Sheet
                            </a>

                            <a href="{{ route('round.two.export') }}" class="btn btn-success btn-sm">
                                <i class="fa fa-download mr-1"></i> Round 2 Sheet
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <h4 class="section-title">Overall Statistics</h4>

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Total Students</div>
                        <h3 class="value">{{ $totalStudent }}</h3>
                        <p class="small-text">Verified and unverified active students.</p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Verified Students</div>
                        <h3 class="value">{{ $verified }}</h3>
                        <p class="small-text">Approved students.</p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Unverified Students</div>
                        <h3 class="value">{{ $unverified }}</h3>
                        <p class="small-text">Pending verification.</p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Blocked / Trash</div>
                        <h3 class="value">{{ $blockedStudents }} / {{ $trashedStudents }}</h3>
                        <p class="small-text">Inactive records.</p>
                    </div>
                </div>
            </div>

            <h4 class="section-title">Exam Status</h4>

            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="data-card">
                        <div class="label">Round 1 Status</div>
                        <h3 class="value">
                            <span class="badge {{ $roundOneStatus['class'] }}">{{ $roundOneStatus['label'] }}</span>
                        </h3>
                        <p class="small-text">{{ $start_time }} to {{ $end_time }}</p>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="data-card">
                        <div class="label">Round 2 Status</div>
                        <h3 class="value">
                            <span class="badge {{ $roundTwoStatus['class'] }}">{{ $roundTwoStatus['label'] }}</span>
                        </h3>
                        <p class="small-text">{{ $start_time2 }} to {{ $end_time2 }}</p>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="data-card">
                        <div class="label">Round 3 Status</div>
                        <h3 class="value">
                            <span class="badge {{ $roundThreeStatus['class'] }}">{{ $roundThreeStatus['label'] }}</span>
                        </h3>
                        <p class="small-text">{{ $start_time3 }} to {{ $end_time3 }}</p>
                    </div>
                </div>
            </div>

            <h4 class="section-title">Round One Analytics</h4>

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Participated</div>
                        <h3 class="value">{{ $participate }}</h3>
                        <p class="small-text">Completed round one.</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Selected</div>
                        <h3 class="value">{{ $selected }}</h3>
                        <p class="small-text">Qualified for round two.</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Unselected</div>
                        <h3 class="value">{{ $unselected }}</h3>
                        <p class="small-text">Not qualified.</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Yet to Start</div>
                        <h3 class="value">{{ max($roundOneNotStarted, 0) }}</h3>
                        <p class="small-text">Verified but not participated.</p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Pass Rate</div>
                        <h3 class="value">{{ $roundOnePassPercentage }}%</h3>
                        <p class="small-text">Selected from participants.</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Fail Rate</div>
                        <h3 class="value">{{ $roundOneFailPercentage }}%</h3>
                        <p class="small-text">Unselected from participants.</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Highest Marks</div>
                        <h3 class="value">{{ $roundOneHighest ?? 0 }}</h3>
                        <p class="small-text">Top score.</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Lowest Marks</div>
                        <h3 class="value">{{ $roundOneLowest ?? 0 }}</h3>
                        <p class="small-text">Lowest score.</p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Average Marks</div>
                        <h3 class="value">{{ $roundOneAverage ? number_format($roundOneAverage, 2) : 0 }}</h3>
                        <p class="small-text">Average score.</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Zero Marks</div>
                        <h3 class="value">{{ $roundOneZeroMark }}</h3>
                        <p class="small-text">Scored zero.</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Fastest Duration</div>
                        <h3 class="value">{{ $formatDuration($roundOneFastest) }}</h3>
                        <p class="small-text">Shortest time.</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Slowest Duration</div>
                        <h3 class="value">{{ $formatDuration($roundOneSlowest) }}</h3>
                        <p class="small-text">Longest time.</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Average Duration</div>
                        <h3 class="value">{{ $formatDuration($roundOneAverageDuration) }}</h3>
                        <p class="small-text">Average completion time.</p>
                    </div>
                </div>
            </div>

            <h4 class="section-title">Round Two Analytics</h4>

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Participated</div>
                        <h3 class="value">{{ $participate2 }}</h3>
                        <p class="small-text">Completed round two.</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Top 15 Qualified</div>
                        <h3 class="value">{{ $selected2 }}</h3>
                        <p class="small-text">Qualified for next stage.</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Unselected</div>
                        <h3 class="value">{{ $unselected2 }}</h3>
                        <p class="small-text">Not qualified.</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Yet to Start</div>
                        <h3 class="value">{{ max($roundTwoNotStarted, 0) }}</h3>
                        <p class="small-text">Eligible but not participated.</p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Pass Rate</div>
                        <h3 class="value">{{ $roundTwoPassPercentage }}%</h3>
                        <p class="small-text">Qualified from participants.</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Fail Rate</div>
                        <h3 class="value">{{ $roundTwoFailPercentage }}%</h3>
                        <p class="small-text">Unselected from participants.</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Highest Marks</div>
                        <h3 class="value">{{ $roundTwoHighest ?? 0 }}</h3>
                        <p class="small-text">Top score.</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Lowest Marks</div>
                        <h3 class="value">{{ $roundTwoLowest ?? 0 }}</h3>
                        <p class="small-text">Lowest score.</p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Average Marks</div>
                        <h3 class="value">{{ $roundTwoAverage ? number_format($roundTwoAverage, 2) : 0 }}</h3>
                        <p class="small-text">Average score.</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Zero Marks</div>
                        <h3 class="value">{{ $roundTwoZeroMark }}</h3>
                        <p class="small-text">Scored zero.</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Fastest Duration</div>
                        <h3 class="value">{{ $formatDuration($roundTwoFastest) }}</h3>
                        <p class="small-text">Shortest time.</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Slowest Duration</div>
                        <h3 class="value">{{ $formatDuration($roundTwoSlowest) }}</h3>
                        <p class="small-text">Longest time.</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Average Duration</div>
                        <h3 class="value">{{ $formatDuration($roundTwoAverageDuration) }}</h3>
                        <p class="small-text">Average completion time.</p>
                    </div>
                </div>
            </div>
        @endif

        @if ($user->role_id == 3)
            <div class="dashboard-hero student-hero">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h3>Welcome, {{ $user->name ?? 'Student' }}</h3>
                        <p>{{ $studentNextStep }}</p>

                        <div class="progress-wrap">
                            <div class="progress-fill" style="width: {{ $studentProgress }}%;"></div>
                        </div>

                        <p class="small-text mt-2">Overall Progress: {{ $studentProgress }}%</p>
                    </div>

                    <div class="col-lg-4 text-lg-right mt-3 mt-lg-0">
                        <span class="badge {{ $getEligibilityClass($roundOneEligible) }}">
                            {{ $getEligibilityText($roundOneEligible) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h4 class="section-title mt-lg-0">My Eligibility</h4>

                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <div class="data-card">
                                <div class="label">Round 1 Eligibility</div>
                                <h3 class="value">
                                    <span class="badge {{ $getEligibilityClass($roundOneEligible) }}">
                                        {{ $getEligibilityText($roundOneEligible) }}
                                    </span>
                                </h3>
                                <p class="small-text">Available for verified students.</p>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6">
                            <div class="data-card">
                                <div class="label">Round 2 Eligibility</div>
                                <h3 class="value">
                                    @if ($showRoundOneResult)
                                        <span class="badge {{ $getEligibilityClass($roundTwoEligible) }}">
                                            {{ $getEligibilityText($roundTwoEligible) }}
                                        </span>
                                    @else
                                        <span class="badge badge-warning">Pending</span>
                                    @endif
                                </h3>
                                <p class="small-text">Based on Round 1 qualification.</p>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6">
                            <div class="data-card">
                                <div class="label">Final Round Eligibility</div>
                                <h3 class="value">
                                    @if ($showRoundTwoResult)
                                        <span class="badge {{ $getEligibilityClass($roundThreeEligible) }}">
                                            {{ $getEligibilityText($roundThreeEligible) }}
                                        </span>
                                    @else
                                        <span class="badge badge-warning">Pending</span>
                                    @endif
                                </h3>
                                <p class="small-text">Based on Round 2 qualification.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h4 class="section-title">My Performance</h4>

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Round 1 Score</div>
                        <h3 class="value">
                            {{ $roundOneCompleted ? ($user->round_one_result ?? 0) : 'Hidden' }}</h3>
                        <p class="small-text">
                            @if ($roundOneCompleted)
                                Duration: {{ $roundOneDuration }}
                            @else
                                {{ $roundOneScoreMessage }}
                            @endif
                        </p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Round 1 Accuracy</div>
                        <h3 class="value">
                            {{ $roundOneCompleted ? $roundOneAccuracy . '%' : 'Hidden' }}</h3>
                        <p class="small-text">
                            @if ($roundOneCompleted)
                                {{ $roundOneCorrectCount }} correct, {{ $roundOneWrongCount }} wrong out of {{ $roundOneAnsweredCount }} answered.
                            @else
                                {{ $roundOneAccuracyMessage }}
                            @endif
                        </p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Round 2 Score</div>
                        <h3 class="value">
                            {{ $roundTwoCompleted ? ($user->round_two_result ?? 0) : 'Hidden' }}</h3>
                        <p class="small-text">
                            @if ($roundTwoCompleted)
                                Duration: {{ $roundTwoDuration }}
                            @else
                                {{ $roundTwoScoreMessage }}
                            @endif
                        </p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="data-card">
                        <div class="label">Round 2 Accuracy</div>
                        <h3 class="value">
                            {{ $roundTwoCompleted ? $roundTwoAccuracy . '%' : 'Hidden' }}</h3>
                        <p class="small-text">
                            @if ($roundTwoCompleted)
                                {{ $roundTwoCorrectCount }} correct, {{ $roundTwoWrongCount }} wrong out of {{ $roundTwoAnsweredCount }} answered.
                            @else
                                {{ $roundTwoAccuracyMessage }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="info-box">
                        <h4>Round 1 Result</h4>

                        @if ($roundOneCompleted)
                            <div class="result-box">
                                <p><strong>Obtained Marks:</strong> {{ $user->round_one_result ?? 0 }}</p>
                                <p><strong>Duration:</strong> {{ $roundOneDuration }}</p>
                                <p>
                                    <strong>Status:</strong>
                                    @if ($showRoundOneResult)
                                        <span class="badge {{ $user->selected ? 'badge-success' : 'badge-danger' }}">
                                            {{ $user->selected ? 'Qualified' : 'Not Qualified' }}
                                        </span>
                                    @else
                                        <span class="badge badge-warning">Pending until result publication</span>
                                    @endif
                                </p>

                                <a class="btn btn-primary btn-sm mt-2" href="{{ route('get.certificate') }}">
                                    Download Participation Certificate
                                </a>
                                <p class="small-text mb-0">Certificate is available after Round 1 submission.</p>
                            </div>
                        @else
                            <p class="text-muted mb-0">
                                {!! $roundOneResultMessage !!}
                            </p>
                        @endif
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="info-box">
                        <h4>Round 2 Result</h4>

                        @if ($roundTwoCompleted)
                            <div class="result-box">
                                <p><strong>Obtained Marks:</strong> {{ $user->round_two_result ?? 0 }}</p>
                                <p><strong>Duration:</strong> {{ $roundTwoDuration }}</p>
                                <p>
                                    <strong>Status:</strong>
                                    @if ($showRoundTwoResult)
                                        <span class="badge {{ $user->selectedTwo ? 'badge-success' : 'badge-danger' }}">
                                            {{ $user->selectedTwo ? 'Qualified' : 'Not Qualified' }}
                                        </span>
                                    @else
                                        <span class="badge badge-warning">Pending until result publication</span>
                                    @endif
                                </p>
                            </div>
                        @else
                            <p class="text-muted mb-0">
                                {!! $roundTwoResultMessage !!}
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <h4 class="section-title">My Journey</h4>

            <div class="row">
                <div class="col-lg-5">
                    <div class="info-box">
                        <h4>Progress Timeline</h4>

                        <ul class="timeline">
                            <li><span
                                    class="timeline-dot {{ $user->status ? 'done' : '' }}">{{ $user->status ? '✓' : '○' }}</span>Registration
                                Verification</li>
                            <li><span
                                    class="timeline-dot {{ $user->round_one_status ? 'done' : '' }}">{{ $user->round_one_status ? '✓' : '○' }}</span>Round
                                1 Completed</li>
                            <li><span
                                    class="timeline-dot {{ $showRoundOneResult && $user->selected ? 'done' : '' }}">{{ $showRoundOneResult && $user->selected ? '✓' : '○' }}</span>Qualified
                                for Round 2</li>
                            <li><span
                                    class="timeline-dot {{ $user->round_two_status ? 'done' : '' }}">{{ $user->round_two_status ? '✓' : '○' }}</span>Round
                                2 Completed</li>
                            <li><span
                                    class="timeline-dot {{ $showRoundTwoResult && $user->selectedTwo ? 'done' : '' }}">{{ $showRoundTwoResult && $user->selectedTwo ? '✓' : '○' }}</span>Qualified
                                for Final Round</li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="info-box">
                        <h4>Important Timeline</h4>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="result-box">
                                    <h5>Round 1</h5>
                                    <p><strong>Exam:</strong> {{ $start_time }} to {{ $end_time }}</p>
                                    <p><strong>Result:</strong> {{ $result }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="result-box">
                                    <h5>Round 2</h5>
                                    <p><strong>Exam:</strong> {{ $start_time2 }} to {{ $end_time2 }}</p>
                                    <p><strong>Result:</strong> {{ $result2 }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="result-box">
                                    <h5>Bootcamp</h5>
                                    <p><strong>Date:</strong> {{ $bootcamp }}</p>
                                    <p><strong>Venue:</strong> AIUB Permanent Campus</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="result-box">
                                    <h5>Final Round</h5>
                                    <p><strong>Exam:</strong> {{ $start_time3 }} to {{ $end_time3 }}</p>
                                    <p><strong>Result:</strong> {{ $result3 }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (($showRoundOneResult && $user->round_one_status) || ($showRoundTwoResult && $user->round_two_status))
                <h4 class="section-title">Question & Answer Review</h4>

                <div class="info-box">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h4 class="mb-2">Review Your Submitted Answers</h4>
                            <p class="small-text mb-0">
                                View your questions, selected answers, correct answers, and full option list for each
                                completed
                                round.
                            </p>
                        </div>

                        <div class="col-lg-4 text-lg-right mt-3 mt-lg-0">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#questionAnswerModal">
                                View Question & Answer
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal fade qa-review-modal" id="questionAnswerModal" tabindex="-1" role="dialog"
                    aria-labelledby="questionAnswerModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div>
                                    <h5 class="modal-title" id="questionAnswerModalLabel">Question & Answer Review</h5>
                                    <p class="small-text mb-0">Round-wise review of submitted answers.</p>
                                </div>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <ul class="nav nav-pills qa-modal-tabs mb-4" id="qaReviewTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="round-one-tab" data-toggle="pill"
                                            href="#round-one-review" role="tab">
                                            Round 1
                                            <span
                                                class="badge badge-light ml-1">{{ $showRoundOneResult && $user->round_one_status ? $roundOneCorrectCount . '/' . $roundOneAnsweredCount : 'Hidden' }}</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="round-two-tab" data-toggle="pill"
                                            href="#round-two-review" role="tab">
                                            Round 2
                                            <span
                                                class="badge badge-light ml-1">{{ $showRoundTwoResult && $user->round_two_status ? $roundTwoCorrectCount . '/' . $roundTwoAnsweredCount : 'Hidden' }}</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="qaReviewTabContent">
                                    <div class="tab-pane fade show active" id="round-one-review" role="tabpanel">
                                        <div class="row mb-3">
                                            <div class="col-xl-2 col-md-4">
                                                <div class="qa-summary-card">
                                                    <span>Total Questions</span>
                                                    <strong>{{ $roundOneTotalQuestions }}</strong>
                                                </div>
                                            </div>

                                            <div class="col-xl-2 col-md-4">
                                                <div class="qa-summary-card">
                                                    <span>Answered</span>
                                                    <strong>{{ $roundOneAnsweredCount }}</strong>
                                                </div>
                                            </div>

                                            <div class="col-xl-2 col-md-4">
                                                <div class="qa-summary-card">
                                                    <span>Correct</span>
                                                    <strong>{{ $roundOneCorrectCount }}</strong>
                                                </div>
                                            </div>

                                            <div class="col-xl-2 col-md-4">
                                                <div class="qa-summary-card">
                                                    <span>Wrong</span>
                                                    <strong>{{ $roundOneWrongCount }}</strong>
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-md-8">
                                                <div class="qa-summary-card">
                                                    <span>Accuracy</span>
                                                    <strong>{{ $roundOneAccuracy }}%</strong>
                                                </div>
                                            </div>
                                        </div>

                                        @if ($showRoundOneResult && $roundOneAnswers->count() > 0)
                                            @foreach ($roundOneAnswers as $key => $item)
                                                @php
                                                    $isCorrect = $compareAnswer(
                                                        $item->student_answer,
                                                        $item->correct_answer,
                                                    );
                                                    $options = $decodeOptions($item->option);
                                                @endphp

                                                <div class="qa-box">
                                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                                        <h6 class="mb-0">Question {{ $key + 1 }}</h6>

                                                        <span
                                                            class="badge {{ $isCorrect ? 'badge-success' : 'badge-danger' }}">
                                                            {{ $isCorrect ? 'Correct' : 'Wrong' }}
                                                        </span>
                                                    </div>

                                                    <div class="qa-question">
                                                        {{ $item->question ?? 'Question not found' }}
                                                    </div>

                                                    @php
                                                        $questionImageUrl = $getQuestionImageUrl(
                                                            $item->image_question ?? null,
                                                            1,
                                                        );
                                                    @endphp

                                                    @if ($questionImageUrl)
                                                        <div class="question-image-box">
                                                            <img src="{{ $questionImageUrl }}" alt="Question Image">
                                                        </div>
                                                    @endif

                                                    @if (count($options) > 0)
                                                        <div class="option-list">
                                                            @foreach ($options as $option)
                                                                @php
                                                                    $isStudentChoice = $compareAnswer(
                                                                        $option,
                                                                        $item->student_answer,
                                                                    );
                                                                    $isCorrectOption = $compareAnswer(
                                                                        $option,
                                                                        $item->correct_answer,
                                                                    );
                                                                    $optionClass = $isCorrectOption
                                                                        ? 'correct-option'
                                                                        : ($isStudentChoice && !$isCorrectOption
                                                                            ? 'wrong-option'
                                                                            : '');
                                                                @endphp

                                                                <div class="option-item {{ $optionClass }}">
                                                                    <div class="option-text">{{ $option }}</div>

                                                                    <div class="option-tags">
                                                                        @if ($isStudentChoice)
                                                                            <span class="badge badge-primary">Your
                                                                                Choice</span>
                                                                        @endif

                                                                        @if ($isCorrectOption)
                                                                            <span
                                                                                class="badge badge-success">Correct</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="answer-line">
                                                                <span class="answer-label">Your Answer</span>
                                                                {{ !empty($item->student_answer) ? $item->student_answer : 'Not answered' }}
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="answer-line">
                                                                <span class="answer-label">Correct Answer</span>
                                                                {{ $item->correct_answer ?? 'Not available' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-muted mb-0">No Round 1 question review is available yet.</p>
                                        @endif
                                    </div>

                                    <div class="tab-pane fade" id="round-two-review" role="tabpanel">
                                        <div class="row mb-3">
                                            <div class="col-xl-2 col-md-4">
                                                <div class="qa-summary-card">
                                                    <span>Total Questions</span>
                                                    <strong>{{ $roundTwoTotalQuestions }}</strong>
                                                </div>
                                            </div>

                                            <div class="col-xl-2 col-md-4">
                                                <div class="qa-summary-card">
                                                    <span>Answered</span>
                                                    <strong>{{ $roundTwoAnsweredCount }}</strong>
                                                </div>
                                            </div>

                                            <div class="col-xl-2 col-md-4">
                                                <div class="qa-summary-card">
                                                    <span>Correct</span>
                                                    <strong>{{ $roundTwoCorrectCount }}</strong>
                                                </div>
                                            </div>

                                            <div class="col-xl-2 col-md-4">
                                                <div class="qa-summary-card">
                                                    <span>Wrong</span>
                                                    <strong>{{ $roundTwoWrongCount }}</strong>
                                                </div>
                                            </div>

                                            <div class="col-xl-4 col-md-8">
                                                <div class="qa-summary-card">
                                                    <span>Accuracy</span>
                                                    <strong>{{ $roundTwoAccuracy }}%</strong>
                                                </div>
                                            </div>
                                        </div>

                                        @if ($showRoundTwoResult && $roundTwoAnswers->count() > 0)
                                            @foreach ($roundTwoAnswers as $key => $item)
                                                @php
                                                    $isCorrect = $compareAnswer(
                                                        $item->student_answer,
                                                        $item->correct_answer,
                                                    );
                                                    $options = $decodeOptions($item->option);
                                                @endphp

                                                <div class="qa-box">
                                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                                        <h6 class="mb-0">Question {{ $key + 1 }}</h6>

                                                        <span
                                                            class="badge {{ $isCorrect ? 'badge-success' : 'badge-danger' }}">
                                                            {{ $isCorrect ? 'Correct' : 'Wrong' }}
                                                        </span>
                                                    </div>

                                                    <div class="qa-question">
                                                        {{ $item->question ?? 'Question not found' }}
                                                    </div>

                                                    @php
                                                        $questionImageUrl = $getQuestionImageUrl(
                                                            $item->image_question ?? null,
                                                            2,
                                                        );
                                                    @endphp

                                                    @if ($questionImageUrl)
                                                        <div class="question-image-box">
                                                            <img src="{{ $questionImageUrl }}" alt="Question Image">
                                                        </div>
                                                    @endif

                                                    @if (count($options) > 0)
                                                        <div class="option-list">
                                                            @foreach ($options as $option)
                                                                @php
                                                                    $isStudentChoice = $compareAnswer(
                                                                        $option,
                                                                        $item->student_answer,
                                                                    );
                                                                    $isCorrectOption = $compareAnswer(
                                                                        $option,
                                                                        $item->correct_answer,
                                                                    );
                                                                    $optionClass = $isCorrectOption
                                                                        ? 'correct-option'
                                                                        : ($isStudentChoice && !$isCorrectOption
                                                                            ? 'wrong-option'
                                                                            : '');
                                                                @endphp

                                                                <div class="option-item {{ $optionClass }}">
                                                                    <div class="option-text">{{ $option }}</div>

                                                                    <div class="option-tags">
                                                                        @if ($isStudentChoice)
                                                                            <span class="badge badge-primary">Your
                                                                                Choice</span>
                                                                        @endif

                                                                        @if ($isCorrectOption)
                                                                            <span
                                                                                class="badge badge-success">Correct</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="answer-line">
                                                                <span class="answer-label">Your Answer</span>
                                                                {{ !empty($item->student_answer) ? $item->student_answer : 'Not answered' }}
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="answer-line">
                                                                <span class="answer-label">Correct Answer</span>
                                                                {{ $item->correct_answer ?? 'Not available' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-muted mb-0">No Round 2 question review is available yet.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            @endif

            <div class="info-box">
                <h4>Notice Board</h4>

                <div class="row notice-tabs">
                    <div class="col-4">
                        <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-s1-list" data-toggle="list"
                                href="#list-s1">First Round Exam Time</a>
                            <a class="list-group-item list-group-item-action" id="list-r1-list" data-toggle="list"
                                href="#list-r1">First Round Result</a>
                            <a class="list-group-item list-group-item-action" id="list-s2-list" data-toggle="list"
                                href="#list-s2">Second Round Exam Time</a>
                            <a class="list-group-item list-group-item-action" id="list-r2-list" data-toggle="list"
                                href="#list-r2">Second Round Result</a>
                            <a class="list-group-item list-group-item-action" id="list-b-list" data-toggle="list"
                                href="#list-b">Bootcamp Time</a>
                            <a class="list-group-item list-group-item-action" id="list-s3-list" data-toggle="list"
                                href="#list-s3">Third Round Exam Time</a>
                            <a class="list-group-item list-group-item-action" id="list-r3-list" data-toggle="list"
                                href="#list-r3">Third Round Result</a>
                        </div>
                    </div>

                    <div class="col-8">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="list-s1">
                                First round exam is scheduled for <b>{{ $start_time }}</b>. The exam will be closed on
                                <b>{{ $end_time }}</b>.
                            </div>

                            <div class="tab-pane fade" id="list-r1">
                                Marketing Olympiad results will be published on <b>{{ $result }}</b>.
                            </div>

                            <div class="tab-pane fade" id="list-s2">
                                Second round exam is scheduled for <b>{{ $start_time2 }}</b>. The exam will be closed on
                                <b>{{ $end_time2 }}</b>.
                            </div>

                            <div class="tab-pane fade" id="list-r2">
                                Marketing Olympiad results will be published on <b>{{ $result2 }}</b>.
                            </div>

                            <div class="tab-pane fade" id="list-b">
                                Bootcamp is scheduled for <b>{{ $bootcamp }}</b>. Venue: AIUB Permanent Campus.
                            </div>

                            <div class="tab-pane fade" id="list-s3">
                                Third round exam is scheduled for <b>{{ $start_time3 }}</b>. The exam will be closed on
                                <b>{{ $end_time3 }}</b>.
                            </div>

                            <div class="tab-pane fade" id="list-r3">
                                Marketing Olympiad results will be published on <b>{{ $result3 }}</b>.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
