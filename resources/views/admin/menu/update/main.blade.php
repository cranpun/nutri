@extends("admin.base")

@section("title")
献立編集
@endsection

@section("labeltitle")
献立編集
@endsection

@section("labelsubtitle")
@endsection

@section("main")
<form class="container" method="POST" action="{{ route('admin-menu-updatestore', ['servedate' => $servedate]) }}">
    @csrf
    <h4 class="is-size-3">昼食</h4>
    <table id="lunchtable" class="table is-fullwidth is-narrow is-bordered is-striped">
        <thead>
            <tr>
                <th>食材</th>
                <?php foreach($rows[\App\L\MenuTiming::ID_LUNCH] as $idx => $row) : ?>
                <td id="menu-lunch-{{ $idx }}" class="menu menu-lunch">
                    <input type="text" name="menu_lunch[{{$idx}}]" id="menu_lunch_{{$idx}}" value='{{ old("menu_lunch[{$idx}]", $row["name"]) }}'>
                </td>
                <?php endforeach; ?>
        </thead>
    </table>

    <hr />

    <h4 class="is-size-3">夕食</h4>
    <table id="dinnertable" class="table is-fullwidth is-narrow is-bordered is-striped">
        <thead>
            <tr>
                <th>食材</th>
                <?php foreach($rows[\App\L\MenuTiming::ID_DINNER] as $idx => $row) : ?>
                <td id="menu-dinner-{{ $idx }}" class="menu menu-dinner">
                    <input type="text" name="menu_dinner[{{$idx}}]" id="menu_dinner_{{$idx}}" value='{{ old("menu_dinner[{$idx}]", $row["name"]) }}'>
                </td>
                <?php endforeach; ?>
        </thead>
    </table>

    <div class="field">
        <div class="control">
            <button id="act-submit" type="submit" class="button">更新</button>
        </div>
    </div>
</form>
@endsection