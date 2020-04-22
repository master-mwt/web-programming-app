<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $images = Image::all();

        // return view('rest.image.index', compact(
        //     'images'
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
        // return view('rest.image.create');
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
        // $data = $this->validateData();

        // $image = Image::create($data);

        // return redirect('/images/' . $image->id);
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        // return view('rest.image.show', compact(
        //     'image'
        // ));

        if(request()->ajax()){
            return response()->json($image, 200);
        }
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        // return view('rest.image.edit', compact(
        //     'image'
        // ));
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        // $data = $this->validateData();

        // $image->update($data);

        // return redirect('/images/' . $image->id);
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        // $image->delete();
        // return redirect('/images');
        abort(404);
    }


    private function validateData()
    {
        return request()->validate([
            'type' => 'required',
            'size' => 'required',
            'location' => 'required',
            'caption' => 'required',
        ]);
    }
}
