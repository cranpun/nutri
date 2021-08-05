<?php
use \App\Http\Controllers\Admin\Menu\MenuController;
?>

@extends("admin.base")

@section("title")
献立一覧
@endsection

@section("labeltitle")
<div>献立一覧</div>
@endsection

@section("labelsubtitle")
<div class="is-size-5">
    <span id="srch-label-startday">{{ $srch[MenuController::$index_NAME_SDATE] }}</span>
    <span>～</span>
    <span id="srch-label-endday">{{ $srch[MenuController::$index_NAME_EDATE] }}</span>
</div>
@endsection

@section("main")
<div>
    @include("admin.menu.index.filter", compact(["srch"]))
</div>

<?php
$today = \Carbon\Carbon::today()->format("Y-m-d");
?>
<?php if(array_key_exists($today, $rows)) : ?>
<h4 class="is-size-4">本日（{{ $today }}）の献立</h4>
<table id="indextable" class="table is-fullwidth is-narrow is-bordered is-striped" style="table-layout: fixed;">
    <thead>
        <tr>
            <th>昼食</th>
            <th>夕食</th>
        </tr>
    </thead>
    <tbody>
        <tr id="row-today" class="">
            <td id="d-lunch-today" class="d-lunch">
                <?php foreach($rows[$today][\App\L\MenuTiming::ID_LUNCH] as $menu): ?>
                    @include("admin.menu.index.foodmodal", ["menu" => $menu, "prefix" => "today"])
                <?php endforeach; ?>
            </td>
            <td id="d-dinner-today" class="d-dinner">
            <ul>
                <?php foreach($rows[$today][\App\L\MenuTiming::ID_DINNER] as $menu): ?>
                    @include("admin.menu.index.foodmodal", ["menu" => $menu, "prefix" => "today"])
                <?php endforeach; ?>
                </ul>
            </td>
        </tr>
    </tbody>
</table>

<hr />
<?php endif; ?>

<div class="has-text-right">
    <span class="tag">{{ number_format(count($rows)) }}</span>
</div>
<table id="indextable" class="table is-fullwidth is-narrow is-bordered is-striped" style="table-layout: fixed;">
    <thead>
        <tr>
            <th style="width: 60px;">日付</th>
            <th>昼食</th>
            <th>夕食</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($rows as $date => $row): ?>
        <tr id="row-<?= $date ?>" class="{{ $date == $today ? 'has-background-primary-light' : '' }}">
            <td id="d-servedate-<?= $date ?>" class="d-servedate val"><?= \Carbon\Carbon::parse($date)->format("m/d\n(D)") ?></td>
            <td id="d-lunch-<?= $date ?>" class="d-lunch">
                @include("admin.menu.index.item", ["servedate" => $date, "srch" => $srch, "timing" => \App\L\MenuTiming::ID_LUNCH, "menus" => $row[\App\L\MenuTiming::ID_LUNCH]])
            </td>
            <td id="d-dinner-<?= $date ?>" class="d-dinner">
                @include("admin.menu.index.item", ["servedate" => $date, "srch" => $srch, "timing" => \App\L\MenuTiming::ID_DINNER, "menus" => $row[\App\L\MenuTiming::ID_DINNER]])
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

@endsection
