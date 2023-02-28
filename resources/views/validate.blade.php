@if ($errors->any())
<p class="alert alert-danger d-flex justify-content-between">{{$errors->first()}}<button data-dismiss="alert" class="close">&times;</button></p>
@endif
@if (Session::has('success'))
<p class="alert alert-success d-flex justify-content-between">{{Session::get('success')}}<button data-dismiss="alert" class="close">&times;</button></p>  
@endif
@if (Session::has('warning'))
<p class="alert alert-warning d-flex justify-content-between">{{Session::get('warning')}}<button data-dismiss="alert" class="close">&times;</button></p>  
@endif
@if (Session::has('danger'))
<p class="alert alert-danger d-flex justify-content-between">{{Session::get('danger')}}<button data-dismiss="alert" class="close">&times;</button></p>  
@endif