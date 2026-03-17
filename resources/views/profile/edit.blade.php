<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>プロフィール編集</title>
</head>

<body>

<h1>プロフィール編集</h1>

<form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PUT')

<div>

<label>名前</label>

<input type="text" name="name" value="{{ $user->name }}">

</div>

<div>

<label>自己紹介<label>

<textarea name="bio">{{ $user->bio }}</textarea>

</div>

<button type="submit">

<label>更新<label>

</button>

</form>

</body>
</html>
