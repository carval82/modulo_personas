@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Persona</h2>
    <form method="POST" action="{{ route('personas.update', $persona->id) }}">
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

        <div class="form-group">
            <label for="rol_id">Rol</label>
            <select class="form-control" id="rol_id" name="rol_id" required>
            @foreach($roles as $rol)
        @if(is_object($rol))
        <option value="{{ $rol->id }}" {{ optional($persona)->rol_id == $rol->id ? 'selected' : '' }}>
            {{ $rol->descripcion }}
        </option>
    @endif
@endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tipo_sangre_id">Tipo de Sangre</label>
            <select class="form-control" id="tipo_sangre_id" name="tipo_sangre_id" required>
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
    @if(is_array($tiposContratos) || is_object($tiposContratos))
        @foreach($tiposContratos as $contrato)
            @php
                $contratoId = is_object($contrato) ? $contrato->id : ($contrato['id'] ?? null);
                $contratoDescripcion = is_object($contrato) ? $contrato->descripcion : ($contrato['descripcion'] ?? '');
            @endphp
            <option value="{{ $contratoId }}" {{ $persona->tipo_contrato_id == $contratoId ? 'selected' : '' }}>
                {{ $contratoDescripcion }}
            </option>
        @endforeach
    @else
        <option value="">No hay tipos de contrato disponibles</option>
    @endif
    </select>
</div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection