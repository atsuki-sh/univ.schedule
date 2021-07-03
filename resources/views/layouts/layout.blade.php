<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta charset="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('styles')
</head>
<body>
{{--ナビバー--}}
<nav class="navbar">
    <span class="navbar-brand mb-0 h1">スケジュール管理アプリ</span>
    <p>こんにちは！{{ $user->name }}さん</p>
    <a href="{{ route('logout') }}"
       onclick="event.preventDefault();
       document.getElementById('logout-form').submit();">
        ログアウト
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</nav>

{{--ページメニュー--}}
<div class="page-menu">
    @yield('page-menu')
</div>

<div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                {{--                タイトル--}}
                <div class="alert alert-danger" id="alert-title"></div>
                <input type="text" class="modal-input h5" id="input-title" data-index="" placeholder="タイトルを入力" value="">
            </div>
            <div class="modal-body">
                @yield('modal-body')
            </div>
            <div class="modal-footer">
                {{--                ボタン類--}}
                <button type="button" class="btn btn-danger" id="btn-delete" data-dismiss="modal">削除</button>
                <button type="button" class="btn btn-light" id="btn-close" data-dismiss="modal">閉じる</button>
                <button type="button" class="btn btn-primary" id="btn-submit">完了</button>
            </div>
        </div>
    </div>
</div>

@yield('content')

{{--スクリプトの読み込み--}}
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
