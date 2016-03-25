<?php 
$header=1;
$activo=1;
require('../../header.php');?>
<?php //include("../../PHP/especialista/consultas.php"); ?>
<?php //include("../../PHP/paciente/consultas_historia.php"); ?>
<?php include("../../PHP/funciones.php"); 
//include('../../PHP/recepcion/conecciones.php');
date_default_timezone_set('America/Caracas');
$hoy = date('Y-m-d'); 
?>

       
        <div class="container">
        <br>
             <div class="row-fluid">
<!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->        
     
 <div class="span6">

            <div class="widget">
          <div class="widget-header">
            <i class="icon-user"></i>
            <h3>Paciente registrado</h3>
          </div> <!-- /widget-header -->
          
          <div class="widget-content inicio">
      <div class="posicion">      
           <form  id="formulario" method="post" action="../../PHP/especialista/buscar_paciente.php">
      
          <div class="login-fields">
              <?php 
              if(isset($_GET['error'])){
               echo '<center class="alert alert-error paciente"><button type="button" class="close" data-dismiss="alert">×</button>Paciente no Registrado</center>';
               }
               ?>
          <center><p class="texto">Introduzca la cedula del paciente</p>
     
           <div class="field"><i class="icon-pencil cedula"></i>
            <select name="ci" class="span1">
              <option>V</option>
              <option>E</option>
              <option>P</option>

            </select>
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
  <!-- /////////////////////////////////////////////////////////////////////////////////////////-->
<!-- /////////////////////////////////////////////////////////////////////////////////////////-->
<!-- ///////////////////////////////Cuarto cuadro/////////////////////////////////////////////-->
<!-- /////////////////////////////Pacientes en espera//////////////////////////////////////////-->
<!-- /////////////////////////////////////////////////////////////////////////////////////////-->
<!-- /////////////////////////////////////////////////////////////////////////////////////////-->                
  

  <div class="widget">
          <div class="widget-header ">
            <i class="icon-star"></i>
            <h3>Pacientes en cabina</h3>
          </div> <!-- /widget-header -->
          
                   

  <div class="widget-content inicio_especialista">
          
           <div class="posicion segunda">    
                  <div class="table-responsive" >
                  <table class="display table table-hover" id="">
                  <thead>
                  <tr>
                  <th>Nombre</th>
                  <th>Area</th>
                  <th>Estado</th>
                  <th >Acciones</th>

                  </tr>
                  </thead>
                  <tbody> 

                 <?php 
                  $datos_cabina = mysql_query("SELECT * FROM citas WHERE
                                  fecha = '{$hoy}' AND
                                  status = 15 AND
                                  (remitido = 'Cabina' OR remitido = 'Recidente')
                                  ");
                  while($datos_3 = mysql_fetch_assoc($datos_cabina)){ 
                ?>

                  <tr class="odd gradeX">

                    <td>
                      <?php
                        $name_2 = mysql_query("SELECT nombre_completo FROM pacientes WHERE 
                                  id = '{$datos_3['paciente_id']}' ");
                        $name2 = mysql_fetch_assoc($name_2);
                        echo $name2['nombre_completo'];
                      ?> 
                    </td>  
                    <td><?php echo $datos_3['remitido'];  ?></td>
                    <td>
                        <div class="proceso parpadea_2 font-normal">En Proceso</div>
                    </td>                                 
                    <td> 
                        <a class="btn" href="ver_historial.php?paciente=<?php echo $paciente_3['id']; ?>&cita=<?php echo $datos_3['id']; ?>">ver</a>                  
                    </td>                                 
                    <td> 
                        <a class="btn" href="../../PHP/especialista/debug.php?paciente=<?php echo $paciente_3['id']; ?>&cita=<?php echo $datos_3['id']; ?>">Eliminar</a>
                    </td> 
                  </tr>
                  
                  <?php  } ?>
                  </tbody>
                </table>

              </div>

      </div>
    </div>
</div>

<!-- /////////////////////////////////////////////////////////////////////////////////////////-->
<!-- /////////////////////////////////////////////////////////////////////////////////////////-->
<!-- ///////////////////////////////Cuarto cuadro/////////////////////////////////////////////-->
<!-- /////////////////////////////Pacientes en espera//////////////////////////////////////////-->
<!-- /////////////////////////////////////////////////////////////////////////////////////////-->
<!-- /////////////////////////////////////////////////////////////////////////////////////////-->
 <div class="widget">
          <div class="widget-header ">
            <i class="icon-star"></i>
            <h3>Solicitudes</h3>
          </div> <!-- /widget-header -->


  <div class="widget-content inicio_especialista">

           <div class="posicion segunda">
                  <div class="table-responsive" >
                  <table class="display table table-hover">
                  <thead>
                  <tr>
                  <th>Nombre del solicitante</th>
                  <th>Paciente</th>
                  <th>fecha</th>

                   <th>Acciones</th>

                  </tr>
                  </thead>
                  <tbody>
                    <?php
                       $consulta_solicitudes =mysql_query("SELECT * FROM cambio_tratamiento");
                      while($solicitud=mysql_fetch_assoc($consulta_solicitudes)){
                                    $usuario_id=$solicitud['usuario_id'];
                                    $consulta_usuario = mysql_query("SELECT * FROM usuarios WHERE id=$usuario_id");
                                   $usuario_solo = mysql_fetch_array($consulta_usuario);
                                    $paciente_id=$solicitud['paciente_id'];
                                    $consulta_paciente = mysql_query("SELECT * FROM pacientes WHERE id=$paciente_id");
                                    $paciente_solo = mysql_fetch_array($consulta_paciente);


                    if ($solicitud['status']==0) { ?>
                 <td><?php echo $usuario_solo['nombre'].' '.$usuario_solo['apellido']; ?></td>
                  <td><?php echo $paciente_solo['nombre_completo'];  ?></td>
                  <td><?php echo $solicitud['created_at'];  ?></td>
                  <td> 
                    <a href="../../Pantallas/Especialista/solicitud_cambio_tratamiento.php?paciente=<?php echo $paciente_solo['id'];?>&id=<?php echo $solicitud['tratamiento_id'];?>" class="btn btn-default">Ver Detalles</a>
                  </td>

                  <?php }
                   }

                    ?>



                  </tbody>
                  </table>

                  </div>

</div>
</div>
</div>
  </div>     

<!-- /////////////////////////////////////////////////////////////////////////////////////////-->
<!-- /////////////////////////////////////////////////////////////////////////////////////////-->
<!-- ///////////////////////////////Cuarto cuadro/////////////////////////////////////////////-->
<!-- /////////////////////////////Pacientes en espera//////////////////////////////////////////-->
<!-- /////////////////////////////////////////////////////////////////////////////////////////-->
<!-- /////////////////////////////////////////////////////////////////////////////////////////-->
<div class="span6">
           
            <div class="widget">
            <div class="widget-header ">
            <i class="icon-group"></i>
            <h3>Sala de espera para especialista</h3>
              <?php 
              if(isset($_GET['guardo'])){
               echo '<Center class="alert alert-error paciente_espera"><button type="button" class="close" data-dismiss="alert">×</button>Finalize con el paciente actual primero</Center>';
               }
               ?>
            
            </div> <!-- /widget-header -->
            
          <div class="widget-content inicio_especialista">
            <div class="posicion segunda">    
                  <div class="table-responsive">
                  <table class="display table table-hover">
                  <thead>
                  <tr>
                  <th>Orden</th>
                  <th>Nombre</th>
                  <th>Motivo</th>
                  <th>Estado</th>
                  <th>Entrada</th>
                  <th>Estado</th>
                  
                  </tr>
                  </thead>
                  <tbody> 
                  <?php  
                  $cita_espera = mysql_query("SELECT * FROM citas WHERE
                                            fecha = '{$hoy}' AND
                                            (status = 2 OR status = 100 ) AND
                                            remitido != 'Cabina'
                                            ORDER BY updated_at ASC");
                  $i=1;
                  while($dato_espera = mysql_fetch_assoc($cita_espera)){ ?>
                 
                 
                 <tr class="odd gradeX">
                    <td><?php echo $i; $i++; ?></td>
                    <td>
                      <?php
                        $nombre = mysql_query("SELECT id, nombre_completo FROM pacientes WHERE 
                                  id = '{$dato_espera['paciente_id']}' ");
                        $name_pac = mysql_fetch_assoc($nombre);
                        echo $name_pac['nombre_completo'];
                      ?> 
                    </td>

                    <td><?php echo $dato_espera['tipo'];  ?></td>


                   <td>
                      <?php if ($dato_espera['status']==100) { ?>
                      <div class="parpadea text ausente">Ausente</div> 
                  </td>
                    <?php }else {?>  
                    <div cl<div class="parpadea text">
                    <a href="../../PHP/recepcion/comfirmar_cita.php?id=<?php echo $dato_espera['id'];?>&status=<?php echo $dato_espera['status'];?>&paciente=<?php echo $name_pac['id'];?>">En espera</a></div> 
                  </td> <?php } ?>

                 

                  <td>
                    <?php
                       $hf_1= $dato_espera['updated_at'];
                        $hora_1= explode(" ", $hf_1);
                        $hora_llegada_1= $hora_1[1];
                        echo $hora_llegada_1;
                    ?>
                </td>
                <td>
                  <?php if($dato_espera['status_pago'] == 1){ ?>
                    <span class="label label-success font14 labels"><i class="icon-ok"></i> Pagado</span>
                  <?php }
                  else { ?>
                    <span class="label  font14 labels"><i class="icon-remove"></i> No Pago</span>
                  <?php }
                  ?>
                </td>

                    </tr>

                   <?php }?>

                          </tbody>
                  </table>

                  </div>

</div>
</div>
</div>

<!-- /////////////////////////////////////////////////////////////////////////////////////////-->
<!-- /////////////////////////////////////////////////////////////////////////////////////////-->
<!-- ///////////////////////////////Cuarto cuadro/////////////////////////////////////////////-->
<!-- /////////////////////////////Solicitudes//////////////////////////////////////////-->
<!-- /////////////////////////////////////////////////////////////////////////////////////////-->
<!-- /////////////////////////////////////////////////////////////////////////////////////////-->

    <div class="widget">
      <div class="widget-header ">
            <i class="icon-star"></i>
            <h3>Recepcion pacientes en espera</h3>
      </div> <!-- /widget-header -->


      <div class="widget-content inicio_especialista">

           <div class="posicion segunda">
              <div class="table-responsive" >
                <table class="display table table-hover">
                  <thead>
                    <tr>
                      <th>Orden</th>
                      <th>Nombre</th>
                      <th>Remitido</th>
                      <th>Motivo</th>
                      <th>Estado</th>
                      <th>Entrada</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $n=1;
                      $fecha_dato=date('Y-m-d');
                      $todas_las_citas_2 = mysql_query("SELECT * FROM citas WHERE 
                                          fecha='$fecha_dato' AND 
                                          (status=2 OR status=100) AND
                                          remitido != 'Especialista'
                                          ORDER BY updated_at ASC");

                      while($datos_2=mysql_fetch_assoc($todas_las_citas_2)){ 

                          $paciente_id_2=$datos_2['paciente_id'];
                          $todos_paciente_2 = mysql_query("SELECT nombre_completo FROM pacientes Where id=$paciente_id_2");
                          $paciente_2 = mysql_fetch_assoc($todos_paciente_2);  
                          $hf= $datos_2['updated_at'];
                          $hora= explode(" ", $hf);
                          $hora_llegada= $hora[1];            
                    ?>                
                                
                  <tr class="odd gradeX">
                    <td><?php echo $n; $n++; ?></td>
                    <td><?php echo $paciente_2['nombre_completo']; ?></td>
                    <td><?php echo $datos_2['remitido'];  ?></td>
                    <td><?php echo $datos_2['tipo'];  ?></td>
                           <td>

                    <?php if ($datos_2['status']==100) { ?>
                    <div class="parpadea text ausente">Ausente</div> </td>
                    <?php }else {?>  
                    <div class="parpadea text">En espera</div> </td> <?php } ?>
                    <td class="iconos_reporte">
                    <?php echo $hora_llegada; ?>  
                    </td>                  
                  </tr>                  
                  <?php   }  ?>
              </tbody>
            </table>

      

      </div>

</div>
</div>
</div>
</div>
      
 <!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->
<!--///////////////HCitas canceladas////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////-->



          </div> <!-- /widget-content -->

        </div> <!-- /widget -->

        </div> <!-- /span6 -->


        </div> <!-- /row -->

      </div> <!-- /container -->