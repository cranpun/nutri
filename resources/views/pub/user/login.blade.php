@extends("pub.base")

@section("title")
ログイン
@endsection

@section("labeltitle")
ログイン
@endsection

@section("labelsubtitle")
@endsection

@section("main")
<form class="container" method="POST" action="{{ route('authenticate') }}">
    @csrf
    <x-myinput field="name" label="ユーザ" type="text" :defval="old('name')" placeholder="ユーザを入力" />
    <x-myinput field="password" label="パスワード" type="password" defval="" placeholder="パスワードを入力" />
    <div class="field">
        <div class="control">
            <button id="act-login" type="submit" class="button">ログイン</button>
        </div>
    </div>
</form>
@endsection