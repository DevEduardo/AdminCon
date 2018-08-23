@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-4 col-sm-12 mt-5">
            <div class="card">
                <div class="card-body row justify-content-center">
                    <form method="POST" action="{{ route('password.email') }}" class="col-md-12" id="form-login">
                        {{ csrf_field() }}
                        <p class="h4 text-center py-5"><img src="{{asset('img/logo.gif')}}" alt=""></p>
                        <div class="md-form">
                            <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required autofocus>
                            <label for="email" class="font-weight-light">Correo electronico</label>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div><br><br>
                        <button class="btn btn-teal btn-block" type="submit">Recuperar contraseña</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
