<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccessResponseMail extends Mailable
{
    use Queueable, SerializesModels;
    private $isAccept;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $createdBy
     */
    public function __construct($isAccept)
    {
        $this->isAccept = $isAccept;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.response-access', [
            'isAccept' => $this->isAccept,
        ]);
    }
}
