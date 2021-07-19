<?php
/**
 */
$posturl = route('admin-menu-swapstore', compact(['servedate', 'timing', 'dir']));
?>
<form action="{{ $posturl }}" method="POST" style="display: inline-block">
    @csrf
    <button type="submit" class="button is-small">
        <span class="material-icons">arrow_{{ $dir }}ward</span>
    </button>
</form>