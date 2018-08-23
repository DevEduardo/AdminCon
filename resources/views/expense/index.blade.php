@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="col-md-12">
            <div class="row teal white-text">
              <table class="col-md-12">
                <thead>
                  <tr>
                    <th>Gastos generales</th>
                    <th>No comunes</th>
                    <th>Cuotas extras</th>
                    <th>Total general</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><b>{{ mil($totals['totalCommon']) }}</b></td>
                    <td><b>{{ mil($totals['totalNotCommon']) }}</b></td>
                    <td><b>{{ mil($totals['totalExtra']) }}</b></td>
                    <td><b>{{ mil($totalGeneral) }}</b></td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>
    	<div class="col-md-12 mt-4">
            <div class="row">
                <div class="col-md-3">
                    <form action="{{url('gastos/mes')}}" method="post" class="form-inline" id="formMes">
                        {{ csrf_field() }}
                        <div class="mg-l3 mg-r2">
                            <select name="month" id="month" class="form-control" >
                              <option value="">Mes</option>
                              @if($month == '01')
                              <option value="01" selected>Enero</option>
                              @endif
                               @if($month == '02')
                              <option value="02" selected>Febrero</option>
                              @endif
                               @if($month == '03')
                              <option value="03" selected>Marzo</option>
                              @endif
                               @if($month == '04')
                              <option value="04" selected>Abril</option>
                              @endif
                               @if($month == '05')
                              <option value="05" selected>Mayo</option>
                              @endif
                               @if($month == '06')
                              <option value="06" selected>Junio</option>
                              @endif
                               @if($month == '07')
                              <option value="07" selected>Julio</option>
                              @endif
                               @if($month == '08')
                              <option value="08" selected>Agosto</option>
                              @endif
                               @if($month == '09')
                              <option value="09" selected>Septiembre</option>
                              @endif
                               @if($month == '10')
                              <option value="10" selected>Octubre</option>
                              @endif
                               @if($month == '11')
                              <option value="11" selected>Noviembre</option>
                              @endif
                               @if($month == '12')
                              <option value="12" selected>Diciembre</option>
                              @endif
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
                          <div class="">
                            <select name="anio" id="anio" class="form-control">
                              <option value="">Año</option>
                              @if($year == 2010)
                                <option value="2010" selected>2010</option>
                              @endif
                              @if($year == 2011)
                                <option value="2011" selected>2011</option>
                              @endif
                              @if($year == 2012)
                                <option value="2012" selected>2012</option>
                              @endif
                              @if($year == 2013)
                                <option value="2013" selected>2013</option>
                              @endif
                              @if($year == 2014)
                                <option value="2014" selected>2014</option>
                              @endif
                              @if($year == 2015)
                                <option value="2015" selected>2015</option>
                              @endif
                              @if($year == 2016)
                                <option value="2016" selected>2016</option>
                              @endif
                              @if($year == 2018)
                                <option value="2018" selected>2018</option>
                              @endif
                              @if(@year == 2018)
                                <option value="2018" selected>2018</option>
                              @endif
                              @if($year == 2019)
                                <option value="2019" selected>2019</option>
                              @endif
                              @if($year == 2020)
                                <option value="2020" selected>2020</option>
                              @endif
                              @if($year == 2021)
                                <option value="2021" selected>2021</option>
                              @endif
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
                            </select>
                        </div>
                    </form>
                </div>
                <div class="col-md-9">
                  @if(session('calculationCondominium') == 0)
                    @if($calculation && $calculatedFee )
                      <button id="funds" class="btn btn-sm blue darken-4" data-toggle="tooltip" data-placement="top" title="Realizar calculos de fondos" disabled="on">Calcular fondos</button>
                      <button id="cuotas" class="btn btn-sm btn-teal" data-toggle="tooltip" data-placement="top" title="Realizar calculos de cuotas" disabled="on">Calcular cuotas</button>
                    @elseif($calculation && $calculatedFee == false)
                      <button id="funds" class="btn btn-sm blue darken-4" data-toggle="tooltip" data-placement="top" title="Realizar calculos de fondos" disabled="on">Calcular fondos</button>
                      <button id="cuotas" class="btn btn-sm btn-teal" data-toggle="tooltip" data-placement="top" title="Realizar calculos de cuotas">Calcular cuotas</button>
                    @else
                      <button id="funds" class="btn btn-sm blue darken-4" data-toggle="tooltip" data-placement="top" title="Realizar calculos de fondos">Calcular fondos</button>
                      <button id="cuotas" class="btn btn-sm btn-teal" data-toggle="tooltip" data-placement="top" title="Realizar calculos de cuotas" disabled="on">Calcular cuotas</button>
                    @endif
                  @else
                    @if($calculatedFee )
                      <button id="cuotas" class="btn btn-sm btn-teal" data-toggle="tooltip" data-placement="top" title="Realizar calculos de cuotas" disabled="on">Calcular cuotas</button>
                    @elseif($calculatedFee == false)
                      <button id="cuotas" class="btn btn-sm btn-teal" data-toggle="tooltip" data-placement="top" title="Realizar calculos de cuotas">Calcular cuotas</button>
                    @else
                      <button id="cuotas" class="btn btn-sm btn-teal" data-toggle="tooltip" data-placement="top" title="Realizar calculos de cuotas" disabled="on">Calcular cuotas</button>
                    @endif
                  @endif
                  
                    
                    <a href="{{ url('copy/expense') }}" class="btn btn-sm btn-red" data-toggle="tooltip" data-placement="top" title="Copiar gastos actuales al mes siguiente">Copiar</a>
                    <a href="{{ url('informe/gastos/'.date('m')) }}" target="blanck" class="btn btn-sm btn-green" data-toggle="tooltip" data-placement="top" title="Exportar a PDF">PDF</a>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
          <form action="{{ url('gastos') }}" method="post" class="form-inline">
            {{ csrf_field() }}
            <div class="form-group">
              <select class="form-control" id="cuenta" name="account" required>
                <option value="0"> Cuenta</option>
                @foreach($bills as $bill)
                  <option value="{{ $bill->id }}">{{ $bill->name }}</option>
                @endforeach
              </select>
            </div>
            {!!Field::text('reference',['label'=>' ','class'=>'','ph'=>'Referencia'])!!}
            {!!Field::text('description',['label'=>' ','class'=>'','ph'=>'Descripción'])!!}
            {!!Field::text('amount',['label'=>' ','class'=>'money','ph'=>'importe'])!!}
            <div class="form-group">
              <select class="form-control" id="_Share" name="share">
                <option value="NULL"> Tipo de cuota</option>
                <option value="1"> No comun</option>
                <option value="2"> Extra</option>
              </select> 
            </div>
            <button type="submint" class="btn btn-sm btn-teal"><b>Agregar</b></button>
            <div id="extra" class="hidden col-md-12 mt-3">
              <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                  <h5>Calculo</h5>
                  <div class="form-check">
                      <input class="form-check-input checkClear" name="calculation" value="1" type="radio" id="inmuebles">
                      <label class="form-check-label mr-5" for="inmuebles">Importe/N° de inmuebles</label>
                      <input class="form-check-input checkClear" name="calculation" value="2" type="radio" id="auxiliar">
                      <label class="form-check-label" for="auxiliar">Segun cuota auxiliar</label>
                  </div>
                </div>
                <div class="col-md-12 text-center">
                  <a id="MarkAll" class="btn btn-sm btn-teal">Marcar todo</a>
                  <a id="uncheck" class="btn btn-sm btn-red">Desmarcar todo</a>
                  <button type="submint" id="SubmintClear" class="btn btn-sm btn-green">Aceptar</button>
                  <a id="closeExtra" class="btn btn-sm btn-orange">Cancelar</a>
                </div>
                <div class="row justify-content-center">
                  <div  class="px-4 col-md-12">
                    <table class="col-md-12 table table-hover">
                        <thead>
                            <tr>
                                <th class="teal-text" scope="col">#</th>
                                <th class="teal-text" scope="col">Propietario</th>
                                <th class="teal-text" scope="col">Aplica</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($estate as $property)
                          <tr>
                            <th class="wd-20">{{ $property->numebreProperty }}</th>
                            <td class="wd-60">{{ $property->owner }}</td>
                            <td class=" wd-20 text-center"><input class="apply form-check-input" name="apply[]" value="{{ $property->id }}" type="checkbox" id="auxiliar"></td>
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
                  </form>
                  <!-- FIN DEL FORMULARIO DE GASTOS -->
                  </div> 
                </div>
              </div>
            </div>
          </div>
        <div  class="row justify-content-center">
            <div  class="px-4 table-responsive">
                <table id="expenseTable" class="table table-hover table-responsive-lg">
                    <thead>
                        <tr>
                            <th class="teal-text" scope="row">#</th>
                            <th class="teal-text" scope="col">Cuenta</th>
                            <th class="teal-text" scope="col">referencia</th>
                            <th class="teal-text" scope="col">Descripcion</th>
                            <th class="teal-text" scope="col">Importe</th>
                            <th class="teal-text" scope="col">Tipo de cuota</th>
                            <th class="teal-text" scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($expenses as $key => $expense)
                        <tr id="expense-{{$expense->id}}" >
                          <th class="teal-text"><b>{{ $key + 1 }}</b></th>
                          <td>
                            @foreach($billss as $bill)
                              @if($bill->id == $expense->account)
                                {{ $bill->name }}
                              @endif
                            @endforeach
                          </td>
                          <td>{{ $expense->reference }}</td>
                          <td>{{ $expense->description }}</td>
                          <td>{{ mil($expense->amount) }}</td>
                          <td>{{ share($expense->share) }}</td>
                          <td>
                            <a data-id="{{$expense->id}}" class="expense teal-text mr-2" data-toggle="tooltip" data-placement="top" title="Editar Gasto"><i class="fa fa-2x fa-edit"></i></a>
                            <a class="deleteExpense red-text mr-2" data-id="{{$expense->id}}"><i class="fa fa-2x fa-trash" ></i>
                            </a>
                          </td>
                        </tr>
                        <tr id="_expense-{{$expense->id}}" class="hidden">
                          {!!Form::open(['url'=>'gastos/'.$expense->id, 'id'=>'form-'.$expense->id,'method'=>'PUT'])!!}
                            {{ csrf_field() }}
                            <td>{{ $key + 1 }}</td>
                            <td>
                              <select class="form-control" id="cuenta" name="account">
                                <option > Cuenta</option>
                                @foreach($bills as $bill)
                                @if($bill->id == $expense->account)
                                  <option value="{{ $bill->id }}" selected>{{ $bill->name }}</option>
                                @endif
                                @endforeach
                              </select>
                            </td>
                            <td><input type="text" class="form-control" name="reference" value="{{ $expense->reference }}"></td>
                            <td><input type="text" class="form-control" name="description" value="{{ $expense->description }}"></td>
                            <td><input type="text" class="form-control" name="amount" value="{{ $expense->amount }}"></td>
                            <td>
                              <select class="form-control" id="cuenta" name="share">
                                <option> Cuota</option>
                                @if($expense->share == 0)
                                  <option value="0" selected> No comun</option>
                                @else
                                  <option value="0"> No comun</option>
                                @endif
                                
                                @if($expense->share == 1)
                                  <option value="1" selected> Extra</option>
                                @else
                                  <option value="1"> Extra</option>
                                @endif
                                
                              </select>
                            </td>
                            <td>
                              <a data-id="{{$expense->id}}" class="submint teal-text" data-toggle="tooltip" data-placement="top" title="Guardar cambios"><i class="fa fa-2x fa-save"></i></a>
                              <a data-id="{{$expense->id}}" class="closee red-text ml-2" data-toggle="tooltip" data-placement="top" title="Cancelar edicion"><i class="fa fa-2x fa-close"></i></a> 
                            </td>
                            <td></td>
                          {!!Form::close()!!}
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>  
        </div>
    </div>
</div>
<div class="modal fade " id="cuotasModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cuotas generadas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="cuotasGeneradas"></div>
            </div>
            <div class="modal-footer">
                <button type="button" id="_cuotasCerrar" class="btn btn-sm btn-teal teal-text" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endsection