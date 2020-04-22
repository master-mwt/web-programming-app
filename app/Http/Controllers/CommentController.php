<?php

namespace App\Http\Controllers;

use App\Notifications\NewNotification;
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
        // $comments = Comment::all();

        // return view('rest.comment.index', compact(
        //     'comments'
        // ));
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('rest.comment.create');
        abort(404);
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

        /* NOTIFICATION */
        $comment_list = Comment::where('reply_id', $data['reply_id'])->get();
        $channel = \App\Channel::find($data['channel_id']);
        $reply = \App\Reply::find($data['reply_id']);
        $post = \App\Post::find($reply->post_id);
        foreach ($comment_list as $single_comment){
            if($single_comment->user_id === $data['user_id']){
                continue;
            }
            $user = \App\User::find($single_comment->user_id);
            $user->notify(new NewNotification('New comment on reply in ' . $post->title . ' in ' . $channel->name . "!", $post->id, $data['user_id']));
        }

        $author = \App\User::find($reply->user_id);
        $author->notify(new NewNotification('New comment on your reply in post ' . $post->title . ' in ' . $channel->name . "!", $post->id, $data['user_id']));
        /* END NOTIFICATION */

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
        // return view('rest.comment.edit', compact(
        //     'comment'
        // ));
        abort(404);
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
        // $data = $this->validateData();

        // $comment->update($data);

        // return redirect('/comments/' . $comment->id);
        abort(404);
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
