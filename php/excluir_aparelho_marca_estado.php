<?php
@session_start();//esse comando permite manter as configurações da sessão loggin em outras páginas	// só entra nessa página se estiver logado 
 if(empty($_SESSION['logado'])) {
  	$_SESSION["informacao"]="Operação não premitida!";
  	header('Location:../html/home.php');
 exit;
};
//print_r($_REQUEST);
//exit;
require_once 'conexao.php';
if ((isset($_GET['nome']))AND(isset($_GET['codigo']))) {
	$nome = $_GET['nome'];
	$codigo = $_GET['codigo'];	
	// nao pode usar placeholders, interrogacao, para nomes de tabelas ou colunas, porem pode usar variavel
	$sql = "DELETE FROM $nome WHERE codigo IN(?)";
	$stmt = $conexao->prepare($sql);
	$stmt->execute([$codigo]);

	if($nome =="aparelho"){
		$nome = "O aparelho foi excluído com sucesso!";
	}else if($nome == "marca"){
		$nome = "A marca foi excluída com sucesso!";
	}else{
		$nome = "O modelo foi excluído com sucesso!";
	};
	$_SESSION["informacao"]=$nome;
	 header('Location:backup.php');
	exit;
}else{
	header('Location: ../html/home.php');
}	
?>