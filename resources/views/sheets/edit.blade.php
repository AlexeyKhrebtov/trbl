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
            <div class="col">
                <form action="{{ route('sheets.update', ['sheet' => $sheet]) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')

                    @include('sheets.form')

                    <button type="submit" class="btn btn-primary">Сохранить ДВ</button>

                </form>
            </div>
        </div>
    </div>
@endsection
