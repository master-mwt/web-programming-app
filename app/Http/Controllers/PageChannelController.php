<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Channel;
use App\Post;
use App\PostTag;
use App\Tag;
use App\Role;
use App\UserPostDownvoted;
use App\UserPostHidden;
use App\UserPostReported;
use App\UserPostSaved;
use App\UserPostUpvoted;
use App\UserChannelRole;
use Illuminate\Http\Request;

class PageChannelController extends Controller
{
    public function channel($id)
    {
        $channel = Channel::where('id', $id)->first();
        $posts = Post::where('channel_id', $id)->paginate(5);
        $user = Auth::User();
        
        is_null(UserChannelRole::where(['user_id' => Auth::User()->id, 'channel_id' => $channel->id])->first())
        ? $channel->joined = 'Join'
        : $channel->joined = 'Leave';

        if($channel->joined == 'Leave')
        {
            $channel->member = UserChannelRole::where(['user_id' => Auth::User()->id, 'channel_id' => $channel->id])->first();
            $channel->member->role_id = Role::where('id', $channel->member->role_id)->first();
        }

        foreach($posts as $post) {
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

        return view('discover.channel', compact(
            'channel',
            'posts'
        ));
    }

    public function members($id) {
        $channel = Channel::where('id', $id)->first();
        $user = Auth::User();
        // maybe useful (current auth user role in current channel)
        //$user->role_id = UserChannelRole::where(['user_id' => $user->id, 'channel_id' => $channel->id])->first();

        $members = UserChannelRole::where('channel_id', $channel->id)->orderBy('role_id')->paginate(10);

        foreach ($members as $member) {
            $member->user_id = User::where('id', $member->user_id)->first();
            $member->role_id = Role::where('id', $member->role_id)->first();
        }

        return view('discover.members', compact(
            'channel',
            'members',
            //'user'
        ));
    }
}
