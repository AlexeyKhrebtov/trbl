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

        <div class="row">
            <div class="col-lg-6">
                <form action="{{ route('sectors.update', ['sector' => $sector]) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')

                    @include('sectors.form')

                    <button type="submit" class="btn btn-primary">Сохранить ОПО</button>

                </form>
            </div>
        </div>
    </div>
@endsection
