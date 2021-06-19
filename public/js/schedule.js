// index.blade.phpで定義したLaravel.coursesを使う
console.log(Laravel.courses);

// POST通信のためにCSRFトークンを発行
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// tdのidとデータのcourse_indexが一致したら、そのデータのタイトルをtdに出力する
Laravel.courses.forEach(function(course) {
    for(let i=1; i<=25; i++) {
        if($(`#${i}`).is(`[id = ${course['course_index']}]`)) {
            $(`#${i}`).html(`<h5>${course['title']}</h5>`);
        }
    }
});

// tdがクリックされた時の処理
$('td').click(function() {
    $('#exampleModal').modal('show');
    $('#btn-cancel').hide();
    $('#btn-delete').hide();
    $('#btn-submit').hide();

    const $id = $(this).attr('id');
    $('#input-title').attr('data-index', $id);

    // クリックされたtdのデータをモーダルに埋め込む
    // 途中でbreakしたいので、forEachじゃなくてsomeを使う
    Laravel.courses.some(function(course) {
        let course_index = String(course['course_index']);

        if($id === course_index) {
            $('.modal').removeClass('empty');
            $('#btn-edit').show();
            $('#btn-create').hide();
            $('#modal-title').text(course['title']);
            $('#modal-note').text(course['note']);
            $('#modal-place').text(course['place']);
            $('#modal-teacher').text(course['teacher']);
            return true;
        } else {
            $('.modal').addClass('empty');
            $('#btn-edit').hide();
            $('#btn-create').show();
            $('.show-data').text('');
        }
    });
});

$('#btn-edit').click(function() {
    $('.modal-input').show();
    $('.show-data').hide();
    $('#btn-cancel').show();
    $('#btn-close').hide();
    $('#btn-delete').show();
    $('#btn-submit').show();
    $(this).hide();

    $('#input-title').val($('#modal-title').text());
    $('#input-note').val($('#modal-note').text());
    $('#input-place').val($('#modal-place').text());
    $('#input-teacher').val($('#modal-teacher').text());
});

$('#btn-create').click(function() {
    $('.modal-input').show();
    $('.show-data').hide();
    $('#btn-cancel').show();
    $('#btn-close').hide();
    $('#btn-submit').show();
    $(this).hide();

    $('#input-title').val('');
    $('#input-note').val('');
    $('#input-place').val('');
    $('#input-teacher').val('');
});

$('#btn-cancel').click(function() {
    $('.modal-input').hide();
    $('.show-data').show();
    $('#btn-cancel').hide();
    $('#btn-close').show();
    $('#btn-delete').hide();
    $('#btn-submit').hide();

    if($('.modal').hasClass('empty')) {
        $('#btn-create').show();
    } else {
        $('#btn-edit').show();
    }
});

// 編集・作成データの送信（ajax）
$('#btn-submit').click(function() {
    // 作成データ
    if($('.modal').hasClass('empty')) {
        $.ajax({
            type: 'post', // HTTP通信の種類
            url: 'schedule/create', // 通信したいURL
            dataType: 'json',
            data: {
                course_index: $('#input-title').data('index'),
                title: $('#input-title').val(),
                note: $('#input-note').val(),
                place: $('#input-place').val(),
                teacher: $('#input-teacher').val(),
            },
        })
            // 通信に成功したとき
            .done((res)=>{
                console.log(res.message);
            })
            // 通信に失敗したとき
            .fail((error)=>{
                console.log(error.statusText);
            })
    }
    // 編集データ
    else {
        $.ajax({
            type: 'post', // HTTP通信の種類
            url: 'schedule/update', // 通信したいURL
            dataType: 'json',
            data: {
                course_index: $('#input-title').data('index'),
                title: $('#input-title').val(),
                note: $('#input-note').val(),
                place: $('#input-place').val(),
                teacher: $('#input-teacher').val(),
            },
        })
            // 通信に成功したとき
            .done((res)=>{
                console.log(res.message);
            })
            // 通信に失敗したとき
            .fail((error)=>{
                console.log(error.statusText);
            })
    }

    // ページをリロードして変更を適用
    window.setTimeout(function() {
        window.location.reload();
    }, 1000);
});

// データの削除
$('#btn-delete').click(function() {
    $.ajax({
        type: 'post',
        url: 'schedule/delete',
        dataType: 'json',
        data: {
            course_index: $('#input-title').data('index'),
        }
    })
        // 通信に成功したとき
        .done((res)=>{
            console.log(res.message);
        })
        // 通信に失敗したとき
        .fail((error)=>{
            console.log(error.statusText);
        })

    // ページをリロードして変更を適用
    window.setTimeout(function() {
        window.location.reload();
    }, 1000);
});
