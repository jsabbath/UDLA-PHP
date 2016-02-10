<?php 
include("../../header2.php");
$paciente_id = $_GET['paciente'];
?>

</head>
<body>
<div class="container">
    <h1 class="text-center">TU INFORMACIÒN ES VALIOSA PARA NOSOTROS <br>
        <small>Queremos conocer tu salud para ayudarte mejor.</small>
    </h1>
    <div class="panel-default panel">
        <div class="panel-heading">
            <h3 class="text-center">Habitos:</h3>
            <div class="progress ">
              <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">
                80%
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
                <form  role="form" class="form" action="../../PHP/paciente/registra_habitos.php" method="POST">
                <input type="hidden" name="paciente_id" value="<?php echo $paciente_id;?> ">

                <div class="col-xs-12 col-md-6 col-lg-5">

                    <!-- ///////////// PREGUNTAAA 1 /////////// -->
                    <p class="lead"><strong>¿Fuma?</strong></p>
                    <label class="radio-inline">
                      <input type="radio" name="fuma" id="fuma" onchange="javascript:showContent()" value="si"> Si
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="fuma" value="no" onchange="javascript:showContent()"> NO
                    </label>
                    <div class="form-group" id="content" style="display: none;">
                        <br>
                        <label> Indique con que frecuencia:</label>
                        <select name="frec_fuma" class="form-control ">
                            <option selected value="">Seleccion</option>
                            <option>A diario</option>
                            <option>1 a 2 veces por semana</option>
                            <option>Ocasionalmente</option>
                        </select>
                    </div> <hr>

                    <!-- ///////////// PREGUNTAAA 2 /////////// -->
                    <p class="lead"><strong>¿Toma Licor?</strong></p>
                    <label class="radio-inline">
                      <input type="radio" name="licor"  id="licor" onchange="javascript:showContent2()" value="si"> Si
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="licor" value="no" onchange="javascript:showContent2()"> NO
                    </label>
                    <div class="form-group" id="content2" style="display: none;">
                        <br>
                        <label> Indique con que frecuencia:</label>
                        <select name="frec_licor" class="form-control">
                            <option selected value="">Seleccion</option>
                            <option>A diario</option>
                            <option>1 a 2 veces por semana</option>
                            <option>Ocasionalmente</option>
                        </select>
                    </div> <hr>

                    <!-- ///////////// PREGUNTAAA 5 /////////// -->
                    <p class="lead"><strong>Trabajo o Desempeño:</strong></p>
                    <label class="radio-inline">
                      <input type="radio" name="trabajo" id="trabajo" value="en oficina"> En Oficina
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="trabajo" value="en campo"> En Campo
                    </label>
                     <label class="radio-inline">
                      <input type="radio" name="trabajo" value="entrada y salida"> Entrada y Salida
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="trabajo" value="En el hogar"> En el hogar
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="trabajo" value="No Trabaja"> No Trabaja
                    </label>
                    <hr>

                
                </div>

                <div class="col-xs-12 col-md-6 col-lg-2">
                    <br>
                </div>

                <div class="col-xs-12 col-md-6 col-lg-5">

                    <!-- ///////////// PREGUNTAAA 3 /////////// -->
                    <p class="lead"><strong>¿Realiza deportes al aire libre?</strong></p>
                    <label class="radio-inline">
                      <input type="radio" name="deportes"  id="deportes" onchange="javascript:showContent3()" value="si"> Si
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="deportes" value="no" onchange="javascript:showContent3()"> NO
                    </label>
                    <div class="form-group" id="content3" style="display: none;">
                        <br>
                        <label> Indique con que frecuencia:</label>
                        <select name="frec_deporte" class="form-control">
                            <option selected value="">Seleccion</option>
                            <option>A diario</option>
                            <option>1 a 2 veces por semana</option>
                            <option>Ocasionalmente</option>
                        </select>
                    </div> <hr>

                    <!-- ///////////// PREGUNTAAA 4 /////////// -->
                    <p class="lead"><strong>¿Realiza Ejercicios/Gym?</strong></p>
                    <label class="radio-inline">
                      <input type="radio" name="gym"  id="gym" onchange="javascript:showContent4()" value="si"> Si
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="gym" value="no" onchange="javascript:showContent4()"> NO
                    </label>
                    <div class="form-group" id="content4" style="display: none;">
                        <br>
                        <label> Indique con que frecuencia:</label>
                        <select name="frec_gym" class="form-control">
                            <option selected value="">Seleccion</option>
                            <option>A diario</option>
                            <option>1 a 2 veces por semana</option>
                            <option>Ocasionalmente</option>
                        </select>
                    </div> <hr>


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
        check = document.getElementById("fuma");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
    function showContent2() {
        element = document.getElementById("content2");
        check = document.getElementById("licor");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
    function showContent3() {
        element = document.getElementById("content3");
        check = document.getElementById("deportes");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
    function showContent4() {
        element = document.getElementById("content4");
        check = document.getElementById("gym");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
</script>