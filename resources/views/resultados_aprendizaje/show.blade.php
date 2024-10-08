@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Resultado de Aprendizaje</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Código: {{ $resultado->codigo }}</h5>
            <p class="card-text"><strong>Descripción:</strong> {{ $resultado->descripcion }}</p>
            <p class="card-text"><strong>Intensidad Horaria:</strong> {{ $resultado->intensidad_horaria }} horas</p>
            <p class="card-text"><strong>Competencia:</strong> {{ $resultado->competencia->codigo }} - {{ $resultado->competencia->descripcion }}</p>
        </div>
    </div>
    <div class="mt-3">
        <a href="{{ route('resultados_aprendizaje.edit', $resultado->id) }}" class="btn btn-warning">Editar</a>
        <form action="{{ route('resultados_aprendizaje.destroy', $resultado->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este resultado de aprendizaje?')">Eliminar</button>
        </form>
        <a href="{{ route('resultados_aprendizaje.index') }}" class="btn btn-secondary">Volver al listado</a>
    </div>
</div>
@endsection