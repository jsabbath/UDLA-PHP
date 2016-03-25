<?php 

include "../../config/datos.php"; 
?>

	<?php 
		$frecuencia = mysql_query("SELECT cantidad, frecuencia FROM tratamientos_aprobados WHERE paqueteaprob_id = '11' GROUP BY frecuencia ORDER BY frecuencia DESC LIMIT 1");
 
     		$frecu = mysql_fetch_assoc($frecuencia); 


     		echo "Es string: ".is_numeric($frecu['frecuencia']);
     		echo "<br>";
     		$frec = $frecu['frecuencia'];
     		echo "es string 2: ".is_numeric($frec);
     		echo "<br>";
     		echo "Es string para cantidad: ".is_numeric($frecu['cantidad']);
    ?>