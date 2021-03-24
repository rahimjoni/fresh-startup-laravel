<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function general(){
        $pageInfo = [
            'pageTitle' => 'General Settings',
            'menu' => 'general'
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
        Artisan::call("env:set APP_NAME='".$request->get('site_title')."'");

        Settings::updateOrCreate(['name'=>'site_description'],['value' =>$request->get('site_description')]);
        Settings::updateOrCreate(['name'=>'site_address'],['value' =>$request->get('site_address')]);

        notify()->success('Setting Successfully Updated.', 'Updated');
        return redirect()->back();
    }
    public function appearance(){
        $pageInfo = [
            'pageTitle' => 'Appearance Settings',
            'menu' => 'appearance'
        ];
        return view('backend.settings.appearance')->with($pageInfo);
    }
    public function appearanceUpdate(Request $request){
        $this->validate($request,[
            'site_logo'          => 'nullable|image',
            'site_favicon'       => 'nullable|image',
        ]);

        if ($request->hasFile('site_logo')) {
            $this->deleteOldLogo(setting('site_logo'));
            Settings::updateOrCreate(
                ['name'=>'site_logo'],
                [
                    'value' =>Storage::disk('public')->putFile('logos', $request->file('site_logo'))
                ]
            );
        }
        if ($request->hasFile('site_favicon')) {
            $this->deleteOldLogo(setting('site_favicon'));
            Settings::updateOrCreate(
                ['name'=>'site_favicon'],
                [
                    'value' =>Storage::disk('public')->putFile('logos', $request->file('site_favicon'))
                ]
            );
        }
        notify()->success('Settings Successfully Updated.','Success');
        return back();
    }

    private function deleteOldLogo($path)
    {
        Storage::disk('public')->delete($path);
    }
}
