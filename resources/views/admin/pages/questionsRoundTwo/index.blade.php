@php
    use App\Models\Theme;
    $theme = Theme::findOrFail(1);

    function checkRoundTwoQuestionProblems($qa)
    {
        $problems = [];

        $options = json_decode($qa->option, true);

        if (!is_array($options)) {
            $problems[] = 'Options JSON invalid';
            $options = [];
        }

        if ($qa->category_id == 3) {
            if (empty($qa->image_question)) {
                $problems[] = 'Image question missing';
            }
        } else {
            if (empty(trim($qa->question ?? ''))) {
                $problems[] = 'Question missing';
            }
        }

        if (count($options) != 4) {
            $problems[] = 'Options are not exactly 4';
        }

        foreach ($options as $index => $option) {
            if (empty(trim($option ?? ''))) {
                $problems[] = 'Option ' . ($index + 1) . ' missing';
            }
        }

        $cleanOptions = array_map(function ($option) {
            return strtolower(trim($option ?? ''));
        }, $options);

        if (count($cleanOptions) !== count(array_unique($cleanOptions))) {
            $problems[] = 'Duplicate options found';
        }

        if (empty(trim($qa->answer ?? ''))) {
            $problems[] = 'Answer missing';
        } else {
            $answer = strtolower(trim($qa->answer));

            if (!in_array($answer, $cleanOptions)) {
                $problems[] = 'Answer does not match any option';
            }
        }

        return $problems;
    }

    $totalProblemQuestions = 0;

    foreach ($question as $qa) {
        if (count(checkRoundTwoQuestionProblems($qa)) > 0) {
            $totalProblemQuestions++;
        }
    }
@endphp

@extends('admin.layouts.app')

@section('main')

    <style>
        .manage-page {
            --primary: #0d6efd;
            --primary-soft: #eef5ff;
            --border: #e7edf5;
            --muted: #6b7280;
            --text: #1f2937;
            --shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
        }

        .manage-page .page-hero {
            background: linear-gradient(135deg, #ffffff 0%, #f7faff 100%);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: var(--shadow);
        }

        .manage-page .page-hero h3 {
            color: var(--text);
            font-weight: 700;
            margin-bottom: 6px;
        }

        .manage-page .page-hero p {
            color: var(--muted);
            margin-bottom: 0;
        }

        .manage-page .content-card,
        .manage-page .form-card {
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 24px;
            background: #fff;
        }

        .manage-page .form-card {
            position: sticky;
            top: 90px;
        }

        .manage-page .card-header {
            background: #ffffff;
            border-bottom: 1px solid var(--border);
            padding: 18px 22px;
        }

        .manage-page .card-title {
            font-weight: 700;
            color: var(--text);
            margin-bottom: 2px;
        }

        .manage-page .section-subtitle {
            color: var(--muted);
            font-size: 14px;
            margin-bottom: 0;
        }

        .manage-page .table thead th {
            border-top: none;
            border-bottom: 1px solid var(--border);
            color: #4b5563;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .03em;
            white-space: nowrap;
        }

        .manage-page .table tbody td {
            vertical-align: middle;
            border-color: #edf2f7;
            color: #374151;
        }

        .manage-page .btn {
            border-radius: 10px;
            font-weight: 600;
        }

        .manage-page .btn-icon {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .manage-page label {
            color: #374151;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .manage-page .form-control {
            border-radius: 10px;
            border-color: #d9e1ec;
            min-height: 44px;
        }

        .manage-page .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 .15rem rgba(13, 110, 253, .12);
        }

        .manage-page .upload-panel {
            border: 1px dashed #cbd5e1;
            background: #f8fafc;
            border-radius: 14px;
            padding: 16px;
            margin-bottom: 18px;
        }

        .manage-page .question-img {
            max-width: 90px;
            border-radius: 10px;
            border: 1px solid var(--border);
            padding: 5px;
            background: #fff;
        }

        .manage-page .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 18px;
        }

        .manage-page .empty-state {
            padding: 36px 18px;
            text-align: center;
            color: var(--muted);
        }

        .problem-summary {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 18px;
        }

        .summary-box {
            background: #f8fafc;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 14px 18px;
            min-width: 170px;
        }

        .summary-box h5 {
            margin: 0;
            font-weight: 800;
            color: #111827;
        }

        .summary-box span {
            font-size: 13px;
            color: var(--muted);
        }

        .issue-badge {
            display: inline-block;
            padding: 5px 8px;
            margin: 2px;
            border-radius: 8px;
            background: #fff1f2;
            color: #be123c;
            font-size: 12px;
            font-weight: 600;
            border: 1px solid #fecdd3;
        }

        .ok-badge {
            display: inline-block;
            padding: 5px 8px;
            border-radius: 8px;
            background: #ecfdf5;
            color: #047857;
            font-size: 12px;
            font-weight: 700;
            border: 1px solid #a7f3d0;
        }

        .problem-row {
            background: #fff7f7;
        }

        @media (max-width: 991px) {
            .manage-page .form-card {
                position: static;
            }
        }

        @media (max-width: 767px) {

            .manage-page .page-hero,
            .manage-page .card-header,
            .manage-page .form-card .card-body {
                padding: 18px;
            }

            .manage-page .form-actions {
                flex-direction: column;
            }

            .manage-page .form-actions .btn {
                width: 100%;
            }
        }
    </style>

    <div class="manage-page">
        <div class="page-hero">
            <h3>Round Two Questions</h3>
            <p>Manage question bank, options, answers, CSV import, and question-answer validation.</p>
        </div>

        @include('validate-main')

        <div class="problem-summary">
            <div class="summary-box">
                <h5>{{ count($question) }}</h5>
                <span>Total Questions</span>
            </div>

            <div class="summary-box">
                <h5>{{ $totalProblemQuestions }}</h5>
                <span>Questions With Problems</span>
            </div>

            <div class="summary-box">
                <h5>{{ count($question) - $totalProblemQuestions }}</h5>
                <span>Correct Questions</span>
            </div>
        </div>

        <div class="card content-card">
            <div class="card-header">
                <h4 class="card-title">Round 2 Category-wise Question Distribution</h4>
                <p class="section-subtitle">Shows how many questions are uploaded in each category and how many questions will be used in the exam.</p>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th class="text-center">Questions Uploaded</th>
                                <th class="text-center">Questions in Exam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $uploadedTotal = 0;
                                $examTotal = 0;
                            @endphp
                            @foreach($category as $cat)
                                @php
                                    $uploadedCount = $question->where('category_id', $cat->id)->count();
                                    $uploadedTotal += $uploadedCount;
                                    $examTotal += (int) $cat->question_size;
                                @endphp
                                <tr>
                                    <td>{{ $cat->category_name }}</td>
                                    <td class="text-center">{{ $uploadedCount }}</td>
                                    <td class="text-center">{{ $cat->question_size }}</td>
                                </tr>
                            @endforeach
                            <tr class="font-weight-bold">
                                <td>Total</td>
                                <td class="text-center">{{ $uploadedTotal }}</td>
                                <td class="text-center">{{ $examTotal }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card content-card">
                    <div class="card-header">
                        <form id="questionUploadFormTwo" action="{{ url('/add-question-from-excel-two') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="force_upload" id="forceUploadExcelTwo" value="0">

                            <div class="upload-panel">
                                <label for="questionExcelFileTwo">Excel Upload</label>
                                <div class="d-flex flex-wrap align-items-center" style="gap: 10px;">
                                    <input class="form-control form-control-sm" id="questionExcelFileTwo" type="file"
                                        accept=".csv,.xlsx,.xls" name="question_excel_file" style="max-width: 320px;">
                                    <button type="button" id="validateExcelButtonTwo" class="btn btn-sm btn-outline-primary">
                                        <i class="fa fa-check-circle mr-1"></i> Validate File
                                    </button>
                                    <button type="submit" id="uploadExcelButtonTwo" class="btn btn-sm btn-primary" disabled>
                                        <i class="fa fa-upload mr-1"></i> Upload
                                    </button>
                                    <button type="submit" id="uploadWithProblemsButtonTwo" class="btn btn-sm btn-warning" style="display: none;">
                                        <i class="fa fa-exclamation-triangle mr-1"></i> Upload With Problems
                                    </button>
                                    <a href="{{ route('question.export.round2') }}" class="btn btn-sm btn-outline-success">
                                        <i class="fa fa-download mr-1"></i> Export Questions
                                    </a>
                                    <a href="{{ route('question.export.round2.import.ready') }}" class="btn btn-sm btn-outline-info">
                                        <i class="fa fa-download mr-1"></i> Export Import Template
                                    </a>
                                </div>
                                <div id="excelValidationResultTwo" class="mt-3">
                                    @if(session('excel_validation_errors'))
                                        <div class="validation-message validation-error mb-0">
                                            <strong>Status: Validation failed.</strong><br>Please fix the following problems:
                                            <ul class="mb-0 mt-2 pl-3">
                                                @foreach(session('excel_validation_errors') as $excelError)
                                                    <li>
                                                        @if(!empty($excelError['row'])) Row {{ $excelError['row'] }}: @endif
                                                        {{ $excelError['message'] }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @else
                                        <div class="validation-message validation-neutral mb-0">Status: No file validated yet.</div>
                                    @endif
                                </div>
                            </div>
                        </form>

                        <h4 class="card-title">Question Bank</h4>
                        <p class="section-subtitle">Review, update, remove, and validate questions from this round.</p>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Question</th>
                                        <th>Option 1</th>
                                        <th>Option 2</th>
                                        <th>Option 3</th>
                                        <th>Option 4</th>
                                        <th>Answer</th>
                                        <th>Status</th>
                                        <th>Problems</th>

                                        @if ($form_type == 'create')
                                            <th>Created At</th>
                                        @endif

                                        @if ($form_type == 'edit')
                                            <th>Updated At</th>
                                        @endif

                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($question as $qa)
                                        @php
                                            $problems = checkRoundTwoQuestionProblems($qa);
                                            $options = json_decode($qa->option, true);

                                            if (!is_array($options)) {
                                                $options = [];
                                            }
                                        @endphp

                                        <tr class="{{ count($problems) > 0 ? 'problem-row' : '' }}">
                                            <td>{{ $loop->index + 1 }}</td>

                                            <td>
                                                @if ($qa->category_id == 3)
                                                    @if (!empty($qa->image_question))
                                                        <img class="question-img"
                                                            src="{{ asset('storage/questionTwo/' . $qa->image_question) }}"
                                                            alt="Question Image">
                                                    @else
                                                        <span class="text-danger">No Image</span>
                                                    @endif
                                                @else
                                                    {{ $qa->question }}
                                                @endif
                                            </td>

                                            @for ($i = 0; $i < 4; $i++)
                                                <td>{{ $options[$i] ?? 'Missing' }}</td>
                                            @endfor

                                            <td><strong>{{ $qa->answer }}</strong></td>

                                            <td>
                                                @if (count($problems) > 0)
                                                    <span class="issue-badge">Problem</span>
                                                @else
                                                    <span class="ok-badge">OK</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if (count($problems) > 0)
                                                    @foreach ($problems as $problem)
                                                        <span class="issue-badge">{{ $problem }}</span>
                                                    @endforeach
                                                @else
                                                    <span class="ok-badge">No issue</span>
                                                @endif
                                            </td>

                                            @if ($form_type == 'create')
                                                <td>{{ $qa->created_at->diffForHumans() }}</td>
                                            @endif

                                            @if ($form_type == 'edit')
                                                <td>{{ $qa->updated_at->diffForHumans() }}</td>
                                            @endif

                                            <td>
                                                <a class="btn btn-sm btn-warning btn-icon"
                                                    href="{{ route('question.edit.round2', $qa->id) }}">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </a>

                                                <a class="btn btn-sm btn-danger btn-icon delete-form"
                                                    href="{{ route('question.delete.round2', $qa->id) }}">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="empty-state" colspan="12">No Data Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-12">
                @if ($form_type == 'create')
                    <div class="card form-card">
                        <div class="card-header">
                            <h4 class="card-title">Add New Question</h4>
                            <p class="section-subtitle">Create a new question with four answer options.</p>
                        </div>

                        @include('validate')

                        <div class="card-body">
                            <form action="{{ route('question.store.round2') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Question Category</label>
                                    <select name="category_id" class="form-control" id="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach ($category as $key => $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group d-none" id="image_question_id">
                                    <label>Upload Image</label><br>
                                    <img style="max-width: 50%;" id="question-photo-preview" src="" alt="">
                                    <br>
                                    <input class="d-none" id="question-photo" name="image_question" type="file">
                                    <label for="question-photo">
                                        <img style="cursor: pointer;width: 50px !important" class="w-50"
                                            src="{{ asset('admin/assets/img/upload.gif') }}" alt="">
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>Question</label>
                                    <input name="question" type="text" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Option 1</label>
                                    <input id="option1" name="option[]" type="text" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Option 2</label>
                                    <input id="option2" name="option[]" type="text" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Option 3</label>
                                    <input id="option3" name="option[]" type="text" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Option 4</label>
                                    <input id="option4" name="option[]" type="text" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Answer</label>
                                    <select class="form-control" name="answer" id="answerSelect">
                                        <option value="">Select</option>
                                        <option id="answer1" value=""></option>
                                        <option id="answer2" value=""></option>
                                        <option id="answer3" value=""></option>
                                        <option id="answer4" value=""></option>
                                    </select>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-plus mr-1"></i> Add Question
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif

                @if ($form_type == 'edit')
                    <div class="card form-card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Question</h4>
                            <p class="section-subtitle">Update question, options, image, and answer.</p>
                        </div>

                        @include('validate')

                        <div class="card-body">
                            <form action="{{ route('question.update.round2', $edit->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Question Category</label>
                                    <select name="category_id" class="form-control" id="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach ($category as $key => $category)
                                            <option @if ($category->id == $edit->category_id) selected @endif
                                                value="{{ $category->id }}">
                                                {{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group d-none" id="image_question_id">
                                    <label>Upload Image</label><br>
                                    <img style="max-width: 50%;" id="question-photo-preview"
                                        src="{{ asset('storage/questionTwo/' . $edit->image_question) }}" alt="">
                                    <br>
                                    <input name="image_question" value="{{ $edit->image_question }}" type="hidden">
                                    <input class="d-none" id="question-photo" name="new_image_question" type="file">
                                    <label for="question-photo">
                                        <img style="cursor: pointer;width: 50px !important" class="w-50"
                                            src="{{ asset('admin/assets/img/upload.gif') }}" alt="">
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>Question</label>
                                    <input name="question" type="text" value="{{ $edit->question }}"
                                        class="form-control">
                                </div>

                                @foreach (json_decode($edit->option) as $key => $val)
                                    @php $index = $key + 1; @endphp

                                    <div class="form-group">
                                        <label>Option {{ $index }}</label>
                                        <input id="option{{ $index }}" name="option[]"
                                            value="{{ $val }}" type="text" class="form-control">
                                    </div>
                                @endforeach

                                <div class="form-group">
                                    <label>Answer</label>
                                    <select class="form-control" name="answer" id="answerSelect">
                                        <option value="">Select</option>

                                        @foreach (json_decode($edit->option) as $key => $val)
                                            @php $index = $key + 1; @endphp

                                            <option id="answer{{ $index }}"
                                                @if ($val == $edit->answer) selected @endif
                                                value="{{ $val }}">
                                                {{ $val }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-actions">
                                    <a class="btn btn-outline-info" href="{{ route('question.view.round2') }}">
                                        <i class="fa fa-arrow-left mr-1"></i> Back
                                    </a>

                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save mr-1"></i> Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        $(document).ready(function() {
            function toggleImageQuestion() {
                var type = $("#category_id").val();

                if (type == 3) {
                    $("#image_question_id").removeClass('d-none');
                } else {
                    $("#image_question_id").addClass('d-none');
                }
            }

            $("#category_id").on('change', function() {
                toggleImageQuestion();
            });

            toggleImageQuestion();

            function updateAnswerOptions() {
                for (let i = 1; i <= 4; i++) {
                    let optionValue = $("#option" + i).val();

                    $("#answer" + i)
                        .val(optionValue)
                        .text(optionValue ? optionValue : "Option " + i);
                }
            }

            $("#option1, #option2, #option3, #option4").on('keyup change', function() {
                updateAnswerOptions();
            });

            updateAnswerOptions();

            $("#question-photo").on('change', function() {
                const file = this.files[0];

                if (file) {
                    let reader = new FileReader();

                    reader.onload = function(event) {
                        $("#question-photo-preview").attr("src", event.target.result);
                    }

                    reader.readAsDataURL(file);
                }
            });

            function renderExcelValidationResult(response) {
                let html = '';

                if (response.success) {
                    html = '<div class="validation-message validation-success mb-0"><strong>Status: Validation passed.</strong><br>Total Questions: ' + response.total + '<br>No errors found. Upload button is now active.</div>';
                    $('#uploadExcelButtonTwo').prop('disabled', false);
                    $('#uploadWithProblemsButtonTwo').hide();
                    $('#forceUploadExcelTwo').val('0');
                } else {
                    html = '<div class="validation-message validation-error mb-0"><strong>Status: Validation failed.</strong><br>Please fix the following problems:<ul class="mb-0 mt-2 pl-3">';

                    if (response.errors && response.errors.length) {
                        response.errors.forEach(function(error) {
                            html += '<li>' + (error.row ? 'Row ' + error.row + ': ' : '') + error.message + '</li>';
                        });
                    } else {
                        html += '<li>Something is wrong. Please check the selected file.</li>';
                    }

                    html += '</ul></div>';
                    $('#uploadExcelButtonTwo').prop('disabled', true);
                    $('#uploadWithProblemsButtonTwo').show();
                }

                $('#excelValidationResultTwo').html(html);
            }

            $('#questionExcelFileTwo').on('change', function() {
                $('#uploadExcelButtonTwo').prop('disabled', true);
                $('#uploadWithProblemsButtonTwo').hide();
                $('#forceUploadExcelTwo').val('0');

                if (this.files.length) {
                    $('#excelValidationResultTwo').html('<div class="validation-message validation-neutral mb-0">Status: File selected. Please validate before upload.</div>');
                } else {
                    $('#excelValidationResultTwo').html('<div class="validation-message validation-neutral mb-0">Status: No file validated yet.</div>');
                }
            });

            $('#uploadWithProblemsButtonTwo').on('click', function() {
                $('#forceUploadExcelTwo').val('1');
                event.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Upload with validation problems?',
                    text: 'This will upload the file even though validation found problems.',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, continue',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#forceUploadExcel').val('1');
                        $('#questionUploadForm').submit();
                    }
                });
            });

            $('#uploadExcelButtonTwo').on('click', function() {
                $('#forceUploadExcelTwo').val('0');
            });

            $('#validateExcelButtonTwo').on('click', function() {
                let fileInput = document.getElementById('questionExcelFileTwo');

                if (!fileInput.files.length) {
                    $('#excelValidationResultTwo').html('<div class="validation-message validation-warning mb-0">Status: No file selected. Please choose an Excel file first.</div>');
                    $('#uploadExcelButtonTwo').prop('disabled', true);
                    $('#uploadWithProblemsButtonTwo').hide();
                    $('#forceUploadExcelTwo').val('0');
                    return;
                }

                let formData = new FormData();
                formData.append('_token', $('input[name="_token"]', '#questionUploadFormTwo').val());
                formData.append('question_excel_file', fileInput.files[0]);

                $('#validateExcelButtonTwo').prop('disabled', true).html('<i class="fa fa-spinner fa-spin mr-1"></i> Validating...');
                $('#excelValidationResultTwo').html('<div class="validation-message validation-info mb-0">Status: Validating file... Please wait.</div>');
                $('#uploadExcelButtonTwo').prop('disabled', true);
                $('#uploadWithProblemsButtonTwo').hide();
                $('#forceUploadExcelTwo').val('0');

                $.ajax({
                    url: '{{ route('question.excel.validate.round2') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        renderExcelValidationResult(response);
                    },
                    error: function(xhr) {
                        let response = xhr.responseJSON || {
                            success: false,
                            errors: [{ message: 'The file could not be validated. Please check the format.' }]
                        };
                        renderExcelValidationResult(response);
                    },
                    complete: function() {
                        $('#validateExcelButtonTwo').prop('disabled', false).html('<i class="fa fa-check-circle mr-1"></i> Validate File');
                    }
                });
            });
        });
    </script>
@endpush
