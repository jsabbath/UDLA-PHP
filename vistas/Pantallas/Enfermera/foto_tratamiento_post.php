<?php 
$id = $_GET['id'];
$paciente = $_GET['paciente'];
$header=2;
$activo=2;
require('../../header.php');
include("../../PHP/funciones.php");
//consulta
$tabla_pacientes = mysql_query("SELECT * FROM pacientes WHERE id = '{$paciente}' LIMIT 1 ");
$paciente_data = mysql_fetch_assoc($tabla_pacientes);
?>
<style type="text/css">
.fotografia{
	width: 320px;
	height: 240px;
	border: 10px solid #666;
	border-radius: 7px;
	margin-bottom: 10px;
}
</style>
<script src="../../../js/say-cheese.js"></script>

<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
					<?php if (isset($_GET['msg'])) {
	                    $msg= $_GET['msg']; ?>
	                    <div class="alert alert-danger">
	                        <button type="button" class="close" data-dismiss="alert">&times;</button>
	                        <strong><?php echo $msg; ?> </strong>
	                    </div>
	                <?php } ?>
				<div class="span6">
					<div class="widget">
						<div class="widget-header">
							<i class="icon-camera"></i>
							<h3>Fotoregistro del tratamiento:</h3>
						</div> <!-- /widget-header -->
						
						<div class="widget-content">
							<div class="say-cheese"></div>
							<center>			
								<div id="say-cheese-container" class="fotografia">
								    
								</div>
								<div id="action-buttons">
								    <button class="btn btn-success" id="take-snapshot">Tomar Foto</button>
								</div>
							</center>			
		                    
						</div> <!-- /widget-content -->		
					</div>
				</div>

						<div class="span6">
							<div class="widget">
								<div class="widget-header">
									<i class="icon-camera"></i>
									<h3>Visualización de foto tomada:</h3>
								</div> <!-- /widget-header -->
								
								<div class="widget-content">
									<center>		
										<div id="say-cheese-snapshots" class="fotografia">

										</div>
				                    	<span class="btn btn-success" id="guardarFoto">Guardar Foto</span>
				                	</center>
								</div> <!-- /widget-content -->		
							</div>
						</div>
			</div>
		</div>
	</div>
</div>

<script>
$(function(){
      	var img=null;
        var sayCheese = new SayCheese('#say-cheese-container', { 
        	audio: false,
        	snapshots: true,
         });

		sayCheese.start();
        /*sayCheese.on('start', function() {
          $('#action-buttons').fadeIn('fast'); */

          $('#take-snapshot').on('click', function(evt) {
            sayCheese.takeSnapshot(320, 240);
          });
        //});

        sayCheese.on('error', function(error) {
          var $alert = $('<div>');
          $alert.addClass('alert alert-error').css('margin-top', '20px');

          if (error === 'NOT_SUPPORTED') {
            $alert.html("<strong>:(</strong> Su navegador no sopoorta la funcion de video!");
          } else if (error === 'AUDIO_NOT_SUPPORTED') {
            $alert.html("<strong>:(</strong> Su navegador no soporta audio!");
          } else {
            $alert.html("<strong>:(</strong> Debe permitir al navegador usar su camara!");
          }

          $('.say-cheese').prepend($alert);
        });

        sayCheese.on('snapshot', function(snapshot) {
           img = document.createElement('img');

          $(img).on('load', function() {
            $('#say-cheese-snapshots').html(img);
          });
          img.src = snapshot.toDataURL('image/png');
        });
      
		$('#guardarFoto').bind('click', function() {
			var src = img.src;
			
			data = {
				src: src
			}
			$.ajax({
				url: '../../PHP/enfermera/guardar_foto_post.php?id=<?php echo $id;?>&paciente=<?php echo $paciente;?>',
				data: data,
				type: 'POST',
				success: function (msg) {
				window.location="../../Pantallas/Enfermera/observacion_tratamiento.php?id=<?php echo $id;?>&paciente=<?php echo $paciente;?>";
				}
			});
		});	
});
</script>