			
				<tbody id="contenedor">
					<tr>
						<td width="">
							<div class="proced">							
								<div class="controls">
									<select required class="form-control parametro" name="nombre" id="procedimiento">
										<option></option>
										<?php while ($lista = mysql_fetch_assoc($lista_tratamientos)) { ?>
											<option><?php echo $lista['nombre']; ?></option>
										<?php } ?>
									</select>
								</div> <!-- /controls -->
							</div>
						</td>

						<td width="">
								<div class="cuerpo">
								<select name="parte" class="form-control partes" id="partescuerpo">
									<option></option><option>Area del bikini</option><option>Cuero cabelludo</option><option>Axilas</option>
									<option>Cara</option><option>Cara y Cuello</option><option>Pecho</option><option>Espalda</option>
									<option>Brazos</option><option>Gluteos</option><option>Muslos</option><option>Piernas</option><option>Cicatriz</option>
									<option>Cicatrices</option><option>Manos</option><option>Parpados</option><option>Boso</option><option>Papada</option>
									<option>Revolvera</option><option>Abdomen</option><option>Abdomen y Cintura</option><option>Cintura</option>
									<option>Cara Femenina</option><option>Cara y Cuello Femenina</option><option>Cara Masculina</option><option>Cara y cuello masculina</option>
								</select>
								</div>
						</td>

						<td width="" align="center">
							<div class="control-group">
								<div class="controls">
									<input type="number" min="1" max="100" value="1" name="cantidad" class="form-control seciones" required>
								</div> <!-- /controls -->
							</div>
						</td>

						<td width="" align="center">
							<div class="control-group">
								<div class="controls">
									<select name="frecuencia" class="form-control" required>
										<option value="" selected>Seleccione</option>
										<option>Unica</option>
										<option>3 Dias</option>
										<option>5 Dias</option>
										<option>8 Dias</option>
										<option>10 Dias</option>
										<option>15 Dias</option> <option>21 Dias</option>
										<option>Mensualmente</option>
									</select>
								</div> <!-- /controls -->
							</div>
						</td>

						<td width="">
							<div class="control-group">
								<input name="parametros" class="form-control"  >
							</div>
						</td>

						<td width="">
							<a href="" class="delete btn btn-success" title="Eliminar" id="agregarCampo"><i class="icon-plus"> </i></a>
						</td>

					</tr>
				</tbody>
			</table>


<script type="text/javascript">
	
	$(document).ready(function() {

	    var MaxInputs       = 10; //Número Maximo de Campos
	    var contenedor      = $("#contenedor"); //ID del contenedor
	    var AddButton       = $("#agregarCampo"); //ID del Botón Agregar

	    //var x = número de campos existentes en el contenedor
	    var x = $("#contenedor tr").length + 1 - 2;
	    var FieldCount = x-1; //para el seguimiento de los campos

	    $(AddButton).click(function (e) {
	        if(x <= MaxInputs) //max input box allowed
	        {
	            FieldCount++;
	            //agregar campo
	            $(contenedor).append('<tr><td><div class="proced"><div class="controls"><select required class="form-control parametro" name="nombre[]" id="procedimiento'+ FieldCount +'"><option></option><?php while ($lista = mysql_fetch_assoc($lista_tratamientos)) { ?><option><?php echo $lista["nombre"]; ?></option><?php } ?></select></div></div></td><td width=""><div class="cuerpo"><select name="parte[]" class="form-control partes" id="partescuerpo'+ FieldCount +'"><option></option><option>Area del bikini</option><option>Cuero cabelludo</option><option>Axilas</option><option>Cara</option><option>Cara y Cuello</option><option>Pecho</option><option>Espalda</option><option>Brazos</option><option>Gluteos</option><option>Muslos</option><option>Piernas</option><option>Cicatriz</option><option>Cicatrices</option><option>Manos</option><option>Parpados</option><option>Boso</option><option>Papada</option><option>Revolvera</option><option>Abdomen</option><option>Abdomen y Cintura</option><option>Cintura</option><option>Cara Femenina</option><option>Cara y Cuello Femenina</option><option>Cara Masculina</option><option>Cara y cuello masculina</option></select></div></td><td><div class="control-group"><div class="controls"><input type="number" min="1" max="100" value="1" name="cantidad[]" class="form-control seciones" required></div></div></td><td><div class="control-group"><div class="controls"><select name="frecuencia[]" class="form-control" required><option value="" selected>Seleccione</option><option>Unica</option><option>3 Dias</option><option>5 Dias</option><option>8 Dias</option><option>10 Dias</option><option>15 Dias</option> <option>21 Dias</option><option>Mensualmente</option></select></div></div></td><td><div class="control-group"><input name="parametros" class="form-control"></div></td><td><a href="#" class="eliminar btn btn-danger" title="Eliminar" ><i class="icon-remove"> </i></a></td></tr>');
	            x++; //text box increment
	        }
	        return false;
	    });

	    $("body").on("click",".eliminar", function(e){ //click en eliminar campo
	        if( x > 1 ) {
	            $(this).parent('tbody').remove(); //eliminar el campo
	            x--;
	        }
	        return false;
	    });
	});
</script>