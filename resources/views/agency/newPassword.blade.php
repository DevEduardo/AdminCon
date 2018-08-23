@extends('layouts.app')

@section('content')
<div class="col-md-4">
    <div class="card">
      <div class="card-body row justify-content-center">
        <h4 class="card-title text-center teal-text">CAMBIAR CONTRASEÑA</h4>
        <form action="{{ url('password')}}" method="POST" class="col-md-12">
            {{ csrf_field() }}
            <div class="row">
                <div class="md-form mb-5 col-md-12">
                    <input type="password" id="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : 'validate' }}" required autofocus="on">
                    <label class="col" data-error="Error" data-success="Correcto" for="password">Nueba Contraseña</label>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="md-form mb-5 col-md-12">
                    <input type="password" id="password-confirm" name="password_confirmation" class="form-control {{ $errors->has('password-confirm') ? ' is-invalid' : 'validate' }}" required>
                    <label class="col" data-error="Error" data-success="Correcto" for="password-confirm">Confirmar Contraseña</label>
                    @if ($errors->has('password-confirm'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password-confirm') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="modal-footer d-flex justify-content-center">
                <a href="{{url()->previous()}}" class="btn btn-danger">Cancelar</a>
                <button type="submint" class="btn btn-default">Guardar</button>
            </div>
        </form>
      </div>
    </div>
</div>
@endsection