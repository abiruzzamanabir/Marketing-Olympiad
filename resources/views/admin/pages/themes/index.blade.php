@extends('admin.layouts.app')
@section('main')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Theme Options</h4>
            </div>
            @include('validate')
            <div class="card-body">
                <form action="{{ route('theme-option.update',1) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Title</label>
                        <div class="col-md-10">
                            <input type="text" name="title" value="{{$theme->title}}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Tag Line</label>
                        <div class="col-md-10">
                            <input type="text" name="tagline" value="{{$theme->tagline}}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Favicon</label>
                        <div class="col-md-10">
                            @if ($theme->favicon==='favicon.png')
                            <img width="100px" style="background-color: rgb(197, 197, 197);margin:10px 0px"
                                src="{{ asset('storage/logo/favicon.png') }}" alt="" class="logo-light">
                            @else
                            <img width="100px" style="background-color: rgb(197, 197, 197);margin:10px 0px"
                                src="{{ url('storage/logo/'.$theme->favicon)}}" alt="" class="logo-light">
                            @endif
                            <input type="hidden" name="old_favicon" value="{{$theme->favicon}}">
                            <input class="form-control" name="favicon" type="file">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Logo</label>
                        <div class="col-md-10">
                            @if ($theme->logo==='logo.png')
                            <img width="100px" style="background-color: rgb(197, 197, 197);margin:10px 0px"
                                src="{{ asset('storage/logo/logo.png') }}" alt="" class="logo-light">
                            @else
                            <img width="100px" style="background-color: rgb(197, 197, 197);margin:10px 0px"
                                src="{{ url('storage/logo/'.$theme->logo)}}" alt="" class="logo-light">
                            @endif
                            <input type="hidden" name="old_logo" value="{{$theme->logo}}">
                            <input class="form-control" name="logo" type="file">
                        </div>
                    </div>
                    @php
                        $social= json_decode($theme->social,false);
                    @endphp
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Social</label>
                        <div class="col-md-10">
                            <label>Facebook</label>
                            <input type="text" name="facebook" value="{{$social->facebook}}" class="form-control">
                            <label>Twitter</label>
                            <input type="text" name="twitter" value="{{$social->twitter}}" class="form-control">
                            <label>LinkedIn</label>
                            <input type="text" name="linkedin" value="{{$social->linkedin}}" class="form-control">
                            <label>Instagram</label>
                            <input type="text" name="instagram" value="{{$social->instagram}}" class="form-control">
                            <label>Dribbble</label>
                            <input type="text" name="dribbble" value="{{$social->dribbble}}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Copyright</label>
                        <div class="col-md-10">
                            <input type="text" name="copyright" value="{{$theme->copyright}}" class="form-control">
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
    <div></div>
</div>
@endsection