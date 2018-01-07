<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $groups = $user->groups;

        return view('user.groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::id();
        return view('user.groups.create', compact('user_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $group = Group::create([
            'name' => $request->name,
            'user_id' => $request->user_id
        ]);

        return redirect()->route('collections');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Group::find($id);
        $owner_id = $group->user_id;
        $users = $group->groupUsers;

        return view('user.groups.edit', compact('group', 'owner_id', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $group = Group::find($id);
        $group->name = $request->name;
        $group->update();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deleteUser($group_id, $user_id)
    {
        $user = User::find($user_id);
        $group = Group::find($group_id);
        $group->groupUsers()->detach($user);

        return redirect()->back();
    }

    public function addUser(Request $request)
    {
        $group = Group::find($request->group_id);
        $user = User::where('email', $request->email)->first();
        if ($user != null) {
            $group->groupUsers()->attach($user);
        }

        return redirect()->back();
    }
}
