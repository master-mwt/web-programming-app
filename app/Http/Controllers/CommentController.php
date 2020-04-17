<?php

namespace App\Http\Controllers;

use Auth;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();

        return view('rest.comment.index', compact(
            'comments'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rest.comment.create');
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
        $data['reply_id'] = $request->input('reply_id');

        $this->authorize('create', [Comment::class, $data['channel_id']]);

        $comment = Comment::create($data);

        $comment->post_id = $request->input('post_id');

        //return redirect('/comments/' . $comment->id);
        return redirect('/discover/post/' . $comment->post_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return view('rest.comment.show', compact(
            'comment'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('rest.comment.edit', compact(
            'comment'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $data = $this->validateData();

        $comment->update($data);

        return redirect('/comments/' . $comment->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        if(request()->ajax()){
            return response()->json(null, 204);
        } else {
            return redirect('/comments');
        }
    }


    private function validateData()
    {
        return request()->validate([
            'content' => 'required',
        ]);
    }
}
