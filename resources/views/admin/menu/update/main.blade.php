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
<form class="container" method="POST" action="{{ route('admin-menu-updatestore', compact(['servedate', 'timing'])) }}">
    @csrf
    <x-myinput field="servedate" label="日にち" type="date" :defval="old('servedate', $servedate)" placeholder="" />
    <h4 class="is-size-3">{{ (new \App\L\MenuTiming())->label($timing) }}</h4>
    <table id="lunchtable" class="table is-fullwidth is-narrow is-bordered is-striped">
        <thead>
            <tr>
                <th>食材</th>
                <?php foreach($rows[\App\L\MenuTiming::ID_LUNCH] as $idx => $row) : ?>
                <td id="d-{{ $idx }}" class="d-name">
                    <input type="text" name="name[{{$idx}}]" id="name_{{$idx}}" value='{{ old("name[{$idx}]", $row["name"]) }}'>
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