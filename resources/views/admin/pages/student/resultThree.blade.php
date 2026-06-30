@php
    use App\Models\ExamControl;
    use App\Models\Theme;
    use Carbon\Carbon;
    $exam = ExamControl::findOrFail(1);
    $theme = Theme::findOrFail(1);
    $exam_carbon = Carbon::parse($exam->start_date_time);
    $exam_end_carbon = Carbon::parse($exam->end_date_time);
    $start_exam_carbon = Carbon::parse($exam->next_round_date);
    $end_exam_carbon = Carbon::parse($exam->next_round_end_date);
@endphp
@extends('admin.layouts.app')

@section('main')

<style>
    .student-page {
        --primary: #0d6efd;
        --primary-soft: #eef5ff;
        --success-soft: #ecfdf3;
        --danger-soft: #fff1f2;
        --warning-soft: #fff8e6;
        --border: #e7edf5;
        --muted: #6b7280;
        --text: #1f2937;
        --shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
    }

    .student-page .page-hero {
        background: linear-gradient(135deg, #ffffff 0%, #f7faff 100%);
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 24px;
        margin-bottom: 24px;
        box-shadow: var(--shadow);
    }

    .student-page .page-hero h3 {
        color: var(--text);
        font-weight: 700;
        margin-bottom: 6px;
    }

    .student-page .page-hero p {
        color: var(--muted);
        margin-bottom: 0;
    }

    .student-page .hero-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .student-page .stat-card,
    .student-page .content-card {
        background: #ffffff;
        border: 1px solid var(--border);
        border-radius: 18px;
        box-shadow: var(--shadow);
        overflow: hidden;
        margin-bottom: 24px;
    }

    .student-page .stat-card {
        padding: 18px;
        height: 100%;
    }

    .student-page .stat-label {
        color: var(--muted);
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .student-page .stat-value {
        color: var(--text);
        font-size: 26px;
        font-weight: 800;
        margin-bottom: 0;
    }

    .student-page .content-card .card-header {
        background: #ffffff;
        border-bottom: 1px solid var(--border);
        padding: 18px 22px;
    }

    .student-page .content-card .card-title {
        color: var(--text);
        font-weight: 700;
        margin-bottom: 2px;
    }

    .student-page .section-subtitle {
        color: var(--muted);
        font-size: 14px;
        margin-bottom: 0;
    }

    .student-page .table thead th {
        border-top: none;
        border-bottom: 1px solid var(--border);
        color: #4b5563;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .03em;
        white-space: nowrap;
    }

    .student-page .table tbody td {
        vertical-align: middle;
        border-color: #edf2f7;
        color: #374151;
    }

    .student-page .avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #ffffff;
        box-shadow: 0 6px 16px rgba(15, 23, 42, 0.12);
    }

    .student-page .btn {
        border-radius: 10px;
        font-weight: 600;
    }

    .student-page .btn-icon {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    .student-page .empty-state {
        padding: 36px 18px;
        text-align: center;
        color: var(--muted);
    }

    .student-page .modal-content {
        border: 0;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.18);
    }

    .student-page .modal-header {
        border-bottom: 1px solid var(--border);
        background: #ffffff;
        padding: 18px 22px;
    }

    .student-page .modal-title {
        font-weight: 700;
        color: var(--text);
    }

    .student-page .modal-body {
        padding: 22px;
    }

    .student-page label {
        font-weight: 700;
        color: #374151;
        margin-bottom: 7px;
    }

    .student-page .form-control {
        border-radius: 10px;
        border-color: #d9e1ec;
        min-height: 42px;
    }

    .student-page .document-preview {
        max-width: 100%;
        border-radius: 14px;
        border: 1px solid var(--border);
        background: #f8fafc;
        padding: 8px;
        margin: 8px 0;
    }

    @media (max-width: 991px) {
        .student-page .hero-actions {
            justify-content: flex-start;
            margin-top: 16px;
        }
    }

    @media (max-width: 767px) {
        .student-page .page-hero,
        .student-page .content-card .card-header,
        .student-page .modal-body,
        .student-page .modal-header {
            padding: 18px;
        }
    }
</style>

<div class="student-page">
    <div class="page-hero">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3>Round Three Result (Top 15)</h3>
                <p>Review final round shortlisted participants and actions.</p>
            </div>
            <div class="col-lg-4">
                <div class="hero-actions">
                    
<a class="btn btn-warning btn-sm" href="{{ route('student.block') }}"><i class="fa fa-ban mr-1" aria-hidden="true"></i> Ban Student</a>
<a class="btn btn-danger btn-sm" href="{{ route('student.trash') }}"><i class="fa fa-trash mr-1" aria-hidden="true"></i> Trash Student</a>
<a href="{{ route('round.three.export') }}" class="btn btn-primary btn-sm"><i class="fa fa-download mr-1" aria-hidden="true"></i> Download Result Sheet</a>

                </div>
            </div>
        </div>
    </div>

    @include('validate-main')

    

    <div class="card content-card">
        <div class="card-header">
            <h4 class="card-title">Round Three Result (Top 15)</h4>
            <p class="section-subtitle">Review final round shortlisted participants and actions.</p>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="listRender" class="table table-hover mb-0">
<thead><tr>
<th>#</th>
<th>Name</th>
<th>Email</th>
<th>Gender</th>
<th>Photo</th>
<th>Status</th>
<th>Action</th>
</tr></thead>
<tbody></tbody>
</table>
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
                ajax: "{{ route('student.round.three.result') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'fullName', name: 'fullName'},
                    {data: 'email', name: 'email'},
                    {data: 'gender', name: 'gender'},
                    {data: 'image', name: 'image'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action'}
                ]
            });
        });
    </script>
@endpush
