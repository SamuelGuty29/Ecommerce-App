<section class="row">

    <div class="mb-3 col-6">
        <label for="name">Nombre</label>
        <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name') ? old('name') : (isset($category) ? $category->name : '') }}" />

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-12">
        <a href="{{ route('categories.index') }}" class="btn btn-secondary me-2">Cancelar</a>
        <button type="submit" class="btn btn-primary">Almacenar</button>
    </div>
</section>
