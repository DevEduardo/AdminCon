@extends('layouts.app')

@section('content')
<div class="col-sm-12 col-md-10 col-lg-6">
    <div class="card">
    	<div class="col-md-8 float-right">
            <a href="{{ url('condominios/create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus mr-1"></i> Condominio</a>
        </div>
        <div class="">
            <ul class="list-group col-md-12 m-2">
                @foreach($condominiums as $condominium)
                    <li class="list-group-item">
                        <img src="{{$condominium->logo}}" class="avatar-pic mr-3">{{$condominium->name}}
                        <div class="btn-group float-right mt-2" role="group" aria-label="Basic example">
						    <a href="{{url('condominios/'.$condominium->id.'/edit')}}" class="btn btn-md btn-primary"><i class="fa fa-edit pr-2" aria-hidden="true"></i></a>
						    @if($condominium->status == 1)
						    <a href="{{url('condominios/'.$condominium->id.'/lockOrUnlock')}}" class="btn btn-md btn-grey"><i class="fa fa-lock pr-2" aria-hidden="true"></i></a>
						    @else
						    <a href="{{url('condominios/'.$condominium->id.'/lockOrUnlock')}}" class="btn btn-md btn-default"><i class="fa fa-unlock pr-2" aria-hidden="true"></i></a>
						    @endif
						    <a class="btn btn-md btn-red"
                                        onclick="event.preventDefault();
                                        document.getElementById('delete-form').submit();">
                                        <i class="fa fa-close pr-2" aria-hidden="true"></i>
                                    </a>
									{!!Form::open(['url'=>'condominios/'.$condominium->id,'id'=>'delete-form','method'=>'DELETE'])!!}
                                        {{ csrf_field() }}
                                    {!!Form::close()!!}
						</div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection