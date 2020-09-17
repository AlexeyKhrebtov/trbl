@extends('layouts.app')

@section('content')
    <div class="container">
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

        <form action="{{ route('sectors.update', ['sector' => $sector]) }}" method="post" enctype="multipart/form-data" class="row">
            @method('PATCH')

            @include('sectors.form')

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Сохранить ОПО</button>
            </div>
        </form>
    </div>
@endsection
