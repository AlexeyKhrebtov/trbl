@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-6">
                <h4 class="mt-1">Дефектные ведомости</h4>
            </div>
            <div class="col-6">
                <a href="{{ route('sheets.create') }}" class="btn btn-light float-right"><i class="fa fa-plus text-success"></i> Добавить ДВ</a>
            </div>
        </div>
        
        <div class="row">
            <div class="col-6">
                <p>Показаны ведомости за <strong>{{ $year }}</strong> год.</p>
            </div>
            <div class="col-6">
                <div class="btn-group" role="group" aria-label="Basic example">
                @foreach ($year_list as $y)
                    <a href="/sheets?year={{ $y }}" class="btn @if ($y == $year) btn-primary @else btn-secondary @endif">{{ $y }}</a>
                @endforeach
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3 mb-4">
                <div class="list-group sticky-top" id="list-tab" role="tablist">
                    @foreach ($sectors as $sector)
                        <a class="list-group-item list-group-item-action @if ($loop->first) active @endif" id="list-sector_{{ $sector->id }}" data-toggle="list" href="#sector_{{ $sector->id }}" role="tab" aria-controls="home">{{ $sector->title }}</a>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-9">
                <div class="tab-content" id="nav-tabContent">
                    @foreach ($sectors as $sector)
                    <div class="tab-pane fade @if ($loop->first) show active @endif" id="sector_{{ $sector->id }}" role="tabpanel" aria-labelledby="list-sector_{{ $sector->id }}">
                        <h4>{{ $sector->title }}</h4>
                        <div class="table-responsive-sm">
                            <table class="table table-hover shadow-sm bg-white rounded">
                                <caption>{{ $sector->title }}</caption>
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">Номер ДВ</th>
                                    <th scope="col">Дата</th>
                                    <th scope="col">Статус</th>
                                    <th scope="col">Список наименований</th>
                                </tr>
                                </thead>
                                <tbody>
                            @foreach ($sheets as $sheet)
                                @if ($sheet->sector_id != $sector->id)
                                    @continue
                                @endif
                                <tr>
                                    <th scope="row"><a href="{{  route('sheets.show', $sheet) }}">{{ $sheet->number }}</a></th>
                                    <td>{{ \Carbon\Carbon::parse($sheet->date)->format('d.m.Y') }}</td>
                                    <td>{{ $sheet->status }}</td>
                                    <td>
                                        @if (count($sheet->details))
                                            <ul class="list-group list-group-flush">
                                            @foreach($sheet->details as $detail)
                                                <li class="list-group-item">{{ $detail->name }}</li>
                                            @endforeach
                                            </ul>
                                        @else
                                            <p class="bg-warning text-dark text-center mb-0">Оборудование не заполнено!</p>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
