<?php require("../../header2.php"); ?>
<?php 
include "../../config/datos.php";
$paciente_id = $_GET['paciente'];
?>


<div class="container">

	<h1 class="text-center">TU INFORMACIÒN ES VALIOSA PARA NOSOTROS <br>
		<small>Queremos conocer tu salud para ayudarte mejor.</small>
	</h1>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="text-center">Antecedentes Medicos Personales:</h3>
			<div class="progress ">
			  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%;">
			    10%
			  </div>
			</div>
		</div> <!-- fin panel heading -->

		<div class="panel-body">
			<div class="row">

			<div class="container">
			<?php 
				$consulta2 = mysql_query("SELECT enfermedad FROM antecedentes_personales WHERE paciente_id = '{$paciente_id}' ");
				$arreglo = "";
				while ($fila = mysql_fetch_assoc($consulta2)) {
				 	$arreglo .= ",".$fila['enfermedad'];   
				}
				
				$list = explode(",", $arreglo);
				//print_r($list);									
			?>
				<div class="ayuda text-danger col-lg-12">
				<p style="padding-left:12px"><i class="fa fa-info-circle"></i> Por favor presione según sea necesario sobre una o mas enfermedades que haya padecido anteriormente o que padece:</p>
				</div>
				
			<div class="preguntas">
             <ul>
				<li>
					<?php if(in_array("Resistencia a la insulina", $list, true)){ ?>
						<div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box-checked">
						<P class="box-text"><i class="fa fa-check"></i> Resistencia a la Insulina</P>	
					</div>
					<?php }
					else{ ?>
					<a href="" data-toggle="modal" data-target="#myModal" class="box-button">
					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box">
						<P class="box-text"><i class="fa fa-chevron-right"></i> Resistencia a la Insulina</P>	
					</div>
					</a>
					<?php } ?>
				</li>

				<li>
				<?php if(in_array("Trastornos Tiroideos", $list, true)){ ?>
					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-3 box-checked">
						<P class="box-text"><i class="fa fa-check"></i> Trastornos Tiroideos</P>	
					</div>
				<?php }
				else{ ?>
				<a class="box-button disabled" role="button" href="" data-toggle="modal" data-target="#tras_tiroideos">
					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-3 box">
						<P class="box-text"><i class="fa fa-chevron-right"></i> Trastornos Tiroideos</P>	
					</div>
				</a>
				<?php } ?>
				</li>

				<li>
				<?php if(in_array("Rinitis Alérgica", $list, true)){ ?>
					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box-checked">
						<P class="box-text"><i class="fa fa-check"></i> Rinitis Alérgica</P>	
					</div>
				<?php }
				else{ ?>
				<a  class="box-button" href="#" data-toggle="modal" data-target="#rinitis">
					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box">
						<P class="box-text"><i class="fa fa-chevron-right"></i> Rinitis Alérgica</P>	
					</div>
				</a> 
				<?php } ?>
				</li>

				<li>
				<?php if(in_array("Sinusitis Alérgica", $list, true)){ ?>
					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box-checked">
						<P class="box-text"><i class="fa fa-check"></i> Sinusitis Alérgica</P>	
					</div>
				<?php }
				else{ ?>
				<a class="box-button" href="#" data-toggle="modal" data-target="#sinusitis">
					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box">
						<P class="box-text"><i class="fa fa-chevron-right"></i> Sinusitis Alérgica</P>	
					</div>
				</a>
				<?php } ?>
				</li>

				<li>
				<?php if(in_array("Trastornos Nerviosos", $list, true)){ ?>
					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-3 box-checked">
						<P class="box-text"><i class="fa fa-check"></i> Transtornos Nerviosos</P>	
					</div>
				<?php }
				else{ ?>
				<a class="box-button" href="#" data-toggle="modal" data-target="#trastornos">
					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-3 box">
						<P class="box-text"><i class="fa fa-chevron-right"></i> Trastornos Nerviosos</P>	
					</div>
				</a>
				<?php } ?>
				</li>

				<li>
				<?php if(in_array("Hipertension Arterial", $list, true)){ ?>
					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box-checked">
						<P class="box-text"><i class="fa fa-check"></i> Hipertension Arterial</P>	
					</div>
				<?php }
				else{ ?>
				<a class="box-button" href="#" data-toggle="modal" data-target="#hipertension">
					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box">
						<P class="box-text"><i class="fa fa-chevron-right"></i> Hipertension Arterial</P>	
					</div>
				</a>
				<?php } ?>
				</li>

				<li>
				<?php if(in_array("Diabetes Mellitus", $list, true)){ ?>
					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box-checked">
						<P class="box-text"><i class="fa fa-check"></i> Diabetes</P>
					</div>
				<?php }
				else{ ?>
				<a class="box-button" href="#" data-toggle="modal" data-target="#diabetes">
					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box">
						<P class="box-text"><i class="fa fa-chevron-right"></i> Diabetes</P>	
					</div>
				</a>
				<?php } ?>
				</li>

				<li>
				<?php if(in_array("Asma Bronquial", $list, true)){ ?>
					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-3 box-checked">
						<P class="box-text"><i class="fa fa-check"></i> Asma Bronquial</P>
					</div>
				<?php }
				else{ ?>
				<a class="box-button" href="#" data-toggle="modal" data-target="#asma">
					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-3 box">
						<P class="box-text"><i class="fa fa-chevron-right"></i> Asma Bronquial</P>	
					</div>
				</a>
				<?php } ?>
				</li>

				<li>
				<?php if(in_array("Enfermedades Dermatologicas", $list, true)){ ?>
					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box-checked">
						<P class="box-text"><i class="fa fa-check"></i> Enfermedades Dermatologicas</P>
					</div>
				<?php }
				else{ ?>
				<a class="box-button" href="#" data-toggle="modal" data-target="#dermatologicas">
					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box">
						<P class="box-text"><i class="fa fa-chevron-right"></i> Enfermedades Dermatologicas</P>	
					</div>
				</a>
				<?php } ?>
				</li>

				<li>
				<?php if(in_array("Cancer de Piel(Melanoma u otro)", $list, true)){ ?>
					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box-checked">
						<P class="box-text"><i class="fa fa-check"></i> Cancer de Piel</P>
					</div>
				<?php }
				else{ ?>
				<a class="box-button" href="#" data-toggle="modal" data-target="#cancer">
					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box">
						<P class="box-text"><i class="fa fa-chevron-right"></i> Cancer de Piel</P>	
					</div>
				</a>
				<?php } ?>
				</li>


				<li><a class="box-button" href="#" data-toggle="modal" data-target="#otras">
					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-3 box">
						<P class="box-text"><i class="fa fa-chevron-right"></i> Otras</P>	
					</div>
				</a></li></ul></div>
				</div>
			 </div><!--fin row -->
			<div class="row">			
				<div id="respuesta" class="col-lg-12">
					<?php //include("../../PHP/paciente/consulta_ant_personal.php"); ?>
				</div>
			</div>
		</div> <!-- fin panel body -->

		<div class="panel-footer">
			<a href="antecedentes_alergicos.php?paciente=<?php echo $paciente_id; ?>" class="btn btn-success btn-lg">Continuar</a>			
		</div>			
	</div><!-- fin panel default -->
</div>

</body>
</html>

<?php include("modals_ant_personales.php"); ?>