@extends('admin.layouts.app')
@section('main')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Exam Control</h4>
                </div>
                @include('validate')
                <div class="card-body">
                    <form action="{{ route('exam-controll.update', 1) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Round 1 result</label>
                            <div class="form-group order col-md-10">
                                <select class="form-control" name="round1resultstatus" id="">
                                    <option @if ($exam->round1resultstatus == 'true') selected @endif value="true">Published
                                    </option>
                                    <option @if ($exam->round1resultstatus == 'false') selected @endif value="false">Unpublished
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Round 2 result</label>
                            <div class="form-group order col-md-10">
                                <select class="form-control" name="round2resultstatus" id="">
                                    <option @if ($exam->round2resultstatus == 'true') selected @endif value="true">Published
                                    </option>
                                    <option @if ($exam->round2resultstatus == 'false') selected @endif value="false">Unpublished
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Minutes</label>
                            <div class="col-md-10">
                                <input type="text" name="minutes" value="{{$exam->minutes}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Seconds</label>
                            <div class="col-md-10">
                                <input type="text" name="seconds" value="{{$exam->seconds}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Question Quantity</label>
                            <div class="col-md-10">
                                <input type="text" name="question_qty" value="{{$exam->question_qty}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Start Date Time</label>
                            <div class="col-md-10">
                                <input type="datetime-local" name="start_date_time" value="{{$exam->start_date_time}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">End Date Time</label>
                            <div class="col-md-10">
                                <input type="datetime-local" name="end_date_time" value="{{$exam->end_date_time}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">First Round Result Published Time</label>
                            <div class="col-md-10">
                                <input type="datetime-local" name="result_published_time" value="{{$exam->result_published_time}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Next Round Date</label>
                            <div class="col-md-10">
                                <input type="datetime-local" name="next_round_date" value="{{$exam->next_round_date}}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-primary">Save Change</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Sending Mail Panel</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('exam.time.mail') }}" class="btn btn-primary btn-sm">Send Start Exam Mail</a>
                        <a href="{{ route('result.published.mail') }}" class="btn btn-primary btn-sm">Send Result Published Mail</a>
{{--                        <form action="{{ route('exam.time.mail') }}" method="POST">--}}
{{--                            @csrf--}}
{{--                            <label for="start date"></label>--}}
{{--                            <input type="date" name="sdate">--}}
{{--                            <label for="end date"></label>--}}
{{--                            <input type="date" name="edate">--}}
{{--                            <button class="btn btn-primary btn-sm">Send Start Exam Mail</button>--}}
{{--                        </form>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
