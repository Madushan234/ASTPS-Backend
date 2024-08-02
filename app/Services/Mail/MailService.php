<?php

namespace App\Services\Mail;

use App\Mail\SendEmail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailables\Attachment;

class MailService
{
    private $mailData;

    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    public function send()
    {
        if (config('app.env') == 'testing') return true;
        try {
            if (empty($this->mailData['layoutName']) || empty($this->mailData['to']) || empty($this->mailData['subject'])) {
                throw new \InvalidArgumentException('Missing required fields');
            }
            $mail = Mail::to($this->mailData['to']);
            if (isset($this->mailData['cc']) && is_array($this->mailData['cc']) && !empty($this->mailData['cc'])) {
                $mail->cc($this->mailData['cc']);
            }
            if (isset($this->mailData['bcc']) && is_array($this->mailData['bcc']) && !empty($this->mailData['bcc'])) {
                $mail->bcc($this->mailData['bcc']);
            }

            $mail->send(new SendEmail([
                "layoutName" => $this->mailData['layoutName'],
                "subject" => $this->mailData['subject'],
                "data" => $this->mailData['data'],
                "attachments" => (isset($this->mailData['attachments']) && is_array($this->mailData['attachments'])) ? $this->mailData['attachments'] : []
            ]));
            return true;
        } catch (\Exception $exception) {
            Log::error("mail sending failed with error : " . $exception->getMessage());
            return false;
        }
    }
}
