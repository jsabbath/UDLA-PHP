<!--////////////////// Modal  Toma o se inyecta Vitaminas/////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////-->

	<!-- Modal -->
	<div class="modal fade" id="vitaminas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar tratamientos previos:</h4>
	      </div>

	    <div class="modal-body">
	        <form name="antecedentes" action="../../PHP/paciente/registra_trat_previos.php" method="POST" class="form" >
	        	
	        <div class="form-group">
				<label> Tratamiento seleccionado:</label>
			   	<input type="text" class="form-control" name="item" value="Toma o se inyecta Vitaminas" readonly>
			</div>

			<div class="row">
		        <div class="form-group col-xs-12 col-md-6">
					<label> Indique cual vitamina:</label>
				   	<input type="text" class="form-control" name="cual">
				</div>

				<div class="form-group col-xs-12 col-md-6">
				    <label> Motivo para tomarla:</label>
				    <input type="text" class="form-control" name="motivos" placeholder="">
				</div>

				<div class="form-group col-xs-12 col-md-6">
			        <label> Desde hace cuanto lo toma:</label>
			        <select class="form-control" name="hace_cuanto" required>
			            <option value=""> ------------ </option>
			            <option>1 mes</option>
			            <option>3 meses</option>
			            <option>6 meses</option>
			            <option>1 año o mas</option>
			            <option>2 años o mas</option>
			        </select>
				</div>
	        	
	        	<div class="form-group col-xs-12 col-md-6">
        	        <label> ¿Lo sigue tomando actualmente?</label>
        	        <select class="form-control" name="actual" >
        	            <option value=""> ------------ </option>
        	            <option>Si</option>
        	            <option>No</option>
        	            <option>Ocasionalmente</option>
        	        </select>
	        	</div>
	        
			</div>

			<input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
			<input name="otra" type="hidden" value="">
	    </div>
	    <div class="modal-footer">
	        <button type="button" class="btn btn-default btn-lg " data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-success btn-lg ">Guardar</button>
	        </form>
	    </div>
	    
	    </div>
	  </div>
	</div>

	<!--////////////////// Modal  Toma Proteinas/////////////////-->
	<!--///////////////////////////////////////////////////////////////////////////////////////-->

		<!-- Modal -->
		<div class="modal fade" id="proteinas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar tratamientos previos:</h4>
		      </div>

		    <div class="modal-body">
		        <form name="antecedentes" action="../../PHP/paciente/registra_trat_previos.php" method="POST" class="form" >
		        	
		        <div class="form-group">
					<label> Tratamiento seleccionado:</label>
				   	<input type="text" class="form-control" name="item" value="Toma Proteinas" readonly>
				</div>

				<div class="row">
			        <div class="form-group col-xs-12 col-md-6">
						<label> Indique cual proteina:</label>
					   	<input type="text" class="form-control" name="cual">
					</div>

					<div class="form-group col-xs-12 col-md-6">
					    <label> Motivo para tomarlo:</label>
					    <input type="text" class="form-control" name="motivos" placeholder="">
					</div>

					<div class="form-group col-xs-12 col-md-6">
				        <label> Desde hace cuanto lo toma:</label>
				        <select class="form-control" name="hace_cuanto" required>
				            <option value=""> ------------ </option>
				            <option>1 mes</option>
				            <option>3 meses</option>
				            <option>6 meses</option>
				            <option>1 año o mas</option>
				            <option>2 años o mas</option>
				        </select>
					</div>
		        	
		        	<div class="form-group col-xs-12 col-md-6">
	        	        <label> ¿Lo sigue tomando actualmente?</label>
	        	        <select class="form-control" name="actual" >
	        	            <option value=""> ------------ </option>
	        	            <option>Si</option>
	        	            <option>No</option>
	        	            <option>Ocasionalmente</option>
	        	        </select>
		        	</div>
		        
				</div>

				<input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
				<input name="otra" type="hidden" value="">
		    </div>
		    <div class="modal-footer">
		        <button type="button" class="btn btn-default btn-lg " data-dismiss="modal">Cancelar</button>
		        <button type="submit" class="btn btn-success btn-lg ">Guardar</button>
		        </form>
		    </div>
		    
		    </div>
		  </div>
		</div>

<!--////////////////// Modal  Toma Aminoacidos/////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////-->

<!-- Modal -->
<div class="modal fade" id="aminoacidos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar tratamientos previos:</h4>
      </div>

    <div class="modal-body">
        <form name="antecedentes" action="../../PHP/paciente/registra_trat_previos.php" method="POST" class="form" >
        	
        <div class="form-group">
			<label> Tratamiento seleccionado:</label>
		   	<input type="text" class="form-control" name="item" value="Toma Aminoacidos" readonly>
		</div>

		<div class="row">
	        <div class="form-group col-xs-12 col-md-6">
				<label> Indique cual aminoacido:</label>
			   	<input type="text" class="form-control" name="cual">
			</div>

			<div class="form-group col-xs-12 col-md-6">
			    <label> Motivo para tomarlo:</label>
			    <input type="text" class="form-control" name="motivos" placeholder="">
			</div>

			<div class="form-group col-xs-12 col-md-6">
		        <label> Desde hace cuanto lo toma:</label>
		        <select class="form-control" name="hace_cuanto" required>
		            <option value=""> ------------ </option>
		            <option>1 mes</option>
		            <option>3 meses</option>
		            <option>6 meses</option>
		            <option>1 año o mas</option>
		            <option>2 años o mas</option>
		        </select>
			</div>
        	
        	<div class="form-group col-xs-12 col-md-6">
    	        <label> ¿Lo sigue tomando actualmente?</label>
    	        <select class="form-control" name="actual" >
    	            <option value=""> ------------ </option>
    	            <option>Si</option>
    	            <option>No</option>
    	            <option>Ocasionalmente</option>
    	        </select>
        	</div>
        
		</div>

		<input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
		<input name="otra" type="hidden" value="">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg " data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success btn-lg ">Guardar</button>
        </form>
    </div>
    
    </div>
  </div>
</div>


<!--////////////////// Modal Toma Aspirinas/////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////-->

<!-- Modal -->
<div class="modal fade" id="aspirinas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar tratamientos previos:</h4>
      </div>

    <div class="modal-body">
        <form name="antecedentes" action="../../PHP/paciente/registra_trat_previos.php" method="POST" class="form" >
        	
        <div class="form-group">
			<label> Tratamiento seleccionado:</label>
		   	<input type="text" class="form-control" name="item" value="Toma Aspirinas" readonly>
		</div>

		<div class="row">
	        <div class="form-group col-xs-12 col-md-6">
				<label> Indique cual aspirinas:</label>
			   	<input type="text" class="form-control" name="cual">
			</div>

			<div class="form-group col-xs-12 col-md-6">
			    <label> Motivo para tomarlo:</label>
			    <input type="text" class="form-control" name="motivos" placeholder="">
			</div>

			<div class="form-group col-xs-12 col-md-6">
		        <label> Desde hace cuanto lo toma:</label>
		        <select class="form-control" name="hace_cuanto" required>
		            <option value=""> ------------ </option>
		            <option>1 mes</option>
		            <option>3 meses</option>
		            <option>6 meses</option>
		            <option>1 año o mas</option>
		            <option>2 años o mas</option>
		        </select>
			</div>
        	
        	<div class="form-group col-xs-12 col-md-6">
    	        <label> ¿Lo sigue tomando actualmente?</label>
    	        <select class="form-control" name="actual" >
    	            <option value=""> ------------ </option>
    	            <option>Si</option>
    	            <option>No</option>
    	            <option>Ocasionalmente</option>
    	        </select>
        	</div>
        
		</div>

		<input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
		<input name="otra" type="hidden" value="">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg " data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success btn-lg ">Guardar</button>
        </form>
    </div>
    
    </div>
  </div>
</div>

<!--////////////////// Modal Toma Anticoagulantes/////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////-->

<!-- Modal -->
<div class="modal fade" id="anticoagulantes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar tratamientos previos:</h4>
      </div>

    <div class="modal-body">
        <form name="antecedentes" action="../../PHP/paciente/registra_trat_previos.php" method="POST" class="form" >
        	
        <div class="form-group">
			<label> Tratamiento seleccionado:</label>
		   	<input type="text" class="form-control" name="item" value="Toma Anticoagulantes" readonly>
		</div>

		<div class="row">
	        <div class="form-group col-xs-12 col-md-6">
				<label> Indique cual anticoagulante:</label>
			   	<input type="text" class="form-control" name="cual">
			</div>

			<div class="form-group col-xs-12 col-md-6">
			    <label> Motivo para tomarlo:</label>
			    <input type="text" class="form-control" name="motivos" placeholder="">
			</div>

			<div class="form-group col-xs-12 col-md-6">
		        <label> Desde hace cuanto lo toma:</label>
		        <select class="form-control" name="hace_cuanto" required>
		            <option value=""> ------------ </option>
		            <option>1 mes</option>
		            <option>3 meses</option>
		            <option>6 meses</option>
		            <option>1 año o mas</option>
		            <option>2 años o mas</option>
		        </select>
			</div>
        	
        	<div class="form-group col-xs-12 col-md-6">
    	        <label> ¿Lo sigue tomando actualmente?</label>
    	        <select class="form-control" name="actual" >
    	            <option value=""> ------------ </option>
    	            <option>Si</option>
    	            <option>No</option>
    	            <option>Ocasionalmente</option>
    	        </select>
        	</div>
        
		</div>

		<input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
		<input name="otra" type="hidden" value="">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg " data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success btn-lg ">Guardar</button>
        </form>
    </div>
    
    </div>
  </div>
</div>


<!--////////////////// Modal Toma Antiflamatorios/////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////-->

<!-- Modal -->
<div class="modal fade" id="antiflamatorios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar tratamientos previos:</h4>
      </div>

    <div class="modal-body">
        <form name="antecedentes" action="../../PHP/paciente/registra_trat_previos.php" method="POST" class="form" >
        	
        <div class="form-group">
			<label> Tratamiento seleccionado:</label>
		   	<input type="text" class="form-control" name="item" value="Toma Antiflamatorios" readonly>
		</div>

		<div class="row">
	        <div class="form-group col-xs-12 col-md-6">
				<label> Indique cual antiflamatorio:</label>
			   	<input type="text" class="form-control" name="cual">
			</div>

			<div class="form-group col-xs-12 col-md-6">
			    <label> Motivo para tomarlo:</label>
			    <input type="text" class="form-control" name="motivos" placeholder="">
			</div>

			<div class="form-group col-xs-12 col-md-6">
		        <label> Desde hace cuanto lo toma:</label>
		        <select class="form-control" name="hace_cuanto" required>
		            <option value=""> ------------ </option>
		            <option>1 mes</option>
		            <option>3 meses</option>
		            <option>6 meses</option>
		            <option>1 año o mas</option>
		            <option>2 años o mas</option>
		        </select>
			</div>
        	
        	<div class="form-group col-xs-12 col-md-6">
    	        <label> ¿Lo sigue tomando actualmente?</label>
    	        <select class="form-control" name="actual" >
    	            <option value=""> ------------ </option>
    	            <option>Si</option>
    	            <option>No</option>
    	            <option>Ocasionalmente</option>
    	        </select>
        	</div>
        
		</div>

		<input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
		<input name="otra" type="hidden" value="">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg " data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success btn-lg ">Guardar</button>
        </form>
    </div>
    
    </div>
  </div>
</div>


<!--////////////////// Modal Toma Antibioticos/////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////-->

<!-- Modal -->
<div class="modal fade" id="antibioticos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar tratamientos previos:</h4>
      </div>

    <div class="modal-body">
        <form name="antecedentes" action="../../PHP/paciente/registra_trat_previos.php" method="POST" class="form" >
        	
        <div class="form-group">
			<label> Tratamiento seleccionado:</label>
		   	<input type="text" class="form-control" name="item" value="Toma Antibioticos" readonly>
		</div>

		<div class="row">
	        <div class="form-group col-xs-12 col-md-6">
				<label> Indique cual antibiotico:</label>
			   	<input type="text" class="form-control" name="cual">
			</div>

			<div class="form-group col-xs-12 col-md-6">
			    <label> Motivo para tomarlo:</label>
			    <input type="text" class="form-control" name="motivos" placeholder="">
			</div>

			<div class="form-group col-xs-12 col-md-6">
		        <label> Desde hace cuanto lo toma:</label>
		        <select class="form-control" name="hace_cuanto" required>
		            <option value=""> ------------ </option>
		            <option>1 mes</option>
		            <option>3 meses</option>
		            <option>6 meses</option>
		            <option>1 año o mas</option>
		            <option>2 años o mas</option>
		        </select>
			</div>
        	
        	<div class="form-group col-xs-12 col-md-6">
    	        <label> ¿Lo sigue tomando actualmente?</label>
    	        <select class="form-control" name="actual" >
    	            <option value=""> ------------ </option>
    	            <option>Si</option>
    	            <option>No</option>
    	            <option>Ocasionalmente</option>
    	        </select>
        	</div>
        
		</div>

		<input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
		<input name="otra" type="hidden" value="">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg " data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success btn-lg ">Guardar</button>
        </form>
    </div>
    
    </div>
  </div>
</div>

<!--////////////////// Modal Toma Hormonas de Crecimiento/////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////-->

<!-- Modal -->
<div class="modal fade" id="hormonas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar tratamientos previos:</h4>
      </div>

    <div class="modal-body">
        <form name="antecedentes" action="../../PHP/paciente/registra_trat_previos.php" method="POST" class="form" >
        	
        <div class="form-group">
			<label> Tratamiento seleccionado:</label>
		   	<input type="text" class="form-control" name="item" value="Toma Hormonas de Crecimiento" readonly>
		</div>

		<div class="row">
	        <div class="form-group col-xs-12 col-md-6">
				<label> Indique cual hormona:</label>
			   	<input type="text" class="form-control" name="cual">
			</div>

			<div class="form-group col-xs-12 col-md-6">
			    <label> Motivo para tomarlo:</label>
			    <input type="text" class="form-control" name="motivos" placeholder="">
			</div>

			<div class="form-group col-xs-12 col-md-6">
		        <label> Desde hace cuanto lo toma:</label>
		        <select class="form-control" name="hace_cuanto" required>
		            <option value=""> ------------ </option>
		            <option>1 mes</option>
		            <option>3 meses</option>
		            <option>6 meses</option>
		            <option>1 año o mas</option>
		            <option>2 años o mas</option>
		        </select>
			</div>
        	
        	<div class="form-group col-xs-12 col-md-6">
    	        <label> ¿Lo sigue tomando actualmente?</label>
    	        <select class="form-control" name="actual" >
    	            <option value=""> ------------ </option>
    	            <option>Si</option>
    	            <option>No</option>
    	            <option>Ocasionalmente</option>
    	        </select>
        	</div>
        
		</div>

		<input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
		<input name="otra" type="hidden" value="">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg " data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success btn-lg ">Guardar</button>
        </form>
    </div>
    
    </div>
  </div>
</div>

<!--////////////////// Modal otros/////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////-->

<!-- Modal -->
<div class="modal fade" id="otros" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar tratamientos previos:</h4>
      </div>

    <div class="modal-body">
        <form name="antecedentes" action="../../PHP/paciente/registra_trat_previos.php" method="POST" class="form" >
        	
        <div class="form-group">
			<label> Otro Tratamiento:</label>
		   	<input type="text" class="form-control" name="otra" >
		</div>

		<div class="row">
	        <div class="form-group col-xs-12 col-md-6">
				<label> Indique cual:</label>
			   	<input type="text" class="form-control" name="cual">
			</div>

			<div class="form-group col-xs-12 col-md-6">
			    <label> Motivo para tomarlo:</label>
			    <input type="text" class="form-control" name="motivos" placeholder="">
			</div>

			<div class="form-group col-xs-12 col-md-6">
		        <label> Desde hace cuanto lo toma:</label>
		        <select class="form-control" name="hace_cuanto" required>
		            <option value=""> ------------ </option>
		            <option>1 mes</option>
		            <option>3 meses</option>
		            <option>6 meses</option>
		            <option>1 año o mas</option>
		            <option>2 años o mas</option>
		        </select>
			</div>
        	
        	<div class="form-group col-xs-12 col-md-6">
    	        <label> ¿Lo sigue tomando actualmente?</label>
    	        <select class="form-control" name="actual" >
    	            <option value=""> ------------ </option>
    	            <option>Si</option>
    	            <option>No</option>
    	            <option>Ocasionalmente</option>
    	        </select>
        	</div>
        
		</div>

		<input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
		<input type="hidden" name="item" value="otra">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg " data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success btn-lg ">Guardar</button>
        </form>
    </div>
    
    </div>
  </div>
</div>