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
                    <h4 class="card-title">Round One Result (Top 1000)</h4>
                    <div class="mb-3">
                        <a class="btn btn-sm btn-warning" href="{{ route('student.block') }}">Ban Student <i
                            class="fa fa-ban ml-2" aria-hidden="true"></i></a>
                    <a class="btn btn-sm btn-danger" href="{{ route('student.trash') }}">Trash Student <i
                            class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>
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
                        <table id="listRender" class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>Email</th>
                                    <th>Photo</th>
                                    <th>Marks</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            var table = $('#listRender').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('student.round.one.result') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'fullName', name: 'fullName'},
                    {data: 'email', name: 'email'},
                    {data: 'image', name: 'image'},
                    {data: 'round_one_result', name: 'round_one_result'},
                    {data: 'duration', name: 'duration'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action'}
                ]
            });
        });
    </script>
@endpush
