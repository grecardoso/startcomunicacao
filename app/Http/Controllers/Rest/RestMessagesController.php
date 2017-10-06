<?php

namespace Hermes\Http\Controllers\Rest;

use Illuminate\Http\Request;
use Hermes\Http\Controllers\Controller;

use Hermes\Models\Message;
use Hermes\User;


class RestMessagesController extends Controller
{
    /**
     * TODO: Alterar status da mensagem de acordo com o visualizado
     */
    public function show (Message $message, User $user) {

        if ( $user->category === 'ADMIN') {
            $message->status_from = false;
        } else {
            $message->status_to = false;
        }

        $message->save();
        return $message;
    }
}
