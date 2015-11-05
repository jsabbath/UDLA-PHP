<?php 
require("../../header2.php");
$paciente_id = $_GET['paciente'];
?>

<div class="container">
    <h1 class="text-center">TU INFORMACIÒN ES VALIOSA PARA NOSOTROS <br>
        <small>Queremos conocer tu salud para ayudarte mejor.</small>
    </h1>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">Utilización de cremas:</h3>
            <div class="progress ">
              <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                60%
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
                
                <form  role="form" class="form" action="../../PHP/paciente/registra_cremas.php" method="POST">
                <input type="hidden" name="paciente_id" value="<?php echo $paciente_id;?> ">

                <div class="col-xs-12 col-md-12 col-lg-12">
                    <div class="col-xs-12 col-md-6 col-lg-6">
                    <!-- ///////////// PREGUNTAAA 1 /////////// -->
                    <p class="lead"><strong>¿Usa algún protector solar?</strong></p>
                    <label class="radio-inline">
                      <input type="radio" name="protector" id="protector"  onchange="javascript:showContent()" value="si"> Si
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="protector" value="no" onchange="javascript:showContent()"> NO
                    </label>
                    <div class="form-group" id="content" style="display: none;">
                        <br>
                        <label> ¿Cual protector?</label>
                        <input class="form-control input-lg" type="text" name="cual_protector">
                    </div>
                    <hr>

                    <!-- ///////////// PREGUNTAAA 3 ///////////  -->
                    <p class="lead"><strong>¿Usa crema par el cuerpo?</strong></p>
                    <label class="radio-inline">
                      <input type="radio" name="crema_cuerpo"  id="crema_cuerpo" onchange="javascript:showContent3()" value="si"> Si
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="crema_cuerpo" value="no" onchange="javascript:showContent3()"> NO
                    </label>
                    <div class="form-group" id="content3" style="display: none;">
                        <br>
                        <label> ¿Cual ?</label>
                        <input class="form-control input-lg" type="text" name="cual_cuerpo">
                    </div>
                    <hr>
                    </div>

                    <div class="col-xs-12 col-md-6 col-lg-6">
                        <!-- ///////////// PREGUNTAAA 2 ///////////  -->
                        <p class="lead"> <strong>¿Usa crema para la cara de noche?</strong></p>
                        <label class="radio-inline">
                          <input type="radio" name="crema_noche"  id="crema_noche" onchange="javascript:showContent2()" value="si"> Si
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="crema_noche" value="no" onchange="javascript:showContent2()"> NO
                        </label>
                        <div class="form-group" id="content2" style="display: none;">
                            <br>
                            <label> ¿Cual?</label>
                            <input class="form-control input-lg" type="text" name="cual_noche">
                        </div>
                        <hr>
                         <!-- ///////////// PREGUNTAAA 4 ///////////  -->
                        <p class="lead"><strong>¿Usa crema para la cara de dia?</strong></p>
                        <label class="radio-inline">
                          <input type="radio" name="crema_dia"  id="crema_dia" onchange="javascript:showContent4()" value="si"> Si
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="crema_dia" value="no" onchange="javascript:showContent4()"> NO
                        </label>
                        <div class="form-group" id="content4" style="display: none;">
                            <br>
                            <label> ¿Cual?</label>
                            <input class="form-control input-lg" type="text" name="cual_dia">
                        </div>
                        <hr>
                    </div>
                </div>

                <div class="col-xs-12 col-md-12 col-lg-12">
                    <div class="row">
                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <!-- ///////////// PREGUNTAAA 5 ///////////  -->
                            <div class="form-group">
                                <br>
                                <label> ¿Cual Shampoo Usa para el lavado del cabello?</label>
                                <input class="form-control input-lg" type="text" name="shampo">
                            </div>

                            <!-- ///////////// PREGUNTAAA 7 ///////////  -->
                            <div class="form-group">
                                <br>
                                <label> ¿Que jabón usa para el lavado diario ?</label>
                                <input class="form-control input-lg" type="text" name="javon">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <!-- ///////////// PREGUNTAAA 6 ///////////  -->
                               <div class="form-group">
                                   <br>
                                   <label> ¿Que jabón usa para el lavado de la cara?</label>
                                   <input class="form-control input-lg" type="text" name="javon_cara">
                               </div>
                        </div>   
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

    function showContent() {
        element = document.getElementById("content");
        check = document.getElementById("protector");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
    function showContent2() {
        element = document.getElementById("content2");
        check = document.getElementById("crema_noche");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
    function showContent3() {
        element = document.getElementById("content3");
        check = document.getElementById("crema_cuerpo");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
    function showContent4() {
        element = document.getElementById("content4");
        check = document.getElementById("crema_dia");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
</script>