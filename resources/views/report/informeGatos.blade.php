@extends('layouts.pdf')

@section('content')
	<div>
		<div >{{ session('nameCondominium') }}</div>
		<div></div>
		<div >INFORME DE GASTOS {{ month($month)  }}/{{ date('Y') }}</div>
	</div>
	<table class="table page-break" >
		<thead>
			<tr id="encabezado">
				<th>CUENTA</th>
				<th>REFERENCIA</th>
				<th>DESCRIPCION</th>
				<th>IMPORTE</th>
				<th>CUOTA</th>
			</tr>
		</thead>
		<tbody>
			@foreach($expenses as $expense)
				<tr>
					<td>
						@foreach($bill as $account)
							@if($account->id == $expense->account)
								{{$account->name}}
							@endif
						@endforeach
					</td>
					<td>{{$expense->reference}}</td>
					<td>{{$expense->description}}</td>
					<td>{{mil($expense->amount)}}</td>
					<td>{{share($expense->share)}}</td>
				</tr>					
			@endforeach
		</tbody>
	</table>
@endsection