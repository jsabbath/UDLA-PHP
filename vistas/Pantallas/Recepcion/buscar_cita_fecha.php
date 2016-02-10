<?php
include "../../config/datos.php";
include('../../PHP/recepcion/conecciones.php'); 
$header=2;
$activo=2;
require('../../header.php');?>
<?php include("../../PHP/paciente/consultas_historia.php"); ?>
<link href="../../../datatables/dataTables.bootstrap.css" rel="stylesheet">
<script src="../../../datatables/dataTables.bootstrap.js"></script>
<script src="../../../datatables/jquery.dataTables.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#dataTables-example').dataTable();
});
</script>
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12">
  
                 <div class="widget">
            <div class="widget-header"> <i class="icon-file"></i>
              <h3>Pacientes Registrados</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                     

									<div class="table-responsive">
									<table class="display table table-hover" id="dataTables-example">
									<thead>
									<tr>
									<th>Nombre</th>
									<th>Cedula</th>
									<th>Nro de Móvil</th>
									<th>Motivo</th>
									<th>Estado</th>
									<th class="acciones">Acciones</th>
									</tr>
									</thead>
									<tbody>
									<?php if($todas_las_citas){
									while($datos=mysql_fetch_assoc($todas_las_citas)){ 
                                    $paciente_id=$datos['paciente_id'];
                                    $todos_paciente = mysql_query("SELECT * FROM pacientes Where id=$paciente_id");
                                    while($paciente = mysql_fetch_array($todos_paciente)){      ?>

                                    <?php if ($datos['fecha']==$_POST['fecha'] AND $datos['status']!=2 AND $datos['status']!=10 AND $datos['status']!=15): ?>
									<tr class="odd gradeX">
									
									<td><?php echo $paciente['nombre_completo']; ?></td>
									<td><?php echo $paciente['cedula']; ?></td>
									<td><?php echo $paciente['telefono'];  ?></td>
									<td><?php echo $datos['tipo'];  ?></td>
									<td>
									<?php if ( $datos['status']==0) : ?>
									<div class="confirmar segunda">Por Confirmar</div>
									<?php  
									elseif ($datos['status']==1) : ?>
									<div class="confirmada segunda">Confirmada</div>	
                                    <?php endif?>
	                               </td>
	                            
									<td class="iconos_reporte">
									<?php if ($datos['status']==1) {  ?>
									<a class="btn btn-small botones_citas" href="../../PHP/recepcion/comfirmar_cita.php?id=<?php echo $datos['id'];?>&status=<?php echo $datos['status'];?>">Presente</a>
									<a class="btn btn-small botones_citas" href="../../PHP/recepcion/buscar_paciente.php?paciente=<?php echo $paciente['id'];?>&cita_id=existe">Editar</a>
									<?php }else {?>
									<a class="btn btn-small botones_citas" href="../../PHP/recepcion/comfirmar_cita.php?id=<?php echo $datos['id'];?>&status=<?php echo $datos['status'];?>">Confirmar</a>
									<a class="btn btn-small botones_citas" href="../../PHP/recepcion/buscar_paciente.php?paciente=<?php echo $paciente['id'];?>&cita_id=existe">Editar</a>
									
									<?php }?>
									
									</td>
										
									</tr>
										<?php endif ?>


									<?php   }} } ?>
									</tbody>
									</table>
									
									</div>
             
  
            </div>  <!-- /widget-content hastaa aqui -->
            <!-- /widget-content --> 

          </div>
          <!-- /widget --> 
        </div>
        <!-- /span6 -->
        
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!-- /main -->


