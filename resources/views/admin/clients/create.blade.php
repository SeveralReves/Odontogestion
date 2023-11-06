@extends('adminlte::page')

@section('title', 'OdontoGestion')

@section('content_header')
    <a type="button" href="/clients" class="btn btn-link"> Regresar</a>
    <h1 class="m-0 text-dark">Crear Cliente</h1>
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
<form action="{{ route('clients.store') }}" method="post">
        @csrf
        <div class="row">
            <x-adminlte-input name="name" label="Nombres" placeholder="Ingresa los nombres del cliente"
                fgroup-class="col-md-6" label-class="text-primary">
            </x-adminlte-input>
            <x-adminlte-input name="lastname" label="Apellidos" placeholder="Ingresa los apellidos del cliente"
                fgroup-class="col-md-6" label-class="text-primary">
            </x-adminlte-input>
            <x-adminlte-input name="id_number" label="Cédula de identidad" placeholder="XX.XXX.XXX" fgroup-class="col-md-6"
                label-class="text-primary">
                <x-slot name="bottomSlot">
                    <span class="text-sm text-gray">
                        Solo ingresa los numeros
                    </span>
                </x-slot>
            </x-adminlte-input>
            <x-adminlte-input name="email" label="Correo electrónico" placeholder="mail@mail.com" fgroup-class="col-md-6"
                label-class="text-primary">
            </x-adminlte-input>
            <x-adminlte-input name="phone" label="Teléfono" placeholder="04121231212" fgroup-class="col-md-6"
                label-class="text-primary">
                <x-slot name="bottomSlot">
                    <span class="text-sm text-gray">
                        Solo ingresa los numeros
                    </span>
                </x-slot>
            </x-adminlte-input>
            @php
                $config = ['format' => 'DD/MM/YYYY', 'maxDate' => 'js:moment()'];
            @endphp
            <x-adminlte-input-date name="birthday" :config="$config" label="Fecha de nacimiento"
                placeholder="Escoge una fecha..." fgroup-class="col-md-6" label-class="text-primary">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-clock"></i>
                    </div>
                </x-slot>
            </x-adminlte-input-date>
            <x-adminlte-textarea name="address" label="Dirección" placeholder="Ingresa dirección..."
                label-class="text-primary" fgroup-class="col-md-6" />
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <x-adminlte-button class="btn-flat" type="submit" label="Submit" theme="primary"
                    icon="fas fa-lg fa-save" />
            </div>
        </div>
    </form>
@stop
