@extends('layouts.app')

@section('content')

<!-- Content Agencies-->
<div class="col-md-6">
    <div class="card">
        <div class="col-md-6 float-right">
            <a id="createAgencies" class="btn btn-primary btn-sm"><i class="fa fa-plus mr-1"></i> Agencia</a>
        </div>
        <div class="mt-1">
            <div class="row d-flex justify-content-center ">
                <div class="col-md-11">
                    <div class="accordion accordion-5" id="accordionEx5" role="tablist" aria-multiselectable="true">
                        @foreach($agencies as $agency)
                        <div class="card mb-4">
                            <div class="card-header p-0 z-depth-1" role="tab" id="heading30">
                                <a data-toggle="collapse" data-parent="#accordionEx5" href="#{{$agency->id}}" aria-expanded="true" aria-controls="collapse30">
                                    <img src="{{ $agency->logo }}" class="float-left rounded-circle z-depth-1-half avatar-pic mr-2" ></img>
                                    <h4 class="text-uppercase teal-text mb-0 py-3 mt-1">
                                        {{ $agency->name }}
                                    </h4>
                                </a>
                            </div>
                            <div id="{{ $agency->id }}" class="collapse" role="tabpanel" aria-labelledby="heading30" data-parent="#accordionEx5">
                                <div class="col-md-6 float-right">
                                    <a href="{{ url('agencias/'.$agency->id.'/edit') }}" class=" btn btn-teal btn-sm"><i class="fa fa-edit mr-1"></i> Editar</a>
                                    <a data-id="{{ $agency->id }}" class="deleteAgency btn btn-danger btn-sm"><i class="fa fa-close mr-1"></i> Eliminar</a>
                                </div>
                                <div class="card-body rgba-black-light white-text z-depth-1">
                                    <p class="p-md-1 mb-0">Nombre: {{ $agency->name }}</p>
                                    <p class="p-md-1 mb-0">Email : {{ $agency->email }}</p>
                                    <p class="p-md-1 mb-0">Persona de contacto: {{ $agency->personContact }}</p>
                                    <p class="p-md-1 mb-0">Telefono: {{ $agency->phone }}</p>
                                    <p class="p-md-1 mb-0">Direccion: {{ $agency->address }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content Agencies-->

<!-- Content Conformation of Payments-->
<div id="_shapePayments" class="col-md-6">
    <div class="card card-cascade narrower">
        <div class="view view-cascade gradient-card-header purple-gradient narrower py-4 mx-4 mb-3 d-flex justify-content-center align-items-center">
            <h4 class="white-text font-weight-bold text-uppercase mb-0">Table name</h4>
        </div>
        <div class="px-4 d-flex justify-content-center">
            <table class="table table-hover table-responsive mb-0">
                <thead>
                    <tr>
                        <th scope="row">#</th>
                        <th class="th-md">First Name</th>
                        <th class="th-md">Last Name</th>
                        <th class="th-md">Username</th>
                        <th class="th-md">Username</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>Mark</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <hr class="my-0">

        <!--Bottom Table UI-->
        <div class="d-flex justify-content-center">

            <!--Pagination -->
            <nav class="my-4 pt-2">
                <ul class="pagination pagination-circle pg-teal mb-0">
                    <li class="page-item disabled clearfix d-none d-md-block"><a class="page-link">First</a></li>
                    <li class="page-item disabled">
                        <a class="page-link" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                    </li>
                    <li class="page-item active"><a class="page-link">1</a></li>
                    <li class="page-item"><a class="page-link">2</a></li>
                    <li class="page-item"><a class="page-link">3</a></li>
                    <li class="page-item"><a class="page-link">4</a></li>
                    <li class="page-item"><a class="page-link">5</a></li>
                    <li class="page-item">
                        <a class="page-link" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                    </li>
                    <li class="page-item clearfix d-none d-md-block"><a class="page-link">Last</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div> 
<!-- Content Conformation of Payments-->

<!-- Content Create agencies-->
<div id="createAgency" class="col-md-6 hidden">
    <div class="card card-cascade narrower">    
        <div class="modal-header text-center">
            <h4 class="modal-title w-100 font-weight-bold">Nueva agencia</h4>
        </div>
        <form action="{{ url('agencias')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-body mx-3">
                <div class="md-form mb-5">
                    <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : 'validate' }}" value="{{ old('name') }}" required autofocus="on">
                    <label data-error="Datos erroneos" data-success="Datos correctos" for="name">Nombre de agencia</label>
                    @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="md-form mb-5">
                    <input type="text" id="decument" name="rif" class="form-control {{ $errors->has('document') ? ' is-invalid' : 'validate' }}" value="{{ old('document') }}" required">
                    <label data-error="Datos erroneos" data-success="Datos correctos" for="decument">Rif/Cédula</label>
                    @if ($errors->has('document'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('document') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="md-form mb-5">
                    <input type="email" id="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : 'validate' }}" value="{{ old('email') }}" required">
                    <label data-error="Datos erroneos" data-success="Datos correctos" for="email">Email</label>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="md-form mb-5">
                    <input type="text" id="personContact" name="personContact" class="form-control {{ $errors->has('personContact') ? ' is-invalid' : 'validate' }}" value="{{ old('personContact') }}" required">
                    <label data-error="Datos erroneos" data-success="Datos correctos" for="personContact">Persona de contacto</label>
                    @if ($errors->has('personContact'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('personContact') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="md-form mb-5">
                    <input type="text" id="address" name="address" class="form-control {{ $errors->has('address') ? ' is-invalid' : 'validate' }}" value="{{ old('address') }}" required">
                    <label data-error="Datos erroneos" data-success="Datos correctos" for="address">Direccion</label>
                    @if ($errors->has('address'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="md-form mb-5">
                    <input type="text" id="phone" name="phone" class="form-control {{ $errors->has('phone') ? ' is-invalid' : 'validate' }}" value="{{ old('phone') }}" required">
                    <label data-error="Datos erroneos" data-success="Datos correctos" for="phone">Telefono</label>
                    @if ($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                </div>
                
                <div class="md-form mb-5">
                    <input type="file" id="logo" name="logo" class="form-control{{ $errors->has('logo') ? ' is-invalid' : 'validate' }}" value="{{ old('logo') }}" required">
                    <label data-error="Datos erroneos" data-success="Datos correctos" for="logo"></label>
                    @if ($errors->has('logo'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('logo') }}</strong>
                        </span>
                    @endif
                </div>
                
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <a id="cancel" class="btn btn-danger">Cancelar</a>
                <button type="submint" class="btn btn-teal">Guardar</button>
            </div>
        </form>
    </div>
</div> 
<!-- Content Create agencies-->

@endsection