<?php

namespace App\Http\Controllers\Admin;

use App\Exports\RoundOneResult;
use App\Http\Controllers\Controller;
use App\Imports\QuestionAnswerImport;
use App\Models\Admin;
use App\Models\AnswerdQuestion;
use App\Models\Category;
use App\Models\ExamControl;
use App\Models\QuestionAnswer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
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
            $question_image = md5(time() . rand()) . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $filePath = "app/public/question";
            if (!file_exists(storage_path($filePath))) {
                mkdir(storage_path($filePath), 666, true);
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
            $file_name = md5(time() . rand()) . '.' . $img->clientExtension();
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
        if (Auth::guard('admin')->user()->round_one_status == 1) {
            return redirect()->route('home.page')->with('danger-front', 'You can participate exam only one time.');
        }
        Admin::where('id', Auth::guard('admin')->user()->id)->update(['round_one_status' => true]);
//        Admin::where('id', Auth::guard('admin')->user()->id)->update(['round_one_status' => true]);
        $ExamTime = ExamControl::first();
        //        $QA = QuestionAnswer::inRandomOrder()->limit($ExamTime->question_qty)->get();

        $categoryList = Category::where(['status' => 1, 'is_archive' => 0])->get();

        $newArr = [];
        foreach ($categoryList as $catgory) {
            $newArr[$catgory->id] = QuestionAnswer::where(['category_id' => $catgory->id, 'status' => 1, 'is_archive' => 0])->inRandomOrder()->limit($catgory->question_size)->get()->toArray();
        }
        $QA = array_merge(...array_values($newArr));
        $minute = !empty($ExamTime->minutes) ? $ExamTime->minutes : 0;
        $seconds = !empty($ExamTime->seconds) ? $ExamTime->seconds : 20;
        return view('admin.pages.questions.round1', [
            'question' => $QA, 'minute' => $minute, 'seconds' => $seconds
        ]);
    }
    public function round1store(Request $request)
    {
        $resultCounter = 0;
        try {
            DB::beginTransaction();
            if (
                !empty($request->question) &&
                count($request->question) > 0 &&
                !empty($request->answer) &&
                count($request->answer) > 0
            ) {
                foreach ($request->question as $key => $value) {

                    $mainResult = QuestionAnswer::find($value)->answer;
                    if (!empty($mainResult) && !empty($request->answer[$key]) && $mainResult == $request->answer[$key]) {
                        $resultCounter++;
                    }

                    $answerdQuestion = new AnswerdQuestion();
                    $answerdQuestion->user_id = Auth::guard('admin')->user()->id;
                    $answerdQuestion->question_id = $value;
                    $answerdQuestion->category_id = isset($request->category_id[$key]) ? $request->category_id[$key] : '';
                    $answerdQuestion->answer = isset($request->answer[$key]) ? $request->answer[$key] : '';
                    $answerdQuestion->created_at = Carbon::now();
                    $answerdQuestion->save();
                }
            }

            Admin::where('id', Auth::guard('admin')->user()->id)
                ->update(['round_one_result' => $resultCounter, 'duration' => $request->duration]);

            DB::commit();
            return redirect()->route('result.index')->with('success-main', 'Answer Script successfully Submitted');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Answer Script Failed To Submitted Message : ' . $e->getMessage() . ' File ' . $e->getFile() . ' Line' . $e->getLine());
            return  redirect()->route('home.page')->with('danger-main', 'Answer Script Failed To Submitted');;
        }
    }

    public function importQuestionFromExcel(Request $request)
    {
        try {
            Excel::import(new QuestionAnswerImport, request()->file('question_excel_file'));

            return redirect('/add-question')->with('success-main', 'Question Uploaded Successfully!');
        } catch (\Exception $e) {
            Log::error('Excel Data Save Error: ' . $e->getMessage() . ' File: ' . $e->getFile() . ' Line: ' . $e->getLine());
            return redirect('/add-question')->with('danger-main', 'Something Is Wrong.Please Check Log File');
        }
    }

    public function getCertificate()
    {
        ini_set('max_execution_time', 120);

        //        $mpdf = new \Mpdf\Mpdf([
        //            'mode' => 'utf-8',
        //            'format' => 'A4',
        //            'fontDir' => base_path('public/assets/fonts/'),
        //            'fontdata' => config('pdf.font_data'),
        //        ]);

        //        $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
        //        $fontDirs = $defaultConfig['fontDir'];
        //
        //        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        //        $fontData = $defaultFontConfig['fontdata'];
        //
        //        $mpdf = new \Mpdf\Mpdf([
        //            'fontDir' => array_merge($fontDirs, [
        //                __DIR__ . '/custom/font/directory',
        //            ]),
        //            'fontdata' => $fontData + [ // lowercase letters only in font key
        //                    'greatvibes' => [
        //                        'R' => 'GreatVibes-Regular.ttf',
        //                    ]
        //                ],
        //            'default_font' => 'greatvibes'
        //        ]);

        // Initialize mPDF
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8', 'format' => 'A4-L', 'orientation' => 'L',
            'margin_left' => 5,
            'margin_right' => 5,
            'margin_top' => 8,
            'margin_bottom' => 5,
        ]);
        //        $mpdf->SetFont('greatvibes');
        $mpdf->SetFont('montserrat');
        $mpdf->SetCompression(true);
        // Add a page with a background image
        $mpdf->AddPage('L', '', '', '', 'on');

        $mpdf->SetWatermarkImage(
            public_path('storage/logo/logo_without_text.png'),
            0.15,
            -80,
            array(5, -100)
        );
        $mpdf->showWatermarkImage = true;
        $mpdf->SetWatermarkText('', 0.4);
        $mpdf->SetFillColor(255, 255, 255, 0.95);


        // Set the font directory path
        //        $fontDir = __DIR__ . '/../../../../../public/assets/fonts';
        //        $mpdf->AddFontDirectory($fontDir);
        //        $mpdf->SetFont('GreatVibes-Regular');
        //        // Add the font directory to mPDF
        //        $mpdf->fontDirs[] = $fontDir;
        //
        //        // Register the font with mPDF
        //        $mpdf->fontData['GreatVibes'] = [
        //            'R' => 'GreatVibes-Regular.ttf',
        //        ];
        //        $mpdf->fontData['Montserrat'] = [
        //            'R' => 'Montserrat-Regular.ttf', // Replace with your font file name
        //            'B' => 'Montserrat-Bold.ttf', // Replace with your font file name
        //            'BI' => 'Montserrat-ExtraLight.ttf', // Replace with your font file name
        //        ];
        //
        //        // Set the default font for the PDF to the custom font
        //        $mpdf->default_font = 'GreatVibes';
        //        $mpdf->default_font = 'Montserrat';
        //
        //        // Set custom fonts
        ////        $fontDir = __DIR__ . '\..\..\..\public\assets\fonts\/';
        ////        $fontDir = public_path('/assets/fonts/');
        //        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        //        $fontDirs = $defaultConfig['fontDir'];
        //
        //        $mpdf->addFontDirectory($fontDir);
        //        dd($mpdf);
        //        $mpdf->SetFont('GreatVibes', '', 16, '', true);
        //        $mpdf->SetFont('Montserrat', '', 12, '', true);


        $name = Auth::guard('admin')->user()->first_name . ' ' . Auth::guard('admin')->user()->last_name;

        $data = [
            'name' => $name,
        ];

        $content = (string)view('admin.mail.certificate', $data);
        //        dd($content,44);
        // Add content to the PDF
        $mpdf->WriteHTML($content);

        $file_name = $name . ' ' . 'Marketing Olympiad' . ' ' . 'Certificate' . Auth::guard('admin')->user()->id . '.pdf';
        // Output the PDF
        // $mpdf->Output($file_name.'.pdf', 'D');
        $mpdf->Output(public_path('attachments/' . $name . ' ' . 'Marketing Olympiad' . ' ' . 'Certificate' . Auth::guard('admin')->user()->id . '.pdf'), 'F');
        Admin::where('id', Auth::guard('admin')->user()->id)->update(['certificate' => $file_name]);
        $data["email"] = Auth::guard('admin')->user()->email;
        $data["title"] = "Marketing Olympiad Certificate";
        $data["body"] = "Here is your Certificate.";
        $data["name"] = $name;

        $file = public_path('attachments/' . $name . ' ' . 'Marketing Olympiad' . ' ' . 'Certificate' . Auth::guard('admin')->user()->id . '.pdf');

        Mail::send('admin.mail.mailbody', $data, function ($message) use ($data, $file) {
            $message->to($data["email"])
                ->subject($data["title"]);

            $message->attach($file);
        });

        unlink(public_path('attachments/' . $name . ' ' . 'Marketing Olympiad' . ' ' . 'Certificate' . Auth::guard('admin')->user()->id . '.pdf'));
        $mpdf->Output($file_name.'.pdf', 'D');
        // return  redirect()->route('home.page')->with('success-front', 'Kindly Check Your Email!');
        exit();

        //        $pdf = PDF::loadView('admin.mail.certificate', [], [], [
        //
        //        ]);
        //        return $pdf->stream('document.pdf');


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
        // Initialize mPDF
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8', 'format' => 'A4-L', 'orientation' => 'L',
            'margin_left' => 5,
            'margin_right' => 5,
            'margin_top' => 8,
            'margin_bottom' => 5,
        ]);
        //        $mpdf->SetFont('greatvibes');
        $mpdf->SetFont('montserrat');
        $mpdf->SetCompression(true);
        // Add a page with a background image
        $mpdf->AddPage('L', '', '', '', 'on');

        $mpdf->SetWatermarkImage(
            public_path('storage/logo/logo_without_text.png'),
            0.15,
            -80,
            array(5, -100)
        );
        $mpdf->showWatermarkImage = true;
        $mpdf->SetWatermarkText('', 0.4);
        $mpdf->SetFillColor(255, 255, 255, 0.95);

        $name = Auth::guard('admin')->user()->first_name . ' ' . Auth::guard('admin')->user()->last_name;

        $data = [
            'name' => $name,
        ];

        $content = (string)view('admin.mail.certificate', $data);
        //        dd($content,44);
        // Add content to the PDF
        $mpdf->WriteHTML($content);

        $file_name = $name . ' ' . 'Marketing Olympiad' . ' ' . 'Certificate' . Auth::guard('admin')->user()->id . '.pdf';
        // Output the PDF
        $mpdf->Output($file_name.'.pdf', 'D');
        // return  redirect()->route('home.page')->with('success-front', 'Kindly Check Your Email!');
        exit();

    }
    public function destroy($id)
    {
        $delete_id = QuestionAnswer::findOrFail($id);
        $delete_id->delete();
        return back()->with('success-main', 'Question Deleted successfully');
    }
}
