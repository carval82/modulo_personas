@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles de la Persona</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $persona->pnombre }} {{ $persona->papelido }}</h5>
            <p class="card-text"><strong>ID:</strong> {{ $persona->id }}</p>
            <p class="card-text"><strong>Documento:</strong> {{ $persona->documento }}</p>
            <p class="card-text"><strong>Primer Nombre:</strong> {{ $persona->pnombre }}</p>
            <p class="card-text"><strong>Segundo Nombre:</strong> {{ $persona->snombre ?? 'N/A' }}</p>
            <p class="card-text"><strong>Primer Apellido:</strong> {{ $persona->papelido }}</p>
            <p class="card-text"><strong>Segundo Apellido:</strong> {{ $persona->sapelido ?? 'N/A' }}</p>
            <p class="card-text"><strong>Teléfono:</strong> {{ $persona->telefono }}</p>
            <p class="card-text"><strong>Correo:</strong> {{ $persona->correo }}</p>
            <p class="card-text"><strong>Dirección:</strong> {{ $persona->direccion }}</p>
            <p class="card-text"><strong>Rol:</strong> {{ $persona->rol->descripcion ?? 'N/A' }}</p>
            <p class="card-text"><strong>Grupo Sanguíneo:</strong> {{ $persona->grupoSanguineo->descripcion ?? 'N/A' }}</p>
            <p class="card-text"><strong>Tipo de Contrato:</strong> {{ $persona->tipoContrato->descripcion ?? 'N/A' }}</p>
            <p class="card-text"><strong>Fecha de Creación:</strong> {{ $persona->created_at->format('Y-m-d H:i:s') }}</p>
            <p class="card-text"><strong>Última Actualización:</strong> {{ $persona->updated_at->format('Y-m-d H:i:s') }}</p>
        </div>
    </div>
    <div class="mt-3">
        <a href="{{ route('personas.edit', $persona) }}" class="btn btn-primary">Editar</a>
        <a href="{{ route('personas.index') }}" class="btn btn-secondary">Volver a la lista</a>
        <form action="{{ route('personas.destroy', $persona) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar esta persona?')">Eliminar</button>
        </form>
    </div>
</div>
@endsection