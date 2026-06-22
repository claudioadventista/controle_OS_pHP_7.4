<?php
require_once 'conexao.php';
$data1=$_GET['data1'];
$data2=$_GET['data2'];
$nulo = '';

$consulta = $conexao->prepare("SELECT * FROM cliente WHERE excluiu = ? AND dataSaida BETWEEN(?) AND (?) ORDER BY $data1 ASC");  
$consulta->execute([$nulo, $data1, $data2]);
$sql = $consulta->fetch();
 

require_once("../fpdf/fpdf.php");
$pdf= new FPDF("P","pt","A4");
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('arial','',12);
$pdf->write(1,'Clique aqui para voltar', '../html/relatorio.php');// Link para voltar
$pdf->Ln(8);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(520,10,utf8_decode('Relatório de Cadastros'),0,0,"C");
$pdf->Ln(15);
$width_cell=array(50,330,80,60,40);
$pdf->SetFillColor(100,100,100);
$pdf->SetTextColor(255,255,255);
$pdf->Cell($width_cell[0],20,'O.S',1,0,'C',true);
$pdf->Cell($width_cell[1],20,'NOME',1,0,'C',true);
$pdf->Cell($width_cell[2],20,'TEL.',1,0,'C',true);
$pdf->Cell($width_cell[3],20,utf8_decode('ORÇ.'),1,1,'C',true);
$pdf->SetFont('Arial','I',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(235,236,236);
$fill=false;

while($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
    $pdf->Cell($width_cell[0],20,$row['ordemServico'],1,0,'C',$fill);
    $pdf->Cell($width_cell[1],20,utf8_decode($row['nome']),1,0,'',$fill);
    $pdf->Cell($width_cell[2],20,$row['telefone'],1,0,'C',$fill);
    $pdf->Cell($width_cell[3],20,$row['orcamento'],1,1,'C',$fill);
    $fill=!$fill;
};
$pdf->Output();
?>