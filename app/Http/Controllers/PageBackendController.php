<?php

namespace App\Http\Controllers;

use App\DataTables\ChannelDataTable;
use Illuminate\Http\Request;

class PageBackendController extends Controller
{
    public function backendChannel(ChannelDataTable $dataTable)
    {
        return $dataTable->render('backend.channels');
    }
}
