<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function general(){
        $pageInfo = [
            'pageTitle' => 'General Settings',
            'menu' => 'users'
        ];
        return view('backend.settings.general')->with($pageInfo);
    }

    public function generalUpdate(Request $request){

        $this->validate($request,[
            'site_title'          => 'required',
            'site_description'    => 'nullable',
            'site_address'        => 'nullable',
        ]);

        Settings::updateOrCreate(['name'=>'site_title'],['value' =>$request->get('site_title')]);
        Settings::updateOrCreate(['name'=>'site_description'],['value' =>$request->get('site_description')]);
        Settings::updateOrCreate(['name'=>'site_address'],['value' =>$request->get('site_address')]);

        notify()->success('Setting Successfully Updated.', 'Updated');
        return redirect()->back();
    }
}
