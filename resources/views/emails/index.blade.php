@extends('layouts.app')

@section('content')
<div class="col-md-5">
	<div class="card">
	  <div class="card-body row justify-content-center">
	    <h4 class="card-title text-center teal-text"><b>ENVIO DE CORREOS</b></h4>
	    <form action="{{ url('email')}}" method="POST" enctype="multipart/form-data" class="col-md-12">
            {{ csrf_field() }}

            <div class="row justify-content-center">
	            <div class="form-group col-md-12">
	                <label data-error="wrong" data-success="right" for="type">Telefono</label>
	                <select name="type" id="type" class="form-control {{ $errors->has('phone') ? ' is-invalid' : 'validate' }}" required>
	                	<option value="">Seleccione una opcion</option>
	                	<option value="0">Mensaje de bienvenida y generacion de usuario</option>
                		<option value="1">Aviso de cobro</option>
	                </select>
	                @if ($errors->has('type'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('type') }}</strong>
	                    </span>
	                @endif
	            </div>
            </div>
            
            <div class="row">
				<div class="form-group col-lg-6">
					<label for="desde">Desde</label>
					<select name="desde" id="desde" class="form-control">
					  <option selected="">Inmueble</option>
					  @foreach($estate as $property)
					    <option value="{{$property->id}}">{{$property->numebreProperty}}</option>
					  @endforeach
					</select>
					@if ($errors->has('desde'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('desde') }}</strong>
	                    </span>
	                @endif
				</div>

				<div class="form-group col-lg-6">
					<label for="">Hasta</label>
					<select name="hasta" id="hasta" class="form-control">
					  <option selected="">Inmueble</option>
					  @foreach($estate as $property)
					    <option value="{{$property->id}}">{{$property->numebreProperty}}</option>
					  @endforeach
					</select>
					@if ($errors->has('hasta'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('hasta') }}</strong>
	                    </span>
	                @endif
				</div>
            </div>
			
			<div class="form-group">
				<label for="asunto">Asunto</label>
				<input type="text" id="subject" name="subject" class="form-control">
				@if ($errors->has('subject'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('subject') }}</strong>
                    </span>
                @endif
			</div>

            <div class="form-group">
              	<label for="">Mensaje</label>
              	<textarea name="message" id="message" class="form-control" cols="5" rows="5"></textarea>
              	@if ($errors->has('message'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('message') }}</strong>
                    </span>
                @endif
            </div>

            <div class="row justify-content-center">
                <a href="{{url()->previous()}}" class="col-sm-12 col-md-5 btn btn-danger">Cancelar</a>
                <button type="submint" class="col-sm-12 col-md-5 btn btn-default">Enviar</button>
            </div>
        </form>
	  </div>
	</div>
</div>
@endsection