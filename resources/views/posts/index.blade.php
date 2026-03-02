<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Posts</title>
</head>
<body>
<h1>投稿一覧</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('posts.store') }}">
    @csrf
    <textarea name="post" rows="4" cols="60" maxlength="400">{{ old('post') }}</textarea>
    <div>
        <button type="submit">投稿</button>
    </div>
</form>

<hr>

@foreach ($posts as $post)
    <div style="margin: 12px 0;">
        <div style="display:flex; align-items:center; gap:10px;">
            <img
                src="{{ asset('images/' . ($post->user->image ?? 'dawn.png')) }}"
                width="32" height="32" style="border-radius:50%;"
                alt="icon"
            >
            <strong>{{ $post->user->name }}</strong>
            <small>{{ $post->created_at }}</small>
        </div>

        <p>{{ $post->post }}</p>

        @if ($post->user_id === auth()->id())
          <form method="POST" action="{{ route('posts.destroy', $post) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('削除しますか？')">削除</button>
          </form>
        @endif

    </div>
@endforeach
</body>
</html>
