<?php
/**
 * @param なし
 */

use \App\Http\Controllers\Admin\Menu\MenuController;

$modalaction = "index";
$posturl = route('admin-menu-index');
?>
    <?php if($isPrevilege) : ?>
    <form id="form-deflunchstore" method="POST" action="{{ route('admin-menu-deflunchstore', $srch) }}" style="display: inline;">
        @csrf
        <button type="submit" id="act-deflunchstore" class="button">SDL</button>
    </form>
    <?php endif; ?>
