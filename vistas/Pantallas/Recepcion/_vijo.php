<?php 
$header=2; 
require('../../header.php');
include "../../config/datos.php"; 
?>
<link href="../../../datatables/dataTables.bootstrap.css" rel="stylesheet">
<script src="../../../datatables/dataTables.bootstrap.js"></script>
<script src="../../../datatables/jquery.dataTables.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#dataTables-example').dataTable();
});
</script>
<?php

require_once ('../../../libs/ez_sql_core.php');
require_once ('../../../libs/ez_sql_mysql.php');
require_once ('../../../libs/Zebra_Pagination.php');

?>

<div class="main">
	<div class="main-inner">
		<div class="container">
      	    <div class="row">
	      	 	<div class="span6">
	      			<div class="widget">
					<div class="widget-header ">
						<i class="icon-star"></i>
						<h3>Historia Medica</h3>
					</div> <!-- /widget-header -->
					
					<div class="widget-content inicio">
					<div class="posicion">		
						<center>
						<p class="texto">Por favor preciones el boton si va a agregar una historia medica de un nuevo paciente </p>

							<button class="button btn btn-success btn-large centro"><a href="">Agregar Historia Medica</a></button></center>
                    </div>
					</div> <!-- /widget-content -->
						
				</div> <!-- /widget -->
				
		    </div> <!-- /span6 -->
	      	
	      	<div class="span6">
	      		
	      		<div class="widget">
							
					<div class="widget-header">
						<i class="icon-user"></i>
						<h3>Paciente registrado</h3>
					</div> <!-- /widget-header -->
					
					<div class="widget-content inicio">
			<div class="posicion">			
           <form  id="formulario" method="post" action="../../PHP/recepcion/buscar_paciente.php">
      
          <div class="login-fields">
              <?php 
              if(isset($_GET['error'])){
               echo '<center class="alert alert-error paciente">Paciente no Registrado</center>';
               }
               ?>
          <center><p class="texto">Introdusta la cedula del paciente</p>
     
           <div class="field"><i class="icon-pencil cedula"></i>
            <input type="text" id="cedula" name="cedula" value="" placeholder="Cedula" class="login username-field" />
           </div> <!-- /field -->
          </center>
             
           </div> <!-- /login-fields -->
      
          <div class="login-actions">
        
     
         <center>   <input class="button btn btn-success btn-large" type="submit" name="aceptar" value="Buscar" class="aceptar">       
       
        </center>
         </div> <!-- .actions -->
     </div>
      
      
      
 </form>
</div> <!-- /widget-content -->
				
</div> <!-- /widget -->
									
 </div> <!-- /span6 -->

                 <div class="span6">
	      			<div class="widget">
					<div class="widget-header ">
						<i class="icon-calendar"></i>
						<h3>Citas Para Hoy</h3>

					</div> <!-- /widget-header -->
					
					<div class="widget-content inicio">
					<div class="posicion segunda">		
					 <table class="pagina" border="0px" width="100%" id="dataTables-example"> 
<tr class="pacientes_hoy">
<td class="paciente_consulta">Paciente</td>
<td>Telefono</td>
<td>Motivo de Consulta</td>
<td>Estado</td>
<td class="acciones_pacientes">Acciones</td>
</tr>

<?php foreach ($citas as $cita): ?>
<?php $users = $conn->get_results('SELECT * FROM pacientes WHERE id="'.$cita->paciente_id.'"'); ?>
<tr class="listado">
<?php if ($cita->fecha == date('Y-m-d') AND $cita->status!=2 AND $cita->status!=10 AND $cita->status!=15): ?>
<?php foreach ($users as $user): ?>
<td class="paciente_consulta"><?php echo $user->nombre_completo;  ?></td>
<td><?php echo $user->telefono;  ?></td>
<td><?php echo $cita->tipo;  ?></td>
<td>
<?php if ( $cita->status==0) : ?>
 <div class="confirmar segunda">Por Confirmar</div>
 <?php  
 elseif ($cita->status==1) : ?>
<div class="confirmada segunda">Confirmada</div>


 <?php endif?>
 </td>
 <?php endforeach ?>
<td class="iconos_reporte">
	<?php if ($cita->status==1) {  ?>
	<a href="../../PHP/recepcion/comfirmar_cita.php?id=<?php echo $cita->id;?>&status=<?php echo $cita->status;?>"><i class="icon-certificate confirmada" title="Si el paciente llego Precione"></i></a>
    <a href="../../PHP/recepcion/cancelar_cita.php?id=<?php echo $cita->id;?>"><i class="icon-trash confirmada" title="Cancelar"></i></a>
	<?php }else {?>
	<a href="../../PHP/recepcion/comfirmar_cita.php?id=<?php echo $cita->id;?>"><i class="icon-check" title="Confirmar"></i></a>
    <a href="../../PHP/recepcion/buscar_paciente.php?paciente=<?php echo $user->id;?>"><i class="icon-edit " title="Editar"></i></a>
    <a href="../../PHP/recepcion/cancelar_cita.php?id=<?php echo $cita->id;?>"><i class="icon-trash " title="Cancelar"></i></a>
	<?php }?>

</td>
 <?php endif?>
</tr>

<?php endforeach ?>
  </table>

            </div>
					</div> <!-- /widget-content -->
						

     


						
				</div> <!-- /widget -->
				
		    </div> <!-- /span6 -->

	      	





<!-- /////////////////////////////////////////////////////////////////////////////////////////-->
<!-- /////////////////////////////////////////////////////////////////////////////////////////-->
<!-- ///////////////////////////////Cuarto cuadro/////////////////////////////////////////////-->
<!-- /////////////////////////////Citas en recepcion//////////////////////////////////////////-->
<!-- /////////////////////////////////////////////////////////////////////////////////////////-->
<!-- /////////////////////////////////////////////////////////////////////////////////////////-->
                <div class="span6">
	      			<div class="widget">
					<div class="widget-header ">
						<i class="icon-group"></i>
						<h3>Pacientes en espera</h3>

					</div> <!-- /widget-header -->
					
					<div class="widget-content inicio">
					<div class="posicion segunda">		
					 <table class="pagina" border="0px" width="100%"> 
<tr class="pacientes_hoy">
<td class="paciente_consulta">Paciente</td>
<td>Remitido a</td>
<td>Motivo de Consulta</td>
<td>Estado</td>
<td class="acciones_pacientes">Acciones</td>
</tr>

<?php foreach ($citas as $cita): ?>
<?php $users = $conn->get_results('SELECT * FROM pacientes WHERE id="'.$cita->paciente_id.'"'); ?>
<tr class="listado">
<?php if ($cita->fecha == date('Y-m-d') AND $cita->status==2 ): ?>
<?php foreach ($users as $user): ?>
<td class="paciente_consulta"><?php echo $user->nombre_completo;  ?></td>
<td><?php echo $cita->remitido;  ?></td>
<td><?php echo $cita->tipo;  ?></td>
<td><div class="parpadea text">En espera</div> </td>
 <?php endforeach ?>

 <td class="iconos_reporte">

    <a href=""><i class="icon-time" title="Si el paciente entro a consulta Precione"></i></a>


</td>
</tr>
 <?php endif?>

<?php endforeach ?>
  </table>

            </div>
					</div> <!-- /widget-content -->
						
				</div> <!-- /widget -->
				
		    </div> <!-- /span6 -->















	      </div> <!-- /row -->
	      
	    </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    
</div> <!-- /main -->

</body>
</html>


