<!-- Content Agency Create-->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Nueva agencia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('agencias')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body mx-3">
                    <div class="md-form mb-5">
                        <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : 'validate' }}" value="{{ old('name') }}" required autofocus="on">
                        <label data-error="wrong" data-success="right" for="name">Nombre de agencia</label>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="md-form mb-4">
                        <input type="text" id="decument" name="rif" class="form-control {{ $errors->has('document') ? ' is-invalid' : 'validate' }}" value="{{ old('document') }}" required">
                        <label data-error="wrong" data-success="right" for="decument">Rif/Cédula</label>
                        @if ($errors->has('document'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('document') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="md-form mb-4">
                        <input type="email" id="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : 'validate' }}" value="{{ old('email') }}" required">
                        <label data-error="wrong" data-success="right" for="email">Email</label>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="md-form mb-4">
                        <input type="text" id="personContact" name="personContact" class="form-control {{ $errors->has('personContact') ? ' is-invalid' : 'validate' }}" value="{{ old('personContact') }}" required">
                        <label data-error="wrong" data-success="right" for="personContact">Persona de contacto</label>
                        @if ($errors->has('personContact'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('personContact') }}</strong>
                                </span>
                            @endif
                    </div>

                    <div class="md-form mb-4">
                        <input type="text" id="address" name="address" class="form-control {{ $errors->has('address') ? ' is-invalid' : 'validate' }}" value="{{ old('address') }}" required">
                        <label data-error="wrong" data-success="right" for="address">Direccion</label>
                        @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                    </div>

                    <div class="md-form mb-4">
                        <input type="text" id="phone" name="phone" class="form-control {{ $errors->has('phone') ? ' is-invalid' : 'validate' }}" value="{{ old('phone') }}" required">
                        <label data-error="wrong" data-success="right" for="phone">Telefono</label>
                        @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                    </div>
                    
                    <div class="md-form mb-4">
                        <input type="file" id="logo" name="logo" class="form-control{{ $errors->has('logo') ? ' is-invalid' : 'validate' }}" value="{{ old('logo') }}" required">
                        <label data-error="wrong" data-success="right" for="logo"></label>
                        @if ($errors->has('logo'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('logo') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submint" class="btn btn-default">Cancelar</button>
                    <button type="submint" class="btn btn-default">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Content Agency Create-->