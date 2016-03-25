 <!-- Button to trigger modal -->
  
   
  <!-- Modal -->
  <div id="edit_paciente" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">Datos del Paciente</h3>
    </div>
    <div class="modal-body">
      <form action="../../PHP/especialista/edit_pacientes.php" method="POST" accept-charset="utf-8">
        <div class="row">

          <input type="hidden" name="paciente_id" value="<?php echo $paciente['id']; ?>">
          <div class="span-6">           
              <div class="control-group">                     
                <label class="control-label" for="">Nombre:</label>
                <div class="controls">
                  <input required type="text" name="nombre" value="<?php echo $paciente['nombre_completo']; ?>" class="form-control">
                </div> <!-- /controls -->       
              </div>

              <div class="control-group">                     
                <label class="control-label" for="">Cedula:</label>
                <div class="controls">
                  <input required type="text" name="cedula" value="<?php echo $paciente['cedula']; ?>" class="form-control">
                </div> <!-- /controls -->       
              </div>

              <div class="control-group">                     
                <label class="control-label" for="">Email:</label>
                <div class="controls">
                  <input type="email" name="email" value="<?php echo $paciente['email']; ?>" class="form-control">
                </div> <!-- /controls -->       
              </div>

              <div class="control-group">                     
                <label class="control-label" for="">Fecha de Nacimiento:</label>
                <div class="controls">
                  <input  type="text" name="nacimiento" value="<?php echo $paciente['fecha_nacimiento']; ?>" id="datepicker" class="form-control ">
                </div> <!-- /controls -->       
              </div>

              <div class="control-group">                     
                <label class="control-label" for="">Estado Civil:</label>
                <div class="controls">
                  <input type="text" name="estado_civil" value="<?php echo $paciente['estado_civil']; ?>" class="form-control">
                </div> <!-- /controls -->       
              </div>

              <div class="control-group">                     
                <label class="control-label" for="">Sexo:</label>
                <div class="controls">
                  <select name="sexo" >
                    <option ><?php echo $paciente['sexo']; ?></option>
                    <option >Femenino</option>
                    <option >Masculino</option>
                  </select>
                </div> <!-- /controls -->       
              </div>



          </div> <!-- fin sapn-6 derecha -->

           

          <div class="span-6">
            
            <div class="control-group">                     
                <label class="control-label" for="">Ocupacion:</label>
                <div class="controls">
                  <input  type="text" name="ocupacion" value="<?php echo $paciente['ocupacion']; ?>" class="form-control">
                </div> <!-- /controls -->       
              </div>

            <div class="control-group">                     
                <label class="control-label" for="">Telefono:</label>
                <div class="controls">
                  <input  type="text" name="telefono" value="<?php echo $paciente['telefono']; ?>" class="form-control">
                </div> <!-- /controls -->       
              </div>

              <div class="control-group">                     
                <label class="control-label" for="">Estado:</label>
                <div class="controls">
                 <select name="estado">
                   <option><?php echo $paciente['estado']; ?></option>
                   <option>Amazonas</option><option>Anzoátegui</option><option>Apure</option>
                   <option>Aragua</option> <option>Barinas</option><option>Bolívar</option>
                   <option>Carabobo</option><option>Cojedes</option><option>Delta Amacuro</option>
                   <option>Distrito Federal</option> <option>Falcón</option><option>Guárico</option> 
                   <option>Lara</option><option>Mérida</option><option>Miranda</option>
                   <option>Monagas</option><option>Nueva Esparta</option><option>Portuguesa</option>
                   <option>Sucre</option><option>Táchira</option><option>Vargas</option>
                   <option>Yaracuy</option><option>Zulia</option>
                 </select>
                </div> <!-- /controls -->       
              </div>

              <div class="control-group">                     
                <label class="control-label" for="">Ciudad:</label>
                <div class="controls">
                  <input type="text" name="ciudad" value="<?php echo $paciente['ciudad']; ?>" class="form-control">
                </div> <!-- /controls -->       
              </div>

              <div class="control-group">                     
                <label class="control-label" for="">Direccion:</label>
                <div class="controls">
                  <textarea name="direccion" rows="3"><?php echo $paciente['direccion']; ?></textarea>
                </div> <!-- /controls -->       
            </div>

          </div> <!-- fin span-6 izq -->



        </div> <!-- fin div>row   -->   
      
    </div>
    <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
      <button type="submit" class="btn btn-primary">Guardar Cambios</button>
      </form>
    </div>
  </div>
