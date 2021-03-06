<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use \App\User;
use \App\Post;
use \App\PostTag;
use \App\Tag;
use \App\Channel;
use \App\Comment;
use \App\Reply;
use \App\UserPostSaved;
use \App\UserPostHidden;
use \App\UserPostReported;
use \App\UserPostUpvoted;
use \App\UserPostDownvoted;
use \App\UserChannelRole;
use \App\Role;
use \App\Image;
use App\UserReplyDownvoted;
use App\UserReplyUpvoted;
use Illuminate\Http\Request;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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
        $user->image = Image::where('id', $user->image_id)->first();

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
        $myposts = Post::where('user_id', $user->id)->orderByDesc('created_at')->paginate(10);

        foreach($myposts as $post) {
            $post->channel_id = Channel::findOrFail($post->channel_id);
            $post->user_id = $user;

            $post->tags = PostTag::where('post_id',$post->id)->get();
            foreach($post->tags as $tag) {
                $tag->tag_id = Tag::findOrFail($tag->tag_id);
            }

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
        }

        return view('dashboard.post.list', compact(
            'myposts'
        ));
    }

    public function postSaved()
    {
        $user = Auth::User();
        $myposts = UserPostSaved::where('user_id', $user->id)->orderByDesc('created_at')->paginate(10);

        foreach($myposts as $post) {
            $post->post_id = Post::findOrFail($post->post_id);
            $post->post_id->user_id = User::findOrFail($post->post_id->user_id);
            $post->user_id = $user;
            //destructuring
            $post->channel_id = Channel::findOrFail($post->post_id->channel_id);
            $post->title = $post->post_id->title;
            $post->upvote = $post->post_id->upvote;
            $post->downvote = $post->post_id->downvote;

            $post->tags = PostTag::where('post_id',$post->post_id->id)->get();
            foreach($post->tags as $tag) {
                $tag->tag_id = Tag::findOrFail($tag->tag_id);
            }

            if(Auth::check())
            {
                is_null(UserPostUpvoted::where(['user_id' => $user->id, 'post_id' => $post->post_id->id])->first())
                ? $post->upvoted = 'Upvote'
                : $post->upvoted = 'Unupvote';

                is_null(UserPostDownvoted::where(['user_id' => $user->id, 'post_id' => $post->post_id->id])->first())
                ? $post->downvoted = 'Downvote'
                : $post->downvoted = 'Undownvote';

                is_null(UserPostSaved::where(['user_id' => $user->id, 'post_id' => $post->post_id->id])->first())
                ? $post->saved = 'Save'
                : $post->saved = 'Unsave';

                is_null(UserPostHidden::where(['user_id' => $user->id, 'post_id' => $post->post_id->id])->first())
                ? $post->hidden = 'Hide'
                : $post->hidden = 'Unhide';

                is_null(UserPostReported::where(['user_id' => $user->id, 'post_id' => $post->post_id->id])->first())
                ? $post->reported = 'Report'
                : $post->reported = 'Unreport';
            }
        }

        return view('dashboard.post.altlist', compact(
            'myposts'
        ));
    }

    public function postHidden()
    {
        $user = Auth::User();
        $myposts = UserPostHidden::where('user_id', $user->id)->orderByDesc('created_at')->paginate(10);

        foreach($myposts as $post) {
            $post->post_id = Post::findOrFail($post->post_id);
            $post->post_id->user_id = User::findOrFail($post->post_id->user_id);
            $post->user_id = $user;
            //destructuring
            $post->channel_id = Channel::findOrFail($post->post_id->channel_id);
            $post->title = $post->post_id->title;
            $post->upvote = $post->post_id->upvote;
            $post->downvote = $post->post_id->downvote;

            $post->tags = PostTag::where('post_id',$post->post_id->id)->get();
            foreach($post->tags as $tag) {
                $tag->tag_id = Tag::findOrFail($tag->tag_id);
            }

            if(Auth::check())
            {
                is_null(UserPostUpvoted::where(['user_id' => $user->id, 'post_id' => $post->post_id->id])->first())
                ? $post->upvoted = 'Upvote'
                : $post->upvoted = 'Unupvote';

                is_null(UserPostDownvoted::where(['user_id' => $user->id, 'post_id' => $post->post_id->id])->first())
                ? $post->downvoted = 'Downvote'
                : $post->downvoted = 'Undownvote';

                is_null(UserPostSaved::where(['user_id' => $user->id, 'post_id' => $post->post_id->id])->first())
                ? $post->saved = 'Save'
                : $post->saved = 'Unsave';

                is_null(UserPostHidden::where(['user_id' => $user->id, 'post_id' => $post->post_id->id])->first())
                ? $post->hidden = 'Hide'
                : $post->hidden = 'Unhide';

                is_null(UserPostReported::where(['user_id' => $user->id, 'post_id' => $post->post_id->id])->first())
                ? $post->reported = 'Report'
                : $post->reported = 'Unreport';
            }
        }

        return view('dashboard.post.altlist', compact(
            'myposts'
        ));
    }

    public function postReported()
    {
        $user = Auth::User();
        $myposts = UserPostReported::where('user_id', $user->id)->orderByDesc('created_at')->paginate(10);

        foreach($myposts as $post) {
            $post->post_id = Post::findOrFail($post->post_id);
            $post->post_id->user_id = User::findOrFail($post->post_id->user_id);
            $post->user_id = $user;
            //destructuring
            $post->channel_id = Channel::findOrFail($post->post_id->channel_id);
            $post->title = $post->post_id->title;
            $post->upvote = $post->post_id->upvote;
            $post->downvote = $post->post_id->downvote;

            $post->tags = PostTag::where('post_id',$post->post_id->id)->get();
            foreach($post->tags as $tag) {
                $tag->tag_id = Tag::findOrFail($tag->tag_id);
            }

            if(Auth::check())
            {
                is_null(UserPostUpvoted::where(['user_id' => $user->id, 'post_id' => $post->post_id->id])->first())
                ? $post->upvoted = 'Upvote'
                : $post->upvoted = 'Unupvote';

                is_null(UserPostDownvoted::where(['user_id' => $user->id, 'post_id' => $post->post_id->id])->first())
                ? $post->downvoted = 'Downvote'
                : $post->downvoted = 'Undownvote';

                is_null(UserPostSaved::where(['user_id' => $user->id, 'post_id' => $post->post_id->id])->first())
                ? $post->saved = 'Save'
                : $post->saved = 'Unsave';

                is_null(UserPostHidden::where(['user_id' => $user->id, 'post_id' => $post->post_id->id])->first())
                ? $post->hidden = 'Hide'
                : $post->hidden = 'Unhide';

                is_null(UserPostReported::where(['user_id' => $user->id, 'post_id' => $post->post_id->id])->first())
                ? $post->reported = 'Report'
                : $post->reported = 'Unreport';
            }
        }

        return view('dashboard.post.altlist', compact(
            'myposts'
        ));
    }

    public function postUpvoted()
    {
        $user = Auth::User();
        $myposts = UserPostUpvoted::where('user_id', $user->id)->orderByDesc('created_at')->paginate(10);

        foreach($myposts as $post) {
            $post->post_id = Post::findOrFail($post->post_id);
            $post->post_id->user_id = User::findOrFail($post->post_id->user_id);
            $post->user_id = $user;
            //destructuring
            $post->channel_id = Channel::findOrFail($post->post_id->channel_id);
            $post->title = $post->post_id->title;
            $post->upvote = $post->post_id->upvote;
            $post->downvote = $post->post_id->downvote;

            $post->tags = PostTag::where('post_id',$post->post_id->id)->get();
            foreach($post->tags as $tag) {
                $tag->tag_id = Tag::findOrFail($tag->tag_id);
            }

            if(Auth::check())
            {
                is_null(UserPostUpvoted::where(['user_id' => $user->id, 'post_id' => $post->post_id->id])->first())
                ? $post->upvoted = 'Upvote'
                : $post->upvoted = 'Unupvote';

                is_null(UserPostDownvoted::where(['user_id' => $user->id, 'post_id' => $post->post_id->id])->first())
                ? $post->downvoted = 'Downvote'
                : $post->downvoted = 'Undownvote';

                is_null(UserPostSaved::where(['user_id' => $user->id, 'post_id' => $post->post_id->id])->first())
                ? $post->saved = 'Save'
                : $post->saved = 'Unsave';

                is_null(UserPostHidden::where(['user_id' => $user->id, 'post_id' => $post->post_id->id])->first())
                ? $post->hidden = 'Hide'
                : $post->hidden = 'Unhide';

                is_null(UserPostReported::where(['user_id' => $user->id, 'post_id' => $post->post_id->id])->first())
                ? $post->reported = 'Report'
                : $post->reported = 'Unreport';
            }
        }

        return view('dashboard.post.altlist', compact(
            'myposts'
        ));
    }

    public function postDownvoted()
    {
        $user = Auth::User();
        $myposts = UserPostDownvoted::where('user_id', $user->id)->orderByDesc('created_at')->paginate(10);

        foreach($myposts as $post) {
            $post->post_id = Post::findOrFail($post->post_id);
            $post->post_id->user_id = User::findOrFail($post->post_id->user_id);
            $post->user_id = $user;
            //destructuring
            $post->channel_id = Channel::findOrFail($post->post_id->channel_id);
            $post->title = $post->post_id->title;
            $post->upvote = $post->post_id->upvote;
            $post->downvote = $post->post_id->downvote;

            $post->tags = PostTag::where('post_id',$post->post_id->id)->get();
            foreach($post->tags as $tag) {
                $tag->tag_id = Tag::findOrFail($tag->tag_id);
            }

            if(Auth::check())
            {
                is_null(UserPostUpvoted::where(['user_id' => $user->id, 'post_id' => $post->post_id->id])->first())
                ? $post->upvoted = 'Upvote'
                : $post->upvoted = 'Unupvote';

                is_null(UserPostDownvoted::where(['user_id' => $user->id, 'post_id' => $post->post_id->id])->first())
                ? $post->downvoted = 'Downvote'
                : $post->downvoted = 'Undownvote';

                is_null(UserPostSaved::where(['user_id' => $user->id, 'post_id' => $post->post_id->id])->first())
                ? $post->saved = 'Save'
                : $post->saved = 'Unsave';

                is_null(UserPostHidden::where(['user_id' => $user->id, 'post_id' => $post->post_id->id])->first())
                ? $post->hidden = 'Hide'
                : $post->hidden = 'Unhide';

                is_null(UserPostReported::where(['user_id' => $user->id, 'post_id' => $post->post_id->id])->first())
                ? $post->reported = 'Report'
                : $post->reported = 'Unreport';
            }
        }

        return view('dashboard.post.altlist', compact(
            'myposts'
        ));
    }

    public function replyOwned()
    {
        $user = Auth::User();
        $myreplies = Reply::where('user_id', $user->id)->orderByDesc('created_at')->paginate(10);

        foreach($myreplies as $reply) {
            $reply->post_id = Post::findOrFail($reply->post_id);
            $reply->user_id = $user;
            //destructuring
            $reply->channel_id = Channel::findOrFail($reply->post_id->channel_id);
            $reply->comments = Comment::where('reply_id', $reply->id)->get();
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

        return view('dashboard.reply.list', compact(
            'myreplies'
        ));
    }

    public function replyUpvoted()
    {
        $user = Auth::User();
        $myreplies = UserReplyUpvoted::where('user_id', $user->id)->orderByDesc('created_at')->paginate(10);

        foreach($myreplies as $reply) {
            $reply->reply_id = Reply::findOrFail($reply->reply_id);
            $reply->reply_id->user_id = User::findOrFail($reply->reply_id->user_id);
            $reply->user_id = $user;
            //destructuring
            $reply->channel_id = Channel::findOrFail($reply->reply_id->channel_id);
            $reply->post_id = Post::findOrFail($reply->reply_id->post_id);
            $reply->comments = Comment::where('reply_id', $reply->reply_id->id)->get();
            foreach($reply->comments as $comment) {
                $comment->user_id = User::findOrFail($comment->user_id);
            }

            if(Auth::check()){
                is_null(UserReplyUpvoted::where(['user_id' => Auth::User()->id, 'reply_id' => $reply->reply_id->id])->first())
                ? $reply->upvoted = 'Upvote'
                : $reply->upvoted = 'Unupvote';

                is_null(UserReplyDownvoted::where(['user_id' => Auth::User()->id, 'reply_id' => $reply->reply_id->id])->first())
                ? $reply->downvoted = 'Downvote'
                : $reply->downvoted = 'Undownvote';
            }
        }

        return view('dashboard.reply.altlist', compact(
            'myreplies'
        ));
    }

    public function replyDownvoted()
    {
        $user = Auth::User();
        $myreplies = UserReplyDownvoted::where('user_id', $user->id)->orderByDesc('created_at')->paginate(10);

        foreach($myreplies as $reply) {
            $reply->reply_id = Reply::findOrFail($reply->reply_id);
            $reply->reply_id->user_id = User::findOrFail($reply->reply_id->user_id);
            $reply->user_id = $user;
            //destructuring
            $reply->channel_id = Channel::findOrFail($reply->reply_id->channel_id);
            $reply->post_id = Post::findOrFail($reply->reply_id->post_id);
            $reply->comments = Comment::where('reply_id', $reply->reply_id->id)->get();
            foreach($reply->comments as $comment) {
                $comment->user_id = User::findOrFail($comment->user_id);
            }

            if(Auth::check()){
                is_null(UserReplyUpvoted::where(['user_id' => Auth::User()->id, 'reply_id' => $reply->reply_id->id])->first())
                ? $reply->upvoted = 'Upvote'
                : $reply->upvoted = 'Unupvote';

                is_null(UserReplyDownvoted::where(['user_id' => Auth::User()->id, 'reply_id' => $reply->reply_id->id])->first())
                ? $reply->downvoted = 'Downvote'
                : $reply->downvoted = 'Undownvote';
            }
        }

        return view('dashboard.reply.altlist', compact(
            'myreplies'
        ));
    }

    public function commentOwned()
    {
        $user = Auth::User();
        $mycomments = Comment::where('user_id', $user->id)->orderByDesc('created_at')->paginate(10);

        foreach($mycomments as $comment) {
            $comment->reply_id = Reply::findOrFail($comment->reply_id);
            $comment->reply_id->user_id = User::findOrFail($comment->reply_id->user_id);
            $comment->user_id = $user;
            //destructuring
            $comment->reply_id->post_id = Post::findOrFail($comment->reply_id->post_id);
            $comment->channel_id = Channel::findOrFail($comment->reply_id->channel_id);

            if(Auth::check()){
                is_null(UserReplyUpvoted::where(['user_id' => Auth::User()->id, 'reply_id' => $comment->reply_id->id])->first())
                    ? $comment->reply_id->upvoted = 'Upvote'
                    : $comment->reply_id->upvoted = 'Unupvote';

                is_null(UserReplyDownvoted::where(['user_id' => Auth::User()->id, 'reply_id' => $comment->reply_id->id])->first())
                    ? $comment->reply_id->downvoted = 'Downvote'
                    : $comment->reply_id->downvoted = 'Undownvote';
            }
        }

        return view('dashboard.comment.list', compact(
            'mycomments'
        ));
    }

    public function channelOwned()
    {
        $user = Auth::User();
        $mychannels = UserChannelRole::where(['user_id' => $user->id, 'role_id' => 1])->paginate(10);

        foreach($mychannels as $channel) {
            $channel->channel_id = Channel::findOrFail($channel->channel_id);
            $channel->user_id = $user;
            $channel->role_id = Role::findOrFail($channel->role_id);
            $channel->channel_id->image_id = Image::where('id', $channel->channel_id->image_id)->first();
            //destructuring
            $channel->id = $channel->channel_id;
            $channel->name = $channel->channel_id->name;
        }

        return view('dashboard.channel.list', compact(
            'mychannels'
        ));
    }

    public function channelJoined()
    {
        $user = Auth::User();
        $mychannels = UserChannelRole::where('user_id', $user->id)->whereIn('role_id', [2,3,4])->paginate(10);

        foreach($mychannels as $channel) {
            $channel->channel_id = Channel::findOrFail($channel->channel_id);
            $channel->user_id = $user;
            $channel->role_id = Role::findOrFail($channel->role_id);
            $channel->channel_id->image_id = Image::where('id', $channel->channel_id->image_id)->first();
            //destructuring
            $channel->id = $channel->channel_id;
            $channel->name = $channel->channel_id->name;
        }

        return view('dashboard.channel.list', compact(
            'mychannels'
        ));
    }

    public function imageUpload()
    {
        return view('dashboard.image_upload');
    }

    public function imageUploadStore(Request $request, Faker $faker)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ]);

        $imagename = time().'.'.$request->image->extension();

        $request->image->move(public_path('imgs_cstm/users'), $imagename);

        $imagegetsize = getimagesize('imgs_cstm/users/'.$imagename);

        $data['type'] = $imagegetsize['mime'];
        $data['size'] = $imagegetsize[0].'x'.$imagegetsize[1];
        $data['location'] = '/imgs_cstm/users/'.$imagename;
        $data['caption'] = $faker->sentence;

        $user = Auth::User();

        DB::beginTransaction();
        try {
            $image = Image::create($data);
            User::where('id', $user->id)->update(['image_id' => $image->id]);

            $oldImagePath = Image::where('id', $user->image_id)->first();
            if($oldImagePath->location !== '/imgs/no_profile_img.jpg'){
                File::delete(public_path($oldImagePath->location));
                $oldImagePath->delete();
            }

            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();

            abort(500);
        }

        return back()
        ->with('success', 'you have successfully upload image')
        ->with('image', $imagename);
    }

    public function removeImage(User $user)
    {
        $image_user_default = \App\Image::where('location', '/imgs/no_profile_img.jpg')->first();
        $oldImagePath = Image::where('id', $user->image_id)->first();

        if($oldImagePath->location !== '/imgs/no_profile_img.jpg'){
            DB::beginTransaction();
            try {
                File::delete(public_path($oldImagePath->location));
                $user->image_id = $image_user_default->id;
                $user->save();
                $oldImagePath->delete();

                DB::commit();
            } catch(\Exception $e){
                DB::rollBack();

                abort(500);
            }
        }

        return back();
    }
}
