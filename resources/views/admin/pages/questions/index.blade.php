@php
    use App\Models\Theme;
    $theme = Theme::findOrFail(1);
    
@endphp
@extends('admin.layouts.app')
@section('main')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Question</h4>
                </div>
                @include('validate-main')
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Question</th>
                                    <th>Option 1</th>
                                    <th>Option 2</th>
                                    <th>Option 3</th>
                                    <th>Option 4</th>
                                    <th>Answer</th>
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
                                @forelse ($question as $qa)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $qa->question }}</td>
                                        @foreach(json_decode($qa->option1) as $val)
                                            <td>{{ $val }}</td>
                                        @endforeach


                                        <td>{{ $qa->answer }}</td>
                                        @if ($form_type == 'create')
                                            <td>{{ $qa->created_at->diffForHumans() }}</td>
                                        @endif
                                        @if ($form_type == 'edit')
                                            <td>{{ $qa->updated_at->diffForHumans() }}</td>
                                        @endif
                                        <td>
                                            {{-- <a class="btn btn-sm btn-info" href=""><i class="fa fa-eye"
                                            aria-hidden="true"></i></a> --}}
                                            <a class="btn btn-sm btn-warning"
                                                href="{{ route('question.edit', $qa->id) }}"><i class="fa fa-edit"
                                                    aria-hidden="true"></i></a>
                                            @if ($form_type == 'create')
                                                <form class="d-inline delete-form"
                                                    action="{{ route('permission.destroy', $qa->id) }}" method="POST">
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
                                        <td class="text-danger text-center" colspan="9">No Data Found</td>
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
                        <h4 class="card-title">Add new Question</h4>
                    </div>
                    @include('validate')
                    <div class="card-body">
                        <form action="{{ route('question.store') }}" method="POST">
                            @csrf
                            <div class="form-group order">
                                <label>Question</label>
                                <input name="question" type="text" class="form-control" autofocus>
                            </div>
                            <div class="form-group order">
                                <label>Option 1</label>
                                <input id="option1" name="option[]" type="text" class="form-control" autofocus>
                            </div>
                            <div class="form-group order">
                                <label>Option 2</label>
                                <input id="option2" name="option[]" type="text" class="form-control" autofocus>
                            </div>
                            <div class="form-group order">
                                <label>Option 3</label>
                                <input id="option3" name="option[]" type="text" class="form-control" autofocus>
                            </div>
                            <div class="form-group order">
                                <label>Option 4</label>
                                <input id="option4" name="option[]" type="text" class="form-control" autofocus>
                            </div>
                            <div class="form-group order">
                                <label>Answer</label>
                                <select class="form-control" name="answer" id="">
                                    <option value="">Select</option>
                                    <option id="answer1" value=""></option>
                                    <option id="answer2" value=""></option>
                                    <option id="answer3" value=""></option>
                                    <option id="answer4" value=""></option>
                                </select>
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
                        <h4 class="card-title">Edit Question</h4>
                    </div>
                    @include('validate')
                    <div class="card-body">
                        <form action="{{ route('question.update', $edit->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Question</label>
                                <input name="question" value="{{ $edit->question }}" type="text" class="form-control"
                                    autofocus>
                            </div>
                            @foreach(json_decode($edit->option1) as $key=>$val)
                                <?php $index = ++$key; ?>
                            <div class="form-group">
                                <label>Option {{$index}}</label>
                                <input id="option{{$index}}" name="option[]" value="{{ $val }}" type="text" class="form-control"
                                    autofocus>
                            </div>
                            @endforeach
{{--                            <div class="form-group">--}}
{{--                                <label>Option 2</label>--}}
{{--                                <input id="option2" name="option2" value="{{ $edit->option2 }}" type="text" class="form-control"--}}
{{--                                    autofocus>--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label>Option 3</label>--}}
{{--                                <input id="option3" name="option3" value="{{ $edit->option3 }}" type="text" class="form-control"--}}
{{--                                    autofocus>--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label>Option 4</label>--}}
{{--                                <input id="option4" name="option4" value="{{ $edit->option4 }}" type="text" class="form-control"--}}
{{--                                    autofocus>--}}
{{--                            </div>--}}
                            <div class="form-group order">
                                <select class="form-control" name="answer" id="">
                                    <option value="">Select</option>
                                    @foreach(json_decode($edit->option1) as $key=>$val)
                                        <?php $index = ++$key; ?>
                                        <option id="answer{{$index}}" @if ($val == $edit->answer) selected @endif
                                        value="{{ $val }}">{{ $val }}</option>
                                        @endforeach

{{--                                        <option id="answer2" @if ($edit->option2 == $edit->answer) selected @endif--}}
{{--                                            value="{{ $edit->option2 }}">{{ $edit->option2 }}</option>--}}
{{--                                        <option id="answer3" @if ($edit->option3 == $edit->answer) selected @endif--}}
{{--                                            value="{{ $edit->option3 }}">{{ $edit->option3 }}</option>--}}
{{--                                        <option id="answer4" @if ($edit->option4 == $edit->answer) selected @endif--}}
{{--                                            value="{{ $edit->option4 }}">{{ $edit->option4 }}</option>--}}
                                </select>
                            </div>

                            <div class="text-right">
                                <a class="btn btn-info" href="{{ route('question.view') }}">Back</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
