<?php
$id = $food["food_id"];
?>
<a 
    id="d-food-{{ $id }}" 
    class="d-food"
    style="display: block"
    onclick="document.querySelector('#modal-food-{{ $id }}').classList.add('is-active');"
>
    <span class="val">{{ count($food["menus"]) }}</span>
</a>
<div id="modal-food-{{ $id }}" class="modal">
    <div class="modal-background" onclick="document.querySelector('#modal-food-{{ $id }}').classList.remove('is-active')"></div>
    <div class="modal-content">
        <div class="box">
            <ul>
            <?php foreach($food["menus"] as $menu) : ?>
                <li id="d-foodmenu-{{ $menu->menu_id }}">{{ "{$menu->menu_servedate} {$menu->menu_name}" }}</li>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <button class="modal-close" onclick="document.querySelector('#modal-food-{{ $id }}').classList.remove('is-active')">閉じる</button>
</div>