<?php 
$header=2;
$activo=2;
require('../../header.php');?>

<link href="../../../datatables/dataTables.bootstrap.css" rel="stylesheet">
<script src="../../../datatables/dataTables.bootstrap.js"></script>
<script src="../../../datatables/jquery.dataTables.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#dataTables-example').dataTable({
      "ajax": "../../PHP/recepcion/datatables.php",          
           "columns": [
            { "data": "nombre_completo" },
            { "data": "cedula" },
            { "data": "telefono" },
            { "data": "id" }
            ]
  });
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


