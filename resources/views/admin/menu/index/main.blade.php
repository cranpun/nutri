@extends("admin.base")

@section("title")
献立一覧
@endsection

@section("labeltitle")
献立一覧
@endsection

@section("labelsubtitle")
@endsection

@section("main")
<section class="mb-3">
    @include("admin.menu.index.createmodal")
</section>
<div class="has-text-right">
    <span class="tag">{{ number_format(count($rows)) }}</span>
</div>
<table id="indextable" class="table is-fullwidth is-narrow is-bordered is-striped">
    <thead>
        <tr>
            <th>操作</th>
            <th>日付</th>
            <th>昼食</th>
            <th>夕食</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($rows as $date => $row): ?>
        <tr id="row-<?= $date ?>" class="">
            <td id="d-ctrl-<?= $date ?>">
                <a id="act-update-{{ $date }}" href="{{ route('admin-menu-update', ['menu_id' => $date]) }}" class="button is-small">編集</a>
                <span class="delbtn">
                    <x-mydelbutton
                        url="{{ route('admin-menu-delete', ['menu_id' => $date]) }}"
                        id="{{ $date }}"
                    />
                </span>
            </td>
            <td id="d-servedate-<?= $date ?>" class="d-servedate val"><?= $date ?></td>
            <td id="d-lunch-<?= $date ?>" class="d-lunch">
                <?php foreach($row[\App\L\MenuTiming::ID_LUNCH] as $menu): ?>
                    <div id="d-lunch-menu-<?= $menu->id ?>" class="d-lunch-menu val">{{ $menu->name }}</div>
                <?php endforeach; ?>
            </td>
            <td id="d-dinner-<?= $date ?>" class="d-dinner">
                <?php foreach($row[\App\L\MenuTiming::ID_DINNER] as $menu): ?>
                    <div id="d-dinner-menu-<?= $menu->id ?>" class="d-dinner-menu val">{{ $menu->name }}</div>
                <?php endforeach; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

@endsection