<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact\StoreContactRequest;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class FrontCategoryController extends Controller
{
    public function index(string $slug){
        $category = Category::where('slug',$slug)->where('isActive',true)->with('articles')->first();
        return view('front.partials.category',compact('category'));
    }


}
