@extends('layouts.app')

@section('content')
<div class="col-md-11">
    <div class="card">
    	<div class="col-md-11 float-right">
            <a href="{{ url('inmuebles/create') }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Agregar nuevo inmueble"><i class="fa fa-plus mr-1"></i> Inmueble</a>
            <p>Inmuebles registrados: {{ $estate->count() }}</p>
        </div>
        <div class="row justify-content-center">
            <div class="px-4 table-responsive">
                <table class="table table-hover table-responsive-lg ">
                    <thead>
                        <tr>
                            <th class="teal-text" scope="row">#</th>
                            <th class="teal-text" scope="col">Propietario</th>
                            <th class="teal-text" scope="col">Telefono</th>
                            <th class="teal-text" scope="col">Email</th>
                            <th class="teal-text" scope="col">Alicuota</th>
                            <th class="teal-text" scope="col">Saldo</th>
                            <th class="teal-text" scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($estate as $property)
                        <tr>
                            <th scope="row">{{ $property->numebreProperty }}</th>
                            <td>{{ $property->owner }}</td>
                            <td>{{ $property->phone }}</td>
                            <td>{{ $property->email }}</td>
                            <td>{{ $property->aliquot }}</td>
                            <td>{{ mil($property->debit) }}</td>
                            <td>
                                <a href="{{url('inmuebles/'.$property->id.'/edit')}}" class="teal-text mr-2" data-toggle="tooltip" data-placement="top" title="Editar Inmueble"><i class="fa fa-2x fa-edit"></i></a>
                                <a href="{{url('inmuebles/pago/'.$property->id)}}" class="green-text mr-2" data-toggle="tooltip" data-placement="top" title="Realizar pagos"><i class="fa fa-2x fa-money"></i></a>
                                <a href="{{url('inmuebles/deudas/'.$property->id)}}" class="blue-text mr-2" data-toggle="tooltip" data-placement="top" title="Ingresar deudas"><i class="fa fa-2x fa-credit-card"></i></a>
                                @if($property->status == 1)
                                <a href="{{url('inmuebles/'.$property->id.'/lockOrUnlock')}}" class="cyan-text mr-2" data-toggle="tooltip" data-placement="top" title="Bloquear inmueble"><i class="fa fa-2x fa-check"></i></a>
                                @else
                                <a href="{{url('inmuebles/'.$property->id.'/lockOrUnlock')}}" class="grey-text mr-2" data-toggle="tooltip" data-placement="top" title="Desbloquear inmueble"><i class="fa fa-2x fa-close"></i></a>
                                @endif
                                <a class="red-text mr-2"
                                    onclick="event.preventDefault();
                                    document.getElementById('delete-form').submit();" data-toggle="tooltip" data-placement="top" title="Eliminar inmueble">
                                    <i class="fa fa-2x fa-trash" aria-hidden="true"></i>
                                </a>
                                {!!Form::open(['url'=>'inmuebles/'.$property->id,'id'=>'delete-form','method'=>'DELETE'])!!}
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