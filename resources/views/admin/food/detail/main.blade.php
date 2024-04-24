@extends("admin.base")

@section("title")
食材詳細
@endsection

@section("labeltitle")
食材詳細
@endsection

@section("labelsubtitle")
@endsection

@section("main")
<form class="container" method="POST" action="{{ route('admin-food-updatestore', ['food_id' => $row['id']]) }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id" value="{{ $row['id'] }}">
    <x-mylabel field="favorite" label="お気に入り" :defval="$row['favorite'] == 0 ? 'OFF' : 'ON'" />
    <x-mylabel field="name" label="名前" :defval="$row['name']" placeholder="" />
    <x-mylabel field="kana" label="かな" :defval="$row['kana']" placeholder="" />
    <x-mylabel field="category" label="カテゴリ" :defval="$row['foodcategory']" />

    <h3 class="is-size-6 has-text-weight-bold">栄養素</h3>
    <ul style="list-style-type: disc;" class=" pl-5">
    <?php foreach($foodnutris as $foodnutri): ?>
        <li id="foodnutri-{{ $foodnutri['id'] }}">{{ $foodnutri['nutri_name'] }}</li>
    <?php endforeach; ?>
    </ul>

    <h3 class="is-size-6 has-text-weight-bold pt-3">レシピ</h3>
    <table class="table is-bordered is-stripe is-narrow">
        <thead>
            <th>日付</th>
            <th>名前</th>
            <th>URL</th>
        </thead>
        <tbody>
            @foreach($menus as $menu)
            <tr>
                <td id="menu-servedate-{{ $menu['id'] }}" class="nowrap">{{ $menu['servedate'] }}</td>
                <td id="menu-name-{{ $menu['id'] }}" class="nowrap">{{ $menu['name'] }}</td>
                <td id="recipe-url-{{ $menu['id'] }}">
                    @if($menu['recipe_id'])
                        <a href="{{ $menu['recipe_url'] }}" target="_blank">url</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</form>
@endsection
