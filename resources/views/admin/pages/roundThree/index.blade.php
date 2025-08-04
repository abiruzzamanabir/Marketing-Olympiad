<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Round Three</title>
    <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <style>
        body {
            background-image: linear-gradient(rgba(255, 255, 255, 0.3), rgb(255, 255, 255, 0.3)), url({{ asset('storage/logo/WebBanner.png') }});
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: top right;
            background-size: cover;
        }

        @media (max-width: 769px) {
            body {
                background-position: center right !important;
                background-size: cover !important;
                background-image: url({{ asset('storage/logo/WebBannerM.png') }});
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div style="margin-bottom:100px" class="row justify-content-around align-items-center mb-5 pb-5">
            <div class="text-center">
                <a href="{{ route('home.page') }}"><img style="height: 200px" src="{{ asset('storage/logo/logo_text.png') }}" alt=""></a>
            </div>
            <div class="col-md-8 pb-3">

                <div>
                    <div>
                        <h5>Case Study:</h5>
                        <p style="text-align: justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum libero quia eius dignissimos, deleniti id error explicabo in ratione delectus commodi nemo dicta rem deserunt? Repudiandae doloremque dolorum consectetur architecto?
                        Deleniti sunt at veritatis asperiores. Impedit sapiente dolore rem quam laboriosam rerum fugiat deleniti numquam, exercitationem perferendis magnam cum, quos corrupti neque delectus nesciunt animi ad, eum ab! Dolorem, accusantium?
                        In dicta voluptate at illo voluptatem cum recusandae cumque fugiat ducimus possimus velit eum itaque optio harum, obcaecati sunt quia vero atque quibusdam autem ratione excepturi? Reprehenderit in error maiores!
                        Illum nihil tempora eius sint, quisquam deleniti? Ullam commodi odio sapiente animi eligendi explicabo labore suscipit eum, aspernatur quidem ex, nihil veniam. Cupiditate maxime labore deleniti iste repellat enim fuga!
                        Laborum aperiam libero molestias facere accusantium unde animi ab quam ipsam, voluptatibus natus facilis id dolore sunt aspernatur aliquam repellendus culpa praesentium magni ullam delectus? Ipsam cum ratione ut facere!</p>
                        <a class="btn btn-primary" href="#">Download Kit</a>
                    </div>
                    <form action="{{ route('round.three.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="border p-3 mt-3">
                            <label class="focus-label">Name</label>
                            <div class="input-group form-focus my-2">
                                <input name="name"
                                    value="{{ Auth::guard('admin')->user()->first_name . '_' . Auth::guard('admin')->user()->last_name }}"
                                    type="text" class="form-control floating" readonly>
                            </div>
                            <label class="focus-label">Email</label>
                            <div class="input-group form-focus my-2">
                                <input
                                    value="{{ Auth::guard('admin')->user()->email }}"
                                    type="text" class="form-control floating" readonly>
                            </div>
                            <label class="focus-label">Phone</label>
                            <div class="input-group form-focus my-2">
                                <input
                                    value="{{ Auth::guard('admin')->user()->cell }}"
                                    type="text" class="form-control floating" readonly>
                            </div>
                            <label class="focus-label">University/Institution</label>
                            <div class="input-group form-focus my-2">
                                <input
                                    value="{{ Auth::guard('admin')->user()->uniname }}"
                                    type="text" class="form-control floating" readonly>
                            </div>
                            <div class="form-group">
                                <hr>
                                <label class="mb-2">Your File (<span class="text-danger">Only Support PDF File</span>)</label>
                                <img style="max-width: 25%;" id="profile-photo-preview" src=""
                                    alt="">
                                <br>
                                    <input  id="profile-photo" name="documentFile" type="file"
                                    class="form-control">
                                {{-- <label for="profile-photo"><img style="cursor: pointer;width: 50px !important"
                                        class="w-25" src="{{ asset('admin\assets\img\upload.gif') }}"
                                        alt=""></label> --}}
                                <br>
                                @if($errors->has('documentFile'))
                                    <span class="text-danger"> {{$errors->first('documentFile')}} </span>
                                @endif
                            </div>
                        </div>
                        <div class="text-center">
                            <button style="border-radius: 50px"
                                class="btn border border-2 btn-md my-2 btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('custom/admin.js') }}"></script>

</body>

</html>
