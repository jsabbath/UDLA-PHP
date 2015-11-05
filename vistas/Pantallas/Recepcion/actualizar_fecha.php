<?php
	$header=2;

	include "../../config/datos.php"; 
	require('../../header.php');
	  
		?>
		<?php
					$result = mysql_query("SELECT * FROM citas WHERE id LIKE '".$_GET['ids']."'");
					
					if($result === FALSE) { 
					die(mysql_error()); // TODO: better error handling
					}

?>
   <div class="main">
		<div class="main-inner">
		    <div class="container">
		      <div class="row">
		      	
		      	<div class="span12">      		
		      		
		      		<div class="widget ">
		      		
							
					<div class="widget-header">
						<i class="icon-user"></i>
						<h3>Actualización de Cita</h3>
					</div> <!-- /widget-header -->
					
					<div class="widget-content inicio">
			<div class="posicion">			
           <form  id="formulario" method="post" action="../../PHP/recepcion/actualizar_fecha.php?ids=<?php echo $_GET['ids'];?>&id=<?php echo $_GET['id'];?>">
      
          <div class="login-fields">
              
          <center><p class="texto">Introduca la Nueva Fehca</p>
     
           <div class="field"><i class="icon-pencil cedula"></i>
            <input type="date" id="fecha" name="fecha" class="login username-field" />
           </div> <!-- /field -->
          </center>
             
           </div> <!-- /login-fields -->
      
          <div class="login-actions">
        
     
         <center>   <input class="button btn btn-success btn-large" type="submit" name="aceptar" value="Modificar" class="aceptar">       
       
        </center>
         </div> <!-- .actions -->
     </div>
      
      
      
 </form>
</div> <!-- /widget-content -->
				
</div></div></div></div></div></div></div>
					