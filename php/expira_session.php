<?php
 @session_start();
 require_once 'conexao.php';
 //$codigo = $_SESSION['codigo'];
 $sql = "UPDATE funcionario SET tentativa = ? WHERE codigo = ? "; 
 $stmt = $conexao->prepare($sql);
 $stmt->execute(['0', $codigo]);
		
 unset($_SESSION['logado']);
 unset($_SESSION['nivel']);
 // unset($_SESSION['codigo']);
 unset($_SESSION['barra_funcionario']); 
 unset($_SESSION['controle']);
 unset($_SESSION['info']);
 $_SESSION = array();
 session_destroy();
 if($_SESSION['cronometro']="sim"){
 	$_SESSION['cronometro']=="nao";
 };
 header('location: ../html/home.php');
?>