@extends('admin.layouts.app')
@section('main')
@php
    use App\Models\ExamControl;
    use App\Models\Theme;
    use Carbon\Carbon;
    $exam = ExamControl::findOrFail(1);
    $theme = Theme::findOrFail(1);

    // $examstarttime = $exam->start_date_time;
    // $exam_start_carbon = Carbon::parse($examstarttime);
    // $exam_start = $exam_start_carbon->format('d');

    // $examendime = $exam->end_date_time;
    // $exam_end_carbon = Carbon::parse($examendime);
    // $exam_end = $exam_end_carbon->format('d');

    // $examtime = $exam->next_round_date;
    // $exam_carbon = Carbon::parse($examtime);

    // $exam_date = $exam_carbon->format('d'); // Output: 13
    // $exam_end_time = $exam->next_round_end_date;
    // $exam_end_carbon = Carbon::parse($exam_end_time);
    // $exam_end_date = $exam_end_carbon->format('d');
    // $exam_month = $exam_carbon->format('m'); // Output: 04
    // $exam_year = $exam_carbon->format('Y'); // Output: 2023

    // // echo "Date: $exam_date, Month: $exam_month, Year: $exam_year";
    // $currentdatetime = now();
    // $carbon = Carbon::parse($currentdatetime);

    // $date = $carbon->format('d'); // Output: 13
    // $month = $carbon->format('m'); // Output: 04
    // $year = $carbon->format('Y'); // Output: 2023

    // // echo "Date: $date, Month: $month, Year: $year";

    $exam_carbon = Carbon::parse($exam->start_date_time);
    $exam_end_carbon = Carbon::parse($exam->end_date_time);
    $start_exam_carbon = Carbon::parse($exam->next_round_date);
    $end_exam_carbon = Carbon::parse($exam->next_round_end_date);

@endphp
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Round Three Result (Top 15)</h4>
                    <div class="mb-3">
                        <a class="btn btn-sm btn-warning" href="{{ route('student.block') }}">Ban Student <i
                            class="fa fa-ban ml-2" aria-hidden="true"></i></a>
                    <a class="btn btn-sm btn-danger" href="{{ route('student.trash') }}">Trash Student <i
                            class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>
                        <a type="button" href="{{ route('round.three.export') }}" class="btn btn-sm btn-primary my-2">Dowenload Result Sheet</a>
                    </div>
                    {{-- <div>
                    <a class="btn btn-sm btn-danger" href="{{ route('student.unverified') }}"><i
                        class="fa fa-arrow-left mr-2" aria-hidden="true"></i>Unverified Student</a>
                    <a class="btn btn-sm btn-success" href="{{ route('student.verified') }}">Verified Student<i
                        class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>
                </div> --}}
                </div>
                @include('validate-main')
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>Email</th>
                                    <th>Photo</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($all_admin as $user)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $user->first_name }} {{ $user->last_name }} </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->photo == 'avatar.png')
                                                <img class="rounded-circle"
                                                    style="width: 40px; height: 40px; object-fit: cover"
                                                    src="{{ asset('storage/admins/avatar.png') }}" alt="Profile Picture">
                                            @else
                                                <img class="rounded-circle"
                                                    style="width: 40px; height: 40px; object-fit: cover"
                                                    src="{{ asset('storage/admins/' . $user->photo) }}"
                                                    alt="Profile Picture">
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->winner)
                                                <a href="{{ route('student.winner.status.update', $user->id) }}"><span
                                                        class="badge badge-success">Winner</span></a>
                                            @else
                                                <a href="{{ route('student.winner.status.update', $user->id) }}"><span
                                                        class="badge badge-danger">Not Selected</span></a>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- <a class="btn btn-sm btn-info" href=""><i class="fa fa-eye"
                                        aria-hidden="true"></i></a> --}}
                                            <a class="btn btn-sm btn-primary" data-toggle="modal"
                                                href="#view_student_details{{ $user->id }}"
                                                data-id="{{ $user->id }}"><i class="fa fa-eye mr-1"></i></a>
                                            <a class="btn btn-sm btn-warning"
                                                href="{{ route('student.ban', $user->id) }}"><i class="fa fa-ban"
                                                    aria-hidden="true"></i></a>
                                            @if ($form_type == 'create')
                                                {{-- <form class="d-inline delete-form"
                                    action="{{ route('admin-user.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"
                                            aria-hidden="true"></i></button>
                                </form> --}}
                                                <a class="btn btn-sm btn-danger"
                                                    href="{{ route('admin.trash.update', $user->id) }}"><i
                                                        class="fa fa-trash" aria-hidden="true"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-danger text-center" colspan="7">No Data Found</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @forelse ($all_admin as $user)
    <!-- Edit Details Modal -->
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
                                            alt="User Image"
                                            src="{{ asset('storage/studentNidFront/' . $user->nidphotofront) }}">
                                        <img class="col-sm-10 my-2 border border-dark p-2 bg-dark shadow-sm"
                                            alt="User Image"
                                            src="{{ asset('storage/studentNidBack/' . $user->nidphotoback) }}">
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
                                        <img class="col-sm-10 my-2 border border-dark p-2 bg-dark shadow-sm"
                                            alt="User Image"
                                            src="{{ asset('storage/studentSidFront/' . $user->stuphotofront) }}">
                                        <img class="col-sm-10 my-2 border border-dark p-2 bg-dark shadow-sm"
                                            alt="User Image"
                                            src="{{ asset('storage/studentSidBack/' . $user->stuphotoback) }}">
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
                                        value="{{ $user->round_two_result ?? '' }}" required readonly>
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
    <!-- /Edit Details Modal -->
@endforeach
@endsection
