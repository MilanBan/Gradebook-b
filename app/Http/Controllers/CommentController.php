<?php

namespace App\Http\Controllers;

use App\User;
use App\Comment;
use App\Gradebook;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($gradebook_id)
    {
        return Comment::where('gradebook_id', $gradebook_id)->get();
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
    public function store(Request $request, $gradebook_id)
    {
        $request->validate([
            'content' => 'required | max:1000'
        ]);
        
        $comment = new Comment();
        $comment->content = $request->input('content');

        $user = JWTAuth::parseToken()->authenticate();
        $comment->user_id = $user->id;
        $comment->gradebook_id = $gradebook_id;

        $gradebook = Gradebook::find($gradebook_id);
        $gradebook->comments()->save($comment);

        $user = User::find($comment->user_id);
        $user->comments()->save($comment);

        return $comment;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($gradebook_id, $comment_id)
    {
        $comment = Comment::find($comment_id);

        $comment->delete();

        return new JsonResponse(true);
    }
}
