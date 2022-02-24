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
<form class="container" method="POST" action="{{ route('admin-menu-updatestore', compact(['servedate', 'timing']) + $srch) }}" style="position: relative; overflow-x: scroll;">
    @csrf

    <table id="lunchtable" class="table is-fullwidth is-narrow is-bordered is-striped" style="table-layout: fixed">
        <thead>
            <tr>
                <th style="width: 35px;"></th>
                <th style="width: 100px;">食材</th>
                <th style="width: 50px;">カテゴリ</th>
                <?php foreach($rows as $idx => $row) : ?>
                <td id="d-name-{{ $idx }}" class="d-name" style="width: 80px;">
                    <input type="text" name="name[{{$idx}}]" id="name_{{$idx}}" value='{{ old("name[{$idx}]", $row["name"]) }}' style="width: 100%" placeholder="メニュー名" tabindex={{ ($idx + 1) }}><br/>
                    <input type="text" name="memo[{{$idx}}]" id="memo_{{$idx}}" value='{{ old("memo[{$idx}]", $row["memo"]) }}' style="width: 100%" placeholder="メモ：URL等" tabindex={{ ($idx + 1) * 10 }}>
                    <div>
                        <?php $field = "recipe_id_{$idx}"; ?>
                        <select name="recipe_id[{{ $idx }}]" id="{{ $field }}" style="width: 100%;"  tabindex={{ ($idx + 1) * 100 }}>
                            @foreach ($recipe as $option)
                            <option value="{{ $option['id'] }}" <?= $row["recipe_id"] == $option["id"] ? " selected " : "" ?>>{{ $option['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <div>
                            <input type="text" id="{{ $field }}-filter" placeholder="レシピフィルタ" style="width: 100%;"  tabindex={{ ($idx + 1) * 1000 }}>
                        </div>
                        <script type="text/javascript">
                        let options_{{ $field }};
                        window.addEventListener("load", function() {
                            const filter = document.querySelector("#{{ $field }}-filter");
                            const select = document.querySelector("#{{ $field }}");

                            // optionsを退避
                            options_{{ $field }} = document.querySelectorAll("#{{ $field }} option");

                            // 本体処理
                            filter.addEventListener("change", function() {
                                // 処理中はselectを無効化
                                select.setAttribute("disabled", true);

                                // 一旦、現在のoptionを削除
                                document.querySelectorAll("#{{ $field }} option").forEach(function(node) {
                                    select.removeChild(node);
                                });
                                const str_filter = filter.value;
                                // filterに合致するoptionのみ追加
                                options_{{ $field }}.forEach(function(node) {
                                    if(node.text.indexOf(str_filter) >= 0) {
                                        select.append(node);
                                    }
                                });
                                // 処理完了
                                select.removeAttribute("disabled");
                            });
                        });
                        </script>
                    </div>
                </td>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach($foods as $food) : ?>
            <tr class="{{ $food->bgcolor }}">
                <th class="">{{ mb_substr($food->kana, 0, 1) }}</th>
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

    <div style="position: fixed; top: 290px; right: 24px;">
        <div class="control">
            <button id="act-submit" type="submit" class="button is-danger">更新</button>
        </div>
    </div>
</form>
@endsection
