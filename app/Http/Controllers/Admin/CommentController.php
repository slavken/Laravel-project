<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Services\CommentService;

class CommentController extends Controller
{
    function __construct(CommentService $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::with(['post', 'user'])
            ->latest()
            ->paginate();
        $waitingComments = Comment::with('user')
            ->inActive()
            ->latest()
            ->paginate(5);

        return view('home.admin.comments.index', [
            'comments' => $comments, 
            'waitingComments' => $waitingComments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        $this->authorize('update-comments');
        return view('home.admin.comments.edit', ['comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, Comment $comment)
    {
        $this->authorize('update-comments');
        $this->comment->edit($request, $comment);

        return redirect()
            ->route('comments.index')
            ->with('status', 'The comment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete-comments');
        $comment->delete();

        return redirect()
            ->route('comments.index');
    }

    public function confirm($id)
    {
        $this->authorize('update-comments');
        $this->comment->confirm((int) $id);

        return redirect()
            ->route('comments.index');
    }
}
