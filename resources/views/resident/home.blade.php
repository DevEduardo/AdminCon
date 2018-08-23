@extends('layouts.app')

@section('content')
<!-- Content Agencies-->
<div class="col-md-6 mb-3">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title text-center"><a>Estado de cuenta</a></h4>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead> 
              <tr>
                <th class="teal-text" scope="row">FECHA</th>
                <th class="teal-text" scope="col">REFERENCIA</th>
                <th class="teal-text" scope="col">MONTO</th>
                <th class="teal-text" scope="col">status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($payments as $payment)
              <tr>
                <th scope="row">{{ $payment->date }}</th>
                <td>{{$payment->reference}}</td>
                <td>{{mil($payment->amount)}}</td>
                <td>{{$payment->status}}</td>
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