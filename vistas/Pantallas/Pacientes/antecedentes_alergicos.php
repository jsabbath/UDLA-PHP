<?php 
require("../../header2.php");
$paciente_id = $_GET['paciente'];
?>

<div class="container">
    <h1 class="text-center">TU INFORMACIÒN ES VALIOSA PARA NOSOTROS <br>
        <small>Queremos conocer tu salud para ayudarte mejor.</small>
    </h1>

    <div class="panel-default panel">
        <div class="panel-heading">
            <h3 class="text-center">Antecedentes alergicos:</h3>
            <div class="progress ">
              <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;">
                20%
              </div>
            </div>
        </div>

        <div class="panel-body">
            <div class="row">
                <h3 class="text-center"></h3>
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
                <div class="col-xs-12 col-md-6 col-lg-5">
                    <form role="form" class="form" action="../../PHP/paciente/registra_alergias.php" method="POST">
                    <p class="lead">¿Es usted alergico a algún Medicamento?</p>
                    <input type="hidden" name="paciente_id" value="<?php echo $paciente_id;?> ">
                    <label class="radio-inline">
                      <input type="radio" name="medicamento"  id="radiomedicamento" onchange="javascript:showContent()" value="si"> Si
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="medicamento" value="no" onchange="javascript:showContent()"> NO
                    </label>
                    
                    <div class="form-group" id="content" style="display: none;">
                        <br>
                        <label> ¿Ha cuales medicamentos es alergico?</label>
                        <input class="form-control input-lg" type="text" name="medicamentos">
                    </div>

                </div>

                <div class="col-xs-12 col-md-6 col-lg-2">

                </div>

                <div class="col-xs-12 col-md-6 col-lg-5">
                    <p class="lead">¿Es usted alergico a algún Alimento?</p>

                    <label class="radio-inline">
                      <input type="radio" name="alimento" data-validate="validate(minselect(1))" id="radioalimento" onchange="javascript:showContent2()" value="si"> Si
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="alimento" value="no" onchange="javascript:showContent2()"> NO
                    </label>
                    <br>
                    <div class="form-group" id="content2" style="display: none;">
                        <br>
                        <label> ¿Ha cuales alimentos es alergico?</label>
                        <input class="form-control input-lg" type="text" name="alimentos">
                    </div>
                </div>

            </div>
        </div>

        <div class="panel-footer">
            <button type="submit" class="btn btn-success btn-lg">Guardar y Continuar</button>
        </div>
    </form>
    </div>

</div>

</body>
</html>
<script type="text/javascript">
$('#default-behavior').ketchup();
    function showContent() {
        element = document.getElementById("content");
        check = document.getElementById("radiomedicamento");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
    function showContent2() {
        element = document.getElementById("content2");
        check = document.getElementById("radioalimento");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
</script>