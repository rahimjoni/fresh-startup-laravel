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

    public function mail(){
        $pageInfo = [
            'pageTitle' => 'Mail Settings',
            'menu' => 'mail'
        ];
        return view('backend.settings.mail')->with($pageInfo);
    }

    public function mailUpdate(Request $request){

        $this->validate($request,[
            'MAIL_MAILER'          => 'string|max:255',
            'MAIL_HOST'            => 'nullable|string|max:255',
            'MAIL_PORT'            => 'nullable|string|max:255',
            'MAIL_USERNAME'        => 'nullable|string|max:255',
            'MAIL_PASSWORD'        => 'nullable|string|max:255',
            'MAIL_ENCRYPTION'      => 'nullable|string|max:255',
            'MAIL_FROM_ADDRESS'    => 'nullable|email|max:255',
            'MAIL_FROM_NAME'       => 'nullable|string|max:255',
        ]);

        Settings::updateOrCreate(['name'=>'MAIL_MAILER'],['value' =>$request->get('MAIL_MAILER')]);
        Artisan::call("env:set MAIL_MAILER='".$request->get('MAIL_MAILER')."'");

        Settings::updateOrCreate(['name'=>'MAIL_HOST'],['value' =>$request->get('MAIL_HOST')]);
        Artisan::call("env:set MAIL_HOST='".$request->get('MAIL_HOST')."'");

        Settings::updateOrCreate(['name'=>'MAIL_PORT'],['value' =>$request->get('MAIL_PORT')]);
        Artisan::call("env:set MAIL_PORT='".$request->get('MAIL_PORT')."'");

        Settings::updateOrCreate(['name'=>'MAIL_USERNAME'],['value' =>$request->get('MAIL_USERNAME')]);
        Artisan::call("env:set MAIL_USERNAME='".$request->get('MAIL_USERNAME')."'");

        Settings::updateOrCreate(['name'=>'MAIL_PASSWORD'],['value' =>$request->get('MAIL_PASSWORD')]);
        Artisan::call("env:set MAIL_PASSWORD='".$request->get('MAIL_PASSWORD')."'");

        Settings::updateOrCreate(['name'=>'MAIL_ENCRYPTION'],['value' =>$request->get('MAIL_ENCRYPTION')]);
        Artisan::call("env:set MAIL_ENCRYPTION='".$request->get('MAIL_ENCRYPTION')."'");

        Settings::updateOrCreate(['name'=>'MAIL_FROM_ADDRESS'],['value' =>$request->get('MAIL_FROM_ADDRESS')]);
        Artisan::call("env:set MAIL_FROM_ADDRESS='".$request->get('MAIL_FROM_ADDRESS')."'");

        Settings::updateOrCreate(['name'=>'MAIL_FROM_NAME'],['value' =>$request->get('MAIL_FROM_NAME')]);
        Artisan::call("env:set MAIL_FROM_NAME='".$request->get('MAIL_FROM_NAME')."'");

        notify()->success('Setting Successfully Updated.', 'Updated');
        return redirect()->back();
    }

    private function deleteOldLogo($path)
    {
        Storage::disk('public')->delete($path);
    }
}
