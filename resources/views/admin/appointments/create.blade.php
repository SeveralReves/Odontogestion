@extends('adminlte::page')

@section('title', 'OdontoGestion')

@section('content_header')
    <a type="button" href="/appointments" class="btn btn-link"> Regresar</a>
    <h1 class="m-0 text-dark mb-4">Crear Cita</h1>
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
    <form action="{{ route('appointments.store') }}" method="post">
        @csrf
        <div class="row">
            <x-adminlte-select2 name="client_id" label="Cliente" label-class="text-lightblue"
                data-placeholder="Seleccione un cliente..." value="{{ old('client_id') }}" fgroup-class="col-md-6"
                label-class="text-primary">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-user"></i>
                    </div>
                </x-slot>
                <option {{old('client_id') ? '' : 'selected' }} disabled> Seleccione un cliente</option>
                @foreach ($clients as $item)
                    <option value="{{ $item->id }}" {{old('client_id') == $item->id ? 'selected' : null }}>{{ $item->name }}</option>
                @endforeach
            </x-adminlte-select2>

            <x-adminlte-select2 name="appointments_type_id" label="Tipo de cita" label-class="text-lightblue"
                data-placeholder="Seleccione un tipo de cita..." value="{{ old('appointments_type_id') }}" fgroup-class="col-md-6"
                label-class="text-primary">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-tags"></i>
                    </div>
                </x-slot>
                <option {{old('appointments_type_id') ? '' :  'selected'}} disabled> Seleccione un tipo de cita</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{old('appointments_type_id') == $type->id ? 'selected' : null }}>{{ $type->name }}</option>
                @endforeach
            </x-adminlte-select2>

            <x-adminlte-select2 name="status_id" label="Estado" label-class="text-lightblue"
                data-placeholder="Seleccione un estado..." value="{{ old('status_id') }}" fgroup-class="col-md-6"
                label-class="text-primary">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-tasks"></i>
                    </div>
                </x-slot>
                <option {{old('status_id') ? '' :  'selected'}} disabled> Seleccione un estado</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}" {{old('status_id') == $status->id ? 'selected' : null }}>{{ $status->name }}</option>
                @endforeach
            </x-adminlte-select2>

            @php
                $config = ['format' => 'DD/MM/YYYY', 'minDate' => 'js:moment()'];
            @endphp
            <x-adminlte-input-date name="date" :config="$config" label="Fecha de cita"
                value="{{ old('date') }}" placeholder="Escoge una fecha..." fgroup-class="col-md-6"
                label-class="text-primary">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-calendar"></i>
                    </div>
                </x-slot>
            </x-adminlte-input-date>
            @php
                $config2 = ['format' => 'HH:mm'];
            @endphp
            <x-adminlte-input-date name="hour" :config="$config2" label="Hora de cita"
                value="{{ old('hour') }}" placeholder="Escoge una hora..." fgroup-class="col-md-6"
                label-class="text-primary">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-clock"></i>
                    </div>
                </x-slot>
            </x-adminlte-input-date>

            <x-adminlte-textarea name="notes" label="Nota" value="{{ old('notes') }}"
                placeholder="Ingresa alguna nota..." label-class="text-primary" fgroup-class="col-md-6" />
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <x-adminlte-button class="btn-flat" type="submit" label="Guardar" theme="primary"
                    icon="fas fa-lg fa-save" />
            </div>
        </div>
    </form>
@stop
