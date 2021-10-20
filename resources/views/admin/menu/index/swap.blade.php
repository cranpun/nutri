<?php
/**
 */
$posturl = route('admin-menu-swapstore', compact(['servedate', 'timing', 'dir']) + $srch);
?>
<form action="{{ $posturl }}" method="POST" style="display: inline-block">
    @csrf
    <button type="submit" class="button is-small" id="act-swap-{{ $servedate }}-{{ $timing }}-{{ $dir }}">
        <span class="material-icons">arrow_{{ $dir == "prev" ? "up" : "down" }}ward</span>
    </button>
</form>
