<?php

namespace App\Http\Controllers\Admin;

use App\Models\CategoryTwo;
use Illuminate\Http\Request;
use App\Models\QuestionAnswerTwo;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Intervention\Image\Facades\Image;
use App\Imports\QuestionAnswerImportTwo;
use App\Models\Admin;
use App\Models\AnswerdQuestionTwo;
use App\Models\ExamControl;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuestionAnswerControllerTwo extends Controller
{
    public function index()
    {
        $QA = QuestionAnswerTwo::where(['status' => 1, 'is_archive' => 0])->get();
        $category = CategoryTwo::where(['status' => 1, 'is_archive' => 0])->get();
        return view('admin.pages.questionsRoundTwo.index', [
            'question' => $QA,
            'category' => $category,
            'form_type' => 'create',

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

        $question = new QuestionAnswerTwo();
        $question->category_id = $request->category_id;
        $question->question = $request->question;
        $question->option =  json_encode($request->option);
        $question->answer = $request->answer;
        if ($request->hasFile('image_question')) {
            $img = $request->file('image_question');
            $question_image = md5(time() . rand()) . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $filePath = "app/public/questionTwo";
            if (!file_exists(storage_path($filePath))) {
                mkdir(storage_path($filePath), 666, true);
            }

            $inter->save(storage_path('app/public/questionTwo/') . $question_image);
            $question->image_question = $question_image;
        }
        $question->status = 1;

        $question->save();
        return back()->with('success', 'Question added successfully');
    }
    public function edit($id)
    {
        $QA = QuestionAnswerTwo::get();
        $qno = QuestionAnswerTwo::findOrFail($id);
        $category = CategoryTwo::where(['status' => 1, 'is_archive' => 0])->get();
        return view('admin.pages.questionsRoundTwo.index', [
            'question' => $QA,
            'edit'  => $qno,
            'category' => $category,
            'form_type' => 'edit',
        ]);
    }
    public function update(Request $request, $id)
    {
        $update_data = QuestionAnswerTwo::findOrFail($id);
        if ($request->hasFile('new_image_question')) {
            $img = $request->file('new_image_question');
            $file_name = md5(time() . rand()) . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $inter->save(storage_path('app/public/questionTwo/') . $file_name);
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

    private function questionExportRows($importTemplate = false)
    {
        $categories = CategoryTwo::pluck('category_name', 'id')->toArray();

        $rows = QuestionAnswerTwo::orderBy('id')->get()->map(function ($question) use ($categories, $importTemplate) {
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
        }, 'round-two-questions.xlsx');
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
        }, 'round-two-questions-import-template.xlsx');
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

    public function validateQuestionExcelTwo(Request $request)
    {
        $request->validate([
            'question_excel_file' => 'required|file|mimes:xlsx,xls,csv|max:5120',
        ]);

        try {
            $validation = $this->validateQuestionExcelRows(
                $this->readQuestionExcelRows($request->file('question_excel_file')),
                CategoryTwo::class,
                QuestionAnswerTwo::class
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

    public function importQuestionFromExcelTwo(Request $request)
    {
        $request->validate([
            'question_excel_file' => 'required|file|mimes:xlsx,xls,csv|max:5120',
        ]);

        try {
            $validation = $this->validateQuestionExcelRows(
                $this->readQuestionExcelRows($request->file('question_excel_file')),
                CategoryTwo::class,
                QuestionAnswerTwo::class
            );

            if (!$validation['success'] && !$request->boolean('force_upload')) {
                return redirect('/add-question-round-2')
                    ->with('danger-main', 'Please fix the Excel errors before uploading, or use Upload With Problems if you still want to continue.')
                    ->with('excel_validation_errors', $validation['errors']);
            }

            Excel::import(new QuestionAnswerImportTwo, $request->file('question_excel_file'));

            return redirect('/add-question-round-2')
                ->with('success-main', 'Question Uploaded Successfully!');
        } catch (\Throwable $e) {
            Log::error('Round 2 Excel Data Save Error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return redirect('/add-question-round-2')
                ->with('danger-main', 'Something is wrong. Please check log file.');
        }
    }
    public function round2()
    {
        $admin = Auth::guard('admin')->user();

        if ($admin->round_two_status) {
            return redirect()->route('home.page')
                ->with('danger-front', 'You have already attempted this round.');
        }

        $examTime = ExamControl::first();

        if (!$examTime) {
            return redirect()->route('home.page')
                ->with('danger-front', 'Exam time is not configured.');
        }

        $categories = CategoryTwo::where('status', 1)
            ->where('is_archive', 0)
            ->get(['id', 'question_size']);

        $questions = $categories->flatMap(function ($category) {
            return QuestionAnswerTwo::where('category_id', $category->id)
                ->where('status', 1)
                ->where('is_archive', 0)
                ->inRandomOrder()
                ->limit($category->question_size)
                ->get();
        })->values();

        $admin->update([
            'round_two_status' => true,
        ]);

        return view('admin.pages.questionsRoundTwo.round2', [
            'question' => $questions,
            'minute' => $examTime->minutes ?: 0,
            'seconds' => $examTime->seconds ?: 20,
        ]);
    }
    public function round2store(Request $request)
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
            $resultCounter = 0;
            $totalSubmitted = 0;

            DB::transaction(function () use ($questionIds, $answers, $categoryIds, $request, $userId, &$resultCounter, &$totalSubmitted) {
                $now = now();

                $rows = $questionIds->map(function ($questionId, $key) use ($answers, $categoryIds, $userId, $now) {
                    return [
                        'user_id' => $userId,
                        'question_id' => $questionId,
                        'category_id' => $categoryIds[$key] ?? null,
                        'answer' => $answers[$key] ?? '',
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                })->values()->toArray();

                if (!empty($rows)) {
                    AnswerdQuestionTwo::upsert(
                        $rows,
                        ['user_id', 'question_id'],
                        ['category_id', 'answer', 'updated_at']
                    );
                }

                $correctAnswers = QuestionAnswerTwo::whereIn('id', $questionIds)
                    ->pluck('answer', 'id')
                    ->map(function ($answer) {
                        return strtolower(trim((string) $answer));
                    });

                $resultCounter = $questionIds->filter(function ($questionId, $key) use ($answers, $correctAnswers) {
                    $studentAnswer = strtolower(trim((string) ($answers[$key] ?? '')));
                    $correctAnswer = $correctAnswers[$questionId] ?? null;

                    return $studentAnswer !== '' && $correctAnswer !== null && $studentAnswer === $correctAnswer;
                })->count();

                $totalSubmitted = $questionIds->filter(function ($questionId, $key) use ($answers) {
                    return trim((string) ($answers[$key] ?? '')) !== '';
                })->count();

                Admin::where('id', $userId)->update([
                    'round_two_status' => true,
                    'round_two_result' => $resultCounter,
                    'durationTwo' => $request->duration,
                ]);
            });

            /*
            |--------------------------------------------------------------------------
            | Round 2 Submit Flow
            |--------------------------------------------------------------------------
            | Round 2 does not generate or email certificates. The heavy work is avoided
            | during submit by using bulk upsert and in-memory score calculation, so the
            | student can immediately see the score and duration after clicking Submit.
            */

            $isDisqualified = (bool) $request->input('is_disqualified', false);
            $reason = $request->input('disqualification_reason') ?: 'Leaving the exam window or changing tabs multiple times.';

            return redirect()->route('exam.congratulations', [
                'round' => 2,
                'status' => $isDisqualified ? 'disqualified' : 'submitted',
                'correctAnswers' => $resultCounter,
                'totalSubmitted' => $totalSubmitted,
                'duration' => $request->duration,
                'reason' => $isDisqualified ? $reason : null,
            ])->with('success-main', $isDisqualified ? 'Exam submitted after disqualification' : 'Answer Script successfully Submitted');
        } catch (\Throwable $e) {
            Log::error('Round 2 Answer Script Failed To Submit', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return redirect()->route('home.page')
                ->with('danger-main', 'Answer Script Failed To Submit');
        }
    }

    public function round2Autosave(Request $request)
    {
        $request->validate([
            'question_id' => 'required|integer',
            'category_id' => 'nullable|integer',
            'answer' => 'required',
            'duration' => 'nullable',
        ]);

        $userId = Auth::guard('admin')->id();
        $question = QuestionAnswerTwo::where('id', $request->question_id)
            ->where('status', 1)
            ->where('is_archive', 0)
            ->firstOrFail();

        DB::transaction(function () use ($request, $userId, $question) {
            $now = now();

            AnswerdQuestionTwo::updateOrInsert(
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
                'round_two_status' => true,
                'round_two_result' => $this->roundTwoSavedResult($userId),
                'durationTwo' => $request->duration,
            ]);
        });

        return response()->json([
            'success' => true,
            'saved_answers' => AnswerdQuestionTwo::where('user_id', $userId)->count(),
            'result' => Admin::where('id', $userId)->value('round_two_result'),
        ]);
    }

    private function roundTwoSavedResult($userId)
    {
        return DB::table('answerd_question_twos')
            ->join('question_answer_twos', 'question_answer_twos.id', '=', 'answerd_question_twos.question_id')
            ->where('answerd_question_twos.user_id', $userId)
            ->whereColumn('answerd_question_twos.answer', 'question_answer_twos.answer')
            ->count();
    }

    public function round3()
    {
        $admin = Auth::guard('admin')->user();

        if (!empty($admin->file_name)) {
            return redirect()->route('home.page')
                ->with('danger-front', 'Already Submitted!');
        }

        return view('admin.pages.roundThree.index');
    }
    public function round3store(Request $request)
    {
        $request->validate([
            'documentFile' => 'required|file|mimes:pdf|max:8000',
        ]);

        try {
            $admin = Auth::guard('admin')->user();

            if (!empty($admin->file_name)) {
                return redirect()->route('home.page')
                    ->with('danger-front', 'Already Submitted!');
            }

            $file = $request->file('documentFile');
            $fileName = uniqid('round3_', true) . '.' . $file->getClientOriginalExtension();

            $path = storage_path('app/public/roundThree');

            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $file->move($path, $fileName);

            $admin->update([
                'file_name' => $fileName,
            ]);

            return view('admin.pages.roundThree.thankYouPage');
        } catch (\Throwable $e) {
            Log::error('Round 3 File Upload Error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return redirect()->back()
                ->with('danger-front', 'Error!');
        }
    }
    public function resultTwo()
    {
        $result = Auth::guard('admin')->user();

        return view('admin.pages.resultTwo.index', [
            'result' => $result,
        ]);
    }
    public function destroy($id)
    {
        $delete_id = QuestionAnswerTwo::findOrFail($id);
        $delete_id->delete();
        return back()->with('success-main', 'Question Deleted successfully');
    }
}
