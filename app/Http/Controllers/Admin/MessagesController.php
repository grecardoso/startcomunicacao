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

        if ( $request->input('category') === 'GLOBAL') {
            /**
             * TODO: Criar tabela e controller separado para as mensagens globais. Retirar ela daqui.
             */
            $customers = User::where([
                ['category', 'CUSTOMER'],
                ['status', 'A']
            ])->orderBy('id', 'desc')->get();

            foreach($customers as $customer) {
                $message = new Message();
                $message->to = $customer->id;
                $message->from = $request->input('from');
                $message->title = $request->input('title');
                $message->content = $request->input('content');
                $message->category = $request->input('category');
                $message->save();
            }
            return redirect()->route('messages.index')->with([
                'msg' => 'Mensagem criada com sucesso',
                'status' => 'success'
            ]);
        } else {
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
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id) {
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

    public function deleteAllGlobalMessages() {
        Message::where('category', '=', 'GLOBAL')->delete();
        return redirect()->route('messages.index')->with([
            'msg' => 'Mensagem Deletada com sucesso!',
            'status' => 'success'
        ]);
    }
}
