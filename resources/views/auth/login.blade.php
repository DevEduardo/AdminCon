@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-sm-12 mt-4">
            <div class="card">
                <div class="card-body row justify-content-center">
                    <form method="POST" action="{{ route('login') }}" class="col-md-10" id="form-login">
                        {{ csrf_field() }}
                        <p class="h4 text-center py-4"><img src="{{asset('img/logo.gif')}}" alt=""></p>
                        <div class="md-form">
                            <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required autofocus>
                            <label for="email" class="font-weight-light">Correo</label>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="md-form">
                            <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"  required>
                            <label for="password" class="font-weight-light">Contraseña</label>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="row py-4 mt-3">
                            <div class="col-lg-12 text-center"><button class="btn btn-teal" type="submit">Ingresar</button></div>
                            <div class="col-lg-12"><a href="{{ url('password/reset') }}" class="text-left">Ha olvidado su contraseña??</a></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
