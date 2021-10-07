<?php
$id = "{$prefix}{$menu->id}";
?>
<li>
<a 
    id="d-menu-{{ $id }}" 
    class="d-menu val"
    style="display: block"
    onclick="document.querySelector('#modal-menu-{{ $id }}').classList.add('is-active');"
>{{ $menu->name }}</a>
</li>
<div id="modal-menu-{{ $id }}" class="modal">
    <div class="modal-background" onclick="document.querySelector('#modal-menu-{{ $id }}').classList.remove('is-active')"></div>
    <div class="modal-content">
        <div class="box">
            <?php if(strlen($menu->memo) > 0) : ?>
            <div>
                <span class="tag">メモ</span>
                <div>
                    <?php if(filter_var($menu->memo, FILTER_VALIDATE_URL)) : // URLなのでリンク ?>
                        <a href="{{ $menu->memo }}" target="_blank">{{ $menu->memo }}</a>
                    <?php else : ?>
                        <span id="d-memo-{{ $id }}" class="d-memo">{{ $menu->memo }}</span>
                    <?php endif; ?>
                </div>
                <div>
                    <?php if(filter_var($menu->recipe_url, FILTER_VALIDATE_URL)) : // URLなのでリンク ?>
                        <a href="{{ $menu->recipe_url }}" target="_blank">{{ $menu->recipe_url }}</a>
                    <?php endif; ?>
                </div>
            </div>
            <hr />
            <?php endif; ?>
            <?php if(strlen($menu->recipe_url) > 0) : ?>
            <div>
                <span class="tag">レシピ</span>
                <div>
                    <?php if(filter_var($menu->recipe_url, FILTER_VALIDATE_URL)) : // URLなのでリンク ?>
                        <a href="{{ $menu->recipe_url }}" target="_blank">{{ $menu->recipe_url }}</a>
                    <?php endif; ?>
                </div>
            </div>
            <hr />
            <?php endif; ?>

            <?php if(count($menu->foods) > 0) : ?>
            <span class="tag">食材</span>
            <ul id="d-foods-{{ $id }}" class="d-foods">
            <?php foreach($menu->foods as $food) : ?>
                <li id="d-menufood-{{ $food->id }}">{{ $food->name }}</li>
            <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>
    <button class="modal-close" onclick="document.querySelector('#modal-menu-{{ $id }}').classList.remove('is-active')">閉じる</button>
</div>
