@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Seleccionar Vacuna</h1>

        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Mostrar los errores de validación -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario para seleccionar una vacuna -->
        <form action="{{ route('vacunas.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="id_vacuna" class="form-label">Seleccione una vacuna</label>
                <select id="id_vacuna" name="id_vacuna" class="form-control">
                    <option value="" disabled selected>Seleccione una vacuna</option>
                    @foreach($vacunas as $vacuna)
                        <option value="{{ $vacuna->id }}">{{ $vacuna->nombre_vacuna }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Otros campos que puedas tener -->

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection
