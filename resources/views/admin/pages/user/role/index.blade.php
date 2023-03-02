@extends('admin.layouts.app')
@section('main')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Roles</h4>
            </div>
            @include('validate-main')
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Permissions</th>
                                @if ($form_type=='create')
                                <th>Created At</th> @endif
                                @if ($form_type=='edit')
                                <th>Updated At</th> @endif
                                <th>Users</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $role)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$role->name}}</td>
                                <td>{{$role->slug}}</td>
                                <td>
                                    <ul class="list-unstyled">
                                        <li>
                                            @forelse (json_decode($role->permission) as $item)
                                                <li><i class="fa fa-angle-right mr-2" aria-hidden="true"></i>{{$item}}</li>
                                            @empty
                                                <li>No data found</li>
                                            @endforelse
                                        </li>
                                    </ul>
                                </td>
                                @if ($form_type=='create')
                                <td>{{$role->created_at->diffForHumans()}}</td>
                                @endif
                                @if ($form_type=='edit')
                                <td>{{$role->updated_at->diffForHumans()}}</td>
                                @endif
                                <td>
                                    <ul class="list-unstyled">
                                            @forelse (json_decode($role->users) as $role_user)
                                                <li>
                                                    <span><i class="fa fa-check" aria-hidden="true"></i></span>{{$role_user->fast_name}}
                                                </li>
                                            @empty
                                                <li class="text-danger">No User Found</li>
                                            @endforelse
                                    </ul>
                                </td>
                                <td>
                                    {{-- <a class="btn btn-sm btn-info" href=""><i class="fa fa-eye"
                                            aria-hidden="true"></i></a> --}}
                                    <a class="btn btn-sm btn-warning" href="{{ route('role.edit', $role->id) }}"><i
                                            class="fa fa-edit" aria-hidden="true"></i></a>
                                    @if ($form_type=='create')
                                    <form class="d-inline delete-form" action="{{ route('role.destroy', $role->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fa fa-trash"
                                                aria-hidden="true"></i></button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-danger text-center" colspan="6">No Data Found</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        @if ($form_type == 'create')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add new role</h4>
            </div>
            @include('validate')
            <div class="card-body">
                <form action="{{ route('role.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" type="text" class="form-control" autofocus>
                    </div>
                    <div class="form-group">
                        <ul class="list-unstyled">
                            @forelse ($permissions as $item)
                            <li>
                                <label><input class="mr-2" type="checkbox" name="permission[]" value="{{$item->slug}}" id="">{{$item->name}}</label>
                            </li>
                            @empty
                            <li>
                                <label class="text-danger text-center">No Records Found</label>
                            </li>

                            @endforelse
                        </ul>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
        @if ($form_type == 'edit')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit role</h4>
            </div>
            @include('validate')
            <div class="card-body">
                <form action="{{ route('role.update',$edit->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" value="{{$edit->name}}" type="text" class="form-control" autofocus>
                    </div>
                    <div class="form-group">
                        <ul class="list-unstyled">
                            @forelse (json_decode($permissions) as $item)
                            <li>
                                <label><input @if (in_array($item->slug , json_decode($edit->permission))) checked @endif class="mr-2" type="checkbox" name="permission[]" value="{{$item->slug}}" id="">{{$item->name}}</label>
                            </li>
                            @empty
                            <li>
                                <label class="text-danger text-center">No Records Found</label>
                            </li>

                            @endforelse
                        </ul>
                    </div>
                    <div class="text-right">
                        <a class="btn btn-info" href="{{ route('role.index') }}">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection