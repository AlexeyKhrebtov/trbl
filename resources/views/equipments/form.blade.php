<div class="col-md-6">
    <div class="form-group">
        <label for="title">Название оборудования</label>
        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ old('title') ?? $equipment->title }}" placeholder="Видеокамеры купольные поворотные" id="title" required>
        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
@csrf
