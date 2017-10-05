<?php

namespace Hermes\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Hermes\Http\Controllers\Controller;

use Hermes\Models\Message;
use Hermes\User;

class MessagesControler extends Controller
{
    public function index () {
        $messages = Message::all();
        $customers = User::where([
            ['category', 'CUSTOMER'],
            ['status', 'A']
        ])->orderBy('id', 'desc')->get();

        return view('messages.index', [
            'messages' => $messages,
            'customers' => $customers
        ]);
    }

    public function store(Request $request) {
        //return $request->all();
        $message = Message::create( $request->all() );
        if ($message->save()) {
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

    public function delete($id) {
        $message = Message::findOrFail($id);
        if ($message->delete()) {
            return redirect()->route('messages.index')->with([
                'msg' => 'Mensagem Deletada com sucesso!',
                'status' => 'success'
            ]);
        } else {
            return redirect()->route('messages.index')->with([
                'msg' => 'Ocorreu um erro no processo. Tente novamente.',
                'status' => 'error'
            ]);
        }
    }
}
