<?php
namespace App\Services;

use App\Models\Comment;

class CommentService
{
    public function createComment($feedbackId, $userId, $content)
    {
        return Comment::create([
            'feedback_id' => $feedbackId,
            'user_id' => $userId,
            'comment' => $content,
            'status' => 1
        ]);
    }
}
