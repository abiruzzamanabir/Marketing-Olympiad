<div class="modal fade" id="view_student_details{{ $user->id }}" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Information Of <span
                            class="text-bold text-uppercase text-primary">{{ $user->first_name ?? '' }}
                        {{ $user->last_name ?? '' }}</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="text-center mt-2">
                <img style="width: 120px; height: 120px; object-fit: cover" class="rounded-circle" alt="User Image"
                     src="{{ asset('storage/admins/' . $user->photo) }}">
            </div>
            <div class="modal-body">
                <form action="" method="">
                    <div class="row form-row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input name="first_name" type="text" class="form-control"
                                       value="{{ $user->first_name ?? '' }}" required readonly>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input name="last_name" type="text" class="form-control"
                                       value="{{ $user->last_name ?? '' }}" required readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>University Name</label>
                                <input name="bio" type="text" class="form-control"
                                       value="{{ $user->uniname ?? '' }}" required readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <div class="cal-icon">
                                    <input name="dob" type="date" class="form-control"
                                           value="{{ $user->dob ?? '' }}" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-7">
                            <div class="form-group">
                                <label>Email ID</label>
                                <input name="email" type="email" class="form-control"
                                       value="{{ $user->email ?? '' }}" required readonly>
                            </div>
                        </div>
                        <div class="col-12 col-sm-5">
                            <div class="form-group">
                                <label>Mobile</label>
                                <input name="cell" type="text" value="{{ $user->cell ?? '' }}"
                                       class="form-control" required readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>NID (<span class="text-danger">{{ $user->nid ?? '' }}</span>)</label>
                                @if ($user->status)
                                    @if (Auth::guard('admin')->user()->role->name == 'Super Admin')
                                        <a class="text-danger"
                                           href="{{ route('student.status.update', $user->id) }}"><span
                                                    class="badge badge-success">Verified</span></a>
                                    @else
                                    @endif
                                @else
                                    @if (Auth::guard('admin')->user()->role->name == 'Super Admin')
                                        <a class="text-success"
                                           href="{{ route('student.status.update', $user->id) }}"><span
                                                    class="badge badge-danger">Unverified</span></a>
                                    @else
                                    @endif
                                @endif
                                <br>
                                <div class="text-center">
                                    <img class="col-sm-10 my-2 border border-dark p-2 bg-dark shadow-sm"
                                         alt="User NID Front"
                                         src="{{ asset('storage/studentNidFront/' . $user->nidphotofront) }}">
                                  @if(!empty($user->nidphotoback))
                                    <img class="col-sm-10 my-2 border border-dark p-2 bg-dark shadow-sm"
                                         alt="User NID Back"
                                         src="{{ asset('storage/studentNidBack/' . $user->nidphotoback) }}">
                                    @else
                                     <p>No Image</p>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Student ID (<span
                                            class="text-danger">{{ $user->stuid ?? '' }}</span>)</label>
                                @if ($user->status)
                                    @if (Auth::guard('admin')->user()->role->name == 'Super Admin')
                                        <a class="text-danger"
                                           href="{{ route('student.status.update', $user->id) }}"><span
                                                    class="badge badge-success">Verified</span></a>
                                    @else
                                    @endif
                                @else
                                    @if (Auth::guard('admin')->user()->role->name == 'Super Admin')
                                        <a class="text-success"
                                           href="{{ route('student.status.update', $user->id) }}"><span
                                                    class="badge badge-danger">Unverified</span></a>
                                    @else
                                    @endif
                                @endif
                                <br>
                                <div class="text-center">
                                    @if(!empty($user->stuphotofront))
                                    <img class="col-sm-10 my-2 border border-dark p-2 bg-dark shadow-sm"
                                         alt="User Student ID Front"
                                         src="{{ asset('storage/studentSidFront/' . $user->stuphotofront) }}">
                                    @else
                                        <p>No Image</p>
                                    @endif
                                    @if(!empty($user->stuphotoback))
                                    <img class="col-sm-10 my-2 border border-dark p-2 bg-dark shadow-sm"
                                         alt="User Student ID Back"
                                         src="{{ asset('storage/studentSidBack/' . $user->stuphotoback) }}">
                                     @else
                                      <p>No Image</p>
                                     @endif
                                </div>
                            </div>
                        </div>


                        <div class="col-12">
                            <h5 class="form-title"><span>Address</span></h5>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input name="address" type="text" class="form-control"
                                       value="{{ $user->address ?? '' }}" required readonly>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>City</label>
                                <input name="city" type="text" class="form-control"
                                       value="{{ $user->city ?? '' }}" required readonly>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>State</label>
                                <input name="state" type="text" class="form-control"
                                       value="{{ $user->state ?? '' }}" required readonly>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Zip Code</label>
                                <input name="zip" type="text" class="form-control"
                                       value="{{ $user->zip ?? '' }}" required readonly>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Country</label>
                                <input name="country" type="text" class="form-control"
                                       value="{{ $user->country ?? '' }}" required readonly>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Round 1 Result</label>
                                <input name="country" type="text" class="form-control"
                                       value="{{ $user->round_one_result ?? '' }}/{{$exam->question_qty}}" required readonly>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Round 2 Result</label>
                                <input name="country" type="text" class="form-control"
                                       exam                  value="{{ $user->round_two_result ?? '' }}/{{$exam->question_qty}}" required readonly>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Round 1 Duration</label>
                                <input name="country" type="text" class="form-control"
                                       value="{{ $user->duration ?? '' }} {{$user->duration ? 'Seconds':''}}" required readonly>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Round 2 Duration</label>
                                <input name="country" type="text" class="form-control"
                                       value="{{ $user->duration2 ?? '' }} {{$user->duration2 ? 'Seconds':''}}" required readonly>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Last Login IP</label>
                                <input name="country" type="text" class="form-control"
                                       value="{{ $user->last_login_ip ?? '' }}" required readonly>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a class="btn btn-sm btn-warning" href="{{ route('student.ban', $user->id) }}"><i
                                    class="fa fa-ban" aria-hidden="true"></i></a>
                        <a class="btn btn-sm btn-danger" href="{{ route('admin.trash.update', $user->id) }}"><i
                                    class="fa fa-trash" aria-hidden="true"></i></a>
                    </div>
                    {{-- <button type="submit" class="btn btn-primary btn-block">Save
                    Changes</button> --}}
                </form>
            </div>
        </div>
    </div>
</div>
