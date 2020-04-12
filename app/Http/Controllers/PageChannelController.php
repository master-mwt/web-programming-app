<?php

namespace App\Http\Controllers;

use App\UserReported;
use App\UserSoftBanned;
use Illuminate\Support\Facades\Auth;
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

        if(Auth::check())
        {
            is_null(UserChannelRole::where(['user_id' => Auth::User()->id, 'channel_id' => $channel->id])->first())
            ? $channel->joined = 'Join'
            : $channel->joined = 'Leave';

            if($channel->joined == 'Leave')
            {
                $channel->member = UserChannelRole::where(['user_id' => Auth::User()->id, 'channel_id' => $channel->id])->first();
                $channel->member->role_id = Role::where('id', $channel->member->role_id)->first();
            }
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

        $this->authorize('viewChannelMembersList', [Channel::class, $channel->id]);

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

    public function joinChannel(Channel $channel){
        $user_id = Auth::id();

        $joinedAlready = UserChannelRole::where('user_id', $user_id)->where('channel_id', $channel->id)->first();

        if($joinedAlready){
            return back();
        }

        $member_role = Role::where('name', 'member')->first();
        UserChannelRole::create(['user_id' => $user_id, 'channel_id' => $channel->id, 'role_id' => $member_role->id]);

        return back();
    }

    public function leaveChannel(Channel $channel){
        $user_id = Auth::id();

        $joinedAlready = UserChannelRole::where('user_id', $user_id)->where('channel_id', $channel->id)->first();

        if(!$joinedAlready){
            return back();
        }

        $joinedAlready->delete();

        return back();
    }

    public function banUserFromChannel(Channel $channel, User $member){

        $this->authorize('banUserFromChannel', [User::class, $channel->id]);

        $userExist = UserChannelRole::where('user_id', $member->id)->where('channel_id', $channel->id)->first();
        $bannedAlready = UserSoftBanned::where('user_id', $member->id)->where('channel_id', $channel->id)->first();

        if($bannedAlready || (!$userExist)){
            return back();
        }

        UserSoftBanned::create(['user_id' => $member->id, 'channel_id' => $channel->id]);

        return back();
    }

    public function upgradeToModerator(Channel $channel, User $member){

        $this->authorize('upgradeToModerator', [User::class, $channel->id]);

        $moderator_role = Role::where('name', 'moderator')->first();
        $userIsJoined = UserChannelRole::where('user_id', $member->id)->where('channel_id', $channel->id)->first();

        if((!$userIsJoined) || ($userIsJoined->role_id === $moderator_role->id)){
            return back();
        }

        $userIsJoined->role_id = $moderator_role->id;
        $userIsJoined->save();

        return back();
    }

    public function upgradeToAdmin(Channel $channel, User $member){

        $this->authorize('upgradeToAdmin', [User::class, $channel->id]);

        $admin_role = Role::where('name', 'admin')->first();
        $userIsJoined = UserChannelRole::where('user_id', $member->id)->where('channel_id', $channel->id)->first();

        if((!$userIsJoined) || ($userIsJoined->role_id === $admin_role->id)){
            return back();
        }

        $userIsJoined->role_id = $admin_role->id;
        $userIsJoined->save();

        return back();
    }

    public function downgradeModerator(Channel $channel, User $member){

        $this->authorize('downgradeModerator', [User::class, $channel->id]);

        $moderator_role = Role::where('name', 'moderator')->first();
        $userIsModerator = UserChannelRole::where('user_id', $member->id)->where('channel_id', $channel->id)->where('role_id', $moderator_role->id)->first();

        if(!$userIsModerator){
            return back();
        }

        $member_role = Role::where('name', 'member')->first();

        $userIsModerator->role_id = $member_role->id;
        $userIsModerator->save();

        return back();
    }

    public function downgradeAdmin(Channel $channel, User $member){

        $this->authorize('downgradeAdmin', [User::class, $channel->id]);

        $admin_role = Role::where('name', 'admin')->first();
        $userIsAdmin = UserChannelRole::where('user_id', $member->id)->where('channel_id', $channel->id)->where('role_id', $admin_role->id)->first();

        if(!$userIsAdmin){
            return back();
        }

        $moderator_role = Role::where('name', 'moderator')->first();

        $userIsAdmin->role_id = $moderator_role->id;
        $userIsAdmin->save();

        return back();
    }

    public function reportUserInChannel(Channel $channel, User $member){

        $this->authorize('reportUserInChannel', [User::class, $channel->id]);

        $reportedAlready = UserReported::where('user_id', $member->id)->where('channel_id', $channel->id)->first();

        if($reportedAlready){
            return back();
        }

        UserReported::create(['user_id' => $member->id, 'channel_id' => $channel->id]);

        return back();
    }
}
