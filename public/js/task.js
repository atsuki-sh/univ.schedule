console.log(Laravel.tasks);

for (const task of Laravel.tasks) {
    const dates = task['due_date'].split('-');
    console.log(dates);

    // ログインした日時をセット（時間は0:00）
    const today = new Date();
    today.setHours(0);
    today.setMinutes(0);
    today.setSeconds(0);
    today.setMilliseconds(0);
    // 期限をセット
    const due_date = new Date(dates[0], dates[1]-2, dates[2]);
    console.log(today, due_date);
    const remaining_day = (due_date - today) / 86400000;
    console.log(remaining_day);

    // タスクリストを追加
    const new_task =
        `<li class="list-group-item list-group-item-action" id="${task['task_id']}">\n` +
        '        <div class="task-list">\n' +
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



$('#plus').click(function () {
    $('#exampleModal').modal('show');
})

// todo チェックを入れると取り消し線、完了に変更
// 取り消し線のONとOFFができるように
$('.checkbox').click(function () {
    $('h5').css('text-decoration', 'line-through');
    $('h6').css('text-decoration', 'line-through');
    $('.task-right h5').text('完了');
})
