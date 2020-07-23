<div class="col-md-6">
    <div class="form-group">
        <label for="title">Номер шкафа</label>
        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ old('title') ?? $cabinet->title }}" placeholder="2.5.12" id="title">
        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <fieldset class="border p-2 bg-white mb-2">
        <legend  class="w-auto">Местоположение.</legend>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="location_km">Километр</label>
                <input class="form-control @error('location_km') is-invalid @enderror" type="number" name="location_km" value="{{ old('location_km') ?? $cabinet->location_km }}" placeholder="38" min="0" max="250" id="location_km">
                @error('location_km')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group col-md-6">
                <label for="location_piket">Пикет</label>
                <input class="form-control @error('location_piket') is-invalid @enderror" type="number" name="location_piket" value="{{ old('location_piket') ?? $cabinet->location_piket }}" min="0" max="9" placeholder="3 пк" id="location_piket">
                @error('location_piket')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-group">
            <label for="sector_id">ОПО (участок)</label>
            <select name="sector_id" class="custom-select @error('sector') is-invalid @enderror" id="sector_id">
                <option value="" selected disabled>Выбрать</option>
                @foreach ($sectors as $sector)
                    <option value="{{ $sector->id }}" {{ ($cabinet->sector == $sector) ? 'selected' : '' }}>{{ $sector->title }}</option>
                @endforeach
            </select>
            @error('sector_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </fieldset>

    <div class="form-group">
        <label for="comment">Комментарий</label>
        <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" rows="5" name="comment">{{ old('comment') ?? $cabinet->comment }}</textarea>
        @error('comment')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <form-map v-bind:coords="{lat: {{$cabinet->lat ?? 59.749311}}, lng: {{$cabinet->lng ?? 30.615230}}}" candragmarker></form-map>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="lat">Широта (lat)</label>
            <input class="form-control @error('lat') is-invalid @enderror" type="text" name="lat" value="{{ old('lat') ?? $cabinet->lat }}" placeholder="" min="0" max="250" id="lat" readonly>
            @error('location_km')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group col-md-6">
            <label for="lng">Долгота (lng)</label>
            <input class="form-control @error('lng') is-invalid @enderror" type="text" name="lng" value="{{ old('lng') ?? $cabinet->lng }}" placeholder="" id="lng" readonly>
            @error('lng')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

@csrf
