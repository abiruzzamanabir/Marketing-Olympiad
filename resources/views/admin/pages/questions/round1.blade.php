@extends('admin.layouts.app')
@section('main')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Round 1 Answer Script</h4>
                </div>
                @include('validate')
                <div class="card-body">
                    <form action="{{ route('round.one.store') }}" method="POST">
                        @csrf
                        <form>
                            @foreach ($question as $ques)
                                <div class="border rounded p-3 my-3 shadow-sm">
                                    <p>({{ $loop->index + 1 }}) {{ $ques->question }}</p>
                                    <input type="hidden" name="question{{$loop->index + 1}}" id="" value="{{ $ques->question }}">
                                    <input type="hidden" name="question{{$loop->index + 1}}id" id="" value="{{ $ques->id }}">
                                <input type="radio" id="{{ $ques->option1 }}" name="answer{{$loop->index + 1}}"
                                    value="{{ $ques->option1 }}">
                                <label for="{{ $ques->option1 }}">{{ $ques->option1 }}</label><br>
                                <input type="radio" id="{{ $ques->option2 }}" name="answer{{$loop->index + 1}}"
                                    value="{{ $ques->option2 }}">
                                <label for="{{ $ques->option2 }}">{{ $ques->option2 }}</label><br>
                                <input type="radio" id="{{ $ques->option3 }}" name="answer{{$loop->index + 1}}"
                                    value="{{ $ques->option3 }}">
                                <label for="{{ $ques->option3 }}">{{ $ques->option3 }}</label><br>
                                <input type="radio" id="{{ $ques->option4 }}" name="answer{{$loop->index + 1}}"
                                    value="{{ $ques->option4 }}">
                                <label for="{{ $ques->option4 }}">{{ $ques->option4 }}</label>
                                </div>
                            @endforeach
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </form>
                    </form>
                </div>
            </div>
        </div>
        <div></div>
    </div>
@endsection
