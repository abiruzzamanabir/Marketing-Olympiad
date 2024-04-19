@php
    use App\Models\Theme;
    $theme = Theme::findOrFail(1);
@endphp
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
    <style>
        @media (max-width: 769px) {
            body {
                background-position: top left !important;
                background-size: cover !important;
                background-image: linear-gradient(rgba(224, 224, 224, 0.5), rgba(224, 224, 224, 0.5)), url({{ asset('storage/logo/background.png') }}) !important;
            }
        }
    </style>
</head>

<body
    style="background-image: linear-gradient( rgba(255, 255, 255, 0.3), rgb(255, 255, 255, 0.3) ), url({{ asset('storage/logo/background.png') }}); background-repeat:no-repeat;background-attachment: fixed;background-position:top right ;background-size:cover;">
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
            {{-- <div style="background: radial-gradient(circle at 100% 100%, #ffffff 0, #ffffff 5px, transparent 5px) 0% 0%/8px 8px no-repeat,
                radial-gradient(circle at 0 100%, #ffffff 0, #ffffff 5px, transparent 5px) 100% 0%/8px 8px no-repeat,
                radial-gradient(circle at 100% 0, #ffffff 0, #ffffff 5px, transparent 5px) 0% 100%/8px 8px no-repeat,
                radial-gradient(circle at 0 0, #ffffff 0, #ffffff 5px, transparent 5px) 100% 100%/8px 8px no-repeat,
                linear-gradient(#ffffff, #ffffff) 50% 50%/calc(100% - 6px) calc(100% - 16px) no-repeat,
                linear-gradient(#ffffff, #ffffff) 50% 50%/calc(100% - 16px) calc(100% - 6px) no-repeat,
                linear-gradient(90deg, #db9e9e 0%, #48abe0 100%);
    border-radius: 8px;
    padding: 8px;
    box-sizing: content-box;"  class="bd col-md-6 m-2 border rounded text-center bg-white shadow py-4"> --}}
            <div class="bd col-md-6 m-2 text-center py-4">
                {{-- <div style="background-image: url({{ asset('storage/logo/conn.gif') }}); background-repeat:no-repeat;background-attachment: fixed;background-position:center ;background-size:cover;"  class="bd col-md-6 border rounded text-center p-2 bg-white shadow mt-5 py-5"> --}}
                {{-- <div class="bd col-md-6 border rounded text-center p-2 bg-white shadow mt-5 py-5"> --}}
                {{-- <img class="img-fluid" style="height: 250px;" src="{{ asset('storage/logo/congratulation.png') }}" alt=""> --}}
                @if (Auth::guard('admin')->user()->round_two_status)
                    <div class="text-center">
                        <img style="height: 150px" src="{{ asset('storage/logo/' . $theme->logo) }}" alt="">
                    </div>
                    <h1 style="font-family: 'Great Vibes', cursive;font-size: 55px">Congratulations!</h2>

                        <div class="card-body text-center py-2">
                            <h3 class="text-uppercase">{{ Auth::guard('admin')->user()->first_name }}
                                {{ Auth::guard('admin')->user()->last_name }}</h3>
                            <h4>You have completed the 2nd round.</h4>
                            <h4><span>Your Score:
                                    {{ Auth::guard('admin')->user()->round_two_result }}</span>/<span>{{ $exam->question_qty }}</span>
                            </h4>
                            @php
                                $minute = gmdate('i', Auth::guard('admin')->user()->durationTwo);
                                $secounds = gmdate('s', Auth::guard('admin')->user()->durationTwo);
                            @endphp
                            <h5 class="text-dark">Exam Duration:
                                {{ $minute . ' Minute' . ($minute > 1 ? 's ' : ' ') . $secounds . ' Second' . ($secounds > 1 ? 's ' : ' ') }}
                            </h5>
                            {{-- @if (Auth::guard('admin')->user()->round_one_status == true && empty(Auth::guard('admin')->user()->certificate)) --}}
                            {{--<a style="background-color: #0F3F68;" class="btn text-white mt-3 btn-md text-center"
                                href="{{ route('get.certificate') }}">Get Certificate</a><br>--}}<br>
                            <a class="text-dark" href="{{ route('home.page') }}"><u>Click here to redirect
                                    Homepage</u></a>
                            {{-- @endif
                            /* @if (Auth::guard('admin')->user()->round_one_status == true && !empty(Auth::guard('admin')->user()->certificate))
                                <a class="btn btn-sm btn-success text-center"
                                    href="{{ route('download.certificate') }}">Download Certificate</a> */
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

    <script>
        'use strict';

        window.onload = function() {
            // Globals
            var random = Math.random,
                cos = Math.cos,
                sin = Math.sin,
                PI = Math.PI,
                PI2 = PI * 2,
                timer = undefined,
                frame = undefined,
                confetti = [];

            var particles = 10,
                spread = 40,
                sizeMin = 3,
                sizeMax = 12 - sizeMin,
                eccentricity = 10,
                deviation = 100,
                dxThetaMin = -.1,
                dxThetaMax = -dxThetaMin - dxThetaMin,
                dyMin = .13,
                dyMax = .18,
                dThetaMin = .4,
                dThetaMax = .7 - dThetaMin;

            var colorThemes = [
                function() {
                    return color(200 * random() | 0, 200 * random() | 0, 200 * random() | 0);
                },
                function() {
                    var black = 200 * random() | 0;
                    return color(200, black, black);
                },
                function() {
                    var black = 200 * random() | 0;
                    return color(black, 200, black);
                },
                function() {
                    var black = 200 * random() | 0;
                    return color(black, black, 200);
                },
                function() {
                    return color(200, 100, 200 * random() | 0);
                },
                function() {
                    return color(200 * random() | 0, 200, 200);
                },
                function() {
                    var black = 256 * random() | 0;
                    return color(black, black, black);
                },
                function() {
                    return colorThemes[random() < .5 ? 1 : 2]();
                },
                function() {
                    return colorThemes[random() < .5 ? 3 : 5]();
                },
                function() {
                    return colorThemes[random() < .5 ? 2 : 4]();
                }
            ];

            function color(r, g, b) {
                return 'rgb(' + r + ',' + g + ',' + b + ')';
            }

            // Cosine interpolation
            function interpolation(a, b, t) {
                return (1 - cos(PI * t)) / 2 * (b - a) + a;
            }

            // Create a 1D Maximal Poisson Disc over [0, 1]
            var radius = 1 / eccentricity,
                radius2 = radius + radius;

            function createPoisson() {
                // domain is the set of points which are still available to pick from
                // D = union{ [d_i, d_i+1] | i is even }
                var domain = [radius, 1 - radius],
                    measure = 1 - radius2,
                    spline = [0, 1];
                while (measure) {
                    var dart = measure * random(),
                        i, l, interval, a, b, c, d;

                    // Find where dart lies
                    for (i = 0, l = domain.length, measure = 0; i < l; i += 2) {
                        a = domain[i], b = domain[i + 1], interval = b - a;
                        if (dart < measure + interval) {
                            spline.push(dart += a - measure);
                            break;
                        }
                        measure += interval;
                    }
                    c = dart - radius, d = dart + radius;

                    // Update the domain
                    for (i = domain.length - 1; i > 0; i -= 2) {
                        l = i - 1, a = domain[l], b = domain[i];
                        // c---d          c---d  Do nothing
                        //   c-----d  c-----d    Move interior
                        //   c--------------d    Delete interval
                        //         c--d          Split interval
                        //       a------b
                        if (a >= c && a < d)
                            if (b > d) domain[l] = d; // Move interior (Left case)
                            else domain.splice(l, 2); // Delete interval
                        else if (a < c && b > c)
                            if (b <= d) domain[i] = c; // Move interior (Right case)
                            else domain.splice(i, 0, c, d); // Split interval
                    }

                    // Re-measure the domain
                    for (i = 0, l = domain.length, measure = 0; i < l; i += 2)
                        measure += domain[i + 1] - domain[i];
                }

                return spline.sort();
            }

            // Create the overarching container
            var container = document.createElement('div');
            container.style.position = 'fixed';
            container.style.top = '0';
            container.style.left = '0';
            container.style.width = '100%';
            container.style.height = '0';
            container.style.overflow = 'visible';
            container.style.zIndex = '9999';

            // Confetto constructor
            function Confetto(theme) {
                this.frame = 0;
                this.outer = document.createElement('div');
                this.inner = document.createElement('div');
                this.outer.appendChild(this.inner);

                var outerStyle = this.outer.style,
                    innerStyle = this.inner.style;
                outerStyle.position = 'absolute';
                outerStyle.width = (sizeMin + sizeMax * random()) + 'px';
                outerStyle.height = (sizeMin + sizeMax * random()) + 'px';
                innerStyle.width = '100%';
                innerStyle.height = '100%';
                innerStyle.backgroundColor = theme();

                outerStyle.perspective = '50px';
                outerStyle.transform = 'rotate(' + (360 * random()) + 'deg)';
                this.axis = 'rotate3D(' +
                    cos(360 * random()) + ',' +
                    cos(360 * random()) + ',0,';
                this.theta = 360 * random();
                this.dTheta = dThetaMin + dThetaMax * random();
                innerStyle.transform = this.axis + this.theta + 'deg)';

                this.x = window.innerWidth * random();
                this.y = -deviation;
                this.dx = sin(dxThetaMin + dxThetaMax * random());
                this.dy = dyMin + dyMax * random();
                outerStyle.left = this.x + 'px';
                outerStyle.top = this.y + 'px';

                // Create the periodic spline
                this.splineX = createPoisson();
                this.splineY = [];
                for (var i = 1, l = this.splineX.length - 1; i < l; ++i)
                    this.splineY[i] = deviation * random();
                this.splineY[0] = this.splineY[l] = deviation * random();

                this.update = function(height, delta) {
                    this.frame += delta;
                    this.x += this.dx * delta;
                    this.y += this.dy * delta;
                    this.theta += this.dTheta * delta;

                    // Compute spline and convert to polar
                    var phi = this.frame % 7777 / 7777,
                        i = 0,
                        j = 1;
                    while (phi >= this.splineX[j]) i = j++;
                    var rho = interpolation(
                        this.splineY[i],
                        this.splineY[j],
                        (phi - this.splineX[i]) / (this.splineX[j] - this.splineX[i])
                    );
                    phi *= PI2;

                    outerStyle.left = this.x + rho * cos(phi) + 'px';
                    outerStyle.top = this.y + rho * sin(phi) + 'px';
                    innerStyle.transform = this.axis + this.theta + 'deg)';
                    return this.y > height + deviation;
                };
            }

            function poof() {
                if (!frame) {
                    // Append the container
                    document.body.appendChild(container);

                    // Add confetti
                    var theme = colorThemes[0],
                        count = 0;
                    (function addConfetto() {
                        var confetto = new Confetto(theme);
                        confetti.push(confetto);
                        container.appendChild(confetto.outer);
                        timer = setTimeout(addConfetto, spread * random());
                    })(0);

                    // Start the loop
                    var prev = undefined;
                    requestAnimationFrame(function loop(timestamp) {
                        var delta = prev ? timestamp - prev : 0;
                        prev = timestamp;
                        var height = window.innerHeight;

                        for (var i = confetti.length - 1; i >= 0; --i) {
                            if (confetti[i].update(height, delta)) {
                                container.removeChild(confetti[i].outer);
                                confetti.splice(i, 1);
                            }
                        }

                        if (timer || confetti.length)
                            return frame = requestAnimationFrame(loop);

                        // Cleanup
                        document.body.removeChild(container);
                        frame = undefined;
                    });
                }
            }

            poof();
        };
    </script>
</body>

</html>
