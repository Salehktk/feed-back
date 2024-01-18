<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feedback</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- Styles -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f3f4f6;
            color: #1c1c1c;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            text-align: center;
            max-width: 800px;
            width: 100%;
            padding: 0 20px;
        }

        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin: 20px;
            padding: 20px;
            width: 100%;
            text-align: left;
            transition: transform 0.3s;
            box-sizing: border-box;
        }

        .card:hover {
            transform: scale(1.03);
        }

        .comment {
            margin-top: 15px;
            padding: 15px;
            background-color: #f7f7f7;
            border-radius: 12px;
            display: flex;
            align-items: flex-start;
        }

        .comment .user-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #3498db;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }

        .comment-content {
            flex-grow: 1;
        }

        .comment-content p {
            margin: 0;
        }

        .feedback-link {
            text-decoration: none;
            background-color: #3498db;
            color: white;
            padding: 15px 25px;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 30px;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .feedback-link:hover {
            background-color: #2980b9;
        }

        .header {
            background-color: #3498db;
            padding: 30px;
            color: white;
            font-size: 28px;
            font-weight: bold;
            border-radius: 8px 8px 0 0;
            margin-bottom: 30px;
        }

        .feedback-title {
            color: #3498db;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .comments-container {
            margin-top: 20px;
            display: none; /* Hide comments by default */
        }

        .comment-form {
            margin-top: 20px;
        }

        .comment-form textarea {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: vertical; /* Allow vertical resizing */
        }

        .comment-form button {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .comment-form button:hover {
            background-color: #2980b9;
        }

        .comment-icon {
            cursor: pointer;
            
            color: #3498db;
     
        }

        .user-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .user-info .user-name {
            display: flex;
            align-items: center;
        }

        .user-info .user-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #3498db;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }

        .user-info strong {
            font-size: 18px;
        }

        .comment-date {
            font-size: 12px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Feedback App</div>
        <a href="{{ route('feedback.create') }}" class="feedback-link">Submit Feedback</a>

        @foreach($feedbacks as $feedback)
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
                    <div class="comment-form {{ (auth()->check() ? '' : 'd-none')}}">
                        <form method="post" action="{{ route('comment.store', ['feedback' => $feedback->id]) }}">
                            @csrf
                            <textarea name="content" placeholder="Add a comment" rows="3" required></textarea>
                            <button type="submit">Post Comment</button>
                        </form>
                    </div>
                    <p class="{{ (auth()->check() ? 'd-none' : '')}}">Please <a class= "comment-icon" href="{{ route('login') }}">log in</a> to add a comment.</p>
                    @foreach($feedback->comments as $comment)
                        <div class="comment">
                            <div class="user-icon">{{ substr($comment->user->name, 0, 1) }}</div>
                            <div class="comment-content">
                                <strong>{{ $comment->user->name }}</strong>
                                <small class="comment-date">{{ $comment->created_at->format('F d, Y \a\t h:i A') }}</small>
                                <p>{{ $comment->comment }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                
                <p class="comment-icon" onclick="toggleComments(this)">
                    <i class="fa fa-comment"></i> Comments
                </p>
            </div>
        @endforeach
    </div>

    <script>
        function toggleComments(icon) {
            const commentsContainer = icon.parentElement.querySelector('.comments');
            commentsContainer.style.display = (commentsContainer.style.display === 'none' || commentsContainer.style.display === '') ? 'block' : 'none';
        }
    </script>
</body>
</html>
