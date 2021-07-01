// ログイン中のユーザーのタスクを受け取る
console.log(Laravel.tasks);
console.log(Laravel.urls);

// POST通信のためにCSRFトークンを発行
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// タスクがなかったらtask-defaultを表示、あるなら隠す
if(Laravel.tasks.length === 0) {
    $('#task-default').css('display', 'flex');
} else {
    $('#task-default').css('display', 'none');
}

// コードが冗長的になりすぎてる
// todo task['task_id']がたくさん使われているから変数に入れて置換
// todo functionでまとめられそうなやつがある(取消線とか)

// タスク一覧を表示
for (const task of Laravel.tasks) {
    // due_dateのフォーマットを変える
    task['due_date'] = task['due_date'].replace(/-/g, '/')
    console.log(task['due_date']);

    const dates = task['due_date'].split('/');
    console.log(dates);

    // ログインした日時をセット（時間は0:00）
    const today = new Date();
    today.setHours(0);
    today.setMinutes(0);
    today.setSeconds(0);
    today.setMilliseconds(0);
    // 期限をセット
    const due_date = new Date(dates[0], dates[1]-1, dates[2]);
    console.log(today, due_date);
    const remaining_day = (due_date - today) / 86400000;
    console.log(remaining_day);

    // タスクリストを追加
    const new_task =
        `<li class="list-group-item list-group-item-action">\n` +
        `        <div class="task-list" id="${task['task_id']}">\n` +
        '            <div class="check">\n' +
        `                <input class="checkbox" type="checkbox" style="transform:scale(2.0);">\n` +
        '            </div>\n' +
        '            <div class="task-left">\n' +
        `                <h5>${task['title']}</h5>\n` +
        `                <h6>${task['course']}</h6>\n` +
        '            </div>\n' +
        '            <div class="task-right">\n' +
        `                <h5 class="remaining" data-remaining-day="${remaining_day}">残り${remaining_day}日</h5>\n` +
        `                <h6>${task['due_date']}</h6>\n` +
        '            </div>\n' +
        '        </div>\n' +
        '    </li>';
    $('.list-group').append(new_task);

    // いろいろと修正
    // 期限日当日の場合、期限日を過ぎた場合（remaining_dayがマイナス）
    if(remaining_day === 0) {
        $(`#${task['task_id']} .remaining`).text('今日');
    }
    else if(remaining_day < 0) {
        // プラスにする
        $(`#${task['task_id']} .remaining`).text(`${-1 * remaining_day}日前`);
    }

    // statusが2(完了)ならチェックボックスにチェック入れて取消線
    if(task['status'] === 2) {
        $(`#${task['task_id']} .check .checkbox`).prop('checked', true).change();
        $(`#${task['task_id']}`).children('.task-left').children('h5, h6').css('text-decoration-line', 'line-through');
        $(`#${task['task_id']}`).children('.task-right').children('h6').css('text-decoration-line', 'line-through');
        $(`#${task['task_id']}`).children('.task-right').children('h5').text('完了');
    }

    // タスクを残り日数順にソート（昇順）
    // todo できなかった
}

// 追加ボタンが押されたら、空のモーダルを表示
$('#plus').click(function () {
    $('#input-title').val('');
    $('#input-course').val('0');
    $('#input-note').val('');
    $('#input-due').val('');
    $('#input-status').prop('checked', false).change();

    $('#btn-delete').hide();
    $('#btn-close').text('キャンセル');

    $('#exampleModal').modal('show');
    $('#exampleModal').addClass('empty');
})

// タスクがクリックされたら、クリックされたタスクのデータをモーダルに表示
$('.task-left, .task-right').click(function () {
    const $id = $(this).parents('.task-list').attr('id');
    $('#exampleModal').data('task_id', $id);

    // target_taskがクリックされたタスクのデータ
    const target_task = Laravel.tasks.find(
        (task) => String(task['task_id']) === $id);
    console.log(target_task);

    $('#input-title').val(target_task['title']);
    $('#input-course').val(target_task['course_index']);
    $('#input-note').val(target_task['note']);
    $('#input-due').val(target_task['due_date']);
    // statusが1なら「未完了」、2なら「完了」
    if(target_task['status'] === 1) {
        $('#input-status').prop('checked', false).change();
        $('#input-status').val(1);
    }
    else if(target_task['status'] === 2) {
        $('#input-status').prop('checked', true).change();
        $('#input-status').val(2);
    }

    $('#btn-delete').show();
    $('#btn-close').text('閉じる');

    $('#exampleModal').modal('show');
    $('#exampleModal').removeClass('empty');
})

$('#input-status').change(function () {
    if($(this).is(':checked')) {
        $(this).val(2);
    } else {
        $(this).val(1);
    }
})

// チェックボックスのクリックで取り消し線のONとOFF
$('.checkbox').change(function () {
    // 残り日数を取得
    const remaining_day = $(this).parents('.task-list').find('.remaining').data('remaining-day');

    if($(this).is(':checked')) {
        $(this).parents('.task-list').find('.remaining').text('完了');
        $(this).parents('.task-list').children('.task-left').children('h5, h6').css('text-decoration-line', 'line-through');
        $(this).parents('.task-list').children('.task-right').children('h6').css('text-decoration-line', 'line-through');
    } else {
        $(this).parents('.task-list').children('.task-left, .task-right').children('h5, h6').css('text-decoration-line', 'none');
        if(remaining_day === 0) {
            $(this).parents('.task-list').find('.remaining').text('今日');
        }
        else if(remaining_day < 0) {
            // プラスにする
            $(this).parents('.task-list').find('.remaining').text(`${-1 * remaining_day}日前`);
        } else {
            $(this).parents('.task-list').find('.remaining').text(`残り${remaining_day}日`);
        }
    }
})

$('#btn-submit').click(function () {
    // 作成
    if($('#exampleModal').hasClass('empty')) {
        $.ajax({
            type: 'post',
            url: Laravel.urls['create'],
            data: {
                course_index: $('#input-course').val(),
                course: $('#input-course option:selected').text(),
                title: $('#input-title').val(),
                note: $('#input-note').val(),
                due_date: $('#input-due').val(),
                status: Number($('#input-status').val()),
            },
        })

            .done((res) => {
                console.log(res.message);
                setTimeout('location.reload()', 1000);
            })

            .fail((error) => {
                console.log(error);
            })
    }
    // 編集
    else {
        $.ajax({
            type: 'post',
            url: Laravel.urls['update'],
            data: {
                course_index: $('#input-course').val(),
                course: $('#input-course option:selected').text(),
                title: $('#input-title').val(),
                note: $('#input-note').val(),
                due_date: $('#input-due').val(),
                status: Number($('#input-status').val()),
            },
        })

            .done((res) => {
                console.log(res.message);
                setTimeout('location.reload()', 1000);
            })

            .fail((error) => {
                console.log(error);
            })
    }
})

$('#btn-delete').click(function () {
    $.ajax({
        type: 'post',
        url: Laravel.urls['delete'],
        data: {
            task_id: $('#exampleModal').data('task_id'),
        },
    })

        .done((res) => {
            console.log(res.message);
            setTimeout('location.reload()', 1000);
        })

        .fail((error) => {
            console.log(error);
        })
})
