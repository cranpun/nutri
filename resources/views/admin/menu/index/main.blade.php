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
    <a class="button" id="act-create-lunch" href="{{ route('admin-menu-update', ['servedate' => \Carbon\Carbon::today()->format('Y-m-d'), 'timing' => \App\L\MenuTiming::ID_LUNCH]) }}">昼食登録</a>
    <a class="button" id="act-create-dinner" href="{{ route('admin-menu-update', ['servedate' => \Carbon\Carbon::today()->format('Y-m-d'), 'timing' => \App\L\MenuTiming::ID_DINNER]) }}">夕食登録</a>
</section>
<div class="has-text-right">
    <span class="tag">{{ number_format(count($rows)) }}</span>
</div>
<table id="indextable" class="table is-fullwidth is-narrow is-bordered is-striped">
    <thead>
        <tr>
            <th>日付</th>
            <th>昼食</th>
            <th>夕食</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($rows as $date => $row): ?>
        <tr id="row-<?= $date ?>" class="">
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