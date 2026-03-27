<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>投稿編集</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- ヘッダー -->
    <div class="top-header">
        <div class="top-header-left">
            <a href="{{ route('posts.index') }}">
                <img src="{{ asset('images/icons/main_logo.png') }}" alt="DAWNロゴ" class="top-logo">
            </a>
        </div>

        <class="top-header-right">
            <div class="top-user-wrapper" id="userMenuToggle">
                <span class="top-user-name">{{ Auth::user()->name }} さん</span>
                <span class="top-user-arrow">∨</span>
                <img
                    src="{{ asset('images/' . (Auth::user()->image ?: 'icons/dawn.png')) }}"
                    class="top-user-icon"
                >
            </div>

        <!-- ドロップダウン -->
        <div class="top-dropdown" id="userDropdown">

            <a href="{{ route('posts.index') }}" class="dropdown-item active">
                HOME
            </a>

            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                プロフィール編集
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="dropdown-item logout-btn">
                    ログアウト
                </button>
            </form>

        </div>
    </div>

    <!-- 全体 -->
    <div class="top-main">

        <!-- 左：編集エリア -->
        <div class="top-content">

            @if ($errors->any())
                <ul class="top-error-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="edit-post-wrap">
                <div class="edit-post-card">
                    <div class="edit-post-row">
                        <div class="edit-post-icon-wrap">
                            <img
                                src="{{ asset('images/' . (Auth::user()->image ?: 'icons/dawn.png')) }}"
                                alt="icon"
                                class="edit-post-icon"
                            >
                        </div>

                        <form method="POST" action="{{ route('posts.update', $post) }}" class="edit-post-form">
                            @csrf
                            @method('PUT')

                            <textarea
                                name="post"
                                rows="8"
                                maxlength="400"
                                class="edit-post-textarea"
                            >{{ old('post', $post->post) }}</textarea>

                            <div class="edit-post-actions">
                                <button type="submit" class="edit-post-submit">
                                    <img
                                        src="{{ asset('images/icons/edit.png') }}"
                                        alt="更新"
                                        class="edit-post-submit-icon"
                                    >
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <!-- 右：固定サイドバー -->
        <div class="top-sidebar">
            <div class="top-sidebar-box">

                <p class="top-sidebar-user">{{ Auth::user()->name }} さんの</p>

                <div class="top-sidebar-row">
                    <span>フォロー数</span>
                    <span>{{ $followCount ?? 0 }} 名</span>
                </div>

                <a href="{{ route('follow.list') }}" class="sidebar-btn">フォローリスト</a>

                <div class="top-sidebar-row">
                    <span>フォロワー数</span>
                    <span>{{ $followerCount ?? 0 }} 名</span>
                </div>

                <a href="{{ route('follower.list') }}" class="sidebar-btn">フォロワーリスト</a>

                <div class="sidebar-divider"></div>

                <a href="{{ route('search.index') }}" class="sidebar-btn sidebar-search-btn">ユーザー検索</a>
            </div>
        </div>

    </div>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
