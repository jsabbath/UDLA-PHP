<?php 
include("../../header2.php");
include "../../config/datos.php";
$paciente_id = $_GET['paciente'];
?>

<div class="container">
    <h1 class="text-center">TU INFORMACIÒN ES VALIOSA PARA NOSOTROS <br>
        <small>Queremos conocer tu salud para ayudarte mejor.</small>
    </h1>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">Examenes Realizados:</h3>
            <div class="progress ">
              <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;">
                70%
              </div>
            </div>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="container">
                <!-- mensajesss de error o informacion -->
                    <?php if (isset($_GET['msg'])) {
                        $msg= $_GET['msg']; ?>
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><?php echo $msg; ?> </strong>
                        </div>
                    <?php } ?>
                    <h3 class="text-center"></h3>
                    <?php if (isset($_GET['reanuda'])) { ?>
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Sus datos personales ya estan registrados. Por favor ingrese los datos medicos faltantes en su registro. </strong>
                        </div>
                    <?php } ?>

                    <!-- texto de ayudaa -->
                    <div class="ayuda text-danger col-lg-12">
                        <p style="padding-left:12px"><i class="fa fa-info-circle"></i> Por favor presione según sea necesario sobre una o mas examenes que se haya realizado en los ultimos tres meses:</p>
                    </div>

                    <!-- consulta de las opciones ya seleccionadas -->
                    <?php 
                        $consulta2 = mysql_query("SELECT examen FROM examenes WHERE paciente_id = '{$paciente_id}' ");
                        $arreglo = "";
                        while ($fila = mysql_fetch_assoc($consulta2)) {
                            $arreglo .= ",".$fila['examen'];   
                        }
                        
                        $list = explode(",", $arreglo);
                        //print_r($list);                                   
                    ?>

                    <div class="preguntas">
                        <ul>
                            <li>  <!-- /////////////hematologia//////////////////// -->
                                <?php if(in_array("Hematologia", $list, true)){ ?>
                                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box-checked">
                                    <P class="box-text"><i class="fa fa-check"></i>Hematologia</P>   
                                </div>
                                <?php }
                                else{ ?>
                                <a href="" data-toggle="modal" data-target="#hematologia" class="box-button">
                                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box">
                                    <P class="box-text"><i class="fa fa-chevron-right"></i>Hematologia</P>   
                                </div>
                                </a>
                                <?php } ?>
                            </li>

                            <li>  <!-- /////////////Tiroides//////////////////// -->
                                <?php if(in_array("Tiroides", $list, true)){ ?>
                                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3 box-checked">
                                    <P class="box-text"><i class="fa fa-check"></i>Tiroides</P>   
                                </div>
                                <?php }
                                else{ ?>
                                <a href="" data-toggle="modal" data-target="#tiroides" class="box-button">
                                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3 box">
                                    <P class="box-text"><i class="fa fa-chevron-right"></i>Tiroides</P>   
                                </div>
                                </a>
                                <?php } ?>
                            </li>

                            <li>  <!-- /////////////Quimica Sanguinea//////////////////// -->
                                <?php if(in_array("Quimica Sanguinea", $list, true)){ ?>
                                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box-checked">
                                    <P class="box-text"><i class="fa fa-check"></i>Quimica Sanguinea</P>   
                                </div>
                                <?php }
                                else{ ?>
                                <a href="" data-toggle="modal" data-target="#quimica" class="box-button">
                                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box">
                                    <P class="box-text"><i class="fa fa-chevron-right"></i>Quimica Sanguinea</P>   
                                </div>
                                </a>
                                <?php } ?>
                            </li>

                            
                            <li>  <!-- /////////////Hormonales//////////////////// -->
                                <?php if(in_array("Hormonales", $list, true)){ ?>
                                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box-checked">
                                    <P class="box-text"><i class="fa fa-check"></i>Hormonales</P>   
                                </div>
                                <?php }
                                else{ ?>
                                <a href="" data-toggle="modal" data-target="#hormonales" class="box-button">
                                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box">
                                    <P class="box-text"><i class="fa fa-chevron-right"></i>Hormonales</P>   
                                </div>
                                </a>
                                <?php } ?>
                            </li>

                            <li>  <!-- /////////////VDRL//////////////////// -->
                                <?php if(in_array("VDRL", $list, true)){ ?>
                                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3 box-checked">
                                    <P class="box-text"><i class="fa fa-check"></i>VDRL</P>   
                                </div>
                                <?php }
                                else{ ?>
                                <a href="" data-toggle="modal" data-target="#VDRL" class="box-button">
                                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3 box">
                                    <P class="box-text"><i class="fa fa-chevron-right"></i>VDRL</P>   
                                </div>
                                </a>
                                <?php } ?>
                            </li>


                            <li>  <!-- /////////////HIV//////////////////// -->
                                <?php if(in_array("HIV", $list, true)){ ?>
                                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box-checked">
                                    <P class="box-text"><i class="fa fa-check"></i>HIV</P>   
                                </div>
                                <?php }
                                else{ ?>
                                <a href="" data-toggle="modal" data-target="#HIV" class="box-button">
                                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box">
                                    <P class="box-text"><i class="fa fa-chevron-right"></i>HIV</P>   
                                </div>
                                </a>
                                <?php } ?>
                            </li>  

                            <li><a class="box-button" href="#" data-toggle="modal" data-target="#otros">
                                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 box">
                                    <P class="box-text"><i class="fa fa-chevron-right"></i> Otros</P>   
                                </div>
                                </a>
                            </li>                          

                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <div class="panel-footer">
           <a href="habitos.php?paciente=<?php echo $paciente_id; ?>" class="btn btn-success btn-lg">Continuar</a>
        </div>
    </div>
</div>
<?php include("modals_examenes.php"); ?>
</body>
</html>
