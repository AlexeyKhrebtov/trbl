@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-6">
                <h4 class="mt-1">Список ОПО</h4>
            </div>
            <div class="col-6">
                <a href="{{ route('sectors.create') }}" class="btn btn-light float-right"><i class="fa fa-plus text-success"></i> Добавить ОПО</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="list-group">
                @foreach ($sectors as $sector)
                    <a href="{{ route('sectors.show', $sector->id ) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $sector->title }}</h5>
                            <small>#{{ $sector->id }}</small>
                        </div>
                        @if(!empty($sector->comment))
                            <p class="mb-1 alert alert-info">{{ $sector->comment }}</p>
                        @endif
                        <small>Шкафов: {{ $sector->cabinets_count }}</small>
                    </a>
                @endforeach
                </div>
            </div>
            <div class="col-lg-4">
                <!-- пустая колонка -->
            </div>
        </div>

    </div>
@endsection
