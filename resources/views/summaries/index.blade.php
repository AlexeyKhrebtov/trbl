@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-8">
                <h4 class="mt-1">Сводная таблица</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3 mb-4">
                <div class="list-group sticky-top" id="list-tab" role="tablist">
                    @foreach ($sectors as $sector)
                        <a class="list-group-item list-group-item-action @if ($loop->first) active @endif" id="list-sector_{{ $sector->id }}" data-toggle="list" href="#sector_{{ $sector->id }}" role="tab" aria-controls="home">{{ $sector->title }}</a>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-9">
                <div class="tab-content" id="nav-tabContent">
                    @foreach ($sectors as $sector)
                        <div class="tab-pane fade @if ($loop->first) show active @endif" id="sector_{{ $sector->id }}" role="tabpanel" aria-labelledby="list-sector_{{ $sector->id }}">
                            <h4>{{ $sector->title }}</h4>

                            <div class="table-responsive-sm">
                                <table class="table table-hover shadow-sm bg-white rounded">
                                    <caption>{{ $sector->title }}</caption>
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">№&nbsp;камеры</th>
                                            <th scope="col">комментарий</th>
                                            <th scope="col">№&nbsp;шкафа</th>
                                            <th scope="col">комментарий</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cameras as $camera)
                                            @if ($camera->cabinet->sector_id != $sector->id)
                                                @continue
                                            @endif
                                            <tr>
                                                <th scope="row">{{ $camera->title }}</th>
                                                <td>{!! nl2br(e($camera->comment)) !!}</td>
                                                <td>{{ $camera->cabinet->title }}</td>
                                                <td>{!! nl2br(e($camera->cabinet->comment)) !!}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
