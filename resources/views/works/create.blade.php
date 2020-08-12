@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Добавить новый тип работ</h1>
        <p class="lead">Добавление типа работ для использования в ДВ.</p>
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

        <form action="{{ route('works.store') }}" method="post" enctype="multipart/form-data">
            <div class="row">
                @include('works.form')
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Добавить тип работ</button>
                </div>
            </div>
        </form>
    </div>
@endsection
