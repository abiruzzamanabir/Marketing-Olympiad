    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Round 1</title>
        <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    </head>

    <body style="background-image: url({{ asset('storage/logo/Background.jpg') }});  background-size: cover;">

        <div class="container">
            @php
                use App\Models\ExamControl;
                $exam = ExamControl::findOrFail(1);

            @endphp
            <div style="margin-top: 200px !important" class="row justify-content-center mt-5">
                @if (Auth::guard('admin')->user()->round_one_status)
                    <div class="col-md-8">
                        <div class="card border shadow-sm">
                            <div class="card-header">
                                <h4 class="card-title text-center">Round 1 Result</h4>
                            </div>
                            @include('validate')
                            <div class="card-body text-center py-5">
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
                                <p class="text-muted">Exam Duration: {{ $minute . ' Minute'. (($minute > 1) ? 's ' : ' ') . $secounds . ' Second'. (($secounds > 1) ? 's ' : ' ')}}</p>
                                <a class="btn btn-sm btn-primary text-center" href="{{ route('home.page') }}">Go To
                                    Homepage</a>
                                @if (Auth::guard('admin')->user()->round_one_status == true && empty(Auth::guard('admin')->user()->certificate))
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
                @endif
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
            </div>
        </div>
        <script src="{{ asset('admin/assets/js/jquery-3.2.1.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('custom/admin.js') }}"></script>


    </body>

    </html>
