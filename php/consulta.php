<?php
@session_start();//esse comando permite manter as configurações da sessão loggin em outras 
require_once 'conexao.php';
if(empty($_SESSION['logado'])) {
  unset ($_SESSION['logado']);
  header('Location:../html/login.php');	  
exit;
}
$nulo = '';
$idConfig = 1;
$sql_config = $conexao->prepare("SELECT * FROM config WHERE codigo = ? ");
$sql_config->execute([$idConfig]);
$resultado = $sql_config->fetch();

$id = 1;
$stmt = $conexao->prepare("SELECT codigo, semCronometro, mensagem, ordenacao, pagina, letra, ordem, tema FROM funcionario WHERE codigo = ? ");
$stmt->execute([$id]);
$result_func = $stmt->fetch();


//********** paginacao
$ordenacao = $result_func['ordenacao'];
$quantidade = $result_func['pagina'];
$letra = $result_func['letra']; 
$ordem = $result_func['ordem'];
$letra = trim($letra);   
// MANTEM SEMPRE A ORDEM DE A PARA Z SE HOUVER ALGO ERRADO NA COLUNA ordem
if(($result_func['ordem']<>"ASC") AND ($result_func['ordem']<>"DESC")){
	$ordem="ASC";
}
if($resultado['maiuscula']=="sim"){
	$_SESSION['maiuscula']="sim";
}else{
	$_SESSION['maiuscula']="nao";
}
if($result_func['tema']=="claro"){
	$_SESSION['tema']="claro";
}else{
	$_SESSION['tema']="escuro";
}
// Código responsavel para validar o campo Página da paginação.
if(empty($_REQUEST['pagina'])){
	$_REQUEST['pagina']=1;
}
// ESSE BLOCO É RESPONSÁVEL PELA PAGINAÇÃO
$pagina = (isset($_REQUEST['pagina'])) ? (int)$_REQUEST['pagina'] : 1;
$inicio = ($quantidade * $pagina) - $quantidade;


// * Controle para realizar busca.
if(($letra<>"LISTA GERAL")AND($letra<>"PARA ORCAMENTO")AND($letra<>"AGUARDANDO")AND($letra<>"SERVICO PRONTO")AND($letra<>"ORCAMENTO PRONTO")AND($letra<>"APARELHO SAIU")AND($letra<>"DEVOLVEU")AND($letra<>"RETORNOU")AND($letra<>"COMPROU")AND($letra<>"DOOU")AND($letra<>"VENDEU")AND($letra<>"ABANDONOU")AND($letra<>"SUMIU")AND($letra<>"ENTREGOU ERRADO")AND($letra<>"ROUBADO")AND($letra<>"PRAZO")AND($letra<>"DICA")AND($letra<>"FOTOS")AND($letra<>"LIGOU"))
 {
	// mostra a contagem da busca	 
	//$sqlTotalBusca = $conexao->execute("SELECT codigo FROM cliente WHERE (nome LIKE '%$letra%' OR telefone LIKE '%$letra%' OR telefone2 LIKE '%$letra%' OR cpf LIKE '%$letra%' OR novaOS1 LIKE '%$letra%' OR novaOS2 LIKE '%$letra%' OR novaOS3 LIKE '%$letra%' OR aparelho LIKE '%$letra%' OR numeroSerie LIKE '%$letra%' OR ordemServico LIKE '%$letra%' OR marca LIKE '%$letra%' OR estado LIKE '%$letra%' OR defeitoReclamado LIKE '%$letra%' OR observacao LIKE '%$letra%' OR modelo LIKE '%$letra%' OR dataEntrada LIKE '%$letra%' OR barra_cliente LIKE '%$letra%' OR chassi LIKE '%$letra%') ");  
	$termo = "%$letra%";
	$sqlTotalBusca = $conexao->prepare("SELECT codigo FROM cliente WHERE (nome LIKE ? OR telefone LIKE ? OR telefone2 LIKE ? OR cpf LIKE ? OR novaOS1 LIKE ? OR novaOS2 LIKE ? OR novaOS3 LIKE ? OR aparelho LIKE ? OR numeroSerie LIKE ? OR ordemServico LIKE ? OR marca LIKE ? OR estado LIKE ? OR defeitoReclamado LIKE ? OR observacao LIKE ? OR modelo LIKE ? OR dataEntrada LIKE ? OR barra_cliente LIKE ? OR chassi LIKE ?) ");  
	$sqlTotalBusca->execute([$termo, $termo, $termo, $termo, $termo, $termo, $termo, $termo, $termo, $termo, $termo, $termo, $termo, $termo, $termo, $termo, $termo, $termo]);
	$numTotalListaBusca = $sqlTotalBusca->rowCount();
	$numerodepagina = ceil($numTotalListaBusca/$quantidade); 
	$controleBusca = 1;

	$geral = $conexao->prepare("SELECT codigo, ordemServico, nome, aparelho, marca, estado, dataRetorno1, dataRetorno2, dataRetorno3, foto1, foto2, foto3, estadoRetorno1, estadoRetorno2, estadoRetorno3, telefone_ligado1, excluiu FROM cliente WHERE (nome LIKE ? OR telefone LIKE ? OR telefone2 LIKE ? OR cpf LIKE ? OR novaOS1 LIKE ? OR novaOS2 LIKE ? OR novaOS3 LIKE ? OR aparelho LIKE ? OR numeroSerie LIKE ? OR ordemServico LIKE ? OR marca LIKE ? OR estado LIKE ? OR defeitoReclamado LIKE ? OR observacao LIKE ? OR modelo LIKE ? OR dataEntrada LIKE ? OR barra_cliente LIKE ? OR chassi LIKE ?) ORDER BY $ordenacao $ordem LIMIT $inicio, $quantidade ");          		
	$geral->execute([$termo, $termo, $termo, $termo, $termo, $termo, $termo, $termo, $termo, $termo, $termo, $termo, $termo, $termo, $termo, $termo, $termo, $termo]);
		
 }

// * Controle para o botão lista geral.	

$sqlTotalListaGeral = $conexao->prepare("SELECT codigo FROM cliente WHERE excluiu = ? ");
$sqlTotalListaGeral->execute([$nulo]);
$numTotalListaGeral = $sqlTotalListaGeral->rowCount();
$totalListaGeral = ceil($numTotalListaGeral/$quantidade);

if($letra=="LISTA GERAL"){
	$listaGeral = $conexao->prepare("SELECT codigo, ordemServico, nome, aparelho, marca, estado, dataRetorno1, dataRetorno2, dataRetorno3, estadoRetorno1, estadoRetorno2, estadoRetorno3, foto1, foto2, foto3, telefone_ligado1, excluiu FROM cliente WHERE excluiu = ? ORDER BY $ordenacao $ordem LIMIT $inicio, $quantidade ");
	$listaGeral->execute([$nulo]);
}

// para orcamento
$sqlTotalParaOrcamento = $conexao->prepare("SELECT  codigo FROM cliente WHERE estado = ? AND excluiu = ? ");
$sqlTotalParaOrcamento->execute(['PARA ORCAMENTO', $nulo]);
$numTotalParaOrcamento = $sqlTotalParaOrcamento->rowCount();
$totalParaOrcamento = ceil($numTotalParaOrcamento/$quantidade);

if($letra=="PARA ORCAMENTO"){
	$listaParaOrcamento = $conexao->prepare("SELECT codigo, ordemServico, nome, aparelho, marca, estado, dataRetorno1, dataRetorno2, dataRetorno3, estadoRetorno1, estadoRetorno2, estadoRetorno3, foto1, foto2, foto3, telefone_ligado1, excluiu FROM cliente WHERE estado = ? AND excluiu = ? ORDER BY $ordenacao $ordem LIMIT $inicio, $quantidade ");
	$listaParaOrcamento->execute(['PARA ORCAMENTO', $nulo]);
}

// orçamento pronto.
$sqlTotalOrcamentoPronto = $conexao->prepare("SELECT codigo FROM cliente WHERE estado = ? AND excluiu = ? ");
$sqlTotalOrcamentoPronto->execute(['ORCAMENTO PRONTO', $nulo]);
$numTotalOrcamentoPronto = $sqlTotalOrcamentoPronto->rowCount();
$totalOrcamentoPronto = ceil($numTotalOrcamentoPronto/$quantidade);
if($letra=="ORCAMENTO PRONTO"){
	$listaOrcamentoPronto = $conexao->prepare("SELECT codigo, ordemServico, nome, aparelho, marca, estado, dataRetorno1, dataRetorno2, dataRetorno3, estadoRetorno1, estadoRetorno2, estadoRetorno3, foto1, foto2, foto3, telefone_ligado1, excluiu FROM cliente WHERE estado = ? AND excluiu = ? ORDER BY $ordenacao $ordem LIMIT $inicio, $quantidade ");
	$listaOrcamentoPronto->execute(['ORCAMENTO PRONTO', $nulo]);
}

// aguardando.
$sqlTotalPendencia = $conexao->prepare("SELECT codigo FROM cliente WHERE estado = ? AND excluiu = ? ");
$sqlTotalPendencia->execute(['AGUARDANDO', $nulo]);
$numTotalPendencia = $sqlTotalPendencia->rowCount();
$totalPendencia = ceil($numTotalPendencia/$quantidade);
if($letra=="AGUARDANDO"){
	$listaPendencia = $conexao->prepare("SELECT codigo, ordemServico, nome, aparelho, marca, estado, dataRetorno1, dataRetorno2, dataRetorno3, estadoRetorno1, estadoRetorno2, estadoRetorno3, foto1, foto2, foto3, telefone_ligado1, excluiu FROM cliente WHERE estado = ? AND excluiu = ? ORDER BY $ordenacao $ordem LIMIT $inicio, $quantidade ");
	$listaPendencia->execute(['AGUARDANDO', $nulo]);
}

// devolveu.
$sqlTotalDevolveu = $conexao->prepare("SELECT codigo FROM cliente WHERE estado = ? AND excluiu = ? ");
$sqlTotalDevolveu->execute(['DEVOLVEU', $nulo]);
$numTotalDevolveu = $sqlTotalDevolveu->rowCount();
$totalDevolveu = ceil($numTotalDevolveu/$quantidade);
if($letra=="DEVOLVEU"){
	$listaDevolveu = $conexao->prepare("SELECT codigo, ordemServico, nome, aparelho, marca, estado, dataRetorno1, dataRetorno2, dataRetorno3, estadoRetorno1, estadoRetorno2, estadoRetorno3, foto1, foto2, foto3, telefone_ligado1, excluiu FROM cliente WHERE estado = ? AND excluiu = ? ORDER BY $ordenacao $ordem  LIMIT $inicio, $quantidade ");
	$listaDevolveu->execute(['DEVOLVEU', $nulo]);
}

// serviço pronto.
$sqlTotalServicoPronto = $conexao->prepare("SELECT codigo FROM cliente WHERE estado = ? AND excluiu = ? ");
$sqlTotalServicoPronto->execute(['SERVICO PRONTO', $nulo]);
$numTotalServicoPronto = $sqlTotalServicoPronto->rowCount();
$totalServicoPronto = ceil($numTotalServicoPronto/$quantidade);
if($letra=="SERVICO PRONTO"){
	$listaServicoPronto = $conexao->prepare("SELECT codigo, ordemServico, nome, aparelho, marca, estado, dataRetorno1, dataRetorno2, dataRetorno3, estadoRetorno1, estadoRetorno2, estadoRetorno3, foto1, foto2, foto3, telefone_ligado1, excluiu FROM cliente WHERE estado = ? AND excluiu = ? ORDER BY $ordenacao $ordem  LIMIT $inicio, $quantidade ");
	$listaServicoPronto->execute(['SERVICO PRONTO', $nulo]);
}

// aparelho saiu.
$sqlTotalAparelhoSaiu = $conexao->prepare("SELECT codigo FROM cliente WHERE estado = ? AND excluiu = ? AND dataRetorno1 = ? ");
$sqlTotalAparelhoSaiu->execute(['APARELHO SAIU',  $nulo, '0000-00-00']);
$numTotalAparelhoSaiu = $sqlTotalAparelhoSaiu->rowCount();
$totalAparelhoSaiu = ceil($numTotalAparelhoSaiu/$quantidade);
if($letra=="APARELHO SAIU"){
	$listaSaida = $conexao->prepare("SELECT codigo, ordemServico, nome, aparelho, marca, estado, dataRetorno1, dataRetorno2, dataRetorno3, estadoRetorno1, estadoRetorno2, estadoRetorno3, foto1, foto2, foto3, telefone_ligado1, excluiu FROM cliente WHERE estado = ? AND dataRetorno1 = ? AND excluiu = ? ORDER BY $ordenacao $ordem LIMIT $inicio, $quantidade ");
	$listaSaida->execute(['APARELHO SAIU', '0000-00-00', $nulo]);
}

// retornou
$sqlTotalRetornou = $conexao->prepare("SELECT codigo FROM cliente WHERE dataRetorno1 != ? AND excluiu = ? ");
$sqlTotalRetornou->execute(['0000-00-00', $nulo]);
$numTotalRetornou = $sqlTotalRetornou->rowCount();
$totalRetornou = ceil($numTotalRetornou/$quantidade);
if($letra=="RETORNOU"){
	$listaRetorno = $conexao->prepare("SELECT codigo, ordemServico, nome, aparelho, marca, estado, dataRetorno1, dataRetorno2, dataRetorno3, estadoRetorno1, estadoRetorno2, estadoRetorno3, foto1, foto2, foto3, telefone_ligado1,  excluiu FROM cliente WHERE dataRetorno1 != ? AND excluiu = ? ORDER BY $ordenacao $ordem LIMIT $inicio, $quantidade ");
	$listaRetorno->execute(['0000-00-00', $nulo]);
}

// doou
$sqlTotalDoou = $conexao->prepare("SELECT codigo FROM cliente WHERE estado = ? AND excluiu = ? ");
$sqlTotalDoou->execute(['DOOU', $nulo]);
$numTotalDoou = $sqlTotalDoou->rowCount();
$totalDoou = ceil($numTotalDoou/$quantidade);
if($letra=="DOOU"){
	$listaDoou = $conexao->prepare("SELECT codigo, ordemServico, nome, aparelho, marca, estado, dataRetorno1, dataRetorno2, dataRetorno3, estadoRetorno1, estadoRetorno2, estadoRetorno3, foto1, foto2, foto3, telefone_ligado1,  excluiu FROM cliente WHERE estado = ? AND excluiu = ? ORDER BY $ordenacao $ordem LIMIT $inicio, $quantidade ");
	$listaDoou->execute(['DOOU', $nulo]);
}

// comprou
$sqlTotalComprou = $conexao->prepare("SELECT codigo FROM cliente WHERE estado = ? AND excluiu = ?");
$sqlTotalComprou->execute(['COMPROU', $nulo]);
$numTotalComprou = $sqlTotalComprou->rowCount();
$totalComprou = ceil($numTotalComprou/$quantidade);
if($letra=="COMPROU"){
	$listaComprou = $conexao->prepare("SELECT codigo, ordemServico, nome, aparelho, marca, estado, dataRetorno1, dataRetorno2, dataRetorno3, estadoRetorno1, estadoRetorno2, estadoRetorno3, foto1, foto2, foto3, telefone_ligado1, excluiu FROM cliente WHERE estado = ? AND excluiu = ? ORDER BY $ordenacao $ordem LIMIT $inicio, $quantidade ");
	$listaComprou->execute(['COMPROU', $nulo]);
}

// vendeu
$sqlTotalVendeu = $conexao->prepare("SELECT codigo FROM cliente WHERE estado = ? AND excluiu = ? ");
$sqlTotalVendeu->execute(['VENDEU', $nulo]);
$numTotalVendeu = $sqlTotalVendeu->rowCount();
$totalVendeu = ceil($numTotalVendeu/$quantidade);
if($letra=="VENDEU"){
	$listaVendeu = $conexao->prepare("SELECT codigo, ordemServico, nome, aparelho, marca, estado, dataRetorno1, dataRetorno2, dataRetorno3, estadoRetorno1, estadoRetorno2, estadoRetorno3, foto1, foto2, foto3, telefone_ligado1, excluiu FROM cliente WHERE estado = ? AND excluiu = ? ORDER BY $ordenacao $ordem LIMIT $inicio, $quantidade ");
	$listaVendeu->execute(['VENDEU', $nulo]);
}

// abandonou
$sqlTotalAbandonou = $conexao->prepare("SELECT codigo FROM cliente WHERE estado = ? AND excluiu = ? ");
$sqlTotalAbandonou->execute(['ABANDONOU', $nulo]);
$numTotalAbandonou = $sqlTotalAbandonou->rowCount();
$totalAbandonou = ceil($numTotalAbandonou/$quantidade);
if($letra=="ABANDONOU"){
	$listaAbandonou = $conexao->prepare("SELECT codigo, ordemServico, nome, aparelho, marca, estado, dataRetorno1, dataRetorno2, dataRetorno3, estadoRetorno1, estadoRetorno2, estadoRetorno3, foto1, foto2, foto3, telefone_ligado1, excluiu FROM cliente WHERE estado = ? AND excluiu = ? ORDER BY $ordenacao $ordem LIMIT $inicio, $quantidade ");
	$listaAbandonou->execute(['ABANDONOU', $nulo]);
}

// sumiu
$sqlTotalSumiu = $conexao->prepare("SELECT codigo FROM cliente WHERE estado = ? AND excluiu = ? ");
$sqlTotalSumiu->execute(['SUMIU', $nulo]);
$numTotalSumiu = $sqlTotalSumiu->rowCount();
$totalSumiu = ceil($numTotalSumiu/$quantidade);
if($letra=="SUMIU"){
	$listaSumiu = $conexao->prepare("SELECT codigo, ordemServico, nome, aparelho, marca, estado, dataRetorno1, dataRetorno2, dataRetorno3, estadoRetorno1, estadoRetorno2, estadoRetorno3, foto1, foto2, foto3, telefone_ligado1, excluiu FROM cliente WHERE estado = ? AND excluiu = ? ORDER BY $ordenacao $ordem LIMIT $inicio, $quantidade ");
	$listaSumiu->execute(['SUMIU', $nulo]);
}

// entregou errado
$sqlTotalEntregouErrado = $conexao->prepare("SELECT codigo FROM cliente WHERE estado = ? AND excluiu = ? ");
$sqlTotalEntregouErrado->execute(['ENTREGOU ERRADO', $nulo]);
$numTotalEntregouErrado = $sqlTotalEntregouErrado->rowCount();
$totalEntregouErrado = ceil($numTotalEntregouErrado/$quantidade);
if($letra=="ENTREGOU ERRADO"){
	$listaEntregouErrado = $conexao->prepare("SELECT codigo, ordemServico, nome, aparelho, marca, estado, dataRetorno1, dataRetorno2, dataRetorno3, estadoRetorno1, estadoRetorno2, estadoRetorno3, foto1, foto2, foto3, telefone_ligado1, excluiu FROM cliente WHERE estado = ? AND excluiu = ? ORDER BY $ordenacao $ordem LIMIT $inicio, $quantidade ");
	$listaEntregouErrado->execute(['ENTREGOU ERRADO', $nulo]);
}

// roubado
$sqlTotalRoubado = $conexao->prepare("SELECT codigo FROM cliente WHERE estado = ? AND excluiu = ? ");
$sqlTotalRoubado->execute(['ROUBADO', $nulo]);
$numTotalRoubado = $sqlTotalRoubado->rowCount();
$totalRoubado = ceil($numTotalRoubado/$quantidade);
if($letra=="ROUBADO"){
	$listaRoubado = $conexao->prepare("SELECT codigo, ordemServico, nome, aparelho, marca, estado, dataRetorno1, dataRetorno2, dataRetorno3, estadoRetorno1, estadoRetorno2, estadoRetorno3, foto1, foto2, foto3, telefone_ligado1, excluiu FROM cliente WHERE estado = ? AND excluiu = ? ORDER BY $ordenacao $ordem LIMIT $inicio, $quantidade ");
	$listaRoubado->execute(['ROUBADO', $nulo]);
}

// dica
$sqlTotalDica = $conexao->prepare("SELECT codigo FROM cliente WHERE estado = ? AND excluiu = ? ");
$sqlTotalDica->execute(['DICA', $nulo]);
$numTotalDica = $sqlTotalDica->rowCount();
$totalDica = ceil($numTotalDica/$quantidade);
if($letra=="DICA"){
	$listaDica = $conexao->prepare("SELECT codigo, ordemServico, nome, aparelho, marca, estado, dataRetorno1, dataRetorno2, dataRetorno3, estadoRetorno1, estadoRetorno2, estadoRetorno3, foto1, foto2, foto3, telefone_ligado1, excluiu FROM cliente WHERE estado = ? AND excluiu = ? ORDER BY $ordenacao $ordem LIMIT $inicio, $quantidade ");
	$listaDica->execute(['DICA', $nulo]);
}

// a prazo
$sqlTotalPrazo = $conexao->prepare("SELECT codigo FROM cliente WHERE dataPagamento != ? AND excluiu = ? AND pagou = ? ");
$sqlTotalPrazo->execute(['0000-00-00', $nulo, $nulo]);
$numTotalPrazo = $sqlTotalPrazo->rowCount();
$totalPrazo = ceil($numTotalPrazo/$quantidade);
if($letra=="PRAZO"){
	$listaPrazo = $conexao->prepare("SELECT codigo, ordemServico, nome, aparelho, marca, estado, dataPagamento, dataRetorno1, dataRetorno2, dataRetorno3, estadoRetorno1, estadoRetorno2, estadoRetorno3, foto1, foto2, foto3, telefone_ligado1, excluiu FROM cliente WHERE dataPagamento != ? AND excluiu = ? AND pagou = ? ORDER BY $ordenacao $ordem LIMIT $inicio, $quantidade ");
	$listaPrazo->execute(['0000-00-00', $nulo, $nulo]);
}

// fotos
$sqlTotalFotos = $conexao->prepare("SELECT codigo FROM cliente WHERE (foto1<> ? OR foto2<> ? OR foto3<> ?) AND excluiu = ?");
$sqlTotalFotos->execute([$nulo, $nulo, $nulo, $nulo]);
$numTotalFotos = $sqlTotalFotos->rowCount();
$totalFotos = ceil($numTotalFotos/$quantidade);
if($letra=="FOTOS"){
	$listaFotos = $conexao->prepare("SELECT codigo, ordemServico, nome, aparelho, marca, estado, dataRetorno1, dataRetorno2, dataRetorno3, estadoRetorno1, estadoRetorno2, estadoRetorno3, foto1, foto2, foto3, telefone_ligado1, excluiu FROM cliente WHERE (foto1<> ? OR foto2<> ? OR foto3<> ?) AND excluiu = ? ORDER BY $ordenacao $ordem LIMIT $inicio, $quantidade ");
	$listaFotos->execute([$nulo, $nulo, $nulo, $nulo]);
}
// ligou
$sqlTotalLigou = $conexao->prepare("SELECT codigo FROM cliente WHERE telefone_ligado1<>? AND excluiu = ?");
$sqlTotalLigou->execute([$nulo, $nulo]);
$numTotalLigou = $sqlTotalLigou->rowCount();
$totalLigou = ceil($numTotalLigou/$quantidade);
if($letra=="LIGOU"){
	$listaLigou = $conexao->prepare("SELECT codigo, ordemServico, nome, aparelho, marca, estado, dataRetorno1, dataRetorno2, dataRetorno3, estadoRetorno1, estadoRetorno2, estadoRetorno3, foto1, foto2, foto3, telefone_ligado1, excluiu FROM cliente WHERE telefone_ligado1<>? AND excluiu = ? ORDER BY $ordenacao $ordem LIMIT $inicio, $quantidade ");
	$listaLigou->execute([$nulo, $nulo]);
}

// controle para consulta de aparelho, marca e modelo
$contaaparelho = $conexao->prepare("SELECT * FROM aparelho");
$contaaparelho->execute();
$totalaparelho = $contaaparelho->rowCount();
$contamarca = $conexao->prepare("SELECT * FROM marca");
$contamarca->execute();
$totalmarca = $contamarca->rowCount();
$contamodelo = $conexao->prepare("SELECT * FROM modelo");
$contamodelo->execute();
$totalmodelo = $contamodelo->rowCount();

// excluído.
$listclients = $conexao->prepare("SELECT codigo FROM cliente WHERE excluiu<> ? ORDER BY nome ASC");
$listclients->execute([$nulo]);
$numTotclientesExcluidos = $listclients->rowCount();

// excluidos.php.
$sqlTotalExcluido = $conexao->prepare("SELECT codigo FROM cliente WHERE excluiu<> ? ");
$sqlTotalExcluido->execute([$nulo]);
$numTotalListaExcluido = $sqlTotalExcluido->rowCount();
$totalListaExcluido = ceil($numTotalListaExcluido/$quantidade);

// excluidos
$listaExcluido = $conexao->prepare("SELECT * FROM cliente WHERE excluiu<> ? ORDER BY $ordenacao $ordem LIMIT $inicio, $quantidade ");
$listaExcluido->execute([$nulo]);
$totalExcluido = $listaExcluido->rowCount();

// excluidos permanentemente
$sqlExcluidos = $conexao->prepare("SELECT codigo, cadastro FROM excluidos");
$sqlExcluidos->execute();
$totalExcPermanente = $sqlExcluidos->rowCount();
?>