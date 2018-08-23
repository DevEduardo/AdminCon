@component('mail::message')

<div class="center titel">
	¡Hola! {{$name}}
</div>


{{$message}}.<br>

Su contraseña para acceder al sistema: {{$userPass}}


Gracias,<br>
Admincom.com
@endcomponent