@extends('layouts.app')

@section('content')
<div class="col-md-4">
	<div class="card">
	  	<div class="card-body row justify-content-center">
	    	<h4 class="card-title text-center teal-text">EDITAR DATOS DE CUENTA</h4>
	        {!!Form::open(['url'=>'cuentas/'.$bill->id,'method'=>'PUT'])!!}
		        {{ csrf_field() }}

		        <div class="md-form mb-5 col-md-12">
	                <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : 'validate' }}" value="{{ $bill->name }}" required autofocus="on">
	                <label class="col" data-error="Error" data-success="Correcto" for="name">Descripcion de la cuenta</label>
	                @if ($errors->has('name'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('name') }}</strong>
	                    </span>
	                @endif
	            </div>

	            <div class="md-form mb-5 col-md-12">
	                <input type="text" id="code" name="code" class="form-control {{ $errors->has('code') ? ' is-invalid' : 'validate' }}" value="{{ $bill->code }}" required >
	                <label class="col" data-error="Error" data-success="Correcto" for="code">Codigo de la cuenta</label>
	                @if ($errors->has('code'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('code') }}</strong>
	                    </span>
	                @endif
	            </div>
		        <div class="form-check">
				    @if($bill->finance == 1)
				    	<input type="checkbox" class="form-check-input" id="finance" name="finance" value="1" checked="checked">
				    @else
				    	<input type="checkbox" class="form-check-input" id="finance" name="finance" value="1">
				    @endif
				    <label class="form-check-label" for="finance">Fondo</label>
				</div>
				@if($bill->finance == 1)
					<div id="_finance" class=" mt-4">
				@else
					<div id="_finance" class="hidden mt-4">
				@endif
		          <div class="form-group">
		            <select class="form-control" name="estimate">
		            	@if($bill->estimate == 0)
		            		<option value="0" selected> % Sobre gastos comunes</option>
		            	@else
		            		<option value="0"> % Sobre gastos comunes</option>
		            	@endif
		              
		              	@if($bill->estimate == 1)
		              		<option value="1" selected> % Sobre gastos comunes + reservas</option>
		           	 	@else
		           	 		<option value="1"> % Sobre gastos comunes + reservas</option>
		            	@endif
		              
		              	@if($bill->estimate == 2)
		              		<option value="2" selected> Manual</option>
		           	 	@else
		           	 		<option value="2"> Manual</option>
		            	@endif
		              
		            </select>
		          </div>
		          <div class="md-form mb-5 col-md-12">
	                <input type="text" id="value" name="value" class="form-control {{ $errors->has('value') ? ' is-invalid' : 'validate' }}" value="{{ $bill->value }}" >
	                <label class="col" data-error="Error" data-success="Correcto" for="value">Valor</label>
	                @if ($errors->has('value'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('value') }}</strong>
	                    </span>
	                @endif
	            </div>
		        </div>
	        	<div class="modal-footer d-flex justify-content-center">
	                <a href="{{url()->previous()}}" class="btn btn-danger">Cancelar</a>
	                <button type="submint" class="btn btn-default">Guardar</button>
	            </div>
	      	{!!Form::close()!!}
	    </div>
	</div>
</div>
@endsection