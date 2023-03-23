@extends('admin.layouts.app')
@section('main')
@php
    use App\Models\Theme;
    use App\Models\Admin;
    $theme = Theme::findOrFail(1);
    $verified = count(Admin::orderBy("first_name", "asc")->where('status', true)->where('blocked',false)->where('role_id',3)->where('trash', false)->get());
    $unverified = count(Admin::orderBy("first_name", "asc")->where('status', false)->where('blocked',false)->where('role_id',3)->where('trash', false)->get());
    $totalStudent = $verified+$unverified;



@endphp
@include('validate-main')
@if (Auth::guard('admin')->user()->role_id===1)
<div class="row">
	<div class="col-xl-3 col-sm-6 col-12">
		<div class="card">
			<div class="card-body">
				<div class="dash-widget-header">
					<span class="dash-widget-icon text-primary border-primary">
						<i class="fe fe-users"></i>
					</span>
					<div class="dash-count">
						<h3>{{$totalStudent}}</h3>
					</div>
				</div>
				<div class="dash-widget-info">
					<h6 class="text-muted">Students</h6>
					<div class="progress progress-sm">
						<div style="width: {{( 100)+1}}%" class="progress-bar bg-primary"></div>
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
@endsection
