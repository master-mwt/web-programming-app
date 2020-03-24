<?php

namespace App\Http\Controllers;

use App\User;
use App\Channel;
use App\Post;
use Illuminate\Http\Request;

class PageChannelController extends Controller
{
    public function channel($id)
    {
        $channel = Channel::where('id', $id)->first();
        $posts = Post::where('channel_id', $id)->paginate(5);
        
        foreach($posts as $post) {
            $post->user_id = User::findOrFail($post->user_id);
        }

        return view('discover.channel', compact(
            'channel',
            'posts'
        ));
    }
}
