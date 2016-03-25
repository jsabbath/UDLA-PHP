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
<?php $procedimientos = mysql_query("SELECT * FROM lista_tratamientos") ?>
<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget">
						<div class="widget-header">
							<i class="icon-file"></i>
              				<h3>Listado de Procedimientos</h3>
						</div>	
						<div class="widget-content">
							<div class="table-responsive">
							  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
							    <thead>
							      <tr>
							        <th>Nro</th>
							        <th>Procedimiento</th>
							        <th>Precio</th>
							        <th>Acción</th>
							      </tr>
							    </thead>
							    <tbody>
							      <?php if($procedimientos){
							          while($datos=mysql_fetch_assoc($procedimientos)){ ?>
							        <tr class="odd gradeX">
							          	<td><?php echo $datos['id']; ?></td>
							          	<td><?php echo $datos['nombre']; ?></td>
							          	<td><?php echo $datos['precio'];  ?></td>
							          	<td>
							          		<a class="btn btn-default" href="#myModalEdit?id=<?php echo $datos['id']; ?>" role="button" data-toggle="modal"><i class="icon-edit"></i> Editar</a>
							          		<a class="btn btn-default" href="#myModalDelete" role="button" data-toggle="modal"><i class="icon-trash"></i> Eliminar</a> 
							          	</td>
							        </tr>
							        <?php } } ?>
							    </tbody>
							  </table>							  
							</div>
						</div>
					</div>
				</div>
			</div>		
		</div>
	</div>
</div>


<!-- ////////// Modal Nuevo tratamiento/////////////////-->
                <div id="myModalEdit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                	<div class="modal-header">
                    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    	<h3 id="myModalLabel"><i class="icon-edit"></i> Editar Procedimientos.</h3>
                  	</div>
                  	<div class="modal-body">
                    	
                  		<form role="form" method="POST" action="../../PHP/especialista/register_tratamientos_modal.php">
                  		<input type="hidden" name="paciente_id" value="<?php ?> ">
                  			
                  		<div class="control-group">											
                  			<label class="control-label " for="">Nombre del Procedimiento:
                  			<?php echo "hola ".$_GET['id']; ?> 
                  			</label>
                  			<div class="controls ">
                  				<input type="text" name="nombre" class="form-control span5" required>
                  			</div> <!-- /controls -->				
                  		</div>
                  		<div class="control-group">											
                  			<label class="control-label" for="">Precio:</label>
                  			<div class="controls ">
                  				<input  type="text" name="parametros" class="form-control span1" required>
                  			</div> <!-- /controls -->				
                  		</div>


                  	</div>
                  	<div class="modal-footer">
                    	<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                    	<button name="modal" type="submit" class="btn btn-primary">Guardar</button>
                    	</form>
                  	</div>
                </div>