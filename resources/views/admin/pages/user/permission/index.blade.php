@extends('admin.layouts.app')
@section('main')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Permissions</h4>
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
                                @if ($form_type=='create')
                                <th>Created At</th> @endif
                                @if ($form_type=='edit')
                                <th>Updated At</th> @endif
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($all_permission as $per)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$per->name}}</td>
                                <td>{{$per->slug}}</td>
                                @if ($form_type=='create')
                                <td>{{$per->created_at->diffForHumans()}}</td>
                                @endif
                                @if ($form_type=='edit')
                                <td>{{$per->updated_at->diffForHumans()}}</td>
                                @endif
                                <td>
                                    {{-- <a class="btn btn-sm btn-info" href=""><i class="fa fa-eye"
                                            aria-hidden="true"></i></a> --}}
                                    <a class="btn btn-sm btn-warning" href="{{ route('permission.edit', $per->id) }}"><i
                                            class="fa fa-edit" aria-hidden="true"></i></a>
                                    @if ($form_type=='create')
                                    <form class="d-inline delete-form" action="{{ route('permission.destroy', $per->id) }}"
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
                                <td class="text-danger text-center" colspan="5">No Data Found</td>
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
                <h4 class="card-title">Add new permission</h4>
            </div>
            @include('validate')
            <div class="card-body">
                <form action="{{ route('permission.store') }}" method="POST">
                    @csrf
                    <div class="form-group order">
                        <label>Name</label>
                        <input name="name" type="text" class="form-control" autofocus>
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
                <h4 class="card-title">Edit permission</h4>
            </div>
            @include('validate')
            <div class="card-body">
                <form action="{{ route('permission.update',$edit->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" value="{{$edit->name}}" type="text" class="form-control" autofocus>
                    </div>

                    <div class="text-right">
                        <a class="btn btn-info" href="{{ route('permission.index') }}">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection