// index.blade.phpで定義したLaravel.coursesを使う
console.log(Laravel.courses);
console.log(Laravel.urls);

// POST通信のためにCSRFトークンを発行
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// ページリロードのためのfunctionを定義
// todo ajaxでリロードする
function ajaxReload() {
    $.ajax({
        type: 'get',
        url: Laravel.urls['index'],
    });
}

// course_indexの位置のtdに、titleを出力する
for (const course of Laravel.courses) {
    $(`#${course['course_index']}`).html(`<h5>${course['title']}</h5>`);
}

// target_courseをグローバル変数として宣言
let target_course;

// tdがクリックされた時の処理
$('td').click(function() {
    $('#exampleModal').modal('show');

    // 後で使えるよう、クリックされたtdのid(course_index)を保存しておく
    const $id = $(this).attr('id');
    $('#input-title').attr('data-index', $id);

    // クリックされたtdのデータをモーダルに埋め込む
    target_course = Laravel.courses.find(
        (course) => String(course['course_index']) === $id);
    console.log(target_course);

    // クリックしたtdが空かどうかの判定
    if(target_course === undefined) {
        // 空ならemptyクラスをつける(作成か編集かの判定に使う)
        $('.modal').addClass('empty');
        $('#btn-delete').hide();
        $('#input-title').val('');
        $('#input-note').val('');
        $('#input-place').val('');
        $('#input-teacher').val('');
    } else {
        $('.modal').removeClass('empty');
        $('#btn-delete').show();
        $('#input-title').val(target_course['title']);
        $('#input-note').val(target_course['note']);
        $('#input-place').val(target_course['place']);
        $('#input-teacher').val(target_course['teacher']);
    }

});

// 編集・作成データの送信（ajax）
$('#btn-submit').click(function() {
    // 作成データ
    if($('.modal').hasClass('empty')) {
        $.ajax({
            type: 'post', // HTTP通信の種類
            url: Laravel.urls['create'],
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
                // ajaxReload();
                $('.alert').hide();
                setTimeout('location.reload()', 1000);
            })
            // 通信に失敗したとき
            .fail((xhr, textStatus, errorThrown)=>{
                // xhr.responseJSON.errorsに、バリデーションして返ってきたエラーが入っている
                console.log(xhr.responseJSON.errors['title'][0]);
                console.error(errorThrown);

                $('.alert').text(xhr.responseJSON.errors['title'][0]);
                $('.alert').show();
            })
    }
    // 編集データ
    else {
        $.ajax({
            type: 'post', // HTTP通信の種類
            url: Laravel.urls['update'], // 通信したいURL
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
                // ajaxReload();
                $('.alert').hide();
                setTimeout('location.reload()', 1000);
            })
            // 通信に失敗したとき
            .fail((xhr, textStatus, errorThrown)=>{
                // xhr.responseJSON.errorsに、バリデーションして返ってきたエラーが入っている
                console.log(xhr.responseJSON.errors['title'][0]);

                $('.alert').text(xhr.responseJSON.errors['title'][0]);
                $('.alert').show();
            })
    }
});

// データの削除
$('#btn-delete').click(function() {
    $.ajax({
        type: 'post',
        url: Laravel.urls['delete'],
        data: {
            course_index: $('#input-title').data('index'),
        }
    })
        // 通信に成功したとき
        .done((res)=>{
            console.log(res.message);
            // ajaxReload();
            setTimeout('location.reload()', 1000);
        })
        // 通信に失敗したとき
        .fail((error)=>{
            console.log(error.statusText);
        })
});

// 閉じるボタンが押されたときは入力値を戻す
$('#btn-close').click(function() {
    if($('.modal').hasClass('empty')) {
        $('#input-title').val('');
        $('#input-note').val('');
        $('#input-place').val('');
        $('#input-teacher').val('');
    } else {
        $('#input-title').val(target_course['title']);
        $('#input-note').val(target_course['note']);
        $('#input-place').val(target_course['place']);
        $('#input-teacher').val(target_course['teacher']);
    }

    $('#btn-submit').data('dismiss', '');
    $('.alert').hide();
});
