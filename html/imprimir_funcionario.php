<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Controle OS</title>
		<link rel="shortcut icon" href="favicon.ico" >
		<meta name="viewport" content="widhth=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=10,  minimum-scale=1.0" />
		<meta name="referrer" content="default" id="meta_referrer" />
		<meta http-equiv="cache-control" content="max-age=0" />
		<meta http-equiv="cache-control" content="no-cache" />
		<meta http-equiv="expires" content="0" />
		<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
		<meta http-equiv="pragma" content="no-cache" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<?php 
		@session_start();
		require_once '../php/conexao.php';
		if(empty($_SESSION['logado'])){
			header("Location:home.php");
			exit;	
		};
		?>
		<style>
			html, body {
				top: 0;
				width:100vw;
				height: 100%;
				left: 0;
				margin: 0;
				padding: 0;
				font-family: Helvetica, Arial, sans-serif;
				z-index:10;
				font-size:12px;
			}
			a{
				text-decoration:none;
				color:#000;
			}
		</style>
	</head>
	<body>
		<a href="#" style="text-decoration:none;color:#000; "onclick="history.back()">	
				<?php
				/*

				Impressao gerente

				*/
				if ((isset($_REQUEST["FuncCod"]))AND($_REQUEST["Modo"]=='individual')){
					echo "<h3><center>Cadastro de Funcionário</center></h3>";
					$codigoFunc = $_REQUEST['FuncCod'];

					$sql_func = $conexao->prepare("SELECT * FROM funcionario where codigo = ? ");
					$sql_func->execute([$codigoFunc]);
					$linha = $sql_func->fetch();

					echo "Nome - <strong>".$linha['nome'].'</strong><br>';
					echo "Dt. Nascimento - ".date('d/m/Y',strtotime($linha['data_nascimento'])).'<br>';
					echo "Dt. Cadastro - ".date('d/m/Y',strtotime($linha['data_cadastro'])).'<br>';
					if($linha['email']<>""){
						echo "Email - ".$linha['email'].'<br>';
					};
					echo "Login - ".$linha['usuario'].'<br>';
					if($linha['telefone']<>""){
						echo "Telefone - ".$linha['telefone'].'<br>';
					};
					if($linha['telefone2']<>""){
						echo "Telefone 2 - ".$linha['telefone2'].'<br>';
					};
					if($linha['cpf']<>""){
						echo "CPF - ".$linha['cpf'].'<br>';
					};
					echo "Cod. Barras - ".$linha['barra_funcionario'].'<br>';
					if($linha['obs']<>""){
						echo "Obs - ".$linha['obs'].'<br>';
					};
					if($linha['endereco']<>""){
						echo "Endereço - ".$linha['endereco'].'<br>';
					};
					if($linha['numero']<>""){
						echo "Nº - ".$linha['numero'].'<br>';
					};
					if($linha['bairro']<>""){
						echo "Bairro - ".$linha['bairro'].'<br>';
					};
					if($linha['cidade']<>""){
						echo "Cidade - ".$linha['cidade'].'<br>';
					};
					echo"<script>window.print();</script>";
					exit;			
				}
				?>
		</a>
	</body>
</html>