<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a href="#" class="navbar-brand">
                <img src="{{ url('storage/logo/'.$theme->logo)}}" height="28" alt="{{$theme->title}}">
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
                <div class="navbar-nav">
                    <a href="#" class="nav-item nav-link active">Home</a>
                    <a href="#" class="nav-item nav-link">Profile</a>
                    <a href="#" class="nav-item nav-link">Messages</a>
                </div>
                <div class="navbar-nav ms-5">
                    <a class="btn btn-info btn-sm mx-1" href="{{ route('admin.login.page') }}" class="nav-item nav-link">Login</a>
                    <a class="btn btn-info btn-sm mx-1" href="{{ route('student-register.index') }}" class="nav-item nav-link">Register</a>
                </div>
            </div>
        </div>
    </nav>
</div>
