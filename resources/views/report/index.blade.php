@extends('layouts.app')

@section('content')
<!-- Content Agencies-->
<div class="col-sm-12 col-md-10 col-lg-6">
    <div class="card pd-3">
        <div class="col-md-12">
            <h4 class="card-title text-center teal-text">INFORMES DEL SISTEMA</h4>
        </div>
        <div class="">
            <ul class="list-group col-md-12 m-2">
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-lg-5">
                            <h4>Informe de gastos</h4>
                        </div>
                        <div class="col-lg-7 ">
                            <div class="row">
                                <div class="col-lg-9">
                                    <select id="month" class="form-control">
                                        <option value="">Selecciones mes</option>
                                        <option value="01">Enero</option>
                                        <option value="02">Febrero</option>
                                        <option value="03">Marzo</option>
                                        <option value="04">Abril</option>
                                        <option value="05">Mayo</option>
                                        <option value="06">Junio</option>
                                        <option value="07">Julio</option>
                                        <option value="08">Agosto</option>
                                        <option value="09">Septiembre</option>
                                        <option value="10">Octubre</option>
                                        <option value="11">Noviembre</option>
                                        <option value="12">Diciembre</option>
                                    </select>
                                </div>
                                 <div class="col-lg-3">
                                      <a id="_gastos" href="{{ url('informe/gastos') }}" target="blanck" class="col-lg-5 mt-0"><i class="fa fa-2x fa-file-pdf-o"></i></a>
                                 </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-lg-5">
                            <h4>Aviso de cobro</h4>
                        </div>
                        <div class="col-lg-7 ">
                            <div class="row">
                                <div class="col-lg-9">
                                    <select id="monthCobro" class="form-control">
                                        <option value="">Selecciones mes</option>
                                        <option value="01">Enero</option>
                                        <option value="02">Febrero</option>
                                        <option value="03">Marzo</option>
                                        <option value="04">Abril</option>
                                        <option value="05">Mayo</option>
                                        <option value="06">Junio</option>
                                        <option value="07">Julio</option>
                                        <option value="08">Agosto</option>
                                        <option value="09">Septiembre</option>
                                        <option value="10">Octubre</option>
                                        <option value="11">Noviembre</option>
                                        <option value="12">Diciembre</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <a id="_cobro" href="{{ url('aviso/cobro') }}" target="blanck" class="col-lg-5 mt-0"><i class="fa fa-2x fa-file-pdf-o"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-lg-5">
                            <h4>Cuotas pendientes</h4>
                        </div>
                        <div class="col-lg-7 ">
                            <div class="row">
                                <div class="col-lg-9">
                                    <select id="year" class="form-control">
                                        <option value="">Selecciones año</option>
                                        <option value="2010">2010</option>
                                        <option value="2011">2011</option>
                                        <option value="2012">2012</option>
                                        <option value="2013">2013</option>
                                        <option value="2014">2014</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 text-right">
                                    <a id="_cuotas" href="{{ url('cuotas/pendientes') }}" target="blanck" class="col-lg-5 mt-0"><i class="fa fa-2x fa-file-pdf-o"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <!-- <div class="row">
                        <div class="col-lg-5">
                            <h4>Facturacion</h4>
                        </div>
                        <div class="col-lg-7 ">
                            <div class="row">
                                <div class="col-lg-9">
                                    <select id="monthFactura" class="form-control">
                                        <option value="">Selecciones mes</option>
                                        <option value="01">Enero</option>
                                        <option value="02">Febrero</option>
                                        <option value="03">Marzo</option>
                                        <option value="04">Abril</option>
                                        <option value="05">Mayo</option>
                                        <option value="06">Junio</option>
                                        <option value="07">Julio</option>
                                        <option value="08">Agosto</option>
                                        <option value="09">Septiembre</option>
                                        <option value="10">Octubre</option>
                                        <option value="11">Noviembre</option>
                                        <option value="12">Diciembre</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 text-right">
                                    <a id="_facturas" href="{{ url('facturacion') }}" target="blanck" class="col-lg-5 mt-0"><i class="fa fa-2x fa-file-pdf-o"></i></a>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Content Agencies-->
@endsection