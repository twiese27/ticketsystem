<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResponsibleMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The
     */
    public $entry;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($entry)
    {
       $this->entry = $entry;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('tjade.wiese@vierol.de')// an der Stelle würde eigentlich die email des kunden eingefügt werden
                    ->view('mails.responsible')
                    ->with([
                        'entry' => $this->entry,
                    ]); 

        
    }
}
