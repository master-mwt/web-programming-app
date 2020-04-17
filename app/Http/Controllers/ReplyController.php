<?php

namespace App\Http\Controllers;

use Auth;
use App\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $replies = Reply::all();

        return view('rest.reply.index', compact(
            'replies'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rest.reply.create');
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

        $data['user_id'] = Auth::User()->id;
        $data['channel_id'] = $request->input('channel_id');
        $data['post_id'] = $request->input('post_id');

        $this->authorize('create', [Reply::class, $data['channel_id']]);

        $reply = Reply::create($data);

        //return redirect('/replies/' . $reply->id);
        return redirect('/discover/post/' . $reply->post_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Reply $reply)
    {
        return view('rest.reply.show', compact(
            'reply'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $reply)
    {
        return view('rest.reply.edit', compact(
            'reply'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reply $reply)
    {
        $data = $this->validateData();

        $reply->update($data);

        return redirect('/replies/' . $reply->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        $this->authorize('delete', $reply);

        $reply->delete();

        if(request()->ajax()){
            return response()->json(null, 204);
        } else {
            return redirect('/replies');
        }
    }


    private function validateData()
    {
        return request()->validate([
            'content' => 'required',
        ]);
    }
}
