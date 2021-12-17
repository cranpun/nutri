@extends("admin.base")

@section("title")
食材編集
@endsection

@section("labeltitle")
食材編集
@endsection

@section("labelsubtitle")
@endsection

@section("main")
<form class="container" method="POST" action="{{ route('admin-food-updatestore', ['food_id' => $row['id']]) }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id" value="{{ $row['id'] }}">
    <x-mycheckbox field="favorite" label="お気に入り" :defval="old('favorite', $row['favorite'] == 0)" />
    <x-myinput field="name" label="名前" type="text" :defval="old('name', $row['name'])" placeholder="" />
    <x-myinput field="kana" label="かな" type="text" :defval="old('kana', $row['kana'])" placeholder="" />
    <x-myselect field="category" label="カテゴリ" :options="$category" :defval="old('category', $row['category'])" :enablefilter='false' />

    <?php foreach($nutris as $row) : $nutri_id = $row->id; ?>
        <x-mycheckbox :field="'nutri_ids[' . $nutri_id . ']'" :label="$row['name']" :defval="old('nutri_ids[$nutri_id]', in_array($nutri_id, $foodnutris))" />
    <?php endforeach; ?>

    <div class="field">
        <div class="control">
            <button id="act-submit" type="submit" class="button">更新</button>
        </div>
    </div>
</form>
@endsection
