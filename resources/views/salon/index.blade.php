@extends('layouts.app')

@section('content')
<div class="col-md-8">
    <div class="card">
    	<div class="col-md-11 float-right">
            <a href="{{ url('salones/create') }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="right" title="Agregar nuevo salon"><i class="fa fa-plus mr-1"></i> Salones</a>
            <a href="{{ url('reservados') }}" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="right" title="Salones reservados"> Reservaciones</a>
        </div>
        <div class="row justify-content-center">
            <div class="px-4 table-responsive">
                <table class="table table-hover table-responsive-lg ">
                    <thead>
                        <tr>
                            <th class="teal-text" scope="row">#</th>
                            <th class="teal-text" scope="col">Nombre</th>
                            <th class="teal-text" scope="col">Capacidad</th>
                            <th class="teal-text" scope="col">Disponible</th>
                            <th class="teal-text" scope="col">Feca del proximo alquiler</th>
                            <th class="teal-text" scope="col">Precio de alquiler</th>
                            <th class="teal-text" scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($salons as $key => $salon)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $salon->name }}</td>
                            <td>{{ $salon->capacity }}</td>
                            <td>{{ available($salon->available) }}</td>
                            <td>{{ $salon->nextDateRent }}</td>
                            <td>{{ mil($salon->preci) }}</td>
                            <td>
                                <a id="_salon" data-id="{{$salon->id}}" class="teal-text mr-2" data-toggle="tooltip" data-placement="top" title="Reservar Salon"><i class="fa fa-2x fa-calendar"></i></a>
                                <a href="{{url('salones/'.$salon->id.'/edit')}}" class="teal-text mr-2" data-toggle="tooltip" data-placement="top" title="Editar Salon"><i class="fa fa-2x fa-edit"></i></a>
                                <a class="red-text mr-2"
                                    onclick="event.preventDefault();
                                    document.getElementById('delete-form').submit();" data-toggle="tooltip" data-placement="top" title="Eliminar Salon">
                                    <i class="fa fa-2x fa-trash" aria-hidden="true"></i>
                                </a>
                                {!!Form::open(['url'=>'salones/'.$salon->id,'id'=>'delete-form','method'=>'DELETE'])!!}
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

<div class="modal fade" id="salonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reservacion de salon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('reservar/salon/agency') }}" method="post">
                  {{ csrf_field() }}
                  <div class="md-form mb-5">
                      <input type="text" id="date" name="date" class="date2 form-control {{ $errors->has('date') ? ' is-invalid' : 'validate' }}" value="{{ old('date') }}" required>
                      <label data-error="Error" data-success="Correcto" for="date">Fecha en que desea alquilar el salon</label>
                      @if ($errors->has('date'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('date') }}</strong>
                              </span>
                          @endif
                  </div>
                
                <input type="hidden" name="salonId" id="salonIput">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-red" data-dismiss="modal">cancelar</button>
                <button type="submint" class="btn btn-teal">Reservar salon</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection