@extends('admin.base')

@section('title')
    季節の献立
@endsection

@section('labeltitle')
    <div>季節の献立</div>
@endsection

@section('labelsubtitle')
    <div class="is-size-5">
        <span id="srch-label-month">{{ $srch['srch_month'] }}</span>月
    </div>
@endsection

@section('main')
    <div>
        <section class="mb-3">
            <a class="button" href="{{ route("admin-menu-season", ["srch_month" => $srch["pre_month"]]) }}">＜</a>
            @include('admin.menu.season.filter', compact(['srch']))
            <a class="button" href="{{ route("admin-menu-season", ["srch_month" => $srch["next_month"]]) }}">＞</a>
        </section>
    </div>

    <div class="has-text-right">
        <span class="tag">{{ number_format(count($rows)) }}</span>
    </div>
    <table id="indextable" class="table is-fullwidth is-narrow is-bordered is-striped" style="table-layout: fixed;">
        <thead>
            <tr>
                <th style="width: 60px;">日付</th>
                @foreach(array_keys($rows[array_key_first($rows)]) as $year)
                <th>{{ $year }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $day => $years)
            <tr id="row-{{ $day }}">
                <td id="d-servedate-{{ $day }}" class="d-servedate val">{{ $day }}</td>
                @foreach($years as $year => $menus)
                <td id="d-year-{{ $year }}" class="d-year">
                    <ul>
                    @foreach($menus as $menu)
                        <li>{{ $menu->name }}</li>
                    @endforeach
                    </li>
                </td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
