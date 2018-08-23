@extends('layouts.app')

@section('content')
<div class="col-md-10">
	<div class="card">
	  	<div class="card-body row justify-content-center">
		    <h4 class="card-title text-center teal-text">CREAR FACTURA</h4>
		    <form action="{{ url('factura/store')}}" method="POST" class="col-md-12" id="factura">
	            {{ csrf_field() }}
	            <div class="row">
	            	<div class="md-form col-md-4">
		                <input type="text" id="number" name="number" class="form-control {{ $errors->has('number') ? ' is-invalid' : 'validate' }}" value="{{ old('number') }}" required autofocus="on" autocomplete="off">
		                <label class="col" data-error="Error" data-success="Correcto" for="number">Numero del factura</label>
		                @if ($errors->has('number'))
		                    <span class="invalid-feedback" role="alert">
		                        <strong>{{ $errors->first('number') }}</strong>
		                    </span>
		                @endif
		            </div>
					<div class="col-md-4 pt-5">
						<span  id="success" class="font-italic text-success " ></span>
						<span  id="danger" class="font-italic text-danger " ></span>
					</div>
					<div class="md-form col-md-4">
		                <input type="text" id="date" name="date" class="date form-control {{ $errors->has('date') ? ' is-invalid' : 'validate' }}" value="{{ old('date') }}" required autofocus="on">
		                <label class="col" data-error="Error" data-success="Correcto" for="date">Fecha</label>
		                @if ($errors->has('date'))
		                    <span class="invalid-feedback" role="alert">
		                        <strong>{{ $errors->first('date') }}</strong>
		                    </span>
		                @endif
		            </div>
	            </div>

	            <div class="row">
	            	<div class="form-group col-md-4"><br>
		                <select name="businessName" id="businessName" class="form-control">
		                	<option value="">Nombre o razon social</option>
		                	@foreach($estate as $property)
		                		<option value="{{ $property->id }}">{{ $property->owner }}</option>
		                	@endforeach
		                </select>
		                @if ($errors->has('businessName'))
		                    <span class="invalid-feedback" role="alert">
		                        <strong>{{ $errors->first('businessName') }}</strong>
		                    </span>
		                @endif
		            </div>

		            <div class="md-form col-md-4">
		                <input type="text" id="document" name="document" class="form-control {{ $errors->has('document') ? ' is-invalid' : 'validate' }}" value="" required >
		                <label class="col" data-error="Error" data-success="Correcto" for="document">Rif/cedula</label>
		                @if ($errors->has('document'))
		                    <span class="invalid-feedback" role="alert">
		                        <strong>{{ $errors->first('document') }}</strong>
		                    </span>
		                @endif
		            </div>

		            <div class="md-form col-md-4">
		                <input type="text" id="phone" name="phone" class="form-control {{ $errors->has('phone') ? ' is-invalid' : 'validate' }}" value="" required >
		                <label class="col" data-error="Error" data-success="Correcto" for="phone">Telefono</label>
		                @if ($errors->has('phone'))
		                    <span class="invalid-feedback" role="alert">
		                        <strong>{{ $errors->first('phone') }}</strong>
		                    </span>
		                @endif
		            </div>
	            </div>
	            <div class="row">
	            	<div class="form-group col-md-4"><br>
		               <select id="wayToPay" name="wayToPay" class="form-control {{ $errors->has('wayToPay') ? ' is-invalid' : 'validate' }}">
		                	<option value="">Forma de pago</option>
		                	<option value="0">Transferencia</option>
		                	<option value="1">Deposito</option>
		                	<option value="2">Cheque</option>
		                	<option value="3">Tarjeta</option>
		                	<option value="4">Efectivo</option>
		                </select>
		                @if ($errors->has('businessName'))
		                    <span class="invalid-feedback" role="alert">
		                        <strong>{{ $errors->first('businessName') }}</strong>
		                    </span>
		                @endif
		            </div>
					
	        		<div class="_transfer hidden md-form col-md-4">
		            	<input type="text" id="operationNumber" name="operationNumber" class="form-control {{ $errors->has('operationNumber') ? ' is-invalid' : 'validate' }}" value="{{ old('operationNumber') }}" >
		                <label class="col" data-error="wrong" data-success="right" for="operationNumber">Numero de operacion</label>
		                @if ($errors->has('operationNumber'))
		                    <span class="invalid-feedback" role="alert">
		                        <strong>{{ $errors->first('operationNumber') }}</strong>
		                    </span>
		                @endif
		            </div>

		            <div class="_transfer hidden form-group col-md-4"><br>
		            	<select id="issuingBank" name="issuingBank" class="form-control {{ $errors->has('issuingBank') ? ' is-invalid' : 'validate' }}">
		                	<option value="">Banco emisor</option>
		                	@include('property.partials.optionBank')
		                </select>
		                @if ($errors->has('issuingBank'))
		                    <span class="invalid-feedback" role="alert">
		                        <strong>{{ $errors->first('issuingBank') }}</strong>
		                    </span>
		                @endif
		            </div>

	        		<div class="_check hidden md-form col-md-4">
		            	<input type="text" id="operationNumber" name="operationNumbe" class="form-control {{ $errors->has('operationNumber') ? ' is-invalid' : 'validate' }}"  >
		                <label class="col" data-error="wrong" data-success="right" for="operationNumber">Numero de cheque</label>
		                @if ($errors->has('operationNumber'))
		                    <span class="invalid-feedback" role="alert">
		                        <strong>{{ $errors->first('operationNumber') }}</strong>
		                    </span>
		                @endif
		            </div>

		            <div class="_check hidden form-group col-md-4">
		            	<select id="issuingBank" name="issuingBank" class="form-control {{ $errors->has('issuingBank') ? ' is-invalid' : 'validate' }}">
		                	<option value="">Banco emisor</option>
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
	        		<div class="_card hidden md-form col-md-4">
		            	<input type="text" id="operationNumbe" name="operationNumber" class="form-control {{ $errors->has('operationNumber') ? ' is-invalid' : 'validate' }}" value="{{ old('operationNumber') }}" >
		                <label class="col" data-error="wrong" data-success="right" for="operationNumbe">Numero de tarjeta</label>
		                @if ($errors->has('operationNumbe'))
		                    <span class="invalid-feedback" role="alert">
		                        <strong>{{ $errors->first('operationNumbe') }}</strong>
		                    </span>
		                @endif
		            </div>
		        </div>
	        
			<div class="row">
					<div class="row">
						<div class="md-form col-md-2">
		                <input type="text" id="quantity" name="quantity" class="form-control {{ $errors->has('quantity') ? ' is-invalid' : 'validate' }}" value="" >
		                <label class="col" data-error="Error" data-success="Correcto" for="quantity">Cantidad</label>
		                @if ($errors->has('quantity'))
		                    <span class="invalid-feedback" role="alert">
		                        <strong>{{ $errors->first('quantity') }}</strong>
		                    </span>
		                @endif
		            </div>

		            <div class="md-form col">
		                <input type="text" id="concept" name="concept" class="form-control {{ $errors->has('concept') ? ' is-invalid' : 'validate' }}" value="" >
		                <label class="col" data-error="Error" data-success="Correcto" for="concept">Concepto o descripcion</label>
		                @if ($errors->has('concept'))
		                    <span class="invalid-feedback" role="alert">
		                        <strong>{{ $errors->first('concept') }}</strong>
		                    </span>
		                @endif
		            </div>

		            <div class="md-form col-md-2">
		                <input type="text" id="total" name="total" class="form-control {{ $errors->has('total') ? ' is-invalid' : 'validate' }}" value="" >
		                <label class="col" data-error="Error" data-success="Correcto" for="total">Total</label>
		                @if ($errors->has('total'))
		                    <span class="invalid-feedback" role="alert">
		                        <strong>{{ $errors->first('total') }}</strong>
		                    </span>
		                @endif
		            </div>
		            <div class=" md-form col-md-2">
		                <a id="submintAgregar" class="btn btn-sm btn-default">Agregar</a>
		            </div>
				<div class="px-4 table-responsive">
	                <table class="table table-hover table-responsive-lg ">
	                    <thead>
	                        <tr>
	                            <th class="teal-text" scope="row">CANTIDAD</th>
	                            <th class="teal-text" scope="col">CONCEPTO O DESCRIPCION</th>
	                            <th class="teal-text" scope="col">TOTAL</th>
	                        </tr>
	                    </thead>
	                    <tbody id="_data">
	                    </tbody>
	                </table>
	                <div class="row">
	                	<div class="col-lg-6"></div>
	                	<div class="col-lg-6 text-right" >
	                		<div class="row">
	                			<div class="col-lg-7">Sub-Total Bs</div>
	                			<div class="col-lg-5 text-left"><h5 id="sGeneral"></h5></div>
	                		</div>
	                	</div>
	                </div>
	                <div class="row">
	                	<div class="col-lg-6"></div>
	                	<div class="col-lg-6 text-right" >
	                		<div class="row">
	                			<div class="col-lg-7">IVA(12%) Bs</div>
	                			<div class="col-lg-5 text-left"><h5 id="tIva"></h5></div>
	                		</div>
	                	</div>
	                </div>
	                <div class="row">
	                	<div class="col-lg-6"></div>
	                	<div class="col-lg-6 text-right" >
	                		<div class="row">
	                			<div class="col-lg-7">Total Bs</div>
	                			<div class="col-lg-5 text-left"><h5 id="tGeneral"></h5></div>
	                		</div>
	                	</div>
	                </div>
	            </div> 
			</div>
			<div id="inputHidden">
				
			</div>
			<input type="hidden" name="numberInput" id="numberInput">
			<input type="hidden" name="total" id="_total">
			<input type="hidden" name="iva" id="_iva">
			
			<div class="modal-footer d-flex justify-content-center col">
                <a href="{{url()->previous()}}" class="btn btn-danger">Cancelar</a>
                <button type="submint" id="submintFac" class="btn btn-default">Guardar</button>
            </div>
            </form>
	 	</div>
	</div>
</div>
@endsection