@extends('layouts.app')

@section('content')
<!-- Content Agencies-->
<div class="col-sm-12 col-md-12 col-lg-5 mb-3">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"><a>Notificacion de pagos</a></h4>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead> 
              <tr>
                <th class="teal-text" scope="row">FECHA</th>
                <th class="teal-text" scope="col">REFERENCIA</th>
                <th class="teal-text" scope="col">MONTO</th>
                <th class="teal-text" scope="col">accion</th>
              </tr>
            </thead>
            <tbody>
              @foreach($payments as $payment)
              <tr>
                <th scope="row">{{ $payment->date }}</th>
                <td>{{$payment->reference}}</td>
                <td>{{mil($payment->amount)}}</td>
                <td>
                  <a href="{{url('approved/'.$payment->id)}}" data-toggle="tooltip" data-placement="top" title="Aprobar pago"><i class="fa fa-2x fa-check green-text"></i></a>
                  <a href="{{url('deny/'.$payment->id)}}" data-toggle="tooltip" data-placement="top" title="Rechazar pago"><i class="fa fa-2x fa-close red-text"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>    
</div>

<div class="col-sm-12 col-md-12 col-lg-4">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"><a>Cuentas por cobrar</a></h4>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead> 
              <tr>
                <th class="teal-text" scope="row">FECHA</th>
                <th class="teal-text" scope="col">Propietario</th>
                <th class="teal-text" scope="col">MONTO</th>
              </tr>
            </thead>
            <tbody>
              @foreach($accountsReceivable as $value)
              <tr>
                <th scope="row">{{ month($value->month) }}</th>
                <td>{{$value->owner}}</td>
                <td>{{mil($value->amount)}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>    
</div>
<!-- Content Agencies-->
@endsection