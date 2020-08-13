<div class="col-md-6">
    <div class="form-group">
        <label for="sheet_id">ДВ</label>
        <select name="sheet_id" class="custom-select @error('sheet_id') is-invalid @enderror" id="sheet_id" required>
            <option value="" selected disabled>Выбрать</option>
            @foreach ($sheets as $sheet)
                <option value="{{ $sheet->id }}" {{ ($detail->sheet == $sheet) ? 'selected' : '' }}>{{ $sheet->number }}</option>
            @endforeach
        </select>
        @error('sheet_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
        <label for="equipment_id">Оборудование</label>
        <select name="equipment_id" class="custom-select @error('equipment_id') is-invalid @enderror" id="equipment_id" required>
            <option value="" selected disabled>Выбрать</option>
            @foreach ($equipments as $equipment)
                <option value="{{ $equipment->id }}" {{ ($detail->equipment == $equipment) ? 'selected' : '' }}>{{ $equipment->title }}</option>
            @endforeach
        </select>
        @error('equipment_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
        <label for="name">Название/модель/номер оборудования</label>
        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') ?? $detail->name }}" placeholder="камера №2.5.12" id="name" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
        <label for="work_id">Тип работы</label>
        <select name="work_id" class="custom-select @error('work_id') is-invalid @enderror" id="work_id" required>
            <option value="" selected disabled>Выбрать</option>
            @foreach ($works as $work)
                <option value="{{ $work->id }}" {{ ($detail->work == $work) ? 'selected' : '' }}>{{ $work->title }}</option>
            @endforeach
        </select>
        @error('work_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>


</div>
@csrf
