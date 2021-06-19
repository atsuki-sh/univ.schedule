<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script src="{{ asset('js/app.js') }}"></script>

@if (Route::has('login'))
    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
        @auth
            <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary text-sm text-gray-700 underline">ログイン</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-primary ml-4 text-sm text-gray-700 underline">新規登録</a>
            @endif
        @endauth
    </div>
@endif

<button type="button" class="btn btn-primary" id="btn-submit">完了</button>
<button type="button" class="btn btn-danger">削除</button>
<button type="button" class="btn btn-light">キャンセル</button>
<button type="button" class="btn btn-dark">dark</button>

<script>
    $('.btn').click(function () {
        $('.btn-dark').text('jQuery!');
    });
</script>
