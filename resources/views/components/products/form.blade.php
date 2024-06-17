<section class="row">

    <div class="mb-3 col-6">
        <label for="name">Nombre</label>
        <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name') ? old('name') : (isset($product) ? $product->name : '') }}" />

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="mb-3 col-6">
        <label for="description">Descripción</label>
        <input id="descriptinn" type="text" name="description"
            class="form-control @error('description') is-invalid @enderror"
            value="{{ old('description') ? old('description') : (isset($product) ? $product->description : '') }}" />
        @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="mb-3 col-6">
        <label for="price">Precio</label>
        <input id="price" type="number" name="price" class="form-control @error('price') is-invalid @enderror"
            value="{{ old('price') ? old('price') : (isset($product) ? $product->price : '') }}" />

        @error('price')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="mb-3 col-6">
        <label for="stock">Stock</label>
        <input id="stock" type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
            value="{{ old('stock') ? old('stock') : (isset($product) ? $product->stock : '') }}" />

        @error('stock')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="mb-3 col-6">
        <label for="category_id">Categoria</label>
        <input id="category" type="number" name="category_id"
            class="form-control @error('category_id') is-invalid @enderror"
            value="{{ old('category_id') ? old('category_id') : (isset($product) ? $product->category_id : '') }}" />

        @error('category_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-12">
        <a href="{{ route('products.index') }}" class="btn btn-secondary me-2">Cancelar</a>
        <button type="submit" class="btn btn-primary">Almacenar</button>
    </div>
</section>
