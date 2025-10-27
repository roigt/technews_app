<?php

namespace App\Http\Controllers\Detail;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Models\Article;
use App\Models\Comment;

class DetailController extends Controller
{
    public function index(string $slug){
        $article=Article::where('slug',$slug)->with(['comments' => function($q) {
            $q->orderBy('created_at', 'desc');
        }])->first();

        $new_view = $article->views +1;
        $article->views=$new_view;
        $article->update();

        return view('front.detail',['article_detail'=>$article]);
    }

    public function comment(StoreCommentRequest $request,int $id){
       $request->validated($request->all());

       Comment::create([
           'name'=>$request->name,
           'email'=>$request->email,
           'web_site'=>$request->web_site,
           'message'=>$request->message,
           'article_id'=>$id,
       ]);
        return back()->with('success','Comment added successfully');

    }

}
