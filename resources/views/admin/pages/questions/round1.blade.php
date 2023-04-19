<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Round One Quiz</title>
    <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- <style>
        .bd {
            border-image-slice: 42 42 42 42;
border-image-width: 42px 42px 42px 42px;
border-image-outset: 0px 0px 0px 0px;
border-image-repeat: round round;
border-image-source: url("https://mdn.github.io/css-examples/tools/border-image-generator/border-image-6.svg");
border-style: solid;
        }
    </style> --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <style>
        .bgcolorClass {
            background-color: #7CC6FE;
            color: white;
        }

        input[type="radio"] {
            visibility: hidden;
        }

        @media (max-width: 769px) {
  body {
    background-position:center right !important;
    background-size:cover !important;
    background-image:  url({{ asset('storage/logo/WebBannerM.png') }}) !important;
  }
}
    </style>
</head>

<body
    style="background-image: linear-gradient( rgba(255, 255, 255, 0.3), rgb(255, 255, 255, 0.3) ), url({{ asset('storage/logo/WebBanner.png') }}); background-repeat:no-repeat;background-attachment: fixed;background-position:top right  ;background-size:cover;">
    {{-- style="background-color: #0f3e687a; font-family: 'Montserrat', sans-serif;"> --}}

    <div class="container">
        <div style="margin-bottom:100px" class="row justify-content-around align-items-center mb-5 pb-5">
            <div class="text-center">
                <img style="height: 200px" src="{{ asset('storage/logo/logo_text.png') }}" alt="">
            </div>
            <div class="d-none d-md-block col-md-2 justify-content-left align-items-center">
                <h1 style="font-size:120px" class="text-left p-3 m-3 rounded">
                    <div class="d-flex justify-content-center align-items-center">
                        {{-- <div style="text-orientation: upright;writing-mode: vertical-lr;">
                            <h4>Left</h4>
                        </div> --}}
                        <div>
                            <div class="justify-content-center align-items-center">
                                <p class="text-center"><span style="font-size: 80px" id="m"></span><span style="font-size: 80px" id="min"></span></p>
                                <p class="text-center" style="font-size: 20px">
                                    Min</p>
                            </div>
                            <hr>
                            {{-- <span id="z"></span><span id="remain"></span> --}}
                            <div class="justify-content-center align-items-center">
                                <p class="text-center"><span style="font-size: 80px" id="z"></span><span style="font-size: 80px" id="remain"></span></p>
                                <p class="text-center" style="font-size: 20px">
                                    Sec</p>
                            </div>
                        </div>
                    </div>
                </h1>
            </div>
            <div class="col-md-8 pb-3">
                {{-- <div class="card">
                    <div class="card-header bg-info d-flex justify-content-between align-items-center">
                        <h4 class="card-title border p-3 text-white rounded">Round 1 Quiz</h4>
                        <h6 class="text-right border p-3 text-white rounded">
                            <span>You have:</span>
                            <span id="min"></span> <b>Minute<span id="s"></span></b>
                            <span id="remain"></span> <b>Second<span id="ss"></span></b>
                        </h6>
                        <br>
                        <h4 class="border p-3 text-white rounded" id="showQuestionCounter"></h4>
                    </div>
                    @include('validate')
                    <div class="card-body">
                        <form id="round1" action="{{ route('round.one.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="duration" id="duration">
                            <input type="hidden" name="" id="question_qty" value="{{ count($question) }}">
                                @foreach ($question as $key => $ques)
                                    <div class="border rounded p-3 my-3 shadow-sm question"
                                         style="{{ $key == 0 ? '' : 'display:none' }}">
                                        @if (!empty($ques['image_question']))
                                            <img src="{{asset('storage/question/'.$ques['image_question'])}}" style="height: 200px ;margin-bottom: 10px;border: 5px solid rgb(210, 210, 210); padding: 10px" alt="IMG">
                                            <br>
                                            <hr>
                                        @endif
                                            <strong>({{ $loop->index + 1 }}) {{ $ques['question'] }}</strong>
                                        <input type="hidden" name="question[{{ $key }}]" id=""
                                               value="{{ $ques['id']}}">
                                               <hr>
                                         <input type="hidden" name="category_id[{{ $key }}]" id=""
                                               value="{{ $ques['category_id']}}">
                                        @foreach (json_decode($ques['option']) as $keyIndex => $options)
                                            <input type="radio" id="{{ 'option_' . $key . '_' . $keyIndex }}"
                                                   name="answer[{{ $key }}]" value="{{ $options }}"
                                                   class="optionCheck">
                                            <label for="{{ 'option_' . $key . '_' . $keyIndex }}">{{ $options }}</label><br>
                                        @endforeach
                                         <button class="btn btn-md btn-primary my-3 submitAnswer d-none" type="button">Confirm</button>
                                    </div>
                                @endforeach
                            <button class="btn btn-primary d-none" type="submit" id="submitBtn">Submit</button>
                        </form>
                    </div>
                </div> --}}

                <div
                    class="text-center d-flex justify-content-between justify-content-md-center align-content-center align-items-center">
                    {{-- <h4 style="width: 125px" class="card-title border p-3 rounded">Round 1</h4> --}}
                    <h4 class="d-md-none d-sm-block text-center p-3 text-dark">
                        <span id="minn"></span> :
                        <span id="remainn"></span>
                    </h4>
                    {{-- <img class="d-md-block d-none" style="height: 120px" src="{{ asset('storage/logo/logo_text.png') }}" alt=""> --}}
                    <h4 style="width: 125px" class="p-3" id="showQuestionCounter"></h4>
                </div>
                <div>
                    {{-- <div style="background: radial-gradient(circle at 100% 100%, #ffffff 0, #ffffff 5px, transparent 5px) 0% 0%/8px 8px no-repeat,
                radial-gradient(circle at 0 100%, #ffffff 0, #ffffff 5px, transparent 5px) 100% 0%/8px 8px no-repeat,
                radial-gradient(circle at 100% 0, #ffffff 0, #ffffff 5px, transparent 5px) 0% 100%/8px 8px no-repeat,
                radial-gradient(circle at 0 0, #ffffff 0, #ffffff 5px, transparent 5px) 100% 100%/8px 8px no-repeat,
                linear-gradient(#ffffff, #ffffff) 50% 50%/calc(100% - 6px) calc(100% - 16px) no-repeat,
                linear-gradient(#ffffff, #ffffff) 50% 50%/calc(100% - 16px) calc(100% - 6px) no-repeat,
                linear-gradient(90deg, #009ada 0%, #D21848  100%);
    border-radius: 8px;
    padding: 8px;
    box-sizing: content-box;"
                    class="shadow p-4"> --}}
                    {{-- class="shadow p-4 position-relative"> --}}
                    {{-- <span style="font-size: 12px" class="position-absolute top-0 start-0 badge bg-primary">Round 1 Quiz</span>
                    <span style="font-size: 15px" class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger">Remaining Time <span id="min"></span>:<span id="remain"></span></span>
                    <span style="font-size: 12px" id="showQuestionCounter" class="position-absolute top-0 end-0 badge bg-primary"></span> --}}

                    <div class="d-flex justify-content-between align-items-center">
                        {{-- <span class="badge rounded-pill bg-primary">Round 1 Quiz</span>
                        <span class="badge rounded-pill bg-danger">Remaining Time <span id="min"></span>:<span id="remain"></span></span> --}}

                        {{-- <h4 class="text-right border p-3 m-3 rounded">
                            <span>You have:</span>
                            <span id="min"></span> <b>Minute<span id="s"></span></b>
                            <span id="remain"></span> <b>Second<span id="ss"></span></b>
                        </h4> --}}
                    </div>
                    {{-- <hr class="w-25 text-center d-block mx-auto"> --}}
                    <form id="round1" action="{{ route('round.one.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="duration" id="duration">
                        <input type="hidden" name="" id="question_qty" value="{{ count($question) }}">
                        @foreach ($question as $key => $ques)
                            <div class="question" style="{{ $key == 0 ? '' : 'display:none' }}">
                                @if (!empty($ques['image_question']))
                                    <div class="text-center">
                                        <img style="height: 120px !important;" class="rounded" {{-- <img style="background: radial-gradient(circle at 100% 100%, #ffffff 0, #ffffff 5px, transparent 5px) 0% 0%/8px 8px no-repeat,
                                        radial-gradient(circle at 0 100%, #ffffff 0, #ffffff 5px, transparent 5px) 100% 0%/8px 8px no-repeat,
                                        radial-gradient(circle at 100% 0, #ffffff 0, #ffffff 5px, transparent 5px) 0% 100%/8px 8px no-repeat,
                                        radial-gradient(circle at 0 0, #ffffff 0, #ffffff 5px, transparent 5px) 100% 100%/8px 8px no-repeat,
                                        linear-gradient(#ffffff, #ffffff) 50% 50%/calc(100% - 6px) calc(100% - 16px) no-repeat,
                                        linear-gradient(#ffffff, #ffffff) 50% 50%/calc(100% - 16px) calc(100% - 6px) no-repeat,
                                        linear-gradient(90deg, #db9e9e 0%, #48abe0 100%);
                            border-radius: 8px;
                            padding: 8px;
                            box-sizing: content-box; height: 150px !important;" class="rounded" --}}
                                            src="{{ asset('storage/question/' . $ques['image_question']) }}"
                                            alt="IMG">
                                    </div>

                                @endif
                                <strong style="font-size: 18px" class="text-center">
                                    {{ $ques['question'] }}</strong>
                                <input type="hidden" name="question[{{ $key }}]" id=""
                                    value="{{ $ques['id'] }}">

                                <input type="hidden" name="category_id[{{ $key }}]" id=""
                                    value="{{ $ques['category_id'] }}">
                                @foreach (json_decode($ques['option']) as $keyIndex => $options)
                                    <label class="text-dark me-3 d-block"
                                        for="{{ 'option_' . $key . '_' . $keyIndex }}">
                                        <div id="{{ 'bgcolor_' . $key . '_' . $keyIndex }}"
                                            style="padding: 10px 5px;border-radius: 50px;"
                                            class="border border-2 my-2  bgAllClass">
                                            <div class="">
                                                <input type="radio" id="{{ 'option_' . $key . '_' . $keyIndex }}"
                                                    data-parentID="{{ 'bgcolor_' . $key . '_' . $keyIndex }}"
                                                    name="answer[{{ $key }}]" value="{{ $options }}"
                                                    class="optionCheck border">
                                                {{ $options }}
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                                <button style="background-color: #7CC6FE;color: white;border-radius: 50px"
                                    class="btn border border-2 btn-md my-2 submitAnswer d-none mx-auto d-block"
                                    type="button">Confirm</button>
                            </div>
                        @endforeach
                        <div class="text-center">
                            <button style="background-color: #7CC6FE;color: white;border-radius: 50px" class="btn border border-2 btn-md my-2 d-none" type="submit"
                                id="submitBtn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="{{ asset('admin/assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('custom/admin.js') }}"></script>
    {{-- <script type="text/javascript">
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
                    title: 'Disqualified',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                })
                // alert("disqualified");
                location.href = 'https://bbf.digital/marketing-olympiad/admin-logout';
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
    </script> --}}
    <script type="text/javascript">
        window.onload = counter;

        function counter() {
            minutes = "{{ $minute }}";
            seconds = "{{ $seconds }}";
            count = 0;
            countDown();
        }
    </script>
    <script type="text/javascript">
        function countDown() {
            document.getElementById("min").innerHTML = minutes;
            document.getElementById("remain").innerHTML = seconds;
            document.getElementById("minn").innerHTML = minutes;
            document.getElementById("remainn").innerHTML = seconds;
            document.getElementById("duration").value = count;
            // if (minutes > 1) {
            //     document.getElementById("s").innerHTML = 's';
            // } else {
            //     document.getElementById("s").innerHTML = '';
            // }
            // if (seconds > 1) {
            //     document.getElementById("ss").innerHTML = 's';
            // } else {
            //     document.getElementById("ss").innerHTML = '';
            // }
            if (minutes < 10) {
                document.getElementById("m").innerHTML = '0';
            } else {
                document.getElementById("m").innerHTML = '';
            }
            if (seconds < 10) {
                document.getElementById("z").innerHTML = '0';
            } else {
                document.getElementById("z").innerHTML = '';
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


</body>

</html>
