@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-6">
                <h4 class="mt-1">Список камер</h4>
            </div>
            <div class="col-6">
                <a href="{{ route('cameras.create') }}" class="btn btn-light float-right"><i class="fa fa-plus text-success"></i> Добавить камеру</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <cameras-index-page :cameras='@json($cameras)'></cameras-index-page>
    </div>
@endsection
