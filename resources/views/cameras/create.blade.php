@extends('layouts.app')

@section('content')
    <div class="container-lg">
        <h1>Добавить новую камеру</h1>
        <p class="lead">Добавление камеры к списку камер.</p>
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

        <form action="{{ route('cameras.store') }}" method="post" enctype="multipart/form-data">
            <div class="row">
                @include('cameras.form')
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Добавить камеру</button>
                </div>
            </div>
        </form>

    </div>
@endsection
