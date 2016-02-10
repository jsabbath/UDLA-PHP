<?php
$name = $_POST['nombre'];
$mes = $_POST['mes'];

switch ($mes) {
	case '01':
		$mes = "Enero";
		break;

	case '02':
		$mes = "Febrero";
		break;

	case '03':
		$mes = "Marzo";
		break;
	case '04':
		$mes = "Abril";
		break;
	case '05':
		$mes = "Mayo";
		break;
	case '06':
		$mes = "Junio";
		break;
	case '07':
		$mes = "Julio";
		break;
	case '08':
		$mes = "Agosto";
		break;
	case '09':
		$mes = "Septiembre";
		break;
	case '10':
		$mes = "Octubre";
		break;
	case '11':
		$mes = "Noviembre";
		break;
	case '12':
		$mes = "Diciembre";
		break;
	default:
		# code...
		break;
}

header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=reporte_de_".$mes."_".$name.".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $_POST['datos_a_enviar'];
?>