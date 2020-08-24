@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-6">
                <h4 class="mt-1">Оборудование</h4>
            </div>
            <div class="col-6">
                <a href="{{ route('equipments.create') }}" class="btn btn-light float-right"><i class="fa fa-plus text-success"></i> Добавить оборудование</a>
            </div>
        </div>
    </div>
    <div class="container">
        <ul>
            @forelse ($equipments as $equipment)
                <li>{{ $equipment->title }} <a href="{{ route('equipments.edit', $equipment) }}">edit</a></li>
            @empty
                <p>Нет оборудования</p>
            @endforelse
        </ul>
    </div>
@endsection
