<?php 
@session_start();
if(empty($_SESSION['logado'])) {
 	$_SESSION["informacao"]="Operação não premitida";
 	header('Location:../html/home.php');
 exit;
}
require_once 'conexao.php';
if (isset($_GET['codigo']))
	{
		$codigo = $_GET['codigo'];
		$sql = "UPDATE cliente SET excluiu = ? WHERE codigo = ? ";
		$stmt = $conexao->prepare($sql);
		$stmt->execute(['sim', $codigo]);
	
	};
$_SESSION["informacao"]="Excluído com sucesso";
 header('Location:backup.php');
exit;
?> 	