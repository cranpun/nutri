<?php
use \App\Http\Controllers\Admin\Food\FoodController;
?>

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
<form class="container" method="GET" action="{{ route('admin-food-shoppingnote') }}">
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
        <?php foreach($rows as $row): $id = $row['food_id']; ?>
        <tr id="row-<?= $id ?>">
            <td>
                <label>
                    <input type="checkbox" name='{{ FoodController::$shoppingnote_NAME_FOOD_ID . "[{$id}]" }}' {{ in_array($id, $food_ids) ? "checked" : "" }} >
                    <span id="d-food_name-<?= $id ?>" class="d-food_name val"><?= $row["food_name"] ?></span>
                </label>
            </td>
            <td id="d-category-<?= $id ?>" class="d-category val"><?= $row["food_category"] ?></td>
            <td id="d-count-<?= $id ?>" class="d-count val">
                @include("admin.food.shoppingnote.menumodal", ["food" => $row])
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="field">
    <div class="control">
        <button id="act-submit" type="submit" class="button">一時保存</button>
    </div>
</div>

</form>
@endsection