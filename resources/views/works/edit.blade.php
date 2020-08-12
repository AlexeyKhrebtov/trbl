@extends('layouts.app')

@section('content')
    <div class="container">
        <h4 class="mt-4 mb-5 text-center">Редактирование типа работ</h4>
        <form action="{{ route('works.update', ['work' => $work]) }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            <div class="row">
                @include('works.form')
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Сохранить тип работ</button>
                </div>
            </div>
        </form>
    </div>
@endsection
