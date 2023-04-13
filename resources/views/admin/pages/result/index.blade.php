    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Result</title>
        <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        {{-- <style>
            .bd {
                border-image: url('{{ asset('admin/assets/img/border.png') }}') 30 stretch !important;
                border-image-width: 30px 20px !important;
                border-image-repeat: stretch !important;
            }
        </style> --}}
    </head>

    <body
    style="background-image: linear-gradient( rgba(255, 255, 255, 0.3), rgb(255, 255, 255, 0.3) ), url({{ asset('storage/logo/WebBanner.png') }}); background-repeat:no-repeat;background-attachment: fixed;background-position:right ;background-size:cover;">
        <div class="container">

            @php
                use App\Models\ExamControl;
                $exam = ExamControl::findOrFail(1);

            @endphp
            {{-- <div style="margin-top: 200px !important" class="row justify-content-center mt-5">
                @if (Auth::guard('admin')->user()->round_one_status)
                    <div class="col-md-6">
                        <div class="card border shadow-sm">
                            <div class="card-header bg-info">
                                <h4 class="card-title text-center text-white">Round 1 Result</h4>
                            </div>
                            @include('validate')
                            <div class="card-body text-center py-2">
                                <h2><span
                                        class="@if (Auth::guard('admin')->user()->round_one_result < 2) text-danger
                                        @elseif(Auth::guard('admin')->user()->round_one_result < 3)
                                            text-warning
                                        @else
                                            text-success @endif">{{ Auth::guard('admin')->user()->round_one_result }}</span>/<span
                                        class="text-primary">{{ $exam->question_qty }}</span>
                                </h2>
                                @php
                                $minute = gmdate("i", Auth::guard('admin')->user()->duration);
                                $secounds = gmdate("s", Auth::guard('admin')->user()->duration);
                                @endphp
                                <hr>
                                <p class="text-muted">Exam Duration: {{ $minute . ' Minute'. (($minute > 1) ? 's ' : ' ') . $secounds . ' Second'. (($secounds > 1) ? 's ' : ' ')}}</p>

                            </div>
                            <div class="card-footer text-center">
                                {{-- <a class="btn btn-sm btn-primary text-center" href="{{ route('home.page') }}">Go To
                                    Homepage</a> --}}
            {{-- @if (Auth::guard('admin')->user()->round_one_status == true && empty(Auth::guard('admin')->user()->certificate))
                                    <a class="btn btn-sm btn-success text-center"
                                        href="{{ route('get.certificate') }}">Generate Certificate</a>
                                @endif
                                @if (Auth::guard('admin')->user()->round_one_status == true && !empty(Auth::guard('admin')->user()->certificate))
                                    <a class="btn btn-sm btn-success text-center"
                                        href="{{ route('download.certificate') }}">Download Certificate</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif --}}
            {{-- @if (Auth::guard('admin')->user()->round_two_status)
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
                    text-success @endif">{{ Auth::guard('admin')->user()->round_two_result }}</span>/<span
                                        class="text-primary">3</span>
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
                    text-success @endif">{{ Auth::guard('admin')->user()->round_three_result }}</span>/<span
                                        class="text-primary">3</span>
                                </h2>
                            </div>
                        </div>
                    </div>
                @endif --}}
            {{-- </div> --}}
            <div style="height: 100vh" class="row justify-content-center align-items-center">
                <div style="background: radial-gradient(circle at 100% 100%, #ffffff 0, #ffffff 5px, transparent 5px) 0% 0%/8px 8px no-repeat,
                radial-gradient(circle at 0 100%, #ffffff 0, #ffffff 5px, transparent 5px) 100% 0%/8px 8px no-repeat,
                radial-gradient(circle at 100% 0, #ffffff 0, #ffffff 5px, transparent 5px) 0% 100%/8px 8px no-repeat,
                radial-gradient(circle at 0 0, #ffffff 0, #ffffff 5px, transparent 5px) 100% 100%/8px 8px no-repeat,
                linear-gradient(#ffffff, #ffffff) 50% 50%/calc(100% - 6px) calc(100% - 16px) no-repeat,
                linear-gradient(#ffffff, #ffffff) 50% 50%/calc(100% - 16px) calc(100% - 6px) no-repeat,
                linear-gradient(90deg, #db9e9e 0%, #48abe0 100%);
    border-radius: 8px;
    padding: 8px;
    box-sizing: content-box;"  class="bd col-md-6 border rounded text-center bg-white shadow py-4">
                {{-- <div style="background-image: url({{ asset('storage/logo/conn.gif') }}); background-repeat:no-repeat;background-attachment: fixed;background-position:center ;background-size:cover;"  class="bd col-md-6 border rounded text-center p-2 bg-white shadow mt-5 py-5"> --}}
                {{-- <div class="bd col-md-6 border rounded text-center p-2 bg-white shadow mt-5 py-5"> --}}
                    {{-- <img class="img-fluid" style="height: 250px;" src="{{ asset('storage/logo/congratulation.png') }}" alt=""> --}}
                    @if (Auth::guard('admin')->user()->round_one_status)
                    <div class="text-center">
                        <img style="height: 100px" src="{{ asset('storage/logo/logo.png') }}" alt="">
                    </div>
                    <h1 style="font-family: 'Great Vibes', cursive;font-size: 65px">Congratualations</h2>

                        <div class="card-body text-center py-2">
                            <h3 class="text-uppercase">{{ Auth::guard('admin')->user()->first_name }}
                                {{ Auth::guard('admin')->user()->last_name }}</h3>
                                <h4>You have completed the 1st round.</h4>
                            <h4><span>Your Score: {{ Auth::guard('admin')->user()->round_one_result }}</span>/<span>{{ $exam->question_qty }}</span>
                            </h4>
                            @php
                                $minute = gmdate('i', Auth::guard('admin')->user()->duration);
                                $secounds = gmdate('s', Auth::guard('admin')->user()->duration);
                            @endphp
                            <h5 class="text-muted">Exam Duration:
                                {{ $minute . ' Minute' . ($minute > 1 ? 's ' : ' ') . $secounds . ' Second' . ($secounds > 1 ? 's ' : ' ') }}
                            </h5>
                            {{-- @if (Auth::guard('admin')->user()->round_one_status == true && empty(Auth::guard('admin')->user()->certificate)) --}}
                                <a style="background-color: #0F3F68;" class="btn text-white mt-3 btn-md text-center"
                                    href="{{ route('get.certificate') }}">Get Certificate</a><br><br>
                                    <a class="text-muted" href="{{ route('home.page') }}"><u>Click here to redirect Homepage</u></a>
                            {{-- @endif
                            @if (Auth::guard('admin')->user()->round_one_status == true && !empty(Auth::guard('admin')->user()->certificate))
                                <a class="btn btn-sm btn-success text-center"
                                    href="{{ route('download.certificate') }}">Download Certificate</a>
                            @endif --}}
                        </div>

                </div>
            </div>
            @endif
        </div>
        </div>
        </div>
        <script src="{{ asset('admin/assets/js/jquery-3.2.1.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('custom/admin.js') }}"></script>


    </body>

    </html>
