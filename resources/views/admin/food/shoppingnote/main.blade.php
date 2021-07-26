@extends("admin.base")

@section("title")
買い物メモ
@endsection

@section("labeltitle")
買い物メモ
@endsection

@section("labelsubtitle")
<div class="is-size-5">
    <span id="srch-label-sdate">{{ \Carbon\Carbon::parse($sdate)->format("m/d(D)") }}</span>
    <span>～</span>
    <span id="srch-label-edate">{{ \Carbon\Carbon::parse($edate)->format("m/d(D)") }}</span>
</div>
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
            <th>名前</th>
            <th>カテゴリ</th>
            <th>回数</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($rows as $row): $id = $row['id']; ?>
        <tr id="row-<?= $id ?>">
            <td id="d-name-<?= $id ?>" class="d-name val"><?= $row["name"] ?></td>
            <td id="d-category-<?= $id ?>" class="d-category val"><?= $row["category"] ?></td>
            <td id="d-count-<?= $id ?>" class="d-count val"><?= $row["count"] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
@endsection