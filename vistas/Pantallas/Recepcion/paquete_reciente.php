  
    <?php 
      include "../../config/datos.php";
      date_default_timezone_set('America/Caracas');
      $hoy = date('Y-m-d');
      $paq_hoy = mysql_query("SELECT * FROM paquetes WHERE 
                  created_at = '{$hoy}' AND 
                  (status = 0 OR status = 1)
                  ");
      if (mysql_num_rows($paq_hoy) > 0) { ?>

      <div class="span3">
        <hr>
      </div>
      <div class="span6">
      <div class="widget">
        <div class="widget-header">
          <i class="icon-ok"></i>
          <strong>Paquetes Recien Cargados <?php echo date('h:i:s a'); ?></strong>
        </div>
        <div class="widget-content content-new">
            <table class="table">
              <thead>
                <tr>
                  <th>Nro</th>
                  <th>Paciente</th>
                  <th>Telefono</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $nro = 1;
                  while ($paq = mysql_fetch_assoc($paq_hoy)) {
                      $pact = mysql_query("SELECT id, nombre_completo, telefono FROM pacientes WHERE id = '{$paq['paciente_id']}' LIMIT 1 ");
                      $pacte = mysql_fetch_assoc($pact);
                    ?>
                    <tr>
                      <td class="padding-small"><?php echo $nro; $nro++; ?></td>
                      <td class="padding-small"><?php echo $pacte['nombre_completo'];?> </td>
                      <td class="padding-small"><?php echo $pacte['telefono'];?> </td>
                      <td class="padding-small"><?php
                        if ($paq['status'] == "0") { ?>
                            <span class="label label-warning">Sin Revisar</span>
                      <?php }
                      else { ?>
                            <span class="label label-warning">Sin Revisar</span>
                      <?php } ?> 
                      </td>
                      <td class="padding-small"> <a href="../../PHP/recepcion/paquete_status.php?paciente=<?php echo $pacte['id'];?>&paquete=<?php echo $paq['id']; ?>" title="" class="btn btn-small" target="_blank"><i class="icon-briefcase"></i> Ir a Paquetes</a> </td>
                    </tr>
                 <?php }
                 ?>
              </tbody>
            </table>
            </div>
          </div>
          </div>
          <div class="span3">
            <hr>
          </div>
  <?php }  ?>
        