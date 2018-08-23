@extends('layouts.pdf')

@section('content')
<div>
	<div >{{ session('nameCondominium') }}</div>
	<div></div>
	<div >CUOTAS PENDIENTES {{ $year }}</div>
</div>
<table class="table table2 page-break " >
	<thead>
		<tr id="encabezado">
			<th>INMUEBLE</th>
			<th>PROPIETARIO</th>
			<th>DEUDA</th>
			<th class="text-center">ENE</th>
			<th class="text-center">FEB</th>
			<th class="text-center">MAR</th>
			<th class="text-center">ABR</th>
			<th class="text-center">MAY</th>
			<th class="text-center">JUN</th>
			<th class="text-center">JUL</th>
			<th class="text-center">AGO</th>
			<th class="text-center">SEP</th>
			<th class="text-center">OCT</th>
			<th class="text-center">NOV</th>
			<th class="text-center">DIC</th>
			<th class="text-center">TOTAL</th>
		</tr>
	</thead>
	<tbody>
		@foreach($estate as $property)
			<tr>
				<td>{{$property->numebreProperty}}</td>
				<td>{{$property->owner}}</td>
				<td>
					@foreach($yearLasts as $total)
						@if($total->property == $property->id)
						{{mil($total->deuda)}}
						@endif
					@endforeach
				</td>
				<td class="center">
					@foreach($dues as $due)
						@if($due->property == $property->id && monthDue($due->month)== '01')
						{{mil($due->amount)}}
						@endif
					@endforeach
				</td>
				<td class="center">
					@foreach($dues as $due)
						@if($due->property == $property->id && monthDue($due->month)== '02')
						{{mil($due->amount)}}
						@endif
					@endforeach
				</td>
				<td class="center">
					@foreach($dues as $due)
						@if($due->property == $property->id && monthDue($due->month)== '03')
						{{mil($due->amount)}}
						@endif
					@endforeach
				</td>
				<td class="center">
					@foreach($dues as $due)
						@if($due->property == $property->id && monthDue($due->month)== '04')
						{{mil($due->amount)}}
						@endif
					@endforeach
				</td>
				<td class="center">
					@foreach($dues as $due)
						@if($due->property == $property->id && monthDue($due->month)== '05')
						{{mil($due->amount)}}
						@endif
					@endforeach
				</td>
				<td class="center">
					@foreach($dues as $due)
						@if($due->property == $property->id && monthDue($due->month)== '06')
						{{mil($due->amount)}}
						@endif
					@endforeach
				</td>
				<td class="center">
					@foreach($dues as $due)
						@if($due->property == $property->id && monthDue($due->month)== '07')
						{{mil($due->amount)}}
						@endif
					@endforeach
				</td>
				<td class="center">
					@foreach($dues as $due)
						@if($due->property == $property->id && monthDue($due->month)== '08')
						{{mil($due->amount)}}
						@endif
					@endforeach
				</td>
				<td class="center">
					@foreach($dues as $due)
						@if($due->property == $property->id && monthDue($due->month)== '09')
						{{mil($due->amount)}}
						@endif
					@endforeach
				</td>
				<td class="center">
					@foreach($dues as $due)
						@if($due->property == $property->id && monthDue($due->month)== '10')
						{{mil($due->amount)}}
						@endif
					@endforeach
				</td>
				<td class="center">
					@foreach($dues as $due)
						@if($due->property == $property->id && monthDue($due->month)== '11')
						{{mil($due->amount)}}
						@endif
					@endforeach
				</td>
				<td class="center">
					@foreach($dues as $due)
						@if($due->property == $property->id && monthDue($due->month)== '12')
						{{mil($due->amount)}}
						@endif
					@endforeach
				</td>
				<td>
					@foreach($sum as $due)
						@if($due->property == $property->id )
							{{ mil($due->total) }}
						@endif
					@endforeach
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
@endsection