<?php
/**
 * @param なし
 */
$modalaction = "index";
$posturl = route('admin-menu-index');
?>
 <section class="mb-3">
    <a class="button" id="act-{{ $modalaction }}-open" onclick="document.querySelector('#modal-{{ $modalaction }}').classList.add('is-active');">フィルター</a>
    <div id="modal-{{ $modalaction }}" class="modal">
        <div class="modal-background" onclick="document.querySelector('#modal-{{ $modalaction }}').classList.remove('is-active')"></div>
        <div class="modal-content">
            <div class="box">
                <form name="form-{{ $modalaction }}" id="form-{{ $modalaction }}" method="GET" action="{{ $posturl }}" class="">
                    <x-myinput :field="$NAME_START" label="開始日" type="date" :defval="$srch[$NAME_START]" placeholder="" />
                    <x-myinput :field="$NAME_END" label="終了日" type="date" :defval="$srch[$NAME_END]" placeholder="" />
                    <fieldset class="field">
                        <button type="submit" id="act-{{ $modalaction }}" class="button">読み込み</button>
                    </fieldset>
                </form>
            </div>
        </div>
        <button class="modal-close" onclick="document.querySelector('#modal-{{ $modalaction }}').classList.remove('is-active')">閉じる</button>
    </div>
</section>
