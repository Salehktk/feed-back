<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feedback</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

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
            padding: 10px;
            background-color: #f7f7f7;
            border-radius: 5px;
        }

        .comment .avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }

        .comment-content {
            display: flex;
            align-items: flex-start;
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
            font-size: 20px;
            color: #3498db;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Feedback App</div>
        <a href="{{ route('feedback.create') }}" class="feedback-link">Submit Feedback</a>

        @foreach($feedbacks as $feedback)
            <div class="card">
                <div class="feedback-title">{{ $feedback->title }}</div>
                <p>{{ $feedback->description }}</p>

                <div class="comments mt-4">
                    <div class="feedback-title">Comments</div>
                    <div class="comment-icon" onclick="toggleComments(this)">▼</div>
                    @foreach($feedback->comments as $comment)
                        <div class="comment">
                            <div class="comment-content">
                                <img src="user-avatar.jpg" alt="User Avatar" class="avatar">
                                <div>
                                    <strong>{{ $comment->user->name }}</strong>
                                    <p>{{ $comment->content }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="comment-form">
                    <form method="post" action="">
                        @csrf
                        <textarea name="content" placeholder="Add a comment" rows="3" required></textarea>
                        <button type="submit">Post Comment</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        function toggleComments(icon) {
            const commentsContainer = icon.nextElementSibling;
            commentsContainer.style.display = (commentsContainer.style.display === 'none' || commentsContainer.style.display === '') ? 'block' : 'none';
        }
    </script>
</body>
</html>
