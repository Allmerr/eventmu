<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {

        $rules = [
            'type' => 'required|in:post,comment',
            'content' => 'required|string',
        ];

        if($request->type == 'post'){
            $rules['post_id'] = 'required|exists:posts,id';
        }else{
            $rules['comment_id'] = 'required|exists:comments,id';
        }

        $validatedData = $request->validate($rules);

        $validatedData['user_id'] = auth()->user()->id;

        Comment::create($validatedData);

        return redirect()->back()->with('success', 'Comment created successfully');

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
    public function update(Request $request, Comment $comment)
    {
        $rules = [
            'content' => 'required|string',
        ];

        $validatedData = $request->validate($rules);

        $comment->update($validatedData);

        return redirect()->back()->with('success', 'Comment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Comment $comment)
    {
        $comment->update(['is_deleted' => '1']);

        return redirect()->back()->with('success', 'Comment deleted successfully');
    }
}
