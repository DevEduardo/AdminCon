@extends('layouts.app')

@section('content')
<div class="col-md-8">
    <div class="card">
    	<div class="col-md-11 float-right">
            <a href="{{ url('empleados/create') }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="right" title="Agregar nuevo empleado"><i class="fa fa-plus mr-1"></i> Empleado</a>
        </div>
        <div class="row justify-content-center">
            <div class="px-4 table-responsive">
                <table class="table table-hover table-responsive-lg ">
                    <thead>
                        <tr>
                            <th class="teal-text" scope="row">#</th>
                            <th class="teal-text" scope="col">Nombre</th>
                            <th class="teal-text" scope="col">Email</th>
                            <th class="teal-text" scope="col">Telefono</th>
                            <th class="teal-text" scope="col">Acceso</th>
                            <th class="teal-text" scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $key => $employee)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->phone }}</td>
                            <td>
                                @foreach($employeeAcces as $acces)
                                    @if($employee->id == $acces->employee)
                                        {{ $acces->records == 1 ? 'Registros': '' }}
                                        {{ $acces->moves == 1 ? ' - Movimientos': '' }}
                                        {{ $acces->emails == 1 ? ' - Correos': '' }}
                                        {{ $acces->informes == 1 ? ' - Informes': '' }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <a href="{{url('empleados/'.$employee->id.'/edit')}}" class="teal-text mr-2" data-toggle="tooltip" data-placement="top" title="Editar Empleado"><i class="fa fa-2x fa-edit"></i></a>
                                <a class="red-text mr-2"
                                    onclick="event.preventDefault();
                                    document.getElementById('delete-form').submit();" data-toggle="tooltip" data-placement="top" title="Eliminar Empleado">
                                    <i class="fa fa-2x fa-trash" aria-hidden="true"></i>
                                </a>
                                {!!Form::open(['url'=>'empleados/'.$employee->id,'id'=>'delete-form','method'=>'DELETE'])!!}
                                    {{ csrf_field() }}
                                {!!Form::close()!!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>  
        </div>
    </div>
</div>
@endsection