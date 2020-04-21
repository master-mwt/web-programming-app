<?php

namespace App\Http\Controllers;

use App\UserHardBanned;
use Auth;
use App\User;
use App\Post;
use App\PostTag;
use App\Tag;
use App\Channel;
use App\Image;
use App\UserPost;
use App\UserPostUpvoted;
use App\UserPostDownvoted;
use App\UserPostSaved;
use App\UserPostHidden;
use App\UserPostReported;
use Illuminate\Http\Request;

class PageUserController extends Controller
{
    public function user($id)
    {
        $user = User::where('id', $id)->first();
        $user->image = Image::where('id', $user->image_id)->first();

        if(UserHardBanned::where('user_id', $user->id)->first()){
            $user->hardBanned = true;
        }

        return view('discover.user', compact(
            'user'
        ));
    }

    public function userPosts($id)
    {
        $posts = Post::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(10);

        foreach($posts as $key => $post) {
            $post->channel_id = Channel::findOrFail($post->channel_id);
            $post->user_id = User::findOrFail($post->user_id);

            $post->tags = PostTag::where('post_id',$post->id)->get();
            foreach($post->tags as $tag) {
                $tag->tag_id = Tag::findOrFail($tag->tag_id);
            }

            if(Auth::check())
            {
                if(UserPostHidden::where(['user_id' => Auth::User()->id, 'post_id' => $post->id])->first()){
                    $posts->forget($key);
                    continue;
                }

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
        }

        return view('discover.user_posts', compact(
            'posts'
        ));
    }
}
