@extends('admin.layouts.app')
@section('main')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Exam Control</h4>
                </div>
                @include('validate')
                <div class="card-body">
                    <form action="{{ route('exam-controll.update', 1) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Round 1 result</label>
                            <div class="form-group order">
                                <select class="form-control" name="round1resultstatus" id="">
                                    <option value="">Select</option>
                                    <option @if ($exam->round1resultstatus == 'true') selected @endif value="true">Published
                                    </option>
                                    <option @if ($exam->round1resultstatus == 'false') selected @endif value="false">Unpublished
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Round 2 result</label>
                            <div class="form-group order">
                                <select class="form-control" name="round2resultstatus" id="">
                                    <option value="">Select</option>
                                    <option @if ($exam->round2resultstatus == 'true') selected @endif value="true">Published
                                    </option>
                                    <option @if ($exam->round2resultstatus == 'false') selected @endif value="false">Unpublished
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-primary">Save Change</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
