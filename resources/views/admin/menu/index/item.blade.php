<?php
/**
 */

?>
<div class="columns">
    <div class="column">
        <a href="{{ route('admin-menu-update', ['servedate' => $servedate, 'timing' => $timing] + $srch) }}" id="act-update-{{ $servedate }}-{{ $timing }}" class="button is-small">編集</a>
        @include("admin.menu.index.swap", ['servedate' => $servedate, 'timing' => $timing, 'srch' => $srch, 'dir' => 'prev'])
        @include("admin.menu.index.swap", ['servedate' => $servedate, 'timing' => $timing, 'srch' => $srch, 'dir' => 'next'])
    </div>
    <div class="column is-11">
        <ul style="list-style: disc">
        <?php foreach($menus as $menu): ?>
        @include("admin.menu.index.foodmodal", ["menu" => $menu, "prefix" => ""])
        <?php endforeach; ?>
        </li>
    </div>
</div>
