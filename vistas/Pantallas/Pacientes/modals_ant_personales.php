<!--////////////////// Modal  Resistencia a la insulina/////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////-->

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar antecedentes  personales:</h4>
	      </div>
	    <div class="modal-body">
	        <form name="antecedentes" action="../../PHP/paciente/registra_ant_personal.php" method="POST" class="form" >
	        	
	        <div class="form-group">
				<label> Nombre enfermedad:</label>
			   <input type="text" class="form-control" name="item" value="Resistencia a la insulina" readonly>
			</div>
	        
	        <div class="form-group">
				<label> Desde hace cuanto la padece:</label>
			   	<select class="form-control" name="hace_cuanto" required>
				   	<option value=""> ------------ </option>
				   	<option>Actualmente</option>
				   	<option>1 mes</option>
				   	<option>3 meses</option>
				   	<option>6 meses</option>
				   	<option>1 año o mas</option>
				   	<option>2 años o mas</option>
				   	<option>Desde nacimiento</option>
			   	</select>
			</div>
			<input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
			<input name="cuales_der" type="hidden" value="">
			<input name="otra" type="hidden" value="">
	    </div>
	    <div class="modal-footer">
	    	<button type="submit" class="btn btn-success btn-lg ">Guardar</button>
	        <button type="button" class="btn btn-default btn-lg " data-dismiss="modal">Cancelar</button>
	        </form>
	    </div>
	    
	    </div>
	  </div>
	</div>

<!--////////////////// trastornos tiroideos /////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////-->

<!-- Modal -->
	<div class="modal fade" id="tras_tiroideos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar antecedentes  personales:</h4>
	      </div>
	    <div class="modal-body">
	        <form name="antecedentes" action="../../PHP/paciente/registra_ant_personal.php" method="POST" class="form" >
	        	
	        <div class="form-group">
				<label> Nombre enfermedad:</label>
			   <input type="text" class="form-control" name="item" value="Trastornos Tiroideos" readonly>
			</div>
	        
	        <div class="form-group">
				<label> Desde hace cuanto la padece:</label>
			   	<select class="form-control" name="hace_cuanto" required>
				   	<option value=""> ------------ </option>
				   	<option>Actualmente</option>
				   	<option>1 mes</option>
				   	<option>3 meses</option>
				   	<option>6 meses</option>
				   	<option>1 año o mas</option>
				   	<option>2 años o mas</option>
				   	<option>Desde nacimiento</option>
			   	</select>
			</div>
			<input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
			<input name="cuales_der" type="hidden" value="">
			<input name="otra" type="hidden" value="">
	    </div>
	    <div class="modal-footer">
	        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-success btn-lg">Guardar</button>
	        </form>
	    </div>
	    
	    </div>
	  </div>
	</div>

<!--////////////////// Modal  Rinitis alergica/////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////-->

<!-- Modal -->
	<div class="modal fade" id="rinitis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar antecedentes  personales:</h4>
	      </div>
	    <div class="modal-body">
	        <form name="antecedentes" action="../../PHP/paciente/registra_ant_personal.php" method="POST" class="form" >
	        	
	        <div class="form-group">
				<label> Nombre enfermedad:</label>
			   <input type="text" class="form-control" name="item" value="Rinitis Alérgica" readonly>
			</div>
	        
	        <div class="form-group">
				<label> Desde hace cuanto la padece:</label>
			   	<select class="form-control" name="hace_cuanto" required>
				   	<option value=""> ------------ </option>
				   	<option>Actualmente</option>
				   	<option>1 mes</option>
				   	<option>3 meses</option>
				   	<option>6 meses</option>
				   	<option>1 año o mas</option>
				   	<option>2 años o mas</option>
				   	<option>Desde nacimiento</option>
			   	</select>
			</div>
			<input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
			<input name="cuales_der" type="hidden" value="">
			<input name="otra" type="hidden" value="">
	    </div>
	    <div class="modal-footer">
	        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-success btn-lg">Guardar</button>
	        </form>
	    </div>
	    
	    </div>
	  </div>
	</div>

<!--////////////////// Modal  Sinusitis Alérgica /////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////-->

<!-- Modal -->
	<div class="modal fade" id="sinusitis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar antecedentes  personales:</h4>
	      </div>
	    <div class="modal-body">
	        <form name="antecedentes" action="../../PHP/paciente/registra_ant_personal.php" method="POST" class="form" >
	        	
	        <div class="form-group">
				<label> Nombre enfermedad:</label>
			   <input type="text" class="form-control" name="item" value="Sinusitis Alérgica" readonly>
			</div>
	        
	        <div class="form-group">
				<label> Desde hace cuanto la padece:</label>
			   	<select class="form-control" name="hace_cuanto" required>
				   	<option value=""> ------------ </option>
				   	<option>Actualmente</option>
				   	<option>1 mes</option>
				   	<option>3 meses</option>
				   	<option>6 meses</option>
				   	<option>1 año o mas</option>
				   	<option>2 años o mas</option>
				   	<option>Desde nacimiento</option>
			   	</select>
			</div>
			<input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
			<input name="cuales_der" type="hidden" value="">
			<input name="otra" type="hidden" value="">
	    </div>
	    <div class="modal-footer">
	        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-success btn-lg">Guardar</button>
	        </form>
	    </div>
	    
	    </div>
	  </div>
	</div>

<!--////////////////// Modal Trastornos Nerviosos /////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////-->

<!-- Modal -->
	<div class="modal fade" id="trastornos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar antecedentes  personales:</h4>
	      </div>
	    <div class="modal-body">
	        <form name="antecedentes" action="../../PHP/paciente/registra_ant_personal.php" method="POST" class="form" >
	        	
	        <div class="form-group">
				<label> Nombre enfermedad:</label>
			   <input type="text" class="form-control" name="item" value="Trastornos Nerviosos" readonly>
			</div>
	        
	        <div class="form-group">
				<label> Desde hace cuanto la padece:</label>
			   	<select class="form-control" name="hace_cuanto" required>
				   	<option value=""> ------------ </option>
				   	<option>Actualmente</option>
				   	<option>1 mes</option>
				   	<option>3 meses</option>
				   	<option>6 meses</option>
				   	<option>1 año o mas</option>
				   	<option>2 años o mas</option>
				   	<option>Desde nacimiento</option>
			   	</select>
			</div>
			<input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
			<input name="cuales_der" type="hidden" value="">
			<input name="otra" type="hidden" value="">
	    </div>
	    <div class="modal-footer">
	        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-success btn-lg">Guardar</button>
	        </form>
	    </div>
	    
	    </div>
	  </div>
	</div>

<!--////////////////// Modal Hipertension Arterial /////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////-->

<!-- Modal -->
	<div class="modal fade" id="hipertension" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar antecedentes  personales:</h4>
	      </div>
	    <div class="modal-body">
	        <form name="antecedentes" action="../../PHP/paciente/registra_ant_personal.php" method="POST" class="form" >
	        	
	        <div class="form-group">
				<label> Nombre enfermedad:</label>
			   <input type="text" class="form-control" name="item" value="Hipertension Arterial" readonly>
			</div>
	        
	        <div class="form-group">
				<label> Desde hace cuanto la padece:</label>
			   	<select class="form-control" name="hace_cuanto" required>
				   	<option value=""> ------------ </option>
				   	<option>Actualmente</option>
				   	<option>1 mes</option>
				   	<option>3 meses</option>
				   	<option>6 meses</option>
				   	<option>1 año o mas</option>
				   	<option>2 años o mas</option>
				   	<option>Desde nacimiento</option>
			   	</select>
			</div>
			<input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
			<input name="cuales_der" type="hidden" value="">
			<input name="otra" type="hidden" value="">
	    </div>
	    <div class="modal-footer">
	        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-success btn-lg">Guardar</button>
	        </form>
	    </div>
	    
	    </div>
	  </div>
	</div>


<!--////////////////// Modal Diabetes /////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////-->

<!-- Modal -->
	<div class="modal fade" id="diabetes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar antecedentes  personales:</h4>
	      </div>
	    <div class="modal-body">
	        <form name="antecedentes" action="../../PHP/paciente/registra_ant_personal.php" method="POST" class="form" >
	        	
	        <div class="form-group">
				<label> Nombre enfermedad:</label>
			   <input type="text" class="form-control" name="item" value="Diabetes Mellitus" readonly>
			</div>
	        
	        <div class="form-group">
				<label> Desde hace cuanto la padece:</label>
			   	<select class="form-control" name="hace_cuanto" required>
				   	<option value=""> ------------ </option>
				   	<option>Actualmente</option>
				   	<option>1 mes</option>
				   	<option>3 meses</option>
				   	<option>6 meses</option>
				   	<option>1 año o mas</option>
				   	<option>2 años o mas</option>
				   	<option>Desde nacimiento</option>
			   	</select>
			</div>
			<input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
			<input name="cuales_der" type="hidden" value="">
			<input name="otra" type="hidden" value="">
	    </div>
	    <div class="modal-footer">
	        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-success btn-lg">Guardar</button>
	        </form>
	    </div>
	    
	    </div>
	  </div>
	</div>

<!--////////////////// Modal Enfermedades Dermatologicas /////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////-->

<!-- Modal -->
	<div class="modal fade" id="dermatologicas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar antecedentes  personales:</h4>
	      </div>
	    <div class="modal-body">
	        <form name="antecedentes" action="../../PHP/paciente/registra_ant_personal.php" method="POST" class="form" >
	        	
	        <div class="form-group">
				<label> Nombre enfermedad:</label>
			   <input type="text" class="form-control" name="item" value="Enfermedades Dermatologicas" readonly>
			</div>

			<div class="form-group">
				<label>¿Cuales enfermedades dermatologicas?</label>
			   <input type="text" class="form-control" name="cuales_der" value="" >
			</div>
	        
	        <div class="form-group">
				<label> Desde hace cuanto la padece:</label>
			   	<select class="form-control" name="hace_cuanto" required>
				   	<option value=""> ------------ </option>
				   	<option>Actualmente</option>
				   	<option>1 mes</option>
				   	<option>3 meses</option>
				   	<option>6 meses</option>
				   	<option>1 año o mas</option>
				   	<option>2 años o mas</option>
				   	<option>Desde nacimiento</option>
			   	</select>
			</div>
			<input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
			<input name="otra" type="hidden" value="">
	    </div>
	    <div class="modal-footer">
	        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-success btn-lg">Guardar</button>
	        </form>
	    </div>
	    
	    </div>
	  </div>
	</div>

<!--////////////////// Modal Cancer de Piel(Melanoma u otro) /////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////-->

<!-- Modal -->
	<div class="modal fade" id="cancer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar antecedentes  personales:</h4>
	      </div>
	    <div class="modal-body">
	        <form name="antecedentes" action="../../PHP/paciente/registra_ant_personal.php" method="POST" class="form" >
	        	
	        <div class="form-group">
				<label> Nombre enfermedad:</label>
			   <input type="text" class="form-control" name="item" value="Cancer de Piel(Melanoma u otro)" readonly>
			</div>
	        
	        <div class="form-group">
				<label> Desde hace cuanto la padece:</label>
			   	<select class="form-control" name="hace_cuanto" required>
				   	<option value=""> ------------ </option>
				   	<option>Actualmente</option>
				   	<option>1 mes</option>
				   	<option>3 meses</option>
				   	<option>6 meses</option>
				   	<option>1 año o mas</option>
				   	<option>2 años o mas</option>
				   	<option>Desde nacimiento</option>
			   	</select>
			</div>
			<input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
			<input name="otra" type="hidden" value="">
			<input name="cuales_der" type="hidden" value="">
	    </div>
	    <div class="modal-footer">
	        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-success btn-lg">Guardar</button>
	        </form>
	    </div>
	    
	    </div>
	  </div>
	</div>

<!--////////////////// Modal asma bronquuial /////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////-->

<!-- Modal -->
	<div class="modal fade" id="asma" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar antecedentes  personales:</h4>
	      </div>
	    <div class="modal-body">
	        <form name="antecedentes" action="../../PHP/paciente/registra_ant_personal.php" method="POST" class="form" >
	        	
	        <div class="form-group">
				<label> Nombre enfermedad:</label>
			   <input type="text" class="form-control" name="item" value="Asma Bronquial" readonly>
			</div>
	        
	        <div class="form-group">
				<label> Desde hace cuanto la padece:</label>
			   	<select class="form-control" name="hace_cuanto" required>
				   	<option value=""> ------------ </option>
				   	<option>Actualmente</option>
				   	<option>1 mes</option>
				   	<option>3 meses</option>
				   	<option>6 meses</option>
				   	<option>1 año o mas</option>
				   	<option>2 años o mas</option>
				   	<option>Desde nacimiento</option>
			   	</select>
			</div>
			<input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
			<input name="otra" type="hidden" value="">
			<input name="cuales_der" type="hidden" value="">
	    </div>
	    <div class="modal-footer">
	        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-success btn-lg">Guardar</button>
	        </form>
	    </div>
	    
	    </div>
	  </div>
	</div>

<!--////////////////// Modal otras enfermedades /////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////-->

<!-- Modal -->
	<div class="modal fade" id="otras" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar antecedentes  personales:</h4>
	      </div>
	    <div class="modal-body">
	        <form name="antecedentes" action="../../PHP/paciente/registra_ant_personal.php" method="POST" class="form" >
	        	
	        <div class="form-group">
				<label> Nombre enfermedad:</label>
			   <input type="text" class="form-control" name="otra" value="">
			</div>
	        
	        <div class="form-group">
				<label> Desde hace cuanto la padece:</label>
			   	<select class="form-control" name="hace_cuanto" required>
				   	<option value=""> ------------ </option>
				   	<option>Actualmente</option>
				   	<option>1 mes</option>
				   	<option>3 meses</option>
				   	<option>6 meses</option>
				   	<option>1 año o mas</option>
				   	<option>2 años o mas</option>
				   	<option>Desde nacimiento</option>
			   	</select>
			</div>
			<input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
			<input name="item" type="hidden" value="otras">
			<input name="cuales_der" type="hidden" value="">
	    </div>
	    <div class="modal-footer">
	        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-success btn-lg">Guardar</button>
	        </form>
	    </div>
	    
	    </div>
	  </div>
	</div>