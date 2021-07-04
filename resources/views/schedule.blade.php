@extends('layouts/layout')

@section('title', 'スケジュール')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/schedule.css') }}">
@endsection

@section('page-menu')
    <a id="sch" href="#">スケジュール</a>
    <a id="task" href="{{ route('task.index', ["user_id" => $user->id]) }}">タスク一覧</a>
    <i class="fas fa-cog fa-2x"></i>
@endsection

@section('modal-body')
    <div class="item">
        {{--                    メモ--}}
        <i class="fas fa-pen fa-lg fa-fw"></i>
        <textarea class="modal-input" id="input-note" placeholder="メモを入力" rows="3"></textarea>
    </div>
    <div class="item">
        {{--                    場所--}}
        <i class="fas fa-map-marker-alt fa-lg fa-fw"></i>
        <input type="text" class="modal-input" id="input-place" placeholder="場所を入力" value="">
    </div>
    <div class="item">
        {{--                    先生--}}
        <i class="fas fa-user fa-lg fa-fw"></i>
        <input type="text" class="modal-input" id="input-teacher" placeholder="先生を入力" value="">
    </div>
@endsection

@section('content')
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
        {{--    それぞれのtdはid属性として番号をもつ--}}
        @for($i=1; $i<=25; $i+=5)
            <tr>
                <th scope="row">{{ ($i-1) / 5 + 1}}</th>
                <td class="schedule" id="{{ $i }}"></td>
                <td class="schedule" id="{{ $i+1 }}"></td>
                <td class="schedule" id="{{ $i+2 }}"></td>
                <td class="schedule" id="{{ $i+3 }}"></td>
                <td class="schedule" id="{{ $i+4 }}"></td>
            </tr>
        @endfor
        </tbody>
    </table>
@endsection

@section('scripts')
    <script>
        window.Laravel = {};
        window.Laravel.courses = @json($courses);
        window.Laravel.urls = @json($urls);
    </script>
    <script src="{{ asset('js/schedule.js') }}"></script>
@endsection
