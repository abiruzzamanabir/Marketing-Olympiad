<?php

namespace App\Http\Controllers\Admin;

use App\Exports\RoundOneResult;
use App\Http\Controllers\Controller;
use App\Jobs\GenerateRoundOneCertificateMail;
use App\Imports\QuestionAnswerImport;
use App\Models\Admin;
use App\Models\AnswerdQuestion;
use App\Models\Category;
use App\Models\ExamControl;
use App\Models\QuestionAnswer;
use App\Models\Theme;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class QuestionAnswerController extends Controller
{
    public function index()
    {
        $QA = QuestionAnswer::where(['status' => 1, 'is_archive' => 0])->get();
        $category = Category::where(['status' => 1, 'is_archive' => 0])->get();
        return view('admin.pages.questions.index', [
            'question' => $QA,
            'category' => $category,
            'form_type' => 'create',
        ]);
    }
    public function result()
    {
        $result = Admin::where('id', Auth::guard('admin')->user()->id)->get();
        return view('admin.pages.result.index', [
            'result' => $result,
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            //            'question' => 'required',
            'option' => 'required',
            'answer' => 'required'
        ]);
        if (empty($request->question) && empty($request->image_question)) {
            return back()->with('error', 'Please Add Question First');
        }

        $question = new QuestionAnswer();
        $question->category_id = $request->category_id;
        $question->question = $request->question;
        $question->option =  json_encode($request->option);
        $question->answer = $request->answer;
        if ($request->hasFile('image_question')) {
            $img = $request->file('image_question');
            $question_image = bin2hex(random_bytes(16)) . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $filePath = "app/public/question";
            if (!file_exists(storage_path($filePath))) {
                mkdir(storage_path($filePath), 0755, true);
            }

            $inter->save(storage_path('app/public/question/') . $question_image);
            $question->image_question = $question_image;
        }
        $question->status = 1;

        $question->save();
        return back()->with('success', 'Question added successfully');
    }
    public function edit($id)
    {
        $QA = QuestionAnswer::get();
        $qno = QuestionAnswer::findOrFail($id);
        $category = Category::where(['status' => 1, 'is_archive' => 0])->get();
        return view('admin.pages.questions.index', [
            'question' => $QA,
            'edit'  => $qno,
            'category' => $category,
            'form_type' => 'edit',
        ]);
    }
    public function update(Request $request, $id)
    {
        $update_data = QuestionAnswer::findOrFail($id);
        if ($request->hasFile('new_image_question')) {
            $img = $request->file('new_image_question');
            $file_name = bin2hex(random_bytes(16)) . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $inter->save(storage_path('app/public/question/') . $file_name);
        } else {
            $file_name = $request->image_question;
        }
        $update_data->update([
            'question' => $request->question,
            'option' => json_encode($request->option),
            'answer' => $request->answer,
            'category_id' => $request->category_id,
            'image_question' => $file_name,
        ]);
        return back()->with('success', 'Question updated successfully');
    }
    public function round1()
    {
        $admin = Auth::guard('admin')->user();

        if ($admin->round_one_status) {
            return redirect()->route('home.page')
                ->with('danger-front', 'You have already attempted this round.');
        }

        $examTime = ExamControl::first();

        if (!$examTime) {
            return redirect()->route('home.page')
                ->with('danger-front', 'Exam time is not configured.');
        }

        $categories = Category::where('status', 1)
            ->where('is_archive', 0)
            ->get(['id', 'question_size']);

        $questions = $categories->flatMap(function ($category) {
            return QuestionAnswer::where('category_id', $category->id)
                ->where('status', 1)
                ->where('is_archive', 0)
                ->inRandomOrder()
                ->limit($category->question_size)
                ->get();
        })->values();

        $admin->update([
            'round_one_status' => true,
        ]);

        return view('admin.pages.questions.round1', [
            'question' => $questions,
            'minute' => $examTime->minutes ?: 0,
            'seconds' => $examTime->seconds ?: 20,
        ]);
    }
    public function round1store(Request $request)
    {
        $request->validate([
            'question' => 'required|array',
            'answer' => 'nullable|array',
            'category_id' => 'nullable|array',
            'duration' => 'nullable',
            'is_disqualified' => 'nullable',
            'disqualification_reason' => 'nullable|string|max:255',
        ]);

        $userId = Auth::guard('admin')->id();
        $questionIds = collect($request->input('question', []))->filter()->values();
        $answers = $request->input('answer', []);
        $categoryIds = $request->input('category_id', []);

        try {
            DB::transaction(function () use ($questionIds, $answers, $categoryIds, $request, $userId) {
                $now = now();

                foreach ($questionIds as $key => $questionId) {
                    $answerValue = $answers[$key] ?? '';

                    AnswerdQuestion::updateOrInsert(
                        [
                            'user_id' => $userId,
                            'question_id' => $questionId,
                        ],
                        [
                            'category_id' => $categoryIds[$key] ?? null,
                            'answer' => $answerValue,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ]
                    );
                }

                $resultCounter = $this->roundOneSavedResult($userId);

                Admin::where('id', $userId)->update([
                    'round_one_status' => true,
                    'round_one_result' => $resultCounter,
                    'duration' => $request->duration,
                ]);
            });

            $student = Admin::findOrFail($userId);

            try {
                // Certificate PDF generation and mail sending are intentionally
                // moved out of the submit response. The student should see
                // result and duration immediately after clicking Submit.
                $certificateJob = GenerateRoundOneCertificateMail::dispatch($student->id);

                if (method_exists($certificateJob, 'afterResponse')) {
                    $certificateJob->afterResponse();
                }
            } catch (\Throwable $mailException) {
                Log::error('Round 1 participation certificate job dispatch failed', [
                    'user_id' => $student->id,
                    'email' => $student->email,
                    'message' => $mailException->getMessage(),
                    'file' => $mailException->getFile(),
                    'line' => $mailException->getLine(),
                ]);
            }

            $isDisqualified = (bool) $request->input('is_disqualified', false);
            $reason = $request->input('disqualification_reason') ?: 'Leaving the exam window or changing tabs multiple times.';

            return redirect()->route('exam.congratulations', [
                'round' => 1,
                'status' => $isDisqualified ? 'disqualified' : 'submitted',
                'correctAnswers' => $student->round_one_result,
                'totalSubmitted' => AnswerdQuestion::where('user_id', $userId)->count(),
                'duration' => $request->duration,
                'reason' => $isDisqualified ? $reason : null,
            ])->with('success-main', $isDisqualified ? 'Exam submitted after disqualification' : 'Answer Script successfully Submitted');
        } catch (\Throwable $e) {
            Log::error('Answer Script Failed To Submit', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return redirect()->route('home.page')
                ->with('danger-main', 'Answer Script Failed To Submit');
        }
    }

    public function round1Autosave(Request $request)
    {
        $request->validate([
            'question_id' => 'required|integer',
            'category_id' => 'nullable|integer',
            'answer' => 'required',
            'duration' => 'nullable',
        ]);

        $userId = Auth::guard('admin')->id();
        $question = QuestionAnswer::where('id', $request->question_id)
            ->where('status', 1)
            ->where('is_archive', 0)
            ->firstOrFail();

        DB::transaction(function () use ($request, $userId, $question) {
            $now = now();

            AnswerdQuestion::updateOrInsert(
                [
                    'user_id' => $userId,
                    'question_id' => $question->id,
                ],
                [
                    'category_id' => $request->category_id ?: $question->category_id,
                    'answer' => $request->answer,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );

            Admin::where('id', $userId)->update([
                'round_one_status' => true,
                'round_one_result' => $this->roundOneSavedResult($userId),
                'duration' => $request->duration,
            ]);
        });

        return response()->json([
            'success' => true,
            'saved_answers' => AnswerdQuestion::where('user_id', $userId)->count(),
            'result' => Admin::where('id', $userId)->value('round_one_result'),
        ]);
    }

    private function roundOneSavedResult($userId)
    {
        return DB::table('answerd_questions')
            ->join('question_answers', 'question_answers.id', '=', 'answerd_questions.question_id')
            ->where('answerd_questions.user_id', $userId)
            ->whereColumn('answerd_questions.answer', 'question_answers.answer')
            ->count();
    }

    private function questionExportRows($importTemplate = false)
    {
        $categories = Category::pluck('category_name', 'id')->toArray();

        $rows = QuestionAnswer::orderBy('id')->get()->map(function ($question) use ($categories, $importTemplate) {
            $options = json_decode($question->option, true);

            if (!is_array($options)) {
                $options = [];
            }

            $options = array_values($options);

            if ($importTemplate) {
                return [
                    'Category ID' => $question->category_id,
                    'Category' => $categories[$question->category_id] ?? $question->category_id,
                    'Question' => $question->question,
                    'Image Question' => $question->image_question,
                    'Option 1' => $options[0] ?? '',
                    'Option 2' => $options[1] ?? '',
                    'Option 3' => $options[2] ?? '',
                    'Option 4' => $options[3] ?? '',
                    'Answer' => $question->answer,
                    'Status' => ((int) $question->status === 1) ? 'Active' : 'Inactive',
                    'Archive Status' => ((int) $question->is_archive === 1) ? 'Yes' : 'No',
                ];
            }

            return [
                'ID' => $question->id,
                'Category' => $categories[$question->category_id] ?? $question->category_id,
                'Question' => $question->question,
                'Image Question' => $question->image_question,
                'Option 1' => $options[0] ?? '',
                'Option 2' => $options[1] ?? '',
                'Option 3' => $options[2] ?? '',
                'Option 4' => $options[3] ?? '',
                'Answer' => $question->answer,
                'Status' => ((int) $question->status === 1) ? 'Active' : 'Inactive',
                'Archive Status' => ((int) $question->is_archive === 1) ? 'Yes' : 'No',
                'Created At' => optional($question->created_at)->format('Y-m-d H:i:s'),
                'Updated At' => optional($question->updated_at)->format('Y-m-d H:i:s'),
            ];
        })->toArray();

        if ($importTemplate) {
            array_unshift($rows, [
                'Category ID',
                'Category',
                'Question',
                'Image Question',
                'Option 1',
                'Option 2',
                'Option 3',
                'Option 4',
                'Answer',
                'Status',
                'Archive Status',
            ]);

            return $rows;
        }

        array_unshift($rows, [
            'ID',
            'Category',
            'Question',
            'Image Question',
            'Option 1',
            'Option 2',
            'Option 3',
            'Option 4',
            'Answer',
            'Status',
            'Archive Status',
            'Created At',
            'Updated At',
        ]);

        return $rows;
    }

    public function exportQuestions()
    {
        return Excel::download(new class($this->questionExportRows()) implements FromArray {
            private $rows;

            public function __construct(array $rows)
            {
                $this->rows = $rows;
            }

            public function array(): array
            {
                return $this->rows;
            }
        }, 'round-one-questions.xlsx');
    }

    public function exportQuestionsImportReady()
    {
        return Excel::download(new class($this->questionExportRows(true)) implements FromArray {
            private $rows;

            public function __construct(array $rows)
            {
                $this->rows = $rows;
            }

            public function array(): array
            {
                return $this->rows;
            }
        }, 'round-one-questions-import-template.xlsx');
    }


    private function readQuestionExcelRows($file)
    {
        $sheets = Excel::toArray(new class implements ToArray, WithHeadingRow {
            public function array(array $array)
            {
                return $array;
            }
        }, $file);

        return $sheets[0] ?? [];
    }

    private function validateQuestionExcelRows(array $rows, $categoryModel, $questionModel)
    {
        $errors = [];
        $totalRows = 0;
        $seenQuestions = [];
        $existingCategoryIds = $categoryModel::pluck('id')->map(function ($id) {
            return (int) $id;
        })->toArray();

        foreach ($rows as $index => $row) {
            $rowNumber = $index + 2;
            $row = is_array($row) ? $row : [];

            $categoryId = $this->cleanExcelValue($row['category_id'] ?? $row['category'] ?? '');
            $question = $this->cleanExcelValue($row['question'] ?? '');
            $options = [
                $this->cleanExcelValue($row['option1'] ?? $row['option_1'] ?? ''),
                $this->cleanExcelValue($row['option2'] ?? $row['option_2'] ?? ''),
                $this->cleanExcelValue($row['option3'] ?? $row['option_3'] ?? ''),
                $this->cleanExcelValue($row['option4'] ?? $row['option_4'] ?? ''),
            ];
            $answer = $this->cleanExcelValue($row['answer'] ?? '');

            if ($categoryId === '' && $question === '' && implode('', $options) === '' && $answer === '') {
                continue;
            }

            $totalRows++;

            if ($categoryId === '') {
                $errors[] = ['row' => $rowNumber, 'message' => 'Category ID is required.'];
            } elseif (!is_numeric($categoryId) || !in_array((int) $categoryId, $existingCategoryIds, true)) {
                $errors[] = ['row' => $rowNumber, 'message' => 'Category ID "' . $categoryId . '" does not exist.'];
            }

            if ($question === '') {
                $errors[] = ['row' => $rowNumber, 'message' => 'Question cannot be empty.'];
            } else {
                // Same question text can be used with a different answer.
                // Count duplicate only when both question and answer are the same.
                $questionKey = mb_strtolower($question) . '|' . mb_strtolower($answer);

                if ($answer !== '' && isset($seenQuestions[$questionKey])) {
                    $errors[] = [
                        'row' => $rowNumber,
                        'message' => 'Duplicate question with the same answer found in this Excel file. Same as row ' . $seenQuestions[$questionKey] . '.',
                    ];
                }

                if ($answer !== '' && !isset($seenQuestions[$questionKey])) {
                    $seenQuestions[$questionKey] = $rowNumber;
                }

                if ($answer !== '' && $questionModel::where('question', $question)->where('answer', $answer)->exists()) {
                    $errors[] = ['row' => $rowNumber, 'message' => 'This question with the same answer already exists in the question bank.'];
                }
            }

            foreach ($options as $optionIndex => $optionValue) {
                if ($optionValue === '') {
                    $errors[] = ['row' => $rowNumber, 'message' => 'Option ' . ($optionIndex + 1) . ' cannot be empty.'];
                }
            }

            if ($answer === '') {
                $errors[] = ['row' => $rowNumber, 'message' => 'Answer cannot be empty.'];
            } elseif (!in_array($answer, $options, true)) {
                $errors[] = ['row' => $rowNumber, 'message' => 'Answer must match one of the four options exactly.'];
            }
        }

        if ($totalRows === 0) {
            $errors[] = ['row' => null, 'message' => 'No question rows found in the selected file.'];
        }

        return [
            'success' => count($errors) === 0,
            'total' => $totalRows,
            'errors' => $errors,
        ];
    }


    private function cleanExcelValue($value)
    {
        if ($value === null) {
            return '';
        }

        $value = (string) $value;
        $value = str_replace("\xC2\xA0", ' ', $value);
        $value = preg_replace('/\s+/u', ' ', $value);

        return trim($value);
    }

    public function validateQuestionExcel(Request $request)
    {
        $request->validate([
            'question_excel_file' => 'required|file|mimes:xlsx,xls,csv|max:5120',
        ]);

        try {
            $validation = $this->validateQuestionExcelRows(
                $this->readQuestionExcelRows($request->file('question_excel_file')),
                Category::class,
                QuestionAnswer::class
            );

            return response()->json($validation);
        } catch (\Throwable $e) {
            Log::error('Excel Validation Error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json([
                'success' => false,
                'total' => 0,
                'errors' => [
                    ['row' => null, 'message' => 'The file could not be read. Please check the Excel format.'],
                ],
            ], 422);
        }
    }

    public function importQuestionFromExcel(Request $request)
    {
        $request->validate([
            'question_excel_file' => 'required|file|mimes:xlsx,xls,csv|max:5120',
        ]);

        try {
            $validation = $this->validateQuestionExcelRows(
                $this->readQuestionExcelRows($request->file('question_excel_file')),
                Category::class,
                QuestionAnswer::class
            );

            if (!$validation['success'] && !$request->boolean('force_upload')) {
                return redirect('/add-question')
                    ->with('danger-main', 'Please fix the Excel errors before uploading, or use Upload With Problems if you still want to continue.')
                    ->with('excel_validation_errors', $validation['errors']);
            }

            Excel::import(new QuestionAnswerImport, $request->file('question_excel_file'));

            return redirect('/add-question')
                ->with('success-main', 'Question Uploaded Successfully!');
        } catch (\Throwable $e) {
            Log::error('Excel Data Save Error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return redirect('/add-question')
                ->with('danger-main', 'Something is wrong. Please check log file.');
        }
    }

    private function getCertificateViewData($user)
    {
        $theme = Theme::find(1);

        $logo = public_path('storage/logo/logo.png');
        $partnerPanel = public_path('storage/logo/logo_panel_8.png');

        if ($theme && !empty($theme->logo)) {
            $themeLogo = public_path('storage/logo/' . $theme->logo);

            if (file_exists($themeLogo)) {
                $logo = $themeLogo;
            }
        }

        if ($theme && !empty($theme->logo_panel)) {
            $themeLogoPanel = public_path('storage/logo/' . $theme->logo_panel);

            if (file_exists($themeLogoPanel)) {
                $partnerPanel = $themeLogoPanel;
            }
        }

        return [
            'name' => trim($user->first_name . ' ' . $user->last_name),
            'logo' => $logo,
            'partnerPanel' => $partnerPanel,
            'signatureLeft' => public_path('storage/logo/signature-left.png'),
            'signatureRight' => public_path('storage/logo/signature-right.png'),
        ];
    }

    private function makeCertificatePdf($data)
    {
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'orientation' => 'L',
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0,
            'tempDir' => storage_path('app/mpdf-temp'),
        ]);

        $mpdf->SetFont('montserrat');
        $mpdf->SetCompression(true);
        $mpdf->showImageErrors = true;

        $watermarkPath = public_path('storage/logo/logo_without_text.png');

        if (file_exists($watermarkPath)) {
            $mpdf->SetWatermarkImage(
                $watermarkPath,
                0.15,
                -80,
                array(5, -100)
            );
            $mpdf->showWatermarkImage = true;
            $mpdf->SetWatermarkText('', 0.4);
            $mpdf->SetFillColor(255, 255, 255, 0.95);
        }


        $content = view('admin.mail.certificate', $data)->render();

        $mpdf->WriteHTML($content);

        return $mpdf;
    }

    private function certificateFileName($name, $userId)
    {
        $safeName = preg_replace('/[^A-Za-z0-9_\- ]/', '', $name);

        return $safeName . ' Marketing Olympiad Certificate ' . $userId . '.pdf';
    }

    private function generateCertificateFile($user)
    {
        $data = $this->getCertificateViewData($user);
        $fileName = $this->certificateFileName($data['name'], $user->id);
        $attachmentDir = public_path('attachments');

        if (!file_exists($attachmentDir)) {
            mkdir($attachmentDir, 0755, true);
        }

        $filePath = $attachmentDir . DIRECTORY_SEPARATOR . $fileName;

        $mpdf = $this->makeCertificatePdf($data);
        $mpdf->Output($filePath, 'F');

        Admin::where('id', $user->id)->update([
            'certificate' => $fileName,
        ]);

        return [$filePath, $fileName, $data];
    }

    private function sendParticipationCertificateMail($user)
    {
        if (!$user || empty($user->email)) {
            return;
        }

        [$filePath, $fileName, $data] = $this->generateCertificateFile($user);

        $year = now()->format('Y');
        $mailData = [
            'email' => $user->email,
            'title' => 'Certificate of Participation | Marketing Olympiad ' . $year,
            'body' => 'Thank you for participating in Round 1 of Marketing Olympiad. Your Certificate of Participation is attached with this email.',
            'name' => $data['name'],
        ];

        Mail::send('admin.mail.mailbody', $mailData, function ($message) use ($mailData, $filePath, $fileName) {
            $message->to($mailData['email'])
                ->subject($mailData['title'])
                ->attach($filePath, [
                    'as' => $fileName,
                    'mime' => 'application/pdf',
                ]);
        });
    }

    public function getCertificate()
    {
        return $this->downloadCertificate();
    }
    // public function downloadCertificate()
    // {
    //     $name = Auth::guard('admin')->user()->first_name . ' ' . Auth::guard('admin')->user()->last_name;
    //     $file_name = $name . ' ' . 'Marketing Olympiad' . ' ' . 'Certificate' . Auth::guard('admin')->user()->id . '.pdf';


    //     $filePath = public_path('attachments/' . Auth::guard('admin')->user()->certificate);
    //     $headers = [
    //         'Content-Type' => 'application/pdf',
    //     ];
    //     return response()->download($filePath, $file_name, $headers);
    // }
    public function downloadCertificate()
    {
        ini_set('max_execution_time', 120);

        $user = Auth::guard('admin')->user();

        if (!$user) {
            abort(403);
        }

        $data = $this->getCertificateViewData($user);
        $fileName = $this->certificateFileName($data['name'], $user->id);

        $mpdf = $this->makeCertificatePdf($data);

        return response($mpdf->Output($fileName, 'S'), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }
    public function destroy($id)
    {
        $delete_id = QuestionAnswer::findOrFail($id);
        $delete_id->delete();
        return back()->with('success-main', 'Question Deleted successfully');
    }
}
