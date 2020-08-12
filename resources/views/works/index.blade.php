@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1 class="mt-1">Типы работ</h1>
            </div>
            <div class="col-6">
                <a href="{{ route('works.create') }}" class="btn btn-light float-right"><i class="fa fa-plus text-success"></i> Добавить тип работ</a>
            </div>
        </div>
    </div>
    <div class="container">
        <ul>
            @forelse ($works as $work)
                <li>{{ $work->title }} <a href="{{ route('works.edit', $work) }}">edit</a></li>
            @empty
                <p>Нет типов работ</p>
            @endforelse
        </ul>
    </div>
@endsection
