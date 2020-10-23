<?php

namespace App\Http\Controllers;

use App\Channel;
use App\UserChannelRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $channels = Channel::all();

        // return view('rest.channel.index', compact(
        //     'channels'
        // ));
        // return $channels;
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rest.channel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validateData();

        $this->authorize('create', Channel::class);

        $image_channel_default = \App\Image::where('location', '/imgs/no_channel_img.jpg')->first();
        $data['image_id'] = $image_channel_default->id;

        DB::beginTransaction();
        try {
            $channel = Channel::create($data);
            UserChannelRole::create(['user_id' => $channel->creator_id, 'channel_id' => $channel->id, 'role_id' => 1]);

            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();

            abort(500);
        }

        Log::info('User ' . auth()->user()->id . ' (' . auth()->user()->username .  ')' . ' has created channel ' . $channel->id . ' (' . $channel->name .  ')');

        if(auth()->user()->group_id == 1)
        {
            return redirect('/backend/channels');
        }
        else
        {
            return redirect('/discover/channel/' . $channel->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel)
    {
        return view('rest.channel.show', compact(
            'channel'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function edit(Channel $channel)
    {
        $this->authorize('update', $channel);

        return view('rest.channel.edit', compact(
            'channel'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Channel $channel)
    {
        $this->authorize('update', $channel);

        $data = $this->validateData();

        $channel->update($data);

        if(auth()->user()->group_id == 1)
        {
            return redirect('/channels/' . $channel->id);
        }
        else
        {
            return redirect('/discover/channel/' . $channel->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel)
    {
        $this->authorize('delete', $channel);

        $channel->delete();

        Log::info('User ' . auth()->user()->id . ' (' . auth()->user()->username .  ')' . ' has deleted channel ' . $channel->id . ' (' . $channel->name .  ')');

        if(auth()->user()->group_id == 1)
        {
            return redirect('/backend/channels');
        }
        else
        {
            return redirect('/home');
        }
    }


    private function validateData()
    {
        return request()->validate([
            'name' => 'required',
            'title' => 'required',
            'description' => 'required',
            'rules' => 'required',
            'creator_id' => 'required',
        ]);
    }
}
