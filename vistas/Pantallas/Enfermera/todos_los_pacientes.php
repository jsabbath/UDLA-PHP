<?php 
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
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>Nombre y Apellido</th>
                      <th>Cedula</th>
                      <th>Nro de Movil</th>
                      <th>Acción</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if($todos_pacientes){
                        while($datos=mysql_fetch_assoc($todos_pacientes)){ ?>
                      <tr class="odd gradeX">
                        <td><?php echo $datos['nombre_completo']; ?></td>
                         <td><?php echo $datos['cedula']; ?></td>
                        <td><?php echo $datos['telefono'];  ?></td>
                        <td><a class="btn btn-default " href="../../Pantallas/Enfermera/tratamientos_paciente.php?paciente=<?php echo $datos['id']; ?>">Ver Paciente</a> </td>
                      </tr>
                      <?php } } ?>
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


