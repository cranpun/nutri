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
        <?php foreach($menus as $menu): $id = $menu->id; ?>
            <a 
                id="d-menu-{{ $menu->id }}" 
                class="d-menu val"
                style="display: block"
                onclick="document.querySelector('#modal-menu-{{ $id }}').classList.add('is-active');"
            >{{ $menu->name }}</a>
            <div id="modal-menu-{{ $id }}" class="modal">
                <div class="modal-background" onclick="document.querySelector('#modal-menu-{{ $id }}').classList.remove('is-active')"></div>
                <div class="modal-content">
                    <div class="box">
                        <ul>
                        <?php foreach($menu->foods as $food) : ?>
                            <li id="d-menufood-{{ $food->id }}">{{ $food->name }}</li>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <button class="modal-close" onclick="document.querySelector('#modal-menu-{{ $id }}').classList.remove('is-active')">閉じる</button>
            </div>
        <?php endforeach; ?>
    </div>
</div>
