@php
    use App\Models\ExamControl;

    $exam = ExamControl::findOrFail(1);
    $user = Auth::guard('admin')->user();
    $permissions = json_decode($user->role->permission ?? '[]', true) ?? [];
    $currentPath = Request::path();

    $hasPermission = fn($permission) => in_array($permission, $permissions, true);
    $isActive = fn($path) => $currentPath === $path ? 'active' : '';

    $canManageAdmin = $hasPermission('admin-user') || $hasPermission('role') || $hasPermission('permission');
    $canViewStudents = $hasPermission('verified-student') || $hasPermission('unverified-student');
    $canManageQuestions =
        $hasPermission('add-question') ||
        $hasPermission('add-question-round-2') ||
        $hasPermission('edit-question') ||
        $hasPermission('update-question');
@endphp

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>

                <li class="{{ $isActive('dashboard') }}">
                    <a href="{{ route('admin.dashboard.page') }}">
                        <i class="fa fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @if ($user->role_id != 3)
                    <li class="menu-title">
                        <span>Admin Option</span>
                    </li>
                @endif

                @if ($canManageAdmin)
                    <li class="submenu">
                        <a href="#">
                            <i class="fa fa-user"></i>
                            <span>Admin User</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul style="display: none;">
                            @if ($hasPermission('admin-user'))
                                <li class="{{ $isActive('admin-user') }}">
                                    <a href="{{ route('admin-user.index') }}">Users</a>
                                </li>
                            @endif

                            @if ($hasPermission('role'))
                                <li class="{{ $isActive('role') }}">
                                    <a href="{{ route('role.index') }}">Role</a>
                                </li>
                            @endif

                            @if ($hasPermission('permission'))
                                <li class="{{ $isActive('permission') }}">
                                    <a href="{{ route('permission.index') }}">Permission</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if ($canViewStudents)
                    <li class="submenu">
                        <a href="#">
                            <i class="fa fa-users"></i>
                            <span>
                                Students
                                <span class="badge badge-light text-dark ml-2">{{ $totalStudent }}</span>
                            </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul style="display: none;">
                            @if ($hasPermission('verified-student'))
                                <li class="{{ $isActive('verified-student') }}">
                                    <a href="{{ route('student.verified') }}">
                                        Total Students
                                        <span
                                            class="badge badge-light text-dark float-right">{{ $verified }}</span>
                                    </a>
                                </li>
                            @endif

                            @if ($hasPermission('round-one-result'))
                                <li class="{{ $isActive('round-one-result') }}">
                                    <a href="{{ route('student.round.one.result') }}">
                                        Top 1000
                                        <span
                                            class="badge badge-light text-dark float-right">{{ $examdone }}</span>
                                    </a>
                                </li>
                            @endif

                            @if ($hasPermission('round-two-result'))
                                <li class="{{ $isActive('round-two-result') }}">
                                    <a href="{{ route('student.round.two.result') }}">
                                        Top 100
                                        <span
                                            class="badge badge-light text-dark float-right">{{ $examdonetwo }}</span>
                                    </a>
                                </li>
                            @endif

                            @if ($hasPermission('round-three-result'))
                                <li class="{{ $isActive('round-three-result') }}">
                                    <a href="{{ route('student.round.three.result') }}">
                                        Top 15
                                        <span
                                            class="badge badge-light text-dark float-right">{{ $examdonethree }}</span>
                                    </a>
                                </li>
                            @endif

                            @if ($hasPermission('winner'))
                                <li class="{{ $isActive('winner') }}">
                                    <a href="{{ route('student.winner') }}">
                                        Winner
                                        <span
                                            class="badge badge-light text-dark float-right">{{ $winner }}</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if ($canManageQuestions)
                    <li class="submenu">
                        <a href="#">
                            <i class="fa fa-question-circle"></i>
                            <span>Question</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul style="display: none;">
                            @if ($hasPermission('add-question'))
                                <li class="{{ $isActive('add-question') }}">
                                    <a href="{{ route('question.view') }}">
                                        Round One
                                        <span class="badge badge-light text-dark ml-2">{{ $question }}</span>
                                    </a>
                                </li>
                            @endif

                            @if ($hasPermission('add-question-round-2'))
                                <li class="{{ $isActive('add-question-round-2') }}">
                                    <a href="{{ route('question.view.round2') }}">
                                        Round Two
                                        <span class="badge badge-light text-dark ml-2">{{ $questionTwo }}</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if ($hasPermission('exam-controll'))
                    <li class="{{ $isActive('exam-controll') }}">
                        <a href="{{ route('exam-controll.index') }}">
                            <i class="fa fa-exchange"></i>
                            <span>Exam Control</span>
                        </a>
                    </li>
                @endif

                @if ($hasPermission('theme-option'))
                    <li class="{{ $isActive('theme-option') }}">
                        <a href="{{ route('theme-option.index') }}">
                            <i class="fa fa-tasks"></i>
                            <span>Theme Option</span>
                        </a>
                    </li>
                @endif

                @if ($hasPermission('setting'))
                    <li>
                        <a href="#">
                            <i class="fa fa-cog"></i>
                            <span>Setting</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
