@php
    use Carbon\Carbon;
    use App\Models\ExamControl;

    $user = Auth::guard('admin')->user();
    $role = $user->role;
    $permissions = json_decode($role->permission ?? '[]', true) ?: [];

    $exam = ExamControl::findOrFail(1);
    $now = Carbon::now();

    $roundOneOpen = $now->between(Carbon::parse($exam->start_date_time), Carbon::parse($exam->end_date_time));

    $roundTwoOpen = $now->between(Carbon::parse($exam->next_round_date), Carbon::parse($exam->next_round_end_date));

    $roundThreeOpen = $now->between(Carbon::parse($exam->third_round_date), Carbon::parse($exam->third_round_end_date));

    $isParticipant = $user->role_id == 3;
    $dashboardRoute = $isParticipant ? route('home.page') : route('admin.dashboard.page');

    $avatarPath =
        $user->photo === 'avatar.png' ? asset('storage/admins/avatar.png') : asset('storage/admins/' . $user->photo);

    $avatarStyle = $user->photo === 'avatar.png' ? '' : 'width: 40px; height: 40px; object-fit: cover';
@endphp

<!-- Header -->
<div class="header">

    <!-- Logo -->
    <div class="header-left">
        <a href="{{ $dashboardRoute }}" class="logo">
            <img src="{{ asset('storage/logo/logo_landing.png') }}" alt="{{ $theme->title }}">
        </a>
        <a href="{{ $dashboardRoute }}" class="logo logo-small">
            <img src="{{ asset('storage/logo/logo_landing.png') }}" alt="{{ $theme->title }}" width="60"
                height="60">
        </a>
    </div>
    <!-- /Logo -->

    @unless ($isParticipant)
        <a href="javascript:void(0);" id="toggle_btn">
            <i class="fe fe-text-align-left"></i>
        </a>
    @endunless

    <!-- Mobile Menu Toggle -->
    <a class="mobile_btn" id="mobile_btn">
        <i class="fa fa-bars"></i>
    </a>
    <!-- /Mobile Menu Toggle -->

    <!-- Header Right Menu -->
    <ul class="nav user-menu">

        <!-- User Menu -->
        <li class="nav-item dropdown has-arrow">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <span class="user-img">
                    <img class="rounded-circle" src="{{ $avatarPath }}" width="31" alt="{{ $user->first_name }}"
                        @if ($avatarStyle) style="{{ $avatarStyle }}" @endif>
                </span>
            </a>

            <div class="dropdown-menu">
                <div class="user-header">
                    @if ($user->photo === 'avatar.png')
                        <div class="avatar avatar-sm">
                            <img src="{{ $avatarPath }}" alt="User Image" class="avatar-img rounded-circle">
                        </div>
                    @else
                        <img src="{{ $avatarPath }}" alt="User Image" class="avatar-img rounded-circle"
                            style="{{ $avatarStyle }}">
                    @endif

                    <div class="user-text">
                        <h6>{{ $user->first_name }} {{ $user->last_name }}</h6>
                        <p class="text-muted mb-0">{{ $role->name }}</p>
                    </div>
                </div>

                @if ($isParticipant)
                    <a class="dropdown-item" href="{{ route('admin.dashboard.page') }}">Dashboard</a>
                @endif

                <a class="dropdown-item" href="{{ route('admin.profile.page') }}">My Profile</a>

                @if ($roundOneOpen && !$user->round_one_status && in_array('round-1', $permissions))
                    <a class="dropdown-item" data-toggle="modal" data-target="#rulesModal" style="cursor:pointer;">
                        Round One
                    </a>
                @endif

                @if ($roundTwoOpen && $user->selected && in_array('round-2', $permissions))
                    <a class="dropdown-item"
                        @if (!$user->round_two_status) data-toggle="modal" data-target="#rulesModal" style="cursor:pointer;"
                        @else
                            href="{{ route('round.two') }}" @endif>
                        Round Two
                    </a>
                @endif

                @if ($roundThreeOpen && $user->selectedTwo && empty($user->file_name) && in_array('round-3', $permissions))
                    <a class="dropdown-item" href="{{ route('round.two') }}">Round Three</a>
                @endif

                @if (in_array('setting', $permissions))
                    <a class="dropdown-item" href="settings.html">Settings</a>
                @endif

                @if ($user->round_one_status)
                    <a class="dropdown-item" href="{{ route('get.certificate') }}">Download Certificate</a>
                @endif

                <a class="dropdown-item" href="{{ route('admin.logout.page') }}">Logout</a>
            </div>
        </li>
        <!-- /User Menu -->

    </ul>
    <!-- /Header Right Menu -->

</div>
<!-- /Header -->
