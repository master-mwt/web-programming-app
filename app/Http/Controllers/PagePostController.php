<?php

namespace App\Http\Controllers;

use App\User;
use App\Channel;
use App\Post;
use App\Reply;
use Illuminate\Http\Request;

class PagePostController extends Controller
{
    public function post($id)
    {
        $post = Post::where('id', $id)->first();
        
        $post->channel_id = Channel::findOrFail($post->channel_id);
        $post->user_id = User::findOrFail($post->user_id);

        $replies = Reply::where('post_id', $id)->paginate(5);

        foreach($replies as $reply) {
            //$post->channel_id = Channel::findOrFail($post->channel_id);
            $reply->user_id = User::findOrFail($reply->user_id);
        }

        return view('post', compact(
            'post',
            'replies'
        ));
    }
}
