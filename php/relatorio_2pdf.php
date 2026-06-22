
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	
	<title>Controle OS</title>
	<link rel="shortcut icon" href="favicon.ico" >
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
</head>
<body>

<?php
ob_clean();
//ob_start();

require_once '../php/funcoes_php.php';
require_once 'conexao.php';
require_once("../fpdf/fpdf.php");

$host = 'localhost';
$usuario = 'root';
$senha = '';
 $db = new PDO('mysql:host='.$host.';dbname='.$banco,$usuario,$senha);
 // Criar a variável global abaixo para mostrar o cabeçario em cada página.
 $GLOBALS = 0;
 class myPDF extends FPDF{
 	function header(){ 
 		$this->Image('../imagem_cliente/logomarca.jpg',176,1,25,15);
 		$this->SetFont('Arial','B',14);
 		$this->Cell(191,0,UTF8_DECODE('RELATÓRIO DE CADASTROS'),0,0,'C');
 		$this->Ln();
 		$this->SetFont('Times','',9);
 		//$this->Cell(276,10,'Strret Address of Employee Office',0,0,'C');
		$this->write(-3,'Clique para Voltar', '../html/relatorio.php');// Link para voltar
 		$this->Ln(7);
		// Adicionar o if abaixo para mostrar o cabeçario em cada página
		if($GLOBALS == 1){
			$this->headerTable();
		};
 	}
	 function total(){
		$data1=$_GET['data1'];
		$data2=$_GET['data2'];
		$to= $_GET['aparelho'];
		$orc=$_GET['orcamento'];
		$pe=$_GET['peca'];
		$per=$_GET['pecaRet'];
		$des=$_GET['desconto'];
		$m=$_GET['materialAuxiliar'];
		$trans=$_GET['transporte'];
		$lucro = ($orc - $pe -$des -$m -$trans);
		$this->SetFont('Arial','',10);
		$this->Cell(50,4,'Entre o dia '.date('d/m/Y',strtotime($data1))." e ".date('d/m/Y',strtotime($data2)),0,1,'L');
		$this->Cell(50,4,'Sairam '.$to.' aparelhos',0,1,'L');
		$this->Cell(50,4,utf8_decode('Total de Orçamento R$ ').number_format($orc,2,',','.'),0,1,'L');
		$this->Cell(50,4,utf8_decode('Total de Peças R$ ').number_format($pe,2,',','.'),0,1,'L');
		$this->Cell(50,4,utf8_decode('Total de Peças Ret. R$ ').number_format($per,2,',','.'),0,1,'L');
		$this->Cell(50,4,utf8_decode('Total de Desconto Ret. R$ ').number_format($des,2,',','.'),0,1,'L');
		$this->Cell(50,4,utf8_decode('Total de Mat. Aux. Ret. R$ ').number_format($m,2,',','.'),0,1,'L');
		$this->Cell(50,4,utf8_decode('Total de Transporte Ret. R$ ').number_format($trans,2,',','.'),0,1,'L');
		$this->Cell(50,4,utf8_decode('Total de Lucro Ret. R$ ').number_format($lucro,2,',','.'),0,0,'L');
		$this->Ln(5);
	}
 	function footer(){
 		$this->SetY(-15);
 		$this->SetFont('Arial','',8);
 		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		
 	}
 	function headerTable(){
		$this->SetFillColor(150,50,50);
		$this->SetTextColor(255,255,255);
 		$this->SetFont('Arial','B',9);
 		$this->Cell(12,7,'O.S.',1,0,'C',true);
		$this->Cell(12,7,utf8_decode('Orç.'),1,0,'C',true);
		$this->Cell(12,7,utf8_decode('Peça'),1,0,'C',true);
		$this->Cell(12,7,utf8_decode('P. Ret.'),1,0,'C',true);
		$this->Cell(12,7,utf8_decode('Desc.'),1,0,'C',true);
		$this->Cell(12,7,utf8_decode('M. Aux.'),1,0,'C',true);
		$this->Cell(12,7,utf8_decode('Transp.'),1,0,'C',true);
		$this->Cell(12,7,'Lucro',1,0,'C',true);
 		$this->Cell(50,7,'Nome',1,0,'C',true);
 		$this->Cell(22,7,'Entrada',1,0,'C',true);
		$this->Cell(22,7,utf8_decode('Saída'),1,0,'C',true);
		$this->Ln();
 	}
	function viewTable($db){
		$data1=$_GET['data1'];
		$data2=$_GET['data2'];
		$orc=$_GET['orcamento'];
		$pe=$_GET['peca'];
		$per=$_GET['pecaRet'];
		$des=$_GET['desconto'];
		$m=$_GET['materialAuxiliar'];
		$trans=$_GET['transporte'];
		$lucro = ($orc - $pe -$des -$m -$trans);
		$this->SetFont('Times','',9);
		$this->SetTextColor(0,0,0);
		$stmt = $db->query("SELECT * FROM cliente  WHERE excluiu='' AND dataSaida BETWEEN '$data1' AND '$data2' AND estado='APARELHO SAIU' ORDER BY $data1 ASC");
		$this->SetFillColor(235,236,255);
		$fill=false;
		while($data = $stmt->fetch(PDO::FETCH_OBJ)){
			$this->Cell(12,7,$data->ordemServico,1,0,'C',$fill);
			$this->Cell(12,7,' '.$data->orcamento,1,0,'L',$fill);
			$this->Cell(12,7,' '.$data->valorPeca,1,0,'L',$fill);
			$this->Cell(12,7,' '.$data->pecaRet1,1,0,'L',$fill);
			$this->Cell(12,7,' '.$data->desconto,1,0,'L',$fill);
			$this->Cell(12,7,' '.$data->materialAuxiliar,1,0,'L',$fill);
			$this->Cell(12,7,' '.$data->transporte,1,0,'L',$fill);
			$this->Cell(12,7,' '.number_format(($data->orcamento - $data->valorPeca - $data->desconto),2,',','.'),1,0,'L',$fill);
			$this->Cell(50,7,' '.utf8_decode(resumo($data->nome,20)),1,0,'L',$fill);
			$this->Cell(22,7,' '.date('d/m/Y',strtotime($data->dataEntrada)),1,0,'L',$fill);
			$this->Cell(22,7,' '.date('d/m/Y',strtotime($data->dataPronto)),1,0,'L',$fill);
			$fill=!$fill;
			$this->Ln();
			// Adicionar a variavel global abaixo para mostrar o cabeçario em cada página
			$GLOBALS = 1;	
		};	
		$this->SetFont('Arial','',9);
		$this->SetFillColor(240,240,150);
		$this->Cell(12,7,'',1,0,'',true);
		$this->Cell(12,7,utf8_decode('Orç.'),1,0,'C',true);
		$this->Cell(12,7,utf8_decode('Peça.'),1,0,'C',true);
		$this->Cell(12,7,utf8_decode('P. Ret.'),1,0,'C',true);
		$this->Cell(12,7,'Desc.',1,0,'C',true);
		$this->Cell(12,7,'M. Aux.',1,0,'C',true);
		$this->Cell(12,7,'Transp.',1,0,'C',true);
		$this->Cell(12,7,'Lucro.',1,0,'C',true);
		$this->Cell(94,7,'',1,1,'',true);
		$this->Cell(12,7,'Totais',1,0,'C',true);
		$this->Cell(12,7,number_format($orc,2,',','.'),1,0,'C',true);
		$this->Cell(12,7,number_format($pe,2,',','.'),1,0,'C',true);
		$this->Cell(12,7,number_format($per,2,',','.'),1,0,'C',true);
		$this->Cell(12,7,number_format($des,2,',','.'),1,0,'C',true);
		$this->Cell(12,7,number_format($m,2,',','.'),1,0,'C',true);
		$this->Cell(12,7,number_format($trans,2,',','.'),1,0,'C',true);
		$this->Cell(12,7,number_format($lucro,2,',','.'),1,0,'C',true);
		$this->Cell(94,7,'',1,1,'',true);
	}	
 };
 $pdf = new myPDF();
 $pdf->AliasNbPages();
 $pdf->AddPage('P','A4',0);//L para paisagem ou P para retrato
 $pdf->total();
 $pdf->headerTable();
 $pdf->viewTable($db);
 $pdf->Output();
 ?>
 </body>
</html>