@extends('admin.layouts.app')
@section('main')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title border p-3">Round 1 Answer Script</h4>
                    <h4 class="text-right border p-3">
                        <span>You have:</span>
                        <span id="min"></span> <b>Minute<span id="s"></span></b>
                        <span id="remain"></span> <b>Second<span id="ss"></span></b>
                    </h4>
                    <br>
                    <h4 class="border p-3" id="showQuestionCounter"></h4>
                </div>
                @include('validate')
                <div class="card-body">
                    <form id="round1" action="{{ route('round.one.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="duration" id="duration">
                        <input type="hidden" name="" id="question_qty" value="{{count($question)}}">
                        @foreach ($question as $key => $ques)
                            <div class="border rounded p-3 my-3 shadow-sm question" style="{{ $key == 0 ? '' : 'display:none' }}">
                                <p>({{ $loop->index + 1 }}) {{ $ques->question }}</p>
                                <input type="hidden" name="question[{{ $key }}]" id=""
                                    value="{{ $ques->id }}">
                                @foreach (json_decode($ques->option) as $keyIndex => $options)
                                    <input type="radio" id="{{ 'option_' . $key . '_' . $keyIndex }}"
                                        name="answer[{{ $key }}]" value="{{ $options }}" class="submitAnswer">
                                    <label for="{{ 'option_' . $key . '_' . $keyIndex }}">{{ $options }}</label><br>
                                @endforeach
{{--                                <button class="btn btn-md btn-primary submitAnswer" type="button">Submit Answer</button>--}}
                            </div>
                        @endforeach
                        <button class="btn btn-primary d-none" type="submit" id="submitBtn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var isTabActive;
        var i = 0;

        window.onfocus = function() {
            isTabActive = true;
            if (i == 1) {
                Swal.fire({
                    title: 'If You Change Tab or Open New Browser Again you will be disqualified',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                })
                // alert("If You Change Tab or Open New Browser Again you will be disqualified");
                i++;
            }
            if (i == 3) {
                document.getElementById("round1").submit();
                Swal.fire({
                    title: 'disqualified',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                })
                // alert("disqualified");
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
            // console.log(window.isTabActive ? 'active' : 'inactive');
        }, 1000);
    </script>
    <script type='text/javascript'>
        var isCtrl = false;
        document.onkeyup = function(e) {
            if (e.which == 17)
                isCtrl = false;
        }
        document.onkeydown = function(e) {
            if (e.which == 123)
                isCtrl = true;
            if (((e.which == 85) || (e.which == 65) || (e.which == 88) || (e.which == 67) || (e.which == 86) || (e
                    .which == 2) || (e.which == 3) || (e.which == 123) || (e.which == 83)) && isCtrl == true) {
                // swal("Function Disabled By Admin!")
                return false;
            }
        }
        // right click code
        var isNS = (navigator.appName == "Netscape") ? 1 : 0;
        if (navigator.appName == "Netscape") document.captureEvents(Event.MOUSEDOWN || Event.MOUSEUP);

        function mischandler() {
            // swal("Function Disabled By Admin!")
            return false;
        }

        function mousehandler(e) {
            var myevent = (isNS) ? e : event;
            var eventbutton = (isNS) ? myevent.which : myevent.button;
            if ((eventbutton == 2) || (eventbutton == 3)) return false;
        }
        document.oncontextmenu = mischandler;
        document.onmousedown = mousehandler;
        document.onmouseup = mousehandler;
        //select content code disable  alok goyal
        function killCopy(e) {
            return false
        }

        function reEnable() {
            return true
        }
        document.onselectstart = new Function("return false")
        if (window.sidebar) {
            document.onmousedown = killCopy
            document.onclick = reEnable
        }
        // const onConfirmRefresh = function (event) {
        // event.preventDefault();
        // return event.returnValue = "Are you sure you want to leave the page?";
        // }

        window.addEventListener("beforeunload", onConfirmRefresh, {
            capture: true
        });
    </script>
    <script type="text/javascript">
        window.onload = counter;

        function counter() {
            minutes = "{{$minute}}";
            seconds = "{{$seconds}}";
            count=0;
            countDown();
        }
    </script>
    <script type="text/javascript">
        function countDown() {
            document.getElementById("min").innerHTML = minutes;
            document.getElementById("remain").innerHTML = seconds;
            document.getElementById("duration").value = count;
            if (minutes > 1) {
                document.getElementById("s").innerHTML = 's';
            } else {
                document.getElementById("s").innerHTML = '';
            }
            if (seconds > 1) {
                document.getElementById("ss").innerHTML = 's';
            } else {
                document.getElementById("ss").innerHTML = '';
            }
            setTimeout("countDown()", 1000);
            if (minutes == 0 && seconds == 0) {
                $("#showQuestionCounter").text(`Submitting...`);
                document.getElementById("round1").submit();
            } else {
                seconds--;
                count++;
                if (seconds == 0 && minutes > 0) {
                    minutes--;
                    seconds = 60;
                }
            }
        }
    </script>

@endsection
