<?php 
$header=1;
$activo=6;
require('../../header.php');?>
<?php include("../../PHP/paciente/consultas_historia.php"); ?>
<link href="../../../datatables/dataTables.bootstrap.css" rel="stylesheet">


		<div class="container">
    <br>
			<div class="row">
				<div class="span12">
					<div class="widget">
						<div class="widget-header">
						    <div class="span9">
                    <i class="icon-file"></i> <h3>Listado de Procedimientos</h3>
                </div>
                <div class="pull-right">
                    <a href="#myModalAdd" role="button" data-toggle="modal" class="btn btn-success font-normal">
                      <i class="icon-plus agregar"> Nuevo Procedimiento</i>
                    </a>
                </div>
						</div>	
						<div class="widget-content">
              <?php 
               if(isset($_GET['exito'])){ ?>
                    <center class="alert alert-info recepcion">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                        Procedimiento actualizado con exito.
                    </center>
              <?php }
              if(isset($_GET['error'])){ ?>
                  <center>
                      <div class="alert alert-error">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <?php echo $_GET['error']; ?>
                      </div>
                  </center>';
               <?php }
               if(isset($_GET['exito_guardo'])){ ?>
                  <center class="alert alert-info">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                        Nuevo Procedimiento Registrado con exito.
                  </center>
               <?php }
                 if(isset($_GET['elimino'])){ ?>
                    <center class="alert alert-info recepcion">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        El Procedimiento fue eliminado con exito.
                    </center>';
              <?php  }  ?>
							<div class="table-responsive">
							  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                 <thead>
							      <tr>
							        <th>Nro</th>
							        <th>Procedimiento</th>
                      <th>Nomenclatura</th>
							        <th>Precio</th>
							        <th>Acción</th>
							      </tr>
							    </thead>
							    <tbody>
                    <?php $procedimientos = mysql_query("SELECT * FROM lista_tratamientos"); ?>
							      <?php if(mysql_num_rows($procedimientos) > 0){
							      	  $i=0;
							      	  $n=0;
							          while($datos=mysql_fetch_assoc($procedimientos)){ 
                    ?>

							        <tr class="odd gradeX">
							          	<td><?php echo $datos['id']; ?></td>
							          	<td><?php echo $datos['nombre']; ?></td>
                          <td><?php echo $datos['nomenclatura']; ?></td>
							          	<td><?php echo $datos['precio']." Bsf";  ?></td>
							          	<td>
							          		<a class="btn btn-default" href="<?php echo "#myModalEdit".$i; ?>" role="button" data-toggle="modal"><i class="icon-edit"></i> Editar</a>
							          		<a class="btn btn-default" href="<?php echo "#myModalDelete".$n; ?>" role="button" data-toggle="modal"><i class="icon-trash"></i> Eliminar</a> 
							          	</td>
							        </tr>
  
  <!-- //////////////////////// Modal Editar Procedimiento ///////////////////////////////////-->
			        	<div id="<?php echo "myModalEdit".$i; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  	<div class="modal-header">
                      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      	<h3 id="myModalLabel"><i class="icon-edit"></i> Editar Procedimientos.</h3>
                    </div>
                                       	
                    <div class="modal-body">
                      <form method="POST" action="../../PHP/especialista/editar_procedimientos_modal.php">                    
                        
                        <input type="hidden" name="id" value="<?php echo  $datos['id']; ?> ">
                    		<div class="control-group">											
                    			 <label class="" for="">Nombre del Procedimiento: </label>
                      			<div class="controls ">
                      				<input type="text" name="nombre" class="form-control span3" value="<?php echo $datos['nombre']; ?>" required>
                      			</div> <!-- /controls -->	
                    		</div>
                        <div class="control-group">
                          <label class="control-label" for="">Nomenclatura:</label>
                          <div class="controls ">
                            <input type="text" name="nomenclatura" class="form-control span2" value="<?php echo $datos['nomenclatura']; ?>" required>
                          </div> <!-- /controls -->     
                        </div>
                    		<div class="control-group">											
                    			<label class="control-label" for="">Precio:</label>
                    			<div class="controls ">
                    				<input  type="text" name="precio" class="form-control span1" value="<?php echo $datos['precio']; ?>" required>
                    			</div> <!-- /controls -->				
                    		</div>
                  	</div>

                  	<div class="modal-footer">
                    	<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                    	<button name="modal" type="submit" class="btn btn-primary">Guardar</button>                   	
                  	</div>
                    </form>
                </div>

<!-- ////////// Modal Eliminar /////////////////-->
            <div id="<?php echo "myModalDelete".$n; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              	<div class="modal-header">
                  	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  	<h3 id="myModalLabel"><i class="icon-trash"></i> eliminar Procedimientos  </h3>
                </div>

                <div class="modal-body">
                  	<form method="POST" action="../../PHP/especialista/eliminar_procedimientos_modal.php">
                  		<center>
                        <p>¿Esta seguro que desea eliminar el procedimiento:  <?php echo $datos['nombre']; ?>.? </p>
                  			<input type="hidden" name="id" value="<?php echo $datos['id'];?>">                       	
                    	</center>                   
                </div>

              	<div class="modal-footer">
                	 <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                    <button name="eliminar" type="submit" class="btn btn-danger">Eliminar</button>
              	   </form>
                </div>
            </div>
							   <?php $i++; $n++;							    
                  }
							} ?>
							    </tbody>
							  </table>	
                  <hr>
                  <div id="cabioprecios">
                      <center>
                        <h4>Cambio de Precios</h4>
                        <?php 
                        if (isset($_GET['msgp']) AND isset($_GET['exit'])) { ?>
                            <div class="alert alert-info">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <strong>Exito!</strong> Se han modificado los precios de <strong> <?php echo $_GET['exit']; ?> </strong> procedimientos.
                            </div>
                        <?php } 
                        else if(isset($_GET['error'])){ ?>
                              <div class="alert alert-error">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Lo sentimos!</strong> No se pudieron modificar los precios de los procedimientos.
                              </div>
                        <? }
                        ?>

                        <form action="../../PHP/especialista/modificar_precios.php" method="POST">
                          <div class="form-group">
                            <label>Indique el porcentaje del aumento:</label>
                            <div class="controls">
                                <input type="text" name="porcentaje" class="span2" placeholder="000" required>
                                <span class="help-block minus">Indique el porcentaje solo en numeros, ejemplo: 50, 80, 100, 150, etc.</span>
                            </div>                     
                          </div>
                          <div class="form-group">
                            <button type="submit" class="btn btn-primary">Modificar</button>
                          </div>
                        </form>
                      </center>   
                  </div>
                			  
							</div>
						</div>
					</div>

<!-- ////////// Modal agregar /////////////////-->

        <div id="<?php echo "myModalAdd"; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel"><i class="icon-plus"></i> Agregar Nuevo Procedimiento.</h3>
            </div>
            
            <div class="modal-body">
              <form role="form" method="POST" action="../../PHP/especialista/agregar_procedimientos_modal.php">
              <div class="control-group">                     
                  <label class="control-label " for="">Nombre del Procedimiento</label>
                  <div class="controls ">
                    <input type="text" name="nombre" class="form-control span4" placeholder="Nombre" required>
                  </div> <!-- /controls -->       
              </div>
              <div class="control-group">
                <label class="control-label" for="">Nomenclatura:</label>
                <div class="controls ">
                  <input type="text" name="nomenclatura" class="form-control span2" placeholder="Nomenclatura adjunta" required>
                </div> <!-- /controls -->  
              </div>
              <div class="control-group">                     
                <label class="control-label" for="">Precio:</label>
                <div class="controls ">
                  <input  type="text" name="precio" class="form-control span1" required>
                </div> <!-- /controls -->       
              </div>
            </div>

              <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                <button name="modal" type="submit" class="btn btn-primary">Guardar</button>
                
              </div>
              </form>
          </div>


				</div>
        <div class="span6">
          <div class="widget">
            <div class="widget-header">
              
             <h3>Pesonal Medico</h3> 
            </div>
            <div class="widget-content">
                <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Nro</th>
                    <th>Nombre</th>
                    <th>Porcentaje</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                  $sql_personal = mysql_query("SELECT * FROM porcentaje");
                  $nro = 1;
                  
                  while ($personas = mysql_fetch_assoc($sql_personal)) { ?>
                      <tr>
                        <td><?php echo $nro; $nro++; ?></td>
                        <td><?php echo $personas['nombre']; ?></td>
                        <td><center><?php echo $personas['dividendo']; ?>%</center> </td>
                        <td>
                          <button type="button" class="btn btn-danger btn-small"> Delete</button>
                          <button type="button" class="btn btn-default btn-small"> Update</button> 
                        </td>
                      </tr>
                 <?php  }
                 ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="span6">
          <div class="widget">
            <div class="widget-header">
              <h3>Lista de Partes del Cuerpo:</h3>
             
            </div>
            <div class="widget-content">

              
              
            </div>
          </div>
        </div>

			</div>		
		</div>


<!-- ////////// Modal Nuevo tratamiento/////////////////-->







<script src="../../../datatables/dataTables.bootstrap.js"></script>
<script src="../../../datatables/jquery.dataTables.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#dataTables-example').dataTable();
});
</script>