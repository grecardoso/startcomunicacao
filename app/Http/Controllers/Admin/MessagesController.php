<?php

namespace Hermes\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Hermes\Http\Controllers\Controller;

use Hermes\Models\Message;
use Hermes\User;

class MessagesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {

        /**
         * TODO: Disparar email para 'aviso de mensagem administrativa para usuário cliente'
         */
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

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
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
