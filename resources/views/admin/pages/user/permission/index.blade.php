@extends('admin.layouts.app')

@section('main')
    <style>
        .permissions-page {
            --primary: #0d6efd;
            --primary-soft: #eef5ff;
            --danger-soft: #fff1f2;
            --border: #e7edf5;
            --muted: #6b7280;
            --text: #1f2937;
            --shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
        }

        .permissions-page .page-hero {
            background: linear-gradient(135deg, #ffffff 0%, #f7faff 100%);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: var(--shadow);
        }

        .permissions-page .page-hero h3 {
            color: var(--text);
            font-weight: 700;
            margin-bottom: 6px;
        }

        .permissions-page .page-hero p {
            color: var(--muted);
            margin-bottom: 0;
        }

        .permissions-page .stat-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 18px;
            box-shadow: var(--shadow);
            height: 100%;
        }

        .permissions-page .stat-label {
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .permissions-page .stat-value {
            color: var(--text);
            font-size: 26px;
            font-weight: 800;
            margin-bottom: 0;
        }

        .permissions-page .content-card,
        .permissions-page .form-card {
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 24px;
        }

        .permissions-page .form-card {
            position: sticky;
            top: 90px;
        }

        .permissions-page .content-card .card-header,
        .permissions-page .form-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid var(--border);
            padding: 18px 22px;
        }

        .permissions-page .card-title {
            color: var(--text);
            font-weight: 700;
            margin-bottom: 2px;
        }

        .permissions-page .section-subtitle {
            color: var(--muted);
            font-size: 14px;
            margin-bottom: 0;
        }

        .permissions-page .table thead th {
            border-top: none;
            border-bottom: 1px solid var(--border);
            color: #4b5563;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .03em;
            white-space: nowrap;
        }

        .permissions-page .table tbody td {
            vertical-align: middle;
            border-color: #edf2f7;
            color: #374151;
        }

        .permissions-page .permission-name {
            font-weight: 700;
            color: var(--text);
            margin-bottom: 2px;
        }

        .permissions-page .permission-slug {
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 0;
        }

        .permissions-page .slug-pill {
            display: inline-flex;
            align-items: center;
            border-radius: 999px;
            background: var(--primary-soft);
            color: #0b5ed7;
            padding: 7px 11px;
            font-size: 12px;
            font-weight: 700;
        }

        .permissions-page .btn-icon {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .permissions-page label {
            color: #374151;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .permissions-page .form-control {
            border-radius: 10px;
            border-color: #d9e1ec;
            min-height: 44px;
        }

        .permissions-page .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.12);
        }

        .permissions-page .helper-text {
            color: var(--muted);
            font-size: 12px;
            margin-top: 6px;
        }

        .permissions-page .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 18px;
        }

        .permissions-page .empty-state {
            padding: 36px 18px;
            text-align: center;
            color: var(--muted);
        }

        @media (max-width: 991px) {
            .permissions-page .form-card {
                position: static;
            }
        }

        @media (max-width: 767px) {

            .permissions-page .page-hero,
            .permissions-page .content-card .card-header,
            .permissions-page .form-card .card-header,
            .permissions-page .form-card .card-body {
                padding: 18px;
            }

            .permissions-page .form-actions {
                flex-direction: column;
            }

            .permissions-page .form-actions .btn {
                width: 100%;
            }
        }
    </style>

    @php
        $totalPermissions = $all_permission->count();
    @endphp

    <div class="permissions-page">
        <div class="page-hero">
            <h3>Permission Management</h3>
            <p>Create, update, and manage permission keys used across admin roles and access control.</p>
        </div>

        @include('validate-main')

        <div class="row mb-4">
            <div class="col-lg-4 col-sm-6 mb-3">
                <div class="stat-card">
                    <p class="stat-label">Total Permissions</p>
                    <h4 class="stat-value">{{ $totalPermissions }}</h4>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6 mb-3">
                <div class="stat-card">
                    <p class="stat-label">Current Mode</p>
                    <h4 class="stat-value text-capitalize">{{ $form_type }}</h4>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6 mb-3">
                <div class="stat-card">
                    <p class="stat-label">Access Control</p>
                    <h4 class="stat-value">Active</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card content-card">
                    <div class="card-header">
                        <h4 class="card-title">Permissions</h4>
                        <p class="section-subtitle">View all permission names, slugs, and update history.</p>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Permission</th>
                                        <th>Slug</th>
                                        @if ($form_type == 'create')
                                            <th>Created At</th>
                                        @endif
                                        @if ($form_type == 'edit')
                                            <th>Updated At</th>
                                        @endif
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($all_permission as $per)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>

                                            <td>
                                                <p class="permission-name">{{ $per->name }}</p>
                                                <p class="permission-slug">Permission item</p>
                                            </td>

                                            <td>
                                                <span class="slug-pill">{{ $per->slug }}</span>
                                            </td>

                                            @if ($form_type == 'create')
                                                <td>{{ $per->created_at->diffForHumans() }}</td>
                                            @endif

                                            @if ($form_type == 'edit')
                                                <td>{{ $per->updated_at->diffForHumans() }}</td>
                                            @endif

                                            <td>
                                                <a class="btn btn-sm btn-warning btn-icon"
                                                    href="{{ route('permission.edit', $per->id) }}" title="Edit Permission">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </a>

                                                @if ($form_type == 'create')
                                                    <form class="d-inline delete-form"
                                                        action="{{ route('permission.destroy', $per->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger btn-icon"
                                                            title="Delete Permission">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="empty-state" colspan="6">No Data Found</td>
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
                            <h4 class="card-title">Add New Permission</h4>
                            <p class="section-subtitle">Create a new permission for role assignment.</p>
                        </div>

                        @include('validate')

                        <div class="card-body">
                            <form action="{{ route('permission.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="permission-name">Permission Name</label>
                                    <input id="permission-name" name="name" type="text" class="form-control"
                                        placeholder="Enter permission name" autofocus>
                                    <p class="helper-text">The system can use this to generate or manage permission access.
                                    </p>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-plus mr-1" aria-hidden="true"></i> Add Permission
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif

                @if ($form_type == 'edit')
                    <div class="card form-card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Permission</h4>
                            <p class="section-subtitle">Update permission name while keeping the same backend logic.</p>
                        </div>

                        @include('validate')

                        <div class="card-body">
                            <form action="{{ route('permission.update', $edit->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="edit-permission-name">Permission Name</label>
                                    <input id="edit-permission-name" name="name" value="{{ $edit->name }}"
                                        type="text" class="form-control" placeholder="Enter permission name" autofocus>
                                </div>

                                <div class="form-actions">
                                    <a class="btn btn-outline-info" href="{{ route('permission.index') }}">
                                        <i class="fa fa-arrow-left mr-1" aria-hidden="true"></i> Back
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save mr-1" aria-hidden="true"></i> Update Permission
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
