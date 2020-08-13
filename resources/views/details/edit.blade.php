@extends('layouts.app')

@section('content')
    <div class="container-lg">
        <h4 class="mt-4 mb-5 text-center">Редактирование оборудования в ДВ</h4>
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
@endsection
