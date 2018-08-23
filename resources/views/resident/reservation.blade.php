@extends('layouts.app')

@section('content')
<div class="col-md-6">
  <div class="card">
    <div class="card-body row justify-content-center">
      <h4 class="card-title text-center"><a>Reservacion de salon</a></h4>
        <div class="px-4 table-responsive">
          <table class="table table-hover table-responsive-lg ">
              <thead>
                  <tr>
                    <th class="teal-text" scope="col">Nombre</th>
                    <th class="teal-text" scope="col">Precio</th>
                    <th class="teal-text" scope="col">Estado</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($salons as $key => $salon)
                  <tr>
                    <td>{{ $salon->salon }}</td>
                    <td>{{ $salon->date }}</td>
                    <td>
                      @if($salon->status == 0)
                        <p class="deep-orange-text"><b>En espera de aprovacion</b></p>
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