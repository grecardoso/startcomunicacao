<?php

namespace Hermes\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CampaignCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\Hermes\Models\Campaign $campaign)
    {
        $this->subject('Nova campanha criada no sistema');
        $this->campaign = $campaign;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $type = $this->campaign->type;
        if ( $type !== 'TXT') {
            if ( isset( $this->campaign->user->path ) ) {
                return $this->view('mails.createdcampaign')->with([
                    'name' => $this->campaign->name,
                    'text' => $this->campaign->message,
                    'owner' => $this->campaign->user->name,
                    'date' => \Datetime::createFromFormat('Y-m-d', $this->campaign->date)->format('d-m-Y')
                ])
                    ->attach(storage_path('app/') . $this->campaign->campaign_file->path)
                    ->attach(storage_path('app/') . $this->campaign->user->path);
            } else {
                return $this->view('mails.createdcampaign')->with([
                    'name'  => $this->campaign->name,
                    'text'   => $this->campaign->message,
                    'owner' => $this->campaign->user->name,
                    'date'  => \Datetime::createFromFormat('Y-m-d', $this->campaign->date)->format('d-m-Y')
                ])->attach(storage_path('app/') . $this->campaign->campaign_file->path);
            }
        } else {
            if ( isset( $this->campaign->user->path ) ) {
                return $this->view('mails.createdcampaign')->with([
                    'name' => $this->campaign->name,
                    'text' => $this->campaign->message,
                    'owner' => $this->campaign->user->name,
                    'date' => \Datetime::createFromFormat('Y-m-d', $this->campaign->date)->format('d-m-Y')
                ])->attach(storage_path('app/') . $this->campaign->user->path);
            } else {
                return $this->view('mails.createdcampaign')->with([
                    'name'  => $this->campaign->name,
                    'text'   => $this->campaign->message,
                    'owner' => $this->campaign->user->name,
                    'date'  => \Datetime::createFromFormat('Y-m-d', $this->campaign->date)->format('d-m-Y')
                ]);
            }
        }
    }
}
