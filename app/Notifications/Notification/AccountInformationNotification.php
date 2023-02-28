<?php

namespace App\Notifications\Notification;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountInformationNotification extends Notification
{
    use Queueable;
    private $name;
    private $email;
    private $cell;
    private $username;
    private $password;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$password)
    {
        $this->name = $user->name;
        $this->email = $user->email;
        $this->cell = $user->cell;
        $this->username = $user->username;
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->line('Hi ' . $this->name .', Welcome to our company, Here is your account information.')
        ->line('Your Email: '.$this->email)
        ->line('Your User Name: '.$this->username)
        ->line('Your Mobile: '.$this->cell)
        ->line('Your Password: '.$this->password)
        ->action('Login', url('/admin-login'))
        ->line('Thank you for joining our company!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
