@if (Session::has('success-main'))
<p class="alert alert-success d-flex justify-content-between">{{Session::get('success-main')}}<button data-dismiss="alert" class="close">&times;</button></p>  
@endif
@if (Session::has('warning-main'))
<p class="alert alert-warning d-flex justify-content-between">{{Session::get('warning-main')}}<button data-dismiss="alert" class="close">&times;</button></p>  
@endif
@if (Session::has('danger-main'))
<p class="alert alert-danger d-flex justify-content-between">{{Session::get('danger-main')}}<button data-dismiss="alert" class="close">&times;</button></p>  
@endif