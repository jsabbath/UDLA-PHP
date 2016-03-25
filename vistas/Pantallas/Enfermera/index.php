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
              <table class="table table-condensed table-hover">
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
                $hoy = date('2016-01-19');
                $citas_espera = mysql_query("SELECT citas.*, pacientes.id As id_pac, pacientes.nombre_completo 
                    FROM citas
                    INNER JOIN pacientes ON citas.paciente_id = pacientes.id
                    WHERE citas.fecha = '{$hoy}' AND citas.remitido = 'Cabina' AND citas.status = 2
                    ORDER BY updated_at ASC");
                while($esperas = mysql_fetch_assoc($citas_espera)){ 
                ?> 
                  <tr>
                    <td><?php echo $n; $n++; ?> </td>
                    <td><?php echo $esperas['nombre_completo']; ?> </td>
                    <td><?php echo $esperas['remitido']; ?> </td>
                    <td><?php echo $esperas['tipo']; ?> </td>
                    <td>                                         
                        <div class="parpadea text">En espera</div> 
                    </td>
                    <td>
                      <?php $hora = explode(" ", $esperas['updated_at']);
                                $hora_llegada= $hora[1];
                                echo $hora_llegada; 
                              ?> 
                    </td>
                    <td>                                 
                      <!--  boton de paquete - -->
                      <button onclick="verProcedimientos('<?php echo $esperas['paquete_ap_id']; ?>');" type="button" data-toggle="tooltip" title="Ver Procedimientos del Paquete" class="btn btn-inverse btn-small"><i class="icon-asterisk"></i> Paquete</button>
                      <!--  boton de inicio - -->
                      <a href="../../PHP/enfermera/confirmacion.php?id=<?php echo $esperas['id'];?>&status=<?php echo $esperas['status'];?>&paciente=<?php echo $esperas['id_pac'];?>" class="btn btn-default">Iniciar</a>
                    </td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
        </div> <!--  widget -->


        <div class="widget">
            <div class="widget-header ">
                <i class="icon-star"></i>
                <h3>Pacientes con Procedimientos en Proceso</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">            
              <table class="table table-condensed table-hover">
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
                $n1=1;
                
                $citas_proceso = mysql_query("SELECT citas.*, pacientes.id As id_pac, pacientes.nombre_completo 
                    FROM citas
                    INNER JOIN pacientes ON citas.paciente_id = pacientes.id
                    WHERE citas.fecha = '{$hoy}' AND citas.remitido = 'Cabina' AND citas.status = 15
                    ORDER BY updated_at ASC");
                while($procesos = mysql_fetch_assoc($citas_proceso)){ 
                ?> 
                  <tr>
                    <td><?php echo $n1; $n1++; ?> </td>
                    <td><?php echo $procesos['nombre_completo']; ?> </td>
                    <td><?php echo $procesos['remitido']; ?> </td>
                    <td><?php echo $procesos['tipo']; ?> </td>
                    <td>                                         
                        <div class="parpadea text">En espera</div> 
                    </td>
                    <td>
                      <?php $hora = explode(" ", $procesos['updated_at']);
                                $hora_llegada= $hora[1];
                                echo $hora_llegada; 
                              ?> 
                    </td>
                    <td>                                 
                      <!--  boton de paquete - -->
                      <button onclick="verProcedimientos('<?php echo $procesos['paquete_ap_id']; ?>');" type="button" data-toggle="tooltip" title="Ver Procedimientos del Paquete" class="btn btn-inverse btn-small"><i class="icon-asterisk"></i> Paquete</button>
                      <!--  boton de inicio - -->
                      <a href="tratamientos_paciente.php?cita=<?php echo $procesos['id'];?>&paciente=<?php echo $procesos['id_pac'];?>" class="btn btn-default">Continuar</a>
                    </td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
        </div> <!--  widget -->
    </div>
  </div>
</div>

<script src="../Recepcion/inicioRecepcion.js"></script>

<!-- Modal Procedimientos -->
<div id="myModalProc" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Procedimientos del Paquete:</h3>
  </div>
  <div class="modal-body">
    <table class="table table-condensed">
      <thead>
        <tr>
          <th>Procedimientos</th>
          <th>Parte</th>
          <th>Sesiones</th>
          <th>Precio</th>
        </tr>
      </thead>
      <tbody id="datos">
        
      </tbody>
    </table>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
  </div>
</div>
               
