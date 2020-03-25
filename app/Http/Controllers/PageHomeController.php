<?php

namespace App\Http\Controllers;

use Auth;
use \App\Post;
use \App\Channel;
use \App\Comment;
use \App\Reply;
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
        $user = Auth::User();

        return view('dashboard.home', compact(
            'user'
        ));
    }

    public function settings()
    {
        return view('dashboard.settings');
    }
    
    public function postOwned()
    {
        $user = Auth::User();
        $myposts = Post::where('user_id', $user->id)->paginate(10);

        foreach($myposts as $post) {
            $post->channel_id = Channel::findOrFail($post->channel_id);
            $post->user_id = $user;
        }

        return view('dashboard.post.list', compact(
            'myposts'
        ));
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

    public function replyOwned()
    {
        return view('dashboard.reply.list');
    }

    public function commentOwned()
    {
        return view('dashboard.comment.list');
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
