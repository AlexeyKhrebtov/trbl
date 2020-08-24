@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $sheet->number }}</h1>

        <div class="row mb-3">
            <div class="col-12 col-sm-4">
                <p class="lead">Дефектная ведомость</p>
            </div>
            <div class="col-6 col-sm-4">
                <a href="{{ route('sheets.index') }}" class="btn btn-outline-info mb-2 bg-white" role="button"><i class="fas fa-undo"></i> Вернуться к списку ДВ</a>
            </div>
            <div class="col-6 col-sm-4">
                <a href="{{ route('sheets.edit', $sheet->id) }}" class="btn btn-outline-dark mb-2"  role="button"><i class="fas fa-edit"></i> Редактировать ДВ</a>
            </div>
        </div>

        <div class="shadow-sm p-3 mb-5 bg-white rounded">
            <div class="row">
                <div class="col-md-4">
                    <dl class="row">
                        <dt class="col-sm-2">Номер</dt>
                        <dd class="col-sm-10">{{ $sheet->number }}</dd>
                        <dt class="col-sm-2">Дата</dt>
                        <dd class="col-sm-10">{{ \Carbon\Carbon::parse($sheet->date)->format('d.m.Y') }}</dd>
                        <dt class="col-sm-2">Участок</dt>
                        <dd class="col-sm-10"><a href="{{route('sectors.show', $sheet->sector_id)}}">{{ $sheet->sector->title }} &nbsp; <i class="fas fa-external-link-alt"></i></a></dd>
                        <dt class="col-sm-2">Статус</dt>
                        <dd class="col-sm-10">{{ $sheet->status }}</dd>
                    </dl>
                </div>
                <div class="col-md-8">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">№ПП</th>
                                    <th scope="col">Оборудование</th>
                                    <th scope="col">Модель</th>
                                    <th scope="col">Тип работ</th>
                                    <th scope="col">Примечание</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($sheet->details as $detail)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $detail->equipment->title }}</td>
                                    <td><strong>{{ $detail->name }}</strong></td>
                                    <td>{{ $detail->work->title }}</td>
                                    <td>{!! nl2br(e($detail->comment)) !!}</td>
                                    <td class=""><a href="{{ route('details.edit', $detail) }}">edit</a></td>
                                </tr>
                            @empty
                                <p>Нет оборудования в ДВ</p>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <h3>Добавить оборудование в ДВ</h3>
        <div class="shadow-sm p-3 mb-5 bg-white rounded">
            <form action="{{ route('details.store') }}" method="post" enctype="multipart/form-data" class="form-inline justify-content-center">
                <input type="hidden" name="sheet_id" value="{{ $sheet->id }}">

                <label class="sr-only" for="equipment_id">Оборудование</label>
                <select name="equipment_id" class="custom-select mb-2 mr-sm-2" id="equipment_id" required>
                    <option value="" selected disabled>Выбрать оборудование</option>
                    @foreach ($equipments as $equipment)
                        <option value="{{ $equipment->id }}">{{ $equipment->title }}</option>
                    @endforeach
                </select>

                <div class="was-validated p-0">
                    <label class="sr-only" for="inlineFormInputName2">Модель</label>
                    <input type="text" name="name" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="модель, камера №2.5.12" required>
                </div>

                <label class="sr-only" for="equipment_id">Тип работы</label>
                <select name="work_id" class="custom-select mb-2 mr-sm-2" id="equipment_id" required>
                    <option value="" selected disabled>Выбрать тип работы</option>
                    @foreach ($works as $work)
                        <option value="{{ $work->id }}">{{ $work->title }}</option>
                    @endforeach
                </select>

                <label class="sr-only" for="comment">Примечание</label>
                <textarea name="comment" id="comment" cols="30" rows="2" placeholder="Примечание" class="form-control mb-2 mr-sm-2"></textarea>

                @csrf

                <button type="submit" class="btn btn-success mb-2">
                    <i class="fa fa-plus text-light mr-1"></i>
                    Добавить
                </button>
            </form>
        </div>

    </div>
@endsection
