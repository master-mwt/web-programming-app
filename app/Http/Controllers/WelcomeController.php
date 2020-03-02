<?php

namespace App\Http\Controllers;

use App\Post;
use App\Channel;
use App\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //remember to call a complex query from (for example) the PostController that returns the post meta-object, with all the references (for example: User, Channel) already resolved
        $posts = Post::paginate(10);

        foreach($posts as $post) {
            $post->channel_id = Channel::findOrFail($post->channel_id);
            $post->user_id = User::findOrFail($post->user_id);
        }

        return view('welcome', compact(
        'posts',
    ));
    }
}
