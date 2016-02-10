<!-- Modal Procedimientos -->
<div id="myModalProc" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Modal header</h3>
  </div>
  <div class="modal-body">
    <p>One fine body…</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary">Save changes</button>
  </div>
</div>


<!-- Modal Diferir Fecha de la Cita-->
<div id="myModalDiferir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Diferir Fecha de la Cita</h3>
  </div>
  <div class="modal-body">
    <form action="" role="form" name="fmdiferir" onsubmit="Diferir(); return false">
      <center>
          <label><h4>Apunte la fecha a la cual quiere reasignar la cita</h4></label>
          <input type="hidden" name="cita_id" value=""> 
          <input type="date" name="fecha">
      </center> 
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button type="submit" name="diferir" class="btn btn-primary">Cambiar</button>
    </form>
  </div>
</div>
