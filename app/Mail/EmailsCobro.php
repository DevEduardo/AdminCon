<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailsCobro extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $subject;
    public $message;
    public $name;
    public $dues;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $name, $subject, $message, $dues)
    {
        $this->email    = $email;
        $this->subject  = $subject;
        $this->message  = $message;
        $this->name     = $name;
        $this->dues     = $dues;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(session('emailCondominium'),session('nameCondominium'))
                    ->to($this->email, $this->name)
                    ->subject($this->subject)
                    ->markdown('emails.cobro');
    }
}
