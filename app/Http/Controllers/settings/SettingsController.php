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


        // Si il n'existe pas, on le crée
        if (!$setting) {
            $setting = new Settings();
            $setting->id = 1;
        }

        // LOGO
        $logo = $setting->logo ?? null; // garde l'ancien logo si pas de nouveau

        if ($request->hasFile('logo')) {
            if ($setting->logo) {
                Storage::disk('s3')->delete($setting->logo);
            }
            $logo = $request->file('logo')->store('images-settings', 's3');
        }

        //gestion logo avec storage
//        $logo = $request->image;
//        if($logo !=null && !$logo->file('image')->getError()){
//            if($setting->logo){//supprimer l ancien image
//               // Storage::disk('public')->delete($setting->logo);
//                Storage::disk('s3')->delete($setting->logo);
//            }
//           // $logo= $request->image->store('asset','public');
//            $logo = $request->file('image')->store('images-settings', 's3');
//        }
        //fin

        // ENREGISTREMENT
        $setting->web_site_name = $request->web_site_name;
        $setting->logo = $logo;
        $setting->address = $request->address;
        $setting->phone = $request->phone;
        $setting->email = $request->email;
        $setting->about = $request->about;
        $setting->save();

//        $setting->update([
//            'web_site_name'=>$request->web_site_name,
//            'logo'=>$logo,
//            'address'=>$request->address,
//            'phone'=>$request->phone,
//            'email'=>$request->email,
//            'about'=>$request->about
//        ]);

        return back()->with('success','Settings updated successfully');
    }
}
