@php
    use Carbon\Carbon;
    use App\Models\ExamControl;

    $exam = ExamControl::findOrFail(1);
    $closed = Carbon::parse($exam->end_date_time);
    $registrationClosed = Carbon::now() >= $closed;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>{{ $theme->title }} - Register</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/logo/' . $theme->favicon) }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">

    <style>
        :root {
            --brand-primary: #1554ff;
            --brand-dark: #0d1730;
            --brand-muted: #667085;
            --brand-border: #e6eaf2;
            --brand-bg: #f6f8fc;
            --brand-soft: #edf3ff;
            --brand-danger: #dc3545;
        }

        body {
            background: var(--brand-bg);
            color: var(--brand-dark);
        }

        .registration-page {
            min-height: 100vh;
            padding: 36px 0;
            background:
                radial-gradient(circle at top left, rgba(21, 84, 255, 0.14), transparent 32%),
                linear-gradient(135deg, #f7f9ff 0%, #eef3ff 45%, #ffffff 100%);
        }

        .registration-shell {
            display: flex;
            overflow: hidden;
            border-radius: 28px;
            background: #ffffff;
            box-shadow: 0 28px 70px rgba(16, 24, 40, 0.12);
        }

        .registration-side {
            width: 36%;
            min-height: 760px;
            padding: 42px 36px;
            color: #ffffff;
            background:
                linear-gradient(145deg, rgba(13, 23, 48, 0.96), rgba(21, 84, 255, 0.86)),
                url("{{ asset('admin/assets/img/login-bg.png') }}");
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .registration-side::after {
            content: "";
            position: absolute;
            inset: auto 30px 30px auto;
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
        }

        .brand-logo-card {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 14px 18px;
            border-radius: 18px;
            background: #ffffff;
            margin-bottom: 42px;
        }

        .brand-logo-card img {
            max-width: 130px;
            max-height: 70px;
        }

        .registration-side h1 {
            font-size: 38px;
            line-height: 1.16;
            font-weight: 800;
            margin-bottom: 18px;
            color: #ffffff;
        }

        .registration-side p {
            font-size: 16px;
            line-height: 1.7;
            color: rgba(255, 255, 255, 0.82);
        }

        .side-points {
            margin-top: 36px;
            padding: 0;
            list-style: none;
        }

        .side-points li {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
        }

        .side-points i {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.14);
        }

        .registration-content {
            width: 64%;
            padding: 42px 46px;
        }

        .form-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 26px;
        }

        .form-header h2 {
            font-size: 30px;
            font-weight: 800;
            margin: 0 0 8px;
            color: var(--brand-dark);
        }

        .form-header p {
            margin: 0;
            color: var(--brand-muted);
        }

        .login-link-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border: 1px solid var(--brand-border);
            border-radius: 999px;
            color: var(--brand-dark);
            font-weight: 600;
            white-space: nowrap;
            background: #ffffff;
        }

        .login-link-pill:hover {
            color: var(--brand-primary);
            text-decoration: none;
            border-color: rgba(21, 84, 255, 0.35);
        }

        .form-section {
            padding: 24px;
            border: 1px solid var(--brand-border);
            border-radius: 22px;
            margin-bottom: 22px;
            background: #ffffff;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
            font-size: 17px;
            font-weight: 800;
            color: var(--brand-dark);
        }

        .section-title span {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            color: var(--brand-primary);
            background: var(--brand-soft);
        }

        .form-control {
            min-height: 48px;
            border-radius: 13px;
            border-color: var(--brand-border);
            color: var(--brand-dark);
        }

        .form-control:focus {
            border-color: var(--brand-primary);
            box-shadow: 0 0 0 0.18rem rgba(21, 84, 255, 0.12);
        }

        label {
            font-weight: 700;
            color: var(--brand-dark);
        }

        .upload-card {
            height: 100%;
            padding: 18px;
            border: 1px dashed #b8c4d8;
            border-radius: 18px;
            background: #fbfcff;
            transition: 0.2s ease;
        }

        .upload-card:hover {
            border-color: var(--brand-primary);
            background: #f7faff;
        }

        .upload-preview {
            display: block;
            max-width: 100%;
            max-height: 120px;
            margin-bottom: 12px;
            border-radius: 12px;
            object-fit: cover;
        }

        .upload-trigger {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 12px;
            color: var(--brand-primary);
            background: var(--brand-soft);
            cursor: pointer;
            font-weight: 700;
            margin: 0;
        }

        .upload-trigger img {
            width: 22px !important;
            height: 22px;
            object-fit: contain;
        }

        .terms-box {
            padding: 16px 18px;
            border-radius: 16px;
            background: #f8fafc;
            border: 1px solid var(--brand-border);
        }

        .btn-register {
            min-height: 52px;
            border-radius: 15px;
            background: var(--brand-primary);
            border-color: var(--brand-primary);
            font-weight: 800;
            letter-spacing: 0.2px;
        }

        .closed-card {
            max-width: 680px;
            margin: 0 auto;
            padding: 70px 40px;
            text-align: center;
            border-radius: 28px;
            background: #ffffff;
            box-shadow: 0 28px 70px rgba(16, 24, 40, 0.12);
        }

        .closed-card img {
            max-width: 180px;
            margin-bottom: 28px;
        }

        .closed-card h1 {
            font-size: 46px;
            font-weight: 800;
            color: var(--brand-danger);
            margin-bottom: 12px;
        }

        .closed-card p {
            color: var(--brand-muted);
            margin-bottom: 0;
        }

        @media (max-width: 991px) {
            .registration-shell {
                flex-direction: column;
            }

            .registration-side,
            .registration-content {
                width: 100%;
            }

            .registration-side {
                min-height: auto;
            }
        }

        @media (max-width: 767px) {
            .registration-page {
                padding: 16px 0;
            }

            .registration-side,
            .registration-content {
                padding: 28px 22px;
            }

            .registration-side h1,
            .form-header h2 {
                font-size: 28px;
            }

            .form-header {
                flex-direction: column;
            }

            .closed-card {
                padding: 48px 24px;
            }

            .closed-card h1 {
                font-size: 34px;
            }
        }
    </style>
</head>

<body>
    <main class="registration-page">
        <div class="container">
            @if ($registrationClosed)
                <div class="closed-card">
                    <a href="{{ route('home.page') }}">
                        <img class="img-fluid" src="{{ asset('storage/logo/' . $theme->logo) }}"
                            alt="{{ $theme->title }}">
                    </a>
                    <h1>Registration window is closed!</h1>
                    <p>Please contact the organizing team for further information.</p>
                </div>
            @else
                <div class="registration-shell">
                    <aside class="registration-side">
                        <a class="brand-logo-card" href="{{ route('home.page') }}">
                            <img class="img-fluid" src="{{ asset('storage/logo/' . $theme->logo) }}"
                                alt="{{ $theme->title }}">
                        </a>

                        <h1>Complete your registration</h1>
                        <p>Submit your personal, academic, and identity details to create your participant profile.</p>

                        <ul class="side-points">
                            <li><i class="fa fa-check"></i> Required information marked clearly</li>
                            <li><i class="fa fa-upload"></i> Upload photo and document copies</li>
                            <li><i class="fa fa-lock"></i> Information used for verification only</li>
                        </ul>
                    </aside>

                    <section class="registration-content">
                        <div class="form-header">
                            <div>
                                <h2>Student Registration</h2>
                                <p>Please fill in the form carefully before submitting.</p>
                            </div>
                            <a class="login-link-pill" href="{{ route('admin.login.page') }}">
                                <i class="fa fa-sign-in"></i> Already registered?
                            </a>
                        </div>

                        @include('validate')

                        <form action="{{ route('student-register.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-section">
                                <div class="section-title"><span><i class="fa fa-user"></i></span> Personal Information
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="first_name">First Name <span class="text-danger">*</span></label>
                                        <input id="first_name"
                                            class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                            name="first_name" type="text" value="{{ old('first_name') }}"
                                            placeholder="Enter first name">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                        <input id="last_name"
                                            class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                            name="last_name" value="{{ old('last_name') }}" type="text"
                                            placeholder="Enter last name">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input id="email"
                                            class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            name="email" value="{{ old('email') }}" type="email"
                                            placeholder="Enter email address">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="cell">Phone <span class="text-danger">*</span></label>
                                        <input id="cell"
                                            class="form-control {{ $errors->has('cell') ? ' is-invalid' : '' }}"
                                            name="cell" value="{{ old('cell') }}" type="text"
                                            placeholder="Enter phone number">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="gender">Gender <span class="text-danger">*</span></label>
                                        <select id="gender"
                                            class="form-control {{ $errors->has('gender') ? ' is-invalid' : '' }}"
                                            name="gender">
                                            <option value="">Select gender</option>
                                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group mb-md-0">
                                        <label for="dob">Birth Date <span class="text-danger">*</span></label>
                                        <input id="dob"
                                            class="form-control {{ $errors->has('dob') ? ' is-invalid' : '' }}"
                                            name="dob" value="{{ old('dob') }}" type="date">
                                    </div>
                                    <div class="col-md-6 form-group mb-0">
                                        <label for="nid">NID / Passport / Birth Certificate Number <span
                                                class="text-danger">*</span></label>
                                        <input id="nid"
                                            class="form-control {{ $errors->has('nid') ? ' is-invalid' : '' }}"
                                            name="nid" value="{{ old('nid') }}" type="text"
                                            placeholder="Enter identity document number">
                                    </div>
                                </div>
                            </div>

                            <div class="form-section">
                                <div class="section-title"><span><i class="fa fa-map-marker"></i></span> Address
                                    Information</div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="address">Address <span class="text-danger">*</span></label>
                                        <input id="address"
                                            class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}"
                                            name="address" value="{{ old('address') }}" type="text"
                                            placeholder="Enter full address">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="city">City <span class="text-danger">*</span></label>
                                        <input id="city"
                                            class="form-control {{ $errors->has('city') ? ' is-invalid' : '' }}"
                                            name="city" value="{{ old('city') }}" type="text"
                                            placeholder="Enter city">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="state">State <span class="text-danger">*</span></label>
                                        <input id="state"
                                            class="form-control {{ $errors->has('state') ? ' is-invalid' : '' }}"
                                            name="state" value="{{ old('state') }}" type="text"
                                            placeholder="Enter state/division">
                                    </div>
                                    <div class="col-md-6 form-group mb-md-0">
                                        <label for="country">Country <span class="text-danger">*</span></label>
                                        <input id="country"
                                            class="form-control {{ $errors->has('country') ? ' is-invalid' : '' }}"
                                            name="country" value="{{ old('country') }}" type="text"
                                            placeholder="Enter country">
                                    </div>
                                    <div class="col-md-6 form-group mb-0">
                                        <label for="zip">Zip / Postal Code <span
                                                class="text-danger">*</span></label>
                                        <input id="zip"
                                            class="form-control {{ $errors->has('zip') ? ' is-invalid' : '' }}"
                                            name="zip" value="{{ old('zip') }}" type="text"
                                            placeholder="Enter zip/postal code">
                                    </div>
                                </div>
                            </div>

                            <div class="form-section">
                                <div class="section-title"><span><i class="fa fa-graduation-cap"></i></span> Academic
                                    Information</div>
                                <div class="row">
                                    <div class="col-md-7 form-group mb-md-0">
                                        <label for="uniname">University / Institute Name <span
                                                class="text-danger">*</span></label>
                                        <input id="uniname"
                                            class="form-control {{ $errors->has('uniname') ? ' is-invalid' : '' }}"
                                            name="uniname" value="{{ old('uniname') }}" type="text"
                                            placeholder="Enter university/institute name">
                                    </div>
                                    <div class="col-md-5 form-group mb-0">
                                        <label for="stuid">Student ID Number <span
                                                class="text-danger">*</span></label>
                                        <input id="stuid"
                                            class="form-control {{ $errors->has('stuid') ? ' is-invalid' : '' }}"
                                            name="stuid" type="text" value="{{ old('stuid') }}"
                                            placeholder="Enter student ID number">
                                    </div>
                                </div>
                            </div>

                            <div class="form-section">
                                <div class="section-title"><span><i class="fa fa-file-image-o"></i></span> Document
                                    Uploads</div>
                                <div class="row">
                                    <div class="col-md-4 form-group mb-md-0">
                                        <div class="upload-card">
                                            <label for="profile-photo">Your Photo <span
                                                    class="text-danger">*</span></label>
                                            <img class="upload-preview" id="profile-photo-preview" src=""
                                                alt="">
                                            <input class="d-none" id="profile-photo" name="photo" type="file">
                                            <label class="upload-trigger" for="profile-photo">
                                                <img src="{{ asset('admin/assets/img/upload.gif') }}" alt="">
                                                Upload Photo
                                            </label>
                                            @if ($errors->has('photo'))
                                                <span
                                                    class="d-block text-danger mt-2">{{ $errors->first('photo') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4 form-group mb-md-0">
                                        <div class="upload-card">
                                            <label for="nidf-photo">NID / Passport / Birth Certificate <span
                                                    class="text-danger">*</span></label>
                                            <img class="upload-preview" id="nidf-photo-preview" src=""
                                                alt="">
                                            <input class="d-none" id="nidf-photo" name="nidphotofront"
                                                type="file">
                                            <label class="upload-trigger" for="nidf-photo">
                                                <img src="{{ asset('admin/assets/img/upload.gif') }}" alt="">
                                                Upload Document
                                            </label>
                                            @if ($errors->has('nidphotofront'))
                                                <span
                                                    class="d-block text-danger mt-2">{{ $errors->first('nidphotofront') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4 form-group mb-0">
                                        <div class="upload-card">
                                            <label for="sidf-photo">Student ID <span
                                                    class="text-muted">(Optional)</span></label>
                                            <img class="upload-preview" id="sidf-photo-preview" src=""
                                                alt="">
                                            <input class="d-none" id="sidf-photo" name="stuphotofront"
                                                type="file">
                                            <label class="upload-trigger" for="sidf-photo">
                                                <img src="{{ asset('admin/assets/img/upload.gif') }}" alt="">
                                                Upload ID
                                            </label>
                                            @if ($errors->has('stuphotofront'))
                                                <span
                                                    class="d-block text-danger mt-2">{{ $errors->first('stuphotofront') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="terms-box mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="defaultCheck1" required>
                                    <label class="form-check-label" for="defaultCheck1">
                                        I agree to the <a href="{{ route('tc.page') }}" target="_blank">terms and
                                            conditions</a>
                                    </label>
                                </div>
                            </div>

                            <button class="btn btn-primary btn-block btn-register" type="submit">Submit
                                Registration</button>
                        </form>
                    </section>
                </div>
            @endif
        </div>
    </main>

    <script src="{{ asset('admin/assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/script.js') }}"></script>
    <script src="{{ asset('custom/admin.js') }}"></script>
</body>

</html>
