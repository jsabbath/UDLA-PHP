
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='http://fonts.googleapis.com/css?family=Nunito:400,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Courgette' rel='stylesheet' type='text/css'>
  <link href="../../../css/normalize.css" rel="stylesheet">
  <link href="../../../css/paciente/bootstrap.min.css" rel="stylesheet">
  <link href="../../../css/paciente/bootstrap-theme.css" rel="stylesheet">
  <link href="../../../css/paciente/font-awesome.css" rel="stylesheet">
   <link href="../../../css/paciente/style.css" rel="stylesheet">
  <script src="../../../js/jquery-1.7.2.min.js"></script>
  <script src="../../../js/bootstrap.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
    $.datepicker.regional['es'] = 
      {
      closeText: 'Cerrar', 
      prevText: 'Previo', 
      nextText: 'Próximo',
       
      monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
      'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
      monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
      'Jul','Ago','Sep','Oct','Nov','Dic'],
      monthStatus: 'Ver otro mes', yearStatus: 'Ver otro año',
      dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
      dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
      dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
      dateFormat: 'yy/mm/dd', firstDay: 0, 
      initStatus: 'Selecciona la fecha', isRTL: false,
      yearRange: '-100:+0'};
     $.datepicker.setDefaults($.datepicker.regional['es']);
  });
  </script>
  <title>.:::Unidad Dermatologica::.</title>
  <meta charset="utf-8">

<style type="text/css">
  .nav-color{
    background: #00ba8b !important;
  }
  .link-color{
    color: #fff !important;
  }
  h1, h2, h3, h4, h5, p{
    font-family: 'Nunito', sans-serif; 
  }

  p, label{
    font-size: 16px;
  }

  input[type=radio] {
    margin: 4px 10px 10px 0;
    margin-top: 1px \9;
    line-height: 2px;
    width:18px;
    height: 18px;
    
  } 
</style>
</head>
<body>
<header>
<nav class="navbar  nav-color">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand link-color" href="index.php">Historias Medicas</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav pull-right">
            <li><a href="../../panel_de_control.php" class="link-color"><i class="fa fa-sign-in"></i> Panel de Control</a></li>
          </ul>
        </div>
      </div>
</nav>
</header>







