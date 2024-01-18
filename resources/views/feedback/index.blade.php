<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feedback</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    <div class="container">
        <div class="header">Feedback App</div>
        <a href="{{ route('feedback.create') }}" class="feedback-link">Submit Feedback</a>

        @foreach ($feedbacks as $feedback)
            <div class="card">
                <div class="user-info">
                    <div class="user-name">
                        <div class="user-icon">{{ substr($feedback->user->name, 0, 1) }}</div>
                        <strong>{{ $feedback->user->name }}</strong>
                    </div>
                    <p class="comment-date">{{ $feedback->created_at->format('F d, Y \a\t h:i A') }}</p>
                </div>
                <div class="feedback-title">{{ $feedback->title }}</div>
                <p>{{ $feedback->description }}</p>

                <div class="comments mt-4" style="display: none;">
                    <div class="comment-form {{ auth()->check() ? '' : 'd-none' }}">
                        <form method="post" action="{{ route('comment.store', ['feedback' => $feedback->id]) }}">
                            @csrf
                            <input id="comment-content" type="hidden" name="content">
                            <div class="mention-container">
                                <trix-editor input="comment-content" placeholder="Add a comment"></trix-editor>
                                <div id="user-list"></div>
                            </div>
                            <div class="suggestion-list" id="suggestion-list"></div>
                            <button type="submit">Post Comment</button>
                        </form>
                    </div>
                    <p class="{{ auth()->check() ? 'd-none' : '' }}">Please <a class= "comment-icon"
                            href="{{ route('login') }}">log in</a> to add a comment.</p>
                    @foreach ($feedback->comments as $comment)
                        <div class="comment">
                            <div class="user-icon">{{ substr($comment->user->name, 0, 1) }}</div>
                            <div class="comment-content">
                                <strong>{{ $comment->user->name }}</strong>
                                <small
                                    class="comment-date">{{ $comment->created_at->format('F d, Y \a\t h:i A') }}</small>
                                <p>{!! $comment->comment !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <p class="comment-icon" onclick="toggleComments(this)">
                    <i class="fa fa-comment"></i> Comments
                </p>
            </div>
        @endforeach
        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $feedbacks->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>
