<?php
require_once 'conexao.php';
$codigo = $_GET['busca'];

$consulta = $conexao->prepare("SELECT * FROM cliente WHERE codigo = ? ");
$consulta->execute([$codigo]);
$resultado = $consulta->fetch();

$ordemServico = "$resultado[ordemServico]";
$nome = utf8_decode("$resultado[nome]");
$telefone= "$resultado[telefone]";
$telefone2= "$resultado[telefone2]";
$endereco = utf8_decode("$resultado[endereco]");
$dataEntrada = "$resultado[dataEntrada]";
$aparelho = "$resultado[aparelho]";
$marca = "$resultado[marca]";
$modelo = "$resultado[modelo]";
$numeroSerie = "$resultado[numeroSerie]";
$defeitoReclamado = utf8_decode("$resultado[defeitoReclamado]");
$acessorio = utf8_decode("$resultado[acessorio]");
$observacao = utf8_decode("$resultado[observacao]");
$estado = "$resultado[estado]";
$material = utf8_decode("$resultado[material]"); 
$orcamento = "$resultado[orcamento]";
$dataPronto = "$resultado[dataPronto]"; 
$dataSaida = "$resultado[dataSaida]"; 
$valorPeca = "$resultado[valorPeca]"; 
$novaOS1 = "$resultado[novaOS1]"; 
$dataRetorno1 = "$resultado[dataRetorno1]"; 
$defRet1 = utf8_decode("$resultado[defRet1]"); 
$acessRet1 = utf8_decode("$resultado[acessRet1]"); 
$obsRet1 = utf8_decode("$resultado[obsRet1]");
$matRet1 = utf8_decode("$resultado[matRet1]");
$pecaRet1 = "$resultado[pecaRet1]";
$estadoRetorno1 = "$resultado[estadoRetorno1]";
$dtProntoRet1 = "$resultado[dtProntoRet1]";
$saidaRetorno1 = "$resultado[saidaRetorno1]";  
$novaOS2 = "$resultado[novaOS2]"; 
$dataRetorno2 = "$resultado[dataRetorno2]"; 
$defRet2 = utf8_decode("$resultado[defRet2]"); 
$acessRet2 = utf8_decode("$resultado[acessRet2]"); 
$obsRet2 = utf8_decode("$resultado[obsRet2]");
$matRet2 = utf8_decode("$resultado[matRet2]");
$pecaRet2 = "$resultado[pecaRet2]";
$estadoRetorno2 = "$resultado[estadoRetorno2]";
$dtProntoRet2 = "$resultado[dtProntoRet2]";
$saidaRetorno2 = "$resultado[saidaRetorno2]";  
$novaOS3 = "$resultado[novaOS3]"; 
$dataRetorno3 = "$resultado[dataRetorno3]"; 
$defRet3 = utf8_decode("$resultado[defRet3]"); 
$acessRet3 = utf8_decode("$resultado[acessRet3]"); 
$obsRet3 = utf8_decode("$resultado[obsRet3]");
$matRet3 = utf8_decode("$resultado[matRet3]");
$pecaRet3 = "$resultado[pecaRet3]";
$estadoRetorno3 = "$resultado[estadoRetorno3]";
$dtProntoRet3 = "$resultado[dtProntoRet3]";
$saidaRetorno3 = "$resultado[saidaRetorno3]";      
$cep = "99999-999";
require_once("../fpdf/fpdf.php");
$pdf= new FPDF("P","pt","A4");
$pdf->AddPage();
$pdf->SetFont('arial','',8);
$pdf->write(1,'Clique aqui para voltar', '../html/home.php');// Link para voltar
$pdf->SetFont('arial','B',18);
$pdf->Cell(0,30,"Ficha",0,1,'C');
$pdf->Cell(0,2,"","B",1,'C');
$pdf->Ln(8);
//o.s.
$pdf->SetFont('arial','B',10);
$pdf->Cell(110,8,"O.S.:",0,0,'L');
$pdf->setFont('arial','',10);
$pdf->Cell(0,8,$ordemServico,0,1,'L');
//nome
$pdf->SetFont('arial','B',10);
$pdf->Cell(110,15,"Nome:",0,0,'L');
$pdf->setFont('arial','',10);
$pdf->Cell(0,15,$nome,0,1,'L');
//Telefone
if($telefone){
$pdf->SetFont('arial','B',10);
$pdf->Cell(110,15,"Telefone:",0,0,'L');
$pdf->setFont('arial','',10);
$pdf->Cell(70,15,$telefone,0,1,'L');
}
if($telefone2){
$pdf->SetFont('arial','B',10);
$pdf->Cell(110,15,"Telefone 2:",0,0,'L');
$pdf->setFont('arial','',10);
$pdf->Cell(70,15,$telefone2,0,1,'L');
}
//Endereço
if($endereco){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',10);
$pdf->Cell(110,15,utf8_decode("Endereço:"),0,0,'L');
$pdf->setFont('arial','',10);
$pdf->Cell(70,15,$endereco,0,1,'L');
 } 
if($dataEntrada){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',10);
$pdf->Cell(110,15,"Data de entrada:",0,0,'L');
$pdf->setFont('arial','',10);
$pdf->Cell(70,15,$dataEntrada,0,1,'L');
 }
$pdf->SetFont('arial','B',10);
$pdf->Cell(110,15,"Aparelho:",0,0,'L');
$pdf->setFont('arial','',10);
$pdf->Cell(70,15,$aparelho,0,1,'L');
$pdf->SetFont('arial','B',10);
$pdf->Cell(110,15,"Marca:",0,0,'L');
$pdf->setFont('arial','',10);
$pdf->Cell(70,15,$marca,0,1,'L');
if($modelo){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',10);
$pdf->Cell(110,15,"Modelo:",0,0,'L');
$pdf->setFont('arial','',10);
$pdf->Cell(70,15,$modelo,0,1,'L');
 }
if($numeroSerie){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',10);
$pdf->Cell(110,15,utf8_decode("Número de série:"),0,0,'L');
$pdf->setFont('arial','',10);
$pdf->Cell(70,15,$numeroSerie,0,1,'L');
 }
if($defeitoReclamado){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',10);
$pdf->Cell(110,15,"Defeito reclamado:",0,0,'L');
$pdf->setFont('arial','',10);
$pdf->Cell(70,15,$defeitoReclamado,0,1,'L');
 }
if($acessorio){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',10);
$pdf->Cell(110,15,utf8_decode("Acessório:"),0,0,'L');
$pdf->setFont('arial','',10);
$pdf->Cell(70,15,$acessorio,0,1,'L');
 }
if($observacao){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',10);
$pdf->Cell(110,15,utf8_decode("Observação:"),0,0,'L');
$pdf->setFont('arial','',10);
$pdf->Cell(70,15,$observacao,0,1,'L');
 }
if($estado){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',10);
$pdf->Cell(110,15,"Estado:",0,0,'L');
$pdf->setFont('arial','',10);
$pdf->Cell(70,15,$estado,0,1,'L');
 }
//material 
if($material){
$pdf->SetFont('arial','B',10);
$pdf->Cell(110,15,"Material:",0,0,'L');
$pdf->setFont('arial','',10);
$pdf->Cell(70,15,$material,0,1,'L');
}
if($orcamento){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',10);
$pdf->Cell(110,15,utf8_decode("Orçamento:"),0,0,'L');
$pdf->setFont('arial','',10);
$pdf->Cell(70,15,$orcamento,0,1,'L');
 }
//Endereço
if(($dataPronto)!=0000-00-00){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',12);
$pdf->Cell(110,20,"Data de pronto:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$dataPronto,0,1,'L');
 }
if(($dataSaida)!=0000-00-00){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',12);
$pdf->Cell(110,20,utf8_decode("Data de saída:"),0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$dataSaida,0,1,'L');
 }
if($valorPeca){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',12);
$pdf->Cell(110,20,utf8_decode("Valor da peça:"),0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$valorPeca,0,1,'L');
 }
// ------------------------- retorno 1
if(($dataRetorno1)!=0000-00-00){
$pdf->Cell(0,5,"","B",1,'C');
$pdf->Ln(8);
if($novaOS1){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,"Nova OS retorno 1:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$novaOS1,0,1,'L');
 }
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,"Data retorno 1:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$dataRetorno1,0,1,'L');
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,"Defeito retorno 1:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$defRet1,0,1,'L');
if($acessRet1){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,utf8_decode("Acessório retorno 1:"),0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$acessRet1,0,1,'L');
 }
 if($obsRet1){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,utf8_decode("Obs. retorno 1:"),0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$obsRet1,0,1,'L');
 } 
 if($matRet1){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,"Material retorno 1:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$matRet1,0,1,'L');
 } 
 if($pecaRet1){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,utf8_decode("Peça retorno 1:"),0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$pecaRet1,0,1,'L');
 }
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,"Estado retono 1:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$estadoRetorno1,0,1,'L');
 if(($dtProntoRet1)!=0000-00-00){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,"Dt pronto retorno 1:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$dtProntoRet1,0,1,'L');
 }
 if(($saidaRetorno1)!=0000-00-00){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,utf8_decode("Dt saída retorno 1:"),0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$saidaRetorno1,0,1,'L');
 }
 }
/// ------------------------------- retorno 2 
 if(($dataRetorno2)!=0000-00-00){
$pdf->Cell(0,5,"","B",1,'C');
$pdf->Ln(8);
if($novaOS2){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,"Nova OS retorno 2:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$novaOS2,0,1,'L');
 }
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,"Data retorno 2:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$dataRetorno1,0,1,'L');
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,"Defeito retorno 2:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$defRet2,0,1,'L');
if($acessRet2){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,utf8_decode("Acessório retorno 2:"),0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$acessRet2,0,1,'L');
 } 
 if($obsRet2){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,utf8_decode("Obs. retorno 2:"),0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$obsRet2,0,1,'L');
 }
 if($matRet2){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,"Material retorno 2:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$matRet2,0,1,'L');
 } 
 if($pecaRet2){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,utf8_decode("Peça retorno 2:"),0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$pecaRet2,0,1,'L');
 }
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,"Estado retono 2:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$estadoRetorno2,0,1,'L');
 if(($dtProntoRet2)!=0000-00-00){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,"Dt pronto retorno 2:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$dtProntoRet2,0,1,'L');
 } 
 if(($saidaRetorno2)!=0000-00-00){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,utf8_decode("Dt saída retorno 2:"),0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$saidaRetorno2,0,1,'L');
 }
 }
//// ------------------------------ retorno 3
if(($dataRetorno3)!=0000-00-00){
$pdf->Cell(0,5,"","B",1,'C');
$pdf->Ln(8);
if($novaOS3){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,"Nova OS retorno 3:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$novaOS3,0,1,'L');
 }
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,"Data retorno 3:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$dataRetorno3,0,1,'L');
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,"Defeito retorno 3:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$defRet3,0,1,'L'); 
if($acessRet3){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,utf8_decode("Acessório retorno 3:"),0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$acessRet3,0,1,'L');
 }
 if($obsRet3){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,utf8_decode("Obs. retorno 3:"),0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$obsRet3,0,1,'L');
 } 
 if($matRet3){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,"Material retorno 3:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$matRet3,0,1,'L');
 }
 if($pecaRet3){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,utf8_decode("Peça retorno 3:"),0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$pecaRet3,0,1,'L');
 } 
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,"Estado retono 3:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$estadoRetorno3,0,1,'L'); 
 if(($dtProntoRet3)!=0000-00-00){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,"Dt pronto retorno 3:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$dtProntoRet3,0,1,'L');
 }
 if(($saidaRetorno3)!=0000-00-00){// Se houver algo registrado no campo, vai ser mostrado, caso contrário, não. 
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,utf8_decode("Dt saída retorno 3:"),0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$saidaRetorno3,0,1,'L');
 }
 }
$pdf->SetFont('arial','',12);
$pdf->write(30,'Clique aqui para voltar', '../html/home.php');// Link para voltar
$pdf->Output();
?>