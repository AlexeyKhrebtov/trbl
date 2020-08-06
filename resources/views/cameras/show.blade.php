@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $camera->title }}</h1>

        <div class="row">
            <div class="col-sm-4">
                <p class="lead">Камера</p>
            </div>
            <div class="col-sm-4">
                <a href="{{ route('cameras.index') }}" class="btn btn-outline-info mb-2" role="button"><i class="fas fa-undo"></i> Вернуться к списку камер</a>
            </div>
            <div class="col-sm-4">
                <a href="{{ route('cameras.edit', $camera->id) }}" class="btn btn-outline-dark mb-2"  role="button"><i class="fas fa-edit"></i> Редактировать камеру</a>
            </div>
        </div>

        <div class="shadow-sm p-3 mb-5 bg-white rounded">
            <dl class="row">
                <dt class="col-sm-3">Номер</dt>
                <dd class="col-sm-9">{{ $camera->title }}</dd>
                <dt class="col-sm-3">Местоположение</dt>
                <dd class="col-sm-9">{{ $camera->location_km }} км, {{ $camera->location_piket }} пикет</dd>
                <dt class="col-sm-3">Шкаф</dt>
                <dd class="col-sm-9"><a href="{{route('cabinets.show', $camera->cabinet->id)}}">{{ $camera->cabinet->title }} &nbsp; <i class="fas fa-external-link-alt"></i></a></dd>
                <dt class="col-sm-3">Доступ</dt>
                <dd class="col-sm-9">
                    <dl>
                        <dd><code class="user-select-all">{{ $camera->login }}:{{ $camera->password }}&#64;{{ $camera->ip }}</code></dd>
                        <dt class="col-sm-3">IP</dt>
                        <dd class="col-sm-9 user-select-all">{{ $camera->ip }}</dd>
                        <dt class="col-sm-3">Login</dt>
                        <dd class="col-sm-9 user-select-all">{{ $camera->login }}</dd>
                        <dt class="col-sm-3">Password</dt>
                        <dd class="col-sm-9 user-select-all">{{ $camera->password }}</dd>
                    </dl>
                </dd>
                <dt class="col-sm-3">Комментарий</dt>
                <dd class="col-sm-9">{!! nl2br(e($camera->comment)) !!}</dd>
                <dt class="col-sm-3">Координаты</dt>
                <dd class="col-sm-9">
                    <div class="input-group input-group-sm mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                        </div>
                        <input class="form-control" type="text" readonly value="{{ $camera->lat }}, {{ $camera->lng }}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button">copy</button>
                        </div>
                    </div>
                    <p>Открыть в <a href="yandexnavi://build_route_on_map?lat_to={{  $camera->lat }}&lon_to={{ $camera->lng }}">Яндекс.Навигатор <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAxIiBoZWlnaHQ9IjEwMSIgdmlld0JveD0iMCAwIDEwMSAxMDEiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTI2LjU3MDUgMS43MzI0Mkg3NC4wNzI3Qzc4LjE3NTUgMS43MzI0MiA4MC4xMTA1IDEuNzM1NTMgODEuNzEzNiAxLjk4OTQ0QzkwLjY0NjMgMy40MDQyNCA5Ny42NTIxIDEwLjQxIDk5LjA2NjkgMTkuMzQyN0M5OS4zMjA4IDIwLjk0NTggOTkuMzIzOSAyMi44ODA4IDk5LjMyMzkgMjYuOTgzNlY3NC40ODU4Qzk5LjMyMzkgNzguNTg4NiA5OS4zMjA4IDgwLjUyMzUgOTkuMDY2OSA4Mi4xMjY3Qzk3LjY1MjEgOTEuMDU5NCA5MC42NDYzIDk4LjA2NTEgODEuNzEzNiA5OS40Nzk5QzgwLjExMDUgOTkuNzMzOSA3OC4xNzU1IDk5LjczNyA3NC4wNzI3IDk5LjczN0gyNi41NzA1QzIyLjQ2NzcgOTkuNzM3IDIwLjUzMjggOTkuNzMzOSAxOC45Mjk2IDk5LjQ3OTlDOS45OTY5MiA5OC4wNjUxIDIuOTkxMTUgOTEuMDU5NCAxLjU3NjM1IDgyLjEyNjdDMS4zMjI0NCA4MC41MjM1IDEuMzE5MzQgNzguNTg4NiAxLjMxOTM0IDc0LjQ4NThWMjYuOTgzNkMxLjMxOTM0IDIyLjg4MDggMS4zMjI0NCAyMC45NDU4IDEuNTc2MzUgMTkuMzQyN0MyLjk5MTE1IDEwLjQxIDkuOTk2OTIgMy40MDQyNCAxOC45Mjk2IDEuOTg5NDRDMjAuNTMyOCAxLjczNTUzIDIyLjQ2NzcgMS43MzI0MiAyNi41NzA1IDEuNzMyNDJaIiBzdHJva2U9IiNFMkUyRTIiIHN0cm9rZS13aWR0aD0iMiIvPjxwYXRoIGQ9Ik04NC45NzExIDE2LjE2NDFMMTEuODQyOCA0NS44ODI4TDQzLjg0MzMgNTcuMzEwMkw1NS4yNzA4IDg5LjI5MjRMODQuOTcxMSAxNi4xNjQxWiIgZmlsbD0idXJsKCNwYWludDBfbGluZWFyKSIvPjxwYXRoIGQ9Ik04NC45NzE4IDE2LjE2NDFMNDIuNzAzMSA1OC40NTExTDU1LjI3MTUgODkuMjkyNEw4NC45NzE4IDE2LjE2NDFaIiBmaWxsPSIjRkZDQzAwIi8+PHBhdGggZD0iTTQxLjU2MTUgNTkuNTkyMUw1NS4yNzA4IDg5LjI5MjRMNTAuNjg4NyA1MC40NDY0TDExLjg0MjggNDUuODgyOEw0MS41NjE1IDU5LjU5MjFaIiBmaWxsPSIjRUNBNzA0Ii8+PGRlZnM+PGxpbmVhckdyYWRpZW50IGlkPSJwYWludDBfbGluZWFyIiB4MT0iMTEuODQzMSIgeTE9Ijg5LjI5MSIgeDI9Ijg0Ljk3NDUiIHkyPSIxNi4xNTk2IiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHN0b3Agc3RvcC1jb2xvcj0iI0ZGQ0MwMCIvPjxzdG9wIG9mZnNldD0iMSIgc3RvcC1jb2xvcj0iI0ZGRTk5MiIvPjwvbGluZWFyR3JhZGllbnQ+PC9kZWZzPjwvc3ZnPg==" style="height:22px;"></a> или показать на <a href="http://maps.yandex.ru/?text={{ $camera->lat }}N,{{ $camera->lng }}E" target="_blank">Яндекс.Карты <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAxIiBoZWlnaHQ9IjEwMSIgdmlld0JveD0iMCAwIDEwMSAxMDEiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTEgMjYuOTgzNkMxIDIyLjg4MDggMS4wMDMxIDIwLjk0NTggMS4yNTcwMiAxOS4zNDI3QzIuNjcxODIgMTAuNDEgOS42Nzc1OSAzLjQwNDI0IDE4LjYxMDMgMS45ODk0NEMyMC4yMTM0IDEuNzM1NTMgMjIuMTQ4NCAxLjczMjQyIDI2LjI1MTIgMS43MzI0Mkg3My43NTM0Qzc3Ljg1NjIgMS43MzI0MiA3OS43OTExIDEuNzM1NTMgODEuMzk0MyAxLjk4OTQ0QzkwLjMyNyAzLjQwNDI0IDk3LjMzMjcgMTAuNDEgOTguNzQ3NSAxOS4zNDI3Qzk5LjAwMTQgMjAuOTQ1OCA5OS4wMDQ1IDIyLjg4MDggOTkuMDA0NSAyNi45ODM2Vjc0LjQ4NThDOTkuMDA0NSA3OC41ODg2IDk5LjAwMTQgODAuNTIzNSA5OC43NDc1IDgyLjEyNjdDOTcuMzMyNyA5MS4wNTk0IDkwLjMyNyA5OC4wNjUxIDgxLjM5NDMgOTkuNDc5OUM3OS43OTExIDk5LjczMzkgNzcuODU2MSA5OS43MzcgNzMuNzUzMyA5OS43MzdIMjYuMjUxMkMyMi4xNDg0IDk5LjczNyAyMC4yMTM0IDk5LjczMzkgMTguNjEwMyA5OS40Nzk5QzkuNjc3NTkgOTguMDY1MSAyLjY3MTgyIDkxLjA1OTQgMS4yNTcwMiA4Mi4xMjY3QzEuMDAzMSA4MC41MjM1IDEgNzguNTg4NiAxIDc0LjQ4NThWMjYuOTgzNloiIHN0cm9rZT0iI0UyRTJFMiIgc3Ryb2tlLXdpZHRoPSIyIi8+PHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik02MC4zMTM2IDQ0Ljc0MjlMNzQuNzQxMiAzOC4xNjhDNzQuNzQxMiA0OS42Nzg1IDY2Ljc5MDggNjEuNTcxNCA1OS43Mzc0IDcyLjkwMDZMNDcuNjQ2NSA5MC44NDkzTDUyLjkzNjUgNTguMDc4Mkw2MC4zMTM2IDQ0Ljc0MjlaIiBmaWxsPSIjRTAwMDAwIi8+PHBhdGggZD0iTTUwLjQxMzQgNjEuODI2OEM2My44OTY2IDYxLjgyNjggNzQuODI2OCA1MC44OTY2IDc0LjgyNjggMzcuNDEzNEM3NC44MjY4IDIzLjkzMDMgNjMuODk2NiAxMyA1MC40MTM0IDEzQzM2LjkzMDMgMTMgMjYgMjMuOTMwMyAyNiAzNy40MTM0QzI2IDUwLjg5NjYgMzYuOTMwMyA2MS44MjY4IDUwLjQxMzQgNjEuODI2OFoiIGZpbGw9IiNGRjMzMzMiLz48cGF0aCBkPSJNNTAuNDEyOCA0Ny4xNEM1NS43ODUgNDcuMTQgNjAuMTQgNDIuNzg1IDYwLjE0IDM3LjQxMjhDNjAuMTQgMzIuMDQwNiA1NS43ODUgMjcuNjg1NSA1MC40MTI4IDI3LjY4NTVDNDUuMDQwNiAyNy42ODU1IDQwLjY4NTUgMzIuMDQwNiA0MC42ODU1IDM3LjQxMjhDNDAuNjg1NSA0Mi43ODUgNDUuMDQwNiA0Ny4xNCA1MC40MTI4IDQ3LjE0WiIgZmlsbD0id2hpdGUiLz48L3N2Zz4=" style="height:22px;"></a></p>

                </dd>
            </dl>

            <form-map v-bind:coords="{lat: {{$camera->lat}}, lng: {{$camera->lng}}}"></form-map>

        </div>

        <div class="pull-right">
            <form action="{{ route('cameras.destroy', $camera) }}" method="post">
                @method('DELETE')
                @csrf
                <input type="submit" class="btn btn-danger" onclick="return confirm('Удалить камеру?')" value="Удалить камеру">
            </form>
        </div>
    </div>
@endsection
