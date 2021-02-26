<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.user.index');
        $pageInfo = [
            'pageTitle' => 'Users',
            'menu' => 'users'
        ];
        $users = User::all();
        return view('backend.users.index',compact('users'))->with($pageInfo);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.user.create');
        $pageInfo = [
            'pageTitle' => 'User Create',
            'menu' => 'users'
        ];
        $roles = Role::all();
        return view('backend.users.form',compact('roles'))->with($pageInfo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        Gate::authorize('app.user.create');

        $this->validate($request,[
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'password'      => 'required|confirmed|string|min:8',
            'role'          => 'required',
            'avatar'        => 'required|image',
        ]);

        $user = User::create([
            'role_id'       =>$request->role,
            'name'          =>$request->name,
            'email'         =>$request->email,
            'password'      =>Hash::make($request->password),
            'status'        =>$request->status,
        ]);

        if ($request->hasFile('avatar'))
        {
            $user->addMedia($request->avatar)->toMediaCollection('avatar');
        }
        notify()->success('User Successfully Added.', 'Added');
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        Gate::authorize('app.user.index');
        $pageInfo = [
            'pageTitle' => 'Users',
            'menu' => 'users'
        ];
        return view('backend.users.show',compact('user'))->with($pageInfo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        Gate::authorize('app.user.create');
        $pageInfo = [
            'pageTitle' => 'User Edit',
            'menu' => 'users'
        ];
        $roles = Role::all();
        return view('backend.users.form',compact('roles','user'))->with($pageInfo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request,[
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password'      => 'nullable|confirmed|string|min:8',
            'role'          => 'required',
            'avatar'        => 'nullable|image',
        ]);

        $user->update([
            'role_id'       =>$request->role,
            'name'          =>$request->name,
            'email'         =>$request->email,
            'password'      =>isset($request->password)? Hash::make($request->password): $user->password,
            'status'        =>$request->status,
        ]);

        if ($request->hasFile('avatar'))
        {
            $user->addMedia($request->avatar)->toMediaCollection('avatar');
        }
        notify()->success('User Successfully Update.', 'Added');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */

    public function destroy(User $user)
    {
        Gate::authorize('app.user.destroy');
            $user->delete();
            notify()->success("User Successfully Deleted", "Deleted");
        return back();
    }
}
