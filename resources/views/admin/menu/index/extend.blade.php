<?php
/**
 * @param なし
 */

use \App\Http\Controllers\Admin\Menu\MenuController;

$modalaction = "extend";
$postdata = [
    MenuController::$index_NAME_EDATE => \Carbon\Carbon::today()->addDays(14)->format("Y-m-d"),
    MenuController::$index_NAME_SDATE => \Carbon\Carbon::today()->addDays(-14)->format("Y-m-d"),
];
$posturl = route('admin-menu-index', $postdata);
?>
<a class="button" href="{{ $posturl }}" id="act-{{ $modalaction }}">前後2週間</a>
