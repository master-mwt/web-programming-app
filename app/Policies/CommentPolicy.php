<?php

namespace App\Policies;

use App\Comment;
use App\RoleService;
use App\Service;
use App\User;
use App\UserChannelRole;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CommentPolicy
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
     * Determine whether the user can view any comments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function view(User $user, Comment $comment)
    {
        //
    }

    /**
     * Determine whether the user can create comments.
     *
     * @param \App\User $user
     * @param int $channel_id
     * @return mixed
     */
    public function create(User $user, int $channel_id)
    {
        $service = Service::where('name', 'create_comment')->first();
        $user_channel_role = UserChannelRole::where(['user_id' => $user->id, 'channel_id' => $channel_id])->first();

        if(!$user_channel_role){
            return Response::deny();
        } else {
            return is_null(RoleService::where(['role_id' => $user_channel_role->role_id, 'service_id' => $service->id])->first())
                ? Response::deny() : Response::allow();
        }
    }

    /**
     * Determine whether the user can update the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function update(User $user, Comment $comment)
    {
        //
    }

    /**
     * Determine whether the user can delete the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function delete(User $user, Comment $comment)
    {
        $service = Service::where('name', 'delete_comment')->first();
        $user_channel_role = UserChannelRole::where(['user_id' => $user->id, 'channel_id' => $comment->channel_id])->first();

        if(!$user_channel_role){
            if($comment->user_id === $user->id){
                return Response::allow();
            } else {
                return Response::deny();
            }
        } else {
            $role_creator = \App\Role::where('name', 'creator')->first()->id;
            $role_admin = \App\Role::where('name', 'admin')->first()->id;

            if(is_null(RoleService::where(['role_id' => $user_channel_role->role_id, 'service_id' => $service->id])->first())){
                return Response::deny();
            } else {
                if($user_channel_role->role_id === $role_creator || $user_channel_role->role_id === $role_admin || $comment->user_id === $user->id){
                    return Response::allow();
                } else {
                    return Response::deny();
                }
            }
        }
    }

    /**
     * Determine whether the user can restore the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function restore(User $user, Comment $comment)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function forceDelete(User $user, Comment $comment)
    {
        //
    }
}
