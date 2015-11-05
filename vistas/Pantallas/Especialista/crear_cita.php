
<?php 
$header=1;
$activo=3;
require('../../header.php');?>

<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12">
  
                 <div class="widget">
            <div class="widget-header"> <i class="icon-file"></i>
              <h3> Mis Pacientes</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
             	<br>
										<br>
										
           <form id="edit-profile" class="form-horizontal" method="post" action="../../PHP/especialista/crear_cita_paciente.php">
										<fieldset>
										   	
											<div class="login-fields">
										
											<?php 
											if(isset($_GET['error_paciente'])){
											echo '<center class="alert alert-error paciente"><button type="button" class="close" data-dismiss="alert">×</button>Paciente no Registrado</center>';
											}elseif (isset($_GET['error_listo'])) {
											echo '<center class="alert alert-error paciente"><button type="button" class="close" data-dismiss="alert">×</button>El paciente ya posee cita</center>';
											}elseif (isset($_GET['guardado'])) {
												echo '<center class="alert alert-error paciente"><button type="button" class="close" data-dismiss="alert">×</button>Cita creada con exito</center>';
											}
											?>
											
											<div class="control-group">											
												<label class="control-label" for="fecha">Introduzca la cedula del paciente</label>
												<div class="controls">
													<div class="field"><i class="icon-pencil cedula"></i>
											<select name="ci" class="span1">
											<option>V</option>
											<option>E</option>
											<option>P</option>
											
											</select>
											<input type="text" id="cedula" name="cedula" value="" placeholder="Cedula" class="login username-field" />
											</div> <!-- /field -->
												</div> <!-- /controls -->				
											</div> <!-- /control-group -->
											
	                                         </div>
																				
											<div class="control-group">											
												<label class="control-label" for="fecha">Seleccione una Fecha</label>
												<div class="controls">
													<input type="date" class="span4" name="fecha" min="<?php echo date('Y-m-d'); ?>">
												</div> <!-- /controls -->				
											</div> <!-- /control-group -->
									
											
											 <div class="control-group">											
												<label class="control-label">Motivo de la Cita</label>
												
	                                            <div class="controls">
	                                            <label class="radio inline">
	                                              <input type="radio"  name="consulta" value="Consulta Sucesiva" checked="true"> Consulta Sucesiva
	                                            </label>
	                                            
	                                            <label class="radio inline">
	                                              <input type="radio" name="consulta" value="Consulta de Tratamiento"> Consulta de Tratamiento
	                                            </label>

	                                              <label class="radio inline">
	                                              <input type="radio" name="consulta" value="Consulta por Nuevo Caso"> Consulta por Nuevo Caso
	                                            </label>
	                                          </div>	<!-- /controls -->			
											</div> <!-- /control-group -->
	                                        
											
												                                        
	                       

											 <div class="control-group">											
												<label class="control-label" for="nota">Cita dirigida a</label>
												<div class="controls">
												<select name="nota">
											    <option value="Especialista">Medico Especialista</option>
	                                            <option value="Cabina">Cabina</option>
	                                            <option value="Recidente">Medico recidente</option>
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