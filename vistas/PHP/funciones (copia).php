<?php 

function calculaedad($fechanacimiento){
	if($fechanacimiento == "0000-00-00" OR $fechanacimiento == "")
	{
		$ano_diferencia = "0";
	}
	else
	{
		list($ano,$mes,$dia) = explode("-",$fechanacimiento);
		$ano_diferencia  = date("Y") - $ano;
		$mes_diferencia = date("m") - $mes;
		$dia_diferencia   = date("d") - $dia;
		if ($dia_diferencia < 0 && $mes_diferencia <= 0)
		    $ano_diferencia--;
		return $ano_diferencia;
	}
}

function calcular_fechas($fecha2)
{
	if($fecha2 == "" OR $fecha2 == "0000-00-00")
	{
		$dias = "Fecha no valida";
		return $dias;
	}
	else
	{
		date_default_timezone_set('UTC');
		$fecha1 = date("Y-m-d");
		$f1 = explode("-", $fecha1);
		$ano1 = $f1[0];
		$mes1 = $f1[1];
		$dia1 = $f1[2];

		$f2 = explode("-", $fecha2);
		$ano2 = $f2[0];
		$mes2 = $f2[1];
		$dia2 = $f2[2];

		//calcular los timestam 
		$time1 = mktime(0,0,0,$mes1,$dia1,$ano1);
		$time2 = mktime(0,0,0,$mes2,$dia2,$ano2);
		//restar fechas
		$diferencia = $time1 - $time2;
		//convertir segundos en dias
		$dias = $diferencia / (60*60*24);
		//obtener el valor absoluto para quitar posible signo negativo
		$dias = abs($dias);
		//quito los posibles decimales redondeandolo hacia abajo
		$dias = floor($dias);

		$anios = ( $dias / 365 ); // cantidad de años

		$dias_extras = $dias - ( $anios * 365 ); //dias que sobran del calculo anterior

		$meses = ( $dias_extras / 30 ); //cantidad de meses

		$cant_dias = $dias_extras - ( $meses * 30 ); //cantidad de dias

		return "Hace ".round($anios, 0)." años, ".$meses." meses y " .$dias." dias";

		//return $dias;
	}
}

function fecha_total($fecha_hoy)
{
  //$fecha_hoy = date('Y-m-d');
  $dias = array('', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo');
  $dia = $dias[date('N', strtotime($fecha_hoy))];
  
  $fecha_separada= explode("-", $fecha_hoy);

  $anio= $fecha_separada[0];
  $dia_nro = $fecha_separada[2];
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
	}
    return $dia.", ".$dia_nro." de ".$mes." del ".$anio;
}

function fecha_mes($fecha_hoy)
{
    
  

  $anio= date('Y');
  $mes_a = $fecha_hoy;
  switch ($mes_a) {
    
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
	}
    return $mes." del ".$anio;
}
 ?>