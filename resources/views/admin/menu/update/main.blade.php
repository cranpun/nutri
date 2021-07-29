@extends("admin.base")

@section("title")
献立
@endsection

@section("labeltitle")
献立
@endsection

@section("labelsubtitle")
<span id='label-servedate'>{{  \Carbon\Carbon::parse($servedate)->format("m/d(D)") }}</span>
<span id="label-timing">{{ (new \App\L\MenuTiming())->label($timing) }}</span>
@endsection

@section("main")
<section class="container">
    <h4>不足栄養素</h4>
    @include("admin.menu.update.lacknutris", ["lacknutris" => $lacknutris])
    <hr />
</section>
<form class="container" method="POST" action="{{ route('admin-menu-updatestore', compact(['servedate', 'timing'])) }}">
    @csrf
    <div class="field">
        <div class="control">
            <button id="act-submit-top" type="submit" class="button">更新</button>
        </div>
    </div>

    <table id="lunchtable" class="table is-fullwidth is-narrow is-bordered is-striped" style="table-layout: fixed">
        <thead>
            <tr>
                <th style="width: 100px;">食材</th>
                <th style="width: 50px;">カテゴリ</th>
                <?php foreach($rows as $idx => $row) : ?>
                <td id="d-{{ $idx }}" class="d-name" style="width: 80px;">
                    <input type="text" name="name[{{$idx}}]" id="name_{{$idx}}" value='{{ old("name[{$idx}]", $row["name"]) }}' style="width: 100%">
                </td>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach($foods as $food) : ?>
            <tr class="{{ $food->bgcolor }}">
                <th class="">{{ in_array($food->id, $recomandfoods) ? "★" : "　"  }}{{ $food->name }}</th>
                <th class="nowrap">{{ (new \App\L\FoodCategory())->label($food->category) }}</th>
                <?php foreach($rows as $idx => $row) : ?>
                    <td id="d-menufood-{{ $food->id }}" class="d-menufood has-text-centered">
                        <input type="checkbox" name='{{ "menufood[{$idx}][{$food->id}]" }}' id='{{ "menufood_{$idx}_{$food->id}" }}' {{ $menufoods[$idx][$food->id] ? " checked " : "" }} >
                    </td>
                <?php endforeach; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="field">
        <div class="control">
            <button id="act-submit" type="submit" class="button">更新</button>
        </div>
    </div>
</form>
@endsection
