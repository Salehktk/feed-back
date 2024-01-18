<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Services\CommentService;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store(CommentRequest $request, $feedbackId)
    {
        $this->commentService->createComment(
            $feedbackId,
            auth()->user()->id,
            $request->input('content')
        );

        return redirect()->back()->with('success', 'Comment added successfully.');
    }
}
