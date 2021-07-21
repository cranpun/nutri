@extends("admin.base")

@section("title")
食材カレンダー
@endsection

@section("labeltitle")
食材カレンダー
@endsection

@section("labelsubtitle")

@endsection

@section("main")
<section class="mb-3">
    @include("admin.analy.calendarfood.filter")
</section>
<div class="has-text-right">
    <span class="tag">{{ number_format(count($rows)) }}</span>
</div>
<table id="indextable" class="table is-fullwidth is-narrow is-bordered is-striped">
    <thead>
        <tr>
            <th>カテゴリ</th>
            <th>名前</th>
            <?php foreach($period as $date) : ?>
                <th>{{ $date->format("d") }}</th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($rows as $food_id => $datedata): $food = $foods[$food_id]; ?>
        <tr id="row-<?= $food_id ?>" class="{{ $food['bgcolor'] }}">
            <td id="d-category-<?= $food_id ?>" class="d-category val">{{ $food->category }}</td>
            <td id="d-name-<?= $food_id ?>" class="d-name val"><?= $food->name ?></td>
            <?php foreach($datedata as $date => $count) : ?>
                <td id="d-date-{{ $food_id }}-{{ $date }}" class="has-text-right" style="background:rgba(255, 0, 0, {{ $count * 0.3 }})">{{ number_format($count) }}</td>
            <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
@endsection