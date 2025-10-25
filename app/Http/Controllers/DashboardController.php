<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user=Auth::user();
        $userRoles=$user->roles->pluck('name')->toArray();
        $firstRole=$user->roles->pluck('name')->first();

        if(in_array('admin',$userRoles)){
           $articles=Article::all();
        }else if($firstRole=='author' && count($userRoles)==1){
           $author_articles= Article::where('author_id',$user->id)->get();
        }
        $recent_articles=Article::where('isActive',1)->orderBy('created_at','desc')->take(10)->get();
        $categories=Category::count();

        return view('back.dashboard', [
            'author_articles' => $firstRole == 'author' ? $author_articles : null,
            'recent_articles' => $recent_articles,
            'categories'      => $categories,
            'articles'        => $articles ?? null,
        ]);

    }
}
