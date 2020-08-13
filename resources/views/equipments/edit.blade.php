@extends('layouts.app')

@section('content')
    <div class="container">
        <h4 class="mt-4 mb-5 text-center">Редактирование оборудования</h4>
        <form action="{{ route('equipments.update', ['equipment' => $equipment]) }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            <div class="row">
                @include('equipments.form')
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Сохранить оборудование</button>
                </div>
            </div>
        </form>
    </div>
@endsection
