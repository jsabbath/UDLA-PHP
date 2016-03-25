<?php 
$header=1;
$activo=8;
require('../../header.php');
include("../../PHP/paciente/consultas_historia.php"); 
include('../../PHP/funciones.php');
date_default_timezone_set('America/Caracas');
if (isset($_POST['fecha'])) {
    $fecha = $_POST['fecha'];
}
else
{
    $fecha = date('Y-m-d');
}
$consulta = "SELECT reportes.*, 
            pacientes.id, pacientes.nombre_completo, 
            tratamientos.nombre as tratamiento, tratamientos.id, 
            porcentaje.*, lista_tratamientos.nombre as trat_lista, lista_tratamientos.precio
            FROM reportes
            INNER JOIN pacientes ON pacientes.id = reportes.paciente_id
            INNER JOIN tratamientos ON tratamientos.id = reportes.tratamiento_id
            INNER JOIN porcentaje ON porcentaje.id = reportes.usuario_id
            INNER JOIN lista_tratamientos ON tratamientos.nombre = lista_tratamientos.nombre
            WHERE reportes.ctreated_at = '{$fecha}'";
$reportes = mysql_query($consulta);
?>

<div class="container">
  <div class="row">

    <div class="span12">
      <center>
      <form action="" method="POST" class="form-inline" accept-charset="utf-8">       
        <div class="control-group">
        <br>
            <p>Seleccione otra fecha para visualizar el reporte.</p>
            <input type="date" name="fecha" required>
            <button type="submit" class="btn btn-default">Buscar</button>
        </div>
      </form>
        <h2>Productividad General: <?php echo strftime('%d %b de %G', strtotime($fecha)); ?> </h2>
        <small>solo se incluyen procedimientos aplicados.</small>
         <br> 
      </center>
    </div>

<div class="span12">
    <div class="widget">
      <div class="widget-header">
          <div class="span9 doctor"><i class="icon-file"></i>
              <h3>Productividad General: <?php echo strftime('%d %b de %G', strtotime($fecha)); ?></h3>
          </div>
          <form action="ficheroExcel2.php" method="POST" target="_blank" id="FormularioExportacion">
              <button type="button" class="botonExcel btn btn-success pull-right"><i class="icon-file-text-alt"></i> Exportar a Excel</button>
              <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
              <input type="hidden" id="mes" name="mes" value="<?php echo $mes_actual; ?>" />
              <input type="hidden" id="nombre" value="Productividad General: <?php echo strftime('%d %b de %G', strtotime($fecha)); ?>"  name="nombre" />
          </form>
      </div>
      <div class="widget-content">
                
        <table class="table table-hover table-condensed" >

          <thead>
            <tr>
              <th>Nro</th>
              <th>Paciente</th>
              <th>Procedimientos</th>
              <th>Aplicado Por</th>
              <th>Fecha de Aplicacion</th>
              <th>Porcentaje</th>
              <th>Precio</th>              
              <th>Bono</th>
            </tr>
          </thead>
          
          <tbody>
            <?php 
              $nro = 1;
              $bonos = 0;
              $ganacias = 0;
              while ($datos = mysql_fetch_assoc($reportes)) {
            ?>
                <tr>
                  <td><?php echo $nro; $nro++; ?></td>
                  <td><?php echo $datos['nombre_completo']; ?> </td>
                  <td><?php echo $datos['tratamiento']; ?> </td>                  
                  <td><?php echo $datos['nombre']; ?> </td>
                  <td><?php echo strftime('%d %b de %G', strtotime($datos['ctreated_at'])); ?> </td>
                  <td><?php echo $datos['dividendo']; ?>% </td>
                  <td><?php echo number_format($datos['precio']); ?>.BS </td>
                  <td>
                    <?php 
                      $porcentaje = $datos['precio'] * $datos['dividendo'];
                      $porcentaje = $porcentaje / 100;
                      echo number_format($porcentaje);
                    ?>Bs
                  </td>
                </tr>
                <?php
                  $precio_final = $datos['precio'] - $porcentaje;
                  $ganacias = $ganacias + $precio_final;
                  $bonos = $bonos + $porcentaje;
                ?>
            <?php } ?>  
          </tbody>
          <tfooter> 
            <tr>
                <td colspan="6"></td>
                <td class="resultados">
                  <strong><?php echo number_format($ganacias); ?> Bs</strong>
                </td>
                <td class="resultados">
                  <strong><?php echo number_format($bonos); ?> Bs</strong>
                </td>
            </tr>
          </tfooter>
        </table>

        <div class="resultados">
          <strong>Ganancia Total: <?php echo number_format($ganacias); ?> Bs</strong><br>
          <strong>Total en Bonos a Personal: <?php echo number_format($bonos); ?> Bs</strong>
        </div>      
      </div> <!-- widget-content -->
    </div> <!-- widget -->
         
  </div> <!-- span12 -->
          	
  </div> <!-- row -->
</div> <!-- container -->

<script language="javascript">
  $(document).ready(function() {
    $(".botonExcel").click(function(event) {
        $("#datos_a_enviar").val( $("<div>").append( $("#dataTables-example").eq(0).clone()).html());
        $("#FormularioExportacion").submit();
    });
  });
</script>