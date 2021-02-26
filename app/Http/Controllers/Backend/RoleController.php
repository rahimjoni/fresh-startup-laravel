<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.roles.index');
        $pageInfo = [
            'pageTitle' => 'Roles',
            'menu' => 'roles'
        ];
        $roles = Role::all();
        return view('backend.roles.index',compact('roles'))->with($pageInfo);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.roles.create');
        $pageInfo = [
            'pageTitle' => 'Roles Create',
            'menu' => 'roles'
        ];
        $modules = Module::all();
        return view('backend.roles.form',compact('modules'))->with($pageInfo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           'name'          => 'required|unique:roles',
           'permissions'   => 'required|array',
           'permissions.*' => 'integer',
        ]);

        Role::create([
            'name'      =>$request->name,
            'slug'      =>Str::slug($request->name),
        ])->permissions()->sync($request->input('permissions'),[]);

        notify()->success('Role Successfully Added.', 'Added');
        return redirect()->route('admin.roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        Gate::authorize('app.roles.edit');
        $pageInfo = [
            'pageTitle' => 'Roles Edit',
            'menu' => 'roles'
        ];
        $modules = Module::all();
        return view('backend.roles.form',compact('modules','role'))->with($pageInfo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $role->update([
            'name'      =>$request->name,
            'slug'      =>Str::slug($request->name),
        ]);
            $role->permissions()->sync($request->input('permissions'));
        notify()->success('Role Successfully Updated.', 'Updated');
        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        Gate::authorize('app.roles.destroy');

        if ($role->deletable) {
            $role->delete();
            notify()->success("Role Successfully Deleted", "Deleted");
        } else {
            notify()->error("You can\'t delete system role.", "Error");
        }
        return back();
    }
}
