<?php

namespace Hermes\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Hermes\Http\Controllers\Controller;

use Hermes\Models\GlobalMessage;

class GlobalMessagesController extends Controller
{
    public function store(Request $request) {
        $message = GlobalMessage::create( $request->all() );
        if ( $message->save() ) {
            return redirect()->route('messages.index')->with([
                'msg' => 'Mensagem criada com sucesso',
                'status' => 'success'
            ]);
        } else {
            return redirect()->route('messages.index')->with([
                'msg' => 'Ocorreu um erro no processo. Tente novamente.',
                'status' => 'error'
            ]);
        }
    }

    public function destroy(GlobalMessage $message) {
        $message->delete();
        return redirect()->route('messages.index')->with([
            'msg' => 'Mensagem deletada com sucesso',
            'status' => 'success'
        ]);
    }
}
