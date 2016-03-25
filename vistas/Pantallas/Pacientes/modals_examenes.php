<!--////////////////// hematologia/////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////-->

<!-- Modal -->
<div class="modal fade" id="hematologia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar examenes realizados:</h4>
      </div>

    <div class="modal-body">
        <form name="antecedentes" action="../../PHP/paciente/registra_examenes.php" method="POST" class="form" >
        	
        <div class="form-group">
			<label> Nombre del examen:</label>
		   	<input type="text" class="form-control input-lg" name="item" value="Hematologia" readonly>
		</div>

		<div class="row">
			<div class="form-group col-xs-12 col-md-6" >
				<label> Fecha:</label>
			   	<input type="date" name="fecha" class="form-control input-lg" >
			</div>
	        
	        <div class="form-group col-xs-12 col-md-6">
				<label> Resultado:</label>
			   	<input type="text" name="resultado" class="form-control input-lg">
		
			</div>
			<span id="helpBlock" class="help-block" style="padding-left:12px">*Ingrese el resultado obtenido si lo recuerda.</span>
		</div>

		<input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg " data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success btn-lg ">Guardar</button>
        </form>
    </div>
    
    </div>
  </div>
</div>

<!--////////////////// Tiroides/////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////-->

<!-- Modal -->
<div class="modal fade" id="tiroides" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar examenes realizados:</h4>
      </div>

    <div class="modal-body">
        <form name="antecedentes" action="../../PHP/paciente/registra_examenes.php" method="POST" class="form" >
        	
        <div class="form-group">
			<label> Nombre del examen:</label>
		   	<input type="text" class="form-control input-lg" name="item" value="Tiroides" readonly>
		</div>

		<div class="row">
			<div class="form-group col-xs-12 col-md-6" >
				<label> Fecha:</label>
			   	<input type="date" name="fecha" class="form-control input-lg" >
			</div>
	        
	        <div class="form-group col-xs-12 col-md-6">
				<label> Resultado:</label>
			   	<input type="text" name="resultado" class="form-control input-lg">
		
			</div>
			<span id="helpBlock" class="help-block" style="padding-left:12px">*Ingrese el resultado obtenido si lo recuerda.</span>
		</div>

		<input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg " data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success btn-lg ">Guardar</button>
        </form>
    </div>
    
    </div>
  </div>
</div>

<!--////////////////// Quimica Sanguinea/////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////-->

<!-- Modal -->
<div class="modal fade" id="quimica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar examenes realizados:</h4>
      </div>

    <div class="modal-body">
        <form name="antecedentes" action="../../PHP/paciente/registra_examenes.php" method="POST" class="form" >
        	
        <div class="form-group">
			<label> Nombre del examen:</label>
		   	<input type="text" class="form-control input-lg" name="item" value="Quimica Sanguinea" readonly>
		</div>

		<div class="row">
			<div class="form-group col-xs-12 col-md-6" >
				<label> Fecha:</label>
			   	<input type="date" name="fecha" class="form-control input-lg" >
			</div>
	        
	        <div class="form-group col-xs-12 col-md-6">
				<label> Resultado:</label>
			   	<input type="text" name="resultado" class="form-control input-lg">
		
			</div>
			<span id="helpBlock" class="help-block" style="padding-left:12px">*Ingrese el resultado obtenido si lo recuerda.</span>
		</div>

		<input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg " data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success btn-lg ">Guardar</button>
        </form>
    </div>
    
    </div>
  </div>
</div>

<!--////////////////// Hormonales/////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////-->

<!-- Modal -->
<div class="modal fade" id="hormonales" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar examenes realizados:</h4>
      </div>

    <div class="modal-body">
        <form name="antecedentes" action="../../PHP/paciente/registra_examenes.php" method="POST" class="form" >
        	
        <div class="form-group">
			<label> Nombre del examen:</label>
		   	<input type="text" class="form-control input-lg" name="item" value="Hormonales" readonly>
		</div>

		<div class="row">
			<div class="form-group col-xs-12 col-md-6" >
				<label> Fecha:</label>
			   	<input type="date" name="fecha" class="form-control input-lg" >
			</div>
	        
	        <div class="form-group col-xs-12 col-md-6">
				<label> Resultado:</label>
			   	<input type="text" name="resultado" class="form-control input-lg">
		
			</div>
			<span id="helpBlock" class="help-block" style="padding-left:12px">*Ingrese el resultado obtenido si lo recuerda.</span>
		</div>

		<input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg " data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success btn-lg ">Guardar</button>
        </form>
    </div>
    
    </div>
  </div>
</div>

<!--////////////////// VDRL/////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////-->

<!-- Modal -->
<div class="modal fade" id="VDRL" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar examenes realizados:</h4>
      </div>

    <div class="modal-body">
        <form name="antecedentes" action="../../PHP/paciente/registra_examenes.php" method="POST" class="form" >
        	
        <div class="form-group">
			<label> Nombre del examen:</label>
		   	<input type="text" class="form-control input-lg" name="item" value="VDRL" readonly>
		</div>

		<div class="row">
			<div class="form-group col-xs-12 col-md-6" >
				<label> Fecha:</label>
			   	<input type="date" name="fecha" class="form-control input-lg" >
			</div>
	        
	        <div class="form-group col-xs-12 col-md-6">
				<label> Resultado:</label>
			   	<input type="text" name="resultado" class="form-control input-lg">
		
			</div>
			<span id="helpBlock" class="help-block" style="padding-left:12px">*Ingrese el resultado obtenido si lo recuerda.</span>
		</div>

		<input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg " data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success btn-lg ">Guardar</button>
        </form>
    </div>
    
    </div>
  </div>
</div>

<!--////////////////// HIV/////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////-->

<!-- Modal -->
<div class="modal fade" id="HIV" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar examenes realizados:</h4>
      </div>

    <div class="modal-body">
        <form name="antecedentes" action="../../PHP/paciente/registra_examenes.php" method="POST" class="form" >
        	
        <div class="form-group">
			<label> Nombre del examen:</label>
		   	<input type="text" class="form-control input-lg" name="item" value="HIV" readonly>
		</div>

		<div class="row">
			<div class="form-group col-xs-12 col-md-6" >
				<label> Fecha:</label>
			   	<input type="date" name="fecha" class="form-control input-lg" >
			</div>
	        
	        <div class="form-group col-xs-12 col-md-6">
				<label> Resultado:</label>
			   	<input type="text" name="resultado" class="form-control input-lg">
		
			</div>
			<span id="helpBlock" class="help-block" style="padding-left:12px">*Ingrese el resultado obtenido si lo recuerda.</span>
		</div>

		<input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg " data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success btn-lg ">Guardar</button>
        </form>
    </div>
    
    </div>
  </div>
</div>

<!--////////////////// otros/////////////////-->
<!--///////////////////////////////////////////////////////////////////////////////////////-->

<!-- Modal -->
<div class="modal fade" id="otros" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar examenes realizados:</h4>
      </div>

    <div class="modal-body">
        <form name="antecedentes" action="../../PHP/paciente/registra_examenes.php" method="POST" class="form" >
        	
        <div class="form-group">
			<label> Nombre del examen:</label>
		   	<input type="text" class="form-control input-lg" name="otros" >
		</div>

		<div class="row">
			<div class="form-group col-xs-12 col-md-6" >
				<label> Fecha:</label>
			   	<input type="date" name="fecha" class="form-control input-lg" >
			</div>
	        
	        <div class="form-group col-xs-12 col-md-6">
				<label> Resultado:</label>
			   	<input type="text" name="resultado" class="form-control input-lg">
		
			</div>
			<span id="helpBlock" class="help-block" style="padding-left:12px">*Ingrese el resultado obtenido si lo recuerda.</span>
		</div>

		<input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
		<input type="hidden" class="form-control" name="item" value="otros" >
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg " data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success btn-lg ">Guardar</button>
        </form>
    </div>
    
    </div>
  </div>
</div>