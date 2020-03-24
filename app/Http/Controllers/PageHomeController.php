<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageHomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard.home');
    }

    public function settings()
    {
        return view('dashboard.settings');
    }
    
    public function postOwned()
    {
        return view('dashboard.post.list');
    }

    public function postSaved()
    {
        return view('dashboard.post.list');
    }

    public function postHidden()
    {
        return view('dashboard.post.list');
    }

    public function postReported()
    {
        return view('dashboard.post.list');
    }

    public function channelOwned()
    {
        return view('dashboard.channel.list');
    }

    public function channelJoined()
    {
        return view('dashboard.channel.list');
    }
}
