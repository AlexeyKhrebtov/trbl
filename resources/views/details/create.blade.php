@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Добавить позицию в ДВ</h1>
        <p class="lead">Оборудоване.</p>
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

        <form action="{{ route('details.store') }}" method="post" enctype="multipart/form-data">
            <div class="row">
                @include('details.form')
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Добавить позицию в ДВ</button>
                </div>
            </div>
        </form>
    </div>
@endsection
