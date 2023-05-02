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
                        {{-- <div class="form-group row">
                            <label class="col-form-label col-md-3
">Round 1 result</label>
                            <div class="form-group order col-md-9
">
                                <select class="form-control" name="round1resultstatus" id="">
                                    <option @if ($exam->round1resultstatus == 'true') selected @endif value="true">Published
                                    </option>
                                    <option @if ($exam->round1resultstatus == 'false') selected @endif value="false">Unpublished
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3
">Round 2 result</label>
                            <div class="form-group order col-md-9
">
                                <select class="form-control" name="round2resultstatus" id="">
                                    <option @if ($exam->round2resultstatus == 'true') selected @endif value="true">Published
                                    </option>
                                    <option @if ($exam->round2resultstatus == 'false') selected @endif value="false">Unpublished
                                    </option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <label class="col-form-label col-md-3
">Minutes</label>
                            <div class="col-md-9
">
                                <input type="text" name="minutes" value="{{ $exam->minutes }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3
">Seconds</label>
                            <div class="col-md-9
">
                                <input type="text" name="seconds" value="{{ $exam->seconds }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3
">Question Quantity</label>
                            <div class="col-md-9
">
                                <input type="text" name="question_qty" value="{{ $exam->question_qty }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3
">First Round Date</label>
                            <div class="col-md-9
">
                                <input type="datetime-local" name="start_date_time" value="{{ $exam->start_date_time }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3
">First Round End Date</label>
                            <div class="col-md-9
">
                                <input type="datetime-local" name="end_date_time" value="{{ $exam->end_date_time }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3">First Round Result Date</label>
                            <div class="col-md-9">
                                <input type="datetime-local" name="result_published_time"
                                    value="{{ $exam->result_published_time }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3">Second Round Date</label>
                            <div class="col-md-9">
                                <input type="datetime-local" name="next_round_date" value="{{ $exam->next_round_date }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3">Second Round End Date</label>
                            <div class="col-md-9">
                                <input type="datetime-local" name="next_round_end_date"
                                    value="{{ $exam->next_round_end_date }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3">Second Round Result Date</label>
                            <div class="col-md-9">
                                <input type="datetime-local" name="result_published_time_round_two"
                                    value="{{ $exam->result_published_time_round_two }}" class="form-control">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-form-label col-md-3">Third Round Date</label>
                            <div class="col-md-9">
                                <input type="datetime-local" name="third_round_date" value="{{ $exam->third_round_date }}"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3">Third Round End Date</label>
                            <div class="col-md-9">
                                <input type="datetime-local" name="third_round_end_date"
                                       value="{{ $exam->third_round_end_date }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3">Third Round Result Date</label>
                            <div class="col-md-9">
                                <input type="datetime-local" name="result_published_time_round_third"
                                       value="{{ $exam->result_published_time_round_third }}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-9
">
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
                        <div class="row">
                            <div class="col-md-3 text-muted">
                                <p>Start exam date mail & SMS Send to all student</p>
                                <a href="{{ route('exam.time.mail') }}" class="btn btn-primary btn-sm">Send Start Exam
                                    Mail & SMS</a>
                            </div>
                            <div class="col-md-3 text-muted">
                                <p>First round result published date mail & SMS Send to all student</p>
                                <a href="{{ route('result.published.mail') }}" class="btn btn-primary btn-sm">Send Result
                                    Published Mail & SMS</a>
                            </div>
                            <div class="col-md-3 text-muted">
                                <p>Selected for second round mail & SMS Send to only selected student</p>
                                <a href="{{ route('selected.mail') }}" class="btn btn-primary btn-sm">Send Selected
                                    Mail & SMS</a>
                            </div>
                            <div class="col-md-3 text-muted">
                                <p>Second round result published date mail & SMS Send to only selected student</p>
                                <a href="{{ route('result.published.mail.round.two') }}" class="btn btn-primary btn-sm">Send Result
                                    Published Mail & SMS</a>
                            </div>
                                {{--  Third Round--}}
                            <div class="col-md-3 text-muted">
                                <p>Selected for third round mail & SMS Send to only selected student</p>
                                <a href="{{ route('selected.third.mail') }}" class="btn btn-primary btn-sm">Send Selected
                                    Mail & SMS</a>
                            </div>
                            <div class="col-md-3 text-muted">
                                <p>Third round result published date mail & SMS Send to only selected student</p>
                                <a href="{{ route('result.published.mail.round.third') }}" class="btn btn-primary btn-sm">Send Result
                                    Published Mail & SMS</a>
                            </div>
                            <div class="col-md-3 text-muted">
                                <p>Bootcamp mail & SMS Send to only selected student</p>
                                <a href="{{ route('bootcamp.mail') }}" class="btn btn-primary btn-sm">Send Bootcamp Mail & SMS</a>
                            </div>
                        </div>


                        {{--                        <form action="{{ route('exam.time.mail') }}" method="POST"> --}}
                        {{--                            @csrf --}}
                        {{--                            <label for="start date"></label> --}}
                        {{--                            <input type="date" name="sdate"> --}}
                        {{--                            <label for="end date"></label> --}}
                        {{--                            <input type="date" name="edate"> --}}
                        {{--                            <button class="btn btn-primary btn-sm">Send Start Exam Mail</button> --}}
                        {{--                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
