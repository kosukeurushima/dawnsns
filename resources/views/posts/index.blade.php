<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Posts</title>
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
                    rc="{{ asset('images/' . (Auth::user()->image ?: 'icons/dawn.png')) }}"
                    alt="icon"
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

        <!-- 左：投稿エリア -->
        <div class="top-content">

            @if ($errors->any())
                <ul class="top-error-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <!-- 投稿フォーム -->
            <div class="top-post-form-wrap">
                <div class="top-post-form-row">
                    <div class="top-post-form-icon-wrap">
                        <img
                            src="{{ asset('images/' . (Auth::user()->image ?: 'icons/dawn.png')) }}"
                            alt="icon"
                            class="top-post-form-icon"
                        >
                    </div>

                    <form method="POST" action="{{ route('posts.store') }}" class="top-post-form">
                        @csrf

                        <textarea
                            name="post"
                            rows="2"
                            maxlength="400"
                            placeholder="何をつぶやこうか...？"
                            class="top-post-textarea"
                        >{{ old('post') }}</textarea>

                        <button type="submit" class="top-post-submit">
                            <img
                                src="{{ asset('images/icons/post.png') }}"
                                alt="投稿"
                                class="top-send-icon"
                            >
                        </button>
                    </form>
                </div>
            </div>

            <!-- 投稿一覧 -->
            @foreach ($posts as $post)
                <div class="top-post-card">
                    <div class="top-post-card-header">
                        <div class="top-post-user">
                            <img
                                src="{{ asset('images/' . ($post->user->image ?: 'icons/dawn.png')) }}"
                                alt="icon"
                                class="top-post-user-icon"
                            >

                            <div class="top-post-content">
                                <div class="top-post-user-name">{{ $post->user->name }}</div>
                                <p class="top-post-body">{{ $post->post }}</p>
                            </div>
                        </div>

                        <small class="top-post-date">{{ $post->created_at }}</small>
                    </div>

                    @if ($post->user_id === auth()->id())
                        <div class="top-post-actions">
                            <a href="{{ route('posts.edit', $post) }}" class="top-action-icon-link">
                                <img
                                    src="{{ asset('images/icons/edit.png') }}"
                                    alt="編集"
                                    class="top-action-icon"
                                >
                            </a>

                            <form method="POST" action="{{ route('posts.destroy', $post) }}" class="top-delete-form js-delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="top-action-icon-button js-delete-trigger">
                                    <img
                                        src="{{ asset('images/icons/trash.png') }}"
                                        data-hover="{{ asset('images/icons/trash_h.png') }}"
                                        data-default="{{ asset('images/icons/trash.png') }}"
                                        alt="削除"
                                        class="top-action-icon js-hover-img"
                                    >
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach

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

    <!-- 削除確認モーダル -->
    <div class="delete-modal" id="deleteModal">
        <div class="delete-modal-content">
            <p class="delete-modal-text">
                このつぶやきを削除します。よろしいでしょうか？
            </p>

            <div class="delete-modal-actions">
                <button type="button" class="delete-modal-ok" id="deleteModalOk">OK</button>
                <button type="button" class="delete-modal-cancel" id="deleteModalCancel">キャンセル</button>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
