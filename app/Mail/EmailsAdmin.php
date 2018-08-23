<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailsAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $agency;
    public $subject;
    public $message;
    public $property;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($agency, $property, $subject, $message)
    {
        $this->agency    = $agency;
        $this->subject   = $subject;
        $this->message   = $message;
        $this->property  = $property;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->property['email'],$this->property['owner'])
                    ->to($this->agency['email'], $this->agency['name'])
                    ->subject($this->subject)
                    ->markdown('emails.admin');
    }
}
