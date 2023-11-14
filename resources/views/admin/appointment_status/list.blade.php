@extends('adminlte::page')

@section('title', 'OdontoGestion')

@section('content_header')
    <h1 class="m-0 text-dark">Estado de Cita</h1>
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
    <div class="row">
        <div class="col-12">
            <a href="appointment_status/create" class="btn btn-primary">Crear Nuevo Estado de cita</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <x-adminlte-datatable id="table1" :heads="$heads">
                        @foreach ($appointment_status as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->type }}</td>
                                <td>
                                 <a href="appointment_edit/{{ $row->id }}/edit" class="btn btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a data-toggle="modal" data-target="#deleteModal-{{ $row->id }}"
                                        class="btn btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <div class="modal fade" id="deleteModal-{{ $row->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">¿Estás seguro que deseas
                                                eliminar el estado de esta cita??</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Si deseas eliminar a <b> {{ $row->name }} {{ $row->type }}</b> presiona
                                            en eliminar
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancelar</button>
                                            <form action="{{ route('edit-appointment_status', $row->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    </x-adminlte-datatable>
                </div>
            </div>
        </div>
    </div>
@stop
