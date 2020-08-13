@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1 class="mt-1">ДВ</h1>
            </div>
            <div class="col-6">
                <a href="{{ route('sheets.create') }}" class="btn btn-light float-right"><i class="fa fa-plus text-success"></i> Добавить ДВ</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="list-group">
                    @foreach ($sheets as $sheet)
                        <a href="{{  route('sheets.show', $sheet) }}" class="list-group-item list-group-item-warning list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $sheet->number }}</h5>
                                <small>#{{ $sheet->id }}</small>
                            </div>
                            <p class="mb-1">от {{ $sheet->date }} - {{ $sheet->status }}</p>
                            <small>Наименований: {{ $sheet->details_count }}</small>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
