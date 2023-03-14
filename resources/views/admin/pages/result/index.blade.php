@extends('admin.layouts.app')
@section('main')
    <div class="row">
        @if (Auth::guard('admin')->user()->round_one_status)
        <div class="col-md-4">
            <div class="card border shadow-sm">
                <div class="card-header">
                    <h4 class="card-title text-center">Round 1 Result</h4>
                </div>
                @include('validate')
                <div class="card-body text-center">
                    <h2><span
                            class="@if (Auth::guard('admin')->user()->round_one_result < 2) text-danger
                @elseif(Auth::guard('admin')->user()->round_one_result < 3)
                    text-warning
                @else
                    text-success @endif">{{ Auth::guard('admin')->user()->round_one_result }}</span>/<span class="text-primary">3</span>
                    </h2>
                </div>
            </div>
        </div>
        @endif
        @if (Auth::guard('admin')->user()->round_two_status)
        <div class="col-md-4">
            <div class="card border shadow-sm">
                <div class="card-header">
                    <h4 class="card-title text-center">Round 2 Result</h4>
                </div>
                @include('validate')
                <div class="card-body text-center">
                    <h2><span
                            class="@if (Auth::guard('admin')->user()->round_two_result < 2) text-danger
                @elseif(Auth::guard('admin')->user()->round_two_result < 3)
                    text-warning
                @else
                    text-success @endif">{{ Auth::guard('admin')->user()->round_two_result }}</span>/<span class="text-primary">3</span>
                    </h2>
                </div>
            </div>
        </div>
        @endif
        @if (Auth::guard('admin')->user()->round_three_status)
        <div class="col-md-4">
            <div class="card border shadow-sm">
                <div class="card-header">
                    <h4 class="card-title text-center">Round 3 Result</h4>
                </div>
                @include('validate')
                <div class="card-body text-center">
                    <h2><span
                            class="@if (Auth::guard('admin')->user()->round_three_result < 2) text-danger
                @elseif(Auth::guard('admin')->user()->round_three_result < 3)
                    text-warning
                @else
                    text-success @endif">{{ Auth::guard('admin')->user()->round_three_result }}</span>/<span class="text-primary">3</span>
                    </h2>
                </div>
            </div>
        </div>
        @endif        
    </div>
@endsection
