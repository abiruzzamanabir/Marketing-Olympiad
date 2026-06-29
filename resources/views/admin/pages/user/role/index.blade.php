@extends('admin.layouts.app')

@section('main')
    <style>
        .roles-page {
            --primary: #0d6efd;
            --primary-soft: #eef5ff;
            --success-soft: #ecfdf3;
            --danger-soft: #fff1f2;
            --warning-soft: #fff8e6;
            --border: #e7edf5;
            --muted: #6b7280;
            --text: #1f2937;
            --shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
        }

        .roles-page .page-hero {
            background: linear-gradient(135deg, #ffffff 0%, #f7faff 100%);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: var(--shadow);
        }

        .roles-page .page-hero h3 {
            color: var(--text);
            font-weight: 700;
            margin-bottom: 6px;
        }

        .roles-page .page-hero p {
            color: var(--muted);
            margin-bottom: 0;
        }

        .roles-page .stat-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 18px;
            box-shadow: var(--shadow);
            height: 100%;
        }

        .roles-page .stat-label {
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .roles-page .stat-value {
            color: var(--text);
            font-size: 26px;
            font-weight: 800;
            margin-bottom: 0;
        }

        .roles-page .content-card,
        .roles-page .form-card {
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 24px;
        }

        .roles-page .form-card {
            position: sticky;
            top: 90px;
        }

        .roles-page .content-card .card-header,
        .roles-page .form-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid var(--border);
            padding: 18px 22px;
        }

        .roles-page .content-card .card-title,
        .roles-page .form-card .card-title {
            color: var(--text);
            font-weight: 700;
            margin-bottom: 2px;
        }

        .roles-page .section-subtitle {
            color: var(--muted);
            font-size: 14px;
            margin-bottom: 0;
        }

        .roles-page .table thead th {
            border-top: none;
            border-bottom: 1px solid var(--border);
            color: #4b5563;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .03em;
            white-space: nowrap;
        }

        .roles-page .table tbody td {
            vertical-align: middle;
            border-color: #edf2f7;
            color: #374151;
        }

        .roles-page .role-name {
            font-weight: 700;
            color: var(--text);
            margin-bottom: 2px;
        }

        .roles-page .role-slug {
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 0;
        }

        .roles-page .permission-wrap,
        .roles-page .user-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            max-width: 310px;
        }

        .roles-page .permission-pill,
        .roles-page .user-pill {
            border-radius: 999px;
            padding: 6px 10px;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .roles-page .permission-pill {
            background: var(--primary-soft);
            color: #0b5ed7;
        }

        .roles-page .user-pill {
            background: var(--success-soft);
            color: #027a48;
        }

        .roles-page .empty-pill {
            background: var(--danger-soft);
            color: #b42318;
            border-radius: 999px;
            padding: 6px 10px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .roles-page .btn-icon {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .roles-page label {
            color: #374151;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .roles-page .form-control {
            border-radius: 10px;
            border-color: #d9e1ec;
            min-height: 44px;
        }

        .roles-page .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.12);
        }

        .roles-page .permission-list {
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 14px;
            max-height: 420px;
            overflow-y: auto;
            background: #fbfdff;
        }

        .roles-page .permission-option {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 9px 8px;
            border-radius: 10px;
            margin-bottom: 4px;
            transition: all .2s ease;
        }

        .roles-page .permission-option:hover {
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04);
        }

        .roles-page .permission-option input {
            margin: 0;
        }

        .roles-page .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 18px;
        }

        .roles-page .empty-state {
            padding: 36px 18px;
            text-align: center;
            color: var(--muted);
        }

        @media (max-width: 991px) {
            .roles-page .form-card {
                position: static;
            }
        }

        @media (max-width: 767px) {

            .roles-page .page-hero,
            .roles-page .content-card .card-header,
            .roles-page .form-card .card-header,
            .roles-page .form-card .card-body {
                padding: 18px;
            }

            .roles-page .form-actions {
                flex-direction: column;
            }

            .roles-page .form-actions .btn {
                width: 100%;
            }
        }
    </style>

    @php
        $totalRoles = $roles->count();
        $totalPermissions = 0;
        $totalAssignedUsers = 0;

        foreach ($roles as $statRole) {
            $decodedPermissions = json_decode($statRole->permission);
            $decodedUsers = json_decode($statRole->users);

            $totalPermissions += is_array($decodedPermissions) ? count($decodedPermissions) : 0;
            $totalAssignedUsers += is_array($decodedUsers) ? count($decodedUsers) : 0;
        }
    @endphp

    <div class="roles-page">
        <div class="page-hero">
            <h3>Role Management</h3>
            <p>Manage user roles, access permissions, and assigned users from one control panel.</p>
        </div>

        @include('validate-main')

        <div class="row mb-4">
            <div class="col-lg-4 col-sm-6 mb-3">
                <div class="stat-card">
                    <p class="stat-label">Total Roles</p>
                    <h4 class="stat-value">{{ $totalRoles }}</h4>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6 mb-3">
                <div class="stat-card">
                    <p class="stat-label">Assigned Permissions</p>
                    <h4 class="stat-value">{{ $totalPermissions }}</h4>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6 mb-3">
                <div class="stat-card">
                    <p class="stat-label">Assigned Users</p>
                    <h4 class="stat-value">{{ $totalAssignedUsers }}</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card content-card">
                    <div class="card-header">
                        <h4 class="card-title">Roles</h4>
                        <p class="section-subtitle">View all available roles with permissions and assigned users.</p>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Role</th>
                                        <th>Permissions</th>
                                        @if ($form_type == 'create')
                                            <th>Created At</th>
                                        @endif
                                        @if ($form_type == 'edit')
                                            <th>Updated At</th>
                                        @endif
                                        <th>Users</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($roles as $role)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>

                                            <td>
                                                <p class="role-name">{{ $role->name }}</p>
                                                <p class="role-slug">{{ $role->slug }}</p>
                                            </td>

                                            <td>
                                                <div class="permission-wrap">
                                                    @forelse (json_decode($role->permission) as $item)
                                                        <span class="permission-pill">
                                                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                            {{ $item }}
                                                        </span>
                                                    @empty
                                                        <span class="empty-pill">No data found</span>
                                                    @endforelse
                                                </div>
                                            </td>

                                            @if ($form_type == 'create')
                                                <td>{{ $role->created_at->diffForHumans() }}</td>
                                            @endif

                                            @if ($form_type == 'edit')
                                                <td>{{ $role->updated_at->diffForHumans() }}</td>
                                            @endif

                                            <td>
                                                <div class="user-wrap">
                                                    @forelse (json_decode($role->users) as $role_user)
                                                        <span class="user-pill">
                                                            <i class="fa fa-check" aria-hidden="true"></i>
                                                            {{ $role_user->first_name }}
                                                        </span>
                                                    @empty
                                                        <span class="empty-pill">No User Found</span>
                                                    @endforelse
                                                </div>
                                            </td>

                                            <td>
                                                <a class="btn btn-sm btn-warning btn-icon"
                                                    href="{{ route('role.edit', $role->id) }}" title="Edit Role">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </a>

                                                @if ($form_type == 'create')
                                                    <form class="d-inline delete-form"
                                                        action="{{ route('role.destroy', $role->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger btn-icon" title="Delete Role">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="empty-state" colspan="7">No Data Found</td>
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
                            <h4 class="card-title">Add New Role</h4>
                            <p class="section-subtitle">Create a role and assign permissions.</p>
                        </div>

                        @include('validate')

                        <div class="card-body">
                            <form action="{{ route('role.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="role-name">Role Name</label>
                                    <input id="role-name" name="name" type="text" class="form-control"
                                        placeholder="Enter role name" autofocus>
                                </div>

                                <div class="form-group">
                                    <label>Permissions</label>
                                    <div class="permission-list">
                                        @forelse ($permissions as $item)
                                            <label class="permission-option">
                                                <input type="checkbox" name="permission[]" value="{{ $item->slug }}">
                                                <span>{{ $item->name }}</span>
                                            </label>
                                        @empty
                                            <p class="text-danger text-center mb-0">No Records Found</p>
                                        @endforelse
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-plus mr-1" aria-hidden="true"></i> Add Role
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif

                @if ($form_type == 'edit')
                    <div class="card form-card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Role</h4>
                            <p class="section-subtitle">Update role name and permissions.</p>
                        </div>

                        @include('validate')

                        <div class="card-body">
                            <form action="{{ route('role.update', $edit->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="edit-role-name">Role Name</label>
                                    <input id="edit-role-name" name="name" value="{{ $edit->name }}" type="text"
                                        class="form-control" placeholder="Enter role name" autofocus>
                                </div>

                                <div class="form-group">
                                    <label>Permissions</label>
                                    <div class="permission-list">
                                        @forelse (json_decode($permissions) as $item)
                                            <label class="permission-option">
                                                <input @if (in_array($item->slug, json_decode($edit->permission))) checked @endif type="checkbox"
                                                    name="permission[]" value="{{ $item->slug }}">
                                                <span>{{ $item->name }}</span>
                                            </label>
                                        @empty
                                            <p class="text-danger text-center mb-0">No Records Found</p>
                                        @endforelse
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <a class="btn btn-outline-info" href="{{ route('role.index') }}">
                                        <i class="fa fa-arrow-left mr-1" aria-hidden="true"></i> Back
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save mr-1" aria-hidden="true"></i> Update Role
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
