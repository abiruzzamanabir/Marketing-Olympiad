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
        <div class="row">
            <div class="col-lg-12 pb-5 mb-5">
                <div class="text-center my-3">
                    <a href="{{ route('home.page') }}"><img style="height: 150px"
                            src="{{ asset('storage/logo/logo_text.png') }}" alt=""></a>
                </div>
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
                <div class="text-center my-5">
                    <h1><em>Top 1000</em></h1>
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
                                        <th>Point</th>
                                        <th>Duration</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($all_admin as $user)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $user->first_name }} {{ $user->last_name }} </td>
                                            <td>{{ $user->uniname }}</td>
                                            <td>{{ $user->round_one_result }}</td>
                                            @php
                                                $minute = gmdate('i', $user->duration);
                                                $secounds = gmdate('s', $user->duration);
                                            @endphp
                                            {{-- <td>{{ $minute . ' Minute' . ($minute > 1 ? 's ' : ' ') . $secounds . ' Second' . ($secounds > 1 ? 's ' : ' ') }}</td> --}}
                                            <td>{{ $minute . ' : ' . $secounds }}</td>
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
                <div class="text-center my-5">
                    <h1><em>Top 100</em></h1>
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
                                        <th>Point</th>
                                        <th>Duration</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($all_admin2 as $user)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $user->first_name }} {{ $user->last_name }} </td>
                                            <td>{{ $user->uniname }}</td>
                                            <td>{{ $user->round_one_result }}</td>
                                            @php
                                                $minute = gmdate('i', $user->duration);
                                                $secounds = gmdate('s', $user->duration);
                                            @endphp
                                            {{-- <td>{{ $minute . ' Minute' . ($minute > 1 ? 's ' : ' ') . $secounds . ' Second' . ($secounds > 1 ? 's ' : ' ') }}</td> --}}
                                            <td>{{ $minute . ' : ' . $secounds }}</td>
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
                <div class="text-center my-5">
                    <h1><em>Top 15</em></h1>
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
            </div>
            <div class="row shadow border border-primary border-3 bg-white p-3 mb-5">
                <div class="col-md-12 text-center">
                    <h2><em>Support</em></h2>
                    <img src="{{ asset('frontend/assets/images/heading-line-dec.png') }}" alt="">
                    <p>Email@gmail.com</p>
                    <p>01xxxxxxxxxxx</p>
                    <a style="font-size: 30px;" href="#"><i class="fab fa-facebook-f mx-2" aria-hidden="true"></i></a>
                    <a style="font-size: 30px;" href="#"><i class="fab fa-instagram mx-2"></i></a>
                    <a style="font-size: 30px;" href="#"><i class="fab fa-linkedin-in mx-2" aria-hidden="true"></i></a>
                    <a style="font-size: 30px;" href="#"><i class="fab fa-youtube mx-2" aria-hidden="true"></i></a>
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
