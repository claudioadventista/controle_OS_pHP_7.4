<?php 
@session_start();
if(empty($_SESSION['logado'])) {
 	$_SESSION["informacao"]="Operação não premitida";
 	header('Location:../html/home.php');
 exit;
}

require_once 'consulta.php';

if (isset($_GET['retornar_cliente'])){
	$codigo = $_GET['retornar_cliente'];
	$nulo = '';

	$sql = "UPDATE cliente SET excluiu = ? WHERE codigo = ? "; 
	$stmt = $conexao->prepare($sql);
	$stmt->execute([$nulo, $codigo]);

	// depois de retornado, faz uma consulta pra ver se ainda restam cadastros ocultos
	require_once 'consulta.php';	
	if($totalExcluido == 1){	
		$_SESSION["informacao"]="Último cadastro retornado com sucesso";	
		header("Location:../html/home.php");	
		exit;
	}else{;
		$_SESSION["informacao"]="Cadastro retornado com sucesso";
?>
		<script>
			// volta para atualizando a página excluidos.php
	   	 	window.location = document.referrer;
	    </script>
<?php
	};
};

?> 	