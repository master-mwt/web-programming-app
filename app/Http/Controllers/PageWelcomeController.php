<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use App\PostTag;
use App\Tag;
use App\Channel;
use App\User;
use App\Reply;
use App\UserPostDownvoted;
use App\UserPostHidden;
use App\UserPostReported;
use App\UserPostSaved;
use App\UserPostUpvoted;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\DataTables\ChannelDataTable;

class PageWelcomeController extends Controller
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

        return view('welcome', compact(
        'posts',
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

    public function help()
    {
        return view('info.help');
    }
    
    public function about()
    {
        return view('info.about');
    }

    public function contact()
    {
        return view('info.contact');
    }
}
