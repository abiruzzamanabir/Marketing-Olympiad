<?php

namespace App\Jobs;

use App\Models\Admin;
use App\Models\Theme;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class GenerateRoundOneCertificateMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $timeout = 180;

    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function handle()
    {
        $user = Admin::find($this->userId);

        if (!$user || empty($user->email) || !$user->round_one_status) {
            return;
        }

        try {
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
        } catch (\Throwable $e) {
            Log::error('Round 1 participation certificate mail job failed', [
                'user_id' => $this->userId,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            throw $e;
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
        $tempDir = storage_path('app/mpdf-temp');

        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'orientation' => 'L',
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0,
            'tempDir' => $tempDir,
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
        $safeName = trim(preg_replace('/[^A-Za-z0-9_\- ]/', '', $name));

        if ($safeName === '') {
            $safeName = 'Participant';
        }

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
}
