<?php

namespace App\Policies;

use App\Post;
use App\RoleService;
use App\Service;
use App\User;
use App\UserChannelRole;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        // admin can do anything
        if($user->group_id == 1){
            return true;
        }
    }

    /**
     * Determine whether the user can view any posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function view(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param \App\User $user
     * @param int $channel_id
     * @return mixed
     */
    public function create(User $user, int $channel_id)
    {
        $service = Service::where('name', 'create_post')->first();
        $user_channel_role = UserChannelRole::where(['user_id' => $user->id, 'channel_id' => $channel_id])->first();

        if(!$user_channel_role){
            return Response::deny();
        } else {
            return is_null(RoleService::where(['role_id' => $user_channel_role->role_id, 'service_id' => $service->id])->first())
            ? Response::deny() : Response::allow();
        }
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        $service = Service::where('name', 'delete_post')->first();
        $user_channel_role = UserChannelRole::where(['user_id' => $user->id, 'channel_id' => $post->channel_id])->first();

        if(!$user_channel_role){
            return Response::deny();
        } else {
            return is_null(RoleService::where(['role_id' => $user_channel_role->role_id, 'service_id' => $service->id])->first())
                ? Response::deny() : Response::allow();
        }
    }

    /**
     * Determine whether the user can restore the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function restore(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function forceDelete(User $user, Post $post)
    {
        //
    }


    /* Custom functions */
    public function reportPost(User $user, Post $post)
    {
        $service = Service::where('name', 'report_post')->first();
        $user_channel_role = UserChannelRole::where(['user_id' => $user->id, 'channel_id' => $post->channel_id])->first();

        if(!$user_channel_role){
            return Response::deny();
        } else {
            return is_null(RoleService::where(['role_id' => $user_channel_role->role_id, 'service_id' => $service->id])->first())
                ? Response::deny() : Response::allow();
        }
    }
}
