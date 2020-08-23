@extends('layouts.app')

@section('content')
    <div class="container-lg">
        <h4 class="mt-4 mb-5 text-center">Редактирование оборудования в ДВ</h4>
        <div class="row">
            <div class="col-sm">
                <form action="{{ route('details.update', $detail) }}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    <div class="row">
                        @include('details.form')
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Сохранить позицию в ДВ</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm mt-4 mt-sm-0">
                <form action="{{ route('details.destroy', $detail) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <fieldset class="border p-2 bg-white">
                        <legend  class="w-auto">
                            <i class="fas fa-exclamation-triangle fa-lg text-danger"></i>
                        </legend>
                        <div class="text-center">
                            <input type="submit" class="btn btn-danger" onclick="return confirm('Удалить оборудование?')" value="Удалить оборудование из ДВ">
                        </div>
                    </fieldset>

                </form>
            </div>
        </div>
    </div>
@endsection
