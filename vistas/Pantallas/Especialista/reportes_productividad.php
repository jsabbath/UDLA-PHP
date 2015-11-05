<?php 
$header=1;
$activo=8;
require('../../header.php');
include('../../PHP/funciones.php');
include("../../PHP/paciente/consultas_historia.php");
?>
<link href="../../../datatables/dataTables.bootstrap.css" rel="stylesheet">
<script src="../../../datatables/dataTables.bootstrap.js"></script>
<script src="../../../datatables/jquery.dataTables.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('.table-rp').dataTable();
});
</script>
<?php 
date_default_timezone_set('America/Caracas');

if(isset($_POST['mes'])){ $mes_actual = $_POST['mes'];}
else { $mes_actual = date('m'); }

$hoy = date('Y-m-d');
//$mes_actual = date('m');
//$mes_actual = 06;
?>

<?php $procedimientos = mysql_query("SELECT * FROM porcentaje"); ?>

<div class="container">
	<div class="row">
<!-- 	///////////////////// seleccione de mes /////////////////////////// -->
		      <div class="span12">
		        <center>
		        <form action="" method="POST" class="form-inline" accept-charset="utf-8">       
		          <div class="control-group">
		          <br><br><br>
		              <p>Seleccione un mes para visualizar el reporte.</p>
		              <select name="mes" required>
		                <option value="">Mes</option>
		                <option value="01">Enero</option>
		                <option value="02">Febrero</option>
		                <option value="03">Marzo</option>
		                <option value="04">Abril</option>
		                <option value="05">Mayo</option>
		                <option value="06">Junio</option>
		                <option value="07">Julio</option>
		                <option value="08">Agosto</option>
		                <option value="09">Septiembre</option>
		                <option value="10">Octubre</option>
		                <option value="11">Noviembre</option>
		                <option value="12">Diciembre</option>
		              </select>
		              <button type="submit" class="btn btn-default">Buscar</button>
		          </div>
		        </form>
		        </center>
		      </div>
		      <center> <br> <h2>Reportes: <?php echo fecha_mes($mes_actual); ?> </h2> <br> </center>

			
 <!-- /////////////////////////////////// medicos y enfermerasss ////////// -->
			
		        <?php while ($empleado = mysql_fetch_assoc($procedimientos)) { ?>
		        	<div class="span12">
		        	<div class="widget">
		        	  	<div class="widget-header">
		        	  		<div class="span9 doctor"><i class="icon-file"></i>
		        	  		<h3>Reporte <?php echo $empleado['nombre']; ?>  </h3></div>
		        	    	<a href="reporte_individual.php?mes=<?php echo $mes_actual; ?>&persona=<?php echo $empleado['id']; ?>" class="botonExcel btn btn-success pull-right"><i class="icon-file-text-alt"></i> Ver Individual</a>
		        	  	</div>
		        	  	<div class="widget-content">
		        	  		
		        	   			<table class="table table-striped table-bordered table-hover table-rp" id="table">

		        			<thead>
					        	<tr>
						        	<th>Nro</th>
						        	<th>Procedimientos</th>
						        	<th>Paciente</th>
						        	<th>Fecha de Aplicacion</th>
						        	<th>Precio</th>
						        	<th>Porcentaje</th>
						        	<th>Total</th>
					        	</tr>
		        			</thead>
		        			<tbody>

		        	<?php   
		        		$precio_tratamiento = 0;
		            	$precio_total_tratamiento = 0;
		            	$total_ganancias = 0;
		            	$i = 1;
		            	
		            	$reportes = mysql_query("SELECT * FROM reportes Where usuario_id = '{$empleado['id']}' AND MONTH(ctreated_at) = '$mes_actual' ");
		         

		            	while($reporte = mysql_fetch_array($reportes)) {
		            		$tratamiento_id=$reporte['tratamiento_id'];
			            	$paciente_id=$reporte['paciente_id'];
			            	$pacientes = mysql_query("SELECT * FROM pacientes Where id= $paciente_id");
			            	$paciente = mysql_fetch_assoc($pacientes);
			            	$tratamientos = mysql_query("SELECT * FROM tratamientos Where id=$tratamiento_id");
			            	$tratamiento = mysql_fetch_assoc($tratamientos);
			            	$nombre=$tratamiento['nombre'];
			            	$result = mysql_query("SELECT * FROM lista_tratamientos WHERE nombre='{$nombre}'");
			            	$precio_tr = mysql_fetch_assoc($result);
			            	  $precio_tratamiento=$precio_tr['precio'];
			            	  $precio_total_tratamiento= $precio_tr['precio'] + $precio_total_tratamiento;

			            	if ($precio_tratamiento != 0) {  ?>
	    			          	<tr class="odd gradeX">
		    			          	<td><?php  echo $i; $i++ ?></td>
		    			          	<td><?php  echo $precio_tr['nombre']; ?></td>
		    			          	<td><?php  echo $paciente['nombre_completo']; ?></td>
		    			           	<td><?php  echo $reporte['ctreated_at']; ?></td>
		    			          	<td>
		    			            	<?php
		    			             	echo  $precio_tratamiento." Bsf";
		    			            	$por= $precio_tratamiento * $empleado['dividendo'];
		    			            	$porciento = $por / 100;
		    			             	?>

		    			           	</td>
		    			            <td><?php echo $empleado['dividendo']." %"; ?></td>
		    			            <td>
		    			                <?php
		    			               		echo   $porciento." Bsf";
		    			                  	$total_ganancias=$porciento + $total_ganancias;
		    			                ?>
		    			            </td>
	    			          	</tr>

	    			        <?php }  //cierre if precio_tratamiento ?>
          	
    <?php      	}// cierrre de wjile de reportes ?>

    			</tbody>

	    			</table>
		        <div class="resultados">
		           <strong>Total Facturado: <?php echo $precio_total_tratamiento." Bsf"; ?></strong>
		           		<br>
		           <strong>Total en porcentaje de Ganancias: <?php echo $total_ganancias." Bsf"; ?></strong>
		        </div>

            		</div> <!-- div widget-content -->
    		</div> <!-- div widget -->
    	</div>


    <?php } //cierre de while de empleados ?>
		                   

	</div> <!-- cierra row -->
</div> <!-- cierra container -->