@extends('admin.base')

@section('title')
    食材一覧
@endsection

@section('labeltitle')
    食材一覧
@endsection

@section('labelsubtitle')
    @if ($srch['srch_kana'] !== '')
        フィルター：{{ $srch['srch_kana'] }}
    @endif
@endsection

@section('main')
    <section class="mb-3">
        @include('admin.food.index.filter')
        @include('admin.food.index.createmodal')
    </section>
    <div class="has-text-right">
        <span class="tag">{{ number_format(count($rows)) }}</span>
    </div>
    <table id="indextable" class="table is-fullwidth is-narrow is-bordered is-striped">
        <thead>
            <tr>
                <th>操作</th>
                <th>ID</th>
                <th class="d-none">カテゴリ</th>
                <th>名前</th>
                <th class="d-none">かな</th>
                <th style="display: none">栄養素</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($rows as $row): $id = $row['id']; ?>
            <tr id="row-<?= $id ?>" class="{{ $row['bgcolor'] }}">
                <td id="d-ctrl-<?= $id ?>">
                    <a id="act-detail-{{ $id }}" href="{{ route('admin-food-detail', ['food_id' => $id]) }}"
                        class="button is-small">詳細</a>
                    <a id="act-update-{{ $id }}" href="{{ route('admin-food-update', ['food_id' => $id]) }}"
                        class="button is-small">編集</a>
                    <span class="delbtn">
                        <x-mydelbutton url="{{ route('admin-food-delete', ['food_id' => $id]) }}"
                            id="{{ $id }}" />
                    </span>
                </td>
                <td id="d-id-<?= $id ?>" class="d-id val"><?= $row['id'] ?></td>
                <td id="d-category-<?= $id ?>" class="d-category val d-none">
                    <?= (new \App\L\FoodCategory())->label($row['category']) ?></td>
                <td id="d-name-<?= $id ?>" class="d-name val"><?= $row['name'] ?></td>
                <td id="d-kana-<?= $id ?>" class="d-kana val d-none"><?= $row['kana'] ?></td>
                <td style="display: none" id="d-nutri-<?= $id ?>" class="d-nutri val">
                    <?php foreach($row["nutri"] as $nutri_id => $nutri): ?>
                    <span id="d-foodnutri-{{ $id }}-{{ $nutri_id }}"
                        class="d-foodnutri-{{ $id }}">{{ $nutri }}</span>
                    <?php endforeach; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script type="text/javascript">
        window.addEventListener("load", function() {
            U.setConfirmDelete();
        });
    </script>
@endsection
