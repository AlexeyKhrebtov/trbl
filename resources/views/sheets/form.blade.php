<div class="container">
    <div class="form-row">
        <div class="form-group col-md-3 @if (\Route::current()->getName() == 'sheets.create' && !$errors->any())was-validated @endif">
            <label for="number">№ ДВ</label>
            <input type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ old('number') ?? $sheet->number }}" inputmode="numeric" placeholder="59515" id="number" maxlength="10" max="4294967294" required autofocus>
            @error('number')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group col-md-3">
            <label for="number">Дата</label>
            <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') ?? $sheet->date }}" inputmode="numeric" placeholder="59515" id="date" required>
            @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="sector_id">Участок</label>
            <select name="sector_id" class="custom-select @error('sector_id') is-invalid @enderror" id="sector_id" required>
                <option value="" selected disabled>Выбрать</option>
                @foreach ($sectors as $sector)
                    <option value="{{ $sector->id }}" {{ ($sheet->sector == $sector) ? 'selected' : '' }}>{{ $sector->title }}</option>
                @endforeach
            </select>
            @error('sector_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group col-md-3">
            <label for="status">Статус</label>
            <select name="status" class="custom-select @error('status') is-invalid @enderror" id="status" required>
                <option value="" selected disabled>Выбрать</option>
                @foreach ($status_options as $status_id => $status_name)
                    <option value="{{ $status_id }}" {{ ($sheet->status == $status_name) ? 'selected' : '' }}>{{ $status_name }}</option>
                @endforeach
            </select>
            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="info">Информация</label>
            <textarea name="info" class="form-control" id="info" rows="4">{{ $sheet->info }}</textarea>
        </div>
    </div>
</div>

@csrf
