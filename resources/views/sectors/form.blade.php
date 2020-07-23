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

@csrf
