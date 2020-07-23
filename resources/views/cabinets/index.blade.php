@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-6">
                <h4 class="mt-1">Список шкафов</h4>
            </div>
            <div class="col-6">
                <a href="{{ route('cabinets.create') }}" class="btn btn-light float-right"><i class="fa fa-plus text-success"></i> Добавить шкаф</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 mb-4">
                <cabinets-list :cabinets='@json($cabinets)'></cabinets-list>
            </div>
            <div class="col-md-8">
                <cabinet-index-map :cabinets='@json($cabinets)'></cabinet-index-map>
            </div>
        </div>

    </div>
@endsection
