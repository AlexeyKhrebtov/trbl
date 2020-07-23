@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $sector->title }}</h1>

        <div class="row">
            <div class="col-sm-4">
                <p class="lead">ОПО</p>
            </div>
            <div class="col-sm-4">
                <a href="{{ route('sectors.index') }}" class="btn btn-outline-info mb-2" role="button"><i class="fas fa-undo"></i> Вернуться к списку ОПО</a>
            </div>
            <div class="col-sm-4">
                <a href="{{ route('sectors.edit', $sector->id) }}" class="btn btn-outline-dark mb-2"  role="button"><i class="fas fa-edit"></i> Редактировать ОПО</a>
            </div>
        </div>

        <div class="shadow-sm p-3 mb-5 bg-white rounded">
            <dl class="row">
                <dt class="col-sm-3">Комментарий</dt>
                <dd class="col-sm-9">{!! nl2br(e($sector->comment)) !!}</dd>
            </dl>
        </div>

        <h2>Шкафы <i class="fas fa-inbox"></i></h2>

        <div class="list-group mb-5">
            @forelse ($sector->cabinets as $cabinet)
                <a href="{{ route('cabinets.show', $cabinet->id) }}" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $cabinet->title }}</h5>
                        <small class="text-muted">{{ $cabinet->location_km }} км, {{ $cabinet->location_piket }} пикет</small>
                    </div>
                    <p class="mb-1">{{ $cabinet->comment }}</p>
                    <small class="text-muted">#{{ $cabinet->id }}</small>
                </a>
            @empty
                <p>нет привязанных шкафов</p>
            @endforelse
        </div>

        <div class="pull-right">
            <a href="#" class="btn btn-danger disabled">Удалить ОПО</a>
        </div>
    </div>
@endsection
