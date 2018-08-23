@extends('layouts.app')

@section('content')
<div class="col-md-6">
	<div class="card">
	  <div class="card-body row justify-content-center">
	    <h4 class="card-title text-center teal-text">EDITAR EMPLEADO</h4>
	    {!!Form::open(['url'=>'empleados/'.$employee->id,'method'=>'PUT','class'=>'col-md-12'])!!}
            {{ csrf_field() }}
            <div class="row">
            	<div class="md-form mb-5 col-md-6">
	                <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : 'validate' }}" value="{{ $employee->name }}" required autofocus="on">
	                <label class="col" data-error="Error" data-success="Correcto" for="name">Nombres</label>
	                @if ($errors->has('name'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('name') }}</strong>
	                    </span>
	                @endif
	            </div>

				<div class="md-form mb-5 col-md-6">
	                <input type="email" id="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : 'validate' }}" value="{{ $employee->email }}" required">
	                <label class="col" data-error="Error" data-success="Correcto" for="email">Correo</label>
	                @if ($errors->has('email'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('email') }}</strong>
	                    </span>
	                @endif
	            </div>
            </div>

            <div class="row">
            	<div class="md-form mb-5 col-md-12">
	                <input type="text" id="phone" name="phone" class="form-control {{ $errors->has('phone') ? ' is-invalid' : 'validate' }}" value="{{ $employee->phone }}" required">
	                <label class="col" data-error="Error" data-success="Correcto" for="phone">Telefono</label>
	                @if ($errors->has('phone'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('phone') }}</strong>
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