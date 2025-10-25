<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\settings\SettingsRequest;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{


    public function index()
    {
        return view('back.settings.index',
            ['settings'=>Settings::where('id',1)->first()]);
    }

    public function update(SettingsRequest $request)
    {
        $request->validated($request->all());
        $setting=Settings::where('id',1)->first();

        //gestion logo avec storage
        $logo = $request->image;
        if($logo !=null && !$logo->file('image')->getError()){
            if($setting->logo){//supprimer l ancien image
                Storage::disk('public')->delete($setting->logo);
            }
            $logo= $request->image->store('asset','public');
        }
        //fin

        $setting->update([
            'web_site_name'=>$request->web_site_name,
            'logo'=>$logo,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'about'=>$request->about
        ]);

        return back()->with('success','Settings updated successfully');
    }
}
