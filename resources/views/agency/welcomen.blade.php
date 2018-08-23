@extends('layouts.app')

@section('content')
<!-- Content Agencies-->
<div class="col-sm-12 col-md-10 col-lg-6">
    <div class="card pd-3">
        <div class="col-md-12 float-right">
            <a href="{{ url('condominios/create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus mr-1"></i> Condominio</a>
        </div>
        <div class="">
            <ul class="list-group col-md-12 m-2">
                @foreach($condominiums as $condominium)
                    <li data-id="{{$condominium->id}}" class="list-group-item item">
                        <img src="{{$condominium->logo}}" class="avatar-pic mr-3">{{$condominium->name}}
                        <form action="{{url('home')}}" method="POST" id="condominium-{{$condominium->id}}">
                            <input type="hidden" name="condominium" value="{{ $condominium->id }}">
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<!-- Content Agencies-->
@endsection