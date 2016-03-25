<?php 

include("../../config/datos.php");

$partes = array('
	Area del Bikini', 
	'Cuero Cabelludo',
	'Axilas',
	'Cara',
	'Cara y Cuello',
	'Pecho',
	'Espalda',
	'Brazos',
	'Gluteos',
	'Muslos',
	'Piernas',
	'Cicatriz',
	'Cicatrices',
	'Manos',
	'Parpados',
	'Boso',
	'Papada',
	'Revolvera',
	'Abdomen',
	'Abdomen y Cintura',
	'Cintura',
	'Cara Femenina',
	'Cara Masculina',
	'Cara y Cuello Femenina',
	'Cara y Cuello Masculina'
	);
$exito = 0;
foreach ($partes as $parte) {
	$sql = mysql_query("INSERT INTO partes_cuerpo VALUES(NULL, '$parte') ");
	if ($sql) {
		$exito++;
	}
	else
	{
		echo "error al guardar ".mysql_error()."<br>";
		break;
	}
}

echo "se registraron con exito ".$exito." partes del cuerpo.";

?>