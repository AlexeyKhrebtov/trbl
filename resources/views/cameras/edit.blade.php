@extends('layouts.app')

@section('content')
    <div class="container-lg">
        <h4 class="mt-4 mb-5 text-center">Редактирование камеры</h4>
        <form action="{{ route('cameras.update', ['camera' => $camera]) }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            <div class="row">
                @include('cameras.form')
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Сохранить камеру</button>
                </div>
            </div>
        </form>
    </div>
@endsection
