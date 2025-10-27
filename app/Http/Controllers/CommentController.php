<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreCommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $comments = Comment::wherehas('article',function($query) use ($user){
              $query->where('author_id',$user->id);
        })->with('article')->get();

        return view('back.comment.comment', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Comment $comment)
    {
        $comment->isActive=false;
        $comment->update();
        return back()->with('success','commentaire bloqué avec succes!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success','commentaire supprimer avec succes!!');
    }

    public function active(Comment $comment){
        if(!$comment->isActive) $comment->update(['isActive'=>true]);
        return back()->with('success','commentaire activé avec succes!!');
    }
}
