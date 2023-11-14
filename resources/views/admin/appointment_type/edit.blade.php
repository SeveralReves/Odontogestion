@extends('adminlte::page')

@section('title', 'OdontoGestion')

@section('content_header')
    <a type="button" href="/clients" class="btn btn-light"><i class="fas fa-arrow-left"></i> Regresar</a>
    <h1 class="m-0 mt-2 text-dark">Editar Tipo de Cita {{ $appointment_type->id }}</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- @dd(session()->all()) --}}
    <form action="{{ route('edit-appointment_type', $appointment_type->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <x-adminlte-input name="name" label="Nombres" value="{{ old('name', $appointment_type->name) }}"
                placeholder="Ingresa los nombres del cliente" fgroup-class="col-md-6" label-class="text-primary">
            </x-adminlte-input>
            <x-adminlte-input name="type" label="Tipo" value="{{ old('type', $appointment_type->type) }}"
                placeholder="Ingresa el Tipo de Cita" fgroup-class="col-md-6" label-class="text-primary">
            </x-adminlte-input>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <x-adminlte-button class="btn-flat" type="submit" label="Actualizar" theme="primary"
                    icon="fas fa-lg fa-save" />
            </div>
        </div>
    </form>
@stop