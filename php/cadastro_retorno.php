<?php	
@session_start();
// só entra nessa página se estiver logado 
 if(empty($_SESSION['logado'])) {
 	$_SESSION["informacao"]="Operação não premitida";
 	header('Location:../html/home.php');
 exit;
}
require_once '../php/funcoes_php.php';
require_once '../php/consulta.php';
$codigo = $_POST['codigoRetorno'];
$nulo = '';
date_default_timezone_set('America/Fortaleza');
/***************************************************************************************

                           CADASTRA E ALTERA O RETORNO 

****************************************************************************************/
if((isset($codigo))AND($codigo<>"")){	
	if(empty($_POST['dataEntradaRetorno'])){
		$dtEntradaRet = date("Y-m-d\TH:i");		
	}else{
		$dtEntradaRet = $_POST['dataEntradaRetorno'];
	}
	if((empty($_POST['dataProntoRetorno']))AND(($_POST['estadoRetorno']=='SERVICO PRONTO')OR($_POST['estadoRetorno']=='APARELHO SAIU'))){	
		$dtProntoRet = date("Y-m-d\TH:i");	
	}else{
		$dtProntoRet = $_POST['dataProntoRetorno'];
	} 
	if((empty($_POST['dataSaidaRetorno']))AND($_POST['estadoRetorno']=='APARELHO SAIU')){
		$dtSaidaRet = date("Y-m-d\TH:i");	
	}else{
		$dtSaidaRet = $_POST['dataSaidaRetorno'];
	} 
	
	if($_SESSION['maiuscula']=="sim"){
		$defRet    = maiusculo($_POST['defeitoRetorno']);
		$acessRet  = maiusculo($_POST['acessorioRetorno']);
		$obsRet    = maiusculo($_POST['obsRetorno']);
		$matRet    = maiusculo($_POST['materialRetorno']);
	}else if($resultado['sem_acento']<>0){
		$defRet    = eliminaAcentos($_POST['defeitoRetorno']);
		$acessRet  = eliminaAcentos($_POST['acessorioRetorno']);
		$obsRet    = eliminaAcentos($_POST['obsRetorno']);
		$matRet    = eliminaAcentos($_POST['materialRetorno']);
	}else{
		$defRet    = $_POST['defeitoRetorno'];
		$acessRet  = $_POST['acessorioRetorno'];
		$obsRet    = $_POST['obsRetorno'];
		$matRet    = $_POST['materialRetorno'];
	}
	$defRet    = ucfirst(retiraEspaco($defRet)); 
	$acessRet  = ucfirst(retiraEspaco($acessRet));  
	$obsRet    = ucfirst(retiraEspaco($obsRet));  
	$matRet    = ucfirst(retiraEspaco($matRet));    
	$novaOS    = $_POST['novaOSRetorno'];
	$estadoRet = $_POST['estadoRetorno'];
	$pecaRet   = limpaValor($_POST['pecaRetorno']);	 
	
	//  CADASTRA E ALTERA O RETORNO 1
	if(($_POST['controleRetorno']=="retorno1Alt")OR($_POST['controleRetorno']=="retorno1")){
	
		require_once 'verifica_alteracaoRetorno.php';
		
		$sql = "UPDATE cliente SET novaOS1 = ?, estadoRetorno1 = ?, defRet1 = ?, acessRet1 = ?, obsRet1 = ?, dataRetorno1 = ?, matRet1 = ?, pecaRet1 = ?, dtProntoRet1 = ?, saidaRetorno1 = ? WHERE codigo = ? "; 
		$stmt = $conexao->prepare($sql);
		$stmt->execute([$novaOS, $estadoRet, $defRet, $acessRet, $obsRet, $dtEntradaRet, $matRet, $pecaRet, $dtProntoRet, $dtSaidaRet, $codigo]);
		
		$_SESSION["informacao"]="Primeiro retorno alterado";
		header('Location:backup.php');
		exit;
	};
	//  CADASTRA E ALTERA O RETORNO 2
	if(($_POST['controleRetorno']=="retorno2Alt")OR($_POST['controleRetorno']=="retorno2")){

		require_once 'verifica_alteracaoRetorno.php';
		
		$sql = "UPDATE cliente SET novaOS2 = ?, estadoRetorno2 = ?, defRet2 = ?, acessRet2 = ?, obsRet2 = ?, dataRetorno2 = ?, matRet2 = ?, pecaRet2 = ?, dtProntoRet2 = ?, saidaRetorno2 = ? WHERE codigo = ? "; 
		$stmt = $conexao->prepare($sql);
		$stmt->execute([$novaOS, $estadoRet, $defRet, $acessRet, $obsRet, $dtEntradaRet, $matRet, $pecaRet, $dtProntoRet, $dtSaidaRet, $codigo]);
		
		$_SESSION["informacao"]="Segundo retorno alterado";
		header('Location:backup.php');
		exit;
	};
	// CADASTRA E ALTERA O RETORNO 3
	if(($_POST['controleRetorno']=="retorno3Alt")OR($_POST['controleRetorno']=="retorno3")){
		
		require_once 'verifica_alteracaoRetorno.php';
		
		$sql = "UPDATE cliente SET novaOS3 = ?, estadoRetorno3 = ?, defRet3 = ?, acessRet3 = ?, obsRet3 = ?, dataRetorno3 = ?, matRet3 = ?, pecaRet3 = ?, dtProntoRet3 = ?, saidaRetorno3 = ? WHERE codigo = ? "; 
		$stmt = $conexao->prepare($sql);
		$stmt->execute([$novaOS, $estadoRet, $defRet, $acessRet, $obsRet, $dtEntradaRet, $matRet, $pecaRet, $dtProntoRet, $dtSaidaRet, $codigo]);
		
		$_SESSION["informacao"]="Terceiro retorno alterado";
		
		header('Location:backup.php');
		exit;
	};
};

