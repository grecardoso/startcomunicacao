<?php

namespace Hermes\Http\Controllers\Rest;

use Hermes\Mail\CampaignApproved;
use Hermes\Mail\CampaignDenied;
use Illuminate\Http\Request;
use Hermes\Http\Controllers\Controller;

use Hermes\Models\Campaign;
use Illuminate\Support\Facades\Mail;

class RestCampaignsController extends Controller
{
    public function approveCampaign( $id ) {
        $campaign = Campaign::findOrFail( $id );
        $campaign->status = 'S';
        if ( $campaign->save() ) {

            // enviando email de aprovação de camapanha para o usuário correspondente
            Mail::to( $campaign->user->email)->send( new CampaignApproved($campaign->user->name));

            return response()->json([
                'msg' => 'Campanha aprovada'
            ]);
        }
    }

    public function denieCampaign( $id ) {
        $campaign = Campaign::findOrFail( $id );
        $campaign->status = 'D';
        if ( $campaign->save() ) {
            // enviando email de aprovação de camapanha para o usuário correspondente
            Mail::to( $campaign->user->email)->send( new CampaignDenied($campaign->user->name, $campaign->name, \DateTime::createFromFormat('Y-m-d', $campaign->date)->format('d-m-Y')));
            return response()->json([
                'msg' => 'Campanha aprovada'
            ]);
        }
    }

    public function completeCampaign( $id ) {
        $campaign = Campaign::findOrFail( $id );
        $campaign->status = 'C';
        if ( $campaign->save() ) {
            return response()->json([
                'msg' => 'Campanha aprovada'
            ]);
        }
    }
}
