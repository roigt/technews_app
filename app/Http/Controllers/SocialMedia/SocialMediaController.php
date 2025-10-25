<?php

namespace App\Http\Controllers\SocialMedia;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialMedia\StoreSocialMediaRequest;
use App\Http\Requests\SocialMedia\UpdateSocialMediaRequest;
use App\Models\SocialMedia;
use App\Services\IconService;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('back.social.index',[
            'socials' => SocialMedia::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('back.social.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSocialMediaRequest $request)
    {
        $request->validated($request->all());
        SocialMedia::create([
            'name'=>$request->name,
            'link'=>$request->link,
            'icon'=>IconService::resolveIcon($request->icon)
        ]);
        return to_route('social.index')->with('success','Social Media added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(SocialMedia $social)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SocialMedia $social)
    {
        return view('back.social.create',compact('social'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSocialMediaRequest $request, SocialMedia $social)
    {
        $request->validated($request->all());
        $social->update([
            'name'=>$request->name,
            'link'=>$request->link,
            'icon'=>IconService::resolveIcon($request->icon)
        ]);
       return  to_route("social.index")->with('success','Social Media updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialMedia $social)
    {
        $social->delete();
        return back()->with('success','Social Media deleted successfully');
    }
}
