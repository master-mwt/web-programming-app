<?php

namespace App\Http\Controllers;

use App\User;
use App\Channel;
use App\Post;
use App\Reply;
use App\Comment;
use App\UserPostDownvoted;
use App\UserPostHidden;
use App\UserPostReported;
use App\UserPostSaved;
use App\UserPostUpvoted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            $reply->comments = Comment::where('reply_id', $reply->id)->get();
            foreach($reply->comments as $comment) {
                $comment->user_id = User::findOrFail($comment->user_id);
            }
        }

        return view('discover.post', compact(
            'post',
            'replies'
        ));
    }

    public function upvote(Post $post)
    {
        $user_id = Auth::id();

        $upvotedAlready = UserPostUpvoted::where('user_id', $user_id)->where('post_id', $post->id)->first();

        if($upvotedAlready){
            $upvotedAlready->delete();
            $post->upvote = $post->upvote - 1;
            $post->save();

            return back();
        }

        $downvotedAlready = UserPostDownvoted::where('user_id', $user_id)->where('post_id', $post->id)->first();

        DB::beginTransaction();
        try {

            if($downvotedAlready){
                $downvotedAlready->delete();
                $post->downvote = $post->downvote - 1;
            }

            $post->upvote = $post->upvote + 1;
            $post->save();
            UserPostUpvoted::create(['user_id' => $user_id, 'post_id' => $post->id]);

            DB::commit();
        } catch(\Exception $e) {
            abort(500, 'An error occurred');
            DB::rollBack();
        }

        return back();
    }

    public function downvote(Post $post)
    {
        $user_id = Auth::id();

        $downvotedAlready = UserPostDownvoted::where('user_id', $user_id)->where('post_id', $post->id)->first();

        if($downvotedAlready){
            $downvotedAlready->delete();
            $post->downvote = $post->downvote - 1;
            $post->save();

            return back();
        }

        $upvotedAlready = UserPostUpvoted::where('user_id', $user_id)->where('post_id', $post->id)->first();

        DB::beginTransaction();
        try {

            if($upvotedAlready){
                $upvotedAlready->delete();
                $post->upvote = $post->upvote - 1;
            }

            $post->downvote = $post->downvote + 1;
            $post->save();
            UserPostDownvoted::create(['user_id' => $user_id, 'post_id' => $post->id]);

            DB::commit();
        } catch(\Exception $e) {
            abort(500, 'An error occurred');
            DB::rollBack();
        }

        return back();
    }

    public function save(Post $post)
    {
        $user_id = Auth::id();

        $savedAlready = UserPostSaved::where('user_id', $user_id)->where('post_id', $post->id)->first();

        if($savedAlready){
            $savedAlready->delete();

            return back();
        }

        UserPostSaved::create(['user_id' => $user_id, 'post_id' => $post->id]);

        return back();
    }

    public function hide(Post $post)
    {
        $user_id = Auth::id();

        $hiddenAlready = UserPostHidden::where('user_id', $user_id)->where('post_id', $post->id)->first();

        if($hiddenAlready){
            $hiddenAlready->delete();

            return back();
        }

        UserPostHidden::create(['user_id' => $user_id, 'post_id' => $post->id]);

        return back();
    }

    public function report(Post $post)
    {
        $user_id = Auth::id();

        $reportedAlready = UserPostReported::where('user_id', $user_id)->where('post_id', $post->id)->first();

        if($reportedAlready){
            $reportedAlready->delete();

            return back();
        }

        UserPostReported::create(['user_id' => $user_id, 'post_id' => $post->id]);

        return back();
    }

}
