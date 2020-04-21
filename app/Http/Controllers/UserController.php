<?php

namespace App\Http\Controllers;

use App\User;
use App\UserHardBanned;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$ users = User::all();

        // return view('rest.user.index', compact(
        //     'users'
        // ));
        // return $users;
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('rest.user.create');
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
        $data = $this->validateDate();

        $user = User::create($data);

        return redirect('/users/' . $user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        if(UserHardBanned::where('user_id', $user->id)->first()){
            $user->hardBanned = true;
        }

        return view('rest.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('rest.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $data = $this->validateData();

        $user->update($data);

        return redirect('/users/' . $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // TODO: is it okay to delete users ?
        abort(404);
    }


    private function validateData()
    {
        return request()->validate([
            'name' => 'required',
            'surname' => 'required',
            'username' => 'required',
            'birth_date' => 'required',
            'email' => 'required',
            //'password' => 'required',
            'group_id' => 'required',
        ]);
    }

    public function notifications()
    {
        return auth()->user()->unreadNotifications()->get()->toArray();
    }
}
