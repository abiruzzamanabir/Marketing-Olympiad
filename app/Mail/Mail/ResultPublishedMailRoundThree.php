<?php

namespace App\Mail\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResultPublishedMailRoundThree extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $name;
    public $result_published_time;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->name = $details['name'];
        $this->result_published_time = $details['result_published_time'];
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
<<<<<<< HEAD
            subject: 'Result Published Mail Round Three',
=======
            subject: 'Result Published Mail Round Two',
>>>>>>> b7a94586bf1b3eedc2dc0d1c4d8bf2e91cd46356
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
            view: 'admin.mail.ResultPublishedRoundThree',
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
