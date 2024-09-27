@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Personas</h1>
    <a href="{{ route('personas.create') }}" class="btn btn-primary mb-3">Crear Nueva Persona</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Documento</th>
                    <th>Primer Nombre</th>
                    <th>Segundo Nombre</th>
                    <th>Primer Apellido</th>
                    <th>Segundo Apellido</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                    <th>Rol</th>
                    <th>Grupo Sanguíneo</th>
                    <th>Tipo de Contrato</th>
                    <th>Fecha Creación</th>
                    <th>Última Actualización</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($personas as $persona)
                <tr>
                    <td>{{ $persona->id }}</td>
                    <td>{{ $persona->documento }}</td>
                    <td>{{ $persona->pnombre }}</td>
                    <td>{{ $persona->snombre }}</td>
                    <td>{{ $persona->papelido }}</td>
                    <td>{{ $persona->sapelido }}</td>
                    <td>{{ $persona->telefono }}</td>
                    <td>{{ $persona->correo }}</td>
                    <td>{{ $persona->direccion }}</td>
                    <td>{{ $persona->rol->descripcion ?? 'N/A' }}</td>
                    <td>{{ $persona->grupoSanguineo->descripcion ?? 'N/A' }}</td>
                    <td>{{ $persona->tipoContrato->descripcion ?? 'N/A' }}</td>
                    <td>{{ $persona->created_at->format('Y-m-d H:i:s') }}</td>
                    <td>{{ $persona->updated_at->format('Y-m-d H:i:s') }}</td>
                    <td>
                        <a href="{{ route('personas.show', $persona) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('personas.edit', $persona) }}" class="btn btn-primary btn-sm">Editar</a>
                        <form action="{{ route('personas.destroy', $persona) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection