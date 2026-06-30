@php
    use App\Models\Theme;
    $theme = Theme::findOrFail(1);
@endphp

@extends('admin.layouts.app')

@section('main')
    <style>
        .admin-users-page {
            --primary: #0d6efd;
            --primary-soft: #eef5ff;
            --success-soft: #ecfdf3;
            --danger-soft: #fff1f2;
            --warning-soft: #fff8e6;
            --border: #e7edf5;
            --muted: #6b7280;
            --text: #1f2937;
            --card-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
        }

        .admin-users-page .page-hero {
            background: linear-gradient(135deg, #ffffff 0%, #f7faff 100%);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: var(--card-shadow);
        }

        .admin-users-page .page-hero h3 {
            font-weight: 700;
            color: var(--text);
            margin-bottom: 6px;
        }

        .admin-users-page .page-hero p {
            color: var(--muted);
            margin-bottom: 0;
        }

        .admin-users-page .hero-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .admin-users-page .stat-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 18px;
            box-shadow: var(--card-shadow);
            height: 100%;
        }

        .admin-users-page .stat-card .stat-label {
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .admin-users-page .stat-card .stat-value {
            color: var(--text);
            font-size: 26px;
            font-weight: 800;
            margin-bottom: 0;
        }

        .admin-users-page .content-card {
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            margin-bottom: 24px;
        }

        .admin-users-page .content-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid var(--border);
            padding: 18px 22px;
        }

        .admin-users-page .content-card .card-title {
            font-weight: 700;
            color: var(--text);
            margin-bottom: 2px;
        }

        .admin-users-page .section-subtitle {
            color: var(--muted);
            font-size: 14px;
            margin-bottom: 0;
        }

        .admin-users-page .table thead th {
            border-top: none;
            border-bottom: 1px solid var(--border);
            color: #4b5563;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .02em;
            white-space: nowrap;
        }

        .admin-users-page .table tbody td {
            vertical-align: middle;
            color: #374151;
            border-color: #edf2f7;
        }

        .admin-users-page .user-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-users-page .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ffffff;
            box-shadow: 0 6px 16px rgba(15, 23, 42, 0.12);
        }

        .admin-users-page .user-name {
            font-weight: 700;
            color: var(--text);
            margin-bottom: 2px;
        }

        .admin-users-page .user-meta {
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 0;
        }

        .admin-users-page .role-pill,
        .admin-users-page .status-pill {
            border-radius: 999px;
            padding: 7px 11px;
            font-size: 12px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .admin-users-page .role-pill {
            background: var(--primary-soft);
            color: #0b5ed7;
        }

        .admin-users-page .status-active {
            background: var(--success-soft);
            color: #027a48;
        }

        .admin-users-page .status-blocked {
            background: var(--danger-soft);
            color: #b42318;
        }

        .admin-users-page .status-online {
            background: var(--success-soft);
            color: #027a48;
        }

        .admin-users-page .action-group {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: nowrap;
        }

        .admin-users-page .btn-icon {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .admin-users-page .form-card {
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            position: sticky;
            top: 90px;
        }

        .admin-users-page .form-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid var(--border);
            padding: 18px 22px;
        }

        .admin-users-page .form-card .card-body {
            padding: 22px;
        }

        .admin-users-page label {
            font-weight: 700;
            color: #374151;
            margin-bottom: 7px;
        }

        .admin-users-page .form-control {
            min-height: 44px;
            border-radius: 10px;
            border-color: #d9e1ec;
        }

        .admin-users-page .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.12);
        }

        .admin-users-page .helper-text {
            color: var(--muted);
            font-size: 12px;
            margin-top: 6px;
        }

        .admin-users-page .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 18px;
        }

        .admin-users-page .empty-state {
            padding: 36px 18px;
            text-align: center;
            color: var(--muted);
        }

        @media (max-width: 991px) {
            .admin-users-page .form-card {
                position: static;
            }

            .admin-users-page .hero-actions {
                justify-content: flex-start;
                margin-top: 16px;
            }
        }

        @media (max-width: 767px) {
            .admin-users-page .page-hero {
                padding: 18px;
            }

            .admin-users-page .content-card .card-header,
            .admin-users-page .form-card .card-header,
            .admin-users-page .form-card .card-body {
                padding: 18px;
            }

            .admin-users-page .form-actions {
                flex-direction: column;
            }

            .admin-users-page .form-actions .btn {
                width: 100%;
            }
        }
    </style>

    @php
        $visibleAdmins = $all_admin->filter(function ($user) {
            return $user->name !== 'Provider';
        });

        $totalAdmins = $visibleAdmins->count();
        $activeAdmins = $visibleAdmins->where('status', true)->count();
        $blockedAdmins = $visibleAdmins->where('status', false)->count();
        $onlineAdmins = $visibleAdmins
            ->filter(function ($user) {
                return $user->last_login_at && now()->diffInMinutes($user->last_login_at) < 2;
            })
            ->count();
    @endphp

    <div class="admin-users-page">
        <div class="page-hero">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h3>Admin User Management</h3>
                    <p>Manage administrator accounts, roles, status, activity, and access control.</p>
                </div>
                <div class="col-lg-4">
                    <div class="hero-actions">
                        <a class="btn btn-outline-danger" href="{{ route('admin.trash') }}">
                            <i class="fa fa-trash mr-1" aria-hidden="true"></i> Trash Users
                        </a>
                        @if ($form_type == 'edit')
                            <a class="btn btn-outline-primary" href="{{ route('admin-user.index') }}">
                                <i class="fa fa-plus mr-1" aria-hidden="true"></i> Add New
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @include('validate-main')

        <div class="row mb-4">
            <div class="col-lg-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <p class="stat-label">Total Admins</p>
                    <h4 class="stat-value">{{ $totalAdmins }}</h4>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <p class="stat-label">Active Users</p>
                    <h4 class="stat-value">{{ $activeAdmins }}</h4>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <p class="stat-label">Blocked Users</p>
                    <h4 class="stat-value">{{ $blockedAdmins }}</h4>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <p class="stat-label">Online Now</p>
                    <h4 class="stat-value">{{ $onlineAdmins }}</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card content-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                <h4 class="card-title">Admin Users</h4>
                                <p class="section-subtitle">
                                    @if ($form_type == 'create')
                                        Recently created users and their current status.
                                    @else
                                        User list with latest update information.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>Role</th>
                                        @if ($form_type == 'create')
                                            <th>Created At</th>
                                        @endif
                                        @if ($form_type == 'edit')
                                            <th>Updated At</th>
                                        @endif
                                        <th>Status</th>
                                        <th>Last Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($all_admin as $user)
                                        @if ($user->name !== 'Provider')
                                            @php
                                                $diffMin = $user->last_login_at
                                                    ? now()->diffInMinutes($user->last_login_at)
                                                    : null;
                                                $diffHours = $user->last_login_at
                                                    ? now()->diffInHours($user->last_login_at)
                                                    : null;
                                                $diffDays = $user->last_login_at
                                                    ? now()->diffInDays($user->last_login_at)
                                                    : null;
                                                $diffyears = $user->last_login_at
                                                    ? now()->diffInYears($user->last_login_at)
                                                    : null;
                                            @endphp

                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>

                                                <td>
                                                    <div class="user-cell">
                                                        @if ($user->photo == 'avatar.png')
                                                            <img class="user-avatar"
                                                                src="{{ asset('storage/admins/' . $user->avatarFile()) }}"
                                                                alt="Profile Picture">
                                                        @else
                                                            <img class="user-avatar"
                                                                src="{{ asset('storage/admins/' . $user->photo) }}"
                                                                alt="Profile Picture">
                                                        @endif

                                                        <div>
                                                            <p class="user-name">{{ $user->first_name }}</p>
                                                            <p class="user-meta">
                                                                @if (!empty($user->email))
                                                                    {{ $user->email }}
                                                                @else
                                                                    Admin user
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <span class="role-pill">
                                                        <i class="fa fa-user-shield" aria-hidden="true"></i>
                                                        @if (isset($user->role->name))
                                                            {{ $user->role->name }}
                                                        @else
                                                            No Role Found
                                                        @endif
                                                    </span>
                                                </td>

                                                @if ($form_type == 'create')
                                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                                @endif

                                                @if ($form_type == 'edit')
                                                    <td>{{ $user->updated_at->diffForHumans() }}</td>
                                                @endif

                                                <td>
                                                    @if ($user->status)
                                                        <span class="status-pill status-active">
                                                            <i class="fa fa-check-circle" aria-hidden="true"></i> Active
                                                            User
                                                        </span>

                                                        @if (Auth::guard('admin')->user()->role->name == 'Super Admin')
                                                            <a class="text-danger ml-2"
                                                                href="{{ route('admin.status.update', $user->id) }}"
                                                                title="Block User">
                                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                            </a>
                                                        @endif
                                                    @else
                                                        <span class="status-pill status-blocked">
                                                            <i class="fa fa-ban" aria-hidden="true"></i> Blocked User
                                                        </span>

                                                        @if (Auth::guard('admin')->user()->role->name == 'Admin')
                                                            <a class="text-success ml-2"
                                                                href="{{ route('admin.status.update', $user->id) }}"
                                                                title="Activate User">
                                                                <i class="fa fa-check" aria-hidden="true"></i>
                                                            </a>
                                                        @endif
                                                    @endif
                                                </td>

                                                <td>
                                                    @if (!$user->last_login_at)
                                                        <span class="text-muted">No activity</span>
                                                    @elseif ($diffMin < 2)
                                                        <span class="status-pill status-online">
                                                            <i class="fa fa-circle" aria-hidden="true"></i> Active Now
                                                        </span>
                                                    @else
                                                        @if ($diffMin <= 60)
                                                            {{ $diffMin }} minutes ago
                                                        @elseif ($diffHours >= 1 && $diffHours <= 24)
                                                            @if ($diffHours < 2)
                                                                {{ $diffHours }} hour ago
                                                            @else
                                                                {{ $diffHours }} hours ago
                                                            @endif
                                                        @else
                                                            @if ($diffDays < 2)
                                                                {{ $diffDays }} day ago
                                                            @else
                                                                @if ($diffDays <= 364)
                                                                    {{ $diffDays }} days ago
                                                                @else
                                                                    @if ($diffyears < 2)
                                                                        {{ $diffyears }} year ago
                                                                    @else
                                                                        {{ $diffyears }} years ago
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                </td>

                                                <td>
                                                    <div class="action-group">
                                                        <a class="btn btn-sm btn-warning btn-icon"
                                                            href="{{ route('admin-user.edit', $user->id) }}"
                                                            title="Edit">
                                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                                        </a>

                                                        @if ($form_type == 'create')
                                                            <a class="btn btn-sm btn-danger btn-icon"
                                                                href="{{ route('admin.trash.update', $user->id) }}"
                                                                title="Move to Trash">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @empty
                                        <tr>
                                            <td class="empty-state" colspan="8">No Data Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-12">
                @if ($form_type == 'create')
                    <div class="card form-card">
                        <div class="card-header">
                            <h4 class="card-title">Add New User</h4>
                            <p class="section-subtitle">Create a new admin user and assign a role.</p>
                        </div>

                        @include('validate')

                        <div class="card-body">
                            <form action="{{ route('admin-user.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="first_name">Name</label>
                                    <input id="first_name" name="first_name" type="text"
                                        value="{{ old('first_name') }}" class="form-control"
                                        placeholder="Enter full name" autofocus>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" name="email" type="email" value="{{ old('email') }}"
                                        class="form-control" placeholder="Enter email address">
                                </div>

                                <div class="form-group">
                                    <label for="username">User Name</label>
                                    <input id="username" name="username" type="text" value="{{ old('username') }}"
                                        class="form-control" placeholder="Enter username">
                                </div>

                                <div class="form-group">
                                    <label for="cell">Mobile</label>
                                    <input id="cell" name="cell" type="text" value="{{ old('mobile') }}"
                                        class="form-control" placeholder="Enter mobile number">
                                </div>

                                <div class="form-group">
                                    <label for="role_id">Role</label>
                                    <select id="role_id" class="form-control" name="role_id">
                                        <option value="">Select Role</option>
                                        @foreach ($roles as $role)
                                            @if ($role->id == 1)
                                            @else
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <p class="helper-text">Choose the access level for this user.</p>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-plus mr-1" aria-hidden="true"></i> Add User
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif

                @if ($form_type == 'edit')
                    <div class="card form-card">
                        <div class="card-header">
                            <h4 class="card-title">Edit User</h4>
                            <p class="section-subtitle">Update user details and role assignment.</p>
                        </div>

                        @include('validate')

                        <div class="card-body">
                            <form action="{{ route('admin-user.update', $edit->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="edit_first_name">Name</label>
                                    <input id="edit_first_name" name="first_name" value="{{ $edit->first_name }}"
                                        type="text" class="form-control" placeholder="Enter full name" autofocus>
                                </div>

                                <div class="form-group">
                                    <label for="edit_email">Email</label>
                                    <input id="edit_email" name="email" value="{{ $edit->email }}" type="text"
                                        class="form-control" readonly>
                                    <p class="helper-text text-danger">You do not have permission to change this email.</p>
                                </div>

                                <div class="form-group">
                                    <label for="edit_username">User Name</label>
                                    <input id="edit_username" name="username" value="{{ $edit->username }}"
                                        type="text" class="form-control" readonly>
                                    <p class="helper-text text-danger">You do not have permission to change this username.
                                    </p>
                                </div>

                                <div class="form-group">
                                    <label for="edit_cell">Cell</label>
                                    <input id="edit_cell" name="cell" value="{{ $edit->cell }}" type="text"
                                        class="form-control" placeholder="Enter mobile number">
                                </div>

                                <div class="form-group">
                                    <label for="edit_role_id">Role</label>
                                    <select id="edit_role_id" class="form-control" name="role_id">
                                        <option value="">Select Role</option>
                                        @foreach ($roles as $role)
                                            <option @if ($role->id == $edit->role_id) selected @endif
                                                value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-actions">
                                    <a class="btn btn-outline-info" href="{{ route('admin-user.index') }}">
                                        <i class="fa fa-arrow-left mr-1" aria-hidden="true"></i> Back
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save mr-1" aria-hidden="true"></i> Update User
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
