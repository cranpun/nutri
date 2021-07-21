<?php
$id = "{$nutri->id}";
?>
<a 
    id="d-nutri-{{ $id }}" 
    class="d-nutri val"
    style="display: block"
    onclick="document.querySelector('#modal-nutri-{{ $id }}').classList.add('is-active');"
>{{ $nutri->name }}</a>
<div id="modal-nutri-{{ $id }}" class="modal">
    <div class="modal-background" onclick="document.querySelector('#modal-nutri-{{ $id }}').classList.remove('is-active')"></div>
    <div class="modal-content">
        <div class="box">
            <ul>
            <?php foreach($nutri->foods as $food) : ?>
                <li id="d-food-{{ $food->id }}">{{ $food->name }}</li>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <button class="modal-close" onclick="document.querySelector('#modal-nutri-{{ $id }}').classList.remove('is-active')">閉じる</button>
</div>