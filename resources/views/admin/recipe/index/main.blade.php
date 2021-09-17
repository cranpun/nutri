@extends("admin.base")

@section("title")
レシピ一覧
@endsection

@section("labeltitle")
レシピ一覧
@endsection

@section("labelsubtitle")
@endsection

@section("main")
<section class="mb-3">
    @include("admin.recipe.index.createmodal")
</section>
<div class="has-text-right">
    <span class="tag">{{ number_format(count($rows)) }}</span>
</div>
<table id="indextable" class="table is-fullwidth is-narrow is-bordered is-striped">
    <thead>
        <tr>
            <th>操作</th>
            <th>ID</th>
            <th>カテゴリ</th>
            <th>名前</th>
            <th>URL</th>
            <th>メモ</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($rows as $row): $id = $row['id']; ?>
        <tr id="row-<?= $id ?>">
            <td id="d-ctrl-<?= $id ?>">
                <a id="act-update-{{ $id }}" href="{{ route('admin-recipe-update', ['recipe_id' => $id]) }}" class="button is-small">編集</a>
                <span class="delbtn">
                    <x-mydelbutton
                        url="{{ route('admin-recipe-delete', ['recipe_id' => $id]) }}"
                        id="{{ $id }}"
                    />
                </span>
            </td>
            <td id="d-id-<?= $id ?>" class="d-id val"><?= $row["id"] ?></td>
            <td id="d-category-<?= $id ?>" class="d-category val">{{ $row["category"] }}</td>
            <td id="d-name-<?= $id ?>" class="d-name val"><?= $row["name"] ?></td>
            <td id="d-url-<?= $id ?>" class="d-url val">
                <a href="{{ $row['url'] }}" target="_blank">link</a>
            </td>
            <td id="d-memo-<?= $id ?>" class="d-memo val"><?= nl2br($row["memo"]) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script type="text/javascript">
window.addEventListener("load", function() {
    U.setConfirmDelete();
});
</script>
@endsection
