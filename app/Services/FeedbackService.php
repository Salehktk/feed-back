<?php

namespace App\Services;

use App\Models\Feedback;

class FeedbackService
{

    public function getAllFeedback()
    {
        return Feedback::latest()->paginate(5);
    }
    public function submitFeedback($userId, $title, $description, $category)
    {
        return Feedback::create([
            'user_id' => $userId,
            'title' => $title,
            'description' => $description,
            'category' => $category,
        ]);
    }
}
