<?php
@session_start();
require_once 'conexao.php';
require_once 'funcoes_php.php';
if(empty($_SESSION['logado'])) {
	 unset ($_SESSION['logado']);
	 header('Location:../html/login.php');	  
 exit;
}	
if(isset($_REQUEST['novo-aparelho'])OR($_REQUEST['nova-marca'])OR($_REQUEST['novo-modelo'])){
	if((isset($_REQUEST['novo-aparelho']))AND(trim($_REQUEST['novo-aparelho'])<>"")){
		$novoAparelho= tirarAcentos(trim($_REQUEST['novo-aparelho']));
		if($novoAparelho == ""){
			$_SESSION["informacao"]="Campo aparelho em branco!";
	    	header('Location:../html/home.php');
	    	exit;
		}	
		if(strlen($novoAparelho) < 2){
			$_SESSION["informacao"]="Campo aparelho com menos de dois caracteres!";
	    	header('Location:../html/home.php');
	    	exit;
		}	
		// Identifica se o aparelho ja é cadastrado
		
		$listaaparelho = $conexao->prepare("SELECT * FROM aparelho WHERE aparelho = ? ");
		$listaaparelho->execute([$novoAparelho]);
		$resultadoap = $listaaparelho->rowCount();
		// Se não for encontrado nenhum aparelho com o nome que foi enviado...
		if ($resultadoap == 0) {
			
			$sql = "INSERT INTO aparelho (aparelho) VALUES (?)";
			$stmt = $conexao->prepare($sql);
			$stmt->execute([$novoAparelho]);
			
			$_SESSION["informacao"]="Aparelho cadastrado com sucesso!";
		    header('Location:backup.php');
	    }else{
	    	$_SESSION["informacao"]="Aparelho já está cadastrado!";
	    	header('Location:../html/home.php');
	    	exit;
		}
    }
    // fim do cadastro de aparelho

    if((isset($_REQUEST['nova-marca']))AND(trim($_REQUEST['nova-marca'])<>"")){
		$novaMarca= tirarAcentos(trim($_REQUEST['nova-marca']));	
		if($novaMarca == ""){
			$_SESSION["informacao"]="Campo marca em branco!";
	    	header('Location:../html/home.php');
	    	exit;
		}	
		if(strlen($novaMarca) < 2){
			$_SESSION["informacao"]="Campo marca com menos de dois caracteres!";
	    	header('Location:../html/home.php');
	    	exit;
		}	
			// Identifica se o modelo ja é cadastrado
			$listamarca = $conexao->prepare("SELECT * FROM marca WHERE marca = ? ");
			$listamarca->execute([$novaMarca]);
			$resultadoma = $listamarca->rowCount();

		// Se não for encontrado nenhuma marca com o nome que foi enviado...
		if ($resultadoma == 0) {
			$sql = "INSERT INTO marca (marca) VALUES (?)";
			$stmt = $conexao->prepare($sql);
			$stmt->execute([$novaMarca]);


			$_SESSION["informacao"]="Marca cadastrada com sucesso!";
		    header('Location:backup.php');
	    }else{
	    	$_SESSION["informacao"]="Marca já está cadastrada!";
	    	header('Location:../html/home.php');
	    	exit;
		}
    }
    // fim de cadastro de marca

    if((isset($_REQUEST['novo-modelo']))AND(trim($_REQUEST['novo-modelo'])<>"")){
		$novoModelo= tirarAcentos(trim($_REQUEST['novo-modelo']));
		if($novoModelo == ""){
			$_SESSION["informacao"]="Campo modelo em branco!";
	    	header('Location:../html/home.php');
	    	exit;
		}	
		if(strlen($novoModelo) < 2){
			$_SESSION["informacao"]="Campo modelo com menos de dois caracteres!";
	    	header('Location:../html/home.php');
	    	exit;
		}		
			// Identifica se o modelo ja é cadastrado
		$listamodelo = $conexao->prepare("SELECT * FROM modelo WHERE modelo = ? ");
		$listamodelo->execute([$novoModelo]);
		$resultadomo = $listamodelo->rowCount();

		// Se não for encontrado nenhum modelo com o nome que foi enviado...
		if ($resultadomo == 0) {
			$sql = "INSERT INTO modelo (modelo) VALUES (?)";
			$stmt = $conexao->prepare($sql);
			$stmt->execute([$novoModelo]);

			$_SESSION["informacao"]="Modelo cadastrado com sucesso!";
		    header('Location:backup.php');
	    }else{
	    	$_SESSION["informacao"]="Modelo já está cadastrado!";
	    	header('Location:../html/home.php');
	    	exit;
		}
    }
	exit;	
}else{	
	 header('Location:../html/home.php');
}

?>