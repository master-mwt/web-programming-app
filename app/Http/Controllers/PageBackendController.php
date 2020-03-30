<?php

namespace App\Http\Controllers;

use App\DataTables\ChannelDataTable;
use App\DataTables\CommentDataTable;
use App\DataTables\LogDataTable;
use App\DataTables\PostDataTable;
use App\DataTables\ReplyDataTable;
use App\DataTables\TagDataTable;
use App\DataTables\UserDataTable;
use Illuminate\Http\Request;

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

    public function backendLogs(LogDataTable $dataTable)
    {
        return $dataTable->render('backend.logs');
    }
}
