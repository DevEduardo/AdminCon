<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailsBienvenida extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $subject;
    public $message;
    public $name;
    public $userPass;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $name, $subject, $message, $userPass)
    {
        $this->email    = $email;
        $this->subject  = $subject;
        $this->message  = $message;
        $this->name     = $name;
        $this->userPass = $userPass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(session('emailCondominium'),session('nameCondominium'))
                    ->to($this->email)
                    ->subject($this->subject)
                    ->markdown('emails.welcomen');
    }
}
