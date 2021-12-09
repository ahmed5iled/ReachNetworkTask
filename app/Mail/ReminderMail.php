<?php

namespace App\Mail;

use App\Models\Ad;
use App\Models\Advertiser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReminderMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $ad;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ad $ad)
    {
        $this->ad = $ad;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from('ahmed@task.com', 'Ahmed Khaled')
            ->view('emails.adsReminder');
    }
}
