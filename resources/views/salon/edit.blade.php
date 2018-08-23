@extends('layouts.app')

@section('content')
<div class="col-md-4">
	<div class="card">
	  <div class="card-body row justify-content-center">
	    <h4 class="card-title text-center teal-text">CREAR SALON</h4>
	    {!!Form::open(['url'=>'salones/'.$salon->id,'method'=>'PUT','class'=>'col-md-12'])!!}
            {{ csrf_field() }}
            <div class="row">
            	<div class="md-form col-md-12 col-sm-12">
	                <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : 'validate' }}" value="{{ $salon->name }}" required autofocus="on">
	                <label class="col" data-error="wrong" data-success="Correcto" for="name">Nombre del salon</label>
	                @if ($errors->has('name'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('name') }}</strong>
	                    </span>
	                @endif
	            </div>

				<div class="md-form col-md-12 col-sm-12">
	                <input type="text" id="capacity" name="capacity" class="form-control {{ $errors->has('capacity') ? ' is-invalid' : 'validate' }}" value="{{ $salon->capacity }}" required>
	                <label class="col" data-error="wrong" data-success="Correcto" for="capacity">Capacidad</label>
	                @if ($errors->has('capacity'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('capacity') }}</strong>
	                    </span>
	                @endif
	            </div>
            </div>

            <div class="row">
            	<div class="md-form col-md-12">
	                <input type="text" id="preci" name="preci" class="form-control {{ $errors->has('preci') ? ' is-invalid' : 'validate' }}" value="{{ $salon->preci }}" required>
	                <label class="col" data-error="wrong" data-success="Correcto" for="preci">Precio de alquiler</label>
	                @if ($errors->has('preci'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('preci') }}</strong>
	                    </span>
	                @endif
	            </div>
            </div>

            <div class="row">
    			<div class="col-md-12">
    				@if($salon->available == 1)
    					<input type="checkbox" id="available" name="available" value="1" class=" {{ $errors->has('available') ? ' is-invalid' : 'validate' }}" checked="checked">
    				@else
    					<input type="checkbox" id="available" name="available" value="1" class=" {{ $errors->has('available') ? ' is-invalid' : 'validate' }}">
    				@endif
        			<label for="available">Disponible</label>
        			@if ($errors->has('available'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('available') }}</strong>
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