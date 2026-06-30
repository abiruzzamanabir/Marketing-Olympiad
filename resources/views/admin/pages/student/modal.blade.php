<style>
    .student-detail-modal .modal-content {
        border: 0;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.18);
    }

    .student-detail-modal .modal-header {
        border-bottom: 1px solid #e7edf5;
        background: #ffffff;
        padding: 18px 22px;
    }

    .student-detail-modal .modal-title {
        font-weight: 700;
        color: #1f2937;
    }

    .student-detail-modal .modal-body {
        padding: 22px;
    }

    .student-detail-modal .profile-photo {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #ffffff;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.15);
    }

    .student-detail-modal label {
        font-weight: 700;
        color: #374151;
        margin-bottom: 7px;
    }

    .student-detail-modal .form-control {
        border-radius: 10px;
        border-color: #d9e1ec;
        min-height: 42px;
        background: #f9fafb;
    }

    .student-detail-modal .document-card {
        border: 1px solid #e7edf5;
        border-radius: 14px;
        padding: 14px;
        background: #fbfdff;
        margin-bottom: 16px;
    }

    .student-detail-modal .document-card img {
        max-width: 100%;
        border-radius: 12px;
        border: 1px solid #e7edf5;
        padding: 8px;
        background: #ffffff;
        margin: 8px 0;
    }

    .student-detail-modal .section-title {
        font-size: 15px;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 12px;
        padding-bottom: 8px;
        border-bottom: 1px solid #e7edf5;
    }

    .answer-action-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 6px;
    }

    .answer-count-card {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 1px solid #d7eadc;
        background: #f3fbf5;
        border-radius: 8px;
        padding: 8px 12px;
        min-height: 34px;
    }

    .answer-count-card span {
        color: #2f6b3f;
        font-weight: 700;
        font-size: 12px;
    }

    .answer-count-card strong {
        color: #168232;
        font-size: 14px;
    }

    .answer-sheet-modal {
        z-index: 1065;
    }

    .answer-sheet-modal .modal-dialog {
        max-width: 1100px;
    }

    .answer-sheet-modal .modal-content {
        border: 0;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.22);
    }

    .answer-sheet-modal .modal-header {
        border-bottom: 1px solid #e7edf5;
    }

    .answer-sheet-modal .round-summary-card {
        border: 1px solid #e7edf5;
        border-radius: 12px;
        padding: 12px 14px;
        background: #fbfdff;
        margin-bottom: 14px;
    }

    .answer-sheet-modal .table th,
    .answer-sheet-modal .table td {
        vertical-align: middle;
    }
</style>

@php
    $roundOneDuration = (int) ($user->duration ?? 0);
    $roundTwoDuration = (int) ($user->durationTwo ?? ($user->duration2 ?? 0));

    $roundOneDurationText =
        $roundOneDuration > 0 ? floor($roundOneDuration / 60) . ' min ' . $roundOneDuration % 60 . ' sec' : '';

    $roundTwoDurationText =
        $roundTwoDuration > 0 ? floor($roundTwoDuration / 60) . ' min ' . $roundTwoDuration % 60 . ' sec' : '';
@endphp

<div class="modal fade student-detail-modal" id="view_student_details{{ $user->id }}" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Student Details: <span class="text-primary">{{ $user->first_name ?? '' }}
                        {{ $user->last_name ?? '' }}</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="text-center mt-4">
                <img class="profile-photo" alt="User Image" src="{{ asset('storage/admins/' . $user->photo) }}">
            </div>

            <div class="modal-body">
                <div class="student-readonly-details">
                    <h5 class="section-title">Personal Information</h5>

                    <div class="row form-row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input name="first_name" type="text" class="form-control"
                                    value="{{ $user->first_name ?? '' }}" readonly>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input name="last_name" type="text" class="form-control"
                                    value="{{ $user->last_name ?? '' }}" readonly>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label>University Name</label>
                                <input name="bio" type="text" class="form-control"
                                    value="{{ $user->uniname ?? '' }}" readonly>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <input name="dob" type="date" class="form-control" value="{{ $user->dob ?? '' }}"
                                    readonly>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Gender</label>
                                <input name="gender" type="text" class="form-control"
                                    value="{{ $user->gender ?? '' }}" readonly>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Mobile</label>
                                <input name="cell" type="text" value="{{ $user->cell ?? '' }}"
                                    class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col-12 col-sm-7">
                            <div class="form-group">
                                <label>Email ID</label>
                                <input name="email" type="email" class="form-control"
                                    value="{{ $user->email ?? '' }}" readonly>
                            </div>
                        </div>

                        <div class="col-12 col-sm-5">
                            <div class="form-group">
                                <label>Student ID Number</label>
                                <input name="stuid" type="text" class="form-control"
                                    value="{{ $user->stuid ?? '' }}" readonly>
                            </div>
                        </div>
                    </div>

                    <h5 class="section-title mt-3">Documents</h5>

                    <div class="document-card">
                        <label>NID / Passport / Birth Certificate (<span
                                class="text-danger">{{ $user->nid ?? '' }}</span>)</label>

                        @if ($user->status)
                            @if (Auth::guard('admin')->user()->role->name == 'Super Admin')
                                <a class="ml-2" href="{{ route('student.status.update', $user->id) }}"><span
                                        class="badge badge-success">Verified</span></a>
                            @endif
                        @else
                            @if (Auth::guard('admin')->user()->role->name == 'Super Admin')
                                <a class="ml-2" href="{{ route('student.status.update', $user->id) }}"><span
                                        class="badge badge-danger">Unverified</span></a>
                            @endif
                        @endif

                        <div class="text-center">
                            @if (!empty($user->nidphotofront))
                                <img alt="User NID Front"
                                    src="{{ asset('storage/studentNidFront/' . $user->nidphotofront) }}">
                            @else
                                <p class="text-muted mb-0">No NID / Passport / Birth Certificate image found.</p>
                            @endif

                            @if (!empty($user->nidphotoback))
                                <img alt="User NID Back"
                                    src="{{ asset('storage/studentNidBack/' . $user->nidphotoback) }}">
                            @endif
                        </div>
                    </div>

                    <div class="document-card">
                        <label>Student ID (<span class="text-danger">{{ $user->stuid ?? '' }}</span>)</label>

                        <div class="text-center">
                            @if (!empty($user->stuphotofront))
                                <img alt="User Student ID Front"
                                    src="{{ asset('storage/studentSidFront/' . $user->stuphotofront) }}">
                            @else
                                <p class="text-muted mb-0">No Student ID image found.</p>
                            @endif

                            @if (!empty($user->stuphotoback))
                                <img alt="User Student ID Back"
                                    src="{{ asset('storage/studentSidBack/' . $user->stuphotoback) }}">
                            @endif
                        </div>
                    </div>

                    <h5 class="section-title mt-3">Address & Exam Information</h5>

                    <div class="row form-row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Address</label>
                                <input name="address" type="text" class="form-control"
                                    value="{{ $user->address ?? '' }}" readonly>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>City</label>
                                <input name="city" type="text" class="form-control"
                                    value="{{ $user->city ?? '' }}" readonly>
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label>State</label>
                                <input name="state" type="text" class="form-control"
                                    value="{{ $user->state ?? '' }}" readonly>
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label>Zip</label>
                                <input name="zip" type="text" class="form-control"
                                    value="{{ $user->zip ?? '' }}" readonly>
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label>Country</label>
                                <input name="country" type="text" class="form-control"
                                    value="{{ $user->country ?? '' }}" readonly>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Round 1 Result</label>
                                <input type="text" class="form-control"
                                    value="{{ $user->round_one_result ?? '' }}/{{ $exam->question_qty ?? 40 }}" readonly>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Round 2 Result</label>
                                <input type="text" class="form-control"
                                    value="{{ $user->round_two_result ?? '' }}/{{ $exam->question_qty ?? 40 }}" readonly>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            @php
                                $roundOneCorrect = is_numeric($user->round_one_result ?? null)
                                    ? (int) $user->round_one_result
                                    : (isset($roundOneAnswers)
                                        ? $roundOneAnswers->where('is_correct', true)->count()
                                        : 0);

                                $roundTwoCorrect = is_numeric($user->round_two_result ?? null)
                                    ? (int) $user->round_two_result
                                    : (isset($roundTwoAnswers)
                                        ? $roundTwoAnswers->where('is_correct', true)->count()
                                        : 0);

                                $roundTotal = $exam->question_qty ?? 40;
                            @endphp

                            <div class="answer-action-row">
                                <button class="btn btn-sm btn-info" type="button" data-toggle="modal"
                                    data-target="#answer_sheet_modal_{{ $user->id }}">
                                    <i class="fa fa-list mr-1"></i> Show Question & Answer
                                </button>

                                <div class="answer-count-card">
                                    <span>Round 1 Correct</span>
                                    <strong>{{ $roundOneCorrect }}/{{ $roundTotal }}</strong>
                                </div>

                                <div class="answer-count-card">
                                    <span>Round 2 Correct</span>
                                    <strong>{{ $roundTwoCorrect }}/{{ $roundTotal }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Round 1 Duration</label>
                                <input type="text" class="form-control" value="{{ $roundOneDurationText }}"
                                    readonly>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Round 2 Duration</label>
                                <input type="text" class="form-control" value="{{ $roundTwoDurationText }}"
                                    readonly>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label>Last Login IP</label>
                                <input type="text" class="form-control" value="{{ $user->last_login_ip ?? '' }}"
                                    readonly>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <a class="btn btn-sm btn-warning" href="{{ route('student.ban', $user->id) }}">
                            <i class="fa fa-ban mr-1" aria-hidden="true"></i> Ban
                        </a>
                        <a class="btn btn-sm btn-danger" href="{{ route('student.trash.update', $user->id) }}">
                            <i class="fa fa-trash mr-1" aria-hidden="true"></i> Trash
                        </a>
                    </div>

                    <div class="document-card mt-4">
                        <h5 class="section-title">Retake Control</h5>
                        <p class="text-muted mb-3">Reset a round to allow this student to participate again. This will set the round status to false and delete that round's previous answer sheet from the database.</p>

                        <div class="d-flex flex-wrap justify-content-center" style="gap: 10px;">
                            <form action="{{ route('student.reset.round.one', $user->id) }}" method="POST" class="retake-reset-form" data-round="Round 1">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">Reset Round 1</button>
                            </form>

                            <form action="{{ route('student.reset.round.two', $user->id) }}" method="POST" class="retake-reset-form" data-round="Round 2">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">Reset Round 2</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade answer-sheet-modal" id="answer_sheet_modal_{{ $user->id }}" aria-hidden="true"
    role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Question & Answer Sheet: <span
                        class="text-primary">{{ $user->first_name ?? '' }} {{ $user->last_name ?? '' }}</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="round-summary-card">
                            <strong>Round 1</strong><br>
                            Result: {{ $user->round_one_result ?? '' }}/{{ $exam->question_qty ?? 40 }}
                            <span class="badge badge-success ml-2">Correct: {{ $roundOneCorrect }}</span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="round-summary-card">
                            <strong>Round 2</strong><br>
                            Result: {{ $user->round_two_result ?? '' }}/{{ $exam->question_qty ?? 40 }}
                            <span class="badge badge-success ml-2">Correct: {{ $roundTwoCorrect }}</span>
                        </div>
                    </div>
                </div>

                <h6 class="font-weight-bold mt-2">Round 1 Question & Answer</h6>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Question</th>
                                <th>Given Answer</th>
                                <th>Correct Answer</th>
                                <th style="width: 90px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(($roundOneAnswers ?? collect()) as $answer)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $answer['question'] }}
                                        @if (!empty($answer['image_question']))
                                            <br><a href="{{ asset('storage/question/' . $answer['image_question']) }}"
                                                target="_blank">View Image</a>
                                        @endif
                                    </td>
                                    <td>{{ $answer['given_answer'] }}</td>
                                    <td>{{ $answer['correct_answer'] }}</td>
                                    <td>
                                        @if ($answer['is_correct'])
                                            <span class="badge badge-success">Correct</span>
                                        @else
                                            <span class="badge badge-danger">Wrong</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Round 1 answer found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <h6 class="font-weight-bold">Round 2 Question & Answer</h6>
                <div class="table-responsive mb-2">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Question</th>
                                <th>Given Answer</th>
                                <th>Correct Answer</th>
                                <th style="width: 90px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(($roundTwoAnswers ?? collect()) as $answer)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $answer['question'] }}
                                        @if (!empty($answer['image_question']))
                                            <br><a
                                                href="{{ asset('storage/questionTwo/' . $answer['image_question']) }}"
                                                target="_blank">View Image</a>
                                        @endif
                                    </td>
                                    <td>{{ $answer['given_answer'] }}</td>
                                    <td>{{ $answer['correct_answer'] }}</td>
                                    <td>
                                        @if ($answer['is_correct'])
                                            <span class="badge badge-success">Correct</span>
                                        @else
                                            <span class="badge badge-danger">Wrong</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Round 2 answer found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@once
    <script id="retake-reset-form-handler">
        $(document).on('submit', '.retake-reset-form', function(event) {
            event.preventDefault();
            const form = this;
            const round = $(form).data('round') || 'this round';

            Swal.fire({
                icon: 'warning',
                title: 'Reset ' + round + '?',
                text: 'The round status will be set to false and previous answers will be deleted from the database.',
                showCancelButton: true,
                confirmButtonText: 'Yes, reset',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endonce
