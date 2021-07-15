@extends("admin.base")

@section("title")
食材一覧
@endsection

@section("labeltitle")
食材一覧
@endsection

@section("labelsubtitle")
@endsection

@section("main")
<section class="mb-3">
    @include("admin.food.index.createmodal")
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
            <th>栄養素</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($rows as $row): $id = $row['id']; ?>
        <tr id="row-<?= $id ?>" class="{{ $row['bgcolor'] }}">
            <td id="d-ctrl-<?= $id ?>">
                <a id="act-update-{{ $id }}" href="{{ route('admin-user-update', ['user_id' => $id]) }}" class="button is-small">編集</a>
                <span class="delbtn">
                    <x-mydelbutton
                        url="{{ route('admin-user-delete', ['user_id' => $id]) }}"
                        id="{{ $id }}"
                    />
                </span>
            </td>
            <td id="d-id-<?= $id ?>" class="d-id val"><?= $row["id"] ?></td>
            <td id="d-category-<?= $id ?>" class="d-category val"><?= $row["category"] ?></td>
            <td id="d-name-<?= $id ?>" class="d-name val"><?= $row["name"] ?></td>
            <td id="d-nutri-<?= $id ?>" class="d-nutri val"><?= join(",", $row["nutri"]) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

@endsection