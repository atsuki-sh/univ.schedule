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

// course_indexの位置のtdに、titleを出力する
function ajaxLoad(courses) {
    for (const course of courses) {
        $(`#${course['course_index']}`).html(`<h5>${course['title']}</h5>`);
    }
}

ajaxLoad(Laravel.courses);

// target_courseをグローバル変数として宣言
let target_course;

// tdがクリックされた時の処理
$('td').click(function() {
    $('#exampleModal').modal('show');
    $('.alert').hide();

    // 後で使えるよう、クリックされたtdのid(course_index)を保存しておく
    const $id = $(this).attr('id');
    $('#input-title').data('index', $id);

    // クリックされたtdのデータをモーダルに埋め込む
    target_course = Laravel.courses.find(
        (course) => String(course['course_index']) === $id);
    console.log(target_course);

    // クリックしたtdが空かどうかの判定
    if(target_course === undefined) {
        // 空ならemptyクラスをつける(作成か編集かの判定に使う)
        $('.modal').addClass('empty');
        $('#btn-delete').hide();
        $('#btn-close').text('キャンセル');
        $('#input-title').val('');
        $('#input-note').val('');
        $('#input-place').val('');
        $('#input-teacher').val('');
    } else {
        $('.modal').removeClass('empty');
        $('#btn-delete').show();
        $('#btn-close').text('閉じる');
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
                $('#exampleModal').modal('hide');
                $('.schedule').text('');
                Laravel.courses = res.courses;
                ajaxLoad(res.courses);
            })
            // 通信に失敗したとき
            .fail((xhr, textStatus, errorThrown)=>{
                // xhr.responseJSON.errorsに、バリデーションして返ってきたエラーが入っている
                console.log(xhr.responseJSON.errors);

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
                $('#exampleModal').modal('hide');
                console.log(res.courses);
                $('.schedule').text('');
                Laravel.courses = res.courses;
                ajaxLoad(res.courses);
            })
            // 通信に失敗したとき
            .fail((xhr, textStatus, errorThrown)=>{
                // xhr.responseJSON.errorsに、バリデーションして返ってきたエラーが入っている
                console.log(xhr.responseJSON.errors);

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
            $('.schedule').text('');
            Laravel.courses = res.courses;
            ajaxLoad(res.courses);
        })
        // 通信に失敗したとき
        .fail((error)=>{
            console.log(error);
        })
});
