  <?php 
$header=1;
$activo=5;
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
</script>


<div class="main">
  <div class="main-inner">
    <div class="container">
            <div class="row">

            <div class="span6">

             


                  <div class="widget">
                  <div class="widget-header ">
                  <i class="icon-calendar"></i>
                  <h3>Citas para hoy</h3> <div Class"citas_manana"><?php  ?></div>
                  
                  </div> <!-- /widget-header -->
                  
                  <div class="widget-content">
                  <div class="">    
                  
                  <div class="table-responsive">
                  <table class="display table table-hover" id="dataTables-example">
                  <thead>
                  <tr>
                  <th>Nombre</th>
                  <th>Nro de Móvil</th>
                  <th>Motivo</th>
                  <th>Estado</th>
                 
                  </tr>
                  </thead>
                  <tbody>
                  <?php if($todas_las_citas){
                  while($datos=mysql_fetch_assoc($todas_las_citas)){ 
                                    $paciente_id=$datos['paciente_id'];
                                    $todos_paciente = mysql_query("SELECT * FROM pacientes Where id=$paciente_id");
                                    while($paciente = mysql_fetch_array($todos_paciente)){      ?>

                                    <?php if ($datos['fecha']== date('Y-m-d') AND $datos['status']!=2 AND $datos['status']!=10 AND $datos['status']!=15 AND $datos['status']!=3 ): ?>
                  <tr class="odd gradeX">
                  
                  <td><?php echo $paciente['nombre_completo']; ?></td>
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
                              
             
                    
                  </tr>
                    <?php endif ?>


                  <?php   }} } ?>

                  </tbody>
                  </table>
                  
                  </div>
                  
                  
                  </div>
                  </div> <!-- /widget-content -->
                  
                  
                  
                  
                  
                  
                  </div> <!-- /widget -->
                  


                
                  


        
      </div>
      <div class="span6">

  
              <div class="widget">
                  <div class="widget-header ">
                  <i class="icon-calendar"></i>
                  <h3>Citas para mañana <?php echo date("Y-m-d", strtotime("+1 day")); ?></h3> <div Class"citas_manana"><?php  ?></div>
                  
                  </div> <!-- /widget-header -->
                  
                  <div class="widget-content">
                  <div class="">    
                  
                  <div class="table-responsive">
                  <table class="display table table-hover" id="dataTables-example">
                  <thead>
                  <tr>
                  <th>Nombre</th>
                  <th>Nro de Móvil</th>
                  <th>Motivo</th>
                  <th>Estado</th>
                
                  </tr>
                  </thead>
                  <tbody>
                  <?php if($todas_las_citas_3){
                  while($datos_3=mysql_fetch_assoc($todas_las_citas_3)){ 
                                    $paciente_id_3=$datos_3['paciente_id'];
                                    $todos_paciente_3 = mysql_query("SELECT * FROM pacientes Where id=$paciente_id_3");
                                    while($paciente_3 = mysql_fetch_array($todos_paciente_3)){      ?>

                                    <?php if ($datos_3['fecha']== date("Y-m-d", strtotime("+1 day")) AND $datos_3['status']!=2 AND $datos_3['status']!=10 AND $datos_3['status']!=15 AND $datos_3['status']!=3): ?>
                  <tr class="odd gradeX">
                  
                  <td><?php echo $paciente_3['nombre_completo']; ?></td>
                  <td><?php echo $paciente_3['telefono'];  ?></td>
                  <td><?php echo $datos_3['tipo'];  ?></td>
                  <td>
                  <?php if ( $datos_3['status']==0) : ?>
                  <div class="confirmar segunda">Por Confirmar</div>
                  <?php  
                  elseif ($datos_3['status']==1) : ?>
                  <div class="confirmada segunda">Confirmada</div>  
                                    <?php endif?>
                                 </td>
                              
           
                    
                  </tr>
                
                    <?php endif ?>


                  <?php   }} } ?>
                  </tbody>
                  </table>
                  
                  </div>
                  
                  
                  </div>
                  </div> <!-- /widget-content -->
                  
                  
                                
                  
  



        </div> <!-- /row -->
        
      </div> <!-- /container -->
      
  </div> <!-- /main-inner -->
    
</div> <!-- /main -->

</body>
</html>








