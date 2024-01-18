<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FeedbackService;

class FeedbackController extends Controller
{
    protected $feedbackService;

    public function __construct(FeedbackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }

    public function index()
    {
        $feedbacks = $this->feedbackService->getAllFeedback();
        return view('feedback.index', compact('feedbacks'));
    }

    public function createForm()
    {
        return view('feedback.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
        ]);

        $this->feedbackService->submitFeedback(
            auth()->user()->id,
            $request->title,
            $request->description,
            $request->category
        );

        return redirect()->route('feedback.create')->with('success', 'Feedback submitted successfully!');
    }
}
