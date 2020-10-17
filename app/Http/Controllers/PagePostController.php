<?php

namespace App\Http\Controllers;

use App\User;
use App\Channel;
use App\Post;
use App\PostTag;
use App\Reply;
use App\Image;
use App\Tag;
use App\Comment;
use App\UserPostDownvoted;
use App\UserPostHidden;
use App\UserPostReported;
use App\UserPostSaved;
use App\UserPostUpvoted;
use App\UserReplyDownvoted;
use App\UserReplyUpvoted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PagePostController extends Controller
{
    public function post($id)
    {
        $post = Post::where('id', $id)->first();

        if(is_null($post))
            abort(404);

        $post->channel_id = Channel::findOrFail($post->channel_id);
        $post->user_id = User::findOrFail($post->user_id);

        $post->tags = PostTag::where('post_id',$post->id)->get();
        foreach($post->tags as $tag) {
            $tag->tag_id = Tag::findOrFail($tag->tag_id);
        }

        $post->images = Image::where('post_id', $post->id)->get();

        !is_null(Image::where('post_id', $post->id)->first())
        ? $post->has_images = 'yes'
        : $post->has_images = 'no';

        if(Auth::check())
        {
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

        $replies = Reply::where('post_id', $id)->orderBy('created_at', 'desc')->paginate(5);

        foreach($replies as $reply) {
            //$post->channel_id = Channel::findOrFail($post->channel_id);
            $reply->user_id = User::findOrFail($reply->user_id);
            $reply->comments = Comment::where('reply_id', $reply->id)->orderBy('created_at', 'desc')->get();
            foreach($reply->comments as $comment) {
                $comment->user_id = User::findOrFail($comment->user_id);
            }

            if(Auth::check()){
                is_null(UserReplyUpvoted::where(['user_id' => Auth::User()->id, 'reply_id' => $reply->id])->first())
                    ? $reply->upvoted = 'Upvote'
                    : $reply->upvoted = 'Unupvote';

                is_null(UserReplyDownvoted::where(['user_id' => Auth::User()->id, 'reply_id' => $reply->id])->first())
                    ? $reply->downvoted = 'Downvote'
                    : $reply->downvoted = 'Undownvote';
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
        $data = [];

        $upvotedAlready = UserPostUpvoted::where('user_id', $user_id)->where('post_id', $post->id)->first();

        if($upvotedAlready){
            $upvotedAlready->delete();
            $post->upvote = $post->upvote - 1;
            $post->save();

            $data['vote'] = $post->upvote - $post->downvote;
            $data['upvotedAlready'] = true;
            return response()->json($data, 200);
        }

        $downvotedAlready = UserPostDownvoted::where('user_id', $user_id)->where('post_id', $post->id)->first();

        DB::beginTransaction();
        try {

            if($downvotedAlready){
                $downvotedAlready->delete();
                $post->downvote = $post->downvote - 1;

                $data['downvotedAlready'] = true;
            }

            $post->upvote = $post->upvote + 1;
            $post->save();
            UserPostUpvoted::create(['user_id' => $user_id, 'post_id' => $post->id]);

            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();

            return response()->json(["message" => 'An error occurred'], 500);
        }

        $data['vote'] = $post->upvote - $post->downvote;
        return response($data, 200);
    }

    public function downvote(Post $post)
    {
        $user_id = Auth::id();
        $data = [];

        $downvotedAlready = UserPostDownvoted::where('user_id', $user_id)->where('post_id', $post->id)->first();

        if($downvotedAlready){
            $downvotedAlready->delete();
            $post->downvote = $post->downvote - 1;
            $post->save();

            $data['vote'] = $post->upvote - $post->downvote;
            $data['downvotedAlready'] = true;
            return response()->json($data, 200);
        }

        $upvotedAlready = UserPostUpvoted::where('user_id', $user_id)->where('post_id', $post->id)->first();

        DB::beginTransaction();
        try {

            if($upvotedAlready){
                $upvotedAlready->delete();
                $post->upvote = $post->upvote - 1;

                $data['upvotedAlready'] = true;
            }

            $post->downvote = $post->downvote + 1;
            $post->save();
            UserPostDownvoted::create(['user_id' => $user_id, 'post_id' => $post->id]);

            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();

            return response()->json(["message" => 'An error occurred'], 500);
        }

        $data['vote'] = $post->upvote - $post->downvote;
        return response($data, 200);
    }

    public function save(Post $post)
    {
        $user_id = Auth::id();

        $savedAlready = UserPostSaved::where('user_id', $user_id)->where('post_id', $post->id)->first();

        if($savedAlready){
            $savedAlready->delete();

            return response()->json(null, 200);
        }

        UserPostSaved::create(['user_id' => $user_id, 'post_id' => $post->id]);

        return response()->json(null, 200);
    }

    public function hide(Post $post)
    {
        $user_id = Auth::id();

        $hiddenAlready = UserPostHidden::where('user_id', $user_id)->where('post_id', $post->id)->first();

        if($hiddenAlready){
            $hiddenAlready->delete();

            return response()->json(null, 200);
        }

        UserPostHidden::create(['user_id' => $user_id, 'post_id' => $post->id]);

        return response()->json(null, 200);
    }

    public function report(Post $post)
    {
        $user_id = Auth::id();

        $this->authorize("reportPost", $post);

        $reportedAlready = UserPostReported::where('user_id', $user_id)->where('post_id', $post->id)->first();

        if($reportedAlready){
            $reportedAlready->delete();

            return response()->json(null, 200);
        }

        UserPostReported::create(['user_id' => $user_id, 'post_id' => $post->id, 'channel_id' => $post->channel_id]);

        return response()->json(null, 200);
    }

    public function replyUpvote(Reply $reply)
    {
        $user_id = Auth::id();
        $data = [];

        $upvotedAlready = UserReplyUpvoted::where('user_id', $user_id)->where('reply_id', $reply->id)->first();

        if($upvotedAlready){
            $upvotedAlready->delete();
            $reply->upvote = $reply->upvote - 1;
            $reply->save();

            $data['vote'] = $reply->upvote - $reply->downvote;
            $data['upvotedAlready'] = true;
            return response()->json($data, 200);
        }

        $downvotedAlready = UserReplyDownvoted::where('user_id', $user_id)->where('reply_id', $reply->id)->first();

        DB::beginTransaction();
        try {

            if($downvotedAlready){
                $downvotedAlready->delete();
                $reply->downvote = $reply->downvote - 1;

                $data['downvotedAlready'] = true;
            }

            $reply->upvote = $reply->upvote + 1;
            $reply->save();
            UserReplyUpvoted::create(['user_id' => $user_id, 'reply_id' => $reply->id]);

            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();

            return response()->json(["message" => 'An error occurred'], 500);
        }

        $data['vote'] = $reply->upvote - $reply->downvote;
        return response($data, 200);
    }

    public function replyDownvote(Reply $reply)
    {
        $user_id = Auth::id();
        $data = [];

        $downvotedAlready = UserReplyDownvoted::where('user_id', $user_id)->where('reply_id', $reply->id)->first();

        if($downvotedAlready){
            $downvotedAlready->delete();
            $reply->downvote = $reply->downvote - 1;
            $reply->save();

            $data['vote'] = $reply->upvote - $reply->downvote;
            $data['downvotedAlready'] = true;
            return response()->json($data, 200);
        }

        $upvotedAlready = UserReplyUpvoted::where('user_id', $user_id)->where('reply_id', $reply->id)->first();

        DB::beginTransaction();
        try {

            if($upvotedAlready){
                $upvotedAlready->delete();
                $reply->upvote = $reply->upvote - 1;

                $data['upvotedAlready'] = true;
            }

            $reply->downvote = $reply->downvote + 1;
            $reply->save();
            UserReplyDownvoted::create(['user_id' => $user_id, 'reply_id' => $reply->id]);

            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();

            return response()->json(["message" => 'An error occurred'], 500);
        }

        $data['vote'] = $reply->upvote - $reply->downvote;
        return response($data, 200);
    }

    public function postGlobalUnreport(Post $post){

        $this->authorize('postGlobalUnreport', [Post::class, $post]);

        UserPostReported::where('post_id', $post->id)->delete();

        // TODO: refresh on return missing (redirect() ?)
        return response()->json(null, 204);
    }
}
