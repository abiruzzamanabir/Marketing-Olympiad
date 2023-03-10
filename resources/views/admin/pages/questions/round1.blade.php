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
                        @foreach ($question as $key=>$ques)
                            <div class="border rounded p-3 my-3 shadow-sm">
                                <p>({{ $loop->index + 1 }}) {{ $ques->question }}</p>
                                <input type="hidden" name="question[{{$key}}]" id="" value="{{ $ques->id }}">
                                @foreach(json_decode($ques->option1) as $keyIndex=>$options)
                                    <input type="radio" id="{{ 'option_'.$key.'_'.$keyIndex}}" name="answer[{{$key}}]"
                                           value="{{ $options }}">
                                <label for="{{ 'option_'.$key.'_'.$keyIndex}}">{{ $options }}</label><br>
                                @endforeach


                                {{--                            <input type="radio" id="{{ $ques->option2 }}" name="answer{{$loop->index + 1}}"--}}
{{--                                value="{{ $ques->option2 }}">--}}
{{--                            <label for="{{ $ques->option2 }}">{{ $ques->option2 }}</label><br>--}}
{{--                            <input type="radio" id="{{ $ques->option3 }}" name="answer{{$loop->index + 1}}"--}}
{{--                                value="{{ $ques->option3 }}">--}}
{{--                            <label for="{{ $ques->option3 }}">{{ $ques->option3 }}</label><br>--}}
{{--                            <input type="radio" id="{{ $ques->option4 }}" name="answer{{$loop->index + 1}}"--}}
{{--                                value="{{ $ques->option4 }}">--}}
{{--                            <label for="{{ $ques->option4 }}">{{ $ques->option4 }}</label>--}}
                            </div>
                        @endforeach
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div></div>
    </div>
@endsection
