<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GetAccessMail extends Mailable
{
    use Queueable, SerializesModels;
    private $user;
    private $createdBy;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $createdBy
     */
    public function __construct($user, $createdBy)
    {
        $this->user = $user;
        $this->createdBy = $createdBy;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.get-access', [
            'user' => $this->user,
            'url' => url('/grant/access/') . '/' . $this->user->id . '/' . $this->createdBy->id,
            'createdBy' => $this->createdBy,
        ]);
    }
}
