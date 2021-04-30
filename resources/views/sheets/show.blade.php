@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>{{ $sheet->number }}</h1>

        <div class="row mb-3">
            <div class="col-12 col-sm-4">
                <p class="lead">Дефектная ведомость</p>
            </div>
            <div class="col-6 col-sm-4">
                <a href="{{ route('sheets.index') }}" class="btn btn-outline-info mb-2 bg-white" role="button">
                    <i class="fas fa-undo"></i> Вернуться к списку ДВ
                </a>
            </div>
            <div class="col-6 col-sm-4">
                <a href="{{ route('sheets.edit', $sheet->id) }}" class="btn btn-outline-dark mb-2"  role="button"><i class="fas fa-edit"></i>  Редактировать ДВ</a>
            </div>
        </div>

        <div class="shadow-sm p-3 mb-5 bg-white rounded">
            <div class="row">
                <div class="col-md-4">
                    <dl class="row">
                        <dt class="col-3">Номер</dt>
                        <dd class="col-9">{{ $sheet->number }}</dd>
                        <dt class="col-3">Дата</dt>
                        <dd class="col-9">{{ \Carbon\Carbon::parse($sheet->date)->format('d.m.Y') }}</dd>
                        <dt class="col-3">Участок</dt>
                        <dd class="col-9"><a href="{{route('sectors.show', $sheet->sector_id)}}">{{ $sheet->sector->title }} &nbsp; <i class="fas fa-external-link-alt"></i></a></dd>
                        <dt class="col-3">Статус</dt>
                        <dd class="col-9">{{ $sheet->status }}</dd>
                    </dl>
                    <p class="mt-2">
                        <a href="{{ route('export', $sheet) }}" target="_blank">
                            <i class="fas fa-file-excel"></i>
                            экспорт в Excel
                        </a>
                    </p>
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

        <div class="row">
            <div class="col">
                @if (count($errors) > 0)
                    <div class = "alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        <h3>Прикрепленные документы</h3>
        <div class="shadow-sm p-3 mb-5 bg-white rounded">
            @if ($sheet->attachments)
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-3">
                    @foreach ($sheet->attachments as $attach)
                        <div class="col mb-4">
                            <div class="card sheets-attach">
                                {{-- иконки тут https://freeicons.io/icon-list/vector-file-types-icons --}}
                                <a href="{{ $attach->link }}" target="_blank" class="text-center">
                                @if ($attach->ext == 'pdf')
                                    <img src="{{ asset('images/icons/pdf.svg') }}" alt="{{ $attach->filename }}" class="card-img-top w-50">
                                @else
                                    <img src="{{ $attach->link }}" alt="{{ $attach->filename }}" loading="lazy" class="card-img-top img-thumbnail-">
                                @endif
                                </a>
                                <div class="card-body">
                                    <h4 class="card-title">{{ $attach->filename }}</h4>
                                    <h6 class="card-subtitle mb-2 text-muted">
                                        @if ($attach->ext == 'pdf')
                                            <i class="fa fa-file-pdf"></i>
                                        @elseif ($attach->ext == 'png' || $attach->ext == 'jpeg' || $attach->ext == 'jpg')
                                            <i class="fa fa-file-image"></i>
                                        @endif
                                        {{ $attach->ext }}, {{ $attach->sizeForHuman }}
                                    </h6>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ $attach->link }}" class="card-link" target="_blank">Открыть</a>
                                        <form action="{{ route('sheets.attach.remove', [$sheet->id, $attach->id]) }}"
                                              method="post"
                                              onSubmit="if(!confirm('Вы действительно хотите безвозвратно удалить этот файл?')){return false;}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="card-link btn btn-danger btn-sm rounded-sm" type="submit" data-toggle="tooltip" data-placement="top" title="Удалить"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-footer text-muted text-center">
                                    <span data-toggle="tooltip" data-placement="top" title="{{ $attach->created_at }}">Загружен {{ $attach->howLong }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <hr>

            <form action="{{ route('sheets.attach', $sheet->id) }}" method="post" enctype="multipart/form-data" class="form-inline mb-3">
                @csrf
                <div class="form-group mr-3 mb-0">
                    <label for="customFile" class="lead">Прикрепить файл</label>
                </div>
                <div class="form-group mx-3 my-sm-3 pt-3">
                    <div class="custom-file">
                        <input type="file" name="attach" required accept="image/*,application/pdf" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile" data-browse="Выбрать файл">Выбрать файл</label>
                    </div>
                    <small class="form-text text-muted">jpeg, pdf (max: 8mb)</small>
                </div>

                <button type="submit" class="btn btn-success mb-2">
                    <i class="fa fa-file-upload text-light mr-1"></i>
                    Загрузить
                </button>
            </form>
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
