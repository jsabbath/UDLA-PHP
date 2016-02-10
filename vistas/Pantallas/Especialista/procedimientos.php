
					<div class="widget">
						<div class="widget-header">						    
                    <i class="icon-file"></i><h3>Listado de Procedimientos</h3>
                    <button type="button" onclick="modalAdd();" class="btn btn-inverse centrar-btn pull-right">
                       Nuevo Procedimiento
                    </button>
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
							  <table class="table table-bordered table-hover table-condensed datatables" id="datatables2">
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
  							          	<td><?php echo $datos['id'];?> </td>
  							          	<td><?php echo $datos['nombre'];?> </td>
                            <td><?php echo $datos['nomenclatura'];?> </td>
  							          	<td><?php echo number_format($datos['precio']);?> Bsf</td>
  							          	<td>
                              <div class="btn-group">
                                <button class="btn btn-info dropdown-toggle btn-small" data-toggle="dropdown">
                                  Selecciona
                                  <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a href="<?php echo "#myModalEdit".$i; ?>" role="button" data-toggle="modal"><i class="icon-edit"></i> Editar</a></li>
                                  <li><a href="<?php echo "#myModalDelete".$n; ?>" role="button" data-toggle="modal"><i class="icon-trash"></i> Eliminar</a></li>
                                </ul>
                              </div>
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
                            <input type="text" name="nomenclatura" class="form-control span2" value="<?php echo $datos['nomenclatura']; ?>">
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
                      </form>                  	
                  	</div>
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
                <br>
              </div>
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
                        <?php }
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
                </form>
              </div>
              
          </div>

				
       

			</div>		
		</div>


<!-- ////////// Modal Nuevo tratamiento/////////////////-->
