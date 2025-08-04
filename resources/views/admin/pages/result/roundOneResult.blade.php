@php
    use Carbon\Carbon;
    use App\Models\Theme;
    use App\Models\ExamControl;
    $theme = Theme::findOrFail(1);
    $exam = ExamControl::findOrFail(1);
    $social = json_decode($theme->social, false);
    $resultRound1 = Carbon::parse($exam->result_published_time);
    $resultRound2 = Carbon::parse($exam->result_published_time_round_two);
    $resultRound3 = Carbon::parse($exam->result_published_time_round_third);
<<<<<<< HEAD
    $result1_published_time = date('l, F j, Y, g:i A', strtotime($exam->result_published_time));
    $result2_published_time = date('l, F j, Y, g:i A', strtotime($exam->result_published_time_round_two));
    $result3_published_time = date('l, F j, Y, g:i A', strtotime($exam->result_published_time_round_third));
=======
<<<<<<< HEAD
    $result1_published_time = date('l, F j, Y, g:i A', strtotime($exam->result_published_time));
    $result2_published_time = date('l, F j, Y, g:i A', strtotime($exam->result_published_time_round_two));
    $result3_published_time = date('l, F j, Y, g:i A', strtotime($exam->result_published_time_round_third));
=======
    $result1_published_time = date('l, F j, Y, g:i A',strtotime($exam->result_published_time));
    $result2_published_time = date('l, F j, Y, g:i A',strtotime($exam->result_published_time_round_two));
    $result3_published_time = date('l, F j, Y, g:i A',strtotime($exam->result_published_time_round_third));
>>>>>>> e953e31f70933353be58a4715f9c7781ff93376d
>>>>>>> b7a94586bf1b3eedc2dc0d1c4d8bf2e91cd46356

@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Result</title>
    <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.css" />
    {{-- <style>
        .bd {
            border-image: url('{{ asset('admin/assets/img/border.png') }}') 30 stretch !important;
            border-image-width: 30px 20px !important;
            border-image-repeat: stretch !important;
        }
    </style> --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body
    style="background-image: linear-gradient( rgba(255, 255, 255, 0.3), rgb(255, 255, 255, 0.3) ), url({{ asset('frontend/assets/images/slider-left-dec.png') }}); background-repeat:no-repeat;background-attachment: fixed;background-position:left ;background-size:contain;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-11 pb-5 mb-5">
                <div class="text-center my-3">
                    <a href="{{ route('home.page') }}"><img style="height: 150px"
                            src="{{ asset('storage/logo/logo_text.png') }}" alt=""></a>
                </div>
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> b7a94586bf1b3eedc2dc0d1c4d8bf2e91cd46356
                <div class="bg-white border rounded p-3">
                    <p>After the evaluation process, the results of the Marketing Olympiad will be announced on the
                        website. The winners have been selected based on their performance in the competition, which
                        includes the overall score of the participant and time. The results will be published on the
                        website, and participants can access their scores by logging in to their accounts. The winners
                        will also be contacted directly via email and SMS. Shortlisted top-performing participants will
                        be allowed to participate in the next round.</p>
                </div>
                <div class="text-center @if (Carbon::now() >= $resultRound1) my-5 @else my-2 @endif">
                    <h2><em>Shortlist of Round 1</em></h2>
                    <p>(Shortlisted candidates will be allowed for Round 2 of the Marketing Olympiad)</p>
<<<<<<< HEAD
                    <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">
                </div>
                @if (Carbon::now() >= $resultRound1)
                    <div class="card">
                        {{-- <div class="card-header d-flex justify-content-between">
=======
                    <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">
                </div>
                @if (Carbon::now() >= $resultRound1)
                    <div class="card">
                        {{-- <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Round one final result</h4>
                        <div>
                        <a class="btn btn-sm btn-danger" href="{{ route('student.unverified') }}"><i
                            class="fa fa-arrow-left mr-2" aria-hidden="true"></i>Unverified Student</a>
                        <a class="btn btn-sm btn-success" href="{{ route('student.verified') }}">Verified Student<i
                            class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>
                    </div>
                    </div> --}}
                        @include('validate-main')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTable1" class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            {{-- <th>Rank</th> --}}
                                            <th class="border">Name</th>
                                            <th class="border">University/Institute</th>
                                            {{-- <th>Point</th>
                                            <th>Duration</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($all_admin as $user)
                                            <tr>
                                                {{-- <td>{{ $loop->index + 1 }}</td> --}}
                                                <td class="border">{{ $user->first_name }} {{ $user->last_name }} </td>
                                                <td class="border">{{ $user->uniname }}</td>
                                                {{-- <td>{{ $user->round_one_result }}</td>
                                                @php
                                                    $minute = gmdate('i', $user->duration);
                                                    $secounds = gmdate('s', $user->duration);
                                                @endphp --}}
                                                {{-- <td>{{ $minute . ' Minute' . ($minute > 1 ? 's ' : ' ') . $secounds . ' Second' . ($secounds > 1 ? 's ' : ' ') }}</td> --}}
                                                {{-- <td>{{ $minute . ' : ' . $secounds }}</td> --}}
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-danger text-center" colspan="6">No Data Found</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <h5 class="text-center text-danger">Result not published yet. Result will be publish on
                        {{ $result1_published_time }}</h5>
                @endif

                <div class="text-center @if (Carbon::now() >= $resultRound2) my-5 @else my-2 @endif">
                    <h2><em>Top 100</em></h2>
                    <p>(The top 100 participants will be allowed for Round 3 of the Marketing Olympiad)</p>
                    <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">
                </div>
                @if (Carbon::now() >= $resultRound2)
                    <div class="card">
                        {{-- <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Round one final result</h4>
                        <div>
                        <a class="btn btn-sm btn-danger" href="{{ route('student.unverified') }}"><i
                            class="fa fa-arrow-left mr-2" aria-hidden="true"></i>Unverified Student</a>
                        <a class="btn btn-sm btn-success" href="{{ route('student.verified') }}">Verified Student<i
                            class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>
                    </div>
                    </div> --}}
                        @include('validate-main')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTable1" class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <!--<th>Rank</th>-->
                                            <th class="border">Name</th>
                                            <th class="border">University/Institute</th>
                                            <!--<th>Point</th>-->
                                            <!--<th>Duration</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($all_admin2 as $user)
                                            <tr>
                                                
                                                <td class="border">{{ $user->first_name }} {{ $user->last_name }} </td>
                                                <td class="border">{{ $user->uniname }}</td>
                                                
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-danger text-center" colspan="6">No Data Found</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <h5 class="text-center text-danger">Result not published yet. Result will be publish on
                        {{ $result2_published_time }}</h5>
                @endif
                <div class="text-center @if (Carbon::now() >= $resultRound3) my-5 @else my-2 @endif">
                    <h2><em>Top 10</em></h2>
                    <p>(The top 10 participants will reach the Grand Finale of the Marketing Olympiad)</p>
                    <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">
                </div>
                @if (Carbon::now() >= $resultRound3)
                    <div class="card">
                        {{-- <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Round one final result</h4>
                        <div>
                        <a class="btn btn-sm btn-danger" href="{{ route('student.unverified') }}"><i
                            class="fa fa-arrow-left mr-2" aria-hidden="true"></i>Unverified Student</a>
                        <a class="btn btn-sm btn-success" href="{{ route('student.verified') }}">Verified Student<i
                            class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>
                    </div>
                    </div> --}}
                        @include('validate-main')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTable1" class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Rank</th>
                                            <th>Name</th>
                                            <th>University/Institute</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($all_admin3 as $user)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $user->first_name }} {{ $user->last_name }} </td>
                                                <td>{{ $user->uniname }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-danger text-center" colspan="6">No Data Found</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <h5 class="text-center text-danger">Result not published yet. Result will be publish on
                        {{ $result3_published_time }}</h5>
                @endif
                <div class="text-center my-5">
                    <h2><em>Winner</em></h2>
                    <p>(Winners of Marketing Olympiad)</p>
=======
                <p class="bg-white border rounded p-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis
                    laboriosam facere recusandae accusantium reiciendis maiores voluptatem iste rem ratione aspernatur
                    quas non vitae aut cupiditate est, reprehenderit praesentium pariatur hic.
                    Laudantium officia tempore reprehenderit eos? Perferendis, quam reprehenderit a possimus odit
                    dolorum quo culpa nobis quisquam debitis, unde magni eos in. Maiores nemo laboriosam iure in ea,
                    temporibus officiis laudantium?
                    Aliquid non, illo quis atque mollitia nesciunt dolores ab accusantium dolor necessitatibus
                    laboriosam laudantium vel aut iste reprehenderit voluptatum in nihil tempore molestias, quod
                    impedit, eum officia? Assumenda, voluptates ea?
                    Voluptatem repellendus, eveniet molestiae corrupti, fuga ipsa non nihil at, blanditiis distinctio
                    veniam ullam? Dolores itaque quis a eius amet velit necessitatibus quas, tenetur nesciunt error
                    minus recusandae corporis atque.
                    Expedita enim veniam laborum. Similique sapiente blanditiis enim odit officiis, tempora at sunt
                    tenetur cum voluptatem exercitationem aliquid saepe nihil a nisi! Asperiores, veniam corrupti. Error
                    reiciendis laudantium quidem molestiae?
                    Distinctio ad laboriosam, non nostrum molestiae deleniti. Cupiditate, aperiam obcaecati vero, in
                    nobis deserunt explicabo similique nostrum dolores ut distinctio debitis, ratione amet provident
                    dignissimos quasi doloribus repellendus. Accusamus, unde.
                    Temporibus doloribus ipsum voluptate dicta expedita asperiores minus ad quae. Perferendis, fugit!
                    Optio debitis animi qui magni iure dolorem veniam, asperiores voluptate at? Obcaecati quod enim
                    voluptates, consectetur perferendis beatae.
                    Laudantium excepturi eveniet, reprehenderit at dignissimos nisi consequuntur deleniti possimus,
                    sequi illum minima obcaecati! Doloribus impedit, expedita eligendi nihil esse dicta mollitia
                    dignissimos facilis obcaecati. Quaerat pariatur laborum quisquam cumque?
                    Totam ad optio iusto, voluptate maiores repellendus exercitationem mollitia velit animi enim at
                    perferendis quisquam dignissimos natus suscipit vitae beatae consequuntur! Eos, ut. Architecto sint
                    dignissimos fugiat adipisci quibusdam aspernatur.
                    Labore, sint adipisci! Repellendus ut blanditiis, totam doloremque deserunt quidem tenetur veritatis
                    distinctio vero eligendi omnis sint error vel eaque neque molestias magnam ducimus aliquam inventore
                    odit rerum voluptatem doloribus. <br>
                    {{-- <a href="{{ route('round.one.final.export') }}" class="btn btn-primary btn-sm my-3">Download Result</a> --}}
                </p>
                <div class="text-center @if (Carbon::now() >= $resultRound1)my-5 @else my-2 @endif">
                    <h1><em>Top 1000</em></h1>
>>>>>>> e953e31f70933353be58a4715f9c7781ff93376d
                    <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">
                </div>
                @if (Carbon::now() >= $resultRound1)
                <div class="card">
                    {{-- <div class="card-header d-flex justify-content-between">
>>>>>>> b7a94586bf1b3eedc2dc0d1c4d8bf2e91cd46356
                        <h4 class="card-title">Round one final result</h4>
                        <div>
                        <a class="btn btn-sm btn-danger" href="{{ route('student.unverified') }}"><i
                            class="fa fa-arrow-left mr-2" aria-hidden="true"></i>Unverified Student</a>
                        <a class="btn btn-sm btn-success" href="{{ route('student.verified') }}">Verified Student<i
                            class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>
                    </div>
                    </div> --}}
<<<<<<< HEAD
                        @include('validate-main')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTable1" class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            {{-- <th>Rank</th> --}}
                                            <th class="border">Name</th>
                                            <th class="border">University/Institute</th>
                                            {{-- <th>Point</th>
                                            <th>Duration</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($all_admin as $user)
                                            <tr>
                                                {{-- <td>{{ $loop->index + 1 }}</td> --}}
                                                <td class="border">{{ $user->first_name }} {{ $user->last_name }} </td>
                                                <td class="border">{{ $user->uniname }}</td>
                                                {{-- <td>{{ $user->round_one_result }}</td>
                                                @php
                                                    $minute = gmdate('i', $user->duration);
                                                    $secounds = gmdate('s', $user->duration);
                                                @endphp --}}
                                                {{-- <td>{{ $minute . ' Minute' . ($minute > 1 ? 's ' : ' ') . $secounds . ' Second' . ($secounds > 1 ? 's ' : ' ') }}</td> --}}
                                                {{-- <td>{{ $minute . ' : ' . $secounds }}</td> --}}
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-danger text-center" colspan="6">No Data Found</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <h5 class="text-center text-danger">Result not published yet. Result will be publish on
                        {{ $result1_published_time }}</h5>
                @endif

                <div class="text-center @if (Carbon::now() >= $resultRound2) my-5 @else my-2 @endif">
                    <h2><em>Top 100</em></h2>
                    <p>(The top 100 participants will be allowed for Round 3 of the Marketing Olympiad)</p>
                    <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">
                </div>
                @if (Carbon::now() >= $resultRound2)
                    <div class="card">
                        {{-- <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Round one final result</h4>
                        <div>
                        <a class="btn btn-sm btn-danger" href="{{ route('student.unverified') }}"><i
                            class="fa fa-arrow-left mr-2" aria-hidden="true"></i>Unverified Student</a>
                        <a class="btn btn-sm btn-success" href="{{ route('student.verified') }}">Verified Student<i
                            class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>
                    </div>
                    </div> --}}
                        @include('validate-main')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTable1" class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <!--<th>Rank</th>-->
                                            <th class="border">Name</th>
                                            <th class="border">University/Institute</th>
                                            <!--<th>Point</th>-->
                                            <!--<th>Duration</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($all_admin2 as $user)
                                            <tr>

                                                <td class="border">{{ $user->first_name }} {{ $user->last_name }} </td>
                                                <td class="border">{{ $user->uniname }}</td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-danger text-center" colspan="6">No Data Found</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <h5 class="text-center text-danger">Result not published yet. Result will be publish on
                        {{ $result2_published_time }}</h5>
                @endif
                <div class="text-center @if (Carbon::now() >= $resultRound3) my-5 @else my-2 @endif">
                    <h2><em>Top 10</em></h2>
                    <p>(The top 10 participants will reach the Grand Finale of the Marketing Olympiad)</p>
                    <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">
                </div>
                @if (Carbon::now() >= $resultRound3)
                    <div class="card">
                        {{-- <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Round one final result</h4>
                        <div>
                        <a class="btn btn-sm btn-danger" href="{{ route('student.unverified') }}"><i
                            class="fa fa-arrow-left mr-2" aria-hidden="true"></i>Unverified Student</a>
                        <a class="btn btn-sm btn-success" href="{{ route('student.verified') }}">Verified Student<i
                            class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>
                    </div>
                    </div> --}}
                        @include('validate-main')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTable1" class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <!--<th>Rank</th>-->
                                            <th class="border">Name</th>
                                            <th class="border">University/Institute</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($all_admin3 as $user)
                                            <tr>
                                                <!--<td>{{ $loop->index + 1 }}</td>-->
                                                <td class="border">{{ $user->name }} </td>
                                                <td class="border">{{ $user->university }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-danger text-center" colspan="6">No Data Found</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <h5 class="text-center text-danger">Result not published yet. Result will be publish on
                        {{ $result3_published_time }}</h5>
                @endif
                <div class="text-center my-5">
                    <h2><em>Winner</em></h2>
                    <p>(Winners of Marketing Olympiad)</p>
                    <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">
                </div>
                @php
                    use App\Models\Winner;
                    $count = Winner::where('year', Carbon::now()->year)->count();
                @endphp
                @if ($count>0)
=======
                    @include('validate-main')
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTable1" class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Name</th>
                                        <th>University/Institute</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($all_admin4 as $user)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $user->first_name }} {{ $user->last_name }} </td>
                                            <td>{{ $user->uniname }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-danger text-center" colspan="6">No Data Found</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @else
                <h3 class="text-center text-danger">Result not published yet. Result will be publish on {{$result1_published_time}}</h3>
                @endif

                <div class="text-center @if (Carbon::now() >= $resultRound2)my-5 @else my-2 @endif">
                    <h1><em>Top 100</em></h1>
                    <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">
                </div>
                @if (Carbon::now() >= $resultRound2)
>>>>>>> b7a94586bf1b3eedc2dc0d1c4d8bf2e91cd46356
                <div class="card">
                    {{-- <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Round one final result</h4>
                        <div>
                        <a class="btn btn-sm btn-danger" href="{{ route('student.unverified') }}"><i
                            class="fa fa-arrow-left mr-2" aria-hidden="true"></i>Unverified Student</a>
                        <a class="btn btn-sm btn-success" href="{{ route('student.verified') }}">Verified Student<i
                            class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>
                    </div>
                    </div> --}}
                    @include('validate-main')
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTable1" class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th class="border">Rank</th>
                                        <th class="border">Name</th>
                                        <th class="border">University/Institute</th>
                                    </tr>
                                </thead>
                                <tbody>
<<<<<<< HEAD
                                    @forelse ($all_admin4 as $user)
                                       <tr>
                                        @if ($user->rank==1)
                                        <td>Champion</td>
                                        @elseif($user->rank==2)
                                        <td>1st Runner Up</td>
                                        @else
                                        <td>2nd Runner Up</td>
                                        @endif
                                          <td>{{ $user->name }}</td>
                                          <td>{{ $user->university }}</td>
                                    </tr>
=======
                                    @forelse ($all_admin2 as $user)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $user->first_name }} {{ $user->last_name }} </td>
                                            <td>{{ $user->uniname }}</td>
                                            <td>{{ $user->round_two_result }}</td>
                                            @php
                                                $minute = gmdate('i', $user->durationTwo);
                                                $secounds = gmdate('s', $user->durationTwo);
                                            @endphp
                                            {{-- <td>{{ $minute . ' Minute' . ($minute > 1 ? 's ' : ' ') . $secounds . ' Second' . ($secounds > 1 ? 's ' : ' ') }}</td> --}}
                                            <td>{{ $minute . ' : ' . $secounds }}</td>
                                        </tr>
>>>>>>> b7a94586bf1b3eedc2dc0d1c4d8bf2e91cd46356
                                    @empty
                                    <tr>
                                    <td class="text-danger text-center" colspan="6">No Data Found</td>
                                    </tr>
                                    @endforelse
                                    {{-- <tr>
                                            <td class="border">Champion</td>
                                            <td class="border">Nadia Hossain</td>
                                            <td class="border">North South University</td>
                                    </tr>
                                    <tr>
                                            <td class="border">1st Runner Up</td>
                                            <td class="border">Shirsha Rohan Roy</td>
                                            <td class="border">Institute of Business Administration, University of Dhaka</td>
                                    </tr>
                                    <tr>
                                            <td class="border">2nd Runner Up</td>
                                            <td class="border">Mohtasim Bin Habib</td>
                                            <td class="border">Institute of Business Administration, University of Dhaka</td>
                                    </tr> --}}

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @else
<<<<<<< HEAD
                    <h5 class="text-center text-danger">Result not published yet.</h5>
                @endif
=======
                <h3 class="text-center text-danger">Result not published yet. Result will be publish on {{$result2_published_time}}</h3>
                @endif
                <div class="text-center @if (Carbon::now() >= $resultRound3)my-5 @else my-2 @endif">
                    <h1><em>Top 15</em></h1>
                    <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">
                </div>
                @if (Carbon::now() >= $resultRound3)
                <div class="card">
                    {{-- <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Round one final result</h4>
                        <div>
                        <a class="btn btn-sm btn-danger" href="{{ route('student.unverified') }}"><i
                            class="fa fa-arrow-left mr-2" aria-hidden="true"></i>Unverified Student</a>
                        <a class="btn btn-sm btn-success" href="{{ route('student.verified') }}">Verified Student<i
                            class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>
                    </div>
                    </div> --}}
                    @include('validate-main')
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTable1" class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Name</th>
                                        <th>University/Institute</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($all_admin3 as $user)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $user->first_name }} {{ $user->last_name }} </td>
                                            <td>{{ $user->uniname }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-danger text-center" colspan="6">No Data Found</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @else
                <h3 class="text-center text-danger">Result not published yet. Result will be publish on {{$result3_published_time}}</h3>
                @endif
                <div class="text-center my-5">
                    <h1><em>Winner</em></h1>
                    <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">
                </div>
                <div class="card">
                    {{-- <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Round one final result</h4>
                        <div>
                        <a class="btn btn-sm btn-danger" href="{{ route('student.unverified') }}"><i
                            class="fa fa-arrow-left mr-2" aria-hidden="true"></i>Unverified Student</a>
                        <a class="btn btn-sm btn-success" href="{{ route('student.verified') }}">Verified Student<i
                            class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>
                    </div>
                    </div> --}}
                    @include('validate-main')
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTable1" class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Name</th>
                                        <th>University/Institute</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($all_admin4 as $user)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $user->first_name }} {{ $user->last_name }} </td>
                                            <td>{{ $user->uniname }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-danger text-center" colspan="6">No Data Found</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
>>>>>>> b7a94586bf1b3eedc2dc0d1c4d8bf2e91cd46356
            </div>
            <div class="row shadow  bg-white p-3 mb-5">
                <div class="col-md-12 text-center">
                    <h2><em>Support</em></h2>
                    <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">
<<<<<<< HEAD
                    <p>support@marketingolympiad.com</p>
                    <!--<p>01xxxxxxxxxxx</p>-->
=======
<<<<<<< HEAD
                    <p>support@marketingolympiad.com</p>
                    <!--<p>01xxxxxxxxxxx</p>-->
=======
                    <p>Email@gmail.com</p>
                    <p>01xxxxxxxxxxx</p>
>>>>>>> e953e31f70933353be58a4715f9c7781ff93376d
>>>>>>> b7a94586bf1b3eedc2dc0d1c4d8bf2e91cd46356
                    @if (!empty($social->facebook))
                        <a style="font-size: 30px;" href="{{ $social->facebook }}" target="_blank"><i
                                class="fab fa-facebook-f mx-2" aria-hidden="true"></i></a>
                    @endif
                    @if (!empty($social->instagram))
                        <a style="font-size: 30px;" href="{{ $social->instagram }}" target="_blank"><i
                                class="fab fa-instagram mx-2"></i></a>
                    @endif
                    @if (!empty($social->linkedin))
                        <a style="font-size: 30px;" href="{{ $social->linkedin }}" target="_blank"><i
                                class="fab fa-linkedin-in mx-2" aria-hidden="true"></i></a>
                    @endif
                    @if (!empty($social->youtube))
                        <a style="font-size: 30px;" href="{{ $social->youtube }}" target="_blank"><i
                                class="fab fa-youtube mx-2" aria-hidden="true"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('custom/admin.js') }}"></script>

</body>

</html>
