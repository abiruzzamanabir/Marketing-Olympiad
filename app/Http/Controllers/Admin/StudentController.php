<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AllStudents;
use App\Exports\RoundOneFinalResult;
use App\Exports\RoundOneResult;
use App\Exports\RoundThreeResult;
use App\Exports\RoundTwoResult;
use App\Exports\Winner as WinnerExport;
use App\Http\Controllers\Controller;
use App\Mail\Mail\AccountInformationMail;
use App\Mail\Mail\AccountVerifiedMail;
use App\Models\Admin;
use App\Models\AnswerdQuestion;
use App\Models\AnswerdQuestionTwo;
use App\Models\ExamControl;
use App\Models\Theme;
use App\Models\TopTen;
use App\Models\Winner as WinnerModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    public function index()
    {
        return view('admin.pages.register', [
            'theme' => Theme::findOrFail(1),
        ]);
    }

    public function ShowRegisterPageSpecial()
    {
        return view('admin.pages.registerSpecial', [
            'theme' => Theme::findOrFail(1),
        ]);
    }

    public function create()
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:admins,email',
            'cell' => 'required|string|unique:admins,cell',
            'gender' => 'required|in:Male,Female',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'uniname' => 'required|string|max:255',
            'dob' => 'required|date',
            'nid' => 'required|string|unique:admins,nid',
            'stuid' => 'required|string|unique:admins,stuid',
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'nidphotofront' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'stuphotofront' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'cell.required' => 'The phone field is required',
            'stuid.required' => 'The student id field is required',
            'stuid.unique' => 'The student id field already exists',
            'nidphotofront.required' => 'The NID / Passport / Birth Certificate Photo is required',
        ]);

        $password = Str::random(10);
        $username = $this->generateUsername($validated['first_name'], $validated['last_name']);

        $user = Admin::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'username' => $username,
            'cell' => $validated['cell'],
            'gender' => $validated['gender'],
            'role_id' => 3,
            'password' => Hash::make($password),
            'address' => $validated['address'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'zip' => $validated['zip'],
            'country' => $validated['country'],
            'uniname' => $validated['uniname'],
            'dob' => $validated['dob'],
            'nid' => $validated['nid'],
            'stuid' => $validated['stuid'],
            'photo' => $this->uploadImage($request, 'photo', 'admins'),
            'mac' => 'UNKNOWN',
            'nidphotofront' => $this->uploadImage($request, 'nidphotofront', 'studentNidFront'),
            'stuphotofront' => $this->uploadImage($request, 'stuphotofront', 'studentSidFront'),
            'status' => true,
            'last_login_at' => now(),
            'last_login_ip' => $request->ip(),
        ]);

        Mail::to($user->email)->send(new AccountInformationMail([
            'name' => $user->first_name . ' ' . $user->last_name,
            'username' => $username,
            'cell' => $user->cell,
            'email' => $user->email,
            'password' => $password,
        ], $username));

        return redirect()->route('admin.login.page')
            ->with('success', 'Account created successfully. Please check your email.');
    }

    public function updateStatus($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->update(['status' => !$admin->status]);

        if ($admin->status) {
            Mail::to($admin->email)->send(new AccountVerifiedMail($admin));
        }

        return back()->with('success-main', 'Status updated successfully');
    }

    public function updateSelectStatus($id)
    {
        return $this->toggleAdminStatus($id, 'selected', 'Selected status updated successfully');
    }

    public function updateSelectTwoStatus($id)
    {
        return $this->toggleAdminStatus($id, 'selectedTwo', 'Selected status updated successfully');
    }

    public function updateSelectThreeStatus($id)
    {
        return $this->toggleAdminStatus($id, 'selectedThree', 'Selected status updated successfully');
    }

    public function updateWinnerStatus($id)
    {
        return $this->toggleAdminStatus($id, 'winner', 'Winner status updated successfully');
    }

    public function updateTrash($id)
    {
        return $this->toggleAdminStatus($id, 'trash', 'Trash updated successfully');
    }

    public function banStudent($id)
    {
        return $this->toggleAdminStatus($id, 'blocked', 'Ban updated successfully');
    }


    public function resetRoundOne($id)
    {
        $student = Admin::where('role_id', 3)->where('id', $id)->firstOrFail();

        DB::transaction(function () use ($student) {
            DB::table('answerd_questions')->where('user_id', (int) $student->id)->delete();

            DB::table('admins')->where('id', (int) $student->id)->update([
                'round_one_status' => false,
                'round_one_result' => 0,
                'duration' => null,
                'updated_at' => now(),
            ]);
        });

        return back()->with('success-main', 'Round 1 has been reset. Previous Round 1 answers have been deleted.');
    }

    public function resetRoundTwo($id)
    {
        $student = Admin::where('role_id', 3)->where('id', $id)->firstOrFail();

        DB::transaction(function () use ($student) {
            DB::table('answerd_question_twos')->where('user_id', (int) $student->id)->delete();

            DB::table('admins')->where('id', (int) $student->id)->update([
                'round_two_status' => false,
                'round_two_result' => 0,
                'durationTwo' => null,
                'updated_at' => now(),
            ]);
        });

        return back()->with('success-main', 'Round 2 has been reset. Previous Round 2 answers have been deleted.');
    }

    public function verifiedStudent(Request $request)
    {
        if ($request->ajax()) {
            $query = $this->baseStudentQuery()
                ->where('status', true)
                ->orderBy('first_name', 'asc');

            $this->applyDataTableSearch($query, $request);

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action', fn($row) => $this->studentActionButtons($row, ExamControl::find(1)))
                ->addColumn('fullName', fn($row) => $this->fullName($row))
                ->addColumn('gender', fn($row) => $row->gender ?: '-')
                ->addColumn('createdAt', fn($row) => optional($row->created_at)->diffForHumans())
                ->addColumn('lastActive', fn($row) => $this->lastActiveBadge($row))
                ->addColumn('image', fn($row) => $this->profileImage($row))
                ->rawColumns(['action', 'image', 'lastActive'])
                ->make(true);
        }

        return view('admin.pages.student.index', [
            'form_type' => 'create',
            'voruv' => 'v',
            'theme' => Theme::findOrFail(1),
        ]);
    }

    public function roundOneResult(Request $request)
    {
        if ($request->ajax()) {
            $query = $this->baseStudentQuery()
                ->where('round_one_status', true)
                ->orderByDesc('round_one_result')
                ->orderBy('duration', 'asc')
                ->limit(1000);

            $this->applyDataTableSearch($query, $request);

            return $this->resultDataTable($query, [
                'duration' => 'duration',
                'status' => ['selected', 'student.selected.status.update'],
            ]);
        }

        return view('admin.pages.student.result', [
            'form_type' => 'create',
            'voruv' => 'v',
            'theme' => Theme::findOrFail(1),
        ]);
    }

    public function roundTwoResult(Request $request)
    {
        if ($request->ajax()) {
            $query = $this->baseStudentQuery()
                ->where('round_two_status', true)
                ->orderByDesc('round_two_result')
                ->orderBy('durationTwo', 'asc')
                ->limit(103);

            $this->applyDataTableSearch($query, $request);

            return $this->resultDataTable($query, [
                'duration' => 'durationTwo',
                'status' => ['selectedTwo', 'student.selectedTwo.status.update'],
                'statusThree' => ['selectedThree', 'student.selectedThree.status.update'],
                'document' => true,
            ]);
        }

        return view('admin.pages.student.resultTwo', [
            'form_type' => 'create',
            'theme' => Theme::findOrFail(1),
        ]);
    }

    public function roundThreeResult(Request $request)
    {
        if ($request->ajax()) {
            $query = $this->baseStudentQuery()
                ->where('selectedThree', true)
                ->limit(15);

            $this->applyDataTableSearch($query, $request);

            return $this->resultDataTable($query, [
                'status' => ['winner', 'student.winner.status.update'],
            ]);
        }

        return view('admin.pages.student.resultThree', [
            'form_type' => 'create',
            'theme' => Theme::findOrFail(1),
        ]);
    }

    public function winner()
    {
        $admin = $this->baseStudentQuery()
            ->where('winner', true)
            ->orderBy('rank')
            ->limit(3)
            ->get();

        return view('admin.pages.student.winner', [
            'all_admin' => $admin,
            'form_type' => 'create',
            'theme' => Theme::findOrFail(1),
        ]);
    }

    public function result()
    {
        return $this->publicResultView('2024', 'admin.pages.result.roundOneResult');
    }

    public function result2023()
    {
        return $this->publicResultView('2023', 'admin.pages.result.result2023');
    }

    public function roundOneResultExport()
    {
        return $this->downloadExport(new RoundOneResult, 'Top1000.xlsx');
    }

    public function roundTwoResultExport()
    {
        return $this->downloadExport(new RoundTwoResult, 'Top100.xlsx');
    }

    public function roundThreeResultExport()
    {
        return $this->downloadExport(new RoundThreeResult, 'Top15.xlsx');
    }

    public function winnerExport()
    {
        return $this->downloadExport(new WinnerExport, 'Winner.xlsx');
    }

    public function allStudentExport()
    {
        return $this->downloadExport(new AllStudents, 'All Students List.xlsx');
    }

    public function roundOneFinalResultExport()
    {
        return $this->downloadExport(new RoundOneFinalResult, 'RoundOneFinalResult.xlsx');
    }

    public function trashStudent()
    {
        return $this->studentListView(
            Admin::where('trash', true)->where('role_id', 3)->orderBy('first_name', 'asc')->get(),
            'trash'
        );
    }

    public function blockStudent()
    {
        return $this->studentListView(
            Admin::where('blocked', true)->where('role_id', 3)->orderBy('first_name', 'asc')->get(),
            'ban'
        );
    }

    public function destroyStudent($id)
    {
        $admin = Admin::findOrFail($id);

        $this->deletePublicFile('admins', $admin->photo, 'avatar.png');
        $this->deletePublicFile('studentNidFront', $admin->nidphotofront);
        $this->deletePublicFile('studentSidFront', $admin->stuphotofront);

        $admin->delete();

        return back()->with('success-main', 'Account Deleted successfully');
    }

    private function uploadImage(Request $request, string $field, string $folder): ?string
    {
        if (!$request->hasFile($field)) {
            return null;
        }

        $file = $request->file($field);
        $fileName = uniqid($field . '_', true) . '.' . $file->getClientOriginalExtension();
        $directory = storage_path('app/public/' . $folder);

        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        Image::make($file->getRealPath())->save($directory . '/' . $fileName);

        return $fileName;
    }

    private function generateUsername(string $firstName, string $lastName): string
    {
        $base = Str::slug($firstName . $lastName, '');
        $username = strtolower($base . rand(100, 999));

        while (Admin::where('username', $username)->exists()) {
            $username = strtolower($base . rand(100, 999));
        }

        return $username;
    }

    private function toggleAdminStatus($id, string $field, string $message)
    {
        $admin = Admin::findOrFail($id);
        $admin->update([$field => !$admin->{$field}]);

        return back()->with('success-main', $message);
    }

    private function baseStudentQuery(): Builder
    {
        return Admin::query()
            ->where('blocked', false)
            ->where('role_id', 3)
            ->where('trash', false);
    }

    private function applyDataTableSearch(Builder $query, Request $request): void
    {
        $search = $request->input('search.value');

        if (!$search) {
            return;
        }

        $query->where(function (Builder $q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('uniname', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('gender', 'like', "%{$search}%")
                ->orWhere('cell', 'like', "%{$search}%");
        });
    }

    private function resultDataTable(Builder $query, array $columns)
    {
        $dataTable = DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', fn($row) => $this->studentActionButtons($row, ExamControl::find(1)))
            ->addColumn('fullName', fn($row) => $this->fullName($row))
            ->addColumn('gender', fn($row) => $row->gender ?: '-')
            ->addColumn('image', fn($row) => $this->profileImage($row));

        if (isset($columns['duration'])) {
            $durationField = $columns['duration'];
            $dataTable->addColumn('duration', fn($row) => $this->formatDuration($row->{$durationField}));
        }

        if (isset($columns['status'])) {
            [$field, $route] = $columns['status'];
            $dataTable->addColumn('status', fn($row) => $this->statusBadge($row->{$field}, $route, $row->id));
        }

        if (isset($columns['statusThree'])) {
            [$field, $route] = $columns['statusThree'];
            $dataTable->addColumn('statusThree', fn($row) => $this->statusBadge($row->{$field}, $route, $row->id));
        }

        if (!empty($columns['document'])) {
            $dataTable->addColumn('document', fn($row) => $this->documentButton($row->file_name));
        }

        return $dataTable
            ->rawColumns(['action', 'image', 'duration', 'status', 'statusThree', 'document'])
            ->make(true);
    }

    private function studentActionButtons(Admin $row, ?ExamControl $exam): string
    {
        $user = $row;
        $roundOneAnswers = $this->roundOneAnswerSheet((int) $row->id);
        $roundTwoAnswers = $this->roundTwoAnswerSheet((int) $row->id);

        $modal = (string) view(
            'admin.pages.student.modal',
            compact('user', 'exam', 'roundOneAnswers', 'roundTwoAnswers')
        );

        return $modal . '
            <a class="btn btn-sm btn-primary" data-toggle="modal" href="#view_student_details' . $row->id . '" data-id="' . $row->id . '">
                <i class="fa fa-eye mr-1"></i>
            </a>
            <a class="btn btn-sm btn-warning" href="' . route('student.ban', $row->id) . '">
                <i class="fa fa-ban" aria-hidden="true"></i>
            </a>
            <a class="btn btn-sm btn-danger" href="' . route('student.trash.update', $row->id) . '">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </a>';
    }

    private function roundOneAnswerSheet(int $userId)
    {
        return DB::table('answerd_questions')
            ->join('question_answers', 'question_answers.id', '=', 'answerd_questions.question_id')
            ->where('answerd_questions.user_id', $userId)
            ->select(
                'question_answers.question',
                'question_answers.image_question',
                'answerd_questions.answer as given_answer',
                'question_answers.answer as correct_answer'
            )
            ->orderBy('answerd_questions.id', 'asc')
            ->get()
            ->map(function ($answer) {
                return [
                    'question' => $answer->question,
                    'image_question' => $answer->image_question,
                    'given_answer' => $answer->given_answer,
                    'correct_answer' => $answer->correct_answer,
                    'is_correct' => strtolower(trim((string) $answer->given_answer)) === strtolower(trim((string) $answer->correct_answer)),
                ];
            });
    }

    private function roundTwoAnswerSheet(int $userId)
    {
        return DB::table('answerd_question_twos')
            ->join('question_answer_twos', 'question_answer_twos.id', '=', 'answerd_question_twos.question_id')
            ->where('answerd_question_twos.user_id', $userId)
            ->select(
                'question_answer_twos.question',
                'question_answer_twos.image_question',
                'answerd_question_twos.answer as given_answer',
                'question_answer_twos.answer as correct_answer'
            )
            ->orderBy('answerd_question_twos.id', 'asc')
            ->get()
            ->map(function ($answer) {
                return [
                    'question' => $answer->question,
                    'image_question' => $answer->image_question,
                    'given_answer' => $answer->given_answer,
                    'correct_answer' => $answer->correct_answer,
                    'is_correct' => strtolower(trim((string) $answer->given_answer)) === strtolower(trim((string) $answer->correct_answer)),
                ];
            });
    }

    private function fullName(Admin $row): string
    {
        return trim($row->first_name . ' ' . $row->last_name);
    }

    private function profileImage(Admin $row): string
    {
        $photo = $row->avatarFile();

        return '<img class="rounded-circle"
            style="width: 40px; height: 40px; object-fit: cover"
            src="' . asset('storage/admins/' . $photo) . '"
            alt="Profile Picture">';
    }

    private function lastActiveBadge(Admin $row): string
    {
        if (!$row->last_login_at) {
            return 'Never logged in';
        }

        $lastLogin = $row->last_login_at instanceof \Carbon\CarbonInterface
            ? $row->last_login_at
            : \Carbon\Carbon::parse($row->last_login_at);

        if (now()->diffInMinutes($lastLogin) < 2) {
            return '<span class="badge badge-success">Active Now</span>';
        }

        return $lastLogin->diffForHumans();
    }

    private function formatDuration($seconds): string
    {
        if (!$seconds) {
            return '-';
        }

        $minutes = (int) gmdate('i', (int) $seconds);
        $secondsOnly = (int) gmdate('s', (int) $seconds);

        return $minutes . ' Minute' . ($minutes === 1 ? ' ' : 's ')
            . $secondsOnly . ' Second' . ($secondsOnly === 1 ? '' : 's');
    }

    private function statusBadge(bool $status, string $route, int $id): string
    {
        return '<a href="' . route($route, $id) . '">
            <span class="badge badge-' . ($status ? 'success' : 'danger') . '">' . ($status ? 'Selected' : 'Not Selected') . '</span>
        </a>';
    }

    private function documentButton(?string $fileName): string
    {
        if (!$fileName) {
            return '';
        }

        return '<a class="btn btn-sm btn-info" href="' . asset('storage/roundThree/' . $fileName) . '">Download Document</a>';
    }

    private function publicResultView(string $year, string $view)
    {
        return view($view, [
            'all_admin' => $this->baseStudentQuery()
                ->where('round_one_status', true)
                ->where('selected', true)
                ->orderBy('first_name', 'asc')
                ->get(),
            'all_admin2' => $this->baseStudentQuery()
                ->where('round_two_status', true)
                ->where('selectedTwo', true)
                ->orderBy('first_name', 'asc')
                ->get(),
            'all_admin3' => TopTen::where('year', $year)->orderBy('name', 'asc')->get(),
            'all_admin4' => WinnerModel::where('year', $year)->orderBy('rank', 'asc')->get(),
            'theme' => Theme::findOrFail(1),
        ]);
    }

    private function studentListView($admin, string $formType)
    {
        return view('admin.pages.student.trash', [
            'all_admin' => $admin,
            'form_type' => $formType,
            'theme' => Theme::findOrFail(1),
        ]);
    }

    private function downloadExport($export, string $fileName)
    {
        try {
            return Excel::download($export, $fileName);
        } catch (\Throwable $e) {
            Log::error('Failed to download export', [
                'file_name' => $fileName,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return redirect()->route('home.page')
                ->with('danger-front', 'Something is wrong. Please check log file');
        }
    }

    private function deletePublicFile(string $folder, ?string $fileName, ?string $skipFileName = null): void
    {
        if (!$fileName || $fileName === $skipFileName) {
            return;
        }

        Storage::disk('public')->delete($folder . '/' . $fileName);
    }
}
