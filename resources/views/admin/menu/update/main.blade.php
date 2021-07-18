@extends("admin.base")

@section("title")
献立編集
@endsection

@section("labeltitle")
献立編集
@endsection

@section("labelsubtitle")
@endsection

@section("main")
<form class="container" method="POST" action="{{ route('admin-menu-updatestore', ['menu_id' => $row['id']]) }}">
    @csrf
    <input type="hidden" name="id" id="id" value="{{ $row['id'] }}">
    <x-myinput field="name" label="名前" type="text" :defval="old('name', $row['name'])" placeholder="" />

    <?php foreach($nutris as $row) : $nutri_id = $row->id; ?>
        <x-mycheckbox :field="'nutri_ids[' . $nutri_id . ']'" :label="$row['name']" :defval="old('nutri_ids[$nutri_id]', in_array($nutri_id, $menunutris))" />
    <?php endforeach; ?>

    <div class="field">
        <div class="control">
            <button id="act-submit" type="submit" class="button">更新</button>
        </div>
    </div>
</form>
@endsection