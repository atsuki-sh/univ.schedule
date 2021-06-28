<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>タスク一覧</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/task.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
<div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                {{--                タイトル--}}
                <div class="alert alert-danger"></div>
                <input type="text" class="modal-input h5" id="input-title" data-index="" placeholder="タイトルを入力" value="">
            </div>
            <div class="modal-body">
                <div class="item">
                    {{--                    科目名--}}
                    <i class="fas fa-map-marker-alt fa-lg fa-fw"></i>
                    <select class="modal-input">
                        <option>科目名を選択</option>
                        <option>価値創造方法論</option>
                        <option>機械学習</option>
                        <option>プログラミング</option>
                    </select>
                </div>
                <div class="item">
                    {{--                    メモ--}}
                    <i class="fas fa-pen fa-lg fa-fw"></i>
                    <textarea class="modal-input" id="input-note" placeholder="メモを入力" rows="3"></textarea>
                </div>
                <div class="item">
                    {{--                    先生--}}
                    <i class="fas fa-user fa-lg fa-fw"></i>
                    <input type="text" class="modal-input" id="input-teacher" placeholder="期限を選択" value="">
                </div>
                <div class="item">
                    {{-- ステータススイッチ --}}
                    <i class="fas fa-user fa-lg fa-fw"></i>
                    <input type="checkbox" data-toggle="toggle" data-width="100px" data-on="完了" data-off="未完了" data-onstyle="success" data-offstyle="danger">
                </div>
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

<nav class="navbar">
    <span class="navbar-brand mb-0 h1">スケジュール管理アプリ</span>
    <p>こんにちは！{{ $user->name }}さん</p>
    <a id="logout" href="#">ログアウト</a>
</nav>

<div class="page-menu">
    <a id="sch" href="#">スケジュール</a>
    <a id="task" href="#">タスク一覧</a>
</div>

@foreach($tasks as $task)
    <h3>{{ $task->course }}</h3>
@endforeach

<ul class="list-group">
    <div class="list-head">
        <div class="button" id="plus">
            <i class="far fa-plus-square fa-2x"></i>
            追加する
        </div>
        <div class="button" id="sort">
            <i class="fas fa-sort fa-2x"></i>
            並び替え
        </div>
        <div class="button">
            <i class="fas fa-cog fa-2x"></i>
            設定
        </div>
    </div>
{{--    <li class="list-group-item list-group-item-action">--}}
{{--        <div class="task-list" id="task-example">--}}
{{--            <h4>タスクを追加してください</h4>--}}
{{--        </div>--}}
{{--    </li>--}}
{{--    <li class="list-group-item list-group-item-action">--}}
{{--        <div class="task-list">--}}
{{--            <div class="check">--}}
{{--                <input class="checkbox" type="checkbox" style="transform:scale(2.0);">--}}
{{--            </div>--}}
{{--            <div class="task-left">--}}
{{--                <h5>レポート提出</h5>--}}
{{--                <h6>科目名</h6>--}}
{{--            </div>--}}
{{--            <div class="task-right">--}}
{{--                <h5>残り2日</h5>--}}
{{--                <h6>6/24</h6>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </li>--}}
{{--    <li class="list-group-item list-group-item-action">--}}
{{--        <div class="task-list">--}}
{{--            <div class="check">--}}
{{--                <input class="checkbox" type="checkbox" style="transform:scale(2.0);">--}}
{{--            </div>--}}
{{--            <div class="task-left">--}}
{{--                <h5>レポート提出</h5>--}}
{{--                <h6>科目名</h6>--}}
{{--            </div>--}}
{{--            <div class="task-right">--}}
{{--                <h5>残り2日</h5>--}}
{{--                <h6>6/24</h6>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </li>--}}
{{--    <li class="list-group-item list-group-item-action">--}}
{{--        <div class="task-list">--}}
{{--            <div class="check">--}}
{{--                <input class="checkbox" type="checkbox" style="transform:scale(2.0);">--}}
{{--            </div>--}}
{{--            <div class="task-left">--}}
{{--                <h5>レポート提出</h5>--}}
{{--                <h6>科目名</h6>--}}
{{--            </div>--}}
{{--            <div class="task-right">--}}
{{--                <h5>残り2日</h5>--}}
{{--                <h6>6/24</h6>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </li>--}}
{{--    <li class="list-group-item list-group-item-action">--}}
{{--        <div class="task-list">--}}
{{--            <div class="check">--}}
{{--                <input class="checkbox" type="checkbox" style="transform:scale(2.0);">--}}
{{--            </div>--}}
{{--            <div class="task-left">--}}
{{--                <h5>レポート提出</h5>--}}
{{--                <h6>科目名</h6>--}}
{{--            </div>--}}
{{--            <div class="task-right">--}}
{{--                <h5>残り2日</h5>--}}
{{--                <h6>6/24</h6>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </li>--}}
</ul>

<!-- flatpickrスクリプト -->
<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
<!-- 日本語化のための追加スクリプト -->
<script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script>
    flatpickr(document.getElementById('input-teacher'), {
        locale: 'ja',
        dateFormat: "Y/m/d",
        minDate: new Date()
    });
</script>
<script>
    window.Laravel = {};
    window.Laravel.tasks = @json($tasks);
</script>
<script src="{{ asset('js/task.js') }}"></script>
</body>
</html>
