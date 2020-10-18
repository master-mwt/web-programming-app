<?php

namespace App\Http\Controllers;

use App\DataTables\ChannelDataTable;
use App\DataTables\CommentDataTable;
use App\DataTables\PostDataTable;
use App\DataTables\ReplyDataTable;
use App\DataTables\TagDataTable;
use App\DataTables\UserDataTable;
use App\User;
use App\UserHardBanned;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PageBackendController extends Controller
{
    public function backendChannels(ChannelDataTable $dataTable)
    {
        return $dataTable->render('backend.channels');
    }

    public function backendTags(TagDataTable $dataTable)
    {
        return $dataTable->render('backend.tags');
    }

    public function backendPosts(PostDataTable $dataTable)
    {
        return $dataTable->render('backend.posts');
    }

    public function backendReplies(ReplyDataTable $dataTable)
    {
        return $dataTable->render('backend.replies');
    }

    public function backendComments(CommentDataTable $dataTable)
    {
        return $dataTable->render('backend.comments');
    }

    public function backendUsers(UserDataTable $dataTable)
    {
        return $dataTable->render('backend.users');
    }

    public function hardBanUser(User $user)
    {
        $this->authorize('banUserFromPlatform', User::class);

        $hardBannedAlready = UserHardBanned::where('user_id', $user->id)->first();

        if($hardBannedAlready){
            return back();
        }

        UserHardBanned::create(['user_id' => $user->id]);

        Log::info('User ' . auth()->user()->id . ' (' . auth()->user()->username .  ')' . ' has hardbanned user ' . $user->id . ' (' . $user->username .  ')');

        return back();
    }

    public function unHardBanUser(User $user)
    {
        $this->authorize('banUserFromPlatform', User::class);

        $hardBannedAlready = UserHardBanned::where('user_id', $user->id)->first();

        if(!$hardBannedAlready){
            return back();
        }

        $hardBannedAlready->delete();

        Log::info('User ' . auth()->user()->id . ' (' . auth()->user()->username .  ')' . ' has unhardbanned user ' . $user->id . ' (' . $user->username .  ')');

        return back();
    }
}
