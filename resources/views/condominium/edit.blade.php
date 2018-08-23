@extends('layouts.app')

@section('content')
<div class="col-md-6">
	<div class="card">
	  <div class="card-body row justify-content-center">
	    <h4 class="card-title text-center teal-text"><a>CREAR CONDOMINIO</a></h4>
	    {!!Form::open(['url'=>'condominios/'.$condominium->id, 'method'=>'PUT', 'enctype'=>'multipart/form-data', 'class'=>'col-md-12'])!!}
            {{ csrf_field() }}
            <div class="row">
            	<div class="md-form mb-5 col-md-6">
	                <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : 'validate' }}" value="{{ $condominium->name }}" required autofocus="on">
	                <label data-error="wrong" data-success="right" for="name" class="col">Nombre del condominio</label>
	                @if ($errors->has('name'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('name') }}</strong>
	                    </span>
	                @endif
	            </div>

	            <div class="md-form mb-5 col-md-6">
	                <input type="text" id="decument" name="document" class="form-control {{ $errors->has('document') ? ' is-invalid' : 'validate' }}" value="{{ $condominium->document }}" required">
	                <label data-error="wrong" data-success="right" for="decument" class="col">Rif/Cédula</label>
	                @if ($errors->has('document'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('document') }}</strong>
	                    </span>
	                @endif
	            </div>
            </div>

			<div class="row">
				<div class="md-form mb-5 col-md-6">
	                <input type="email" id="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : 'validate' }}" value="{{ $condominium->email }}" required">
	                <label data-error="wrong" data-success="right" for="email" class="col">Email</label>
	                @if ($errors->has('email'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('email') }}</strong>
	                    </span>
	                @endif
	            </div>

	            <div class="md-form mb-5 col-md-6">
	                <input type="text" id="personContact" name="personContact" class="form-control {{ $errors->has('personContact') ? ' is-invalid' : 'validate' }}" value="{{ $condominium->personContact }}" required">
	                <label data-error="wrong" data-success="right" for="personContact" class="col">Persona de contacto</label>
	                @if ($errors->has('personContact'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('personContact') }}</strong>
                        </span>
                    @endif
	            </div>
			</div>
           

            <div class="md-form mb-5">
                <input type="text" id="address" name="address" class="form-control {{ $errors->has('address') ? ' is-invalid' : 'validate' }}" value="{{ $condominium->address}}" required">
                <label data-error="wrong" data-success="right" for="address" class="col">Direccion</label>
                @if ($errors->has('address'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="row">
            	<div class="md-form mb-5 col-md-6">
	                <input type="text" id="phone" name="phone" class="form-control {{ $errors->has('phone') ? ' is-invalid' : 'validate' }}" value="{{ $condominium->phone }}" required">
	                <label data-error="wrong" data-success="right" for="phone" class="col">Telefono</label>
	                @if ($errors->has('phone'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('phone') }}</strong>
	                    </span>
	                @endif
	            </div>

	            <div class="md-form mb-5 col-md-6">
	                <select name="calculation" id="calculation" class="form-control {{ $errors->has('phone') ? ' is-invalid' : 'validate' }}" required>
	                	<option value="">Seleccione una opcion</option>
	                	@if($condominium->calculation == 0)
	                		<option value="0" selected>Alicuota</option>
	                	@else
	                		<option value="0">Alicuota</option>
	                	@endif
	                	@if($condominium->calculation == 1)
	                		<option value="1" selected>Cuota fija</option>
	                	@else
	                		<option value="1">Cuota fija</option>
	                	@endif
	                </select>
	                <!-- <label data-error="wrong" data-success="right" for="calculation">Telefono</label> -->
	                @if ($errors->has('calculation'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('calculation') }}</strong>
	                    </span>
	                @endif
	            </div>
            </div>
            
            <div class="md-form mb-5">
            	<p>
            		<img src="{{$condominium->logo}}" class="avatar-pic mr-3">
            		<small><b>Logo actual</b></small>
            	</p>
                <input type="file" id="logo" name="logo" class="form-control{{ $errors->has('logo') ? ' is-invalid' : 'validate' }}" value="{{ old('logo') }}" required">
                <label data-error="wrong" data-success="right" for="logo" class="col"></label>
                @if ($errors->has('logo'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('logo') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
			    <label for="message"> Mensaje</label>
			    <textarea class="form-control rounded-0" name="message" id="message" rows="5">{{$condominium->message}}</textarea>
			    @if ($errors->has('message'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('message') }}</strong>
                    </span>
                @endif
			</div>
            <div class="row justify-content-center">
                <a href="{{url()->previous()}}" class="col-sm-12 col-md-5 btn btn-danger">Cancelar</a>
                <button type="submint" class="col-sm-12 col-md-5 btn btn-default">Guardar cambios</button>
            </div>
        {!!Form::close()!!}
	  </div>
	</div>
</div>
@endsection