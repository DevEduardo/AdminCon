@extends('layouts.app')

@section('content')
<div class="col-md-6">
	<div class="card">
	  <div class="card-body row justify-content-center">
	    <h4 class="card-title text-center teal-text">REALIZAR PAGOS</h4>
	    <form action="{{ url('pago')}}" method="POST" class="col-md-12">
           {{ csrf_field() }}
            <div class="row justify-content-center">
            	<div class="form-group mb-5 col-md-8">
	                <label class="" data-error="wrong" data-success="right" for="numebreProperty">Inmueble</label>
	                <select name="property" id="property" class="form-control">
	                	<option value="" selected>Seleccione un inmueble</option>
	                	@foreach($estate as $property)
							<option value="{{ $property->id }}">({{ $property->numebreProperty }}) {{ $property->owner }}</option>
	                	@endforeach
	                </select>
	                @if ($errors->has('numebreProperty'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('numebreProperty') }}</strong>
	                    </span>
	                @endif
	            </div>
	        </div>

            <div class="modal-footer d-flex justify-content-center">
                <a href="{{url()->previous()}}" class="btn btn-danger">Cancelar</a>
                <button type="submint" class="btn btn-default">Buscar</button>
            </div>
        </form>
	  </div>
	</div>
</div>
@endsection