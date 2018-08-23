@extends('layouts.app')

@section('content')
<div class="col-md-6">
  <div class="card">
    <div class="card-body row justify-content-center">
      <h4 class="card-title text-center"><a>Enivar correo</a></h4>
      <form action="{{ url('email/admin')}}" method="POST" enctype="multipart/form-data" class="col-md-12">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="subject">Asunto</label>
          <input type="text" id="subject" name="subject" class="form-control">
          @if ($errors->has('subject'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('subject') }}</strong>
              </span>
          @endif
        </div>

        <div class="form-group">
            <label for="">Mensaje</label>
            <textarea name="message" id="message" class="form-control" cols="5" rows="5"></textarea>
            @if ($errors->has('message'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('message') }}</strong>
                </span>
            @endif
        </div>

        <input type="hidden" name="emailUser" value="{{ Auth()->user()->email }}">

        <div class="modal-footer d-flex justify-content-center">
            <a href="{{url()->previous()}}" class="btn btn-danger">Cancelar</a>
            <button type="submint" class="btn btn-default">Enviar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection