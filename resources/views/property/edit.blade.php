@extends('layouts.app')

@section('content')
<div class="col-md-6">
	<div class="card">
	  <div class="card-body row justify-content-center">
	    <h4 class="card-title text-center teal-text">EDITAR INMUEBLE</h4>
	    {!!Form::open(['url'=>'inmuebles/'.$property->id,'method'=>'PUT', 'class'=>'col-md-12'])!!}
            {{ csrf_field() }}
            <div class="row">
            	<div class="md-form mb-5 col-md-6">
	                <input type="text" id="numebreProperty" name="numebreProperty" class="form-control {{ $errors->has('numebreProperty') ? ' is-invalid' : 'validate' }}" value="{{ $property->numebreProperty }}" required autofocus="on">
	                <label class="col" data-error="error" data-success="Correcto" for="numebreProperty">Numero del inmueble</label>
	                @if ($errors->has('numebreProperty'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('numebreProperty') }}</strong>
	                    </span>
	                @endif
	            </div>

				<div class="md-form mb-5 col-md-6">
	                <input type="text" id="document" name="document" class="form-control {{ $errors->has('document') ? ' is-invalid' : 'validate' }}" value="{{ $property->document }}" required">
	                <label class="col" data-error="error" data-success="Correcto" for="document">Rif/cedula</label>
	                @if ($errors->has('document'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('document') }}</strong>
	                    </span>
	                @endif
	            </div>
            </div>

            <div class="row">
            	<div class="md-form mb-5 col-md-12">
	                <input type="text" id="owner" name="owner" class="form-control {{ $errors->has('owner') ? ' is-invalid' : 'validate' }}" value="{{ $property->owner }}" required">
	                <label class="col" data-error="error" data-success="Correcto" for="owner">Propietario</label>
	                @if ($errors->has('owner'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('owner') }}</strong>
	                    </span>
	                @endif
	            </div>
            </div>

			<div class="row">
				<div class="md-form mb-5 col-md-6">
	                <input type="email" id="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : 'validate' }}" value="{{ $property->email }}" required">
	                <label class="col" data-error="error" data-success="Correcto" for="email">Email</label>
	                @if ($errors->has('email'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('email') }}</strong>
	                    </span>
	                @endif
	            </div>

	            <div class="md-form mb-5 col-md-6">
	                <input type="text" id="phone" name="phone" class="form-control {{ $errors->has('phone') ? ' is-invalid' : 'validate' }}" value="{{ $property->phone }}" required">
	                <label class="col" data-error="error" data-success="Correcto" for="phone">Telefono</label>
	                @if ($errors->has('phone'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
	            </div>
			</div>
           
            <div class="row">
            	<div class="md-form mb-5 col-md-4">
	                <input type="text" id="aliquot" name="aliquot" class="form-control {{ $errors->has('aliquot') ? ' is-invalid' : 'validate' }}" value="{{ $property->aliquot }}" required">
	                <label class="col" data-error="error" data-success="Correcto" for="aliquot">Alicuota</label>
	                @if ($errors->has('aliquot'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('aliquot') }}</strong>
	                    </span>
	                @endif
	            </div>

	            <div class="md-form mb-5 col-md-4">
	                <input type="text" id="assistant" name="assistant" class="form-control {{ $errors->has('assistant') ? ' is-invalid' : 'validate' }}" value="{{ $property->assistant }}" required">
	                <label class="col" data-error="error" data-success="Correcto" for="assistant">Alicuota auxiliar</label>
	                @if ($errors->has('assistant'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('assistant') }}</strong>
	                    </span>
	                @endif
	            </div>

	            <div class="md-form mb-5 col-md-4">
	                <input type="text" id="area" name="area" class="form-control {{ $errors->has('area') ? ' is-invalid' : 'validate' }}" value="{{ $property->area }}" required">
	                <label class="col" data-error="error" data-success="Correcto" for="area">Area</label>
	                @if ($errors->has('area'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('area') }}</strong>
	                    </span>
	                @endif
	            </div>
            </div>

            <div class="row">
            	<div class="md-form mb-5 col-md-4">
	                <input type="text" id="water" name="water" class="form-control {{ $errors->has('water') ? ' is-invalid' : 'validate' }}" value="{{ $property->water }}" required">
	                <label class="col" data-error="error" data-success="Correcto" for="water">Cuota agua</label>
	                @if ($errors->has('water'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('water') }}</strong>
	                    </span>
	                @endif
	            </div>

	            <div class="md-form mb-5 col-md-4">
	                <input type="text" id="light" name="light" class="form-control {{ $errors->has('light') ? ' is-invalid' : 'validate' }}" value="{{ $property->light }}" required">
	                <label class="col" data-error="error" data-success="Correcto" for="light">Cuota luz</label>
	                @if ($errors->has('light'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('light') }}</strong>
	                    </span>
	                @endif
	            </div>

	            <div class="md-form mb-5 col-md-4">
	                <input type="text" id="gas" name="gas" class="form-control {{ $errors->has('gas') ? ' is-invalid' : 'validate' }}" value="{{ $property->gas }}" required">
	                <label class="col" data-error="error" data-success="Correcto" for="gas">Cuota gas</label>
	                @if ($errors->has('gas'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('gas') }}</strong>
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