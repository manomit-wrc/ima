<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $first_name;
    public $comment;
    public $emailfrom;
    public $emailto;

    public function __construct($first_name,$comment,$emailfrom)
    {
        //
         $this->first_name = $first_name;
         $this->comment = $comment;
         $this->emailfrom = $emailfrom;
         
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->from($this->emailfrom, 'Indian Medical Association')
        ->subject('Contact')
        ->view('emails.contact');
    }
}
