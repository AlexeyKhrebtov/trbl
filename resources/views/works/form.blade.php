<div class="col-md-6">
    <div class="form-group">
        <label for="title">Название типа работ</label>
        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ old('title') ?? $work->title }}" placeholder="Замена изделия" id="title" required>
        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
@csrf
