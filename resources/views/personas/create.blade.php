@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Persona</h2>
    <form action="{{ route('personas.store') }}" method="POST">
        @csrf 

        <div class="form-group">
            <label for="documento">Documento</label>
            <input type="text" class="form-control" name="documento" id="documento" placeholder="Documento" value="{{ old('documento') }}" required>
            @error('documento')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="pnombre">Primer Nombre</label>
            <input type="text" class="form-control" name="pnombre" id="pnombre" placeholder="Primer Nombre" value="{{ old('pnombre') }}" required>
            @error('pnombre')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="snombre">Segundo Nombre</label>
            <input type="text" class="form-control" name="snombre" id="snombre" placeholder="Segundo Nombre" value="{{ old('snombre') }}">
            @error('snombre')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="papellido">Primer Apellido</label>
            <input type="text" class="form-control" name="papellido" id="papellido" placeholder="Primer Apellido" value="{{ old('papellido') }}" required>
            @error('papellido')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="sapellido">Segundo Apellido</label>
            <input type="text" class="form-control" name="sapellido" id="sapellido" placeholder="Segundo Apellido" value="{{ old('sapellido') }}">
            @error('sapellido')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" value="{{ old('telefono') }}" required>
            @error('telefono')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo" value="{{ old('correo') }}" required>
            @error('correo')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección" value="{{ old('direccion') }}" required>
            @error('direccion')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Rol</label>
            <div>
                @foreach(['Coordinador' => 1,  'Instructor' => 2, 'Aprendiz' => 3] as $rol => $value)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rol_id" id="rol_{{ $value }}" value="{{ $value }}" {{ old('rol_id') == $value ? 'checked' : '' }} required>
                        <label class="form-check-label" for="rol_{{ $value }}">{{ $rol }}</label>
                    </div>
                @endforeach
            </div>
            @error('rol_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Grupo Sanguíneo</label>
            <div>
                @foreach(['A+' => 1, 'A-' => 2, 'B+' => 3, 'B-' => 4, 'AB+' => 5, 'AB-' => 6, 'O+' => 7, 'O-' => 8] as $tipo => $value)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tipo_sangre_id" id="tipo_sangre_{{ $value }}" value="{{ $value }}" {{ old('tipo_sangre_id') == $value ? 'checked' : '' }} required>
                        <label class="form-check-label" for="tipo_sangre_{{ $value }}">{{ $tipo }}</label>
                    </div>
                @endforeach
            </div>
            @error('tipo_sangre_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label>Tipo de Contrato</label>
            <div>
                @foreach(['Vinculado' => 1, 'Contratista' => 2] as $tipo => $value)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tipo_contrato_id" id="contrato_{{ $value }}" value="{{ $value }}" {{ old('tipo_contrato_id') == $value ? 'checked' : '' }} required>
                        <label class="form-check-label" for="contrato_{{ $value }}">{{ $tipo }}</label>
                    </div>
                @endforeach
            </div>
            @error('tipo_contrato_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection