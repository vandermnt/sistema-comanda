@extends('principal')

@section('conteudo')

<div class="row">
  <div class="bola" style="background-color: green; margin-left: 15px; border: none"> </div> <p style="margin-left: 7px; color: black"><b> Livre </b></p>
  <div class="bola" style="background-color: red; margin-left: 15px; border: none"> </div> <p style="margin-left: 7px; color: black"> <b> Ocupada </b></p>
</div>

<div class="row">
@foreach ($mesas as $mesas)
  @if($mesas->status == false)
    <div class="col-sm-2"style="margin-top: 5px">
       <button type="button" class="btn btn-success btn-lg btn-block" style="background-color: "><b> {{ $mesas->id }} </b></button>
    </div>
    @else
      <div class="col-sm-2"style="margin-top: 5px">
        <a href=""> <button type="button" class="btn btn-danger btn-lg btn-block"><b> {{ $mesas->id }} </b></button> </a>
      </div>
  @endif

@endforeach
</div>
@stop
