<?php 
include("../../header2.php");
$paciente_id = $_GET['paciente'];
$gen = $_GET['gen'];
?>


<div class="container">
	<h1 class="text-center">TU INFORMACIÒN ES VALIOSA PARA NOSOTROS <br>
	    <small>Queremos conocer tu salud para ayudarte mejor.</small>
	</h1>

<?php if($gen == 2){ ?>
	<!-- ////////////// PANEL FEMENINO ///////////// -->
	<div class="panel-default panel">
		<div class="panel-heading">
			<h3 class="text-center">Antecedentes femeninos</h3>
            <div class="progress ">
              <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;">
                90%
              </div>
            </div>			
		</div>

		<div class="panel-body">
			<div class="row">
                <?php if (isset($_GET['msg'])) {
                    $msg= $_GET['msg']; ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong><?php echo $msg; ?> </strong>
                    </div>
                <?php } ?>
                <?php if (isset($_GET['reanuda'])) { ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Sus datos personales ya estan registrados. Por favor ingrese los datos medicos faltantes en su registro. </strong>
                    </div>
                <?php } ?>
				
                <form  role="form" class="form" action="../../PHP/paciente/registra_preguntas_gen.php" method="POST">
                <input type="hidden" name="paciente_id" value="<?php echo $paciente_id;?> ">

                <div class="col-xs-12 col-md-6 col-lg-6">
                	<!-- ///////////// PREGUNTAAA 1 /////////// -->
                    <div class="form-group">
                        <br>
                        <label> ¿Edad en que se desarrollo?</label>
                        <input class="form-control input-lg" type="text" name="edad_des">
                    </div>
                    <div class="form-group">
                        <br>
                        <label> ¿Edad en que experimento la menopausia?</label>
                        <input class="form-control input-lg" type="text" name="edad_menopausia">
                    </div>
                    

                    <p class="lead"><strong>¿Experimenta un ciclo menstrual regular?</strong></p>
                    <label class="radio-inline">
                      <input type="radio" name="trast"  value="si"> SI
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="trast" value="no"> NO
                    </label>

                    <p class="lead"><strong>¿Experimenta dolor intenso durante la mestruacion? </strong></p>
                    <label class="radio-inline">
                      <input type="radio" name="dolor_menstrual"  value="si"> SI
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="dolor_menstrual" value="no"> NO
                    </label>		

                </div>
                <div class="col-xs-12 col-md-6 col-lg-6">
                    <p class="lead"><strong>¿Sufre de Ovarios poliquísticos o multifoliculares?</strong></p>
                    <label class="radio-inline">
                      <input type="radio" name="ovarios"  value="si"> SI
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="ovarios" value="no"> NO
                    </label>

                	<p class="lead"><strong>¿Toma Hormonas femeninas?</strong></p>
                    <label class="radio-inline">
                      <input type="radio" name="hormonas"   value="si"> SI
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="hormonas" value="no"> NO
                    </label>

                    <p class="lead"><strong>¿Toma anticonceptivos orales?</strong> </p>
                    <label class="radio-inline">
                      <input type="radio" name="anti"  id="anticonceptivo" onchange="javascript:showContent()" value="si"> Si
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="anti" value="no" onchange="javascript:showContent()"> NO
                    </label>
                    
                    <div class="form-group" id="content" style="display: none;">
                        <br>
                        <label> ¿cual?</label>
                        <input class="form-control input-lg" type="text" name="cual_anti">
                    </div>

                    <p class="lead"><strong>¿Tiene sospechas de embarazo?</strong></p>
                    <label class="radio-inline">
                      <input type="radio" name="embarazo"  value="si"> SI
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="embarazo" value="no"> NO
                    </label>

                    <div class="form-group">
					    <br>
					    <label> ¿Fecha de ultima menstruación?</label>
					    <input class="form-control input-lg" type="date" name="fecha">
					</div>
                </div>               
			</div>
		</div>
		<div class="panel-footer">
			<a href="terminar.php" class="btn btn-default btn-lg">Omitir</a>
			<button type="submit" name="femenino" class="btn btn-success btn-lg">Guardar y Continuar</button>
		</div>
	</form>
	</div> <!-- ////////////// FIN PANEL FEMENINO ///////////// -->
<?php }
else{ ?>

	<!-- ////////////// PANEL MASCULINO ///////////// -->
	<div class="panel-default panel">
		<div class="panel-heading">
			<h3 class="text-center">Antecedentes masculinos</h3>
            <div class="progress ">
              <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;">
                90%
              </div>
            </div>
		</div>
		<div class="panel-body">
			<div class="row">
                <?php if (isset($_GET['msg'])) {
                    $msg= $_GET['msg']; ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong><?php echo $msg; ?> </strong>
                    </div>
                <?php } ?>
                <?php if (isset($_GET['reanuda'])) { ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Sus datos personales ya estan registrados. Por favor ingrese los datos medicos faltantes en su registro. </strong>
                    </div>
                <?php } ?>
				
                <form  role="form" class="form" action="../../PHP/paciente/registra_preguntas_gen.php" method="POST">
                <input type="hidden" name="paciente_id" value="<?php echo $paciente_id;?> ">
                
                <div class="col-xs-12 col-md-6 col-lg-6">
                	<p class="lead"><strong>¿Tiene Pareja Estable?</strong></p>
                    <label class="radio-inline">
                      <input type="radio" name="pareja"  value="si"> SI
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="pareja" value="no"> NO
                    </label>

                    <p class="lead"><strong>¿Usa Preservativo(condon)?</strong></p>
                    <label class="radio-inline">
                      <input type="radio" name="condon"  value="si"> SI
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="condon" value="no"> NO
                    </label>
                </div>

                <div class="col-xs-12 col-md-6 col-lg-6">
                	<p class="lead"><strong>¿Ha realizado Antígeno prostático (más de 40 años de edad)?</strong></p>
                    <label class="radio-inline">
                      <input type="radio" name="antigeno"  id="antigeno" onchange="javascript:showContent2()" value="si"> SI
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="antigeno" onchange="javascript:showContent2()" value="no"> NO
                    </label>

                    <div class="form-group" id="content2" style="display: none;">
					    <br>
					    <label> En que Fecha:</label>
					    <input class="form-control input-lg" type="date" name="fecha">
                        <label> Resultados:</label>
                        <input class="form-control input-lg" type="text" name="resultado">
					</div>
                </div>
			</div>
		</div>
		<div class="panel-footer">
			<a href="terminar.php" class="btn btn-default btn-lg">Omitir</a>
			<button type="submit" name="masculino" class="btn btn-success btn-lg">Guardar y Continuar</button>
		</div>
	</form>
	</div> <!-- ////////////// FIN PANEL MASCULINO ///////////// -->
<?php } ?>
</div>
</body>
</html>
<script type="text/javascript">

    function showContent() {
        element = document.getElementById("content");
        check = document.getElementById("anticonceptivo");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
    function showContent2() {
        element = document.getElementById("content2");
        check = document.getElementById("antigeno");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
</script>