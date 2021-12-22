@extends("admin.base")

@section("title")
レシピ編集
@endsection

@section("labeltitle")
レシピ編集
@endsection

@section("labelsubtitle")
@endsection

@section("main")
<form class="container" method="POST" action="{{ route('admin-recipe-updatestore', ['recipe_id' => $row['id']]) }}">
    @csrf
    <input type="hidden" name="id" id="id" value="{{ $row['id'] }}">
    <x-myinput field="name" label="名前" type="text" :defval="old('name', $row['name'])" placeholder="" />
    <x-myselect field="category" label="カテゴリ" :options="$category" :defval="old('category', $row['category'])" :enablefilter='false' />
    <x-myinput field="url" label="URL" type="text" :defval="old('url', $row['url'])" placeholder="" />
    <x-mytextarea field="memo" label="memo" :defval="old('memo', $row['memo'] ?? '')" placeholder="" />

    <div class="field">
        <div class="control">
            <button id="act-submit" type="submit" class="button">更新</button>
        </div>
    </div>
</form>
@endsection
