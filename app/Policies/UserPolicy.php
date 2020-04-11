<?php

namespace App\Policies;

use App\GroupService;
use App\RoleService;
use App\Service;
use App\User;
use App\UserChannelRole;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
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
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        $service = Service::where('name', 'view_user_data')->first();

        $group_service = GroupService::where(['group_id' => $user->group_id, 'service_id' => $service->id]);

        if(!$group_service){
            return Response::deny();
        } else {
            // if true i'm not viewing someone else private profile
            return ($user->id === $model->id) ? Response::allow() : Response::deny();
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $service = Service::where('name', 'create_user')->first();

        $group_service = GroupService::where(['group_id' => $user->group_id, 'service_id' => $service->id]);

        if(!$group_service){
            return Response::deny();
        } else {
            return Response::allow();
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        $service = Service::where('name', 'mod_user_data')->first();

        $group_service = GroupService::where(['group_id' => $user->group_id, 'service_id' => $service->id]);

        if(!$group_service){
            return Response::deny();
        } else {
            // if true i'm not updating someone else profile
            return ($user->id === $model->id) ? Response::allow() : Response::deny();
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }


    /* Custom functions */
    public function silenceUserInCommentSection(User $user, int $channel_id)
    {
        $service = Service::where('name', 'silence_user_in_comment_section')->first();
        $user_channel_role = UserChannelRole::where(['user_id' => $user->id, 'channel_id' => $channel_id])->first();

        if(!$user_channel_role){
            return Response::deny();
        } else {
            return is_null(RoleService::where(['role_id' => $user_channel_role->role_id, 'service_id' => $service->id]))
                ? Response::deny() : Response::allow();
        }
    }

    public function reportUserInChannel(User $user, int $channel_id)
    {
        $service = Service::where('name', 'report_user_in_channel')->first();
        $user_channel_role = UserChannelRole::where(['user_id' => $user->id, 'channel_id' => $channel_id])->first();

        if(!$user_channel_role){
            return Response::deny();
        } else {
            return is_null(RoleService::where(['role_id' => $user_channel_role->role_id, 'service_id' => $service->id]))
                ? Response::deny() : Response::allow();
        }
    }

    public function banUserFromChannel(User $user, int $channel_id)
    {
        $service = Service::where('name', 'ban_user_from_channel')->first();
        $user_channel_role = UserChannelRole::where(['user_id' => $user->id, 'channel_id' => $channel_id])->first();

        if(!$user_channel_role){
            return Response::deny();
        } else {
            return is_null(RoleService::where(['role_id' => $user_channel_role->role_id, 'service_id' => $service->id]))
                ? Response::deny() : Response::allow();
        }
    }

    public function banUserFromPlatform(User $user)
    {
        $service = Service::where('name', 'ban_user_from_platform')->first();

        $group_service = GroupService::where(['group_id' => $user->group_id, 'service_id' => $service->id]);

        if(!$group_service){
            return Response::deny();
        } else {
            return Response::allow();
        }
    }

    public function upgradeToModerator(User $user, int $channel_id)
    {
        $service = Service::where('name', 'upgrade_to_moderator')->first();
        $user_channel_role = UserChannelRole::where(['user_id' => $user->id, 'channel_id' => $channel_id])->first();

        if(!$user_channel_role){
            return Response::deny();
        } else {
            return is_null(RoleService::where(['role_id' => $user_channel_role->role_id, 'service_id' => $service->id]))
                ? Response::deny() : Response::allow();
        }
    }

    public function upgradeToAdmin(User $user, int $channel_id)
    {
        $service = Service::where('name', 'upgrade_to_admin')->first();
        $user_channel_role = UserChannelRole::where(['user_id' => $user->id, 'channel_id' => $channel_id])->first();

        if(!$user_channel_role){
            return Response::deny();
        } else {
            return is_null(RoleService::where(['role_id' => $user_channel_role->role_id, 'service_id' => $service->id]))
                ? Response::deny() : Response::allow();
        }
    }

    public function downgradeModerator(User $user, int $channel_id)
    {
        $service = Service::where('name', 'downgrade_moderator')->first();
        $user_channel_role = UserChannelRole::where(['user_id' => $user->id, 'channel_id' => $channel_id])->first();

        if(!$user_channel_role){
            return Response::deny();
        } else {
            return is_null(RoleService::where(['role_id' => $user_channel_role->role_id, 'service_id' => $service->id]))
                ? Response::deny() : Response::allow();
        }
    }

    public function downgradeAdmin(User $user, int $channel_id)
    {
        $service = Service::where('name', 'downgrade_admin')->first();
        $user_channel_role = UserChannelRole::where(['user_id' => $user->id, 'channel_id' => $channel_id])->first();

        if(!$user_channel_role){
            return Response::deny();
        } else {
            return is_null(RoleService::where(['role_id' => $user_channel_role->role_id, 'service_id' => $service->id]))
                ? Response::deny() : Response::allow();
        }
    }
}
