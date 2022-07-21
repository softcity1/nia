<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUserEmail extends Mailable
{
    use Queueable, SerializesModels;
    private $data;
    private $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $password)
    {
        $this->data = $data;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.new-user', [
            'data' => $this->data,
            'url' => url('/login'),
            'password' => $this->password,
        ]);
    }
}
