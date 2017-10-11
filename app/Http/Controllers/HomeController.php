<?php

namespace Hermes\Http\Controllers;

use Illuminate\Http\Request;

use Hermes\User;
use Hermes\Models\Campaign;
use Hermes\Models\GlobalMessage;
use Hermes\Models\Report;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = User::where([
            ['category', '=', 'CUSTOMER'],
            ['status', '=', 'W']
        ])->orderBy('id', 'desc')->get();
        $campaigns = null;
        $reports = null;
        $started = null;
        $denied = null;
        $messages = null;
        if ( Auth::user()->category === 'ADMIN') {
            $campaigns = Campaign::where('status','=','W')->orderBy('id', 'desc')->get();
            $reports = Report::orderBy('id', 'desc')->get();
            $started = Campaign::where('status','=','S')->orderBy('id', 'desc')->count();
            $denied = Campaign::where('status','=','D')->orderBy('id', 'desc')->count();
        } else {
            $campaigns = Campaign::where([
                ['status','=','W'],
                ['user_id', '=', Auth::user()->id]
            ])->orderBy('id', 'desc')->get();
            $reports = Report::where([
                //['status','=','W'],
                ['user_id', '=', Auth::user()->id]
            ])->orderBy('id', 'desc')->limit(10)->get();
            $started = Campaign::where([
                ['status','=','S'],
                ['user_id', '=', Auth::user()->id]
            ])->orderBy('id', 'desc')->count();
            $denied = Campaign::where([
                ['status','=','D'],
                ['user_id', '=', Auth::user()->id]
            ])->orderBy('id', 'desc')->count();
            $messages = GlobalMessage::orderBy('id', 'desc')->get();
        }

        return view('home',[
            'customers' => $customers,
            'reports' => $reports,
            'campaigns' => $campaigns,
            'campaigns_started' => $started,
            'campaigns_denied' => $denied,
            'messages' => $messages
        ]);
    }
}
