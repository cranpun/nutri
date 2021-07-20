<?php
$id = "{$prefix}{$menu->id}";
?>
<a 
    id="d-menu-{{ $id }}" 
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