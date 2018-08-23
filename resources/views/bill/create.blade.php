@extends('layouts.app')

@section('content')
<div class="col-md-5">
	<div class="card">
	  	<div class="card-body row justify-content-center">
	    	<h4 class="card-title text-center teal-text">CREAR CUENTA</h4>
	        {!!Form::open(['route'=>'cuentas.store','class'=>'col-lg-12'])!!}
		       {{ csrf_field() }}

		        <div class="md-form mb-5 col-md-12">
	                <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : 'validate' }}" value="{{ old('name') }}" required autofocus="on">
	                <label class="col" data-error="Error" data-success="Correcto" for="name">Descripcion de la cuenta</label>
	                @if ($errors->has('name'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('name') }}</strong>
	                    </span>
	                @endif
	            </div>

		        <div class="form-check text-center">	
				    <input type="radio" class="form-check-input" id="finance" name="finance" value="1">
				    <label class="form-check-label mr-5" for="finance">Fondo</label>
				    <input type="radio" class="form-check-input" id="expenses" name="finance" value="2">
				    <label class="form-check-label mr-5" for="expenses">Gastos administrativo</label>
				    <input type="radio" class="form-check-input" id="bil" name="finance" value="3">
				    <label class="form-check-label" for="bil">Cuenta general</label>
				</div>
				
		        <div id="_finance" class="hidden mt-4">
			        <div class="form-group">
			            <select class="form-control" name="estimate" id="estimate">
			              <option value="0"> Seleecine una opcion</option>
			              <option value="1"> % Sobre gastos comunes</option>
			              <option value="2"> % Sobre gastos comunes + reservas</option>
			              <option value="8"> Manual</option>
			            </select>
			        </div>
		          	<div id="_manual" class="md-form mb-5 col-md-12 ">
		                <input type="text" id="value" name="value" class="form-control {{ $errors->has('value') ? ' is-invalid' : 'validate' }}" value="{{ old('value') }}" >
		                <label class="col" data-error="Error" data-success="Correcto" for="value">Valor</label>
		                @if ($errors->has('value'))
		                    <span class="invalid-feedback" role="alert">
		                        <strong>{{ $errors->first('value') }}</strong>
		                    </span>
		                @endif
	            	</div>
		        </div>
		        <div id="_bil" class="hidden mt-4">
			        <div class="form-group">
			            <select class="form-control" name="estimate2">
			              <option value="0"> Seleecine una opcion</option>
			              @if(session('calculationCondominium') == 1)
			              	<option value="10"> Cuota fija</option>
			              @else
			              	<option value="3"> Alicuota</option>
			              @endif
			              <option value="4"> Aliquota extra</option>
			              <option value="5"> Aliquota gas</option>
			              <option value="6"> Aliquota luz</option>
			              <option value="7"> Aliquota agua</option>
			            </select>
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