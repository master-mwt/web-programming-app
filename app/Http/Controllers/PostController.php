<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostTag;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('rest.post.index', compact(
            'posts'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rest.post.create');
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
        //retrieve tags from request
        $tags_array = $request->input('tags');
        //string->array_of_strings tags explosion
        $tags_exploded = explode(" ", $tags_array);
        //add # to tags that doesn't start with #
        $tags_nu = [];
        foreach ($tags_exploded as $tag_exploded) {
            if($tag_exploded[0] != '#') {
                array_push($tags_nu, '#'.$tag_exploded);
            } else {
                array_push($tags_nu, $tag_exploded);
            }
        }
        //remove duplicate tags
        $tags = array_unique($tags_nu);

        $this->authorize('create', [Post::class, $data['channel_id']]);

        $post = Post::create($data);

        foreach ($tags as $tag) {
            //if tag is new
            if(is_null(Tag::where('name', $tag)->first()))
            {
                DB::beginTransaction();
                try {
                    //INSERT new tag
                    //RETRIEVE new tag object from db (for id)
                    //INSERT RELATION post-tag
                    Tag::create(['name' => $tag]);
                    $tag = Tag::where('name', $tag)->first();
                    PostTag::create(['post_id' => $post->id, 'tag_id' => $tag->id]);

                    DB::commit();
                } catch(\Exception $e) {
                    DB::rollBack();

                    abort(500);
                }
            //if tag is NOT new
            } else {
                DB::beginTransaction();
                try {
                    //RETRIEVE new tag object from db (for id)
                    //INSERT RELATION post-tag
                    $tag = Tag::where('name', $tag)->first();
                    PostTag::create(['post_id' => $post->id, 'tag_id' => $tag->id]);

                    DB::commit();
                } catch(\Exception $e) {
                    DB::rollBack();

                    abort(500);
                }
            }
        }

        return redirect('/discover/post/' . $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('rest.post.show', compact(
            'post'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('rest.post.edit', compact(
            'post'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $this->validateData();

        $post->update($data);

        return redirect('/posts/' . $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        if(request()->ajax()){
            return response()->json(null, 204);
        } else {
            return redirect('/posts');
        }
    }


    private function validateData()
    {
        return request()->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
    }
}
