@component('mail::message')

{{$message}}.<br>
<h1>Deudas pendientes hasta la fecha</h1>
<ul>
	@foreach($dues as $due)
		<li><p><h2>{{ monthYear($due->created_at->format('m-Y')) }}: {{ mil($due->amount) }}</h2></p></li>
	@endforeach
</ul>
@endcomponent