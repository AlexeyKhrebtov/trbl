@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $sheet->number }}</h1>

        <div class="row">
            <div class="col-sm-4">
                <p class="lead">Дефектная ведомость</p>
            </div>
            <div class="col-sm-4">
                <a href="{{ route('sheets.index') }}" class="btn btn-outline-info mb-2" role="button"><i class="fas fa-undo"></i> Вернуться к списку ДВ</a>
            </div>
            <div class="col-sm-4">
                <a href="{{ route('sheets.edit', $sheet->id) }}" class="btn btn-outline-dark mb-2"  role="button"><i class="fas fa-edit"></i> Редактировать ДВ</a>
            </div>
        </div>

        <div class="shadow-sm p-3 mb-5 bg-white rounded">
            <dl class="row">
                <dt class="col-sm-1">Номер</dt>
                <dd class="col-sm-11">{{ $sheet->number }}</dd>
                <dt class="col-sm-1">Дата</dt>
                <dd class="col-sm-11">{{ $sheet->date }}</dd>
                <dt class="col-sm-1">Участок</dt>
                <dd class="col-sm-11"><a href="{{route('sectors.show', $sheet->sector_id)}}">{{ $sheet->sector->title }} &nbsp; <i class="fas fa-external-link-alt"></i></a></dd>
                <dt class="col-sm-1">Статус</dt>
                <dd class="col-sm-11">{{ $sheet->status }}</dd>
            </dl>
        </div>
    </div>
@endsection
