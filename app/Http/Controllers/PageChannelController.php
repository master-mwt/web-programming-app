<?php

namespace App\Http\Controllers;

use App\UserReported;
use App\UserSoftBanned;
use Auth;
use App\User;
use App\Channel;
use App\Post;
use App\PostTag;
use App\Tag;
use App\Role;
use App\Image;
use App\UserPostDownvoted;
use App\UserPostHidden;
use App\UserPostReported;
use App\UserPostSaved;
use App\UserPostUpvoted;
use App\UserChannelRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Faker\Generator as Faker;

class PageChannelController extends Controller
{
    public function channel($id)
    {
        $channel = Channel::where('id', $id)->first();
        $channel->image = Image::where('id', $channel->image_id)->first();
        $posts = Post::where('channel_id', $id)->orderByDesc('created_at')->paginate(5);
        $user = Auth::User();

        $tags = Tag::all();
        $tags_array = [];
        foreach ($tags as $tag) {
            array_push($tags_array, $tag->name);
        }

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

        if(Auth::check() && Auth::User()->group_id == 1){
            $administrator = new \App\Role();
            $administrator->name = 'administrator';
            $channel->member = (object)['role_id' => $administrator];
        }

        foreach($posts as $key => $post) {
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

        return view('discover.channel', compact(
            'channel',
            'posts',
            'tags_array'
        ));
    }

    public function members($id)
    {
        $channel = Channel::where('id', $id)->first();
        $user = Auth::User();

        $this->authorize('viewChannelMembersList', [Channel::class, $channel->id]);

        if($user->group_id == 1){
            $administrator = new \App\Role();
            $administrator->name = 'administrator';
            $user->role = (object)['role_id' => $administrator];
        } else {
            $user->role = UserChannelRole::where(['user_id' => $user->id, 'channel_id' => $channel->id])->first();
            $user->role->role_id = Role::where('id',$user->role->role_id)->first();
        }

        $members = UserChannelRole::where('channel_id', $channel->id)->orderBy('role_id')->paginate(10);

        foreach ($members as $member) {
            $member->user_id = User::where('id', $member->user_id)->first();
            $member->role_id = Role::where('id', $member->role_id)->first();
            $member->user_id->image_id = Image::where('id', $member->user_id->image_id)->first();

            if(is_null(UserReported::where(['user_id' => $member->user_id->id, 'channel_id' => $channel->id])->first())){
                $member->reported = 'Not_Reported';
                $member->isReported = false;
            } else {
                $member->reported = 'Reported';
                $member->isReported = true;
            }

            if(is_null(UserSoftBanned::where(['user_id' => $member->user_id->id, 'channel_id' => $channel->id])->first())){
                $member->banned = 'Not_Banned';
                $member->isBanned = false;
            } else {
                $member->banned = 'Banned';
                $member->isBanned = true;
            }

        }

        return view('discover.members', compact(
            'channel',
            'members',
            'user'
        ));
    }

    public function reportedPosts($id)
    {
        $channel = Channel::where('id', $id)->first();

        $posts = UserPostReported::where('channel_id', $id)->paginate(10);

        foreach ($posts as $post) {
            $post->user_id = User::where('id', $post->user_id)->first();
            $post->post_id = Post::where('id', $post->post_id)->first();
            $post->channel_id = Channel::where('id', $post->channel_id)->first();
            $post->counter = UserPostReported::where('post_id', $post->post_id->id)->count();

            $post->tags = PostTag::where('post_id',$post->post_id->id)->get();
            foreach($post->tags as $tag) {
                $tag->tag_id = Tag::findOrFail($tag->tag_id);
            }

            if(Auth::check())
            {
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

        $posts_sorted = $posts->sortByDesc(function($post){
            return $post->counter;
        });
        $posts_sorted_paginated = new LengthAwarePaginator($posts_sorted, $posts->total(), $posts->perPage());

        return view('discover.reported_posts', [
            'channel' => $channel,
            'posts' => $posts_sorted_paginated,
        ]);
    }

    public function bannedUsers($id)
    {
        $channel = Channel::where('id', $id)->first();
        $user = Auth::User();

        if($user->group_id == 1){
            $administrator = new \App\Role();
            $administrator->name = 'administrator';
            $user->role = (object)['role_id' => $administrator];
        } else {
            $user->role = UserChannelRole::where(['user_id' => $user->id, 'channel_id' => $channel->id])->first();
            $user->role->role_id = Role::where('id',$user->role->role_id)->first();
        }

        $members = UserSoftBanned::where('channel_id', $channel->id)->paginate(10);

        foreach ($members as $member) {
            $member->user_id = User::where('id', $member->user_id)->first();
            $member->user_id->image_id = Image::where('id', $member->user_id->image_id)->first();
        }

        return view('discover.banned_users', compact(
            'channel',
            'user',
            'members'
        ));
    }

    public function joinChannel(Channel $channel)
    {
        $user_id = Auth::id();

        if(UserSoftBanned::where('user_id', $user_id)->where('channel_id', $channel->id)->first()){
            abort(403, 'You are not allowed to join this channel');
        }

        $joinedAlready = UserChannelRole::where('user_id', $user_id)->where('channel_id', $channel->id)->first();

        if($joinedAlready){
            return back();
        }

        $member_role = Role::where('name', 'member')->first();
        UserChannelRole::create(['user_id' => $user_id, 'channel_id' => $channel->id, 'role_id' => $member_role->id]);

        return back();
    }

    public function leaveChannel(Channel $channel)
    {
        $user_id = Auth::id();

        $joinedAlready = UserChannelRole::where('user_id', $user_id)->where('channel_id', $channel->id)->first();

        if(!$joinedAlready){
            return back();
        }

        $creator_role = \App\Role::where('name', 'creator')->first()->id;

        if($joinedAlready->role_id === $creator_role){
            abort(500, 'You are the creator of this channel');
        }

        $reported_posts = UserPostReported::where('user_id', $joinedAlready->user_id)->where('channel_id', $joinedAlready->channel_id)->get();

        DB::beginTransaction();
        try {

            if($reported_posts){
                foreach ($reported_posts as $reported_post){
                    $reported_post->delete();
                }
            }

            $joinedAlready->delete();

            DB::commit();
        } catch(\Exception $e){
            DB::rollBack();
            abort(500, "An error occurred");
        }

        return back();
    }

    public function banUserFromChannel(Channel $channel, User $member)
    {

        $this->authorize('banUserFromChannel', [User::class, $channel->id]);

        $role_creator = \App\Role::where('name', 'creator')->first()->id;
        $memberExist = UserChannelRole::where('user_id', $member->id)->where('channel_id', $channel->id)->first();
        $bannedAlready = UserSoftBanned::where('user_id', $member->id)->where('channel_id', $channel->id)->first();

        if($bannedAlready || (!$memberExist)){
            abort(500, "Ban not permitted for this member");
        }

        $memberRole = \App\Role::where('id', $memberExist->role_id)->first()->id;

        if($memberRole === $role_creator){
            abort(500, "Ban not permitted for the channel's creator");
        }

        $userChannelRole = UserChannelRole::where('user_id', Auth::id())->where('channel_id', $channel->id)->first();
        $userRole = \App\Role::where('id', $userChannelRole->role_id)->first()->id;

        if($memberRole <= $userRole){
            abort(500, "Ban not permitted for a member whose role is higher or equals than yours");
        }

        DB::beginTransaction();
        try {

            UserSoftBanned::create(['user_id' => $member->id, 'channel_id' => $channel->id]);
            $memberExist->delete();

            $userIsReported = UserReported::where('user_id', $member->id)->where('channel_id', $channel->id)->first();

            if($userIsReported){
                $userIsReported->delete();
            }

            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            abort(500, "An error occurred");
        }

        return back();
    }

    public function unBanUserFromChannel(Channel $channel, User $member)
    {

        $this->authorize('banUserFromChannel', [User::class, $channel->id]);

        $bannedAlready = UserSoftBanned::where('user_id', $member->id)->where('channel_id', $channel->id)->first();

        if(!$bannedAlready){
            abort(500, "This member is not banned");
        }

        $bannedAlready->delete();

        return back();
    }

    public function upgradeToModerator(Channel $channel, User $member)
    {

        $this->authorize('upgradeToModerator', [User::class, $channel->id]);

        $moderator_role = Role::where('name', 'moderator')->first();
        $userIsJoined = UserChannelRole::where('user_id', $member->id)->where('channel_id', $channel->id)->first();

        if((!$userIsJoined) || ($userIsJoined->role_id === $moderator_role->id)){
            abort(500, "Upgrade not permitted for this member");
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
            abort(500, "Upgrade not permitted for this user");
        }

        $userIsJoined->role_id = $admin_role->id;
        $userIsJoined->save();

        return back();
    }

    public function upgradeToCreator(Channel $channel, User $member)
    {

        $this->authorize('upgradeToCreator', [User::class, $channel->id]);

        $creator_role = Role::where('name', 'creator')->first();
        $userIsJoined = UserChannelRole::where('user_id', $member->id)->where('channel_id', $channel->id)->first();

        if((!$userIsJoined) || ($userIsJoined->role_id === $creator_role->id)){
            abort(500, "Upgrade not permitted for this user");
        }

        if(UserChannelRole::where('channel_id', $channel->id)->where('role_id', $creator_role->id)->first()){
            abort(500, "Remove the creator first");
        }

        DB::beginTransaction();
        try {

            $userIsJoined->role_id = $creator_role->id;
            $userIsJoined->save();

            $channel->creator_id = $member->id;
            $channel->save();

            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            abort(500, "An error occurred");
        }

        return back();
    }

    public function downgradeModerator(Channel $channel, User $member)
    {

        $this->authorize('downgradeModerator', [User::class, $channel->id]);

        $moderator_role = Role::where('name', 'moderator')->first();
        $userIsModerator = UserChannelRole::where('user_id', $member->id)->where('channel_id', $channel->id)->where('role_id', $moderator_role->id)->first();

        if(!$userIsModerator){
            abort(500, "Downgrade not permitted for this user");
        }

        $member_role = Role::where('name', 'member')->first();

        $userIsModerator->role_id = $member_role->id;
        $userIsModerator->save();

        return back();
    }

    public function downgradeAdmin(Channel $channel, User $member)
    {

        $this->authorize('downgradeAdmin', [User::class, $channel->id]);

        $admin_role = Role::where('name', 'admin')->first();
        $userIsAdmin = UserChannelRole::where('user_id', $member->id)->where('channel_id', $channel->id)->where('role_id', $admin_role->id)->first();

        if(!$userIsAdmin){
            abort(500, "Downgrade not permitted for this user");
        }

        $moderator_role = Role::where('name', 'moderator')->first();

        $userIsAdmin->role_id = $moderator_role->id;
        $userIsAdmin->save();

        return back();
    }

    public function downgradeCreator(Channel $channel, User $member)
    {

        $this->authorize('downgradeCreator', [User::class, $channel->id]);

        $creator_role = Role::where('name', 'creator')->first();
        $userIsCreator = UserChannelRole::where('user_id', $member->id)->where('channel_id', $channel->id)->where('role_id', $creator_role->id)->first();

        if(!$userIsCreator){
            abort(500, "Downgrade not permitted for this user");
        }

        $admin_role = Role::where('name', 'admin')->first();

        DB::beginTransaction();
        try {
            $userIsCreator->role_id = $admin_role->id;
            $userIsCreator->save();

            $channel->creator_id = Auth::id();
            $channel->save();

            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            abort(500, "An error occurred");
        }

        return back();
    }

    public function reportUserInChannel(Channel $channel, User $member)
    {

        $this->authorize('reportUserInChannel', [User::class, $channel->id]);

        $role_creator = \App\Role::where('name', 'creator')->first()->id;
        $memberExist = UserChannelRole::where('user_id', $member->id)->where('channel_id', $channel->id)->first();
        $reportedAlready = UserReported::where('user_id', $member->id)->where('channel_id', $channel->id)->first();

        if($reportedAlready || (!$memberExist)){
            abort(500, "Report not permitted for this member");
        }

        $memberRole = \App\Role::where('id', $memberExist->role_id)->first()->id;

        if($memberRole === $role_creator){
            abort(500, "Report not permitted for the channel's creator");
        }

        $userChannelRole = UserChannelRole::where('user_id', Auth::id())->where('channel_id', $channel->id)->first();
        $userRole = \App\Role::where('id', $userChannelRole->role_id)->first()->id;

        if($memberRole <= $userRole){
            abort(500, "Report not permitted for a member whose role is higher than yours");
        }

        UserReported::create(['user_id' => $member->id, 'channel_id' => $channel->id]);

        return back();
    }

    public function unReportUserInChannel(Channel $channel, User $member)
    {

        $this->authorize('reportUserInChannel', [User::class, $channel->id]);

        $reportedAlready = UserReported::where('user_id', $member->id)->where('channel_id', $channel->id)->first();

        if(!$reportedAlready){
            abort(500, "This member is not reported");
        }

        $reportedAlready->delete();

        return back();
    }

    public function imageUpload($id)
    {   
        $channel = Channel::findOrFail($id);

        return view('dashboard.channel_image_upload', [
            'channel' => $channel,
        ]);
    }

    public function imageUploadStore(Request $request, Faker $faker)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ]);
        
        //get current channel
        $channel_id = $request->input('channel_id');

        $imagename = time().'.'.$request->image->extension();

        $request->image->move(public_path('imgs_cstm/channels'), $imagename);
        
        $imagegetsize = getimagesize('imgs_cstm/channels/'.$imagename);

        $data['type'] = $imagegetsize['mime'];
        $data['size'] = $imagegetsize[0].'x'.$imagegetsize[1];
        $data['location'] = '/imgs_cstm/channels/'.$imagename;
        $data['caption'] = $faker->sentence;
        
        DB::beginTransaction();
        try {
            $image = Image::create($data);
            Channel::where('id', $channel_id)->update(['image_id' => $image->id]);

            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();

            abort(500);
        }

        return back()
        ->with('success', 'you have successfully upload image')
        ->with('image', $imagename);
    }
}
