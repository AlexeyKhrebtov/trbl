@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Добавить новое оборудование</h1>
        <p class="lead">Добавление оборудования для использования в ДВ.</p>
        <hr>

        @if ($errors->any())
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger">
                        Ошибки при валидации формы. Проверьте данные.
                        @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('equipments.store') }}" method="post" enctype="multipart/form-data">
            <div class="row">
                @include('equipments.form')
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Добавить оборудование</button>
                </div>
            </div>
        </form>
    </div>
@endsection
