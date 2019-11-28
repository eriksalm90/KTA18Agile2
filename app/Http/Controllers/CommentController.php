<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::with('user')->get();
        return $comments;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = new Comment();
        if ($request->has('body')){
            $request->body = $request->input('body');
            $request->user_id=1;
            $request->post_id=1;
            $request->save();
            return $comment;
        }
        return response()->json(['error' => 'invalid parameters provided'], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return Comment
     */
    public function show(Comment $comment)
    {
        return $comment->load(['user','post']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        if ($request->has('title')){
            $comment->title = $request->input('title');
        }
        if ($request->has('body')){
            $comment->body = $request->input('body');
        }
        if ($comment->isDirty()){
            $comment->save();
        }
        return $comment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json(['status'=>'OK']);
    }
}
