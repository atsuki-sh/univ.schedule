$('#plus').click(function () {
    $('#exampleModal').modal('show');
})

$('#sort').click(function () {
    // これを追加すればタスクが増えていく
    // 追加して「完了」を押したときと、ロードするとき
    const new_task = '<li class="list-group-item list-group-item-action">\n' +
        '        <div class="task-list">\n' +
        '            <div class="check">\n' +
        '                <input class="checkbox" type="checkbox" style="transform:scale(2.0);">\n' +
        '            </div>\n' +
        '            <div class="task-left">\n' +
        '                <h5>レポート提出</h5>\n' +
        '                <h6>科目名</h6>\n' +
        '            </div>\n' +
        '            <div class="task-right">\n' +
        '                <h5>残り2日</h5>\n' +
        '                <h6>6/24</h6>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '    </li>';
    $('.list-group').append(new_task);
})

// チェックを入れると取り消し線、完了に変更
// 取り消し線のONとOFFができるように
$('.checkbox').click(function () {
    $('h5').css('text-decoration', 'line-through');
    $('h6').css('text-decoration', 'line-through');
    $('.task-right h5').text('完了');
})
