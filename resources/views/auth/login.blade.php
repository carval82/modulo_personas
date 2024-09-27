@extends('layouts.app')

@section('content')

<section class="p-3 p-md-4 p-xl-5">
  <div class="container">
    <div class="card border-light-subtle shadow-sm">
      <div class="row g-0">
      <div class="col-12 col-md-6">
  <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" 
       loading="lazy" 
       src="{{ asset('img/imagen.jpg') }}" 
       alt="Imagen de fondo SENA">
</div>
        <div class="col-12 col-md-6">
          <div class="card-body p-3 p-md-4 p-xl-5 ">
            <div class="row">
              <div class="col-12">
                <div class="mb-5">
                  <h3>Iniciar sesión</h3>
                </div>
              </div>
            </div>
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="row gy-3 gy-md-4 overflow-hidden">
                <div class="col-12">
                  <label for="email" class="form-label">Correo electrónico <span class="text-danger">*</span></label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="col-12">
                  <label for="password" class="form-label">Contraseña <span class="text-danger">*</span></label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required autocomplete="current-password">
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label text-secondary" for="remember">
                      Mantener sesión iniciada
                    </label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="d-grid">
                    <button class="btn btn-primary btn-lg" type="submit">Iniciar sesión</button>
                  </div>
                </div>
              </div>
            </form>
            <div class="row">
              <div class="col-12">
                <hr class="mt-5 mb-4 border-secondary-subtle">
                <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end">
                  @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="link-secondary text-decoration-none">Crear nueva cuenta</a>
                  @endif
                  @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="link-secondary text-decoration-none">¿Olvidaste tu contraseña?</a>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection