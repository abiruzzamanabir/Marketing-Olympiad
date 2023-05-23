@extends('admin.layouts.app')
@section('main')
    @php
        use App\Models\Theme;
        use App\Models\Admin;
        use Carbon\Carbon;
        use App\Models\ExamControl;
        $theme = Theme::findOrFail(1);
        $exam = ExamControl::findOrFail(1);
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
        $participate = count(
            Admin::orderBy('first_name', 'asc')
                ->where('status', true)
                ->where('blocked', false)
                ->where('role_id', 3)
                ->where('trash', false)
                ->where('round_one_status', true)
                ->get(),
        );
        $participate2 = count(
            Admin::orderBy('first_name', 'asc')
                ->where('status', true)
                ->where('blocked', false)
                ->where('role_id', 3)
                ->where('trash', false)
                ->where('round_two_status', true)
                ->get(),
        );
        $selected = count(
            Admin::orderBy('first_name', 'asc')
                ->where('status', true)
                ->where('blocked', false)
                ->where('role_id', 3)
                ->where('trash', false)
                ->where('round_one_status', true)
                ->where('selected', true)
                ->get(),
        );
        $selected2 = count(
            Admin::orderBy('first_name', 'asc')
                ->where('status', true)
                ->where('blocked', false)
                ->where('role_id', 3)
                ->where('trash', false)
                ->where('round_two_status', true)
                ->where('selectedTwo', true)
                ->get(),
        );
        $unselected = $participate - $selected;
        $unselected2 = $participate2 - $selected2;
        $totalStudent = $verified + $unverified;

        $start_time = date('l, F j, Y, g:i A', strtotime($exam->start_date_time));
        $end_time = date('l, F j, Y, g:i A', strtotime($exam->end_date_time));
        $result = date('l, F j, Y, g:i A', strtotime($exam->result_published_time));

        $start_time2 = date('l, F j, Y, g:i A', strtotime($exam->next_round_date));
        $end_time2 = date('l, F j, Y, g:i A', strtotime($exam->next_round_end_date));
        $result2 = date('l, F j, Y, g:i A', strtotime($exam->result_published_time_round_two));

        $start_time3 = date('l, F j, Y, g:i A', strtotime($exam->third_round_date));
        $end_time3 = date('l, F j, Y, g:i A', strtotime($exam->third_round_end_date));
        $result3 = date('l, F j, Y, g:i A', strtotime($exam->result_published_time_round_third));

        $bootcamp = date('l, F j, Y, g:i A', strtotime($exam->bootcamp_date));

        $r2r_time = Carbon::parse($exam->result_published_time_round_two);

        $exam = ExamControl::findOrFail(1);
        $examtime = $exam->result_published_time;
        $exam_carbon = Carbon::parse($examtime);

        $exam_date = $exam_carbon->format('d'); // Output: 13
        $exam_month = $exam_carbon->format('m'); // Output: 04
        $exam_year = $exam_carbon->format('Y'); // Output: 2023

        // echo "Date: $exam_date, Month: $exam_month, Year: $exam_year";
        $currentdatetime = now();
        $carbon = Carbon::parse($currentdatetime);

        $date = $carbon->format('d'); // Output: 13
        $month = $carbon->format('m'); // Output: 04
        $year = $carbon->format('Y'); // Output: 2023

        // echo "Date: $date, Month: $month, Year: $year";

        $r1s = Carbon::parse($exam->start_date_time);
        $r1e = Carbon::parse($exam->end_date_time);
        $r1r = Carbon::parse($exam->result_published_time);
        $r2s = Carbon::parse($exam->next_round_date);
        $r2e = Carbon::parse($exam->next_round_end_date);
        $r2r = Carbon::parse($exam->result_published_time_round_two);
        $r3s = Carbon::parse($exam->third_round_date);
        $r3e = Carbon::parse($exam->third_round_end_date);
        $r3r = Carbon::parse($exam->result_published_time_round_third);

    @endphp
    @include('validate-main')
<<<<<<< HEAD
    @if (Auth::guard('admin')->user()->role_id == 3)
    @if (Carbon::now() >= $r1s && Carbon::now() <= $r1e && Auth::guard('admin')->user()->round_one_status == false)
    <a class="btn btn-primary mb-4" @if (Auth::guard('admin')->user()->round_one_status == false) data-toggle="modal"
        data-target="#rulesModal" style="cursor:pointer;" @else href="{{ route('round.one') }}" @endif">Start Exam</a>
    @endif
    @if (Carbon::now() >= $r2s && Carbon::now() <= $r2e && Auth::guard('admin')->user()->round_two_status == false)
    <a class="btn btn-primary mb-4" @if (Auth::guard('admin')->user()->round_two_status == false) data-toggle="modal"
        data-target="#rulesModal" style="cursor:pointer;" @else href="{{ route('round.two') }}" @endif">Start Exam</a>
    @endif
    @if (Carbon::now() >= $r3s && Carbon::now() <= $r3e && Auth::guard('admin')->user()->selectedTwo == true)
    <a class="btn btn-primary mb-4" href="{{ route('round.three') }}">Start Exam</a>
    @endif
    @endif


=======
>>>>>>> e953e31f70933353be58a4715f9c7781ff93376d
    @if (Auth::guard('admin')->user()->role_id == 1)
        <div class="row justify-content-between">
            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon text-primary border-primary">
                                <i class="fe fe-users"></i>
                            </span>
                            <div class="dash-count">
                                <h3>{{ $totalStudent }}</h3>
                            </div>
                        </div>
                        <div class="dash-widget-info">
                            <h6 class="text-muted">Total Students</h6>
                            <div class="progress progress-sm">
                                <div style="width: {{ 100 }}%" class="progress-bar bg-primary"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="d-block w-100 text-center my-3"><u>Round One</u></h3>
            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon text-primary border-primary">
                                <i class="fe fe-users"></i>
                            </span>
                            <div class="dash-count">
                                <h3>{{ $participate }}</h3>
                            </div>
                        </div>
                        <div class="dash-widget-info">
                            <h6 class="text-muted">Participate</h6>
                            <div class="progress progress-sm">
                                <div style="width: {{ 100 + 1 }}%" class="progress-bar bg-primary"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon text-success border-success">
                                <i class="fe fe-users"></i>
                            </span>
                            <div class="dash-count">
                                <h3>{{ $selected }}</h3>
                            </div>
                        </div>
                        <div class="dash-widget-info">
                            <h6 class="text-muted">Selected</h6>
                            <div class="progress progress-sm">
                                <div style="width: {{ 100 + 1 }}%" class="progress-bar bg-success"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon text-danger border-danger">
                                <i class="fe fe-users"></i>
                            </span>
                            <div class="dash-count">
                                <h3>{{ $unselected }}</h3>
                            </div>
                        </div>
                        <div class="dash-widget-info">
                            <h6 class="text-muted">Unelected</h6>
                            <div class="progress progress-sm">
                                <div style="width: {{ $unselected }}%" class="progress-bar bg-danger"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="d-block w-100 text-center my-3"><u>Round Two</u></h3>
            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon text-primary border-primary">
                                <i class="fe fe-users"></i>
                            </span>
                            <div class="dash-count">
                                <h3>{{ $participate2 }}</h3>
                            </div>
                        </div>
                        <div class="dash-widget-info">
                            <h6 class="text-muted">Participate</h6>
                            <div class="progress progress-sm">
                                <div style="width: {{ 100 + 1 }}%" class="progress-bar bg-primary"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon text-success border-success">
                                <i class="fe fe-users"></i>
                            </span>
                            <div class="dash-count">
                                <h3>{{ $selected2 }}</h3>
                            </div>
                        </div>
                        <div class="dash-widget-info">
                            <h6 class="text-muted">Selected</h6>
                            <div class="progress progress-sm">
                                <div style="width: {{ 100 + 1 }}%" class="progress-bar bg-success"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon text-danger border-danger">
                                <i class="fe fe-users"></i>
                            </span>
                            <div class="dash-count">
                                <h3>{{ $unselected2 }}</h3>
                            </div>
                        </div>
                        <div class="dash-widget-info">
                            <h6 class="text-muted">Unelected</h6>
                            <div class="progress progress-sm">
                                <div style="width: {{ $unselected2 }}%" class="progress-bar bg-danger"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-xl-3 col-sm-6 col-12">
		<div class="card">
			<div class="card-body">
				<div class="dash-widget-header">
					<span class="dash-widget-icon text-success">
						<i class="fe fe-credit-card"></i>
					</span>
					<div class="dash-count">
						<h3>487</h3>
					</div>
				</div>
				<div class="dash-widget-info">

					<h6 class="text-muted">Patients</h6>
					<div class="progress progress-sm">
						<div class="progress-bar bg-success w-50"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-sm-6 col-12">
		<div class="card">
			<div class="card-body">
				<div class="dash-widget-header">
					<span class="dash-widget-icon text-danger border-danger">
						<i class="fe fe-money"></i>
					</span>
					<div class="dash-count">
						<h3>485</h3>
					</div>
				</div>
				<div class="dash-widget-info">

					<h6 class="text-muted">Appointment</h6>
					<div class="progress progress-sm">
						<div class="progress-bar bg-danger w-50"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-sm-6 col-12">
		<div class="card">
			<div class="card-body">
				<div class="dash-widget-header">
					<span class="dash-widget-icon text-warning border-warning">
						<i class="fe fe-folder"></i>
					</span>
					<div class="dash-count">
						<h3>$62523</h3>
					</div>
				</div>
				<div class="dash-widget-info">

					<h6 class="text-muted">Revenue</h6>
					<div class="progress progress-sm">
						<div class="progress-bar bg-warning w-50"></div>
					</div>
				</div>
			</div>
		</div>
	</div> --}}
        </div>
    @endif
    {{-- <div class="row">
	<div class="col-md-12 col-lg-6">

		<!-- Sales Chart -->
		<div class="card card-chart">
			<div class="card-header">
				<h4 class="card-title">Revenue</h4>
			</div>
			<div class="card-body">
				<div id="morrisArea"></div>
			</div>
		</div>
		<!-- /Sales Chart -->

	</div>
	<div class="col-md-12 col-lg-6">

		<!-- Invoice Chart -->
		<div class="card card-chart">
			<div class="card-header">
				<h4 class="card-title">Status</h4>
			</div>
			<div class="card-body">
				<div id="morrisLine"></div>
			</div>
		</div>
		<!-- /Invoice Chart -->

	</div>
</div> --}}

    @if (Auth::guard('admin')->user()->role_id == 3)
        @php
            $minute = gmdate('i', Auth::guard('admin')->user()->duration);
            $secounds = gmdate('s', Auth::guard('admin')->user()->duration);
            $minute1 = gmdate('i', Auth::guard('admin')->user()->durationTwo);
            $secounds1 = gmdate('s', Auth::guard('admin')->user()->durationTwo);
        @endphp
        <div class="row">
            <div class="col-md-6">
<<<<<<< HEAD
                @if (Auth::guard('admin')->user()->round_one_status == true)
                    <h4 class="">Olympiad Updates</h4>
                @endif
                @if (Auth::guard('admin')->user()->round_one_status == true)
                    <div class="border p-3">
                        <u class="text-bold">Round 1:</u>
                        <p>Obtained Marks: {{ Auth::guard('admin')->user()->round_one_result }}</p>
                        @if (Auth::guard('admin')->user()->duration)
                        <p>Duration:
                            {{ $minute . ' Minute' . ($minute > 1 ? 's ' : ' ') . $secounds . ' Second' . ($secounds > 1 ? 's ' : ' ') }}
                        </p>
                        @endif
=======
                <h4 class="">Exam Information</h4>
                @if (Auth::guard('admin')->user()->round_one_status == true)
                    <div class="border p-3">
                        <u class="text-bold">Round 1:</u>
                        <p>Corrected Answer: {{ Auth::guard('admin')->user()->round_one_result }}</p>
                        <p>Duration:
                            {{ $minute . ' Minute' . ($minute > 1 ? 's ' : ' ') . $secounds . ' Second' . ($secounds > 1 ? 's ' : ' ') }}
                        </p>
>>>>>>> e953e31f70933353be58a4715f9c7781ff93376d
                @endif
                @if (Auth::guard('admin')->user()->round_one_status == true)
                    <a class="btn btn-primary btn-sm" href="{{ route('get.certificate') }}">Download
                        Certificate</a>
            </div>
    @endif
<<<<<<< HEAD
    @if (Auth::guard('admin')->user()->round_one_status == true)
        <p class="pt-3">Second Round Status: @if (Carbon::now() >= $r1r)
                @if (Auth::guard('admin')->user()->selected)
                    <span class="badge badge-success">Eligible</span>
                @else
                    <span class="badge badge-danger">Not Eligible</span>
                @endif
            @else
                <span class="badge badge-warning">Result Not Published Yet!</span>
            @endif

        </p>
    @endif
    @if (Auth::guard('admin')->user()->round_two_status == true)
        <div class="border p-3">
            <u class="text-bold">Round 2:</u>
            <p>Obtained Marks: {{ Auth::guard('admin')->user()->round_two_result }}</p>
            @if (Auth::guard('admin')->user()->durationTwo)
            <p>Duration:
                {{ $minute1 . ' Minute' . ($minute1 > 1 ? 's ' : ' ') . $secounds1 . ' Second' . ($secounds1 > 1 ? 's ' : ' ') }}
            </p>
            @endif
        </div>
    @endif
    @if (Auth::guard('admin')->user()->round_two_status == true)
        <p class="pt-3">Third Round Status: @if (Carbon::now() >= $r2r)
                @if (Auth::guard('admin')->user()->selectedTwo)
                    <span class="badge badge-success">Eligible</span>
                @else
                    <span class="badge badge-danger">Not Eligible</span>
                @endif
            @else
                <span class="badge badge-warning">Result Not Published Yet!</span>
            @endif

        </p>
    @endif
=======
    <p class="pt-3">Second Round Status: @if ($date >= $exam_date && $month >= $exam_month && $year >= $exam_year)
            @if (Auth::guard('admin')->user()->selected)
                <span class="badge badge-success">Selected</span>
            @else
                <span class="badge badge-danger">Not Selected</span>
            @endif
        @else
            <span class="badge badge-warning">Result Not Published Yet!</span>
        @endif

    </p>
    @if (Auth::guard('admin')->user()->round_two_status == true)
        <div class="border p-3">
            <u class="text-bold">Round 2:</u>
            <p>Corrected Answer: {{ Auth::guard('admin')->user()->round_two_result }}</p>
            <p>Duration:
                {{ $minute1 . ' Minute' . ($minute1 > 1 ? 's ' : ' ') . $secounds1 . ' Second' . ($secounds1 > 1 ? 's ' : ' ') }}
            </p>
        </div>
    @endif
    <p class="pt-3">Third Round Status: @if (Carbon::now() >= $r2r_time)
            @if (Auth::guard('admin')->user()->selectedTwo)
                <span class="badge badge-success">Selected</span>
            @else
                <span class="badge badge-danger">Not Selected</span>
            @endif
        @else
            <span class="badge badge-warning">Result Not Published Yet!</span>
        @endif

    </p>
>>>>>>> e953e31f70933353be58a4715f9c7781ff93376d

    {{-- <p>Second Round Status: @if (Auth::guard('admin')->user()->selected)
                        <span class="badge badge-success">Selected</span>
                    @else
                        <span class="badge badge-danger">Not Selected</span>
                    @endif
                </p> --}}
    </div>
    <div class="col-md-6">
        <h4 class="">Notice Board</h4>
        <div class="row">
            <div class="col-4">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-s1-list" data-toggle="list"
                        href="#list-s1" role="tab" aria-controls="s1">First Round Exam Time</a>
                    <a class="list-group-item list-group-item-action" id="list-r1-list" data-toggle="list"
                        href="#list-r1" role="tab" aria-controls="r1">First Round Result</a>
                    <a class="list-group-item list-group-item-action" id="list-s2-list" data-toggle="list"
                        href="#list-s2" role="tab" aria-controls="s2">Second Round Exam Time</a>
                    <a class="list-group-item list-group-item-action" id="list-r2-list" data-toggle="list"
                        href="#list-r2" role="tab" aria-controls="r2">Second Round Result</a>
                    <a class="list-group-item list-group-item-action" id="list-b-list" data-toggle="list" href="#list-b"
                        role="tab" aria-controls="b">Bootcamp Time</a>
                    <a class="list-group-item list-group-item-action" id="list-s3-list" data-toggle="list"
                        href="#list-s3" role="tab" aria-controls="s3">Third Round Exam Time</a>
                    <a class="list-group-item list-group-item-action" id="list-r3-list" data-toggle="list"
                        href="#list-r3" role="tab" aria-controls="r3">Third Round Result</a>
                    {{-- <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Messages</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Settings</a> --}}
                </div>
            </div>
            <div class="col-8">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-s1" role="tabpanel"
                        aria-labelledby="list-s1-list">First round exam is scheduled for
                        <b>{{ $start_time }}</b>. The exam will be conducted through our online
                        platform and the exam will be closed on <b>{{ $end_time }}</b>.
                    </div>
                    <div class="tab-pane fade" id="list-r1" role="tabpanel" aria-labelledby="list-r1-list">Marketing
                        Olympiad results will be published on
                        <b>{{ $result }}</b>
                    </div>
                    <div class="tab-pane fade show" id="list-s2" role="tabpanel" aria-labelledby="list-s2-list">Second
                        round exam is scheduled for
                        <b>{{ $start_time2 }}</b>. The exam will be conducted through our online
                        platform and the exam will be closed on <b>{{ $end_time2 }}</b>.
                    </div>
                    <div class="tab-pane fade" id="list-r2" role="tabpanel" aria-labelledby="list-r2-list">Marketing
                        Olympiad results will be published on
                        <b>{{ $result2 }}</b>
                    </div>
                    <div class="tab-pane fade show" id="list-b" role="tabpanel" aria-labelledby="list-b-list">
                        Bootcamp is scheduled for
                        <b>{{ $bootcamp }}</b>. Venue: AIUB Permanent Campus</b>.
                    </div>
                    <div class="tab-pane fade show" id="list-s3" role="tabpanel" aria-labelledby="list-s3-list">Third
                        round exam is scheduled for
                        <b>{{ $start_time3 }}</b>. The exam will be conducted through our online
                        platform and the exam will be closed on <b>{{ $end_time3 }}</b>.
                    </div>
                    <div class="tab-pane fade" id="list-r3" role="tabpanel" aria-labelledby="list-r3-list">Marketing
                        Olympiad results will be published on
                        <b>{{ $result3 }}</b>
                    </div>
                    {{-- <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>
                        <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">...</div> --}}
                </div>
            </div>
        </div>
        {{-- <ol class="list-group">
                    <li class="list-group-item">
                        <div>
                            <h4>First Round Exam Time</h4>
                            <p>First round exam is scheduled for <b>{{ $start_time }}</b>. The exam will be conducted through our online
                                platform and the exam will be closed on <b>{{ $end_time }}</b>.</p>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div>
                            <h4>First Round Result </h4>
                            <p>Marketing Olympiad results will be published on <b>{{$result}}</b>.</p>
                        </div>
                    </li>
                </ol> --}}
    </div>
    </div>
    @endif
@endsection
