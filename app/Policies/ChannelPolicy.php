<?php

namespace App\Policies;

use App\Channel;
use App\GroupService;
use App\RoleService;
use App\Service;
use App\User;
use App\UserChannelRole;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ChannelPolicy
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
     * Determine whether the user can view any channels.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the channel.
     *
     * @param  \App\User  $user
     * @param  \App\Channel  $channel
     * @return mixed
     */
    public function view(User $user, Channel $channel)
    {
        //
    }

    /**
     * Determine whether the user can create channels.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $service = Service::where('name', 'create_channel')->first();

        return is_null(GroupService::where(['group_id' => $user->group_id, 'service_id' => $service->id])->first())
            ? Response::deny()
            : Response::allow();
    }

    /**
     * Determine whether the user can update the channel.
     *
     * @param  \App\User  $user
     * @param  \App\Channel  $channel
     * @return mixed
     */
    public function update(User $user, Channel $channel)
    {
        $service = Service::where('name', 'mod_channel_data')->first();
        $user_channel_role = UserChannelRole::where(['user_id' => $user->id, 'channel_id' => $channel->id])->first();

        if(!$user_channel_role){
            return Response::deny();
        } else {
            return is_null(RoleService::where(['role_id' => $user_channel_role->role_id, 'service_id' => $service->id]))
                ? Response::deny() : Response::allow();
        }
    }

    /**
     * Determine whether the user can delete the channel.
     *
     * @param  \App\User  $user
     * @param  \App\Channel  $channel
     * @return mixed
     */
    public function delete(User $user, Channel $channel)
    {
        $service = Service::where('name', 'delete_channel')->first();
        $user_channel_role = UserChannelRole::where(['user_id' => $user->id, 'channel_id' => $channel->id])->first();

        if(!$user_channel_role){
            return Response::deny();
        } else {
            return is_null(RoleService::where(['role_id' => $user_channel_role->role_id, 'service_id' => $service->id]))
                ? Response::deny() : Response::allow();
        }
    }

    /**
     * Determine whether the user can restore the channel.
     *
     * @param  \App\User  $user
     * @param  \App\Channel  $channel
     * @return mixed
     */
    public function restore(User $user, Channel $channel)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the channel.
     *
     * @param  \App\User  $user
     * @param  \App\Channel  $channel
     * @return mixed
     */
    public function forceDelete(User $user, Channel $channel)
    {
        //
    }
}
