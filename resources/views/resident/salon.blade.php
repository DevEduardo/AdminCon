@extends('layouts.app')

@section('content')
<div class="col-md-6">
  <div class="card">
    <div class="card-body row justify-content-center">
      <h4 class="card-title text-center"><a>Salones</a></h4>
        <div class="px-4 table-responsive">
          <a href="{{ url('property/reservacione') }}" data-toggle="tooltip" data-placement="top" title="Reservaciones"><i class="fa fa-1x fa-calendar"></i></a>
          <table class="table table-hover table-responsive-lg ">
              <thead>
                  <tr>
                    <th class="teal-text text-center" scope="col">Nombre</th>
                    <th class="teal-text text-center" scope="col">Precio</th>
                    <th class="teal-text text-center" scope="col">Disponible</th>
                    <th class="teal-text text-center" scope="col">Estado</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($salons as $key => $salon)
                  <tr>
                    <td>{{ $salon->name }}</td>
                    <td>{{ mil($salon->preci) }}</td>
                    <td class="text-center">{{ $salon->available == 1 ? 'SI':'NO' }}</td>
                    <td class="text-center">
                      @if($salon->status == 0)
                        <a id="_salon" data-id="{{$salon->id}}" class="teal-text mr-2" data-toggle="tooltip" data-placement="top" title="Reservar Salon"><i class="fa fa-2x fa-calendar"></i></a>
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
                <form action="{{ url('reservar/salon') }}" method="post">
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