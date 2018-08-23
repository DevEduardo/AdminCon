@extends('layouts.app')

@section('content')
<div class="col-md-4">
	<div class="card">
	  <div class="card-body row justify-content-center">
	    <h4 class="card-title text-center teal-text">Cargar deudas para <br> <b>{{ $property->owner }}</b></h4>
	    <form action="{{ url('inmuebles/deudas/'.$property->id)}}" method="POST" class="col-md-12">
            {{ csrf_field() }}
            <div class="row">
            	<div class="form-group mb-5 col-md-6">
	                <label class="col" data-error="wrong" data-success="right" for="month">Mes</label>
	                <select name="month" id="month" class="form-control {{ $errors->has('month') ? ' is-invalid' : 'validate' }}">
	                	<option value="">Mes</option>
	                	<option value="01">Enero</option>
	                	<option value="02">Febrero</option>
	                	<option value="03">Marzo</option>
	                	<option value="04">Abril</option>
	                	<option value="05">Mayo</option>
	                	<option value="06">Junio</option>
	                	<option value="07">Julio</option>
	                	<option value="08">Agosto</option>
	                	<option value="09">Septiembre</option>
	                	<option value="10">Octubre</option>
	                	<option value="11">Noviembre</option>
	                	<option value="12">Diciembre</option>
	                </select>
	                @if ($errors->has('month'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('month') }}</strong>
	                    </span>
	                @endif
	            </div>
				<div class="form-group mb-5 col-md-6">
	                <label class="col" data-error="wrong" data-success="right" for="year">Año</label>
	                <select name="year" id="year" class="form-control {{ $errors->has('year') ? ' is-invalid' : 'validate' }}">
	                	<option value="">Año</option>
	                	@for($i = 2010; $i < 2030; $i++)
	                		<option value="{{ $i }}">{{ $i }}</option>
	                	@endfor
	                </select>
	                @if ($errors->has('year'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('year') }}</strong>
	                    </span>
	                @endif
	            </div>
				<div class="md-form mb-5 col-md-12">
	                <input type="text" id="amount" name="amount" class="form-control {{ $errors->has('amount') ? ' is-invalid' : 'validate' }}" value="{{ old('amount') }}" required">
	                <label class="col" data-error="wrong" data-success="right" for="amount">Monto</label>
	                @if ($errors->has('amount'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('amount') }}</strong>
	                    </span>
	                @endif
	            </div>
            </div>

            <div class="modal-footer d-flex justify-content-center">
                <a href="{{url()->previous()}}" class="btn btn-danger">Cancelar</a>
                <button type="submint" class="btn btn-default">Guardar</button>
            </div>
        </form>
	  </div>
	</div>
</div>
@endsection