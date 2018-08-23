@extends('layouts.app')

@section('content')
<div class="col-md-8">
    <div class="card">
    	<div class="col-md-11 float-right">
            <a href="{{ url('salones') }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="right" title="Ver salones registrados"></i> Salones</a>
        </div>
        <div class="row justify-content-center">
            <div class="px-4 table-responsive">
                <table class="table table-hover table-responsive-lg ">
                    <thead>
                        <tr>
                            <th class="teal-text" scope="row">#</th>
                            <th class="teal-text" scope="col">Nombre</th>
                            <th class="teal-text" scope="col">Feca de reservacion</th>
                            <th class="teal-text" scope="col">inquilino</th>
                            <th class="teal-text" scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($salons as $key => $salon)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $salon->name }}</td>
                            <td>{{ $salon->nextDateRent }}</td>
                            <td>{{ mil($salon->preci) }}</td>
                            <td>
                                @if($salon->status == 0)
                                    <a href="{{url('alquiler/aprobado/'.$salon->id)}}" class="btn btn-sm btn-green">Aprobar</a>
                                @elseif($salon->status == 1)
                                    <p class="light-green-text"><b>Alquiler aprobado</b></p>
                                @elseif($salon->status == 2)
                                    <p class="red-text"><b>Alquiler cumplido</b></p>
                                @endif
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