@extends('layouts.app')

@section('content')
<div class="col-md-5">
	<div class="card">
		<div class="teal white-text">
			<table>
				<tr>
					<th class="wd-20 pl-3">INMUEBLE</th>
					<th class="wd-20">PROPIETARIO</th>
					<th class="wd-20 pl-3">SALDO</th>
				</tr>
				<tr>
					<td class="pl-3">{{$property->numebreProperty}}</td>
					<td>{{$property->owner}}</td>
					<td id="monto" class="pl-3">{{mil($property->debit)}}</td>
				</tr>
			</table>
		</div>
	  <div class="card-body row justify-content-center">
	  	<div class="table-responsive">
			<table class="table table-hover">
				<thead>	
					<tr>
						<th class="teal-text" scope="row">FECHA</th>
						<th class="teal-text" scope="col">REFERENCIA</th>
						<th class="teal-text" scope="col">MONTO</th>
						<th class="teal-text" scope="col">PAGAR</th>
					</tr>
				</thead>
				<tbody>
		{!!Form::open(['url'=>'pago/deuda','class'=>'col-md-12'])!!}
			{{ csrf_field() }}
					@foreach($dues as $due)
						<tr>
							<th scope="row">{{ $due->month }}</th>
							<td>{{$due->number}}</td>
							<td>{{mil($due->amount)}}</td>
							<td class="text-center">
								<input type="checkbox" name="_amount[]" value="{{ $due->amount }}" class="check form-check-input" checked="checked">
								<input type="hidden" name="id" value="{{ $due->id }}">
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	  </div>
	</div>
</div>

<div class="col-md-5 mt-3">
	<div class="card">
		<div class="teal white-text text-center">
			<p class="h4">DATOS DE PAGO</p>
		</div>
	  	<div class="card-body ">
			<div class="row">
            	<div class="md-form mb-5 col-md-6">
	                <input type="date" id="date" name="date" class="form-control {{ $errors->has('date') ? ' is-invalid' : 'validate' }}" value="{{ old('date') }}" autofocus="on">
	                <label class="col" data-error="wrong" data-success="right" for="date">Fecha</label>
	                @if ($errors->has('date'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('date') }}</strong>
	                    </span>
	                @endif
	            </div>

				<div class="md-form mb-5 col-md-6">
	                <input type="text" id="reference" name="reference" class="form-control {{ $errors->has('reference') ? ' is-invalid' : 'validate' }}" value="{{ old('reference') }}" >
	                <label class="col" data-error="wrong" data-success="right" for="reference">Referencia</label>
	                @if ($errors->has('reference'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('reference') }}</strong>
	                    </span>
	                @endif
	            </div>
            </div>

            <div class="row">
            	<div class="md-form mb-5 col-md-6">
	                <input type="text" id="concept" name="concept" class="form-control {{ $errors->has('concept') ? ' is-invalid' : 'validate' }}" value="{{ old('concept') }}" >
	                <label class="col" data-error="wrong" data-success="right" for="concept">Concepto</label>
	                @if ($errors->has('concept'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('concept') }}</strong>
	                    </span>
	                @endif
	            </div>

				<div class="form-group mb-5 col-md-6">
					<label class="col">Forma de pago</label>
	                <select id="wayToPay" name="wayToPay" class="form-control {{ $errors->has('wayToPay') ? ' is-invalid' : 'validate' }}">
	                	<option value="">Seleccione una opcion</option>
	                	<option value="0">Transferencia</option>
	                	<option value="1">Deposito</option>
	                	<option value="2">Cheque</option>
	                	<option value="3">Tarjeta</option>
	                	<option value="4">Efectivo</option>
	                </select>
	                @if ($errors->has('wayToPay'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('wayToPay') }}</strong>
	                    </span>
	                @endif
	            </div>
	            
            </div>

            <div class="row">
        		<div class="_transfer hidden md-form mb-5 col-md-6">
	            	<input type="text" id="operationNumber" name="operationNumber" class="form-control {{ $errors->has('operationNumber') ? ' is-invalid' : 'validate' }}" value="{{ old('operationNumber') }}" >
	                <label class="col" data-error="wrong" data-success="right" for="operationNumber">Numero de operacion</label>
	                @if ($errors->has('operationNumber'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('operationNumber') }}</strong>
	                    </span>
	                @endif
	            </div>

	            <div class="_transfer hidden form-group mb-5 col-md-6">
	            	<label class="col">Banco emisor</label>
	                <select id="issuingBank" name="_issuingBank" class="form-control {{ $errors->has('issuingBank') ? ' is-invalid' : 'validate' }}">
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
        		<div class="_check hidden md-form mb-5 col-md-6">
	            	<input type="text" id="checkNumber" name="checkNumber" class="form-control {{ $errors->has('checkNumber') ? ' is-invalid' : 'validate' }}" value="{{ old('checkNumber') }}" >
	                <label class="col" data-error="wrong" data-success="right" for="checkNumber">Numero de cheque</label>
	                @if ($errors->has('checkNumber'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('checkNumber') }}</strong>
	                    </span>
	                @endif
	            </div>

	            <div class="_check hidden form-group mb-5 col-md-6">
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
        		<div class="_card hidden md-form mb-5 col-md-12">
	            	<input type="text" id="cardNumber" name="cardNumber" class="form-control {{ $errors->has('cardNumber') ? ' is-invalid' : 'validate' }}" value="{{ old('cardNumber') }}" >
	                <label class="col" data-error="wrong" data-success="right" for="cardNumber">Numero de tarjeta</label>
	                @if ($errors->has('cardNumber'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('cardNumber') }}</strong>
	                    </span>
	                @endif
	            </div>
            </div>

            <div class="row">
        		<div class="md-form mb-5 col-md-12">
	            	<input type="text" id="amount" name="amount" class="form-control {{ $errors->has('amount') ? ' is-invalid' : 'validate' }}" value="{{ $property->debit }}" autofocus="on">
	                <label class="col" data-error="wrong" data-success="right" for="amount">Monto</label>
	                @if ($errors->has('amount'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('amount') }}</strong>
	                    </span>
	                @endif
	            </div>
            </div>

            <input type="hidden" name="estate" value="{{ $property->id }}">

            <div class="row">
            	<div class="col-md-6">
            		<a href="{{url()->previous()}}" class="col btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="No realizar pago"><b>Cancelar</b></a>
                	<a id="recentPayments" class="col btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Ver pagos recientes"><b>Pagos</b></a>
            	</div>
            	<div class="col-md-6">
                	<button type="submint" class="col btn btn-sm btn-green" data-toggle="tooltip" data-placement="top" title="Realizar pago"><b>Pagar</b></button>
            	</div>
            </div>
           {!!Form::close()!!}
	  	</div>
	</div>
</div>
<!-- MODAL -->
<div class="modal fade" id="paymentsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pagos recientes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
					<table class="table table-hover">
						<thead>	
							<tr>
								<th class="teal-text" scope="row">FECHA</th>
								<th class="teal-text" scope="col">REFERENCIA</th>
								<th class="teal-text" scope="col">MONTO</th>
							</tr>
						</thead>
						<tbody>
							@foreach($payments as $payment)
							<tr>
								<th scope="row">{{ $payment->date }}</th>
								<td>{{$payment->reference}}</td>
								<td>{{mil($payment->amount)}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endsection

