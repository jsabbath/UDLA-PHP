<?php 
$header=1;
$activo=8;
require('../../header.php');
include("../../PHP/paciente/consultas_historia.php"); 
include('../../PHP/funciones.php');
$persona = $_GET['persona'];
$mes_actual = $_GET['mes']; //06; // date('m');
?>
<link href="../../../datatables/dataTables.bootstrap.css" rel="stylesheet">
<script src="../../../datatables/dataTables.bootstrap.js"></script>
<script src="../../../datatables/jquery.dataTables.js"></script>


<?php $procedimientos = mysql_query("SELECT * FROM porcentaje WHERE ID = '{$persona}' LIMIT 1 "); ?>
    <div class="container">
      <div class="row">
      <center> 
        <br> <h2>Reporte: <?php echo fecha_mes($mes_actual); ?> </h2> <br> 
      </center>

<?php if(mysql_num_rows($procedimientos) > 0 ){
          $datos=mysql_fetch_assoc($procedimientos) ?>
<div class="span12">
          <div class="widget">
            <div class="widget-header">
                <div class="span9 doctor"><i class="icon-file"></i>
                <h3>Reporte <?php echo $datos['nombre']; ?> </h3></div>
            	 <form action="ficheroExcel.php" method="POST" target="_blank" id="FormularioExportacion">
                    <button type="button" class="botonExcel btn btn-success pull-right"><i class="icon-file-text-alt"></i> Exportar a Excel</button>
                    <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
                    <input type="hidden" id="mes" name="mes" value="<?php echo $mes_actual; ?>" />
                    <input type="hidden" id="nombre" value="<?php echo $datos['nombre']; ?>"  name="nombre" />
                </form>
            </div>
            <div class="widget-content">
                
                <table class="table table-striped table-bordered table-hover"  id="dataTables-example">

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
              $precio_tratamiento=0;
              $precio_total_tratamiento=0;
              $total_ganancias=0;
              $i=1;
              
              $reportes = mysql_query("SELECT * FROM reportes Where usuario_id = '{$persona}' AND MONTH(ctreated_at) = '$mes_actual' ");

              while($reporte = mysql_fetch_array($reportes)){
                
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
                  $precio_total_tratamiento=$precio_tr['precio']+$precio_total_tratamiento;
            
                if ($precio_tratamiento != 0) {  ?>
                    <tr class="odd gradeX">
                        <td><?php  echo $i; $i++ ?></td>
                        <td><?php  echo $precio_tr['nombre']; ?></td>
                        <td><?php  echo $paciente['nombre_completo']; ?></td>
                        <td><?php  echo $reporte['ctreated_at']; ?></td>
                        <td>
                            <?php
                              echo  $precio_tratamiento." Bsf";
                              $por= $precio_tratamiento * $datos['dividendo'];
                              $porciento=$por/100;
                            ?>
                        </td>
                        <td><?php echo $datos['dividendo']." %"; ?></td>
                        <td>
                            <?php
                              echo   $porciento." Bsf";
                              $total_ganancias=$porciento + $total_ganancias;
                            ?>
                        </td>
                    </tr>
          <?php } //cierra if precio 

            } //cierra while reporte ?>

            <tr>
              <td colspan="4"></td>
              <td colspan="2"> <strong>Total Facturado: </strong> </td>
              <td colspan=""><strong><?php echo $precio_total_tratamiento." Bsf"; ?></strong></td>
            </tr>
            <tr>
              <td colspan="4"></td>
              <td colspan="2"><strong>Total en porcentaje de Ganancias:</strong></td>
              <td colspan=""><strong><?php echo $total_ganancias." Bsf"; ?></strong></td>
            </tr>
          </tbody>
        </table>

        <div class="resultados">
          <strong>Total Facturado: <?php echo $precio_total_tratamiento." Bsf"; ?></strong><br>
          <strong>Total en porcentaje de Ganancias: <?php echo $total_ganancias." Bsf"; ?></strong>
        </div>

       
         </div>
         </div>
         
         </div>

      <?php } ?>
          	
  </div>
</div>

<script language="javascript">
  $(document).ready(function() {
  $(".botonExcel").click(function(event) {
  $("#datos_a_enviar").val( $("<div>").append( $("#dataTables-example").eq(0).clone()).html());
  $("#FormularioExportacion").submit();
  });
  });
</script>