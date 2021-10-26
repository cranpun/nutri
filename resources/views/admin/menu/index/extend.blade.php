<?php
/**
 * @param なし
 */

use \App\Http\Controllers\Admin\Menu\MenuController;

$modalaction = "extend";
$postdata = [
    MenuController::$index_NAME_EDATE => \Carbon\Carbon::today()->addDays(30)->format("Y-m-d"),
    MenuController::$index_NAME_SDATE => \Carbon\Carbon::today()->addDays(-90)->format("Y-m-d"),
];
$posturl = route('admin-menu-index', $postdata);
?>
<a class="button" href="{{ $posturl }}" id="act-{{ $modalaction }}">過去献立</a>
