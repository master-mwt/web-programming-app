<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use App\PostTag;
use App\Tag;
use App\Channel;
use App\User;
use App\Image;
use App\Role;
use App\Reply;
use App\UserPostDownvoted;
use App\UserPostHidden;
use App\UserPostReported;
use App\UserPostSaved;
use App\UserPostUpvoted;
use App\UserChannelRole;
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
        $posts = Post::orderByDesc('created_at')->paginate(10);

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

            foreach ($users as $user) {
                $user->image_id = Image::where('id', $user->image_id)->first();
            }

            if(is_null($users->first()))
            {
                $message = 'you make a typo';

                return view('search_res.empty_res', compact(
                    'target',
                    'query',
                    'message'
                ));
            }

            return view('search_res.users_res', [
                'target' => $target,
                'query' => $query,
                'users' => $users->appends($request->except('page'))
            ]);
        }

        if($target === "channels" && !is_null($query)) {
            $channels = Channel::where('name', 'LIKE', '%'.$query.'%')->paginate(10);

            if(is_null($channels->first()))
            {
                $message = 'you make a typo';

                return view('search_res.empty_res', compact(
                    'target',
                    'query',
                    'message'
                ));
            }

            if(Auth::check())
            {
                foreach ($channels as $channel) {
                    $channel->image = Image::where('id', $channel->image_id)->first();
                    is_null(UserChannelRole::where(['user_id' => Auth::User()->id, 'channel_id' => $channel->id])->first())
                    ? $channel->joined = 'Join'
                    : $channel->joined = 'Leave';

                    if($channel->joined == 'Leave')
                    {
                        $channel->member = UserChannelRole::where(['user_id' => Auth::User()->id, 'channel_id' => $channel->id])->first();
                        $channel->member->role_id = Role::where('id', $channel->member->role_id)->first();
                    }
                }
            }

            return view('search_res.channels_res', [
                'target' => $target,
                'query' => $query,
                'channels' => $channels->appends($request->except('page'))
            ]);
        }

        if($target === "posts" && !is_null($query)) {
            $posts = Post::where('title', 'LIKE', '%'.$query.'%')->orderByDesc('created_at')->paginate(10);

            if(is_null($posts->first()))
            {
                $message = 'you make a typo';

                return view('search_res.empty_res', compact(
                    'target',
                    'query',
                    'message'
                ));
            }

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

            return view('search_res.posts_res', [
                'target' => $target,
                'query' => $query,
                'posts' => $posts->appends($request->except('page'))
            ]);
        }

        if($target === "tags" && !is_null($query)) {
            if(substr($query,  0, 1) != '#') {
                $query = '#'.$query;
            }
            $tag = Tag::where('name', $query)->first();

            if(is_null($tag))
            {
                $message = 'you make a typo';

                return view('search_res.empty_res', compact(
                    'target',
                    'query',
                    'message'
                ));
            }

            $posts = PostTag::where('tag_id', $tag->id)->paginate(10);

            foreach ($posts as $key => $post) {
                $post->post_id = Post::where('id', $post->post_id)->first();
                $post->post_id->user_id = User::where('id', $post->post_id->user_id)->first();
                $post->post_id->channel_id = Channel::where('id', $post->post_id->channel_id)->first();

                $post->tags = PostTag::where('post_id',$post->post_id->id)->get();
                foreach($post->tags as $tag) {
                    $tag->tag_id = Tag::findOrFail($tag->tag_id);
                }

                if(Auth::check())
                {
                    if(UserPostHidden::where(['user_id' => Auth::User()->id, 'post_id' => $post->post_id->id])->first()){
                        $posts->forget($key);
                        continue;
                    }

                    is_null(UserPostUpvoted::where(['user_id' => Auth::User()->id, 'post_id' => $post->post_id->id])->first())
                    ? $post->upvoted = 'Upvote'
                    : $post->upvoted = 'Unupvote';

                    is_null(UserPostDownvoted::where(['user_id' => Auth::User()->id, 'post_id' => $post->post_id->id])->first())
                    ? $post->downvoted = 'Downvote'
                    : $post->downvoted = 'Undownvote';

                    is_null(UserPostSaved::where(['user_id' => Auth::User()->id, 'post_id' => $post->post_id->id])->first())
                    ? $post->saved = 'Save'
                    : $post->saved = 'Unsave';

                    is_null(UserPostHidden::where(['user_id' => Auth::User()->id, 'post_id' => $post->post_id->id])->first())
                    ? $post->hidden = 'Hide'
                    : $post->hidden = 'Unhide';

                    is_null(UserPostReported::where(['user_id' => Auth::User()->id, 'post_id' => $post->post_id->id])->first())
                    ? $post->reported = 'Report'
                    : $post->reported = 'Unreport';
                }
            }

            return view('search_res.tags_res', [
                'target' => $target,
                'query' => $query,
                'posts' => $posts->appends($request->except('page'))
            ]);
        }

        $message = 'empty query';

        return view('search_res.empty_res', compact(
            'target',
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
