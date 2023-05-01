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
                <img style="height: 200px" src="{{ asset('storage/logo/logo_text.png') }}" alt="">
            </div>
            <div class="col-md-8 pb-3">

                <div>
                    <div class="d-flex justify-content-between align-items-center">
                        <a class="btn btn-primary" href="#">Download Document</a>
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
                            <label class="focus-label">Cell</label>
                            <div class="input-group form-focus my-2">
                                <input
                                    value="{{ Auth::guard('admin')->user()->cell }}"
                                    type="text" class="form-control floating" readonly>
                            </div>
                            <div class="form-group">
                                <hr>
                                <label>Your File</label><br>
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
