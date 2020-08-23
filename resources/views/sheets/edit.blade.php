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
            <div class="row">
                <div class="col-sm-6 mt-5 mt-sm-5">
                    <form action="{{ route('sheets.destroy', $sheet) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <fieldset class="border p-2 bg-white">
                            <legend  class="w-auto">
                                <i class="fas fa-exclamation-triangle fa-lg text-danger"></i>
                            </legend>
                            <div class="text-center">
                                <input type="submit" class="btn btn-danger" onclick="return confirm('Удалить ДВ со всеми данными?')" value="Удалить ДВ">
                            </div>
                        </fieldset>

                    </form>
                </div>
            </div>

    </div>
@endsection
