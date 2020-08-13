@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md">
            <div class="card shadow">
                <img src="https://images.unsplash.com/photo-1495714096525-285e85481946?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=300&h=200&q=40" class="card-img" alt="Камеры">
                <div class="card-img-overlay">
                    <h1 class="card-title display-5 text-light bg-dark">КАМЕРЫ</h1>
                    <p class="card-text"></p>
                    <a href="{{ route('cameras.index') }}" class="btn btn-light stretched-link">Перейти</a>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card shadow">
                <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=300&h=200&q=40" class="card-img" alt="Шкафы">
                <div class="card-img-overlay">
                    <h1 class="card-title display-5 text-light bg-dark">ШКАФЫ</h1>
                    <p class="card-text"></p>
                    <a href="{{ route('cabinets.index') }}" class="btn btn-light stretched-link">Перейти</a>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card shadow">
                <img src="https://images.unsplash.com/photo-1434871619871-1f315a50efba?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=300&h=200&q=40" class="card-img" alt="OПO">
                <div class="card-img-overlay">
                    <h1 class="card-title display-5 text-light bg-dark">OПO</h1>
                    <p class="card-text"></p>
                    <a href="{{ route('sectors.index') }}" class="btn btn-light stretched-link">Перейти</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md">
            <div class="card shadow">
                <img src="https://images.unsplash.com/photo-1529078155058-5d716f45d604?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=350&h=240&q=50" class="card-img" alt="OПO">
                <div class="card-img-overlay">
                    <h1 class="card-title display-5 text-light bg-dark">Сводная таблица</h1>
                    <p class="card-text"></p>
                    <a href="{{ route('summaries') }}" class="btn btn-light stretched-link">Перейти</a>
                </div>
            </div>
        </div>
        <div class="col-md"></div>
        <div class="col-md">
            <div class="card shadow">
                <img src="https://images.unsplash.com/photo-1568124924590-969ea0925fcc?auto=format&fit=crop&h=240&w=350&q=50&crop=entropy" class="card-img" alt="OПO">
                <div class="card-img-overlay">
                    <h1 class="card-title display-5 text-light bg-dark">ДВ</h1>
                    <p class="card-text"></p>
                    <a href="{{ route('sheets.index') }}" class="btn btn-light stretched-link">Перейти</a>
                </div>
            </div>
        </div>

{{--        <div class="col-md"></div>--}}
    </div>

</div>
@endsection
