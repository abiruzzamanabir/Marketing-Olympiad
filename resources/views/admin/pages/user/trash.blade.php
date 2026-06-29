@extends('admin.layouts.app')

@section('main')
    <style>
        .trash-page .hero,
        .trash-page .card {
            border: 1px solid #e8edf3;
            border-radius: 18px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .05)
        }

        .trash-page .hero {
            padding: 24px;
            margin-bottom: 24px;
            background: #fff
        }

        .trash-page .table thead th {
            font-size: 12px;
            text-transform: uppercase
        }

        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover
        }

        .userbox {
            display: flex;
            align-items: center;
            gap: 12px
        }
    </style>

    <div class="trash-page">
        <div class="hero d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-1">Trash Users</h3>
                <p class="text-muted mb-0">Restore or permanently delete archived administrator accounts.</p>
            </div>
            <a href="{{ route('admin-user.index') }}" class="btn btn-success">
                <i class="fa fa-users mr-1"></i> Active Users
            </a>
        </div>

        @include('validate-main')

        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Photo</th>
                                <th width="180">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($all_admin as $user)
                                @if ($user->name !== 'Provider')
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <strong>{{ $user->first_name }} {{ $user->last_name }}</strong>
                                        </td>
                                        <td>
                                            @if ($user->photo == 'avatar.png')
                                                <img class="avatar" src="{{ asset('storage/admins/avatar.png') }}">
                                            @else
                                                <img class="avatar" src="{{ asset('storage/admins/' . $user->photo) }}">
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.trash.update', $user->id) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="fa fa-undo"></i> Restore
                                            </a>

                                            @if ($form_type == 'trash')
                                                <form class="d-inline delete-form"
                                                    action="{{ route('admin-user.destroy', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-5">
                                        No trashed users found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
