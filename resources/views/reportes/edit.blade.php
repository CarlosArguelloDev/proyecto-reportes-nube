@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Reporte</h1>

    <form action="{{ route('reportes.update', $reporte) }}" method="POST">
        @csrf @method('PUT')
        @include('reportes.form')
        <button class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
