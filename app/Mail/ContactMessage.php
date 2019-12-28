<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $contact_message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $contact_message)
    {
        $this->name = $name;
        $this->contact_message = $contact_message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.contact')
            ->with([
                'name' => $this->name,
                'contact_message' => $this->contact_message
            ]);
    }
}
