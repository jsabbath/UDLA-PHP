	
<?php 
$header=2;
$activo=5;
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
            <div class="widget-header"> 
            <i class="icon-calendar"></i>
              <h3>Creación de citas para pacientes nuevos</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
             	<br>
										<br>
										
           <form id="edit-profile" class="form-horizontal" method="POST" action="../../PHP/recepcion/cita_rapida.php">
										<fieldset>
										   	
											<div class="login-fields">
										
<?php 
if(isset($_GET['msg'])){
echo '<center class="alert alert-error paciente"><button type="button" class="close" data-dismiss="alert">×</button>'.$_GET['msg'].'</center>';
}elseif (isset($_GET['msn'])) {
	echo '<center class="alert alert-info paciente"><button type="button" class="close" data-dismiss="alert">×</button>'.$_GET['msn'].'</center>';
}
?>
											
<div class="control-group">											
<label class="control-label" for="fecha">Introdusta la cedula del paciente</label>
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
<label class="control-label" for="fecha">Telefono</label>
<div class="controls">
<input type="text" class="span4" name="telefono"  required>
</div> <!-- /controls -->       
</div> <!-- /control-group -->

<div class="control-group">                     
<label class="control-label" for="fecha">Nº Historia</label>
<div class="controls">
<input type="number" class="span4" name="nro_historia">
</div> <!-- /controls -->       
</div> <!-- /control-group -->
				
<div class="control-group">											
<label class="control-label" for="fecha">Fecha de la Cita</label>
<div class="controls">
<input type="date" class="span4" name="fecha" min="<?php echo date('Y-m-d'); ?>" required>
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
<input type="radio" name="consulta" value="Cirujia">Cirujia
</label>
<label class="radio inline">
<input type="radio" name="consulta" value="Masajes">Masajes
</label>
</div>	<!-- /controls -->			
</div> <!-- /control-group -->


                                


<div class="control-group">											
<label class="control-label" for="nota">Cita dirigida a</label>
<div class="controls">
<select name="nota">
<option value="Especialista">Medico Especialista</option>
                                              <option value="Cabina">Cabina</option>
                                              <option value="Residente">Medico Residente</option>
</select>
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