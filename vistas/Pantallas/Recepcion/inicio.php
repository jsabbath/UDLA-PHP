<?php 
$header=2;
$activo=1; 
date_default_timezone_set('America/Caracas');
require('../../header.php');
include "../../config/datos.php";
include('../../PHP/recepcion/conecciones.php'); 

?>
<link href="../../../datatables/dataTables.bootstrap.css" rel="stylesheet">
<script src="../../../datatables/dataTables.bootstrap.js"></script>
<script src="../../../datatables/jquery.dataTables.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#dataTables-example, #dataTables-example_2 ').DataTable( {
        dom: 'T<"clear">lfrtip'
    } );
} );

function recargar(){  
  if ($actual<=15) {
    $actual=$actual+1;
  } else {
    $actual=1;
  }
  var variable_post=$actual;
  $("#paquete").fadeOut(function() {
    $.post("paquete_reciente.php", { variable: variable_post }, function(data){ 
    $("#paquete").html(data).fadeIn();
    });     
  });
}
$actual=0;
timer = setInterval("recargar()", 10000);
</script>



<div class="container">
  <br>
  <div class="row-fluid">

<!-- /////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////Cabezera/////////////////////////////////////////////// -->
    <div class="widget">
        <div class="widget-header ">
              <i class="icon-group"></i>
              <h3>Pacientes en espera</h3>
        </div>
        <!-- /widget-header -->
<!-- ////////////////////////////////Cerpo////////////////////////////////////////////////// -->
        <div class="widget-content">
          <div class="">		
          <div class="table-responsive">
<!-- ////////////////////////////////Tabla////////////////////////////////////////////////// -->
        <table class="display table table-hover">
          <thead>
            <tr>
              <th>Orden</th>
              <th>Nombre</th>
              <th>NºH</th>
              <th>Remitido</th>
              <th>Motivo</th>
              <th>Estado</th>
              <th>Hora</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $n=1;
              $i=0;
              $fecha_dato=date('2016-01-22');
              $todas_las_citas_2 = mysql_query("SELECT * FROM citas WHERE  
                                    fecha='$fecha_dato' AND 
                                    (status=2 OR status=100) 
                                    ORDER BY updated_at ASC");

              while($datos_2=mysql_fetch_assoc($todas_las_citas_2)){ 
                
                $paciente_id_2=$datos_2['paciente_id'];
                $todos_paciente_2 = mysql_query("SELECT * FROM pacientes Where id = '$paciente_id_2' ");
                $paciente_2 = mysql_fetch_assoc($todos_paciente_2);  
                $hf= $datos_2['updated_at'];
                $hora= explode(" ", $hf);
                $hora_llegada= $hora[1]; ?>

                <tr>
                    <td><?php echo $n; $n++; ?></td>
                    <td><?php echo $paciente_2['nombre_completo']; ?></td>
                    <td><?php echo $datos_2['nro_historia'];  ?></td>
                    <td><?php echo $datos_2['remitido'];  ?></td>
                    <td><?php echo $datos_2['tipo'];  ?></td>
                     <?php if ($datos_2['status']==100) { ?>
                    <td>
                      <div class="parpadea text ausente">Ausente</div> 
                    </td>
                    <?php } else { ?>  
                    <td>
                      <div class="parpadea text">En espera</div> 
                    </td> <?php } ?>
                    <td class="iconos_reporte"><?php echo $hora_llegada;?></td>
                    <td>
                      <a href="<?php echo "#myModalGeneral".$i; ?>" role="button" class="btn btn-default btn-small" data-toggle="modal"><i class="icon-ellipsis-vertical"></i> Opciones</a>
                          <?php if($datos_2['tipo'] == "Nuevo" OR $datos_2['tipo'] == "Control"    ){ 
                                  if($datos_2['status_pago'] == 1){ ?>
                                    <span class="label label-success font14 labels"><i class="icon-ok"></i> Pagado</span>
                          <?php } else{ ?>
                                  <a href="pagar.php?cita=<?php echo $datos_2['id']; ?>" class="btn btn-info btn-small"><i class="icon-credit-card"></i> Pagar</a>
                          <?php } 
                          }
                          else{ ?>
                          <a href="<?php echo "#myModaleditar".$i; ?>" role="button" class="btn btn-inverse btn-small" data-toggle="modal" ><i class="icon-asterisk"></i> Procedimientos</a>
                         <?php }
                           ?>
                    </td>
                </tr>
<!-- ////////////////////////////////Modal/////////////////////////////////////////////// -->
<!-- ////////// Modal general /////////////////-->
<div id="<?php echo "myModalGeneral".$i; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel"><i class="icon-trash"></i> ¿Que desea hacer con la cita del paciente?</h3>
    </div>
    <div class="modal-body">
        <a href="<?php echo "#myModalhora".$i; ?>" role="button" data-toggle="modal" class="btn btn-inverse">Cambiar Hora de llegada</a>							
        <?php if ($datos_2['status']==100) { ?>
            <a href="<?php echo "#myModalquitar".$i; ?>" role="button" data-toggle="modal" class="btn btn-primary">Poner en Sala de Espera</a>              
        <?php }else { ?>
            <a href="<?php echo "#myModalausente".$i; ?>" role="button" data-toggle="modal" class="btn btn-primary">Pasar a Ausente</a>              
         <?php }?>
            <a href="<?php echo "#myModalfecha_2".$i; ?>" role="button" data-toggle="modal" class="btn btn-danger">Diferir Cita</a>							
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
    </div>
</div>
<!-- ////////////////////////////////Modal/////////////////////////////////////////////// -->
<!-- ////////// Modal Horal /////////////////-->
<div id="<?php echo "myModalhora".$i; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">¿Esta seguro que desea cambiar la hora de la cita del paciente <?php echo $paciente_2['nombre_completo']; ?> </h3>
    </div>
    <div class="modal-body">
        <form method="POST" action="../../PHP/recepcion/cambiar_hora_de_espera.php">
          <center>
            <input type="hidden" name="cita_id" value="<?php echo $datos_2['id'];?>"> 
            <input type="hidden" name="paciente_id" value="<?php echo $paciente_2['id'];?> ">
            <input type="text" name="hora">
          </center>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
</div>
<!-- ////////////////////////////////Modal/////////////////////////////////////////////// -->
<!-- ////////// Ausente /////////////////-->
<div id="<?php echo "myModalausente".$i; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 id="myModalLabel">¿Esta seguro que desea colocar en ausente al paciente <?php echo $paciente_2['nombre_completo']; ?> </h3>
      </div>
      <div class="modal-body">
          <form method="POST" action="../../PHP/recepcion/paciente_ausente.php">
              <center>
                <input type="hidden" name="cita_id" value="<?php echo $datos_2['id'];?>"> 
                <button type="submit" class="btn btn-danger">Si quiero pasar a ausente</button>
              </center>
      </div>
      <div class="modal-footer">
          <button class="btn" data-dismiss="modal" aria-hidden="true">No pasar</button>
          </form>
      </div>
</div>
<!-- ////////////////////////////////Modal/////////////////////////////////////////////// -->
<!-- ////////// Sacar de lista de ausente /////////////////-->
<div id="<?php echo "myModalquitar".$i; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">¿Esta seguro que desea sacar de la lista de ausente al paciente <?php echo $paciente_2['nombre_completo']; ?> </h3>
</div>
<div class="modal-body">
<form method="POST" action="../../PHP/recepcion/paciente_ausente.php">
<center>
<input type="hidden" name="cita_id" value="<?php echo $datos_2['id'];?>"> 
<button name="ausente" type="submit" class="btn btn-danger">Si quiero ponerlo en espera nuevamente</button>
</center>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">No pasar</button>
</div>
</form>
</div>
<!-- ////////////////////////////////Modal/////////////////////////////////////////////// -->
<!-- ////////// Diferir Fecha /////////////////-->
<div id="<?php echo "myModalfecha_2".$i; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">¿Esta seguro que desea diferir la Fecha de la cita del paciente <?php echo $paciente_2['nombre_completo']; ?> </h3>
</div>
<div class="modal-body">
<form method="POST" action="../../PHP/recepcion/actualizar_fecha.php">
<center>
<label><h4>Apunte la fecha a la cual quiere reasignarle la cita</h4></label>
<input type="hidden" name="cita_id" value="<?php echo $datos_2['id'];?>"> 
<input type="hidden" name="paciente_id" value="<?php echo $paciente_2['id'];?> ">
<input type="date" name="fecha">
</center>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
<button name="diferir" type="submit" class="btn btn-primary">Guardar Cambios</button>
</div>
</form>
</div>
<!-- ////////////////////////////////Modal/////////////////////////////////////////////// -->
<!-- ////////// procedimientos /////////////////-->
<div id="<?php echo "myModaleditar".$i; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h3 id="myModalLabel"><i class="icon-edit"></i> Procedimientos que posee el paciente <?php echo $paciente_2['nombre_completo'];  ?></h3>
                    </div>
                    <div class="modal-body">
                    <?php 
                      $pro_por_aplicar = mysql_query("SELECT * FROM tratamientos 
                                            WHERE paciente_id = '{$paciente_2['id']}' AND tipo = 'cabina' AND status = 0 ");
                      $pro_en_marcha =  mysql_query("SELECT * FROM tratamientos 
                                            WHERE paciente_id = '{$paciente_2['id']}' AND tipo = 'cabina' AND status = 1 ");
                                             ?>
                                            <?php if(mysql_num_rows($pro_por_aplicar) > 0){?>
                                            <strong>Por Aplicar:</strong>
                                            <ul>
                                            <?php while($tra_por_aplicar = mysql_fetch_assoc($pro_por_aplicar)){ ?>
                                              <li><?php echo $tra_por_aplicar['nombre']; ?></li>
                                            <?php } ?> </ul> <?php  }else { ?>
                                            <strong>Por Aplicar:</strong><br>
                                            <ul>
                                            <li>No hay tratamientos por aplicar</li>
                                              </ul>
                                            <?php  } ?>
                                            <br>
                                             <?php if(mysql_num_rows($pro_en_marcha) > 0){?>
                                            <strong>En marcha:</strong>
                                            <ul>
                                            <?php while($tra_marcha = mysql_fetch_assoc($pro_en_marcha)){ ?>
                                              <li><?php echo $tra_marcha['nombre']; ?></li>
                                            <?php } ?> </ul> <?php  }else { ?>
                                            <strong>En marcha:</strong><br>
                                            <ul>
                                            <li>No hay Prosedimientos en marcha</li>
                                              </ul>
                                            <?php  } ?>
                    </div>
                    <div class="modal-footer">
                      <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                    
                    </div>
                </div>
<?php $i++; } ?>
</tbody>
</table>
</div>					
</div>
</div> <!-- /widget-content -->
</div> <!-- /widget -->

<!-- /////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////Cita para hoy//////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////// -->

<div class="widget">
    <div class="widget-header ">
        <i class="icon-calendar"></i>
        <h3>Citas para hoy</h3> <div Class"citas_manana"></div>
    </div> <!-- /widget-header -->
    <div class="widget-content inicio_especialista">
      <div class="posicion segunda">		
        <div class="table-responsive">
          <table class="display table table-hover " id="dataTables-example">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>NºH</th>
                <th width="150px">Nro de Móvil</th>
                <th>Motivo</th>
                <th>Dirigido A:</th>
                <th>PAQ</th>
                <th width="80px">Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php $dayy = date('2016-01-22'); ?>
              <?php  $todas_las_citas = mysql_query("SELECT * FROM citas");
              $l=0;
              $u=0;
              while($datos=mysql_fetch_assoc($todas_las_citas)) { 
                  $paciente_id=$datos['paciente_id'];
                  $todos_paciente = mysql_query("SELECT * FROM pacientes Where id = '$paciente_id' LIMIT 1");
                  while($paciente = mysql_fetch_array($todos_paciente)){  ?>
                  <?php if ($datos['fecha']== date('2016-01-22')
                    AND $datos['status']!=2
                    AND $datos['status']!=10 
                    AND $datos['status']!=15 
                    AND $datos['status']!=3 AND $datos['status']!=100 )
                   {  ?>
                  <tr >
                      <td><?php echo $paciente['nombre_completo']; ?></td>
                      <td><?php echo $datos['nro_historia'];  ?></td>
                      <td><?php echo $paciente['telefono'];  ?></td>
                      <td><?php echo $datos['tipo'];  ?></td>
                      <td><?php echo $datos['remitido']; ?></td>
                      

                      <?php if($datos['paquete_ap_id'] != '0' AND $datos['remitido'] == 'Cabina' ){ 
                      ?>
                        <td>
                          <?php $proc_pq = mysql_query("SELECT id, nombre, cantidad FROM tratamientos_aprobados WHERE paqueteaprob_id = '{$datos['paquete_ap_id']}' "); ?>
                          <a href="#" class="tip btn btn-mini" data-toggle="tooltip" data-placement="top" title="" data-original-title=" <?php 
                          while ($pro = mysql_fetch_assoc($proc_pq)) {
                              $nomecl = mysql_query("SELECT * FROM lista_tratamientos WHERE nombre = '{$pro['nombre']}' LIMIT 1 ");
                              $nmcl = mysql_fetch_assoc($nomecl);
                              echo $nmcl['nomenclatura']." / ";
                          } ?>"> procdts </a>
                        </td>
                      <?php  }
                      else{ ?>
                        <td><center>N/A</center></td>
                      <?php  } ?>



                      <td><?php if ( $datos['status']==0) {  ?>
                        <div class="confirmar segunda font-normal">Por Confirmar</div>
                        <?php } elseif ($datos['status']==1) {  ?>
                        <div class="confirmada segunda font-normal">Confirmada</div>	
                        <?php } ?>
                      </td>
                      <td>
                          <?php if ($datos['status']==1) {  ?>
                              <a role="button" class="btn btn-success btn-small presente font-normal" href="../../PHP/recepcion/comfirmar_cita.php?id=<?php echo $datos['id'];?>&status=<?php echo $datos['status'];?>"><i class="icon-map-marker"></i> Presente</a>
                              <a role="button" role="button" data-toggle="modal" class="btn btn-default btn-small font-normal" href="<?php echo "#myModaleditar".$l; ?>"><i class="icon-edit"></i> Editar</a>
                          <?php 
                          }
                          else 
                          { ?> 
                              <a role="button" class="btn btn-default btn-small porconfirmar font-normal"  href="../../PHP/recepcion/comfirmar_cita.php?id=<?php echo $datos['id'];?>&status=<?php echo $datos['status'];?>"><i class="icon-check"></i> Confirmar</a>
                              <a role="button" data-toggle="modal" class="btn btn-default btn-small font-normal" href="<?php echo "#myModaleditar".$l; ?>"><i class="icon-edit"></i> Editar</a>
                          <?php 
                          } 
                          if($datos['tipo'] == "Nuevo" OR $datos['tipo'] == "Control"){ 
                              if($datos['status_pago'] == 1){
                          ?>
                              <span class="label label-success font14 labels"><i class="icon-ok"></i> Pagado</span>
                          <?php } 
                              else
                              { ?>
                                    <a href="pagar.php?cita=<?php echo $datos['id']; ?>" class="btn btn-info btn-small"><i class="icon-credit-card"></i> Pagar</a>
                          <?php } 
                          } ?>
                      </td>
                    </tr>
<div id="<?php echo "myModaleditar".$l; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">¿Que desea hacer con la cita del paciente?</h3>
  </div>
  <div class="modal-body">
      <a href="<?php echo "#myModalfecha".$l; ?><?php  ?>" role="button" data-toggle="modal" class="btn btn-inverse">Cambiar Fecha</a>              
      <a href="<?php echo "#myModalcancelar".$l; ?><?php  ?>" role="button" data-toggle="modal" class="btn btn-primary">Cancelar cita</a>             
  </div>
  <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
  </div>
</div>



<div id="<?php echo "myModalfecha".$l; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">¿Esta seguro que desea Cambiar la Fecha de la cita del paciente <?php echo $paciente['nombre_completo']; ?> </h3>
    </div>
    <div class="modal-body">
        <form method="POST" action="../../PHP/recepcion/actualizar_fecha.php">
          <center>
            <input type="hidden" name="cita_id" value="<?php echo $datos['id'];?>"> 
            <input type="hidden" name="paciente_id" value="<?php echo $paciente['id'];?> ">
            <input type="date" name="fecha">
          </center>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
</div>

<div id="<?php echo "myModalcancelar".$l; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">¿Esta seguro que desea Cancelar la cita del paciente <?php echo $paciente['nombre_completo']; ?> </h3>
    </div>
    <div class="modal-body">
        <form method="POST" action="../../PHP/recepcion/cancelar_cita.php">
          <center>
              <input type="hidden" name="cita_id" value="<?php echo $datos['id'];?>"> 
              <input type="hidden" name="paciente_id" value="<?php echo $paciente['id'];?> ">
              <button type="submit" class="btn btn-danger">Cancelar Cita</button>
          </center>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
        </form>
    </div>
</div>
<?php 
    } 
    $l++;
    $u++; 
    } 
    }  
?>
        </tbody>
      </table>
    </div>
    </div>
    </div> <!-- /widget-content -->
</div> <!-- /widget -->

<!-- /////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////cita ma;ana////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////// -->

<div class="widget">
<div class="widget-header ">
<i class="icon-calendar"></i>
<?php 
$fecha_cita=date("2016-01-22");
$dias = array('','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
$fecha_dia = $dias[date('N', strtotime($fecha_cita))];?>
<h3>
<?php if ($fecha_dia=='Sabado') { ?>
Citas para el Lunes <?php echo date("2016-01-22", strtotime("+2 day")); ?></h3> <div Class"citas_manana"><?php  ?></div>
<?php  }else { ?>
Citas para mañana <?php echo date("2016-01-22", strtotime("+1 day")); ?></h3> <div Class"citas_manana"><?php  ?></div>
<?php  } ?>
</div> <!-- /widget-header -->
<div class="widget-content">
<div class="">		
<div class="table-responsive">
<table class="display table table-hover" id="dataTables-example">
<thead>
  <tr>
    <th>Nombre</th>
    <th width="150px">Nro de Móvil</th>
    <th>NºH</th>
    
    <th>Motivo</th>
    <th width="80px">Estado</th>
    <th>Acciones</th>
  </tr>
</thead>
<tbody>
<?php if($todas_las_citas_3)
$m=0;
{
while($datos_3=mysql_fetch_assoc($todas_las_citas_3)){ 
$paciente_id_3=$datos_3['paciente_id'];
$todos_paciente_3 = mysql_query("SELECT * FROM pacientes Where id=$paciente_id_3");
while($paciente_3 = mysql_fetch_array($todos_paciente_3)){      ?>
<?php if ($datos_3['fecha']== date("2016-01-22", strtotime("+2 day")) AND $fecha_dia=='Sabado' AND $datos_3['status']!=2 AND $datos_3['status']!=10 AND $datos_3['status']!=15 AND $datos_3['status']!=3)
 {  ?>
<tr >
<td><?php echo $paciente_3['nombre_completo']; ?></td>
<td> <?php echo $datos_3['nro_historia'];?> </td>
<td><?php echo $paciente_3['telefono'];  ?></td>

<td><?php echo $datos_3['tipo'];  ?></td>
<td>
  <?php if ( $datos_3['status']==0) : ?>
  <div class="confirmar segunda font-normal">Por Confirmar</div>
  <?php  
  elseif ($datos_3['status']==1) : ?>
  <div class="confirmada segunda font-normal">Confirmada</div>	
  <?php endif?>
</td>
<td class="iconos_reporte">
  <?php if ($datos_3['status']==1) {  ?>
  <a role="button" class="btn btn-default btn-small" role="button" data-toggle="modal" class="btn btn-default" href="<?php echo "#myModalcambiar".$m; ?>"><i class="icon-edit"></i> Editar</a>
  <?php }else {?>
  <a  role="button" class="btn btn-default btn-small porconfirmar" href="../../PHP/recepcion/comfirmar_cita.php?id=<?php echo $datos_3['id'];?>&status=<?php echo $datos_3['status'];?>"><i class="icon-check"></i> Confirmar</a>
  <a role="button" class="btn btn-default btn-small" role="button" data-toggle="modal" class="btn btn-default" href="<?php echo "#myModalcambiar".$m; ?>"><i class="icon-edit"></i> Editar</a>
  <?php }?>
</td>
</tr>


<div id="<?php echo "myModalcambiar".$m; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">¿Que desea hacer con la cita del paciente?</h3>
</div>
<div class="modal-body">
<a href="<?php echo "#myModalfecham".$m; ?><?php  ?>" role="button" data-toggle="modal" class="btn btn-inverse">Cambiar Fecha</a>             
<a href="<?php echo "#myModalcancelarm".$m; ?><?php  ?>" role="button" data-toggle="modal" class="btn btn-primary">Cancelar cita</a>              
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
</div>>
</div>
<div id="<?php echo "myModalfecham".$m; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">¿Esta seguro que desea Cambiar la Fecha de la cita del paciente <?php echo $paciente_3['nombre_completo']; ?> </h3>
</div>
<div class="modal-body">
<form method="POST" action="../../PHP/recepcion/actualizar_fecha.php">
<center>
<input type="hidden" name="cita_id" value="<?php echo $datos_3['id'];?>"> 
<input type="hidden" name="paciente_id" value="<?php echo $paciente_3['id'];?> ">
<input type="date" name="fecha">
</center>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
<button type="submit" class="btn btn-primary">Guardar Cambios</button>
</div>
</form>
</div>

<div id="<?php echo "myModalcancelarm".$m; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">¿Esta seguro que desea Cancelar cita del paciente <?php echo $paciente_3['nombre_completo']; ?> </h3>
</div>
<div class="modal-body">
<form method="POST" action="../../PHP/recepcion/cancelar_cita.php">
<center>
<input type="hidden" name="cita_id" value="<?php echo $datos_3['id'];?>"> 
<input type="hidden" name="paciente_id" value="<?php echo $paciente_3['id'];?> ">
<button type="submit" class="btn btn-danger">Cancelar Cita</button>
</center>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
</div>
</form>
</div>

<?php } elseif  ($datos_3['fecha']== date("2016-01-22", strtotime("+1 day")) AND $datos_3['status']!=2 AND $datos_3['status']!=10 AND $datos_3['status']!=15 AND $datos_3['status']!=3) { ?>
<tr class="odd gradeX">
<td><?php echo $paciente_3['nombre_completo']; ?></td>
<td><?php echo $paciente_3['telefono'];  ?></td>
<td> <?php echo $datos_3['nro_historia'];?> </td>
<td><?php echo $datos_3['tipo'];  ?></td>
<td>
<?php if ( $datos_3['status']==0) : ?>
<div class="confirmar segunda font-normal">Por Confirmar</div>
<?php  
elseif ($datos_3['status']==1) : ?>
<div class="confirmada segunda font-normal">Confirmada</div>	
<?php endif?>
</td>
<td class="iconos_reporte">
<?php if ($datos_3['status']==1) {  ?>
<a role="button"  data-toggle="modal" class="btn btn-default btn-small" href="<?php echo "#myModalcambiar".$m; ?>"><i class="icon-edit"></i> Editar</a>
<?php }else {?>
<a  role="button" class="btn btn-default btn-small porconfirmar" href="../../PHP/recepcion/comfirmar_cita.php?id=<?php echo $datos_3['id'];?>&status=<?php echo $datos_3['status'];?>"><i class="icon-check"></i> Confirmar</a>
<a role="button" class="btn btn-default btn-small" data-toggle="modal"  href="<?php echo "#myModalcambiar".$m; ?>"><i class="icon-edit"></i> Editar</a>
<?php }?>
</td>
</tr>


<div id="<?php echo "myModalcambiar".$m; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">¿Que desea hacer con la cita del paciente?</h3>
</div>
<div class="modal-body">
<a href="<?php echo "#myModalfecham".$m; ?><?php  ?>" role="button" data-toggle="modal" class="btn btn-inverse">Cambiar Fecha</a>             
<a href="<?php echo "#myModalcancelarm".$m; ?><?php  ?>" role="button" data-toggle="modal" class="btn btn-primary">Cancelar cita</a>              
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
</div>>
</div>
<div id="<?php echo "myModalfecham".$m; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">¿Esta seguro que desea Cambiar la Fecha de la cita del paciente <?php echo $paciente_3['nombre_completo']; ?> </h3>
</div>
<div class="modal-body">
<form method="POST" action="../../PHP/recepcion/actualizar_fecha.php">
<center>
<input type="hidden" name="cita_id" value="<?php echo $datos_3['id'];?>"> 
<input type="hidden" name="paciente_id" value="<?php echo $paciente_3['id'];?> ">
<input type="date" name="fecha">
</center>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
<button type="submit" class="btn btn-primary">Guardar Cambios</button>
</div>
</form>
</div>
<div id="<?php echo "myModalcancelarm".$m; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">¿Esta seguro que desea Cancelar cita del paciente <?php echo $paciente_3['nombre_completo']; ?> </h3>
</div>
<div class="modal-body">
<form method="POST" action="../../PHP/recepcion/cancelar_cita.php">
<center>
<input type="hidden" name="cita_id" value="<?php echo $datos_3['id'];?>"> 
<input type="hidden" name="paciente_id" value="<?php echo $paciente_3['id'];?> ">
<button type="submit" class="btn btn-danger">Cancelar Cita</button>
</center>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
</div>
</form>
</div>
<?php } ?>
<?php  $m++; }} } ?>
</tbody>
</table>
</div>
</div>
</div> <!-- /widget-content -->
</div>
<!-- /////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////// -->	
<div class="widget">
<div class="widget-header ">
<i class="icon-star"></i>
<h3>Citas medicas por fecha</h3>
</div> <!-- /widget-header -->
<div class="widget-content inicio">
<div class="posicion">		
<form  id="formulario" method="post" action="./buscar_cita_fecha.php">
<div class="login-fields">
<center><p class="texto">Introduzca la fecha a buscar</p>
<div class="field"><i class="icon-pencil cedula"></i>
<input type="date" id="fecha" name="fecha" value=""  class="date" />
</div> <!-- /field -->
</center>
</div> <!-- /login-fields -->
<div class="login-actions">
<center>   <input class="button btn btn-success btn-large" type="submit" name="aceptar" value="Buscar" class="aceptar">       
</center>
</div> <!-- .actions -->
</form>   </div>
</div> <!-- /widget-content -->
</div> <!-- /widget -->												
</div> <!-- /row -->
</div> <!-- /container -->
</body>
</html>


<script type="text/javascript">
  $(document).ready(function(){
    $('.tip').tooltip();
  });
</script>