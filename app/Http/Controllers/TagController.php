<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tags = Tag::all();

        // return view('rest.tag.index', compact(
        //     'tags'
        // ));
        // return $tags;
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rest.tag.create');
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

        if($data['name'][0] != '#')
            $data['name'] = '#'.$data['name'];
        
        $tag_check = Tag::where('name', $data['name'])->first();
        if(is_null($tag_check)){
            $tag = Tag::create($data);
            return redirect('/tags/' . $tag->id);
        } else {
            abort(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view('rest.tag.show', compact(
            'tag'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('rest.tag.edit', compact(
            'tag'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $data = $this->validateData();
        
        if($data['name'][0] != '#')
            $data['name'] = '#'.$data['name'];

        $tag_check = Tag::where('name', $data['name'])->first();
        if(is_null($tag_check)){
            $tag->update($data);
            return redirect('/tags/' . $tag->id);
        } else {
            abort(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        
        return redirect('/backend/tags');
    }

    private function validateData()
    {
        return request()->validate([
            'name' => 'required',
        ]);
    }
}
