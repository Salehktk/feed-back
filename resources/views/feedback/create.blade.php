@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Submit Feedback</div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form method="post" action="{{ route('feedback.store') }}">
                @csrf

                <div class="form-group">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required placeholder="Enter Title">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required placeholder="Enter Description">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category">Category <span class="text-danger">*</span></label>
                    <select class="form-control @error('category') is-invalid @enderror" id="category" name="category" required>
                        <option value="" disabled selected>Select a category</option>
                        <option value="bug report" {{ old('category') == 'bug report' ? 'selected' : '' }}>Bug Report</option>
                        <option value="feature request" {{ old('category') == 'feature request' ? 'selected' : '' }}>Feature Request</option>
                        <option value="improvement" {{ old('category') == 'improvement' ? 'selected' : '' }}>Improvement</option>
                    </select>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit Feedback</button>
            </form>
        </div>
    </div>
@endsection
