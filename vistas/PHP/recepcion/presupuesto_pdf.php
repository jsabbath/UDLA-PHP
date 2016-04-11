<?php 
include("../../config/datos.php");
$paq = $_GET['paq'];
$pac = $_GET['pac'];
$name_pac = mysql_query("SELECT nombre_completo FROM pacientes WHERE id = '{$pac}' LIMIT 1 ");
if (mysql_num_rows($name_pac) == 1) {
	$paciente = mysql_fetch_assoc($name_pac);
}
require('../fpdf.php');

class PDF extends FPDF {

	function Header()
	{
		$this->Image('../../../img/logo_udla.jpg',20,16,28);

      	$this->SetFont('Times','I',12);

      	$this->Cell(0,5,'Unidad Dermatologica Dra Leticia Acosta',0,1, 'C');
      	$this->Cell(0,5,'Rif: V-09655136-0',0,1, 'C');
      	$this->Cell(0,5,'Carrerra 6 con Calle 2',0,1, 'C');
      	$this->Cell(0,5,'Casco central de Lecherias, Estado Anzoategui',0,1, 'C');
      	$this->Cell(0,5,'0281-2873352 / 0281-9351620',0,1, 'C');
      	$this->Ln();
	}

	function Footer()
	{
		$this->SetY(-10);

		$this->SetFont('Times','I',8);

		$this->Cell(0,10,'PRESUPUESTO VALIDO POR 10 DIAS',0,0,'C');
	}

	function tablaProcedimientos($sql, $paq_sql)
	{
		$this->SetFont('Arial','',11);
		$this->Cell(18,7,'Cantidad',1,0, 'C');
		$this->Cell(90,7,'Procedimientos',1,0, 'C');
		$this->Cell(25,7,'Monto',1,0, 'C');
		$this->Cell(25,7,'Monto Total',1,0, 'C');
		$this->Ln();

		$total = 0;
		$sessiones = 0;
		$cant = 0;
		$this->SetFont('Arial','',10);
		while ($fila = mysql_fetch_assoc($sql)) {
		
			$this->Cell(18,5,$fila['cantidad'],1,0,'C');
			$this->Cell(90,5,$fila['nombre'],1,0,'L');
			$this->Cell(25,5,number_format($fila['precio']). ' Bs.',1,0,'C');
			$unitario = $fila['cantidad'] * $fila['precio'];
			$this->Cell(25,5,number_format($unitario). ' Bs.',1,1,'C');
			$total = $total + $unitario;

			$sessiones = $sessiones + $fila['cantidad'];
			$cant++;
		}

			$this->Cell(18,5,'' ,1,0,'C');
			$this->Cell(90,5, '',1,0,'R');
			$this->Cell(25,5,' ',1,0,'C');
			$this->Cell(25,5,'',1,0,'C');
			$this->Ln();

			$this->Cell(18,5,'' ,1,0,'C');
			$this->Cell(90,5, '',1,0,'R');
			$this->Cell(25,5, 'Total a pagar:',1,0,'R');
			$this->Cell(25,5,number_format($total). ' Bs.',1,0,'C');
			$this->Cell(18,5,'Contado',1,0,'C');
			$this->Ln();

			$paq_dato = mysql_fetch_assoc($paq_sql);
			if ($paq_dato['descuento'] == "5%") {
				
				$desc = $total * 0.05;
				$total_pagar = $total - $desc;

				$this->Cell(18,5,'' ,1,0,'C');
				$this->Cell(90,5, '',1,0,'R');
				$this->Cell(25,5, '5%:',1,0,'R');
				$this->Cell(25,5,number_format($desc). ' Bs.',1,0,'C');
				$this->Cell(18,5,'',1,0,'C');
				$this->Ln();
			}
			else if ($paq_dato['descuento'] == "10%") {
				$desc = $total * 0.10;
				$total_pagar = $total - $desc;

				$this->Cell(18,5,'' ,1,0,'C');
				$this->Cell(90,5, '',1,0,'R');
				$this->Cell(25,5, '10%:',1,0,'R');
				$this->Cell(25,5,number_format($desc). ' Bs.',1,0,'C');
				$this->Cell(18,5,'',1,0,'C');
				$this->Ln();
			}
			else
			{
				$total_pagar = $total;
			}

			$this->Cell(18,5,'' ,1,0,'C');
			$this->Cell(90,5, '',1,0,'R');
			$this->Cell(25,5, 'Total a Pagar:',1,0,'R');
			$this->Cell(25,5,number_format($total_pagar). ' Bs.',1,0,'C');
			$this->Cell(18,5,number_format($total_pagar). ' Bs.',1,0,'C');
			$this->Ln();
			$this->Ln();
			$this->Ln();

			$promedio = $sessiones / $cant;
			$inicial = $total_pagar * 0.65;

			$this->SetFont('Arial','B',11);
			$this->Cell(18,7,'',0,0, 'C');
			$this->Cell(90,7,'Forma de Pago a Credito',1,0, 'C');
			$this->Ln();

			$this->SetFont('Arial','B',10);
			$this->Cell(18,6,'Inicial' ,1,0,'C');
			$this->Cell(90,6,number_format($inicial). ' Bs',1,0,'C');
			$this->Ln();

			if ($promedio >= 3) {
				$cuotas = ($total_pagar - $inicial) / 3 ;
				$this->Cell(18,6,'3 Cuotas' ,1,0,'C');
				$this->Cell(90,6,number_format($cuotas). ' Bs',1,0,'C');
				$this->Ln();
			}
			else
			{
				$cuotas = ($total_pagar - $inicial) / 2 ;
				$this->Cell(18,6,'2 Cuotas' ,1,0,'C');
				$this->Cell(90,6, number_format($cuotas). ' Bs',1,0,'C');
				$this->Ln();
			}
			if($paq_dato['regalo'] != 0)
			{ 
				$regalo = $paq_dato['regalo'];
			}
			else 
			{
				$regalo = " ";
			}

			$this->Cell(18,6,'Obsequio' ,1,0,'C');
			$this->Cell(90,6, $regalo ,1,0,'C');
			$this->Ln();
	}
}

$pdf= new PDF('P', 'mm', 'Letter');
$pdf->SetMargins(20, 18);
$pdf->AddPage();
$pdf->SetFont('Times','B',12);
$pdf->Ln();
$pdf->Cell(0,5,'Fecha: '.date('d-m-Y'), 0, 1, 'R');
$pdf->Cell(0,5,'NOMBRE PACIENTE: '.strtoupper($paciente['nombre_completo']), 0, 1, 'L');
$pdf->Ln();
$pdf->SetFont('Times','B',16);
$pdf->Cell(0,5,'PRESUPUESTO', 0, 1, 'C');
$pdf->Ln();
$pdf->Ln();

$sql = mysql_query("SELECT * FROM tratamientos_aprobados WHERE paqueteaprob_id = '{$paq}'");
$paq_sql = mysql_query("SELECT id, descuento, regalo FROM paquete_aprobado WHERE id = '{$paq}' LIMIT 1 ");

$pdf->AliasNbPages();
$pdf->Ln();
//Primera página
$pdf->SetY(65);
//$pdf->AddPage();
$pdf->Ln();
$pdf->Ln();
$pdf->tablaProcedimientos($sql, $paq_sql);

$pdf->Ln(5);
$pdf->Ln(5);
$pdf->Ln(5);
$pdf->Cell(0,5,'___________________________', 0, 1, 'C');
$pdf->SetFont('Times','B',12);
$pdf->Cell(0,5,'DRA. LETICIA ACOSTA', 0, 1, 'C');
$pdf->SetFont('Times','',8);
$pdf->Cell(0,5,'ESPECIALISTA EN DERMATOLOGIA', 0, 1, 'C');

$pdf->Ln(5);
$pdf->Ln(5);
$pdf->SetFont('Times','',10);
$pdf->Cell(0,5,'PRESUPUESTO VALIDO POR 15 DIAS', 0, 1, 'L');
$pdf->Ln(5);
$pdf->Cell(0,5,'ESTE TRATAMIENTO TIENE UNA DURACIO DE _______________________', 0, 1, 'L');
$pdf->Cell(0,5,'CON UNA FRECUENCIA DE _______________________', 0, 1, 'L');
$pdf->Cell(0,5,'Y UN MES DE PRORROGA PARA SU TOTAL REALIZACION', 0, 1, 'L');
$pdf->Cell(0,5,'EL TRATAMIENTO QUE NO SE HAYA RREALIZADO EN DICHO LAPSO DE TIEMPO', 0, 1, 'L');
$pdf->Cell(0,5,'ESTARA SUJETO A MODIFICACION EN EL PRECIO SI FUERA NECESARIO', 0, 1, 'L');


$pdf->Output('presupuesto', 'I');


?>