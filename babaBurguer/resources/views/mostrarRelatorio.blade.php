@extends('principal')

@section('conteudo')

  <div class="form-inline">
    <div align="right" >
      <h3 style="color: #696969"> Data Emissão Relatório: <b><?php echo $date ?></b> </h3>
    </div>
    <div align="left" >


    </div>
  </div>
  <table class="table table-hover">

    <thead>
      <tr>
        <th style="text-align:center; font-size: 27px"> Mesa</th>
        <th style="text-align:center; font-size: 27px"> Total</th>
      </tr>
    </thead>
    <tbody>
      @foreach($mesas as $mesas)
      <?php $valor_formatado = number_format($mesas->valor, 2, ',', '.'); ?>

      <tr>
        <td align="center" style="font-size: 25px"> {{$mesas->id_mesa}} </td>
        <td align="center" style="font-size: 25px">  R$ {{$valor_formatado}} </td>
      </tr>
      @endforeach
    </tbody>
  </table> <hr>

  <?php $valor_total = number_format($total, 2, ',', '.'); ?>
  <div class="row">
    <img src="{{ url('/img/total_relatorio.png') }}" style="width: 67px; height: 67px; margin-left: 15px">
    <h1 style="color: green; margin-top: 20px; margin-left: 12px"> TOTAL: <b> {{ $valor_total }}</b> </h1>
  </div>
@stop
