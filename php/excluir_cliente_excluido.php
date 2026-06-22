<?php 
@session_start();
// só entra nessa página se estiver logado 
if(empty($_SESSION['logado'])) {
  	$_SESSION["informacao"]="Operação não premitida!";
  	header('Location:../html/home.php');
exit;
};

require_once 'consulta.php';
if (isset($_GET['excluir_cliente'])) {
	// -------------------- EXCLUI IMAGENS SE HOUVER------------------
	// pega o codigo do cadastro enviado pelo get
	$codigo = $_GET['excluir_cliente'];
	// fáz a consulta no banco com o código
	$query = $conexao->prepare("SELECT foto1, foto2, foto3 FROM cliente WHERE codigo = ? ");
	$query->execute([$codigo]);
	//coloca os valores das fotos no array
	$linha = $query->fetch();
	// se o valora de foto1 for diferente de branco, entra aqui
	if($linha['foto1']<>""){
		// coloca o valor da foto na variavel + a extensão
		$foto1 = $linha['foto1'];
		// coloca o caminho da pastana variavel
		$pasta ="../imagem_cliente/";
		// deleta a foto selecionada na pasta
		unlink($pasta.$foto1);
	}
	if($linha['foto2']<>""){
		$foto2 = $linha['foto2'];
		$pasta ="../imagem_cliente/";
		unlink($pasta.$foto2);
	}
	if($linha['foto3']<>""){
		$foto2 = $linha['foto3'];
		$pasta ="../imagem_cliente/";
		unlink($pasta.$foto2);
	};

	require_once 'cadastro_excluido.php';

	$sql = "DELETE FROM cliente WHERE codigo IN(?)";
	$stmt = $conexao->prepare($sql);
	$stmt->execute([$codigo]);

	// depois de excluido, faz uma consulta pra ver se ainda restam cadastros ocultos	
	if($totalExcluido == 1){
		$_SESSION["controle_backup"]="ultimo_cadastro_excluido";
	}else{ 
		$_SESSION["controle_backup"]="cadastro_excluido";
	};
};
header('Location:backup.php');
?>