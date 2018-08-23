@extends('layouts.app')

@section('content')
<div class="col-md-8">
	<div class="card">
	  	<div class="card-body row justify-content-center">
		    <h4 class="card-title text-center teal-text">CREAR FACTURA</h4>
		    <form action="{{ url('factura/store')}}" method="POST" class="col-md-12" id="factura">
	            {{ csrf_field() }}
	            <div class="row">
	            	<div class="md-form col-md-3">
		                <input type="text" id="number" name="number" class="form-control {{ $errors->has('number') ? ' is-invalid' : 'validate' }}" value="{{ old('number') }}" required autofocus="on">
		                <label class="col" data-error="Error" data-success="Correcto" for="number">Numero del factura</label>
		                @if ($errors->has('number'))
		                    <span class="invalid-feedback" role="alert">
		                        <strong>{{ $errors->first('number') }}</strong>
		                    </span>
		                @endif
		            </div>

					<div class="md-form col-md-3">
		                <input type="text" id="date" name="date" class="date2 form-control {{ $errors->has('date') ? ' is-invalid' : 'validate' }}" value="{{ old('date') }}" required >
		                <label class="col" data-error="Error" data-success="Correcto" for="date">Fecha</label>
		                @if ($errors->has('date'))
		                    <span class="invalid-feedback" role="alert">
		                        <strong>{{ $errors->first('date') }}</strong>
		                    </span>
		                @endif
		            </div>
	            </div>

	            <div class="row">
	            	<div class="md-form col-md-4">
		                <input type="text" id="businessName" name="businessName" class="form-control {{ $errors->has('businessName') ? ' is-invalid' : 'validate' }}" value="{{ $property->owner }}" required >
		                <label class="col" data-error="Error" data-success="Correcto" for="businessName">Nombre o razon social</label>
		                @if ($errors->has('businessName'))
		                    <span class="invalid-feedback" role="alert">
		                        <strong>{{ $errors->first('businessName') }}</strong>
		                    </span>
		                @endif
		            </div>

		            <div class="md-form col-md-4">
		                <input type="text" id="document" name="document" class="form-control {{ $errors->has('document') ? ' is-invalid' : 'validate' }}" value="{{ $property->document }}" required >
		                <label class="col" data-error="Error" data-success="Correcto" for="document">Rif/cedula</label>
		                @if ($errors->has('document'))
		                    <span class="invalid-feedback" role="alert">
		                        <strong>{{ $errors->first('document') }}</strong>
		                    </span>
		                @endif
		            </div>

		            <div class="md-form col-md-4">
		                <input type="text" id="phone" name="phone" class="form-control {{ $errors->has('phone') ? ' is-invalid' : 'validate' }}" value="{{ $property->phone }}" required >
		                <label class="col" data-error="Error" data-success="Correcto" for="phone">Telefono</label>
		                @if ($errors->has('phone'))
		                    <span class="invalid-feedback" role="alert">
		                        <strong>{{ $errors->first('phone') }}</strong>
		                    </span>
		                @endif
		            </div>
	            </div>
	            <input type="hidden" name="property" value="{{$property->id}}">
	        </form>
			<div class="row">
				<form action="{{ url('agregar/factura') }}" method="post" id="form-agregar" class="col-md-12">
					 {{ csrf_field() }}
					<div class="row">
						<div class="md-form col-md-2">
		                <input type="text" id="quantity" name="quantity" class="form-control {{ $errors->has('quantity') ? ' is-invalid' : 'validate' }}" value="" required>
		                <label class="col" data-error="Error" data-success="Correcto" for="quantity">Cantidad</label>
		                @if ($errors->has('quantity'))
		                    <span class="invalid-feedback" role="alert">
		                        <strong>{{ $errors->first('quantity') }}</strong>
		                    </span>
		                @endif
		            </div>

		            <div class="md-form col">
		                <input type="text" id="concept" name="concept" class="form-control {{ $errors->has('concept') ? ' is-invalid' : 'validate' }}" value="" required>
		                <label class="col" data-error="Error" data-success="Correcto" for="concept">Concepto o descripcion</label>
		                @if ($errors->has('concept'))
		                    <span class="invalid-feedback" role="alert">
		                        <strong>{{ $errors->first('concept') }}</strong>
		                    </span>
		                @endif
		            </div>

		            <div class="md-form col-md-2">
		                <input type="text" id="total" name="total" class="form-control {{ $errors->has('total') ? ' is-invalid' : 'validate' }}" value="" required>
		                <label class="col" data-error="Error" data-success="Correcto" for="total">Total</label>
		                @if ($errors->has('total'))
		                    <span class="invalid-feedback" role="alert">
		                        <strong>{{ $errors->first('total') }}</strong>
		                    </span>
		                @endif
		            </div>
		            <input type="hidden" name="property" value="{{$property->id}}">
		            <div class=" md-form col-md-2">
		                <a id="submintAgregar" class="btn btn-sm btn-default">Agregar</a>
		            </div>
	            </form>

				<div class="px-4 table-responsive">
	                <table class="table table-hover table-responsive-lg ">
	                    <thead>
	                        <tr>
	                            <th class="teal-text" scope="row">CANTIDAD</th>
	                            <th class="teal-text" scope="col">CONCEPTO O DESCRIPCION</th>
	                            <th class="teal-text" scope="col">TOTAL</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	@foreach($temp as $value)
	                    		<tr>
	                    			<td>{{ $value->quantity }}</td>
	                    			<td>{{ $value->concept }}</td>
	                    			<td>{{ $value->total }}</td>
	                    		</tr>
	                    	@endforeach
	                        <tr>
	                        	<td colspan="1"></td>
	                        	<td class="text-right"><b>Sub-total</b></td>
	                        	<td>{{ mil($sumTemp) }}</td>
	                        </tr>
	                        <tr>
	                        	<td colspan="1"></td>
	                        	<td class="text-right"><b>IVA 12%</b></td>
	                        	<td>{{ mil($iva) }}</td>
	                        </tr>
	                        <tr>
	                        	<td colspan="1"></td>
	                        	<td class="text-right"><b>TOTAL A PAGAR</b></td>
	                        	<td>{{ mil($total) }}</td>
	                        </tr>
	                    </tbody>
	                </table>
	            </div> 
			</div>
			<div class="modal-footer d-flex justify-content-center col">
                <a href="{{url()->previous()}}" class="btn btn-danger">Cancelar</a>
                <a id="submintFactura" class="btn btn-default">Guardar</a>
            </div>
	 	</div>
	</div>
</div>
@endsection