<?php 
include "../../config/datos.php";
include("../funciones.php");

$cedula = $_POST['cedula'];
$ced = $_POST['ci']."-".$cedula;
if(empty($cedula) OR strlen($cedula) < 7)
{
	$msg = "Disculpe debe ingresar una cedula correcta.";
	header("Location: ../../Pantallas/Pacientes/verificar_paciente.php?msg=$msg");
}
else
{
	$verifica = mysql_query("SELECT * FROM pacientes WHERE cedula ='{$ced}' LIMIT 1 ");

	$filas = mysql_num_rows($verifica);//cuenta cuantos han sido encontrados

		if ($filas == 1)
		{ 
			//paciente existente
			$paciente = mysql_fetch_assoc($verifica);
			$progreso = $paciente['progreso'];
			$id= $paciente['id'];
			switch ($progreso) {
				case 1:
				{
					$reanuda = "ok";
					header("Location: ../../Pantallas/Pacientes/datos_paciente.php?paciente=$id&reanuda=ok");
					break;
				}

				case 2:
				{
					$reanuda = "ok";
					header("Location: ../../Pantallas/Pacientes/antecedente_personales.php?paciente=$id&reanuda=ok");
					break;
				}

				case 3:
				{
					$reanuda = "ok";
					header("Location: ../../Pantallas/Pacientes/antecedentes_alergicos.php?paciente=$id&reanuda=ok");
					break;
				}

				case 4:
				{
					$reanuda = "ok";
					header("Location: ../../Pantallas/Pacientes/operaciones.php?paciente=$id&reanuda=ok");
					break;
				}

				case 5:
				{
					$reanuda = "ok";
					header("Location: ../../Pantallas/Pacientes/antec-familiar.php?paciente=$id&reanuda=ok");
					break;
				}
				case 6:
				{
					$reanuda = "ok";
					header("Location: ../../Pantallas/Pacientes/tratamientos_previos.php?paciente=$id&reanuda=ok");
					break;
				}

				case 7:
				{
					$reanuda = "ok";
					header("Location: ../../Pantallas/Pacientes/cremas.php?paciente=$id&reanuda=ok");
					break;
				}

				case 8:
				{
					$reanuda = "ok";
					header("Location: ../../Pantallas/Pacientes/examenes_previos.php?paciente=$id&reanuda=ok");
					break;
				}

				case 9:
				{
					$reanuda = "ok";
					header("Location: ../../Pantallas/Pacientes/habitos.php?paciente=$id&reanuda=ok");
					break;
				}

				case 10:
				{
					$sexo = mysql_query("SELECT * FROM pacientes WHERE id='{$id}'");
					$res = mysql_fetch_assoc($sexo);
					$edad = calculaedad($res['fecha_nacimiento']);
					if($res['sexo'] == 'Masculino' && $edad >=15)
					{
						$reanuda = "ok";
						header("Location: ../../Pantallas/Pacientes/preguntas_genero.php?gen=1&paciente=$paciente_id&reanuda=ok");
					}
					elseif($res['sexo'] == 'Femenino' && $edad >=15)
					{
						$reanuda = "ok";
						header("Location: ../../Pantallas/Pacientes/preguntas_genero.php?gen=2&paciente=$paciente_id&reanuda=ok");
					}
					else
					{
						$msg = "Disculpe, todos sus datos ya fueron registrados satisfactorimente.!";
						header("Location: ../../Pantallas/Pacientes/verificar_paciente.php?msg=$msg");
					}
					break;
				}


				
				default:
				{
					$msg = "Disculpe, todos sus datos ya fueron registrados satisfactorimente.!";
					header("Location: ../../Pantallas/Pacientes/verificar_paciente.php?msg=$msg");
					break;
				}
			}
			
		}
		else
		{
			//paciente no encontrado
			header("Location: ../../Pantallas/Pacientes/datos_paciente.php?ced=$ced");
	 	}
}


?>