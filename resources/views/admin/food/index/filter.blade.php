<?php
/**
 * @param なし
 */

use \App\Http\Controllers\Admin\Recipe\RecipeController;

$modalaction = "index";
$posturl = route('admin-food-index');
?>
    <a class="button" id="act-{{ $modalaction }}-open" onclick="document.querySelector('#modal-{{ $modalaction }}').classList.add('is-active');">フィルター</a>
    <div id="modal-{{ $modalaction }}" class="modal">
        <div class="modal-background" onclick="document.querySelector('#modal-{{ $modalaction }}').classList.remove('is-active')"></div>
        <div class="modal-content">
            <div class="box">
                <form name="form-{{ $modalaction }}" id="form-{{ $modalaction }}" method="GET" action="{{ $posturl }}" class="">
                    <x-myinput field="srch_kana" label="かな" type="text" :defval="$srch['srch_kana']" placeholder="" />

                    <fieldset class="field">
                        <button type="submit" id="act-{{ $modalaction }}" class="button">読み込み</button>
                    </fieldset>
                </form>
            </div>
        </div>
        <button class="modal-close" onclick="document.querySelector('#modal-{{ $modalaction }}').classList.remove('is-active')">閉じる</button>
    </div>

