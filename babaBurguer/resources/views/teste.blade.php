<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

      <title>Baba Burguer System</title>

    <script>
    window.print();
</script>

</head>
<body>
    <?php
//    $texto = 'TEXTO PARA IMPRIMIR'; // texto que será impresso
//
// if ( $handle = printer_open() ){ // impressora configurada no windows
// printer_set_option($handle, PRINTER_MODE, "RAW");
// printer_write($handle, $texto );
// printer_close($handle); }
?>
  <h4 align="center"> BABA BURGUER </h4>
  <h6 align="center" style="margin-top: -15px">  R. dos Expedicionários, 1051 <br> 83206-450 <br>  (41) 3423-7024 </h6>
  <h6 style="margin-top: -15px">----------------------------------------------------------------------</h6>
  <h6 align="center" style="margin-top: -15px"> NÃO É DOCUMENTO FISCAL </h6>
  <h6 style="margin-top: -15px">----------------------------------------------------------------------</h6>
  <p style="margin-top: -15px" align="right"> MESA: {{ $car->id_mesa }} </p>
  @foreach($pedidos as $pedidos)
    <h6 style="font-size: 10px; "> 1 - {{ $pedidos->nome }} = {{ $pedidos->preco }},00</h6>
  @endforeach
  <h6 style="margin-top: -15px">----------------------------------------------------------------------</h6>

 <h4 align="right"> Subtotal: {{ $car->valor }},00 </h4>
</body>
