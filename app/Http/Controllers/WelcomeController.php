<?php

namespace App\Http\Controllers;

use App\Post;
use App\Channel;
use App\User;
use App\Reply;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\DataTables\ChannelDataTable;

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
        $posts = Post::paginate(5);

        foreach($posts as $post) {
            $post->channel_id = Channel::findOrFail($post->channel_id);
            $post->user_id = User::findOrFail($post->user_id);
        }

        return view('welcome', compact(
        'posts',
        ));
    }

    public function channel($id)
    {
        $channel = Channel::where('id', $id)->first();
        $posts = Post::where('channel_id', $id)->paginate(5);
        
        foreach($posts as $post) {
            //$post->channel_id = Channel::findOrFail($post->channel_id);
            $post->user_id = User::findOrFail($post->user_id);
        }

        return view('channel', compact(
            'channel',
            'posts'
        ));
    }

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

    public function search(Request $request)
    {   
        $query = $request->input('query');
        $target = $request->input('target');
        
        //paginate(10, ['*'], 'users_pages')

        if($target === "users" && !is_null($query)) {
            $users = User::where('name', 'LIKE', '%'.$query.'%')->paginate(10);

            return view('search_res.users_res', [
                'target' => $target,
                'query' => $query,
                'users' => $users->appends($request->except('page'))
            ]);
        }

        if($target === "channels" && !is_null($query)) {
            $channels = Channel::where('title', 'LIKE', '%'.$query.'%')->paginate(10);

            return view('search_res.channels_res', [
                'target' => $target,
                'query' => $query,
                'channels' => $channels->appends($request->except('page'))
            ]);
        }

        if($target === "posts" && !is_null($query)) {
            $posts = Post::where('title', 'LIKE', '%'.$query.'%')->paginate(10);

            foreach($posts as $post) {
                $post->channel_id = Channel::findOrFail($post->channel_id);
                $post->user_id = User::findOrFail($post->user_id);
            }

            return view('search_res.posts_res', [
                'target' => $target,
                'query' => $query,
                'posts' => $posts->appends($request->except('page'))
            ]);
        }

        $message = 'wrong query';
        
        return view('search_res.empty_res', compact(
            'message'
        ));
    }

    public function backendChannel(ChannelDataTable $dataTable)
    {
        return $dataTable->render('backend.channels');
    }

}
