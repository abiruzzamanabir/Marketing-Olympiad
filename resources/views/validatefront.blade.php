@if (Session::has('success-front'))
<p style="z-index: 99999" class="alert alert-success d-flex justify-content-between d-block">{{Session::get('success-front')}}<button data-bs-dismiss="alert" class="btn-close"></button></p>
@endif
@if (Session::has('warning-front'))
<p style="z-index: 99999" class="alert alert-warning d-flex justify-content-between d-block">{{Session::get('warning-front')}}<button data-bs-dismiss="alert" class="btn-close"></button></p>
@endif
@if (Session::has('danger-front'))
<p style="z-index: 99999" class="alert alert-danger d-flex justify-content-between d-block">{{Session::get('danger-front')}}<button data-bs-dismiss="alert" class="btn-close"></button></p>
@endif
