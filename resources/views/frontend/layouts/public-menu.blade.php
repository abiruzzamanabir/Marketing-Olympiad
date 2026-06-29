<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm public-menu">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home.page') }}">
            <img src="{{ asset('storage/logo/' . ($theme->logo ?? 'logo_text.png')) }}" alt="{{ $theme->title ?? 'Marketing Olympiad' }}" style="max-height: 44px; width: auto;">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#publicMenu" aria-controls="publicMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="publicMenu">
            <ul class="navbar-nav ml-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home.page') ? 'active font-weight-bold' : '' }}" href="{{ route('home.page') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('student.result.2024') ? 'active font-weight-bold' : '' }}" href="{{ route('student.result.2024') }}">Result</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('student.result.2023') ? 'active font-weight-bold' : '' }}" href="{{ route('student.result.2023') }}">Result 2023</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tc.page') ? 'active font-weight-bold' : '' }}" href="{{ route('tc.page') }}">Terms & Conditions</a>
                </li>
                <li class="nav-item ml-lg-3 my-1 my-lg-0">
                    <a class="btn btn-outline-primary btn-sm" href="{{ route('admin.login.page') }}">Login</a>
                </li>
                <li class="nav-item ml-lg-2 my-1 my-lg-0">
                    <a class="btn btn-primary btn-sm" href="{{ route('student-register.index') }}">Register</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
