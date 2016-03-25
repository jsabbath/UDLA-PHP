<?php
	$header=2;
	$activo=2;
	include "../../config/datos.php"; 
	require('../../header.php');
	include('../../PHP/paciente/consultas_historia.php');
	include("../../PHP/funciones.php");
?>


<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="widget">

				<div class="widget-header">
					<i class="icon user"></i>
					<h3> Paquete de tratamientos del Paciente:  </h3>
				</div>

				<div class="widget-content">
					<div class="row-fluid">
						<div class="span1">
							<img src="../../../img/avatar.jpg" class="img-responsive img-circle" width="80px">				
						</div>
						<div class="span4 primera">
							<h4>Nombre y Apellido: <?php echo $paciente['nombre_completo']; ?> </h4>
							<h4>Cedula: <?php echo $paciente['cedula']; ?> </h4>
							<h4>Telefono: <?php echo $paciente['telefono']; ?> </h4>
							<small><strong>Correo:</strong> <?php echo $paciente['email']; ?> </small>
									
						</div>
						
						<div class="span3 sengunda">
							<h4>Edad: <?php echo calculaedad($paciente['fecha_nacimiento']); ?>  </h4>
							<h4>Sexo: <?php echo $paciente['sexo']; ?></h4>
							<h4>Ocupación: <?php echo $paciente['ocupacion']; ?> </h4>
							<h4> Paciente desde: <?php echo "Hace ". calcular_fechas($paciente['created_at'])." dias"; ?> </h4>
						</div>
						<div class="span4 tercera">
							<h4>Nos conocio a traves de: <?php echo $paciente['remitido']; ?> </h4>
			                <h4>Dirección: <?php echo $paciente['direccion']; ?> </h4>
			            </div>
					</div>
					<hr>
<!-- /////////////////////////////////////Detalles del paquete////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->

	<h3>Datos del paquete:</h3>
	<?php 
	$paquete_id = $_GET['paquete'];
	$detalle_paq = mysql_query("SELECT * FROM paquetes WHERE  id ='{$paquete_id}'");
	$filas_paq = mysql_num_rows($detalle_paq);
	if($filas_paq >0)
	{?>
			<div class="table-responsive">
				<table class="table">
				<tr>
					<th>Estado</th>
					<th>Abonado</th>
					<th>Restante</th>
					<th>Total</th>
					<th>Creado</th>
					<th>Ultimo Pago</th>
					<th>Acción</th>
				</tr>
		<?php
		while($lista_paq = mysql_fetch_assoc($detalle_paq))
		{ ?>		
				<tr> 
					<td><?php if($lista_paq['status']== 0) { echo "Activo";} else { echo "Terminado";} ?></td>
					<td><?php echo $lista_paq['monto_abonado']; ?> Bs.</td>
					<td><?php
						$deudor = $lista_paq['monto_total'] - $lista_paq['monto_abonado']; 
					 	echo $deudor;  ?> Bs.
					</td>
					<td><?php echo $lista_paq['monto_total']; ?> Bs.</td>
					<td><?php echo $lista_paq['created_at']; ?></td>
					<td><?php echo $lista_paq['update_at']; ?></td>
					<td>
						<a href="#myModalNew" role="button" data-toggle="modal" <?php if($lista_paq['status']== 3) { echo "disabled='disabled'";} ?> class="btn btn-default"><i class="icon-plus"></i> Abonar Pago</a>
			
					</td>
				</tr>
	<?php } ?>
		</table>
		<?php if (isset($_GET['msg'])) {
		    $msg= $_GET['msg']; ?>
		    <div class="alert alert-danger">
		        <button type="button" class="close" data-dismiss="alert">&times;</button>
		        <strong><?php echo $msg; ?> </strong>
		    </div>
		<?php } ?>
		</div>
	<?php 	} ?>


	<h3>Procedimientos del paquete:</h3>

	<?php 
	$detalle_trat = mysql_query("SELECT * FROM tratamientos WHERE paciente_id ='{$id}' AND  paquete_id ='{$paquete_id}'");
	$filas_trat = mysql_num_rows($detalle_trat);
	if($filas_trat >0)
	{?>
			<div class="table-responsive">
				<table class="table table-bordered">
				<tr>
					<th>Procedimiento</th>
					<th>Lugar</th>
					<th>Sesiones</th>
					<th>Monto</th>
					<th>Total</th>
					<th></th>
				</tr>
		<?php
		$total_unitario = 0;
		$sesiones = 0;
		$proc = 0;
		while($lista_trat = mysql_fetch_assoc($detalle_trat))
		{ ?>
				<?php 
					$procedimiento = mysql_query("SELECT * FROM lista_tratamientos WHERE nombre= '{$lista_trat['nombre']}' ");
					$monto = mysql_fetch_assoc($procedimiento);
				?>
				<tr> 
					<td><?php echo $lista_trat['nombre']; ?></td>
					<td><?php echo $lista_trat['parte']; ?> </td>
					<td><?php echo $lista_trat['cantidad']; ?> </td>
					<td><?php echo $monto['precio']; ?> Bs.</td>
					<td><?php  
					$total = $monto['precio'] * $lista_trat['cantidad'];
					echo $total;
					?> Bs.</td>
					<td></td>
				</tr>
				<?php 
				$total_unitario = $total_unitario + $total; 
				$proc++;
				$sesiones = $sesiones + $lista_trat['cantidad'];
				?>
			<?php } ?>
			<tr>
				<td></td> <td></td> <td align="center"><strong>Total Precio Unitario:</strong></td> 
				<td><b><?php echo $total_unitario; ?></b> Bs.</td> <td> </td> <td></td>	
			</tr>

			<tr>
				<td></td> <td></td> <td align="center"></td> 
				<td><b>Total</b></td> <td><b><?php echo $total_unitario; ?></b> Bs.</td>
				<td><b>PRECIO DE CONTADO</b></td> 	
			</tr>
			<tr>
				<td></td> <td></td> <td><b>Descuento:</b></td>
				<?php if($total_unitario < 10000 ){
						echo "<td>0%</td>";
						echo "<td></td> <td></td>";
						$total_pagar = $total_unitario;
					}
					else if(($total_unitario > 10000) AND ($total_unitario < 15000)){
						echo "<td>7%</td>";
						$descuento = $total_unitario * 0.07;
						echo "<td><b>".$descuento."</b> Bs.</td> <td></td>";
						$total_pagar = $total_unitario - $descuento;
					} 

					elseif($total_unitario > 15000 ){
						echo "<td>10%</td>";
						$descuento = $total_unitario * 0.10;
						echo "<td><b>".$descuento."</b> Bs.</td> <td></td>";
						$total_pagar = $total_unitario - $descuento;
					} ?>		
			</tr>
			<tr>
				<td></td> <td></td> <td></td>
				<td><b>Total a pagar:</b></td>
				<td><b><?php echo $total_pagar; ?></b> Bs.</td>
				<td><b><?php echo $total_pagar; ?></b> Bs.</td>
			</tr>		
		</table>
		</div>


		<?php
		//comprobando si son sesiones unicas
		$cantidad_sesiones = $sesiones / $proc;
		if($cantidad_sesiones > 1 )
		{ 
			$inicial = $total_pagar * 0.65;
			$cuotas = ($total_pagar - $inicial) / 3;
		?>
		<div class="row-fluid">
		<div class="span5">
			<div class="table-responsive span4">
				<table class="table table-bordered" width="60%">
					<tr align="center">
						<th></th>
						<th>FORMA DE PAGO A CREDITO</th>
					</tr>
					<tr align="center">
						<td>Inicial</td>
						<td><b><?php echo $inicial; ?></b> Bs.</td>
					</tr>
					<tr align="center">
						<td>3 cuotas</td>
						<td><b><?php echo $cuotas; ?></b> Bs.</td>
					</tr>
					<form id="regalo" name="form-regalo" action="../../PHP/recepcion/confirmar_paquete.php" method="POST" >
					<tr align="center">
						<td>Obsequio</td>
						<td>
							<?php 
							$paq_obs = mysql_query("SELECT * FROM paquetes WHERE id = '{$paquete_id}' ");
							$paq =mysql_fetch_assoc($paq_obs);
							if ($paq['status'] < 2){ ?>
							<textarea class="form-control" name="obsequio"></textarea> 
		
							<?php  }
							else{  echo $paq['regalo'];  } ?>							
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="span6">
			<?php
			if ($paq['status'] < 2){ ?>
			<input type="hidden" name="total_pagar" value="<?php echo $total_pagar; ?>" >
			<input type="hidden" name="paciente" value="<?php echo $id; ?>" >
			<input type="hidden" name="paquete" value="<?php echo $paquete_id; ?>" >			
			<button type="submit" class="btn btn-default"><i class="icon-file"></i> Generar Presupuesto</button>
			
			<?php }

				else{ ?>
					<a href="factura.php?paquete=<?php echo $paquete_id;?>&paciente=<?php echo $id; ?>" class="btn btn-default"><i class="icon-file"></i> Generar Presupuesto </a>
				<?php } ?>
			</form>
		</div>
		</div>
		<?php }
		else { ?>
		<div class="row-fluid">
		<div class="span5">
			<div class="table-responsive span4">
				<table class="table table-bordered" width="60%">
					<tr>
						<th></th>
						<th>FORMA DE PAGO</th>
					</tr>
					<tr>
						<td>Inicial</td>
						<td></td>
					</tr>
					<tr>
						<td>3 cuotas</td>
						<td></td>
					</tr>
					<tr>
						<td>Obsequio:</td>
						<td></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="span6">
			<a href="factura.php?paquete=<?php echo $paquete_id;?>&paciente=<?php echo $id; ?>" class="btn btn-default"><i class="icon-file"></i> Generar Presupuesto </a>
		</div>
		</div>
		<?php } ?>
		
		

		<?php } //if principal ?>

				</div> <!-- FIN WIDGET CONTENT -->
			</div> <!-- FIN WIDGET -->
		</div>
	</div>
</div>

<!-- Modal -->

<div id="myModalNew" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	
    <div class="modal-header">
    	 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    	 <h3 id="myModalLabel"><i class="icon-credit-card"></i> Pago de paquetes:</h3>
  	</div>

  	<div class="modal-body">
  		<form id="pagos" name="form-pagos" role="form" action="../../PHP/recepcion/registrar_pagos.php" method="POST">
  			
        <input type="hidden" name="paciente" value="<?php echo $paciente['id']; ?>" >
  			<input type="hidden" name="paquete" value="<?php echo $paquete_id; ?>" >

  			<div class="control-group">											
  				  <label class="control-label" for="">Forma de pago:</label>
  				  <div class="controls">
  					   <select required class="form-control" name="forma">
  						    <option>---------</option>
  						    <option>Efectivo</option>
  						    <option>Debito</option>
  						    <option>Tarjeta de Credito</option>
  						    <option>Trasferencia Bancaria</option>
  						    <option>Deposito</option>
  					   </select>
  				  </div> <!-- /controls -->				
  			</div>

  			<div class="control-group">											
  				  <label class="control-label" for="">Tipo de pago:</label>
  				  <div class="controls">
  					   <select required class="form-control" name="tipo">
  						    <option>---------</option>
  						    <option>Unico</option>
  						    <option>Inicial</option>
  						    <option>Cuota</option>
  					   </select>
  				  </div> <!-- /controls -->				
  			</div>

  			<div class="control-group">											
  				  <label class="control-label" >Monto del Pago:</label>
  				  <div class="controls">
  					     <input required type="text" name="monto" class="form-control">
  				  </div> <!-- /controls -->				
  			</div>

  	</div>
  	
    <div class="modal-footer">
    	   <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    	   <button type="submit" name="pagos" class="btn btn-primary">Confirmar Pago</button>
      </form>
  	</div>
</div>
<!-- Modal -->