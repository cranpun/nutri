@extends("admin.base")

@section("title")
献立一覧
@endsection

@section("labeltitle")
<div>献立一覧</div>
<div class="is-size-5">
    <span id="srch-label-startday">{{ $srch[$NAME_START] }}</span>
    <span>～</span>
    <span id="srch-label-endday">{{ $srch[$NAME_END] }}</span>
</div>
@endsection

@section("labelsubtitle")
@endsection

@section("main")
<div>
    @include("admin.menu.index.filter", compact(["NAME_START", "NAME_END"]))
</div>
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
            <td id="d-servedate-<?= $date ?>" class="d-servedate val"><?= \Carbon\Carbon::parse($date)->format("m/d(D)") ?></td>
            <td id="d-lunch-<?= $date ?>" class="d-lunch">
                <div>
                    <a href="{{ route('admin-menu-update', ['servedate' => $date, 'timing' => \App\L\MenuTiming::ID_LUNCH]) }}" class="button is-small">編集</a>
                    @include("admin.menu.index.swap", ['servedate' => $date, 'timing' => \App\L\MenuTiming::ID_LUNCH, 'dir' => 'up'])
                    @include("admin.menu.index.swap", ['servedate' => $date, 'timing' => \App\L\MenuTiming::ID_LUNCH, 'dir' => 'down'])
                </div>
                <?php foreach($row[\App\L\MenuTiming::ID_LUNCH] as $menu): ?>
                    <div id="d-lunch-menu-<?= $menu->id ?>" class="d-lunch-menu val">{{ $menu->name }}</div>
                <?php endforeach; ?>
            </td>
            <td id="d-dinner-<?= $date ?>" class="d-dinner">
                <div>
                    <a href="{{ route('admin-menu-update', ['servedate' => $date, 'timing' => \App\L\MenuTiming::ID_DINNER]) }}" class="button is-small">編集</a>
                    @include("admin.menu.index.swap", ['servedate' => $date, 'timing' => \App\L\MenuTiming::ID_DINNER, 'dir' => 'up'])
                    @include("admin.menu.index.swap", ['servedate' => $date, 'timing' => \App\L\MenuTiming::ID_DINNER, 'dir' => 'down'])
                </div>
                <?php foreach($row[\App\L\MenuTiming::ID_DINNER] as $menu): ?>
                    <div id="d-dinner-menu-<?= $menu->id ?>" class="d-dinner-menu val">{{ $menu->name }}</div>
                <?php endforeach; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

@endsection