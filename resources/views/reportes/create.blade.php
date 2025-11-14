@extends('layouts.app')
@section('title', 'Reportes')
@section('content')
<div class="container">
  <h1>Nuevo Reporte</h1>

  <form action="{{ route('reportes.store') }}" method="POST">
      @csrf
      @include('reportes.form')
      <button class="btn btn-success">Guardar</button>
  </form>
</div>
@endsection
