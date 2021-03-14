<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.pages.index');
        $pageInfo = [
            'pageTitle' => 'Pages',
            'menu' => 'pages'
        ];
        $pages = Page::latest('id')->get();
        return view('backend.pages.index',compact('pages'))->with($pageInfo);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.pages.create');
        $pageInfo = [
            'pageTitle' => 'Page Create',
            'menu' => 'page_create'
        ];
        return view('backend.pages.form')->with($pageInfo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        Gate::authorize('app.pages.create');

        $this->validate($request,[
            'title'         => 'required|string|unique:pages',
            'body'          => 'required|string',
            'image'         => 'nullable|image',
        ]);

        $page = Page::create([
            'title'             =>$request->title,
            'slug'              =>Str::slug($request->title),
            'excerpt'           =>$request->excerpt,
            'body'              =>$request->body,
            'meta_description'  =>Hash::make($request->meta_description),
            'meta_keyword'      =>Hash::make($request->meta_keyword),
            'status'            =>$request->status,
        ]);

        if ($request->hasFile('image'))
        {
            $page->addMedia($request->image)->toMediaCollection('image');
        }
        notify()->success('Page Successfully Added.', 'Added');
        return redirect()->route('admin.pages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        Gate::authorize('app.pages.create');
        $pageInfo = [
            'pageTitle' => 'Page Edit',
            'menu' => 'pages'
        ];
        return view('backend.pages.form',compact('page'))->with($pageInfo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Page $page)
    {
        Gate::authorize('app.pages.create');

        $this->validate($request,[
            'title'         => 'required|string|unique:pages,title,'.$page->id,
            'body'          => 'required|string',
            'image'         => 'nullable|image',
        ]);

        $page->update([
            'title'             =>$request->title,
            'slug'              =>Str::slug($request->title),
            'excerpt'           =>$request->excerpt,
            'body'              =>$request->body,
            'meta_description'  =>Hash::make($request->meta_description),
            'meta_keyword'      =>Hash::make($request->meta_keyword),
            'status'            =>$request->status,
        ]);

        if ($request->hasFile('image'))
        {
            $page->addMedia($request->image)->toMediaCollection('image');
        }
        notify()->success('Page Successfully Updated.', 'Update');
        return redirect()->route('admin.pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */

    public function destroy(Page $page)
    {
        Gate::authorize('app.pages.destroy');
        $page->delete();
        notify()->success("Page Successfully Deleted", "Deleted");
        return back();
    }
}
