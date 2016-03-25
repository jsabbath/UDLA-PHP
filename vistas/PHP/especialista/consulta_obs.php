<?php 

$consulta = mysql_query("SELECT * FROM observacion_general WHERE paciente_id = '{$id}' ORDER BY id DESC ");
if (mysql_num_rows($consulta) > 0) 
{ ?>
	<div id="example-tip">
	<strong>Observaciones registradas:</strong>
	
	<?php
	while ($list_obs = mysql_fetch_assoc($consulta)) 
	{ ?>	
			<a href="#" class="tip link-tip btn btn-mini" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $list_obs['observacion']; ?>"><?php echo fechaALetras($list_obs['fecha']); ?> </a>			 
	<?php }
?> 
	</div>
<?php } 

function fechaALetras($fecha){
  $fecha_separada= explode("-", $fecha);

  $anio= $fecha_separada[0];
  $dia= $fecha_separada[2];
  
  switch ($fecha_separada[1]) {
    
    case "01":
        $mes="Enero";
      break;
    case "02":
        $mes="Febrero";
      break;
    case "03":
        $mes="Marzo";
      break;
    case "04":
        $mes="Abril";
      break;
    case "05":
        $mes="Mayo";
      break;
    case "06":
        $mes="Junio";
      break;
    case "07":
        $mes="Julio";
      break;
    case "08":
        $mes="Agosto";
      break;
    case "09":
        $mes="Septiembre";
      break;
    case "10":
        $mes="Octubre";
      break;
    case "11":
        $mes="Noviembre";
      break;
    case "12":
        $mes="Diciembre";
      break;

    default: $mes = "fail";
      break;
  }
  	return $dia." de ". $mes." de ". $anio;
}

?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.tip').tooltip();
	});
</script>