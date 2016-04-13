
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
              <h3> Crear Cita</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
             	<br>
										<br>
										
           <form id="edit-profile" class="form-horizontal" method="post" action="../../PHP/especialista/crear_cita_paciente.php">
			<fieldset>
			
			<?php 
	        if(isset($_GET['success'])){ ?>           	
	    		<div class="alert alert-success">
	        		<button type="button" class="close" data-dismiss="alert">×</button>
	             	<center><strong><?php echo $_GET['success']; ?></strong></center>
	             </div>
	        <?php  }
	        else if(isset($_GET['error'])){ ?>
	        	<div class="alert alert-error">
	        		<button type="button" class="close" data-dismiss="alert">×</button>
	             	<center><strong><?php echo $_GET['error']; ?></strong></center>
	             </div>
	         <?php } ?>
				
				<div class="control-group">											
					<label class="control-label" for="fecha">Introduzca la cedula del paciente</label>
					<div class="controls">						
						<select name="ci" class="span1">
							<option>V</option>
							<option>E</option>
							<option>P</option>							
						</select>
						<input type="text" id="cedula" name="cedula" value="" placeholder="Cedula" class="login username-field" />
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
													
				<div class="control-group">											
					<label class="control-label" for="fecha">Seleccione una Fecha</label>
					<div class="controls">
						<input type="date" class="span4" required name="fecha" min="<?php echo date('Y-m-d'); ?>">
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
							<input type="radio" name="consulta" value="Masajista">Masajes
						</label>
						<label class="radio inline">
							<input type="radio" name="consulta" value="Cirujia">Cirujia
						</label>
					
                 </div>	<!-- /controls -->			
				</div> <!-- /control-group -->      

				 <div class="control-group">											
					<label class="control-label" for="nota">Cita dirigida a</label>
					<div class="controls">
					<select name="remitido">
					    <option value="Especialista">Medico Especialista</option>
	                    <option value="Cabina">Cabina</option>
	                    <option value="Recidente">Medico recidente</option>
					</select>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
      	 <br />
				<div class="form-actions">
					<button type="submit" class="btn btn-primary">Crear Cita</button> 
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