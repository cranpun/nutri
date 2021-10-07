<?php
/**
 * @param なし
 */

use \App\Http\Controllers\Admin\Menu\MenuController;

$modalaction = "index";
$posturl = route('admin-menu-index');
?>
    <a class="button" id="act-{{ $modalaction }}-open" onclick="document.querySelector('#modal-{{ $modalaction }}').classList.add('is-active');">フィルター</a>
    <div id="modal-{{ $modalaction }}" class="modal">
        <div class="modal-background" onclick="document.querySelector('#modal-{{ $modalaction }}').classList.remove('is-active')"></div>
        <div class="modal-content">
            <div class="box">
                <form name="form-{{ $modalaction }}" id="form-{{ $modalaction }}" method="GET" action="{{ $posturl }}" class="">
                    <x-myinput :field="MenuController::$index_NAME_EDATE" label="終了日" type="date" :defval="$srch[MenuController::$index_NAME_EDATE]" placeholder="" />
                    <x-myinput :field="MenuController::$index_NAME_SDATE" label="開始日" type="date" :defval="$srch[MenuController::$index_NAME_SDATE]" placeholder="" />
                    <fieldset class="field">
                        <button type="submit" id="act-{{ $modalaction }}" class="button">読み込み</button>
                    </fieldset>
                </form>
            </div>
        </div>
        <button class="modal-close" onclick="document.querySelector('#modal-{{ $modalaction }}').classList.remove('is-active')">閉じる</button>
    </div>

