<?php
/**
 * @param なし
 */
$modalaction = "create";
$TKN_SERVEDATE = "__SERVEDATE__";
$posturl = route('admin-menu-update', ["servedate" => $TKN_SERVEDATE, "timing" => $timing]);
?>
 <span class="">
    <a class="button" id="act-{{ $modalaction }}-{{ $timing }}-open" onclick="document.querySelector('#modal-{{ $modalaction }}').classList.add('is-active');">
        {{ (new \App\L\MenuTiming())->label($timing) }}登録
    </a>
    <div id="modal-create" class="modal">
        <div class="modal-background" onclick="document.querySelector('#modal-{{ $modalaction }}').classList.remove('is-active')"></div>
        <div class="modal-content">
            <div class="box">
                <form name="form-{{ $modalaction }}" id="form-{{ $modalaction }}" method="GET" action="changebyjavascript" class="">
                    @csrf
                    <x-myinput field="servedate" label="日付" type="date" :defval="\Carbon\Carbon::today()->format('Y-m-d')" placeholder="" />
                    <fieldset class="field">
                        <button type="button" id="act-{{ $modalaction }}-{{ $timing }}" class="button">登録</button>
                        <script type="text/javascript">
                        window.addEventListener("load", () => {
                            document.querySelector("#act-{{ $modalaction }}-{{ $timing }}").addEventListener("click", () => {
                                const form = document.querySelector("#form-{{ $modalaction }}");
                                const servedate = document.querySelector("#servedate").value;
                                // 入力されたservedateに置き換え
                                form.action = "{{ $posturl }}".replaceAll("{{ $TKN_SERVEDATE }}", servedate);
                                form.submit();
                            });
                        });
                        </script>
                    </fieldset>
                </form>
            </div>
        </div>
        <button class="modal-close" onclick="document.querySelector('#modal-{{ $modalaction }}').classList.remove('is-active')">閉じる</button>
    </div>
</span>
