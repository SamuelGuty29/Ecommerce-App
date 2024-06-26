<section class="row">

    <div class="mb-3 col-12">

        <div class="col-12 d-flex justify-content-center mt-1">
            <img src="/storage/images/users/default.jpg" alt="Imagen usuario"  class="img-thumbnail" width="170" height="170">
        </div>
        <div class="col-12 mt-1 ">
            <label for="file" class="form-label">Imagen</label>
            <input type="file" name="file" class="form-control @error ('file') is-invalid @enderror"
                id="file" accept="image/*">
            @error('file')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="mb-3 col-12">
        <label for="role">Role</label>

        <select id="role" type="number" name="role" class="form-control @error('role') is-invalid @enderror">
            @foreach ($roles as $role)
                <option value="{{ $role }}">{{ $role }}</option>
            @endforeach
        </select>

        @error('role')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="mb-3 col-6">
        <label for="number_id">Cedula</label>
        <input id="number_id" type="number" name="number_id"
            class="form-control @error('number_id') is-invalid @enderror"
            value="{{ old('number_id') ? old('number_id') : (isset($user) ? $user->number_id : '') }}" />
        @error('number_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="mb-3 col-6">
        <label for="name">Nombre</label>
        <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name') ? old('name') : (isset($user) ? $user->name : '') }}" />

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="mb-3 col-6">
        <label for="last_name">Apellido</label>
        <input id="last_name" type="text" name="last_name"
            class="form-control @error('last_name') is-invalid @enderror"
            value="{{ old('last_name') ? old('last_name') : (isset($user) ? $user->last_name : '') }}" />
        @error('last_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="mb-3 col-6">
        <label for="email">Correo electrónico</label>
        <input id="email" type="text" name="email" class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email') ? old('email') : (isset($user) ? $user->email : '') }}" />

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="mb-3 col-6">
        <label for="password">Contraseña</label>
        <input id="password" type="password" name="password"
            class="form-control @error('password') is-invalid @enderror" />

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="mb-3 col-6">
        <label for="password_confirmation">Confirmar Contraseña</label>
        <input id="password_confirmation" type="password" name="password_confirmation"
            class="form-control @error('password_confirmation') is-invalid @enderror" />

        @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-12">
        <a href="{{ route('users.index') }}" class="btn btn-secondary me-2">Cancelar</a>
        <button type="submit" class="btn btn-primary">Almacenar</button>
    </div>
</section>
