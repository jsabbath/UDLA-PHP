<?php 
$header=1;
$activo=7;
require('../../header.php');
include('../../PHP/recepcion/conecciones.php'); ?>

<link href="../../../datatables/dataTables.bootstrap.css" rel="stylesheet">
<script src="../../../datatables/dataTables.bootstrap.js"></script>
<script src="../../../datatables/jquery.dataTables.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#dataTables-example').dataTable();
});
</script>


		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget">
						<div class="widget-header">
						<div class="span12">  	<i class="icon-file"></i>
<h3>Reportes diario</h3></div>

						</div>	
						<div class="widget-content">
							<div class="table-responsive">
 <table class="table table-striped table-bordered table-hover">
                  <thead>
                  <tr>
                  <th>N°</th>
                  <th>Nombre</th>
                  <th>Nro de Móvil</th>
                  <th>Motivo</th>

                  </tr>
                  </thead>
                  <tbody>
                  <?php $i=1;
                    $nuevo=0;
                  ?>
                 <center><div class="tipo_cita">Pacientes por nuevo caso</div></center> 
                  <?php  $todas_las_citas = mysql_query("SELECT * FROM citas");
                  while($datos=mysql_fetch_assoc($todas_las_citas)){ 
                    $paciente_id=$datos['paciente_id'];
                    $todos_paciente = mysql_query("SELECT * FROM pacientes Where id=$paciente_id");
                    while($paciente = mysql_fetch_array($todos_paciente)){      ?>
     <?php if ($datos['fecha']== date("2015-12-19") AND $datos['status']==3 AND $datos['tipo']=="Nuevo" ) {  ?>

                  <tr class="odd gradeX">
                   <td><?php echo $i; $i++ ?></td>
                  <td><?php echo $paciente['nombre_completo']; ?></td>
                  <td><?php echo $paciente['telefono'];  ?></td>
                  <td><?php echo $datos['tipo'];  ?></td>

                  </tr>
                  <?php $nuevo=2000 +$nuevo ?>



                  <?php   }}}  ?>
               <tr class="odd gradeX">
                 <th>Se produjo en pacientes nuevos un<th>

                  <th>Monto total de: </th>
                  <th><?php echo $nuevo; ?></th>

                  </tr>


                  </tbody>
                  </table></div>
                  <!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->  


  <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover">
                  <thead>
                  <tr>
                   <th>N°</th>
                  <th>Nombre</th>
                  <th>Nro de Móvil</th>
                  <th>Motivo</th>

                  </tr>
                  </thead>
                  <tbody>
                  <?php $n=1; 
                 $control=0
                  ?>
                  <center><div class="tipo_cita">Pacientes por Control</div></center> 
                  <?php  $todas_las_citas = mysql_query("SELECT * FROM citas");
                  while($datos=mysql_fetch_assoc($todas_las_citas)){ 
                                    $paciente_id=$datos['paciente_id'];
                                    $todos_paciente = mysql_query("SELECT * FROM pacientes Where id=$paciente_id");
                                    while($paciente = mysql_fetch_array($todos_paciente)){      ?>
     <?php if ($datos['fecha']== date("2015-12-19") AND $datos['status']==3 AND $datos['tipo']=="Control" ) {  ?>

                  <tr class="odd gradeX">
                 <td><?php echo $n; $n++ ?></td>

                  <td><?php echo $paciente['nombre_completo']; ?></td>
                  <td><?php echo $paciente['telefono'];  ?></td>
                  <td><?php echo $datos['tipo'];  ?></td>

                  </tr>

  <?php $control=1200 +$control ?>

                  <?php   }}}  ?>
   <tr class="odd gradeX">
                 <th>Se produjo en pacientes de CONTROL un<th>

                  <th>Monto total de: </th>
                  <th><?php echo $control; ?></th>

                  </tr>
                  </tbody>
                  </table></div>
                  <!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->



                    <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover">
                  <thead>
                  <tr>
                   <th>N°</th>

                  <th>Nombre Paciente</th>
                  <th>Nro de Móvil</th>
                  <th>Aplicado por</th>
                  <th>Procedimiento</th>
                  <th>Precio</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $l=1;
                  $tratamiento=0;
                  $precio_tratamiento=0;
                  $precio_total_tratamiento=0; ?>
                 <center>  <div class="tipo_cita">Pacientes por Tratamiento</div></center>
                  <?php  $todas_las_citas = mysql_query("SELECT * FROM citas");
                  while($datos=mysql_fetch_assoc($todas_las_citas)){ 
                                    $paciente_id=$datos['paciente_id'];
                                    $todos_paciente = mysql_query("SELECT * FROM pacientes Where id=$paciente_id");
                                    $reportes = mysql_query("SELECT * FROM reportes Where paciente_id=$paciente_id");



                                    while($paciente = mysql_fetch_array($todos_paciente)){      ?>
                  <?php if ($datos['fecha']== date("2015-12-19") AND $datos['status']==3 AND $datos['tipo']=="Tratamiento" ) {  ?>

                  <tr class="odd gradeX">
                 <td><?php echo $l; $l++ ?></td>

                  <td><?php echo $paciente['nombre_completo']; ?></td>
                  <td><?php echo $paciente['telefono'];  ?>
                  <td>

                    <?php 
                   $reportes_2 = mysql_query("SELECT * FROM reportes Where paciente_id=$paciente_id");

                     while($aplicado = mysql_fetch_array($reportes_2)){
                                        $usuario_id=$aplicado['usuario_id'];
                                        $usuario_name = mysql_query("SELECT * FROM porcentaje Where id=$usuario_id");
                                        $name = mysql_fetch_assoc($usuario_name);

                    echo $name['nombre'].",  "; } ?>




                  </td>
                   <td><?php


                        while($reporte = mysql_fetch_array($reportes)){
                                        $tratamiento_id=$reporte['tratamiento_id'];
                                        $tratamientos = mysql_query("SELECT * FROM tratamientos Where id=$tratamiento_id");
                                        $tratamiento = mysql_fetch_assoc($tratamientos);
                                        $nombre=$tratamiento['nombre'];
                                        $result = mysql_query("SELECT * FROM lista_tratamientos WHERE nombre='{$nombre}'");
                                        $precio_tr = mysql_fetch_assoc($result);
                    echo $precio_tr['nomenclatura'].",  ";
                    $precio_tratamiento=$precio_tr['precio']+$precio_tratamiento;
                       $precio_total_tratamiento=$precio_tr['precio']+$precio_total_tratamiento;

                    } ?></td>
                    <td><?php echo $precio_tratamiento;
                     $precio_tratamiento=0; ?></td>

                  </tr>



                  <?php   }}}  ?>
                <tr class="odd gradeX">
                 <th>Se produjo en pacientes de TRATAMIENTOS un<th>
 <th></th>
                  <th>Monto total de: </th>
                  <th><?php echo $precio_total_tratamiento;  ?></th>

                  </tr>
                  </tbody>

                  </table></div>
                  <!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->




                    <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover">
                  <thead>
                  <tr>
                   <th>N°</th>
                  <th>Nombre</th>
                  <th>Nro de Móvil</th>
                  <th>Motivo</th>

                  </tr>
                  </thead>
                  <tbody>
                  <?php $u=1; 
                  $cirugia=0;?>
                  <center> <div class="tipo_cita">Pacientes por Cirujia</div></center> 
                  <?php  $todas_las_citas = mysql_query("SELECT * FROM citas");
                  while($datos=mysql_fetch_assoc($todas_las_citas)){ 
                                    $paciente_id=$datos['paciente_id'];
                                    $todos_paciente = mysql_query("SELECT * FROM pacientes Where id=$paciente_id");
                                    while($paciente = mysql_fetch_array($todos_paciente)){      ?>
     <?php if ($datos['fecha']== date("2015-12-19") AND $datos['status']==3 AND $datos['tipo']=="Cirujia" ) {  ?>

                  <tr class="odd gradeX">
                 <td><?php echo $u; $u++ ?></td>

                  <td><?php echo $paciente['nombre_completo']; ?></td>
                  <td><?php echo $paciente['telefono'];  ?></td>
                  <td><?php echo $datos['tipo'];  ?></td>

                  </tr>



                  <?php   }}}  ?>
                     <tr class="odd gradeX">
                 <th>Se produjo en pacientes con CIRUJIAS un<th>

                  <th>Monto total de: </th>
                  <th><?php echo $cirugia; ?></th>

                  </tr>

                  </tbody>
                  </table></div>
                  <!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->  




                    <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover">
                  <thead>
                  <tr>
                   <th>N°</th>
                  <th>Nombre</th>
                  <th>Nro de Móvil</th>
                  <th>Motivo</th>

                  </tr>
                  </thead>
                  <tbody>
                  <?php $s=1; 
                  $emergencia=0; ?>
                  <center> <div class="tipo_cita">Pacientes por Emergencia</div><center> 
                  <?php  $todas_las_citas = mysql_query("SELECT * FROM citas");
                  while($datos=mysql_fetch_assoc($todas_las_citas)){ 
                                    $paciente_id=$datos['paciente_id'];
                                    $todos_paciente = mysql_query("SELECT * FROM pacientes Where id=$paciente_id");
                                    while($paciente = mysql_fetch_array($todos_paciente)){      ?>
     <?php if ($datos['fecha']== date("2015-12-19") AND $datos['status']==3 AND $datos['tipo']=="Emergencia" ) {  ?>

                  <tr class="odd gradeX">
                 <td><?php echo $s; $s++ ?></td>

                  <td><?php echo $paciente['nombre_completo']; ?></td>
                  <td><?php echo $paciente['telefono'];  ?></td>
                  <td><?php echo $datos['tipo'];  ?></td>

                   <?php $emergencia=3500 +$emergencia ?>

                  </tr>



                  <?php   }}}  ?>
                     <tr class="odd gradeX">
                 <th>Se produjo en pacientes de EMERGENCIA un<th>

                  <th>Monto total de: </th>
                  <th><?php echo $emergencia; ?></th>

                  </tr>

                  </tbody>
                  </table></div>






<center><div class="total">

<?php $total=$nuevo+$control+$emergencia+$precio_total_tratamiento; 
echo $total." Bsf";

?>


</div></center>












						</div>
					</div>




				</div>
			</div>
		</div>
