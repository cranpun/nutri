<?php
/**
 */

?>
<div class="columns">
    <div class="column">
        <a href="{{ route('admin-menu-update', ['servedate' => $servedate, 'timing' => $timing]) }}" class="button is-small">編集</a>
        @include("admin.menu.index.swap", ['servedate' => $servedate, 'timing' => $timing, 'dir' => 'up'])
        @include("admin.menu.index.swap", ['servedate' => $servedate, 'timing' => $timing, 'dir' => 'down'])
    </div>
    <div class="column is-11">
        <?php foreach($menus as $menu): ?>
            <div id="d-{{ $timing }}-menu-{{ $menu->id }}" class="d-{{ $timing }}-menu val">{{ $menu->name }}</div>
        <?php endforeach; ?>
    </div>
</div>
