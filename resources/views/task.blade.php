<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>タスク一覧</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/task.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
<nav class="navbar">
    <span class="navbar-brand mb-0 h1">スケジュール管理アプリ</span>
    <a id="logout" href="#">ログアウト</a>
</nav>

<div class="page-menu">
    <a id="sch" href="#">スケジュール</a>
    <a id="task" href="#">タスク一覧</a>
</div>

<ul class="list-group">
    <div class="list-head">
        <div class="button plus">
            <i class="far fa-plus-square fa-2x"></i>
            追加する
        </div>
        <div class="button">
            <i class="fas fa-sort fa-2x"></i>
            並び替え
        </div>
        <div class="button">
            <i class="fas fa-cog fa-2x"></i>
            設定
        </div>
    </div>
    <li class="list-group-item list-group-item-action">
        <div class="task">
            <div class="check">
                <input type="checkbox" style="transform:scale(2.0);">
            </div>
            <div class="task-left">
                <h5>レポート提出</h5>
                <h6>科目名</h6>
            </div>
            <div class="task-right">
                <h5>残り2日</h5>
                <h6>6/24</h6>
            </div>
        </div>
    </li>
    <li class="list-group-item list-group-item-action">
        <div class="task">
            <div class="check">
                <input type="checkbox" style="transform:scale(2.0);">
            </div>
            <div class="task-left">
                <h5>レポート提出</h5>
                <h6>科目名</h6>
            </div>
            <div class="task-right">
                <h5>残り2日</h5>
                <h6>6/24</h6>
            </div>
        </div>
    </li>
    <li class="list-group-item list-group-item-action">
        <div class="task">
            <div class="check">
                <input type="checkbox" style="transform:scale(2.0);">
            </div>
            <div class="task-left">
                <h5>レポート提出</h5>
                <h6>科目名</h6>
            </div>
            <div class="task-right">
                <h5>残り2日</h5>
                <h6>6/24</h6>
            </div>
        </div>
    </li>
    <li class="list-group-item list-group-item-action">
        <div class="task">
            <div class="check">
                <input type="checkbox" style="transform:scale(2.0);">
            </div>
            <div class="task-left">
                <h5>レポート提出</h5>
                <h6>科目名</h6>
            </div>
            <div class="task-right">
                <h5>残り2日</h5>
                <h6>6/24</h6>
            </div>
        </div>
    </li>
</ul>

<script src="{{ asset('js/task.js') }}"></script>
</body>
</html>
