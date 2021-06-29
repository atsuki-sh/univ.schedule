// ログイン中のユーザーのタスクを受け取る
console.log(Laravel.tasks);

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
        `                <h5 id="remaining">残り${remaining_day}日</h5>\n` +
        `                <h6>${task['due_date']}</h6>\n` +
        '            </div>\n' +
        '        </div>\n' +
        '    </li>';
    $('.list-group').append(new_task);

    // いろいろと修正
    // 期限日当日の場合、期限日を過ぎた場合（remaining_dayがマイナス）
    if(remaining_day === 0) {
        $(`#${task['task_id']} #remaining`).text('今日');
    }
    else if(remaining_day < 0) {
        // プラスにする
        $(`#${task['task_id']} #remaining`).text(`${-1 * remaining_day}日前`);
    }
}

// 追加ボタンが押されたら、空のモーダルを表示
$('#plus').click(function () {
    $('#input-title').val('');
    $('#input-course').val('0');
    $('#input-note').val('');
    $('#input-due').val('');
    $('#input-status').removeAttr('checked').prop('checked', false).change();

    $('#btn-delete').hide();

    $('#exampleModal').modal('show');
})

// タスクがクリックされたら、クリックされたタスクのデータをモーダルに表示
$('.task-left, .task-right').click(function () {
    const $id = $(this).parents('.task-list').attr('id');

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
        $('#input-status').removeAttr('checked').prop('checked', false).change();
    }
    else if(target_task['status'] === 2) {
        $('#input-status').attr('checked', true).prop('checked', true).change();
    }

    $('#btn-delete').show();

    $('#exampleModal').modal('show');
})

// チェックボックスのクリックで取り消し線のONとOFF
$('.checkbox').click(function () {
    if($(this).is(':checked')) {
        $(this).parents('.task-list').children('.task-left, .task-right').children('h5, h6').css('text-decoration-line', 'line-through');
    } else {
        $(this).parents('.task-list').children('.task-left, .task-right').children('h5, h6').css('text-decoration-line', 'none');
    }
})
