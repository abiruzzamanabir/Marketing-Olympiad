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
        $totalStudent = $verified + $unverified;
        $start_time = date('l, F j, Y, g:i A', strtotime($exam->start_date_time));
        $end_time = date('l, F j, Y, g:i A', strtotime($exam->end_date_time));
        $result = date('l, F j, Y, g:i A', strtotime($exam->result_published_time));

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

    @endphp
    @include('validate-main')
    @if (Auth::guard('admin')->user()->role_id === 1)
        <div class="row">
            <div class="col-xl-3 col-sm-6 col-12">
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
                            <h6 class="text-muted">Students</h6>
                            <div class="progress progress-sm">
                                <div style="width: {{ 100 + 1 }}%" class="progress-bar bg-primary"></div>
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

    @if (Auth::guard('admin')->user()->role_id === 3)
        <div class="row">
            <div class="col-md-6">
                <h4 class="">Exam Information</h4>
                <p>Second Round Status: @if ($date >= $exam_date && $month >= $exam_month && $year >= $exam_year)
                        @if (Auth::guard('admin')->user()->selected)
                            <span class="badge badge-success">Selected</span>
                        @else
                            <span class="badge badge-danger">Not Selected</span>
                        @endif
                    @else
                        <span class="badge badge-warning">Result Not Published Yet!</span>
                    @endif

                </p>

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
                        <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">First Round Exam Time</a>
                        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">First Round Result</a>
                        {{-- <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Messages</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Settings</a> --}}
                      </div>
                    </div>
                    <div class="col-8">
                      <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">First round exam is scheduled for <b>{{ $start_time }}</b>. The exam will be conducted through our online
                            platform and the exam will be closed on <b>{{ $end_time }}</b>.</div>
                        <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">Marketing Olympiad results will be published on <b>{{$result}}</b></div>
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
