<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>スケジュール管理アプリ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/schedule.css') }}">
    <script src="{{ asset('js/schedule.js') }}"></script>
</head>
<body>

<!-- Modal -->
<div class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                {{--                タイトル--}}
                <input type="text" class="modal-input h5" id="input-title" data-index="" placeholder="タイトルを入力" value="">
                <h5 class="show-data" id="modal-title"></h5>
            </div>
            <div class="modal-body">
                <div class="item">
                    {{--                    メモ--}}
                    <i class="fas fa-pen fa-lg fa-fw"></i>
                    <textarea class="modal-input" id="input-note" placeholder="メモを入力" rows="5"></textarea>
                    <p class="show-data" id="modal-note"></p>
                </div>
                <div class="item">
                    {{--                    場所--}}
                    <i class="fas fa-map-marker-alt fa-lg fa-fw"></i>
                    <input type="text" class="modal-input" id="input-place" placeholder="場所を入力" value="">
                    <p class="show-data" id="modal-place"></p>
                </div>
                <div class="item">
                    {{--                    先生--}}
                    <i class="fas fa-user fa-lg fa-fw"></i>
                    <input type="text" class="modal-input" id="input-teacher" placeholder="先生を入力" value="">
                    <p class="show-data" id="modal-teacher"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btn-delete">削除</button>
                <button type="button" class="btn btn-light" id="btn-close" data-dismiss="modal">閉じる</button>
                <button type="button" class="btn btn-light" id="btn-cancel">キャンセル</button>
                <button type="button" class="btn btn-primary" id="btn-edit">編集</button>
                <button type="button" class="btn btn-primary" id="btn-create">作成</button>
                <button type="button" class="btn btn-primary" id="btn-submit">完了</button>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-light bg-light">
    <span class="navbar-brand mb-0 h1">スケジュール管理アプリ</span>
</nav>

<div class="page-menu">
    <a id="sch" href="#">スケジュール</a>
    <a id="task" href="#">タスク一覧</a>
    <h4>こんにちは！{{ $user->name }}さん</h4>
    <i class="fas fa-cog fa-2x"></i>
</div>

{{--予定表をtableで作成--}}
<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col"></th>
        <th scope="col">月</th>
        <th scope="col">火</th>
        <th scope="col">水</th>
        <th scope="col">木</th>
        <th scope="col">金</th>
    </tr>
    </thead>
    <tbody>
    {{--    それぞれのtdはid属性としてindex_xをもつ--}}
    @for($i=1; $i<=25; $i+=5)
        <tr>
            <th scope="row">{{ ($i-1) / 5 + 1}}</th>
            <td id="{{ $i }}"></td>
            <td id="{{ $i+1 }}"></td>
            <td id="{{ $i+2 }}"></td>
            <td id="{{ $i+3 }}"></td>
            <td id="{{ $i+4 }}"></td>
        </tr>
    @endfor
    </tbody>
</table>

<script>
    {{--    グローバル変数として別のjsファイルに$coursesを渡す--}}
        window.Laravel = {};
    window.Laravel.courses = @json($courses);
</script>
</body>
</html>
