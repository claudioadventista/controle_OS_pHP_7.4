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
	<link rel="stylesheet" type="text/css" href="../estilo/index.css" />
	<?php 
	//if($_SESSION['tema']=="claro"){
	//	echo '<link rel="stylesheet" type="text/css" href="../estilo/tema_escuro.css" />';
	//}
	?>
	<link href="../fonts/fontawesome-free-5.11.2-web/css/fontawesome.css" rel="stylesheet">
	<link href="../fonts/fontawesome-free-5.11.2-web/css/brands.css" rel="stylesheet">
	<link href="../fonts/fontawesome-free-5.11.2-web/css/solid.css" rel="stylesheet">	

	<?php
	
	@session_start();
	require_once '../php/conexao.php';
	require_once '../php/funcoes_php.php';

	$nulo = '';
	$listaFuncionario = $conexao->prepare("SELECT codigo FROM funcionario WHERE excluiu = ? ");
	$listaFuncionario->execute([$nulo]);
	$funcionario = $listaFuncionario->fetch();
	$totalFuncionario = $listaFuncionario->rowCount();
	
	if($totalFuncionario == 0){
		$_SESSION['funcionario']="primeiro_funcionario";
	}
	// so fica nessa página se não houver nenhum funcionario cadastrado
	if($totalFuncionario > 0){
		header('Location:../php/expira_session.php');
	}
	
	?>
</head>
<body>
	<!-----------------------------------------------------------------------------------

	                      Primeiro Formulario de Cadastro de Gerente 
	
	------------------------------------------------------------------------------------->
		<div  class="formulario_cadastro" >	 
			<div class="cabecario_padrao"> 
				<span class="atualizar_pagina" title="clique para atualizar a página" onclick="document.location.reload(true);" >&#8635</span>	
				<span class="texto">Formulário Primeiro Gerente</span>   
			</div>    	   
			<form id="formulario" name="frmEnviaDados" class="form-horizontal" action="../php/cadastro_funcionario.php"  method="post" enctype="multipart/form-data" > 
				<div class="linha">
					<div class="col col-10" ><br>
						<div class="col col-1 n-vermelho" >* Nome 
					</div>
					<div class="col col-9"></div>
				</div>
				<div class="linha">
					<div class="col col-10">
						<div class="col col-5">
							<input class="input limpar_campo title p-cinco" inputmode="text" id="nomePrimeiroGerenete" name="nomePrimeiroGerente" autofocus type="text" min="5"  maxlength="50" value="" onkeyup="corrigirValor(this)" required />
						</div>
						<div class="col col-5"></div>
					</div>
				</div>		
				<div class="linha">
					<div class="col col-10"><br>
						<div class="col col-2 n-vermelho">* Data de Nascimento</div>	
						<div class="col col-3 t-vermelho">* Usuário</div>
					</div>
				</div> 
				<div class="linha">
					<div class="col col-10">
						<div class="col col-2">
							<input  class="limpar_campo input p-cinco" id="dataNascFunc" required name="data_nascimento" type="date" value="" />
						</div>
						<div class="col col-3">
							<input class="p-cinco texto-normal" type="text" id="primeiroUsuario" title="Digite um nome para usuário com até 20 caracteres"  name="primeiroUsuario" autocomplete="off"  maxlength="20" value="" required onkeyup="corrigirValor(this)" />     
						</div>	
						<div class="col col-5"></div>
					</div>
				</div> 
				<div class="linha">
					<div class="col col-10"><br>
						<div class="col col-5">
							<div class="col col-5">			  			
								<div class="n-vermelho" >* Senha - Mínimo oito caracteres, deve conter letra maiúscula, letra minuscula e número</div>			  			
							</div>
							<div class="col col-5 repita">			  			
								<div class="t-vermelho" >* Repita a senha</div>	
							</div>
						</div>
						<div class="col col-5"></div>
					</div>
				</div>
				<div class="linha">
					<div class="col col-5">
						<div class="col col-5">			  			
							<input type="password"  id="primeiraSenha" class="input p-cinco texto-normal" title="Senha deve conter pelo menos oito caracteres, letra maiúsculas, letra menúscula e número" name="primeiraSenha" maxlength="30" autocomplete="off" value="" required  /> 			  		 
						</div>
						<div class="col col-5">
							<input type="password" id="repitaPrimeiraSenha" class="input p-cinco texto-normal"  title="Repita o mesmo que digitou em Senha"  name="repitaPrimeiraSenha"  maxlength="30" autocomplete="off" value="" required  />   
						</div>
					</div>
				</div>
				<div class="linha">
					<div class="col col-10"><br></div>
				</div>
				<div class="linha">
					<div class="col col-10 div_rodape" >
					<button type="submit" class="botao" onclick="document.getElementById('enviar_cadastro').click();"><i class='fas fa-check'></i><span class='espaco'>CADASTRAR</span></button>	
						
					<input type="hidden" id="enviar_cadastro" value="CADASTRAR" name="primeiroGerente" onclick="return validarFormGerente()"/>	
						
						<button type="button" class="botao" onclick="mostrarOcultar()" id="ver_senha"><i class='fas fa-eye'></i><span class='espaco'>VER</span></button>		 						
					</div>
				</div>
			</form>
		</div>      	     		
	<script>
	function validarFormGerente(){
		let nomePrimeiroGerenete = document.getElementById('nomePrimeiroGerenete').value;
		let primeiroUsuario = document.getElementById("primeiroUsuario");
		let primeiraSenha = document.getElementById("primeiraSenha");
		let repitaPrimeiraSenha =  document.getElementById("repitaPrimeiraSenha");
		let tamanhoPrimeiraSenha = primeiraSenha.value.trim();
		let tamanhoRepitaPrimeiraSenha = repitaPrimeiraSenha.value.trim();
		let valida = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/;
		let dataInformada = document.getElementById('dataNascFunc').value;
		let nova = new Date(dataInformada);
		let idade = Math.floor((Date.now() - nova)/(31557600000));
		if(nomePrimeiroGerenete.length < 5 ){
			document.getElementById('nomePrimeiroGerenete').value = "";
			alert("O campo nome está com menos de cinco caracteres!");
			return false;
		};
		if((!parseInt(idade) && idade !=0) || idade < 0){
			alert("A data é inválida!");
			document.getElementById('dataNascFunc').value = "";
			return false;			
		}else if(idade <  14 || idade > 85){					
			alert(idade + " anos, Só cadastra com " + 14 + " até "+ 85 + " anos!");
			document.getElementById('dataNascFunc').value = "";
			return false;
		};
		if(primeiroUsuario.value.length < 5){
			alert("O nome de usuário deve ter pelo menos cinco caracteres!");
			document.getElementById("primeiroUsuario").value = "";
			return false;
		};
		if (tamanhoPrimeiraSenha.length < 8){
			document.getElementById("primeiraSenha").value ="";
			alert("A senha digitada tem menos de oito caracteres!");
			return false;
		}else{
			if (valida.exec(primeiraSenha.value) == null) {
				document.getElementById("primeiraSenha").value ="";
				alert("A senha precisa conter letra maiúscula, letra menúscula, e número!");
				return false;
			};
		};	
		if (tamanhoRepitaPrimeiraSenha.length < 8){
			document.getElementById("repitaPrimeiraSenha").value ="";
			alert("Repita a senha tem menos de oito caracteres!");
			return false;
		}else if(valida.exec(repitaPrimeiraSenha.value) == null) {
				document.getElementById("repitaPrimeiraSenha").value ="";
				alert("Repita a senha precisa conter letra maiúscula, letra menúscula, e número!");
				return false;
		}else if(primeiraSenha.value != repitaPrimeiraSenha.value){
			document.getElementById("repitaPrimeiraSenha").value = "";
			alert("As senhas digitadas são diferentes!");
			return false;		
		};
	};
	function mostrarOcultar() {
		var senha = document.getElementById("primeiraSenha");
		var repita =  document.getElementById("repitaPrimeiraSenha");
		let ver_senha = document.getElementById("ver_senha");
		if (senha.type === "password" || repita.type === "password"){
			senha.type = "text";
			repita.type = "text";
			ver_senha.innerHTML = "<i class='fas fa-eye-slash'></i><span class='espaco'>OCULTAR</span>";
		}else{
			senha.type = "password";
			repita.type = "password";
			ver_senha.innerHTML = "<i class='fas fa-eye'></i><span class='espaco'>VER</span>";
		}
		idadePrimeiroGerente();		
	};
	</script>
	<script src="../js/funcoes.js"></script>
</body>
</html>