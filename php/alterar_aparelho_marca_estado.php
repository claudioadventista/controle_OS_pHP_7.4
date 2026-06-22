<?php
@session_start();
require_once 'conexao.php';
require_once 'funcoes_php.php';
if(isset($_POST['aparelho'])OR(isset($_POST['marca']))OR(isset($_POST['modelo']))OR(isset($_POST['excluir_funcionario']))){
	$codigo = $_POST['codigo'];
	$nome = $_POST['aparelho'];
	
	// encaminha o aparelho para ser excluido
	if((isset($_POST['aparelho']))AND(isset($_POST['excluir']))AND(trim($_POST['aparelho'])<>"")){
		 header('Location:excluir_aparelho_marca_estado.php?nome=aparelho&codigo='.$codigo );
		 exit;
	}
	
	// alterar o aparelho
	if((isset($_POST['aparelho']))AND(isset($_POST['alterar']))AND(trim($_POST['aparelho'])<>"")){
		$aparelho= tirarAcentos(trim($_POST['aparelho']));	
		if($aparelho == ""){
			$_SESSION["informacao"]="Campo aparelho em branco!";
	    	header('Location:../html/home.php');
	    	exit;
		};
		// Identifica se o nome do aparelho alterado ja é cadastrado
		$listaaparelho = $conexao->prepare("SELECT * FROM aparelho WHERE aparelho = ? ");
		$listaaparelho->execute([$aparelho]);
		$resultadoap = $listaaparelho->rowCount();
		// Se não for encontrado nenhum aparelho com o nome que foi enviado...
		if ($resultadoap == 0) {
			
			$sql = "UPDATE aparelho SET aparelho = ? WHERE codigo = ? "; 
			$stmt = $conexao->prepare($sql);
			$stmt->execute([$aparelho, $codigo]);

			$_SESSION["informacao"]="O aparelho foi alterado com sucesso!";
		    header('Location:backup.php');
	    }else{
	    	$_SESSION["informacao"]="<span style='color:red'>Este aparelho já está cadastrado!</span>";
	    	header('Location:../html/home.php');
	    	exit;
		}
    }
	// fim da alteração de aparelho
	
	// encaminha a marca para ser excluido
	if((isset($_POST['marca']))AND(isset($_POST['excluir']))AND(trim($_POST['marca'])<>"")){
		 header('Location:excluir_aparelho_marca_estado.php?nome=marca&codigo='.$codigo );
		 exit;
	}
	
    if((isset($_POST['marca']))AND(trim($_POST['marca'])<>"")){
		$marca= tirarAcentos(trim($_POST['marca']));
		if($marca == ""){
			$_SESSION["informacao"]="Campo marca em branco!";
	    	header('Location:../html/home.php');
	    	exit;
		}	
		// Identifica se o marca ja é cadastrado
		$listamarca = $conexao->prepare("SELECT * FROM marca WHERE marca = ? ");
		$listamarca->execute([$marca]);
		$resultadoma = $listamarca->rowCount();
		// Se não for encontrado nenhuma marca com o nome que foi enviado...
		if ($resultadoma == 0) {

			$sql = "UPDATE marca SET marca = ? WHERE codigo = ? "; 
			$stmt = $conexao->prepare($sql);
			$stmt->execute([$marca, $codigo]);

			$_SESSION["informacao"]="A marca foi alterada com sucesso";
		    header('Location:backup.php');
	    }else{
	    	$_SESSION["informacao"]="<span style='color:red'>Esta marca já está cadastrada</span>";
	    	header('Location:../html/home.php');
	    	exit;
		}
    }
    // fim da alteração de marca

	// encaminha o modelo para ser excluido
	if((isset($_POST['modelo']))AND(isset($_POST['excluir']))AND(trim($_POST['modelo'])<>"")){
		 header('Location:excluir_aparelho_marca_estado.php?nome=modelo&codigo='.$codigo );
		 exit;
	}
	
    if((isset($_POST['modelo']))AND(trim($_POST['modelo'])<>"")){
		$modelo= tirarAcentos(trim($_POST['modelo']));	
		if($modelo == ""){
			$_SESSION["informacao"]="Campo modelo em branco!";
	    	header('Location:../html/home.php');
	    	exit;
		}
		// Identifica se o modelo ja é cadastrado
		
		$listamodelo = $conexao->prepare("SELECT * FROM modelo WHERE modelo = ? ");
		$listamodelo->execute([$modelo]);
		$resultadomo = $listamodelo->rowCount();
		// Se não for encontrado nenhuma modelo com o nome que foi enviado...
		if ($resultadomo == 0) {

			$sql = "UPDATE modelo SET modelo = ? WHERE codigo = ? "; 
			$stmt = $conexao->prepare($sql);
			$stmt->execute([$modelo, $codigo]);

			$_SESSION["informacao"]="O modelo foi alterado com sucesso";
		    header('Location:backup.php');
	    }else{
	    	$_SESSION["informacao"]="<span style='color:red'>Este modelo já está cadastrado</span>";
	    	header('Location:../html/home.php');
	    	exit;
		}
	}
}else{
    header('Location:../html/home.php');
}
?>

