<?php
/**
 * @param なし
 */

use \App\Http\Controllers\Admin\Menu\MenuController;

$modalaction = "extend";
$postdata = [
    MenuController::$index_NAME_EDATE => \Carbon\Carbon::today()->addDays(30)->format("Y-m-d"),
    MenuController::$index_NAME_SDATE => \Carbon\Carbon::today()->addDays(-370)->format("Y-m-d"),
];
$posturl = route('admin-menu-index', $postdata);
$seasonurl = route("admin-menu-season");
?>
<a class="button" href="{{ $posturl }}" id="act-{{ $modalaction }}">過去献立</a>
<a class="button" href="{{ $seasonurl }}" id="act-season">季節の献立</a>
