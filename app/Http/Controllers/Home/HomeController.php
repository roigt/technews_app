<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;

class HomeController extends Controller
{
    public function index(){
        $articles = Article::where('isActive',1)->orderBy('created_at','DESC')->limit(10)->get();
        $categories= Category::where('isActive',1)->orderBy('created_at','DESC')->with('articles')->get();
        $famous_articles = Article::where('isActive',1)
            ->orderBy('created_at','DESC')
            ->orderBy('views','DESC')
            ->limit(10)->get();

        return view('front.home',[
                'articles'=>$articles,
                'categories'=>$categories,
                'famous_articles'=>$famous_articles,
            ]
        );
    }
}
