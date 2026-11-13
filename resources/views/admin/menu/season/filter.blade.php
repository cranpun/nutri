@php
/**
 * @param なし
 */

use \App\Http\Controllers\Admin\Menu\MenuController;

$modalaction = "filter";
$posturl = route('admin-menu-season');
@endphp
<a class="button" id="act-{{ $modalaction }}-open" onclick="document.querySelector('#modal-{{ $modalaction }}').classList.add('is-active');">フィルター</a>
<div id="modal-{{ $modalaction }}" class="modal">
    <div class="modal-background" onclick="document.querySelector('#modal-{{ $modalaction }}').classList.remove('is-active')"></div>
    <div class="modal-content">
        <div class="box">
            <form name="form-{{ $modalaction }}" id="form-{{ $modalaction }}" method="GET" action="{{ $posturl }}" class="">
                <div class="select">
                    <select name="srch_month" id="srch_month" style="width: 100%;">
                        @for ($month = 1; $month <= 12; $month++)
                        <option value="{{ $month }}" {{ $srch["srch_month"] == $month ? " selected " : "" }} >{{ $month }}</option>
                        @endfor
                    </select>
                </div>

                <fieldset class="field">
                    <button type="submit" id="act-{{ $modalaction }}" class="button">読み込み</button>
                </fieldset>
            </form>
        </div>
    </div>
    <button class="modal-close" onclick="document.querySelector('#modal-{{ $modalaction }}').classList.remove('is-active')">閉じる</button>
</div>

