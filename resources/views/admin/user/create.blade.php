@extends("admin.base")

@section("title")
ユーザ登録
@endsection

@section("labeltitle")
ユーザ登録
@endsection

@section("labelsubtitle")
@endsection

@section("main")
<form class="container" method="POST" action="{{ route('admin-user-store') }}">
    @csrf
    <x-myinput field="name" label="アカウント" type="text" :defval="old('name')" placeholder="重複不可" />
    <x-myinput field="display_name" label="氏名" type="text" :defval="old('display_name')" placeholder="" />
    <x-myinput field="password" label="パスワード" type="password" defval="" placeholder="8文字以上" />
    <x-myinput field="password_confirmation" label="パスワード再入力" type="password" defval="" placeholder="もう一度入力" />
    <div class="field">
        <div class="control">
            <button id="act-submit" type="submit" class="button">登録</button>
        </div>
    </div>
</form>
@endsection