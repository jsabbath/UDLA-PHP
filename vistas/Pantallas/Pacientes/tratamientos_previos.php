<?php
require("../../header2.php"); 
include "../../config/datos.php";
$paciente_id = $_GET['paciente'];
?>

<div class="container">
    <h1 class="text-center">TU INFORMACIÒN ES VALIOSA PARA NOSOTROS <br>
        <small>Queremos conocer tu salud para ayudarte mejor.</small>
    </h1>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">Tratamientos Previos(medicamentos que toma o ha tomado)</h3>
            <div class="progress ">
              <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
                50%
              </div>
            </div>
        </div>

        <div class="panel-body">
            <div class="row">
            <div class="container">
                <!-- mensajess de error o informacion -->
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

                <!-- texto de ayudaa -->
                <div class="ayuda text-danger col-lg-12">
                    <p style="padding-left:12px"><i class="fa fa-info-circle"></i> Por favor presione según sea necesario sobre una o mas tratamientos que se haya aplicado anteriormente:</p>
                </div>

                <!-- consulta de las opciones ya seleccionadas -->
                <?php 
                    $consulta2 = mysql_query("SELECT tratamientos FROM tratamientos_previos WHERE paciente_id = '{$paciente_id}' ");
                    $arreglo = "";
                    while ($fila = mysql_fetch_assoc($consulta2)) {
                        $arreglo .= ",".$fila['tratamientos'];   
                    }
                    
                    $list = explode(",", $arreglo);
                    //print_r($list);                                   
                ?>

                <!-- div todas las opciones -->
                <div class="preguntas">
                    <ul>
                        <li>  <!-- /////////////tomaa vitaminas//////////////////// -->
                            <?php if(in_array("Toma o se inyecta Vitaminas", $list, true)){ ?>
                                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box-checked">
                                <P class="box-text"><i class="fa fa-check"></i> ¿Toma o se inyecta Vitaminas?</P>   
                            </div>
                            <?php }
                            else{ ?>
                            <a href="" data-toggle="modal" data-target="#vitaminas" class="box-button">
                            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box">
                                <P class="box-text"><i class="fa fa-chevron-right"></i> ¿Toma o se inyecta Vitaminas?</P>   
                            </div>
                            </a>
                            <?php } ?>
                        </li>

                        <li>  <!-- /////////////¿Toma Proteinas?//////////////////// -->
                            <?php if(in_array("Toma Proteinas", $list, true)){ ?>
                                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3 box-checked">
                                <P class="box-text"><i class="fa fa-check"></i> ¿Toma Proteinas?</P>   
                            </div>
                            <?php }
                            else{ ?>
                            <a href="" data-toggle="modal" data-target="#proteinas" class="box-button">
                            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3 box">
                                <P class="box-text"><i class="fa fa-chevron-right"></i> ¿Toma Proteinas?</P>   
                            </div>
                            </a>
                            <?php } ?>
                        </li>

                        <li>  <!-- /////////////¿Toma aminoacidos?//////////////////// -->
                            <?php if(in_array("Toma Aminoacidos", $list, true)){ ?>
                                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box-checked">
                                <P class="box-text"><i class="fa fa-check"></i> ¿Toma Aminoacidos?</P>   
                            </div>
                            <?php }
                            else{ ?>
                            <a href="" data-toggle="modal" data-target="#aminoacidos" class="box-button">
                            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box">
                                <P class="box-text"><i class="fa fa-chevron-right"></i> ¿Toma Aminoacidos?</P>   
                            </div>
                            </a>
                            <?php } ?>
                        </li>

                        <li>  <!-- /////////////¿Toma aspirinas?//////////////////// -->
                            <?php if(in_array("Toma Aspirinas", $list, true)){ ?>
                                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box-checked">
                                <P class="box-text"><i class="fa fa-check"></i> ¿Toma Aspirinas?</P>   
                            </div>
                            <?php }
                            else{ ?>
                            <a href="" data-toggle="modal" data-target="#aspirinas" class="box-button">
                            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box">
                                <P class="box-text"><i class="fa fa-chevron-right"></i> ¿Toma Aspirinas?</P>   
                            </div>
                            </a>
                            <?php } ?>
                        </li>

                        <li>  <!-- /////////////¿Toma Anticoagulantes?//////////////////// -->
                            <?php if(in_array("Toma Anticoagulantes", $list, true)){ ?>
                                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3 box-checked">
                                <P class="box-text"><i class="fa fa-check"></i> ¿Toma Anticoagulantes?</P>   
                            </div>
                            <?php }
                            else{ ?>
                            <a href="" data-toggle="modal" data-target="#anticoagulantes" class="box-button">
                            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3 box">
                                <P class="box-text"><i class="fa fa-chevron-right"></i> ¿Toma Anticoagulantes?</P>   
                            </div>
                            </a>
                            <?php } ?>
                        </li>

                        <li>  <!-- /////////////¿Toma Antiflamatorios?//////////////////// -->
                            <?php if(in_array("Toma Antiflamatorios", $list, true)){ ?>
                                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box-checked">
                                <P class="box-text"><i class="fa fa-check"></i> ¿Toma Antiflamatorios?</P>   
                            </div>
                            <?php }
                            else{ ?>
                            <a href="" data-toggle="modal" data-target="#antiflamatorios" class="box-button">
                            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box">
                                <P class="box-text"><i class="fa fa-chevron-right"></i> ¿Toma Antiflamatorios?</P>   
                            </div>
                            </a>
                            <?php } ?>
                        </li>

                        <li>  <!-- ///////¿Toma Hormonas de crecimiento?//////////////// -->
                            <?php if(in_array("Toma Hormonas de Crecimiento", $list, true)){ ?>
                                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box-checked">
                                <P class="box-text"><i class="fa fa-check"></i> ¿Toma Hormonas de Crecimiento?</P>   
                            </div>
                            <?php }
                            else{ ?>
                            <a href="" data-toggle="modal" data-target="#hormonas" class="box-button">
                            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box">
                                <P class="box-text"><i class="fa fa-chevron-right"></i> ¿Toma Hormonas de Crecimiento?</P>   
                            </div>
                            </a>
                            <?php } ?>
                        </li>

                        <li>  <!-- /////////////¿Toma Antibioticos?//////////////////// -->
                            <?php if(in_array("Toma Antibioticos", $list, true)){ ?>
                                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3 box-checked">
                                <P class="box-text"><i class="fa fa-check"></i> ¿Toma Antibioticos?</P>   
                            </div>
                            <?php }
                            else{ ?>
                            <a href="" data-toggle="modal" data-target="#antibioticos" class="box-button">
                            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3 box">
                                <P class="box-text"><i class="fa fa-chevron-right"></i> ¿Toma Antibioticos?</P>   
                            </div>
                            </a>
                            <?php } ?>
                        </li>

                        

                        <li><a class="box-button" href="#" data-toggle="modal" data-target="#otros">
                            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box">
                                <P class="box-text"><i class="fa fa-chevron-right"></i> Otras</P>   
                            </div>
                            </a>
                        </li>

                    </ul>
                </div>
                 </div>   
            </div>
        </div>

        <div class="panel-footer">
            <a href="cremas.php?paciente=<?php echo $paciente_id; ?>" class="btn btn-success btn-lg">Continuar</a>
        </div>
    </div>
</div>

<?php include("modals_previos.php"); ?>
</body>
</html>
