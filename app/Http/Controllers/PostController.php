<?php

namespace App\Http\Controllers;

use App\Notifications\NewNotification;
use App\Post;
use App\PostTag;
use App\Tag;
use App\Image;
use App\UserChannelRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();

        // return view('rest.post.index', compact(
        //     'posts'
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
        // return view('rest.post.create');
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Faker $faker)
    {
        $data = $this->validateData();

        $data['user_id'] = Auth::User()->id;
        $data['channel_id'] = $request->input('channel_id');

        $this->authorize('create', [Post::class, $data['channel_id']]);

        if(is_null($request->images))
        {
            //create the post if there are no images
            $post = Post::create($data);
        }

        if(!is_null($request->tags))
        {
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
        }

        if(!is_null($request->images))
        {
            //images validation
            $validator = $request->validate([
                'images' => 'required',
                'images.*' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            ]);

            //create the post if there are images
            $post = Post::create($data);

            //retrieve images from request
            $images = $request->images;
            //cycle counter (for unique naming, multiple upload)
            $i = 0;

            foreach($images as $image) {
                $imagename = time().$i.'.'.$image->extension();

                $image->move(public_path('imgs_cstm/posts'), $imagename);

                $imagegetsize = getimagesize('imgs_cstm/posts/'.$imagename);

                $data2['type'] = $imagegetsize['mime'];
                $data2['size'] = $imagegetsize[0].'x'.$imagegetsize[1];
                $data2['location'] = '/imgs_cstm/posts/'.$imagename;
                $data2['caption'] = $faker->sentence;
                $data2['post_id'] = $post->id;

                Image::create($data2);

                $i++;
            }
        }

        /* NOTIFICATION */
        $users_in_channel = UserChannelRole::where('channel_id', $data['channel_id'])->get();
        $channel = \App\Channel::find($data['channel_id']);
        foreach ($users_in_channel as $user_in_channel){
            if($user_in_channel->user_id === $data['user_id']){
                continue;
            }
            $user = \App\User::find($user_in_channel->user_id);
            $user->notify(new NewNotification('New post on channel ' . $channel->name . "!", $post->id, $data['user_id']));
        }
        /* END NOTIFICATION */

        if(!is_null($request->tags))
        {
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
        // return view('rest.post.edit', compact(
        //     'post'
        // ));
        abort(404);
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
        // $data = $this->validateData();

        // $post->update($data);

        // return redirect('/posts/' . $post->id);
        abort(404);
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
