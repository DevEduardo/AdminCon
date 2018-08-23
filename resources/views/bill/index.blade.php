@extends('layouts.app')

@section('content')
<div class="col-md-8">
    <div class="card">
    	<div class="col-md-8 float-right">
            <a href="{{ url('cuentas/create') }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="right" title="Agregar nueva cuenta"><i class="fa fa-plus mr-1"></i> Cuenta</a>
        </div>
        <div class="row justify-content-center">
            <div class="px-4 table-responsive">
                <table class="table table-hover table-responsive-lg ">
                    <thead>
                        <tr>
                            <th class="teal-text" scope="row">#</th>
                            <th class="teal-text" scope="col">Cuenta</th>
                            <th class="teal-text" scope="col">Fondo</th>
                            <th class="teal-text" scope="col">Calculo</th>
                            <th class="teal-text" scope="col">Valor</th>
                            <th class="teal-text" scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bills as $key => $bill)
                        <tr>
                            <th>{{ $key + 1}}</th>
                            <td>{{ $bill->name }}</td>
                            <td>
                                @if($bill->finance == 1 || $bill->finance == 2)
                                    SI
                                @else
                                    NO
                                @endif
                            </td>
                            <td>{{ calculation($bill->estimate) }}</td>
                            <td>
                                @if($bill->value != 0)
                                    {{ $bill->value }}
                                @else
                                    NO
                                @endif
                            </td>
                            <td>
                                <a href="{{url('cuentas/'.$bill->id.'/edit')}}" class="teal-text mr-2" data-toggle="tooltip" data-placement="top" title="Editar Cuenta"><i class="fa fa-2x fa-edit"></i></a>
                                <a href="{{url('cuentas/moviminetos/'.$bill->id)}}" class="green-text mr-2" data-toggle="tooltip" data-placement="top" title="Movimeintos de cuenta"><i class="fa fa-2x fa-bar-chart"></i></a>
                                <a class="deleteBill red-text mr-2" data-id="{{$bill->id}}"><i class="fa fa-2x fa-trash" aria-hidden="true"></i></a>
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