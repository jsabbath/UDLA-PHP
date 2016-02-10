<?php 
include "../../config/datos.php";

if (isset($_GET['cita'])) 
{
	$cita = $_GET['cita'];

	$update = mysql_query("UPDATE citas SET status = 3 WHERE id='".$_GET['cita']."' ");	
	if ($update) 
	{
		header("Location: ../../Pantallas/Enfermera/index.php");
	}
	else
	{  
		$msg = "No se pudo despachar al paciente. ";
		header("Location: ../../Pantallas/Enfermera/index.php"); 
	}
}
else 
{
	$paciente=$_GET['paciente'];
	$result = mysql_query("SELECT * FROM citas WHERE paciente_id = '{$paciente}' AND status = 15");
 	if(mysql_num_rows($result) > 0)
 	{
 		while($row = mysql_fetch_array($result))
		{
			
			$update_2 = mysql_query("UPDATE citas SET status = 3 WHERE paciente_id = '{$paciente}'");	
			if (!$update_2) 
			{
				$msg = "No se pudo despachar al paciente. ";
				header("Location: ../../Pantallas/Enfermera/index.php");
			}
		}
		header("Location: ../../Pantallas/Enfermera/index.php");	
 	}
 	else
 	{
 		header("Location: ../../Pantallas/Enfermera/index.php");
 	}
 	
}

?>


