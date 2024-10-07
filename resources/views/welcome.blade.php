@extends('layouts.app')

@section('content')
<div class="content-container">
    <h1 class="text-center mb-4">Welcome to {{ config('app.name', 'Laravel') }}</h1>
    <p class="text-center">
        Laravel has wonderful, thorough documentation covering every aspect of the framework. Whether you are new to the framework or have previous experience with Laravel, we recommend reading all of the documentation from beginning to end.
    </p>
    <!-- Aquí puedes agregar más contenido específico de la página de bienvenida -->
</div>
@endsection