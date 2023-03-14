@extends('admin.layouts.app')
@section('main')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Round 1 Answer Script</h4>
                    <h4 class="text-right">
                        <span>You have:</span>
                        <span id="min"></span> <b>Minute<span id="s"></span></b>
                        <span id="remain"></span> <b>Second<span id="ss"></span></b>
                    </h4>
                </div>
                @include('validate')
                <div class="card-body">
                    <form id="round1" action="{{ route('round.one.store') }}" method="POST">
                        @csrf
                        @foreach ($question as $key => $ques)
                            <div class="border rounded p-3 my-3 shadow-sm">
                                <p>({{ $loop->index + 1 }}) {{ $ques->question }}</p>
                                <input type="hidden" name="question[{{ $key }}]" id=""
                                    value="{{ $ques->id }}">
                                @foreach (json_decode($ques->option) as $keyIndex=>$options)
                                    <input type="radio" id="{{ 'option_' . $key.'_'.$keyIndex }}" name="answer[{{ $key }}]"
                                        value="{{ $options }}">
                                    <label for="{{ 'option_' . $key.'_'.$keyIndex }}">{{ $options }}</label><br>
                                @endforeach


                                {{--                            <input type="radio" id="{{ $ques->option2 }}" name="answer{{$loop->index + 1}}" --}}
                                {{--                                value="{{ $ques->option2 }}"> --}}
                                {{--                            <label for="{{ $ques->option2 }}">{{ $ques->option2 }}</label><br> --}}
                                {{--                            <input type="radio" id="{{ $ques->option3 }}" name="answer{{$loop->index + 1}}" --}}
                                {{--                                value="{{ $ques->option3 }}"> --}}
                                {{--                            <label for="{{ $ques->option3 }}">{{ $ques->option3 }}</label><br> --}}
                                {{--                            <input type="radio" id="{{ $ques->option4 }}" name="answer{{$loop->index + 1}}" --}}
                                {{--                                value="{{ $ques->option4 }}"> --}}
                                {{--                            <label for="{{ $ques->option4 }}">{{ $ques->option4 }}</label> --}}
                            </div>
                        @endforeach
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div></div>
    </div>
    <script type="text/javascript">
        var isTabActive;
        var i = 0;

        window.onfocus = function() {
            isTabActive = true;
            if (i == 1) {
                alert("If You Change Tab or Open New Browser Again you will be disqualified");
                i++;
            }
            if (i == 4) {
                document.getElementById("round1").submit();
                alert("disqualified");
                location.href = 'http://127.0.0.1:8000/admin-logout';
            }

        };

        window.onblur = function() {
            isTabActive = false;
            i++;
            document.getElementById("min").innerHTML = i;
        };

        // test
        setInterval(function() {
            console.log(window.isTabActive ? 'active' : 'inactive');
        }, 1000);
    </script>
    <script type='text/javascript'>
            var isCtrl = false;
            document.onkeyup=function(e)
            {
                if(e.which == 17)
                isCtrl=false;
            }
            document.onkeydown=function(e)
            {
            if(e.which == 123)
            isCtrl=true;
            if (((e.which == 85) || (e.which == 65) || (e.which == 88) || (e.which == 67) || (e.which == 86) || (e.which == 2) || (e.which == 3) || (e.which == 123) || (e.which == 83)) && isCtrl == true)
            {
                swal("Function Disabled By Admin!")
            return false;
            }
            }
            // right click code
            var isNS = (navigator.appName == "Netscape") ? 1 : 0;
            if(navigator.appName == "Netscape") document.captureEvents(Event.MOUSEDOWN||Event.MOUSEUP);
            function mischandler(){
                // swal("Function Disabled By Admin!")
            return false;
            }
            function mousehandler(e){
            var myevent = (isNS) ? e : event;
            var eventbutton = (isNS) ? myevent.which : myevent.button;
            if((eventbutton==2)||(eventbutton==3)) return false;
            }
            document.oncontextmenu = mischandler;
            document.onmousedown = mousehandler;
            document.onmouseup = mousehandler;
            //select content code disable  alok goyal
            function killCopy(e){
            return false
            }
            function reEnable(){
            return true
            }
            document.onselectstart=new Function ("return false")
            if (window.sidebar){
            document.onmousedown=killCopy
            document.onclick=reEnable
            }
            // const onConfirmRefresh = function (event) {
            // event.preventDefault();
            // return event.returnValue = "Are you sure you want to leave the page?";
            // }

    window.addEventListener("beforeunload", onConfirmRefresh, { capture: true });
    </script>
@endsection
