<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Channel;
use App\Post;
use App\UserPostDownvoted;
use App\UserPostHidden;
use App\UserPostReported;
use App\UserPostSaved;
use App\UserPostUpvoted;
use Illuminate\Http\Request;

class PageChannelController extends Controller
{
    public function channel($id)
    {
        $channel = Channel::where('id', $id)->first();
        $posts = Post::where('channel_id', $id)->paginate(5);
        
        foreach($posts as $post) {
            $post->user_id = User::findOrFail($post->user_id);

            is_null(UserPostUpvoted::where(['user_id' => Auth::User()->id, 'post_id' => $post->id])->first())
            ? $post->upvoted = 'Upvote'
            : $post->upvoted = 'Unupvote';

            is_null(UserPostDownvoted::where(['user_id' => Auth::User()->id, 'post_id' => $post->id])->first())
            ? $post->downvoted = 'Downvote'
            : $post->downvoted = 'Undownvote';

            is_null(UserPostSaved::where(['user_id' => Auth::User()->id, 'post_id' => $post->id])->first())
            ? $post->saved = 'Save'
            : $post->saved = 'Unsave';

            is_null(UserPostHidden::where(['user_id' => Auth::User()->id, 'post_id' => $post->id])->first())
            ? $post->hidden = 'Hide'
            : $post->hidden = 'Unhide';

            is_null(UserPostReported::where(['user_id' => Auth::User()->id, 'post_id' => $post->id])->first())
            ? $post->reported = 'Report'
            : $post->reported = 'Unreport';
        }

        return view('discover.channel', compact(
            'channel',
            'posts'
        ));
    }
}
