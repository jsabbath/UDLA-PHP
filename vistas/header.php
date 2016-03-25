<?php   include "config/datos.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Sistema de Citas Medicas</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link href="../../../css/bootstrap.min.css" rel="stylesheet">
<link href="../../../css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="../../../css/select2.css" rel="stylesheet">

<link href="../../../css/font-awesome.css" rel="stylesheet">
<link href="../../../css/style.css" rel="stylesheet">
<link href="../../../css/pages/dashboard.css" rel="stylesheet">

<script src="../../../js/jquery-1.7.2.min.js"></script>
<script src="../../../js/bootstrap.js"></script>
<script src="../../../js/udla.js"></script>
<script src="../../../js/select/select2.min.js"></script>

<link href="../../../datepicker/css/bootstrap-datepicker.css" rel="stylesheet" >
<script src="../../../datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="../../../datepicker/locales/bootstrap-datepicker.es.min.js"></script>

<script type="text/javascript">
  $('#datepicker').datepicker({
        format: "yyyy-mm-dd",
        startDate: "-1y",
        endDate: "+0d",
        language: "es",
        autoclose: true,
        todayHighlight: true
    });
</script>

<?php @session_start(); ?>

</head>
<body>
<?php 
//especialista
if ($header==1) {

    

   if(isset($_SESSION['usuario'])){


  }else{
    header("Location: ../../panel_de_control.php?error=Acceso denegado");
  }
?>

<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="#">Historias Medicas </a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-cog"></i> Mi Cuenta<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="javascript:;">Configuracion</a></li>
              <li><a href="javascript:;">Ayuda</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-user"></i><?php echo  " ".$_SESSION['nombre']." ". $_SESSION['apellido']; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="javascript:;">Mi Perfil</a></li>
              <li><a href="../../PHP/salir.php">Salir</a></li>
            </ul>
          </li>
        </ul>
        
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
<!-- /navbar -->
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li <?php if ($activo==1) { echo 'class="active"';  }?>><a href="./inicio.php"><i class="icon-th-large "></i><span>Principal</span> </a> </li>
       <?php if (isset($_GET['paciente'])) { ?>
        <li <?php  if  ($activo==4) { echo 'class="active"';  }?>><a href="ver_historial.php?paciente=<?php echo $_GET['paciente']; ?>"><i class="icon-user "></i><span>Paciente actual</span> </a> </li>
        <?php } ?>
        <li <?php if ($activo==2) { echo 'class="active"';  }?>><a href="todos_los_pacientes.php"><i class="icon-group "></i><span>Pacientes</span> </a> </li>
        <li <?php if ($activo==3) { echo 'class="active"';  }?>><a href="crear_cita.php"><i class="icon-calendar-empty"></i><span> Crear cita</span> </a></li>
        <li <?php if ($activo==5) { echo 'class="active"';  }?>><a href="citas_pautadas.php"><i class="icon-calendar"></i><span> Citas Pautadas</span> </a> </li>
        <li <?php if ($activo==7) { echo 'class="active"';  }?>><a href="reportes.php"><i class="icon-list-ol"></i><span> Reportes</span> </a> </li>
       <li <?php if ($activo==8) { echo 'class="active"';  }?>><a href="reportes_productividad.php"><i class="icon-user-md"></i><span> Productividad</span> </a> </li>
       <li <?php if ($activo==9) { echo 'class="active"';  }?>><a href="morbilidad.php"><i class="icon-bar-chart"></i><span> Morbilidad</span> </a> </li>
      <li <?php if ($activo==10) { echo 'class="active"';  }?>><a href="configuraciones.php"><i class="icon-cogs"></i><span>Ajustes</span> </a> </li>

      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
<!-- /subnavbar -->


<?php 
}
//recepcion enfermera recidente
elseif ($header==2) {


   
  include "config/datos.php";
   if(isset($_SESSION['usuario'])){

  }else{
    header("Location: ../../panel_de_control.php?error=Acceso denegado");
  }
?>

  
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="#">Historias Medicas </a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-cog"></i> Mi Cuenta<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="javascript:;">Configuracion</a></li>
              <li><a href="javascript:;">Ayuda</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-user"></i><?php echo  " ".$_SESSION['nombre']." ". $_SESSION['apellido']; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="javascript:;">Mi Perfil</a></li>
              <li><a href="../../PHP/salir.php">Salir</a></li>
            </ul>
          </li>
        </ul>
        
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
<!-- /navbar -->
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
       <?php if ($_SESSION['id_nivel']==2 OR $_SESSION['id_nivel']==1 ) { ?>
       <li <?php if ($activo==1) { echo 'class="active"';  }?>><a href="./index.php"><i class="icon-th-large "></i><span>Inicio</span> </a> </li>
       <?php }else{ ?>
        <li <?php if ($activo==1) { echo 'class="active"';  }?>><a href="./index.php"><i class="icon-th-large "></i><span>Inicio</span> </a> </li>
        <?php  }?>
        <li <?php if ($activo==2) { echo 'class="active"';  }?>><a href="todos_los_pacientes.php"><i class="icon-group"></i><span>Pacientes</span> </a> </li> 
        
       <?php if ($_SESSION['id_nivel']==3) { ?>
       <li <?php if ($activo==3) { echo 'class="active"';  }?>><a href="agregar_nuevo_pacientes.php"><i class="icon-calendar-empty"></i><span>Cita con Historia</span> </a> </li>
      <li <?php if ($activo==5) { echo 'class="active"';  }?>><a href="cita_rapida.php"><i class="icon-share-alt"></i><span>Cita rapida </span> </a> </li>
      <li <?php if ($activo==6) { echo 'class="active"';  }?>><a href="pago_citas.php"><i class="icon-credit-card"></i><span>Pago de Citas </span> </a> </li>
      <li <?php if ($activo==7) { echo 'class="active"';  }?>><a href="morbilidad.php"><i class="icon-bar-chart"></i><span>Morbilidad</span> </a> </li>

      <?php } ?>
               
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
<!-- /subnavbar -->
<!-- /subnavbar -->



<?php
}elseif($header==10){
  ?>


<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="#">Historias Medicas </a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-cog"></i> Mi Cuenta<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="javascript:;">Configuracion</a></li>
              <li><a href="javascript:;">Ayuda</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-user"></i><?php echo  " ".$_SESSION['nombre']." ". $_SESSION['apellido']; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="javascript:;">Mi Perfil</a></li>
              <li><a href="../../PHP/salir.php">Salir</a></li>
            </ul>
          </li>
        </ul>
        
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
<!-- /navbar -->
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li <?php if ($activo==1) { echo 'class="active"';  }?>><a href="./inicio.php"><i class="icon-th-large "></i><span>Principal</span> </a> </li>
       <?php if (isset($_GET['paciente'])) { ?>
        <li <?php  if  ($activo==4) { echo 'class="active"';  }?>><a href="ver_historial.php?paciente=<?php echo $_GET['paciente']; ?>"><i class="icon-user "></i><span>Paciente actual</span> </a> </li>
        <?php } ?>
        <li <?php if ($activo==2) { echo 'class="active"';  }?>><a href="todos_los_pacientes.php"><i class="icon-group "></i><span>Pacientes</span> </a> </li>
        <li <?php if ($activo==3) { echo 'class="active"';  }?>><a href="crear_cita.php"><i class="icon-calendar-empty "></i><span>Crear cita</span> </a></li>
        <li <?php if ($activo==5) { echo 'class="active"';  }?>><a href="citas_pautadas.php"><i class="icon-calendar "></i><span>Citas Pautadas</span> </a> </li>
        <li <?php if ($activo==7) { echo 'class="active"';  }?>><a href="reportes.php"><i class="icon-list-ol "></i><span>Reportes</span> </a> </li>
       <li <?php if ($activo==8) { echo 'class="active"';  }?>><a href="reportes_productividad.php"><i class="icon-user-md "></i><span>Productividad</span> </a> </li>
       <li <?php if ($activo==9) { echo 'class="active"';  }?>><a href="morbilidad.php"><i class="icon-bar-chart"></i><span> Morbilidad</span> </a> </li>
       <li <?php if ($activo==10) { echo 'class="active"';  }?>><a href="configuraciones.php"><i class="icon-cogs"></i><span>Ajustes</span> </a> </li>

      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
<!-- /subnavbar -->





<?php
}else{ ?>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="#">Historias Medicas </a>
      <div class="nav-collapse">
        <ul class="nav pull-right">

        </ul>
        
      </div>
      <!--/.nav-collapse -->
    </div>
    <!-- /container -->
  </div>
  <!-- /navbar-inner -->
</div>
<!-- /navbar -->




<?php }
?>


