<?php
/**
 *
 */
?>
<?php foreach($lacknutris as $lacknutri) : $id = $lacknutri["id"]; ?>
    <a class="button is-small" id="act-lacknutri-open-{{ $id }}{" onclick="document.querySelector('#modal-lacknutri-{{ $id }}').classList.add('is-active');">
        {{ $lacknutri["name"] }}
    </a>
    <div id="modal-lacknutri-{{ $id }}" class="modal">
        <div class="modal-background" onclick="document.querySelector('#modal-lacknutri-{{ $id }}').classList.remove('is-active')"></div>
        <div class="modal-content">
            <div class="box">
                <ul>
                <?php foreach($lacknutri["foods"] as $food) : ?>
                    <li id="lacknutri-food-{{ $food->id }}">{{ $food->name }}</li>
                <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <button class="modal-close" onclick="document.querySelector('#modal-lacknutri-{{ $id }}').classList.remove('is-active')">閉じる</button>
    </div>
<?php endforeach; ?>
