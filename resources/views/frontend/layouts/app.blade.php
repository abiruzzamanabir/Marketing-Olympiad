@php
    use App\Models\Theme;
    $theme = Theme::findOrFail(1);
@endphp
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $theme->title }} - {{ $theme->tagline }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

    <style>
        .validation-message {
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 14px;
            line-height: 1.5;
            border: 1px solid transparent;
            background: #f8fafc;
            color: #334155;
        }
        .validation-success { background: #ecfdf5; color: #065f46; border-color: #a7f3d0; }
        .validation-error { background: #fef2f2; color: #991b1b; border-color: #fecaca; }
        .validation-warning { background: #fffbeb; color: #92400e; border-color: #fde68a; }
        .validation-info { background: #eff6ff; color: #1e40af; border-color: #bfdbfe; }
        .validation-neutral { background: #f8fafc; color: #475569; border-color: #e2e8f0; }
    </style>

</head>

<body>
    @include('frontend.layouts.header')
    @include('validatefront')
    @section('front')

    @show
    @include('frontend.layouts.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
    </script>
</body>

</html>
