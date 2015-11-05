	
<?php 
$header=2;
$activo=3;
require('../../header.php');?>
<?php include("../../PHP/paciente/consultas_historia.php"); ?>
<!--
<link href="../../../datatables/dataTables.bootstrap.css" rel="stylesheet">
<script src="../../../datatables/dataTables.bootstrap.js"></script>
<script src="../../../datatables/jquery.dataTables.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#dataTables-example').dataTable();
});
</script>
-->
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12">
  
                 <div class="widget">
            <div class="widget-header"> <i class="icon-file"></i>
              <h3>Crear cita</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
             	<br>
										<br>
										
           <form id="edit-profile" class="form-horizontal" method="post" action="../../PHP/recepcion/agregar_paciente_nuevo.php">
										<fieldset>
										   	
											<div class="login-fields">
										
<?php 
if(isset($_GET['error_paciente'])){
echo '<center class="alert alert-error paciente"><button type="button" class="close" data-dismiss="alert">×</button>Paciente no Registrado</center>';
}elseif (isset($_GET['error_listo'])) {
echo '<center class="alert alert-error paciente"><button type="button" class="close" data-dismiss="alert">×</button>El paciente ya posee cita</center>';
}elseif (isset($_GET['guardado'])) {
	echo '<center class="alert alert-success paciente"><button type="button" class="close" data-dismiss="alert">×</button>Cita creada con exito</center>';
}
?>
											
<div class="control-group">											
<label class="control-label" for="fecha">Cedula:</label>
<div class="controls">
<div class="field"><i class="icon-pencil cedula"></i>
<select name="ci" class="span1">
<option>V</option>
<option>E</option>
<option>P</option>

</select>
<input type="text" id="cedula" name="cedula" value="" required placeholder="Cedula" class="login username-field">
</div> <!-- /field -->
</div> <!-- /controls -->				
</div> <!-- /control-group -->


<div class="control-group">											
<label class="control-label" for="fecha">Nombre y Apellido</label>
<div class="controls">
<input type="text" class="span4" name="nombre" required>
</div> <!-- /controls -->				
</div> <!-- /control-group -->

<div class="control-group">                     
<label class="control-label" for="fecha">Antiguedad del paciente</label>
<div class="controls">
<input type="date" class="span4"  name="antiguedad" min="" required>
</div> <!-- /controls -->       
</div> <!-- /control-group -->

<div class="control-group">                     
<label class="control-label" for="fecha">Telefono</label>
<div class="controls">
<input type="text" class="span4" name="telefono"  required>
</div> <!-- /controls -->       
</div> <!-- /control-group -->
						
<div class="control-group">											
<label class="control-label" for="fecha">Fecha de la Cita</label>
<div class="controls">
<input type="date" class="span4"  name="fecha" min="<?php echo date('Y-m-d'); ?>" required>
</div> <!-- /controls -->				
</div> <!-- /control-group -->


<div class="control-group">											
<label class="control-label">Motivo de la Cita</label>

<div class="controls">
<label class="radio inline">
<input type="radio"  name="consulta" value="Control" checked="true">Control
</label>

<label class="radio inline">
<input type="radio" name="consulta" value="Tratamiento">Tratamiento
</label>

<label class="radio inline">
<input type="radio" name="consulta" value="Nuevo">Nuevo
</label>
<label class="radio inline">
<input type="radio" name="consulta" value="Emergencia">Emergencia
</label>
<label class="radio inline">
<input type="radio" name="consulta" value="Masaje">Masaje
</label>
<label class="radio inline">
<input type="radio" name="consulta" value="Cirujia">Cirujia
</label>
</div>	<!-- /controls -->			
</div> <!-- /control-group -->


                                


<div class="control-group">											
<label class="control-label" for="nota">Cita dirigida a</label>
<div class="controls">
<select name="nota">
<option value="Especialista">Medico Especialista</option>
<option value="Cabina">Cabina</option>
<option value="Recidente">Medico Residente</option>
</select>
</div> <!-- /controls -->				
</div> <!-- /control-group -->

<div class="control-group">											

<div class="controls">
<input type="text" style="display:none;" name="id"value="<?php echo $id; ?>">
</div> <!-- /controls -->				
</div> <!-- /control-group -->




<br />
<div class="form-actions">



<button type="submit" class="btn btn-primary">Guardar cita</button> 
<button class="btn">Cancelar</button>
</div> <!-- /form-actions -->
</fieldset>
</form>

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


?>