@extends('layouts.app')

@section('content')
    <div class="container-lg">
        <h4 class="mt-4 mb-5 text-center">Редактирование шкафа</h4>
        <form action="{{ route('cabinets.update', ['cabinet' => $cabinet]) }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            <div class="row">
                @include('cabinets.form')
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Сохранить шкаф</button>
                </div>
            </div>
        </form>
    </div>
@endsection
