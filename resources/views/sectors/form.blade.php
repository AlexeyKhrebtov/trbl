<div class="col-lg-6">
    <div class="form-group">
        <label for="title">Название опорного пункта</label>
        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ old('title') ?? $sector->title }}" placeholder="Обухово" id="title" required>
        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
        <label for="comment">Комментарий</label>
        <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" rows="5">{{ old('comment') ?? $sector->comment }}</textarea>
        @error('comment')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>

<div class="col-lg-6 mb-4">
    <fieldset class="bg-white shadow-sm p-3">
        <legend>Данные для экспорта</legend>

        <div class="form-group">
            <label for="inventory_number">Инвентарный номер</label>
            <input class="form-control @error('inventory_number') is-invalid @enderror" type="text" name="inventory_number" value="{{ old('inventory_number') ?? $sector->inventory_number }}" placeholder="046138" id="inventory_number" maxlength="20">
            @error('inventory_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="object_location">Местонахождение объекта</label>
            <input class="form-control @error('object_location') is-invalid @enderror" type="text" name="object_location" value="{{ old('object_location') ?? $sector->object_location }}" placeholder="Скоростной участок магистрали Санкт-Петербург - Москва 63-85 км ОПО Рябово" id="object_location">
            @error('object_location')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="region">Регион</label>
            <input class="form-control @error('region') is-invalid @enderror" type="text" name="region" value="{{ old('region') ?? $sector->region }}" placeholder="Ленинградская обл." id="region">
            @error('region')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="route_part">ПЧ</label>
                <input class="form-control @error('route_part') is-invalid @enderror" type="text" name="route_part" value="{{ old('route_part') ?? $sector->route_part }}" placeholder="ПЧГ-10" id="route_part">
                @error('route_part')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group col-md-6">
                <label for="fio">ФИО</label>
                <input class="form-control @error('fio') is-invalid @enderror" type="text" name="fio" value="{{ old('fio') ?? $sector->fio }}" placeholder="Атамурадов А.Ю." id="fio">
                @error('fio')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </fieldset>
</div>

@csrf
