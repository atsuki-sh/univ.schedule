@extends('layouts/layout')

@section('title', 'タスク一覧')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/task.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css">
@endsection

@section('page-menu')
    <a id="sch" href="{{ route('course.index', ["user_id" => $user->id]) }}">スケジュール</a>
    <a id="task" href="#">タスク一覧</a>
@endsection

@section('modal-body')
    <div class="item">
        {{--                    科目名--}}
        <i class="fas fa-chalkboard fa-lg fa-fw"></i>
        <select class="modal-input" id="input-course">
            <option id="course_holder" value="0" selected>科目を選択してください</option>
            @foreach($course_titles as $title)
                <option value="{{ $course_indexes[$loop->index] }}">{{ $title }}</option>
            @endforeach
            <option value="100">その他</option>
        </select>
    </div>
    <div class="item">
        {{--                    メモ--}}
        <i class="fas fa-pen fa-lg fa-fw"></i>
        <textarea class="modal-input" id="input-note" placeholder="メモを入力" rows="3"></textarea>
    </div>
    <div class="alert alert-danger" id="alert-due_date"></div>
    <div class="item">
        {{--                    期限--}}
        <i class="far fa-calendar-alt fa-lg fa-fw"></i>
        <input type="text" class="modal-input" id="input-due" placeholder="期限を選択" value="">
    </div>
    <div class="item">
        {{-- ステータススイッチ --}}
        <i class="far fa-check-square fa-lg fa-fw"></i>
        <input id="input-status" value="" type="checkbox" data-toggle="toggle" data-width="100px" data-on="完了" data-off="未完了" data-onstyle="success" data-offstyle="danger">
    </div>
@endsection

@section('content')
    <ul class="list-group" id="tasks">
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
        {{--    タスクがないときに表示するやつ--}}
        <li class="list-group-item list-group-item-action" id="task-default">
            <div class="task-list">
                <h4>タスクを追加してください</h4>
            </div>
        </li>
    </ul>
@endsection

@section('scripts')
    <!-- flatpickrスクリプト -->
    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
    <!-- 日本語化のための追加スクリプト -->
    <script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script>
        flatpickr(document.getElementById('input-due'), {
            locale: 'ja',
            dateFormat: "Y/m/d",
            minDate: new Date()
        });

        window.Laravel = {};
        window.Laravel.tasks = @json($tasks);
        window.Laravel.urls = @json($urls);
    </script>
    <script src="{{ asset('js/task.js') }}"></script>
@endsection
