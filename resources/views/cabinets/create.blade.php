@extends('layouts.app')

@section('content')
    <div class="container-lg">

        <h1>Добавить новый шкаф</h1>
        <p class="lead">Добавление шкафа к списку шкафов.</p>
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

        <form action="{{ route('cabinets.store') }}" method="post" enctype="multipart/form-data">
            <div class="row">
                @include('cabinets.form')
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Добавить шкаф</button>
                </div>
            </div>
        </form>

    </div>
@endsection
