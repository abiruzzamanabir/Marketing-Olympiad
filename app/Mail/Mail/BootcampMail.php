<?php

namespace App\Mail\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class bootcampMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $name;
    public $bootcamp_date;
    public $bootcamp_end_date;
    public $start_time;
    public $end_time;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($information)
    {
        $this->name = $information['name'];
        $this->bootcamp_date = $information['bootcamp_date'];
        $this->bootcamp_end_date = $information['bootcamp_end_date'];
        $this->start_time = $information['start_time'];
        $this->end_time = $information['end_time'];
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Bootcamp Mail',
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
            view: 'admin.mail.bootcamp',
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
