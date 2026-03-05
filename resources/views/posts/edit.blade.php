<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>投稿編集</title>
</head>
<body>
<h1>投稿編集</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('posts.update', $post) }}">
    @csrf
    @method('PUT')

    <textarea name="post" rows="4" cols="60" maxlength="400">{{ old('post', $post->post) }}</textarea>

    <div>
        <button type="submit">更新</button>
    </div>
</form>

<a href="{{ route('posts.index') }}">戻る</a>

</body>
</html>
