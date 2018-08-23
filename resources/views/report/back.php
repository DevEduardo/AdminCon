@extends('layouts.pdf')

@section('content')
	@foreach($estate as $property)
	<div>
		<div >{{ session('nameCondominium') }}</div>
		<div></div>
		<div >AVISO DE COBRO {{ month($month)  }}/{{ date('Y') }}</div>
	</div>
	<table class="table page-break" >
		<thead>
			<tr>
				<td><b>Inmueble: {{ $property->numebreProperty }}</b></td>
				<td><b>Propietario: {{ $property->owner }}</b></td>
				<td><b>alicuota: {{ $property->aliquot }}</b></td>
			</tr>
			<tr id="encabezado">
				<th>DESCRIPCION</th>
				<th>IMPORTE</th>
				<th>PARTICIPACION</th>
			</tr>
		</thead>
		<tbody>
			<tr >
				<th colspan="4">GASTOS GENERALES</th>
			</tr>
			@foreach($dues as $due)
				@if($due->share == 0)
					<tr>
						<td>{{ $due->description }}</td>
						<td class="center">{{ mil($due->amount) }}</td>
						<td class="center">{{ participation($due->amount, $property->aliquot) }}</td>
					</tr>
				@endif					
			@endforeach
			<tr>
				<td><b>TOTAL GASTOS GENERALES</b></td>
				<td class="center"><b>{{ mil($fondos['totalCommon']) }}</b></td>
				<td class="center"><b>{{ participation($fondos['totalCommon'], $property->aliquot) }}</b></td>
			</tr>
			<tr >
				<th colspan="4">GASTOS EXTRAS</th>
			</tr>
			@foreach($dues as $due)
				@if($due->share == 2)
					<tr>
						<td>{{ $due->description }}</td>
						<td class="center">{{ mil($due->amount) }}</td>
						<td class="center">{{ participation($due->amount, $property->aliquot) }}</td>
					</tr>
				@endif					
			@endforeach
			<tr>
				<td><b>TOTAL GASTOS EXTRA</b></td>
				<td class="center"><b>{{ mil($fondos['totalExtra']) }}</b></td>
				<td class="center"><b>{{ participation($fondos['totalExtra'], $property->aliquot) }}</b></td>
			</tr>
			<tr>
				<th colspan="4">GASTOS NO COMUNES</th>
			</tr>
			@foreach($dues as $due)
				@if($due->share == 1)
					<tr>
						<td>{{ $due->description }}</td>
						<td class="center">{{ mil($due->amount) }}</td>
						<td class="center">{{ participation($due->amount, $property->aliquot) }}</td>
					</tr>
				@endif					
			@endforeach
			<tr>
				<td><b>TOTAL GASTOS NO COMUES</b></td>
				<td class="center"><b>{{ mil($fondos['totalNotCommon']) }}</b></td>
				<td class="center"><b>{{ participation($fondos['totalNotCommon'], $property->aliquot) }}</b></td>
			</tr>
			<tr>
				<th colspan="4" >FONDOS</th>
			</tr>
			<tr>
				<td>fondos de reserva</td>
				<td class="center">{{ mil($fondos['reserveFund']) }}</td>
				<td class="center">{{ participation($fondos['reserveFund'], $property->aliquot) }}</td>
			</tr>
			<tr >
				<th colspan="4" >GASTOS ADMINISTRATIVOS</th>
			</tr>
			<tr>
				<td>honorarios profecionales</td>
				<td class="center">{{ mil($fondos['fee']) }}</td>
				<td class="center">{{ participation($fondos['fee'], $property->aliquot) }}</td>
			</tr>
			<tr>
				<td>iva</td>
				<td class="center">{{ mil($fondos['iva']) }}</td>
				<td class="center">{{ participation($fondos['iva'], $property->aliquot) }}</td>
			</tr>
			<tr id="total">
				<td><b>TOTAL GASTOS DEL MES</b></td>
				<td class="center"><b>{{ mil($fondos['totalMes']) }}</b></td>
				<td class="center"></td>
			</tr>
			<tr id="total">
				<td>TOTAL CONDOMINIO</td>
				<td class="center"><b></b></td>
				<td class="center"><b>{{ participation($fondos['totalMes'], $property->aliquot) }}</b></td>
			</tr>
			<tr>
				<td>
					{{ session('messageCondominium') }}
				</td>
			</tr>
		</tbody>
	</table>
	@endforeach
@endsection