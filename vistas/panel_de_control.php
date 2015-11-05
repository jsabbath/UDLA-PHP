<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>Panel de Usuario</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"> 
    
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />

<link href="../css/font-awesome.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/pages/signin.css" rel="stylesheet" type="text/css">

</head>

<body>
  
  <div class="navbar navbar-fixed-top">
  
  <div class="navbar-inner">
    
    <div class="container">
      
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      
      <a class="brand" href="../../index.php">
        Historias medicas        
      </a>    
      
  
  
    </div> <!-- /container -->
    
  </div> <!-- /navbar-inner -->
  
</div> <!-- /navbar -->



<div class="account-container">
  
  <div class="content clearfix">
    
   <form  id="formulario" method="post" action="./PHP/entrar.php">

    
      <h1>Panel de control</h1>   
      
      <div class="login-fields">
        
        <p>Por favor introduzca sus datos</p>
        
        <div class="field">
          <label for="username">Usuario:</label>
          <input type="text" id="usuario" required name="Usuario" value="" placeholder="Username" class="login username-field" />
        </div> <!-- /field -->
        
        <div class="field">
          <label for="password">Contraseña:</label>
          <input type="password" id="password" required name="Password" value="" placeholder="Password" class="login password-field"/>
        </div> <!-- /password -->
        
      </div> <!-- /login-fields -->
      
      <div class="login-actions">
        
        
           <button class="button btn btn-success btn-xl aceptar" type="submit" name="aceptar"  class="aceptar"> Aceptar </button>     
       
        
      </div> <!-- .actions -->
      
      
      
    </form>
    
  </div> <!-- /content -->
  <?php 
    if(isset($_GET['error'])){ ?>
      <div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Datos No Validos. </strong>
      </div>
    <?php }
    ?>
</div> <!-- /account-container -->






<script src="../../js/jquery-1.7.2.min.js"></script>
<script src="../../js/bootstrap.js"></script>

<script src="../../js/signin.js"></script>

</body>

</html>











