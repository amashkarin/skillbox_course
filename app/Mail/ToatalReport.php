<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ToatalReport extends Mailable
{
    use Queueable, SerializesModels;

    public $reportRows;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reportRows)
    {
        $this->reportRows = $reportRows;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.total-report', [
            'reportRows' => $this->reportRows,
        ]);
    }
}
