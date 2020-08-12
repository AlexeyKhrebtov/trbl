@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1 class="mt-1">ДВ</h1>
            </div>
            <div class="col-6">
                <a href="{{ route('sheets.create') }}" class="btn btn-light float-right"><i class="fa fa-plus text-success"></i> Добавить ДВ</a>
            </div>
        </div>
    </div>

    <div class="container">
        <ul>
            @forelse ($sheets as $sheet)
                <li>
                    {{ $sheet->number }}
                    <a href="{{ route('sheets.show', $sheet) }}">show</a>
                    <a href="{{ route('sheets.edit', $sheet) }}">edit</a>
                </li>
            @empty
                <p>Нет ДВ</p>
            @endforelse
        </ul>
    </div>
@endsection
