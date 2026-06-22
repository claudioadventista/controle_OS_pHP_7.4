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
		<?php // A linha abaixo permite manter as configurações da sessão loggin    
		@session_start();
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
		<a href="#" onclick="history.back()">
			<?php
			@session_start();
			require_once '../php/consulta.php';
			if(isset($_REQUEST['imprimir_tudo'])){
				$imprimir_tudo = $_REQUEST['imprimir_tudo'];
				$listagem = $conexao->prepare("SELECT * FROM cliente WHERE codigo = ? "); 
				$listagem->execute([$imprimir_tudo]);
				$linha = $listagem->fetch();
				/*
				
				Impressao do cadastro individual pelo icone na coluna FUNCOES

				*/
				echo "<h3><center>Cadastro de Cliente</center></h3>";
				echo "O.S. - ".$linha['ordemServico'].'<br>';
				echo "Nome - ".$linha['nome'].'<br>';
				if($linha['telefone']<>""){
					echo "Telefone - ".$linha['telefone'].'<br>';
				};
				if($linha['telefone2']<>""){
					echo "Telefone 2 - ".$linha['telefone2'].'<br>';
				};
				if($linha['cpf']<>""){
					echo "Cpf - ".$linha['cpf'].'<br>';
				};
				if($linha['endereco']<>""){
					echo "Endereço - ".$linha['endereco'].'<br>';
				};
				echo "Aparelho - ".$linha['aparelho'].'<br>';
				echo "Marca - ".$linha['marca'].'<br>';
				if($linha['modelo']<>""){
					echo "Modelo - ".$linha['modelo'].'<br>';
				};
				if($linha['numeroSerie']<>""){
					echo "Número de série - ".$linha['numeroSerie'].'<br>';
				};
				if($linha['chassi']<>""){
					echo "Chassi - ".$linha['chassi'].'<br>';
				};
				echo "Defeito Reclamado - ".$linha['defeitoReclamado'].'<br>';
				echo "Estado do aparelho - ".$linha['estado'].'<br>';
				if($linha['acessorio']<>""){
					echo "Acessório - ".$linha['acessorio'].'<br>';
				};
				if($linha['observacao']<>""){
					echo "Obs. - ".$linha['observacao'].'<br>';
				};
				if($linha['material']<>""){
					echo "Material - ".$linha['material'].'<br>';
				};
				if($linha['orcamento']<>"0.00"){
					echo "Orçamento - ".$linha['orcamento'].'<br>';
				};
				if($linha['desconto']<>"0.00"){
					echo "Desconto - ".$linha['desconto'].'<br>';
				};
				if($linha['valorPeca']<>"0.00"){
					echo "Peça(s) - ".$linha['valorPeca'].'<br>';
				};
				if($linha['materialAuxiliar']<> '0.00'){
					echo "Mat. Auxiliar : ".$linha['materialAuxiliar']."<br>";
				};
				if($linha['transporte']<> '0.00'){
					echo "Transporte : ".$linha['transporte']."<br>";
				};
				if($linha['tecnico']<>""){
					echo "Técnico - ".$linha['tecnico'].'<br>';
				};
				echo "Data de entrada - ".date('d/m/Y', strtotime($linha['dataEntrada'])).'<br>';
				if($linha['dataPronto']<>"000-00-00"){
					echo "Data de pronto - ".date('d/m/Y', strtotime($linha['dataPronto'])).'<br>';
				};
				if($linha['dataSaida']<>"000-00-00"){
					echo "Data de saída - ".date('d/m/Y', strtotime($linha['dataSaida'])).'<br>';
				};
				// retorno 1
				if($linha['dataRetorno1']<>"0000-00-00"){
					if($linha['novaOS1']<>""){
						echo "Nova O.S. retorno 1 - ".$linha['novaOS1'];
					};
					echo '<br>'; echo "Primeiro retorno em - ".date('d/m/Y', strtotime($linha['dataRetorno1'])).'<br>';
					echo "Defeito retorno 1 - ".$linha['defRet1'].'<br>';
					echo "Estado retorno 1 - ".$linha['estadoRetorno1'].'<br>';
					if($linha['acessRet1']<>""){
						echo "Acessório retorno 1 - ".$linha['acessRet1'];
					};
					if($linha['obsRet1']<>""){
						echo "Obs. retorno 1 - ".$linha['obsRet1'].'<br>';
					};
					if($linha['matRet1']<>""){
						echo "Material retorno 1 - ".$linha['matRet1'].'<br>';
					};
					if($linha['pecaRet1']<>"0.00"){
						echo "Peça(s) retorno 1 - ".$linha['pecaRet1'].'<br>';
					};
					if($linha['dtProntoRet1']<>"000-00-00"){
						echo "Data de pronto do retorno 1 - ".date('d/m/Y', strtotime($linha['dtProntoRet1'])).'<br>';
					};
					if($linha['saidaRetorno1']<>"000-00-00"){
						echo "Data de saída do retorno 1 - ".date('d/m/Y', strtotime($linha['saidaRetorno1'])).'<br>';
					};
				};
				// retorno 2
				if($linha['dataRetorno2']<>"0000-00-00"){
					if($linha['novaOS2']<>""){
						echo "Nova O.S. retorno 2 - ".$linha['novaOS2'];
					};
					echo '<br>'; echo "Segundo retorno em - ".date('d/m/Y', strtotime($linha['dataRetorno2'])).'<br>';
					echo "Defeito retorno 2 - ".$linha['defRet2'].'<br>';
					echo "Estado retorno 2 - ".$linha['estadoRetorno2'].'<br>';
					if($linha['acessRet2']<>""){
						echo "Acessório retorno 2 - ".$linha['acessRet2'].'<br>';
					};
					if($linha['obsRet2']<>""){
						echo "Obs. retorno 2 - ".$linha['obsRet2'].'<br>';
					};
					if($linha['matRet2']<>""){
						echo "Material retorno 2 - ".$linha['matRet2'].'<br>';
					};
					if($linha['pecaRet2']<>"0.00"){
						echo "Peça(s) retorno 2 - ".$linha['pecaRet2'].'<br>';
					};
					if($linha['dtProntoRet2']<>"000-00-00"){
						echo "Data de pronto do retorno 2- ".date('d/m/Y', strtotime($linha['dtProntoRet2'])).'<br>';
					};
					if($linha['saidaRetorno2']<>"0000-00-00"){
						echo "Data de saída do retorno 2 - ".date('d/m/Y', strtotime($linha['saidaRetorno2'])).'<br>';
					};
				};
				// etorno 3
				if($linha['dataRetorno3']<>"0000-00-00"){
					if($linha['novaOS3']<>""){
					echo "Nova O.S. retorno 3 - ".$linha['novaOS3'];
					};
					echo '<br>'; echo "Terceiro retorno em - ".date('d/m/Y', strtotime($linha['dataRetorno3'])).'<br>';
					echo "Defeito retorno 3 - ".$linha['defRet3'].'<br>';
					echo "Estado retorno 3 - ".$linha['estadoRetorno3'].'<br>';
					if($linha['acessRet3']<>""){
					echo "Acessório retorno 3 - ".$linha['acessRet3'].'<br>';
					};
					if($linha['obsRet3']<>""){
					echo "Obs. retorno 3 - ".$linha['obsRet3'].'<br>';
					};
					if($linha['matRet3']<>""){
					echo "Material retorno 3 - ".$linha['matRet3'].'<br>';
					};
					if($linha['pecaRet3']<>""){
					echo "Peça(s) retorno 3 - ".$linha['pecaRet3'].'<br>';
					};
					if($linha['dtProntoRet3']<>"000-00-00"){
					echo "Data de pronto do retorno 3 - ".date('d/m/Y', strtotime($linha['dtProntoRet3'])).'<br>';
					};
					if($linha['saidaRetorno3']<>"000-00-00"){
					echo "Data de saída do retorno 3 - ".date('d/m/Y', strtotime($linha['saidaRetorno3'])).'<br><br><br><br><br>';
					};
				};					
				echo"<script>window.print();</script>";
				exit;
			};
			?>
		</a>
	</body>
</html>
