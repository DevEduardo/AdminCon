@extends('layouts.app')

@section('content')

<!-- Content Agency Create-->
<div class="col-md-6">
    <div class="card card-cascade narrower">    
        <div class="modal-header text-center">
            <h4 class="modal-title w-100 font-weight-bold">Editar agencia</h4>
        </div>
            {!! Form::open(['url'=>'agencias/'.$agency->id, 'enctype'=>'multipart/form-data','method'=>'PUT']) !!}
                {{ csrf_field() }}
                <div class="modal-body mx-3">
                    <div class="md-form mb-5">
                        <input type="text" id="editname" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : 'validate' }}" value="{{ $agency->name }}"  required autofocus="on">
                        <label data-error="Error" data-success="Correcto" for="name">Nombre de agencia</label>
                        @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                    </div>

                    <div class="md-form mb-4">
                        <input type="text" id="editdecument" name="document" class="form-control {{ $errors->has('document') ? ' is-invalid' : 'validate' }}" value="{{ $agency->rif }}" required">
                        <label data-error="Error" data-success="Correcto" for="decument">Rif/Cédula</label>
                        @if ($errors->has('document'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('document') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="md-form mb-4">
                        <input type="email" id="editemail" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : 'validate' }}" value="{{ $agency->email }}"  required">
                        <label data-error="Error" data-success="Correcto" for="email">Email</label>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="md-form mb-4">
                        <input type="text" id="editpersonContact" name="personContact" class="form-control {{ $errors->has('personContact') ? ' is-invalid' : 'validate' }}" value="{{ $agency->personContact }}"  required">
                        <label data-error="Error" data-success="Correcto" for="personContact">Persona de contacto</label>
                        @if ($errors->has('personContact'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('personContact') }}</strong>
                                </span>
                            @endif
                    </div>

                    <div class="md-form mb-4">
                        <input type="text" id="editaddress" name="address" class="form-control {{ $errors->has('address') ? ' is-invalid' : 'validate' }}" value="{{ $agency->address }}" required">
                        <label data-error="Error" data-success="Correcto" for="address">Direccion</label>
                        @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                    </div>

                    <div class="md-form mb-4">
                        <input type="text" id="editphone" name="phone" class="form-control {{ $errors->has('phone') ? ' is-invalid' : 'validate' }}" value="{{ $agency->phone }}" required">
                        <label data-error="Error" data-success="Correcto" for="phone">Telefono</label>
                        @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                    </div>
                    
                    <div class="md-form mb-4">
                        <img src="{{ $agency->logo }}" class="float-left rounded-circle z-depth-1-half avatar-pic mr-2" ></img>
                        <input type="file" id="editlogo" name="logo" class="form-control{{ $errors->has('logo') ? ' is-invalid' : 'validate' }}" required">
                        <label data-error="Error" data-success="Correcto" for="logo"></label>
                        @if ($errors->has('logo'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('logo') }}</strong>
                            </span>
                        @endif
                    </div>
                    <input type="hidden" id="id">
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <a href="{{url()->previous()}}" class="btn btn-danger">Cancelar</a>
                    <button type="submint" class="btn btn-teal">Guardar</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div> 
<!-- Content Agency Create-->

@endsection