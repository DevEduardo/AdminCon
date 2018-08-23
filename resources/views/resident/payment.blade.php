@extends('layouts.app')

@section('content')
<div class="col-md-6">
  <div class="card">
    <div class="card-body">
    	<h4 class="card-title text-center">Notificaion de pago</h4>
		{!!Form::open(['url'=>'notificacion','method'=>'POST'])!!}
		{{ csrf_field() }}
	    <div class="col-md-12">
	        <div class="row">
	          <div class="md-form col-md-6">
	              <input type="text" id="date" name="date" class="date2 form-control {{ $errors->has('date') ? ' is-invalid' : 'validate' }}" value="{{ old('date') }}">
	              <label class="col" data-error="wrong" data-success="correcto" for="date">Fecha</label>
	              @if ($errors->has('date'))
	                  <span class="invalid-feedback" role="alert">
	                      <strong>{{ $errors->first('date') }}</strong>
	                  </span>
	              @endif
	          </div>

	          <div class="md-form col-md-6">
	              <input type="text" id="concept" name="concept" class="form-control {{ $errors->has('concept') ? ' is-invalid' : 'validate' }}" value="{{ old('concept') }}" >
	              <label class="col" data-error="wrong" data-success="correcto" for="concept">Concepto</label>
	              @if ($errors->has('concept'))
	                  <span class="invalid-feedback" role="alert">
	                      <strong>{{ $errors->first('concept') }}</strong>
	                  </span>
	              @endif
	          </div>
	        </div>

	        <div class="row">
	          <div class="form-group col-md-12">
	            <label class="col">Forma de pago</label>
	              <select id="wayToPay" name="wayToPay" class="form-control {{ $errors->has('wayToPay') ? ' is-invalid' : 'validate' }}">
	                <option value="">Seleccione una opcion</option>
	                <option value="0">Transferencia</option>
	                <option value="1">Deposito</option>
	                <option value="2">Cheque</option>
	              </select>
	              @if ($errors->has('wayToPay'))
	                  <span class="invalid-feedback" role="alert">
	                      <strong>{{ $errors->first('wayToPay') }}</strong>
	                  </span>
	              @endif
	          </div>
	        </div>

	        <div class="row">
	          <div class="_transfer hidden md-form col-md-6">
	            <input type="text" id="operationNumber" name="operationNumber" class="form-control {{ $errors->has('operationNumber') ? ' is-invalid' : 'validate' }}" value="{{ old('operationNumber') }}" >
	              <label class="col" data-error="wrong" data-success="correcto" for="operationNumber">Numero de operacion</label>
	              @if ($errors->has('operationNumber'))
	                  <span class="invalid-feedback" role="alert">
	                      <strong>{{ $errors->first('operationNumber') }}</strong>
	                  </span>
	              @endif
	          </div>

	          <div class="_transfer hidden form-group col-md-6">
	            <label class="col">Banco emisor</label>
	              <select id="issuingBank" name="issuingBank" class="form-control {{ $errors->has('issuingBank') ? ' is-invalid' : 'validate' }}">
	                <option value="">Seleccione una opcion</option>
	                <option value="0196">ABN AMRO BANK</option>
					<option value="0172">BANCAMIGA BANCO MICROFINANCIERO, C.A.</option>
					<option value="0171">BANCO ACTIVO BANCO COMERCIAL, C.A.</option>
					<option value="0166">BANCO AGRICOLA</option>
					<option value="0175">BANCO BICENTENARIO</option>
					<option value="0128">BANCO CARONI, C.A. BANCO UNIVERSAL</option>
					<option value="0164">BANCO DE DESARROLLO DEL MICROEMPRESARIO</option>
					<option value="0102">BANCO DE VENEZUELA S.A.I.C.A.</option>
					<option value="0114">BANCO DEL CARIBE C.A.</option>
					<option value="0149">BANCO DEL PUEBLO SOBERANO C.A.</option>
					<option value="0163">BANCO DEL TESORO</option>
					<option value="0176">BANCO ESPIRITO SANTO, S.A.</option>
					<option value="0115">BANCO EXTERIOR C.A.</option>
					<option value="0003">BANCO INDUSTRIAL DE VENEZUELA.</option>
					<option value="0173">BANCO INTERNACIONAL DE DESARROLLO, C.A.</option>
					<option value="0105">BANCO MERCANTIL C.A.</option>
					<option value="0191">BANCO NACIONAL DE CREDITO</option>
					<option value="0116">BANCO OCCIDENTAL DE DESCUENTO.</option>
					<option value="0138">BANCO PLAZA</option>
					<option value="0108">BANCO PROVINCIAL BBVA</option>
					<option value="0104">BANCO VENEZOLANO DE CREDITO S.A.</option>
					<option value="0168">BANCRECER S.A. BANCO DE DESARROLLO</option>
					<option value="0134">BANESCO BANCO UNIVERSAL</option>  
					<option value="0177">BANFANB</option>
					<option value="0146">BANGENTE</option>
					<option value="0174">BANPLUS BANCO COMERCIAL C.A</option>
					<option value="0190">CITIBANK.</option>
					<option value="0121">CORP BANCA.</option>
					<option value="0157">DELSUR BANCO UNIVERSAL</option>
					<option value="0151">FONDO COMUN</option>
					<option value="0601">INSTITUTO MUNICIPAL DE CR&#201;DITO POPULAR</option>
					<option value="0169">MIBANCO BANCO DE DESARROLLO, C.A.</option>
					<option value="0137">SOFITASA</option>
	              </select>
	              @if ($errors->has('issuingBank'))
	                  <span class="invalid-feedback" role="alert">
	                      <strong>{{ $errors->first('issuingBank') }}</strong>
	                  </span>
	              @endif
	          </div>
	        </div>

	        <div class="row">
	          <div class="_check hidden md-form col-md-6">
	            <input type="text" id="checkNumber" name="checkNumber" class="form-control {{ $errors->has('checkNumber') ? ' is-invalid' : 'validate' }}" value="{{ old('checkNumber') }}" >
	              <label class="col" data-error="wrong" data-success="correcto" for="checkNumber">Numero de cheque</label>
	              @if ($errors->has('checkNumber'))
	                  <span class="invalid-feedback" role="alert">
	                      <strong>{{ $errors->first('checkNumber') }}</strong>
	                  </span>
	              @endif
	          </div>

	          <div class="_check hidden form-group col-md-6">
	            <label class="col">Banco emisor</label>
	              <select id="issuingBank" name="issuingBank" class="form-control {{ $errors->has('issuingBank') ? ' is-invalid' : 'validate' }}">
	                <option value="">Seleccione una opcion</option>
	                @include('property.partials.optionBank')
	              </select>
	              @if ($errors->has('issuingBank'))
	                  <span class="invalid-feedback" role="alert">
	                      <strong>{{ $errors->first('issuingBank') }}</strong>
	                  </span>
	              @endif
	          </div>
	        </div>

	        <div class="row">
	          <div class="md-form col-md-12">
	            <input type="text" id="amount" name="amount" class="form-control {{ $errors->has('amount') ? ' is-invalid' : 'validate' }}" value="{{ old('amount') }}" >
	              <label class="col" data-error="wrong" data-success="correcto" for="amount">Monto</label>
	              @if ($errors->has('amount'))
	                  <span class="invalid-feedback" role="alert">
	                      <strong>{{ $errors->first('amount') }}</strong>
	                  </span>
	              @endif
	          </div>
	        </div>
			<input type="hidden" name="estate" value="{{$resident->id}}">
	        <div class="row justify-content-center">
	          <button type="submint" class=" btn btn-default" data-toggle="tooltip" data-placement="top" title="Enviar notificacion"><b>Enviar notificacio de pago</b></button>
	        </div>
	    </div>
       	{!!Form::close()!!}
      </div>
    </div>
  </div>
</div>
@endsection