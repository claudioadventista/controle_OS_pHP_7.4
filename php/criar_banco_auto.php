<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title>Formulário de login</title>
	<link rel="shortcut icon" href="favicon.ico" >
	<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=10, minimum-scale=1.0" />
	<meta name="referrer" content="default" id="meta_referrer" />
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
	<meta http-equiv="pragma" content="no-cache" />
	<link rel="stylesheet" type="text/css" href="../estilo/index.css" />
	<link href="../fonts/fontawesome-free-5.11.2-web/css/fontawesome.css" rel="stylesheet">
	<link href="../fonts/fontawesome-free-5.11.2-web/css/brands.css" rel="stylesheet">
	<link href="../fonts/fontawesome-free-5.11.2-web/css/solid.css" rel="stylesheet">
	<style>
		.loga{
			position:absolute;
			font-size:12px;
			bottom:10px;
			text-align: center;
			text-transform:uppercase;
			padding: 5px 0;
			width:100%;
			height:12px;
			color:#f55;
			top:5px;
		}
		.times-x{
			position:relative;
			cursor:pointer;
			margin-left:6px;
			top:6px;
		}
		
	</style>
	</head>
<body>
	<?php
	if(isset($_POST['usuario'])){
		// atribui os valores dos posts as variaveis
		$user = $_POST['usuario'];
		$pass = $_POST['senha'];
		$banco = "ordem_servico";

		// ATENÇÃO: salvar senha em.txt é inseguro. Removi.
		
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		
		try {
			// conecta sem banco pra poder criar
			$conn = new mysqli("localhost", $user, $pass);
			$conn->set_charset("utf8mb4");
			
			// Cria a database se não existir
			$conn->query("CREATE DATABASE IF NOT EXISTS `$banco` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
			$conn->select_db($banco);

			// Função pra criar tabela se não existir
			function criarTabelaSeNaoExiste($conn, $sql) {
				$conn->query($sql);
			}

			// Tabelas
			criarTabelaSeNaoExiste($conn, "CREATE TABLE IF NOT EXISTS marca(
				codigo INT(6) NOT NULL AUTO_INCREMENT,
				marca VARCHAR(50) NOT NULL,
				PRIMARY KEY (codigo)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

			criarTabelaSeNaoExiste($conn, "CREATE TABLE IF NOT EXISTS aparelho(
				codigo INT(6) NOT NULL AUTO_INCREMENT,
				aparelho VARCHAR(50) NOT NULL,
				PRIMARY KEY (codigo)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

			criarTabelaSeNaoExiste($conn, "CREATE TABLE IF NOT EXISTS modelo(
				codigo INT(6) NOT NULL AUTO_INCREMENT,
				modelo VARCHAR(50) NOT NULL,
				PRIMARY KEY (codigo)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

			criarTabelaSeNaoExiste($conn, "CREATE TABLE IF NOT EXISTS excluidos(
				codigo INT(6) NOT NULL AUTO_INCREMENT,
				cadastro TEXT NOT NULL,
				PRIMARY KEY (codigo)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

			criarTabelaSeNaoExiste($conn, "CREATE TABLE IF NOT EXISTS funcionario(
				codigo INT(6) NOT NULL AUTO_INCREMENT,
				nome VARCHAR(50) NOT NULL,
				usuario VARCHAR(15) NOT NULL,
				senha VARCHAR(255) NOT NULL,
				endereco VARCHAR(50) NOT NULL,
				bairro VARCHAR(50) NOT NULL,
				numero VARCHAR(6) NOT NULL,
				cidade VARCHAR(50) NOT NULL,
				telefone VARCHAR(15) NOT NULL,
				telefone2 VARCHAR(15) NOT NULL,
				email VARCHAR(50) NOT NULL,
				acesso INT(6) NOT NULL,
				data_nascimento DATE,
				tentativa INT(1) NOT NULL,
				ultimo_acesso VARCHAR(3) NOT NULL,
				controle_ultimo_acesso DATETIME NOT NULL,
				nivel_acesso VARCHAR(9) NOT NULL,
				data_cadastro DATE NOT NULL,
				mensagem DATE NOT NULL,
				cpf VARCHAR(11) NOT NULL,
				obs VARCHAR(255) NOT NULL,
				excluiu VARCHAR(3) NOT NULL,
				foto_funcionario VARCHAR(37) NOT NULL,
				foto_funcionario2 VARCHAR(37) NOT NULL,
				barra_funcionario VARCHAR(10) NOT NULL,
				pagina INT(2) NOT NULL,
				tema VARCHAR(6) NOT NULL,
				semCronometro VARCHAR(3) NOT NULL,
				letra VARCHAR(20) NOT NULL,
				ordenacao VARCHAR(13) NOT NULL,
				ordem VARCHAR(5) NOT NULL,
				protegido VARCHAR(3) NOT NULL,
				PRIMARY KEY (codigo)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

			criarTabelaSeNaoExiste($conn, "CREATE TABLE IF NOT EXISTS config(
				codigo INT(1) NOT NULL AUTO_INCREMENT,
				pagina INT(1) NOT NULL,
				letra VARCHAR(20) NOT NULL,
				ordenacao VARCHAR(20) NOT NULL,
				ordem VARCHAR(4) NOT NULL,
				os_auto VARCHAR(3) NOT NULL,
				cont_os VARCHAR(7) NOT NULL,
				usuario VARCHAR(15) NOT NULL,
				escolha VARCHAR(3) NOT NULL,
				oficina VARCHAR(50) NOT NULL,
				endereco VARCHAR(80) NOT NULL,
				telefone VARCHAR(15) NOT NULL,
				telefone2 VARCHAR(15) NOT NULL,
				rodape VARCHAR(255) NOT NULL,
				zeros VARCHAR(3) NOT NULL,
				logomarca VARCHAR(3) NOT NULL,
				tema VARCHAR(6) NOT NULL,
				checkMensagem VARCHAR(4) NOT NULL,
				tentativa INT(1) NOT NULL,
				mensagem DATE NOT NULL,
				coluna VARCHAR(4),
				sem_acento INT(1) NOT NULL,
				sem_tecnico INT(1) NOT NULL,
				sem_atendente INT(1) NOT NULL,
				maiuscula VARCHAR(3),
				semCronometro VARCHAR(4),
				idadeMinima INT(2) NOT NULL,
				idadeMaxima INT(2) NOT NULL,
				img_logo VARCHAR(20),
				PRIMARY KEY (codigo)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

			criarTabelaSeNaoExiste($conn, "CREATE TABLE IF NOT EXISTS cliente(
				codigo INT(8) NOT NULL AUTO_INCREMENT,
				nome VARCHAR(50) NOT NULL,
				dtNascimentoAlt DATE NOT NULL,
				cpf VARCHAR(11) NOT NULL,
				endereco VARCHAR(70) NOT NULL,
				telefone VARCHAR(15) NOT NULL,
				telefone2 VARCHAR(15) NOT NULL,
				ordemServico INT(8) NOT NULL,
				dataEntrada DATETIME NOT NULL,
				controle_entrada DATETIME NOT NULL,
				aparelho VARCHAR(50) NOT NULL,
				marca VARCHAR(50) NOT NULL,
				modelo VARCHAR(50) NOT NULL,
				numeroSerie VARCHAR(80) NOT NULL,
				chassi VARCHAR(80) NOT NULL,
				imei VARCHAR(15) NOT NULL,
				placa VARCHAR(8) NOT NULL,
				renavam VARCHAR(11) NOT NULL,
				acessorio VARCHAR(200) NOT NULL,
				observacao VARCHAR(255) NOT NULL,
				defeitoReclamado VARCHAR(200) NOT NULL,
				tecnico VARCHAR(20) NOT NULL,
				estado VARCHAR(20) NOT NULL,
				material VARCHAR(255) NOT NULL,
				orcamento DECIMAL(10,2) NOT NULL,
				valorPeca DECIMAL(10,2) NOT NULL,
				desconto DECIMAL(10,2) NOT NULL,
				transporte DECIMAL(10,2) NOT NULL,
				materialAuxiliar DECIMAL(10,2) NOT NULL,
				dataPronto DATETIME NOT NULL,
				dataSaida DATETIME NOT NULL,
				controle_saida DATETIME NOT NULL,
				infoCliente DECIMAL(10,2) NOT NULL,
				aPrazo VARCHAR(3) NOT NULL,
				inicial DECIMAL(10,2) NOT NULL,
				restante DECIMAL(10,2) NOT NULL,
				dataPagamento DATE NOT NULL,
				pagou VARCHAR(3) NOT NULL,
				dataPagou DATE NOT NULL,
				recebeu VARCHAR(3) NOT NULL,
				valorRecebido DECIMAL(10,2) NOT NULL,
				jurosCartao DECIMAL(10,2) NOT NULL,
				cartao VARCHAR(3) NOT NULL,
				tipoCartao VARCHAR(10) NOT NULL,
				bandeira_cartao VARCHAR(50) NOT NULL,
				parcelasCartao INT(3) NOT NULL,
				excluiu VARCHAR(3) NOT NULL,
				alteracao TEXT NOT NULL,
				novaOS1 VARCHAR(6) NOT NULL,
				novaOS2 VARCHAR(6) NOT NULL,
				novaOS3 VARCHAR(6) NOT NULL,
				defRet1 VARCHAR(200) NOT NULL,
				defRet2 VARCHAR(200) NOT NULL,
				defRet3 VARCHAR(200) NOT NULL,
				acessRet1 VARCHAR(200) NOT NULL,
				acessRet2 VARCHAR(200) NOT NULL,
				acessRet3 VARCHAR(200) NOT NULL,
				obsRet1 VARCHAR(255) NOT NULL,
				obsRet2 VARCHAR(255) NOT NULL,
				obsRet3 VARCHAR(255) NOT NULL,
				matRet1 VARCHAR(255) NOT NULL,
				matRet2 VARCHAR(255) NOT NULL,
				matRet3 VARCHAR(255) NOT NULL,
				orcRet1 DECIMAL(10,2) NOT NULL,
				orcRet2 DECIMAL(10,2) NOT NULL,
				orcRet3 DECIMAL(10,2) NOT NULL,
				tecRet1 VARCHAR(20) NOT NULL,
				tecRet2 VARCHAR(20) NOT NULL,
				tecRet3 VARCHAR(20) NOT NULL,
				dataRetorno1 DATETIME NOT NULL,
				dataRetorno2 DATETIME NOT NULL,
				dataRetorno3 DATETIME NOT NULL,
				estadoRetorno1 VARCHAR(20) NOT NULL,
				estadoRetorno2 VARCHAR(20) NOT NULL,
				estadoRetorno3 VARCHAR(20) NOT NULL,
				saidaRetorno1 DATETIME NOT NULL,
				saidaRetorno2 DATETIME NOT NULL,
				saidaRetorno3 DATETIME NOT NULL,
				imprimiu VARCHAR(20) NOT NULL,
				pecaRet1 DECIMAL(10,2) NOT NULL,
				pecaRet2 DECIMAL(10,2) NOT NULL,
				pecaRet3 DECIMAL(10,2) NOT NULL,
				dtProntoRet1 DATETIME NOT NULL,
				dtProntoRet2 DATETIME NOT NULL,
				dtProntoRet3 DATETIME NOT NULL,
				email VARCHAR(80) NOT NULL,
				controle_entradaRet1 DATETIME NOT NULL,
				controle_entradaRet2 DATETIME NOT NULL,
				controle_entradaRet3 DATETIME NOT NULL,
				controle_saidaRet1 DATETIME NOT NULL,
				controle_saidaRet2 DATETIME NOT NULL,
				controle_saidaRet3 DATETIME NOT NULL,
				foto1 VARCHAR(36) NOT NULL,
				foto2 VARCHAR(36) NOT NULL,
				foto3 VARCHAR(36) NOT NULL,
				barra_cliente VARCHAR(10) NOT NULL,
				quem_ligou1 VARCHAR(20) NOT NULL,
				quem_ligou2 VARCHAR(20) NOT NULL,
				quem_ligou3 VARCHAR(20) NOT NULL,
				quem_ligou4 VARCHAR(20) NOT NULL,
				quem_ligou5 VARCHAR(20) NOT NULL,
				quem_atendeu1 VARCHAR(20) NOT NULL,
				quem_atendeu2 VARCHAR(20) NOT NULL,
				quem_atendeu3 VARCHAR(20) NOT NULL,
				quem_atendeu4 VARCHAR(20) NOT NULL,
				quem_atendeu5 VARCHAR(20) NOT NULL,
				atendeu1 VARCHAR(12) NOT NULL,
				atendeu2 VARCHAR(12) NOT NULL,
				atendeu3 VARCHAR(12) NOT NULL,
				atendeu4 VARCHAR(12) NOT NULL,
				atendeu5 VARCHAR(12) NOT NULL,
				data_ligacao1 DATE NOT NULL,
				data_ligacao2 DATE NOT NULL,
				data_ligacao3 DATE NOT NULL,
				data_ligacao4 DATE NOT NULL,
				data_ligacao5 DATE NOT NULL,
				hora_ligacao1 TIME NOT NULL,
				hora_ligacao2 TIME NOT NULL,
				hora_ligacao3 TIME NOT NULL,
				hora_ligacao4 TIME NOT NULL,
				hora_ligacao5 TIME NOT NULL,
				telefone_ligado1 VARCHAR(15) NOT NULL,
				telefone_ligado2 VARCHAR(15) NOT NULL,
				telefone_ligado3 VARCHAR(15) NOT NULL,
				telefone_ligado4 VARCHAR(15) NOT NULL,
				telefone_ligado5 VARCHAR(15) NOT NULL,
				PRIMARY KEY (codigo)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

			criarTabelaSeNaoExiste($conn, "CREATE TABLE IF NOT EXISTS estado(
				codigo INT(2) NOT NULL AUTO_INCREMENT,
				controle VARCHAR(3) NOT NULL,
				estado VARCHAR(50) NOT NULL,
				PRIMARY KEY (codigo)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

			// Insere config padrão só se não existir
			$res = $conn->query("SELECT 1 FROM config LIMIT 1");
			if($res->num_rows == 0){
				$conn->query("INSERT INTO config (zeros, pagina, letra, ordenacao, ordem, os_auto, checkMensagem, mensagem, cont_os, coluna, idadeMinima, idadeMaxima, tema, sem_acento, img_logo, rodape) VALUES ('sim', 10, 'LISTA GERAL', 'nome', 'ASC', 'sim', 'sim', '2019-07-10', '1', 'nome', 14, 85, 'escuro', 1, 'logomarca.jpg','O aparelho ficará até no máximo 90 dias na oficina, após informado o orçamento, depois disso, ele será vendido para custear despesas com o mesmo. Agradecemos a compreensão.')");
			}

			// Insere estados padrão só se não existir
			$resEstado = $conn->query("SELECT 1 FROM estado LIMIT 1");
			if($resEstado->num_rows == 0){
				$estados = [
					['PO','PARA ORCAMENTO'], ['AG','AGUARDANDO'], ['OP','ORCAMENTO PRONTO'],
					['SP','SERVICO PRONTO'], ['AS','APARELHO SAIU'], ['RE','RETORNOU'],
					['DE','DEVOLVEU'], ['CO','COMPROU'], ['VE','VENDEU'], ['DO','DOOU'],
					['AB','ABANDONOU'], ['SU','SUMIU'], ['EE','ENTREGOU ERRADO'],
					['RO','ROUBADO'], ['DI','DICA']
				];
				$stmt = $conn->prepare("INSERT INTO estado (controle, estado) VALUES (?,?)");
				foreach($estados as $e){
					$stmt->bind_param("ss", $e[0], $e[1]);
					$stmt->execute();
				}
			}

			session_start();
			$_SESSION['logado'] = "";
			$_SESSION['nivel'] = "";
			header('location:../html/cadastro_funcionario2.php');
			exit;

		} catch (mysqli_sql_exception $e) {
			echo "<script>alert('Erro: ".$e->getMessage()."'); window.location.reload(true);</script>";
		} finally {
			if(isset($conn)) $conn->close();
		}
	}
	?>
	<div class="container">	
		<div class="cabecario_padrao">
			<span class="texto">Formulário para Criar o Banco MySQL</span>
			<span class="atualizar_pagina" title="clique para atualizar a página" onclick="document.location.reload(true);">&#8635;</span>
		</div>
		<div class="formLogar">	
			<form id="formulario" action="criar_banco_auto.php" method="post">
				<div class="linha">
					<div class="col col-10"><br></div>
				</div>	
				<div class="linha">
					<div class="col col-10">
						<div class="col col-1"></div>	
						<div class="col col-8">	
							<i class="usuario fas fa-user"></i>
							<span class="texto-digite-usuario" >Digite o usuário</span>
						</div>
					</div>
				</div>	
				<div class="linha">
					<div class="col col-10"><br></div>
				</div>
				<div class="linha">
					<div class="col col-10">
						<div class="col col-1"></div>
						<div class="col col-8">
							<input class="input_usuario" id="loginBanco" name="usuario" type="text" placeholder="Digite o usuário do banco" autocomplete="off" maxlength="30" title="Preencha esse campo com o usuário do banco" required autofocus />
						</div>
						<div class="col col-1">
							<span class="times-x" title="Clique para limpar o campo Usuário" onclick="document.getElementById('loginBanco').value='';document.getElementById('loginBanco').focus()">&times;</span>
						</div>
					</div>
				</div>
				<div class="linha">
					<div class="col col-10"></div>
				</div>
				<div class="linha">
					<div class="col col-10">
						<div class="col col-1"></div>	
						<div class="col col-8">	
							<i class="senha-login fas fa-unlock"></i>
							<span class="digite-senha" >Digite a senha</span>
						</div>
					</div>
				</div>
				<div class="linha">
					<div class="col col-10"><br><br></div>
					<div class="col col-1"></div>
					<div class="col col-8">
						<input class="input_usuario" type="password" id="senha" name="senha" placeholder="Digite a senha do banco" maxlength="30" />
					</div>
					<div class="col col-1">
						<span class="times-x" title="Clique para limpar o campo Senha" onclick="document.getElementById('senha').value='';document.getElementById('senha').focus();">&times;</span>
					</div>
				</div>
				<div class="linha">
					<div class="col col-10" style="margin-top:23px" ></div>
				</div>
				<div class="linha" >
					<div class="col col-10 rodape_alterar_aparelho" >
						<div class="col col-1" >
						</div>
						<div class="col col-9" >
							<button type="button" class="botao" title="Clique para mostra ou oculta a senha"  onclick="mostraOcultar()"><i class="fas fa-eye"></i><span class="espaco">VER</span></button>				
							<button class="botao" title="Clique para fazer criar o banco" onclick="document.getElementById('enviar').click();" ><i class="fas fa-sign-in-alt"></i><span class="espaco">CRIAR</span></button>
							<input type="submit" class="sumido" id="enviar" />	
						</div>
					</div>	
				</div>	
			</form>
		</div>
	</div>
	<script>
		var senha = document.getElementById("senha");
			function mostraSenha() {
					senha.type = "text";
			};
			function ocultaSenha() {
					senha.type = "password";
			}
			function mostraOcultar() {
				if (senha.type === "password"){
					senha.type = "text";
				}else{
					senha.type = "password";
				}		
			};
		</script>
</body>
</html>