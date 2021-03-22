<?php

namespace App\Mail;

use App\Models\PersonResume;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResumeSent extends Mailable
{
    use Queueable, SerializesModels;

    protected $resume;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(PersonResume $resume)
    {
        $this->resume = $resume;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $resume = $this->resume;
        $this->subject('Paytour - Recebemos seu Curriculum Vitae');
        $this->to($resume->email, $resume->name);

        return $this->view('mail.cvSent', compact('resume'));
    }
}
