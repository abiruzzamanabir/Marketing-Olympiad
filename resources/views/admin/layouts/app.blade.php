@php
    use App\Models\Theme;
    use App\Models\Admin;
    use App\Models\ExamControl;
    use App\Models\QuestionAnswer;
    use App\Models\QuestionAnswerTwo;

    $theme = Theme::findOrFail(1);
    $exam = ExamControl::findOrFail(1);
    $user = Auth::guard('admin')->user();

    $studentQuery = Admin::where('role_id', 3)->where('blocked', false)->where('trash', false);

    $verified = (clone $studentQuery)->where('status', true)->count();
    $unverified = (clone $studentQuery)->where('status', false)->count();

    $examdone = (clone $studentQuery)->where('round_one_status', true)->count();
    $examdonetwo = (clone $studentQuery)->where('round_two_status', true)->count();
    $examdonethree = (clone $studentQuery)->where('selectedThree', true)->count();
    $winner = (clone $studentQuery)->where('winner', true)->count();

    $question = QuestionAnswer::count();
    $questionTwo = QuestionAnswerTwo::count();

    $totalStudent = $verified + $unverified;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>{{ $theme->title }}</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/logo/' . $theme->favicon) }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/feathericon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.css">

    <style>
        .validation-message {
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 14px;
            line-height: 1.5;
            border: 1px solid transparent;
            background: #f8fafc;
            color: #334155;
        }
        .validation-success { background: #ecfdf5; color: #065f46; border-color: #a7f3d0; }
        .validation-error { background: #fef2f2; color: #991b1b; border-color: #fecaca; }
        .validation-warning { background: #fffbeb; color: #92400e; border-color: #fde68a; }
        .validation-info { background: #eff6ff; color: #1e40af; border-color: #bfdbfe; }
        .validation-neutral { background: #f8fafc; color: #475569; border-color: #e2e8f0; }
    </style>

</head>

<body @if ($user->role_id == 3) class="mini-sidebar" @endif>

    <div class="main-wrapper">

        @include('admin.layouts.header')

        @if ($user->role_id !== 3)
            @include('admin.layouts.sidebar')
        @endif

        {{-- Rules & Regulation Modal --}}
        <div class="modal fade" id="rulesModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="rulesModalLabel" aria-hidden="true">

            <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="rulesModalLabel">Rules & Regulation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                    </div>

                    <div class="modal-body">
                        <ol class="list-group">
                            <li class="list-group-item">Participants must be enrolled in a university at the time of
                                registration.</li>
                            <li class="list-group-item">Participants have to compete individually.</li>
                            <li class="list-group-item">Participants must register online through the official Marketing
                                Olympiad website.</li>
                            <li class="list-group-item">All participants must comply with the rules and regulations set
                                by the Marketing Olympiad organizers.</li>

                            <li class="list-group-item font-weight-bold">
                                While participating in the online quiz for Marketing Olympiad, participants during the
                                exam cannot copy the question in an attempt on using unfair means.
                            </li>

                            <li class="list-group-item font-weight-bold">
                                Participants cannot open a new tab during the quiz, cannot minimize the browser, cannot
                                lock the screen, cannot refresh the page, cannot take screenshots, and cannot log in
                                from multiple devices.
                            </li>

                            <li class="list-group-item font-weight-bold">
                                The above-mentioned regulations are applicable for any device from which the quiz is
                                being participated.
                            </li>

                            <li class="list-group-item font-weight-bold">
                                Attempting any of the above-mentioned will provide a warning and a second attempt will
                                lead to a disqualification.
                            </li>

                            <li class="list-group-item font-weight-bold">One participant can only attempt the quiz once.
                            </li>
                            <li class="list-group-item">Participants must abide by the competition timeline as
                                mentioned.</li>

                            <li class="list-group-item font-weight-bold">
                                Plagiarism or any other form of academic misconduct is strictly prohibited and may
                                result in disqualification.
                            </li>

                            <li class="list-group-item">All information submitted becomes the property of the Marketing
                                Olympiad organizers.</li>
                            <li class="list-group-item">The decision of the judges is final and cannot be contested.
                            </li>
                            <li class="list-group-item">The Marketing Olympiad organizers reserve the right to
                                disqualify any participant that violates the rules and regulations or engages in
                                unethical behavior.</li>
                            <li class="list-group-item">No negative scoring will be made on wrong answers.</li>
                            <li class="list-group-item font-weight-bold">The quiz must be finished within the given
                                timeframe.</li>
                            <li class="list-group-item">Participants must be at least 18 years old to compete in
                                Marketing Olympiad.</li>
                            <li class="list-group-item">The competition is open to participants from any part of the
                                country.</li>

                            <li class="list-group-item font-weight-bold">
                                The use of any unauthorized resources or external assistance is prohibited during the
                                competition.
                            </li>

                            <li class="list-group-item">
                                Participants must provide accurate and complete information during the registration
                                process.
                            </li>
                        </ol>

                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" id="rulesAgree">
                            <label class="form-check-label" for="rulesAgree">I have read, understood, and agree to abide by the Rules & Regulations.</label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        <a id="startexam" class="d-none"
                            href="{{ $user->selected == true ? route('round.two') : route('round.one') }}">
                            <button type="button" class="btn btn-primary">Start Exam</button>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <div class="page-wrapper">
            <div class="content container-fluid">
                @if ($user->role_id != 3)
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">

                                <h3 class="page-title">
                                    Welcome {{ $user->first_name }} {{ $user->last_name }}!
                                </h3>

                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item active text-uppercase">
                                        {{ str_replace('-', ' ', Request::path()) }}
                                    </li>
                                </ul>

                                <p class="text-muted">
                                    Time: <span id="time">00:00:00</span>
                                </p>

                            </div>
                        </div>
                    </div>
                @endif

                @section('main')
                @show

            </div>
        </div>

    </div>

    <script src="{{ asset('admin/assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/raphael/raphael.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdn.ckeditor.com/4.19.1/basic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>

    <script src="{{ asset('admin/assets/js/script.js') }}"></script>
    <script src="{{ asset('custom/admin.js') }}"></script>

    <script>
        if (window.jQuery && $.fn.dataTable) {
            $.fn.dataTable.ext.errMode = 'none';

            $(document).on('error.dt', function(e, settings, techNote, message) {
                var tableId = settings && settings.nTable ? settings.nTable.id : 'DataTable';
                var cleanMessage = (message || 'Data could not be loaded.').replace(/^DataTables warning:\s*/i, '');

                if (window.Swal) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Table data could not be loaded',
                        html: '<div style="text-align:left">Please refresh the page and try again.<br><br><small><strong>Table:</strong> ' + tableId + '<br><strong>Details:</strong> ' + cleanMessage + '</small></div>',
                        confirmButtonText: 'OK'
                    });
                } else {
                    console.error('DataTables error:', cleanMessage);
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#rulesAgree').on('change', function() {
                $('#startexam').toggleClass('d-none', !this.checked);
            });

            setInterval(function() {
                document.getElementById('time').innerHTML = new Date().toLocaleTimeString();
            }, 1000);
        });
    </script>

    @include('forcejs')

    @stack('script')

</body>

</html>
