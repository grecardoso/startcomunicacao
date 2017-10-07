<?php

namespace Hermes\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class CampaignDenied extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($owner, $name, $date)
    {
        $this->subject('Campanha negada.');
        $this->name = $name;
        $this->date = $date;
        $this->owner = $owner;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.deniedcampaign')->with(['customer_name' => $this->owner, 'campaign_name' => $this->name, 'campaign_date' => $this->date]);
    }
}
