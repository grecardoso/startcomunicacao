<?php

namespace Hermes\Http\Controllers;

use Illuminate\Http\Request;

use Hermes\User;
use Hermes\Models\Campaign;
use Hermes\Models\Message;
use Hermes\Models\Report;

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
        $reports   = Report::orderBy('id', 'desc')->limit(10)->get();
        $campaigns = Campaign::where('status','=','W')->orderBy('id', 'desc')->get();
        return view('home',[
            'customers' => $customers,
            'reports' => $reports,
            'campaigns' => $campaigns
        ]);
    }
}
