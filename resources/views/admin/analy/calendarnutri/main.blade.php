@extends("admin.base")

@section("title")
栄養素カレンダー
@endsection

@section("labeltitle")
栄養素カレンダー
@endsection

@section("labelsubtitle")
<div class="is-size-5">
    <span id="srch-label-startday">{{ $srch[$NAME_START] }}</span>
    <span>～</span>
    <span id="srch-label-endday">{{ $srch[$NAME_END] }}</span>
</div>
@endsection

@section("main")
<section class="mb-3">
    @include("admin.analy.calendarnutri.filter")
</section>
<div class="has-text-right">
    <span class="tag">{{ number_format(count($rows)) }}</span>
</div>
<table id="indextable" class="table is-fullwidth is-narrow is-bordered is-striped">
    <thead>
        <tr>
            <th>名前</th>
            <?php foreach($period as $date) : ?>
                <th>{{ $date->format("d") }}</th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($rows as $nutri_id => $datedata): $nutri = $nutris[$nutri_id]; ?>
        <tr id="row-<?= $nutri_id ?>">
            <td id="d-name-<?= $nutri_id ?>" class="d-name val"><?= $nutri->name ?></td>
            <?php foreach($datedata as $date => $count) : ?>
                <td id="d-date-{{ $nutri_id }}-{{ $date }}" class="has-text-right" style="background:rgba(255, 0, 0, {{ $count * 0.1 }})">{{ number_format($count) }}</td>
            <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
@endsection