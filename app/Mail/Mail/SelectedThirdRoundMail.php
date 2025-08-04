<?php

namespace App\Mail\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SelectedThirdRoundMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $name;
    public $third_round_date;
    public $third_round_end_date;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($information)
    {
        $this->name = $information['name'];
        $this->third_round_date = $information['third_round_date'];
        $this->third_round_end_date = $information['third_round_end_date'];
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Selected Third Round Mail',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'admin.mail.selectedThirdRound',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
