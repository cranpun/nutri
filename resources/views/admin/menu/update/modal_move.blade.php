<?php
/**
 * @param なし
 */

use \App\Http\Controllers\Admin\Menu\MenuController;

$modalaction = "move";
$posturl = route('admin-menu-movestore', compact([
    "servedate",
    "timing"
]));
?>
<a class="button" id="act-{{ $modalaction }}-open"
    onclick="document.querySelector('#modal-{{ $modalaction }}').classList.add('is-active');">日付移動</a>
<div id="modal-{{ $modalaction }}" class="modal">
    <div class="modal-background"
        onclick="document.querySelector('#modal-{{ $modalaction }}').classList.remove('is-active')"></div>
    <div class="modal-content">
        <div class="box">
            <form name="form-{{ $modalaction }}" id="form-{{ $modalaction }}" method="POST"
                action="{{ $posturl }}" class="">
                @csrf
                <x-myinput field="movedate" label="移動先" type="date" :defval="$servedate" placeholder="" />
                <fieldset class="field">
                    <button type="submit" id="act-{{ $modalaction }}" class="button">移動</button>
                </fieldset>
            </form>
        </div>
    </div>
    <button class="modal-close"
        onclick="document.querySelector('#modal-{{ $modalaction }}').classList.remove('is-active')">閉じる</button>
</div>
