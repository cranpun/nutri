<?php
/**
 * @param なし
 */
$modalaction = "create";
$posturl = route('admin-recipe-createstore');
?>
<a class="button" id="act-{{ $modalaction }}-open" onclick="document.querySelector('#modal-{{ $modalaction }}').classList.add('is-active');">登録</a>
<div id="modal-create" class="modal">
    <div class="modal-background" onclick="document.querySelector('#modal-{{ $modalaction }}').classList.remove('is-active')"></div>
    <div class="modal-content">
        <div class="box">
            <form name="form-{{ $modalaction }}" id="form-{{ $modalaction }}" method="POST" action="{{ $posturl }}" class="">
                @csrf
                <x-myinput field="name" label="名前" type="text" defval="" placeholder="" />
                <x-myselect field="category" label="カテゴリ" :options="$category" defval="" :enablefilter='false' />
                <x-myinput field="url" label="URL" type="text" defval="" placeholder="" />
                <x-mytextarea field="memo" label="メモ" defval="" />
                <fieldset class="field">
                    <button type="submit" id="act-{{ $modalaction }}" class="button">登録</button>
                </fieldset>
            </form>
        </div>
    </div>
    <button class="modal-close" onclick="document.querySelector('#modal-{{ $modalaction }}').classList.remove('is-active')">閉じる</button>
</div>
