@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Persona</h1>
    <form action="{{ route('personas.update', $persona->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="documento">Documento</label>
            <input type="text" class="form-control" id="documento" name="documento" value="{{ $persona->documento }}" required>
        </div>

        <div class="form-group">
            <label for="pnombre">Primer Nombre</label>
            <input type="text" class="form-control" id="pnombre" name="pnombre" value="{{ $persona->pnombre }}" required>
        </div>

        <div class="form-group">
            <label for="snombre">Segundo Nombre</label>
            <input type="text" class="form-control" id="snombre" name="snombre" value="{{ $persona->snombre }}">
        </div>

        <div class="form-group">
            <label for="papellido">Primer Apellido</label>
            <input type="text" class="form-control" id="papellido" name="papellido" value="{{ $persona->papellido }}" required>
        </div>

        <div class="form-group">
            <label for="sapellido">Segundo Apellido</label>
            <input type="text" class="form-control" id="sapellido" name="sapellido" value="{{ $persona->sapellido }}">
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $persona->telefono }}" required>
        </div>

        <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" class="form-control" id="correo" name="correo" value="{{ $persona->correo }}" required>
        </div>

        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $persona->direccion }}" required>
        </div>
        <div>
            
            <p>Rol actual de la persona: 
                {{ optional($persona->user)->role_id ? 
                   $roles->firstWhere('id', optional($persona->user)->role_id)->name ?? 'No encontrado' : 
                   'No asignado' }}
            </p>
        </div>

        <div class="form-group">
            <label for="rol_id">Rol</label>
            @if($canChangeRole)
                <select name="rol_id" id="rol_id" class="form-control">
                    @foreach($roles as $rol)
                        <option value="{{ $rol->id }}" {{ ($persona->user->role_id == $rol->id) ? 'selected' : '' }}>
                            {{ $rol->name }}
                        </option>
                    @endforeach
                </select>
            @else
                <input type="text" class="form-control" value="{{ $persona->user->role->name }}" readonly>
                <input type="hidden" name="rol_id" value="{{ $persona->user->role_id }}">
            @endif
        <div class="form-group">
            <label for="tipo_sangre_id">Tipo de Sangre</label>
            <select class="form-control" id="tipo_sangre_id" name="tipo_sangre_id" required>
                <option value="">Seleccione un tipo de sangre</option>
                @foreach($gruposSanguineos as $grupo)
                    <option value="{{ $grupo->id }}" {{ $persona->tipo_sangre_id == $grupo->id ? 'selected' : '' }}>
                        {{ $grupo->descripcion }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tipo_contrato_id">Tipo de Contrato</label>
            <select class="form-control" id="tipo_contrato_id" name="tipo_contrato_id" required>
                <option value="">Seleccione un tipo de contrato</option>
                @foreach($tiposContratos as $contrato)
                    <option value="{{ $contrato->id }}" {{ $persona->tipo_contrato_id == $contrato->id ? 'selected' : '' }}>
                        {{ $contrato->descripcion }}
                    </option>
                @endforeach
            </select>
        </div>
       

<div class="form-group">
        <input type="hidden" name="change_password" value="0">
        <label>
            <input type="checkbox" name="change_password" value="1" id="change_password"> Cambiar contraseña
        </label>
    </div>

    <div id="password_fields" style="display: none;">
        <div class="form-group">
            <label for="password">Nueva contraseña</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirmar nueva contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>
    </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <script>
    document.getElementById('change_password').addEventListener('change', function() {
        document.getElementById('password_fields').style.display = this.checked ? 'block' : 'none';
    });
</script>
    </form>
</div>
@endsection