<?php 

define("cServidor", "localhost");
	define("cUsuario", "root");
	define("cPass","");
	define("cBd","udla_local");
	/*  
	* 	conexion con mysqli
	*/
	$conexion = mysqli_connect(cServidor, cUsuario, cPass, cBd);

 ?>