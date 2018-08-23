@extends('layouts.app')

@section('content')
<div class="col-md-6">
	<div class="card">
	  <div class="card-body row justify-content-center">
	    <h4 class="card-title text-center teal-text">NUEVO EMPLEADO</h4>
	    <form action="{{ url('empleados')}}" method="POST" class="col-md-12">
            {{ csrf_field() }}
            <div class="row">
            	<div class="md-form mb-5 col-md-6 col-sm-12">
	                <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : 'validate' }}" value="{{ old('name') }}" required autofocus="on">
	                <label class="col" data-error="Error" data-success="Correcto" for="name">Nombres</label>
	                @if ($errors->has('name'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('name') }}</strong>
	                    </span>
	                @endif
	            </div>

				<div class="md-form mb-5 col-md-6 col-sm-12">
	                <input type="email" id="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : 'validate' }}" value="{{ old('email') }}" required">
	                <label class="col" data-error="Error" data-success="Correcto" for="email">Correo</label>
	                @if ($errors->has('email'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('email') }}</strong>
	                    </span>
	                @endif
	            </div>
            </div>

            <div class="row">
            	<div class="md-form mb-5 col-md-6">
	                <input type="text" id="phone" name="phone" class="form-control {{ $errors->has('phone') ? ' is-invalid' : 'validate' }}" value="{{ old('phone') }}" required">
	                <label class="col" data-error="Error" data-success="Correcto" for="phone">Telefono</label>
	                @if ($errors->has('phone'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('phone') }}</strong>
	                    </span>
	                @endif
	            </div>

                  <div class="md-form mb-5 col-md-6">
                      <input type="password" id="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : 'validate' }}" value="{{ old('password') }}" required">
                      <label class="col" data-error="Error" data-success="Correcto" for="password">Contraseña</label>
                      @if ($errors->has('password'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                  </div>
            </div>

            <div class="row">
            	<div class="col-md-12 text-center teal-text"><h4>ACCESO</h4></div>
            	<div class="col-md-12">
            		<div class="row">
            			<div class="col-md-3">
            				<input type="checkbox" id="records" name="access[]" value="1">
		            		<label for="records">Regitros</label>
            			</div>
            			<div class="col-md-3">
            				<input type="checkbox" id="moves" name="access[]" value="1">
		            		<label for="moves">Movimientos</label>
            			</div>
            			<div class="col-md-3">
            				<input type="checkbox" id="emails" name="access[]" value="1">
	            			<label for="emails">Correos</label>
            			</div>
            			<div class="col-md-3">
            				<input type="checkbox" id="informe" name="access[]" value="1">
	            			<label for="informe">Informes</label>
            			</div>
            		</div>
            	</div>
            </div>

            <div class="modal-footer d-flex justify-content-center">
                <a href="{{url()->previous()}}" class="btn btn-danger">Cancelar</a>
                <button type="submint" class="btn btn-default">Crerar empleado</button>
            </div>
        </form>
	  </div>
	</div>
</div>
@endsection