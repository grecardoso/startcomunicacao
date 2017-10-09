<?php

namespace Hermes\Http\Controllers\Rest;

use Illuminate\Http\Request;
use Hermes\Http\Controllers\Controller;

use Hermes\Models\Message;
use Hermes\User;


class RestMessagesController extends Controller
{
    public function index(Request $request) {
        $message = null;

        if ( $request->user()->category === 'ADMIN') {
            $message = Message::where('status_from','=',true)->orderBy('id', 'desc')->get();
        } else {
            $message = Message::where([
                ['to', '=', $request->user()->id],
                ['status_from','=',true]
            ])->orderBy('id', 'desc')->get();
        }

        return $message;
    }

    /**
     * TODO: Alterar status da mensagem de acordo com o visualizado
     */
    public function show (Request $request, Message $message) {

        if ( $request->user()->category === 'ADMIN') {
            $message->status_from = false;
        } else {
            $message->status_to = false;
        }

        $message->save();

        return $message;
    }
}
