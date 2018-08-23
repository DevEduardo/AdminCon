@extends('layouts.app')

@section('content')
<div class="col-md-6">
	<div class="card">
	  <div class="card-body row justify-content-center">
	    <h4 class="card-title text-center teal-text"><a>CREAR CONDOMINIO</a></h4>
	    <form action="{{ url('condominios')}}" method="POST" enctype="multipart/form-data" class="col-md-12">
            {{ csrf_field() }}
            <div class="row">
            	<div class="md-form mb-5 col-md-6">
	                <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : 'validate' }}" value="{{ old('name') }}" required autofocus="on">
	                <label data-error="Error" data-success="Correcto" for="name" class="col">Nombre del condominio</label>
	                @if ($errors->has('name'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('name') }}</strong>
	                    </span>
	                @endif
	            </div>

	            <div class="md-form mb-5 col-md-6">
	                <input type="text" id="decument" name="document" class="form-control {{ $errors->has('document') ? ' is-invalid' : 'validate' }}" value="{{ old('document') }}" required">
	                <label data-error="Error" data-success="Correcto" for="decument" class="col">Rif/Cédula</label>
	                @if ($errors->has('document'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('document') }}</strong>
	                    </span>
	                @endif
	            </div>
            </div>

			<div class="row">
				<div class="md-form mb-5 col-md-6">
	                <input type="email" id="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : 'validate' }}" value="{{ old('email') }}" required">
	                <label data-error="Error" data-success="Correcto" for="email" class="col">Email</label>
	                @if ($errors->has('email'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('email') }}</strong>
	                    </span>
	                @endif
	            </div>

	            <div class="md-form mb-5 col-md-6">
	                <input type="text" id="personContact" name="personContact" class="form-control {{ $errors->has('personContact') ? ' is-invalid' : 'validate' }}" value="{{ old('personContact') }}" required">
	                <label data-error="Error" data-success="Correcto" for="personContact" class="col">Persona de contacto</label>
	                @if ($errors->has('personContact'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('personContact') }}</strong>
                        </span>
                    @endif
	            </div>
			</div>
           

            <div class="md-form mb-5">
                <input type="text" id="address" name="address" class="form-control {{ $errors->has('address') ? ' is-invalid' : 'validate' }}" value="{{ old('address') }}" required">
                <label data-error="Error" data-success="Correcto" for="address" class="col">Direccion</label>
                @if ($errors->has('address'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="row">
            	<div class="md-form mb-5 col-md-6">
	                <input type="text" id="phone" name="phone" class="form-control {{ $errors->has('phone') ? ' is-invalid' : 'validate' }}" value="{{ old('phone') }}" required">
	                <label data-error="Error" data-success="Correcto" for="phone" class="col">Telefono</label>
	                @if ($errors->has('phone'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('phone') }}</strong>
	                    </span>
	                @endif
	            </div>

	            <div class="md-form mb-5 col-md-6">
	                <select name="calculation" id="calculation" class="form-control {{ $errors->has('phone') ? ' is-invalid' : 'validate' }}" required>
	                	<option value="">Seleccione una opcion</option>
	                	<option value="0">Alicuota</option>
	                	<option value="1">Cuota fija</option>
	                </select>
	                <!-- <label data-error="wrong" data-success="right" for="calculation">Telefono</label> -->
	                @if ($errors->has('calculation'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('calculation') }}</strong>
	                    </span>
	                @endif
	            </div>

            </div>
            <div id="_amount" class="md-form mb-12 hidden">
                <input type="text" id="amount" name="amount" class="form-control {{ $errors->has('amount') ? ' is-invalid' : 'validate' }}" value="{{ old('amount') }}" required">
                <label data-error="Error" data-success="Correcto" for="amount" class="col">Monto</label>
                @if ($errors->has('amount'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('amount') }}</strong>
                    </span>
                @endif
            </div>
            <div class="md-form mb-5">
                <input type="file" id="logo" name="logo" class="form-control{{ $errors->has('logo') ? ' is-invalid' : 'validate' }}" value="{{ old('logo') }}" required">
                <label data-error="Error" data-success="Correcto" for="logo" class="col"></label>
                @if ($errors->has('logo'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('logo') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
			    <label for="message"> Mensaje</label>
			    <textarea class="form-control rounded-0" name="message" id="message" rows="5"></textarea>
			    @if ($errors->has('message'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('message') }}</strong>
                    </span>
                @endif
			</div>
            <div class="row justify-content-center">
                <a href="{{url()->previous()}}" class="col-sm-12 col-md-5 btn btn-danger">Cancelar</a>
                <button type="submint" class="col-sm-12 col-md-5 btn btn-default">Guardar</button>
            </div>
        </form>
	  </div>
	</div>
</div>
@endsection