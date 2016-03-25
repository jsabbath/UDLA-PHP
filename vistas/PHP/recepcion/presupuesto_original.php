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
			$sql_lista = mysql_query("SELECT * FROM lista_tratamientos WHERE nombre = '{$fila['nombre']}' LIMIT 1 ");
			$trat = mysql_fetch_assoc($sql_lista);

			$this->Cell(18,5,$fila['cantidad'],1,0,'C');
			$this->CellFitSpace(90,5,$fila['nombre'],1,0,'L');
			$this->Cell(25,5,number_format($trat['precio']). 'bs.f',1,0,'C');
			$unitario = $fila['cantidad'] * $trat['precio'] ;
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
			if ($total > 15000 AND $total < 40000) {
				
				$desc = $total * 0.05;
				$total_pagar = $total - $desc;

				$this->Cell(18,5,'' ,1,0,'C');
				$this->Cell(90,5, '',1,0,'R');
				$this->Cell(25,5, '5%:',1,0,'R');
				$this->Cell(25,5,number_format($desc). ' Bs.',1,0,'C');
				$this->Cell(18,5,'',1,0,'C');
				$this->Ln();
			}
			else if ($total > 40000) {
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
				$this->Cell(90,6, number_format($cuotas). ' Bs',1,0,'C');
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
			$this->Cell(90,6, $regalo,1,0,'C');
			$this->Ln();
	}

	//***** Aquí comienza código para ajustar texto *************
	    //***********************************************************
	    function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)
	    {
	        //Get string width
	        $str_width=$this->GetStringWidth($txt);
	 
	        //Calculate ratio to fit cell
	        if($w==0)
	            $w = $this->w-$this->rMargin-$this->x;
	        $ratio = ($w-$this->cMargin*2)/$str_width;
	 
	        $fit = ($ratio < 1 || ($ratio > 1 && $force));
	        if ($fit)
	        {
	            if ($scale)
	            {
	                //Calculate horizontal scaling
	                $horiz_scale=$ratio*100.0;
	                //Set horizontal scaling
	                $this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));
	            }
	            else
	            {
	                //Calculate character spacing in points
	                $char_space=($w-$this->cMargin*2-$str_width)/max($this->MBGetStringLength($txt)-1,1)*$this->k;
	                //Set character spacing
	                $this->_out(sprintf('BT %.2F Tc ET',$char_space));
	            }
	            //Override user alignment (since text will fill up cell)
	            $align='';
	        }
	 
	        //Pass on to Cell method
	        $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);
	 
	        //Reset character spacing/horizontal scaling
	        if ($fit)
	            $this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');
	    }
	 
	    function CellFitSpace($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
	    {
	        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,false);
	    }
	 
	    //Patch to also work with CJK double-byte text
	    function MBGetStringLength($s)
	    {
	        if($this->CurrentFont['type']=='Type0')
	        {
	            $len = 0;
	            $nbbytes = strlen($s);
	            for ($i = 0; $i < $nbbytes; $i++)
	            {
	                if (ord($s[$i])<128)
	                    $len++;
	                else
	                {
	                    $len++;
	                    $i++;
	                }
	            }
	            return $len;
	        }
	        else
	            return strlen($s);
	    }
	//************** Fin del código para ajustar texto *****************
	//******************************************************************
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

$sql = mysql_query("SELECT * FROM tratamientos WHERE paquete_id = '{$paq}'");
$paq_sql = mysql_query("SELECT id, regalo FROM paquetes WHERE id = '{$paq}' LIMIT 1 ");
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
$pdf->Ln(5);
$pdf->Ln(5);
$pdf->Cell(0,5,'___________________________', 0, 1, 'C');
$pdf->SetFont('Times','B',12);
$pdf->Cell(0,5,'DRA. LETICIA ACOSTA', 0, 1, 'C');
$pdf->SetFont('Times','',8);
$pdf->Cell(0,5,'ESPECIALISTA EN DERMATOLOGIA', 0, 1, 'C');




$pdf->Output('presupuesto', 'I');


?>