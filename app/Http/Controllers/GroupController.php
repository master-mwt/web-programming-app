<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $groups = Group::all();

        // return view('rest.group.index', compact(
        //     'groups'
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
        // return view('rest.group.create');
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

        // $group = Group::create($data);

        // return redirect('/groups/' . $group->id);
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        // return view('rest.group.show', compact(
        //     'group'
        // ));
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        // return view('rest.group.edit', compact(
        //     'group'
        // ));
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        // $data = $this->validateData();

        // $group->update($data);

        // return redirect('/groups/' . $group->id);
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        // $group->delete();
        // return redirect('/groups');
        abort(404);
    }


    private function validateData()
    {
        return request()->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
    }
}
