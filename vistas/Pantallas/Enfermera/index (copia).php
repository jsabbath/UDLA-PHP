<?php 
$header=2;
$activo=1;
require('../../header.php');?>
<?php include("../../PHP/funciones.php"); ?>

<div class="container">
    <br>
		<div class="row">
		  <div class="span12">
             
      <div class="widget">
          <div class="widget-header ">
              <i class="icon-star"></i>
              <h3>Recepcion pacientes en espera</h3>
          </div> <!-- /widget-header -->
          <div class="widget-content">
            <div class="posicion segunda">
                <table class="display table table-hover">
                  <thead>
                    <tr>
                      <th>Orden</th>
                      <th>Nombre</th>
                      <th>Remitido</th>
                      <th>Motivo</th>
                      <th>Estado</th>
                      <th>Entrada</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $n=1;
                  $i=0;
                  $fecha_dato=date('Y-m-d');
                  $citas_espera = mysql_query("SELECT citas.*, pacientes.id As id_pac,pacientes.nombre_completo 
                      FROM citas
                      INNER JOIN pacientes ON citas.paciente_id = pacientes.id
                      WHERE fecha = '{$hoy}' AND (status = 2 OR status = 100) 
                                      ORDER BY updated_at ASC");
                  while($datos_2=mysql_fetch_assoc($citas_espera)){ 
                                    $paciente_id_2=$datos_2['paciente_id'];
                                    $todos_paciente_2 = mysql_query("SELECT * FROM pacientes Where id=$paciente_id_2");
                                    $paciente_2 = mysql_fetch_assoc($todos_paciente_2);  
                                    $hf= $datos_2['updated_at'];
                                    $hora= explode(" ", $hf);
                                    $hora_llegada= $hora[1];

                         if ($datos_2['fecha']== date('Y-m-d') AND ($datos_2['status']==2 OR $datos_2['status']==100) AND $datos_2['remitido']!='Especialista') {             
                  ?>                

                                   
                  <tr class="odd gradeX">
                  <td><?php echo $n; $n++; ?></td>
                  <td><?php echo $paciente_2['nombre_completo']; ?></td>
                  <td><?php echo $datos_2['remitido']; ?></td>
                  <td><?php echo $datos_2['tipo']; ?></td>
                  <td>

                  <?php if ($datos_2['status']==100) { ?>
                  <div class="parpadea text ausente">Ausente</div> </td>
                  <?php }else {?>  
                  <div class="parpadea text">En espera</div> </td> <?php } ?>


                  <td class="iconos_reporte"><?php echo $hora_llegada; ?></td>
                    <td class="iconos_reporte">
                  <a href="<?php echo "#myModalProsedimientos".$i; ?>" role="button" data-toggle="modal" class="btn btn-default">Procedimientos</a>
                    <?php if ($datos_2['status']==100) { ?>
                   <a role="button" class="btn btn-default not-active" dissable href="">Iniciar Proceso</a>
                 
                  <?php }else {?>  
                   <a role="button" class="btn btn-default" href="../../PHP/enfermera/confirmacion.php?id=<?php echo $datos_2['id'];?>&status=<?php echo $datos_2['status'];?>&paciente=<?php echo $paciente_2['id'];?>">Iniciar Proceso</a>
                 
                 <?php } ?>


                 
                  </td>
                    
                  </tr>
                 <div id="<?php echo "myModalProsedimientos".$i; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h3 id="myModalLabel"><i class="icon-edit"></i> Prosedimientos que posee el paciente <?php echo $paciente_2['nombre_completo'];  ?></h3>
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





                  <?php   } $i++; }   ?>
                  </tbody></table>
                   </div>

</div>
</div>
</div>
</div>
</div>



               
