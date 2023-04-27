@extends('admin.layouts.app')
@section('main')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Round One Result</h4>
                    <div class="mb-3">
                        <a type="button" href="{{ route('round.one.export') }}" class="btn btn-sm btn-primary my-2">Dowenload Result Sheet</a>
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
                                    <th>Marks</th>
                                    <th>Duration</th>
                                    <th>Status</th>
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
                                        <td>{{ $user->round_one_result }}</td>
                                        @php
                                            $minute = gmdate('i', $user->duration);
                                            $secounds = gmdate('s', $user->duration);
                                        @endphp
                                        <td> {{ $minute . ' Minute' . ($minute > 1 ? 's ' : ' ') . $secounds . ' Second' . ($secounds > 1 ? 's ' : ' ') }}
                                        </td>
                                        <td>
                                            @if ($user->selected)
                                                <a href="{{ route('student.selected.status.update', $user->id) }}"><span
                                                        class="badge badge-success">Selected</span></a>
                                            @else
                                                <a href="{{ route('student.selected.status.update', $user->id) }}"><span
                                                        class="badge badge-danger">Not Selected</span></a>
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
@endsection
