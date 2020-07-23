<div class="col-md-6">
    <div class="form-group">
        <label for="title">Номер камеры</label>
        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ old('title') ?? $camera->title }}" placeholder="камера №2.5.12" id="title" required>
        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <fieldset class="border p-2 bg-white">
        <legend  class="w-auto">Местоположение.</legend>
        <div class="form-row">
            <div class="form-group col-6">
                <label for="location_km">Километр</label>
                <input class="form-control @error('location_km') is-invalid @enderror" type="number" name="location_km" value="{{ old('location_km') ?? $camera->location_km }}" placeholder="38" min="0" max="250" id="location_km">
                @error('location_km')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group col-6">
                <label for="location_piket">Пикет</label>
                <input class="form-control @error('location_piket') is-invalid @enderror" type="number" min="0" max="9" name="location_piket" value="{{ old('location_piket') ?? $camera->location_piket }}" placeholder="3 пк" id="location_piket">
                @error('location_piket')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-group">
            <label for="cabinet_id">Шкаф</label>
            <select name="cabinet_id" class="custom-select @error('cabinet') is-invalid @enderror" id="cabinet_id">
                <option value="" selected disabled>Выбрать</option>
                @foreach ($cabinets as $cabinet)
                    <option value="{{ $cabinet->id }}" {{ ($camera->cabinet == $cabinet) ? 'selected' : '' }}>{{ $cabinet->title }}</option>
                @endforeach
            </select>
            @error('cabinet_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </fieldset>


    <fieldset class="border p-2 bg-white">
        <legend  class="w-auto">Доступы</legend>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="ip">IP</label><input type="text" id="ip" name="ip" pattern="^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$" placeholder="127.0.0.1" value="{{ old('ip') ?? $camera->ip }}" class="form-control @error('ip') is-invalid @enderror">
            </div>
            <div class="form-group col-md-4">
                <label for="login">Login</label><input type="text" id="login" name="login" value="{{ old('login') ?? $camera->login }}" class="form-control @error('login') is-invalid @enderror">
            </div>
            <div class="form-group col-md-4">
                <label for="password">Password</label><input type="text" id="password" name="password" value="{{ old('password') ?? $camera->password }}" class="form-control @error('password') is-invalid @enderror">
            </div>
        </div>
    </fieldset>

    <div class="form-group mt-2">
        <label for="comment">Комментарий</label>
        <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" rows="5">{{ old('comment') ?? $camera->comment }}</textarea>
        @error('comment')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <form-map
            v-bind:coords="{lat: {{$camera->lat ?? 59.749311}}, lng: {{$camera->lng ?? 30.615230}}}" candragmarker></form-map>
    </div>

    <div class="form-row">
        <div class="form-group col-6">
            <label for="lat">Широта (lat)</label>
            <input class="form-control @error('lat') is-invalid @enderror" type="text" name="lat" value="{{ old('lat') ?? $camera->lat }}" placeholder="" min="0" max="250" id="lat" readonly>
            @error('location_km')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group col-6">
            <label for="lng">Долгота (lng)</label>
            <input class="form-control @error('lng') is-invalid @enderror" type="text" name="lng" value="{{ old('lng') ?? $camera->lng }}" placeholder="" id="lng" readonly>
            @error('lng')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>
@csrf
