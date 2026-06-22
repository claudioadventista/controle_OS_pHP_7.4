<?php
@session_start();
require_once '../php/conexao.php';
// lista o numero de funcionarios cadastrados **********

$idConfig = 1;
$sql_config = $conexao->prepare("SELECT * FROM config WHERE codigo = ?");
$sql_config->execute([$idConfig]);
$resultado = $sql_config->fetch();

$nulo ='';
$listaFuncionario = $conexao->prepare("SELECT codigo FROM funcionario WHERE excluiu = ?");
$listaFuncionario->execute([$nulo]);
$funcionario = $listaFuncionario->fetch();
$totalFuncionario = $listaFuncionario->rowCount();

// se não houver nenhum funcionario, manda para o cadstro do primeiro gerente
if($totalFuncionario == 0){
	unset ($_SESSION['logado']);
	header('Location:cadastro_funcionario2.php');
}
// registra uma nova senha do funcionario **********
if(isset($_POST['novaSenha'])){

	$novaSenha = $_POST['novaSenha'];
	$RepitaNovaSenha = $_POST['repitaNovaSenha'];

	$codigo = $_POST['codigoFuncionario'];

	if($novaSenha <> $RepitaNovaSenha){			
		$_SESSION['info'] ="<span class='info-negativo'>Senhas diferentes</span>";	
?>
<script>
	document.getElementById('formLogoar').style.display='block';
</script>
<?php
	}else{
		//$novaSenha  = MD5($_POST['novaSenha']);
		$novaSenha = password_hash($_POST['novaSenha'], PASSWORD_DEFAULT);

		$sql = "UPDATE funcionario SET senha = ? WHERE codigo = ?";
		$stmt = $conexao->prepare($sql);
		$stmt->execute([$novaSenha, $codigo]);

		$_SESSION['info'] ="<span class='info-negativo info-positivo'>A senha foi alterada com sucesso!</span>";	
?>
		<script>
			document.getElementById('formLogoar').style.display='block';
		</script>
<?php
	}
}
//valida o funcionario a ser logado
// se houver um post usuario valido, entra aqui
if(isset($_POST['usuario'])){
	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];
	$nulo = '';
	// pesquisa por usuario
	$query = $conexao->prepare("SELECT * FROM funcionario WHERE excluiu = ? AND usuario = ?");
	$query->execute([$nulo, $usuario]);
	$linha = $query->fetch();
	$row = $query->rowCount();
	
	// se o resultado for igual a 1, entra aqui
	if($row == 1) {
	//  while($linha = $query->fetch(PDO::FETCH_ASSOC)) {
			// usuario do banco
			$userdb = $linha['usuario'];
			// senha do banco, criptografada
			$passdb = $linha['senha'];
			// verifica a senha que veiu do formulario, com a senha do banco
			if(password_verify($senha, $passdb)){
				// se for confirmada a senha, entra na validacao do usuario
				$id = 1;
				$queryConfig = $conexao->prepare("SELECT sem_tecnico, sem_atendente FROM config WHERE codigo = ?");
				$queryConfig->execute([$id]);
				$resultConfig = $queryConfig->fetch();
				// valida o acesso do tecnico ao sistema
				if(($linha['nivel_acesso'] == 'tecnico')AND($resultConfig['sem_tecnico'] == 0)){
					$_SESSION['info'] ="<span class='info-negativo'>Não é permitido tecnico logar no sistema</span>";
					header("Location:login.php");
					exit;
				};
				// valida o acesso do atendente ao sistema
				if(($linha['nivel_acesso'] == 'atendente')AND($resultConfig['sem_atendente'] == 0)){
					$_SESSION['info'] ="<span class='info-negativo'>Não é permitido atendente logar no sistema</span>";
					header("Location:login.php");
					exit;
				};
				// busca no banco pra ver se o funcionario esta logado
				$tentativaLogin = $linha['tentativa'];
				/* 
				ultimo_acesso com sim e igual a Liberar Login Multiplo marcado,
				ultimo_acesso em branco e igual a Liberar Login Multiplo desmarcado
				tentativa com 1 igual a funcionario logado marcado,
				tentativa com 0 e igual a funcionario logado desmarcado.
				*/	
				// se login multiplo estiver marcado...
				if($linha['ultimo_acesso']=="sim"){
					// ...o funcionario sera deslogado, mesmo que estava logoado no banco
					$tentativaLogin = '0';
				}
				// depois de validado, se funcionario encontrado estiver deslogado, entra aqui 
				if($tentativaLogin == '0'){
					// pega o valor do codigo do funcionario encontrado
					$codigo = $linha['codigo'];
					// verifica se o campo acesso esta em branco, ou com zero 0
					if(($linha['acesso']=="")OR($linha['acesso']==0)){
						// se for zero, ou em branco, coloca o valor como primeiro acesso na 'session acesso'
						$_SESSION['acesso']=1;
					}else{
						// se ja tiver acessado o sistema, soma com mais um acesso e coloca na 'session acesso
						$_SESSION['acesso']=$linha['acesso']+1;
					}
					// acesso recebe o valor do banco e acrescenta mais um, para a proxima vez que logar
					$acesso = $linha['acesso']+1;
					// muda o numero de acesso no banco, e muda o valor de tentativa para 1, ou seja, para logado 
					$id = 1;
					$sql = "UPDATE funcionario SET acesso = ?, tentativa = ? WHERE codigo = ?"; 
					$stmt = $conexao->prepare($sql);
					$stmt->execute([$acesso, $id, $id]);

					// com o funcionario logado, pega as informacoes necessarias, e coloca nas sessions
					$_SESSION['logado'] = $_POST['usuario'];
					$_SESSION['nivel'] = $linha['nivel_acesso'];
					$_SESSION['protegido'] = $linha['protegido'];
					$_SESSION['cont'] = 0;
					
					$_SESSION['barra_funcionario'] = $linha['barra_funcionario'];
					$_SESSION['controle'] = $codigo;
					
				}else{
					$_SESSION['info'] = "<span class='info-negativo'>Usuário já está logado</span>";	
					unset ($_SESSION['logado']);
					//header("Location:home.php");
					//exit;
				}		
				header("Location:home.php");
				exit;
			}else{
				$_SESSION['info'] ="<span class='info-negativo'>Usuário ou senha inválido</span>";	
				unset ($_SESSION['logado']);
			}
	//  }	fechamento do while
	}else{
		// se for encontrado mais de um usuario e senha informadas, 
		// ou se não encontrar nenhum funcionario, com a senha informada, entra aqui
		$_SESSION['info'] ="<span class='info-negativo'>Usuário ou senha inválido</span>";	
		unset ($_SESSION['logado']);	
	};
};
?>
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
		<link rel="stylesheet" type="text/css" href="../estilo/index.css" />
		
		<link href="../fonts/fontawesome-free-5.11.2-web/css/fontawesome.css" rel="stylesheet">
		<link href="../fonts/fontawesome-free-5.11.2-web/css/brands.css" rel="stylesheet">
		<link href="../fonts/fontawesome-free-5.11.2-web/css/solid.css" rel="stylesheet">
		<style>
			.info-negativo{
				position:relative;
				color:red;
				top:-55px;
			}
			.info-positivo{
				color:blue;
			}
			#loga{
				position:absolute;
				font-size:12px;
				color:#f55;
				top:5px;
				text-align: center;
				text-transform:uppercase;
				padding: 5px 0; 
				width:100%;
				display:none;
			}
			.texto-nova-senha{
				margin-left:70px;
				font-size:12px;
				letter-spacing:2px;
			}
			.texto-repita-senha{
				position:relative;
				margin-left:70px;
				font-size:12px;
				letter-spacing:2px;
				top:19px;
			}
			/*
			.texto-digite-usuario{
				position:relative;
				left:15px;
				top:19px;
				font-size:12px;
				letter-spacing:2px;
			}
			*/
			.texto-login{
				font-size:12px;
				letter-spacing:2px;
			}
			/*
			.digite-senha{
				position:relative;
				left:15px;
				top:36px;
				font-size:12px;
				letter-spacing:2px;
			}
			*/
			#simbolo-padrao{
				visibility : hidden;
			}
		</style>
	</head>
	<body>
		<div class="container">	
			<div class="cabecario_padrao">
				<a id="simbolo-padrao" href="login.php" class="simbolo_padrao">&times</a>
				<span class="simbolo_padrao atualizar_pagina" title="clique para atualizar a página" onclick="document.location.reload(true);" >&#8635</span>
				<b>    
					<span  id="texto_login" class="texto"></span>  
				</b>
			</div> 		
			<?php 
			if(isset($_POST['recuperaUsuario'])){
				$nulo = '';
				$recuperaNome = $_POST['recuperaNome'];
				$recuperaUsuario = $_POST['recuperaUsuario'];
				$recuperaData = $_POST['recuperaData'];
				$recuperaCpf = $_POST['recuperaCpf'];
				$recuperaBarra = $_POST['recuperaBarra'];

				$idConfig = 1;
				$sql_config = $conexao->prepare("SELECT * FROM funcionario WHERE excluiu = ? AND cpf = ? AND nome = ? AND usuario = ? AND data_nascimento = ? AND barra_funcionario = ?");
				$sql_config->execute([$nulo, $recuperaCpf, $recuperaNome, $recuperaUsuario, $recuperaData, $recuperaBarra]);
				$linha = $sql_config->fetch();
				$row = $sql_config->rowCount();

				if($linha){
					$codigoFuncionario = $linha['codigo'];
				}else{
					$codigoFuncionario = null;
				}
				

				if($row == 1) {;?>
					<!-- 
					
					********** Formulário para Nova Senha **********
				
					--> 
					<div class="formLogar" id="form_nova_senha" >	
						<script>
							document.getElementById('texto_login').innerText = 'Formulário para nova senha';
							document.getElementById('simbolo-padrao').style.visibility = 'visible';
						</script>	
								 			
						<form id="formulario_novaSenha" action="login.php"  method="post" >
							<input type="hidden" name="codigoFuncionario" value="<?php echo $codigoFuncionario;?>">
							<div class="linha">
								<div class="col col-10" ><br></div>
							</div>	
							<div class="linha">
								<div class="col col-10" >
									<div class="col col-1" ></div>		
									<div class="col col-8" >
										<i class="usuario fas fa-key" ></i>
									</div>
									<span class="texto-nova-senha" >Digite a Nova Senha</span>
								</div>
							</div>	
							<div class="linha" >
								<div class="col col-10" >
									<div class="col col-1" ></div>
									<div class="col col-8" >
										<input id="campoNovaSenha" class="input_usuario" title="Digite aqui a nova senha"  name="novaSenha" type="password" placeholder="Digite a nova senha" autocomplete="off" maxlength="50" autofocus />
									</div>
									<div class="col col-1" >	
										<span class="times-x"  title="Clique para limpar o campo Nova Senha" onclick="document.getElementById('campoNovaSenha').value='';">&times</span>					
									</div>
								</div>
							</div>
							<div class="linha">
								<div class="col col-10" ></div>
							</div>
							<div class="linha">
								<div class="col col-10" >
									<div class="col col-1" ></div>
									<div class="col col-8" >					
										<i class="senha fas fa-envelope" ></i>
									</div>
									<span class="texto-repita-senha" >Repita a Senha</span>
								</div>
							</div>
							<div class="linha">
								<div class="col col-10" > <br></div>
							</div>
							<div class="linha">
								<div class="col col-10" >
									<div class="col col-1" >
									</div>
									<div class="col col-8" >						
										<input id="campoRepitaNovaSenha" class="input_usuario" title="Repita a qui a nova senha" name="repitaNovaSenha" type="password" placeholder="Repita a nova senha" autocomplete="off" maxlength="30"autofocus />
									</div>
									<div class="col col-1" >	
										<span class="times-x"  title="Clique para limpar o campo Repita a Senha" onclick="document.getElementById('campoRepitaNovaSenha').value='';">&times</span>
									</div>
								</div>
							</div>
							<div class="linha">
								<div class="col col-10" style="margin-top:24px" ></div>
							</div>
							<div class="linha">
								<div class="col col-10 rodape_alterar_aparelho" >
									<div class="col col-1"></div>
									<button type="button" class="botao" title="Clique para mostrar ou ocultar a senha" onclick="mostraOcultarNovaSenha()"><i class="fas fa-eye"></i><span class="espaco">VER</span></button>				
									<button type="button" class="botao" title="Clique para cadastar a nova senha"  onclick="document.getElementById('Recuperaenviar').click();return conta_nova_senha()" ><i class="fas fa-sign-in-alt"></i><span class="espaco">CADASTRAR</span></button>
									<input type="submit" class="sumido" id="Recuperaenviar" value="" />
									<!--<a href="login.php" class="simbolo_padrao" style="top:6px;left:8px;"  title="Clique para cancelar a operação" onclick="document.getElementById('campoRepitaNovaSenha').value='';">&times</a>-->
								</div>
							</div>
						</form>
					</div>
				<?php	
				}else{
					unset($_POST['recuperaUsuario']);
					$_SESSION['info'] ="<span class='info-negativo'>Não foi possível recuperar a senha</span>";	?>
				<?php	
				};
			}
			/* 
			
			********** Formulário de login **********
			
			*/
			if(empty($_POST['recuperaUsuario'])){
			?>
				<div class="formLogar" id="formLogoar">
					<script>
						document.getElementById('texto_login').innerText = 'Login do sistema Controle O.S.';
					</script>					 			
					<form id="formularioLogar" action="login.php"  method="post" autocomplete="off" >
						<?php if(isset($_SESSION['info'])){; ?> 
							<style>#loga{display:block;}</style>
							<div id="loga" ><?php echo $_SESSION['info']; unset($_SESSION['info']); ?></div>	
						<?php }; ?>	
						<div class="linha">
							<div class="col col-10" ><br></div>
						</div>	
						<div class="linha">
							<div class="col col-10" >
								<div class="col col-1" ></div>		
								<div class="col col-8" >
									<i class="usuario fas fa-user" ></i>
									<span class="texto-digite-usuario" >Digite o usuário</span>
								</div>
							</div>
						</div>	
						<div class="linha">
							<div class="col col-10" ><br></div>
						</div>
						<div class="linha">
							<div class="col col-10" >
								<div class="col col-1" >
								</div>
								<div class="col col-8" >						
									<input class="input_usuario" id="loginUsuario" title="Digite aqui o nome do usuário" name="usuario" type="text" placeholder="Digite o usuário" autocomplete="username" maxlength="30" required autofocus />
								</div>
								<div class="col col-1" >
									<span  class="times-x" title="Clique para limpar o campo Usuário" onclick="document.getElementById('loginUsuario').value='';document.getElementById('loginUsuario').focus()">&times</span>
								</div>
							</div>
						</div>	
						<div class="linha">
							<div class="col col-10" ></div>
						</div>
						<div class="linha">
							<div class="col col-10" >
								<div class="col col-1" >
								</div>
								<div class="col col-8" >					
									<i class="senha-login fas fa-unlock" ></i>
									<span class="digite-senha" >Digite a senha</span>
								</div>
							</div>
						</div>
						<div class="linha">
							<div class="col col-10" > <br><br></div>
						</div>
						<div class="linha">
							<div class="col col-1" ></div>
							<div class="col col-8">
								<input type="password" class="input_usuario" title="Digite aqui a senha do usuário" id="pass" name="senha" placeholder="Digite a senha" maxlength="30" autocomplete="new-password" value="" required />
							</div>
							<div class="col col-1" >	
								<span class="times-x"  title="Clique para limpar o campo Senha" onclick="document.getElementById('pass').value='';document.getElementById('pass').focus();">&times</span>					
							</div>
						</div>
						<div class="linha">
							<div class="col col-10" style="margin-top:24px" ></div>
						</div>
						<div class="linha" >
							<div class="col col-10 rodape_alterar_aparelho" >
							<div class="col col-1" ></div>
								<button type="button" class="botao" title="Clique para mostra ou oculta a senha" onclick="mostraOcultar()"><i class="fas fa-eye"></i><span class="espaco">VER</span></button>				
								<button type="submit" class="botao" title="Clique para fazer o login no sistema" onclick="document.getElementById('enviar').click();servidor();" ><i class="fas fa-sign-in-alt" ></i><span class="espaco">ENTRAR</span></button>
								<input type="submit" class="sumido" id="enviar"  />
							</div>
						</div>
					</form>
					<div class="linha" >
						<div class="col col-10" >
							<div id="esqueci_a_senha" title="Clique para abrir o formulário de recuperação da senha"  class="esqueci_a_senha" onclick="
								document.getElementById('form_recuperar_senha').style.display='block';
								document.getElementById('esqueci_a_senha').style.display = 'none';
								document.getElementById('formLogoar').style.display = 'none';
								document.getElementById('simbolo-padrao').style.visibility = 'visible';
								document.getElementById('texto_login').innerText = 'Formulário para Recuperar a Senha';">
								<span style="font-size:12px; letter-spacing:2px;">Clique aqui para Recuperar a Senha</span> 
							</div> 	
						</div>
					</div>
				</div>
			<?php 
			}; 
			?>
			<!-- 
				
			********** Formulário para Recuperar a Senha **********

			-->
			<div class="formRecuperarSenha sumido" id="form_recuperar_senha" >				 			
				<form id="formulario_recuperacao" action="login.php"  method="post" >
					<div class="linha">
						<div class="col col-10" ><br><br>
							<div class="col col-1" >
							</div>
							<div class="col col-8" >		
								<span class="texto-login" >Nome completo</span>
							</div>
						</div>
					</div>
					<div class="linha">
						<div class="col col-10" >
							<div class="col col-1" >
							</div>
							<div class="col col-8" >						
								<input class="input_usuario"  title="Digite aqui o nome completo" name="recuperaNome" type="text" placeholder="Digite o nome completo" autocomplete="off" maxlength="30" required autofocus />
							</div>
						</div>
					</div>
					<div class="linha">
						<div class="col col-10" ><br>
							<div class="col col-1" >
							</div>
							<div class="col col-8" >			
								<span class="texto-login">Usuário</span>
							</div>
						</div>
					<div class="linha">
						<div class="col col-10" >
							<div class="col col-1" >
							</div>
							<div class="col col-8" >							
								<input id="recuperaUsuario" class="input_usuario" title="Digite aqui a nome do usuário" name="recuperaUsuario" type="text" placeholder="Digite o nome de usuário" autocomplete="off" maxlength="30" required autofocus />
							</div>
						</div>
					</div>
					<div class="linha">
						<div class="col col-10" ><br>
							<div class="col col-1" >
							</div>
							<div class="col col-8" >
								<span class="texto-login">Data de nascimento</span>
							</div>
						</div>
					</div>
					<div class="linha">
						<div class="col col-10" >
							<div class="col col-1" >
							</div>
							<div class="col col-8" >					
								<input class="input_usuario" title="Digite aqui a data de nascimento" name="recuperaData" type="date" autocomplete="off" maxlength="30" required autofocus />
							</div>
						</div>
					</div>
					<div class="linha">
						<div class="col col-10" ><br>
							<div class="col col-1" >
							</div>
							<div class="col col-8" >
								<span class="texto-login">CPF</span>
							</div>
						</div>
					</div>
					<div class="linha">
						<div class="col col-10" >
							<div class="col col-1" >
							</div>
							<div class="col col-8" >						
								<input class="input_usuario" title="Digite aqui o cpf, se hover sido cadastrado" name="recuperaCpf" type="text" placeholder="Digite o CPF" autocomplete="off" maxlength="11" autofocus  onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
							</div>
						</div>
					</div>
					<div class="linha">
						<div class="col col-10" ><br>
							<div class="col col-1" >
							</div>
							<div class="col col-8" >	
								<span class="texto-login">Código de barra</span>
							</div>
						</div>
					</div>
					<div class="linha">
						<div class="col col-10" >
							<div class="col col-1" >
							</div>
							<div class="col col-8" >						
								<input class="input_usuario" title="Digite aqui o código de barra" name="recuperaBarra" type="text" placeholder="Digite o código de barra" autocomplete="off" maxlength="10" required autofocus  onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
							</div>
						</div>
					</div>
					<div class="linha">
						<div class="col col-10" style="margin-top:10px" ></div>
					</div>			
					<div class="linha" >
						<div class="col col-10 rodape_alterar_aparelho" >
							<div class="col col-1" >
							</div>
							<button type="submit" class="botao" title="Clique para verificar as informações" for="Recuperaenviar" ><i class="fas fa-sign-in-alt"></i><span class="espaco">VERIFICAR</span></button>
							<input type="submit" class="sumido" id="Recuperaenviar" />
						</div>
					</div>	
				</form>	
			</div>
			<script>
				var senha = document.getElementById("pass");
				var novaSenha =  document.getElementById("campoNovaSenha");
				var repitaNovaSenha = document.getElementById("campoRepitaNovaSenha");
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
				function mostraOcultarNovaSenha(){
					if (novaSenha.type === "password"){
						novaSenha.type = "text";
						repitaNovaSenha.type = "text";
					}else{
						novaSenha.type = "password";
						repitaNovaSenha.type = "password";
					}	
				}
				/*
				function limpaRecupera(){
					var formRetorno = document.getElementById('formulario_recuperacao');
					var formLogar = document.getElementById('formularioLogar');
					
					formRetorno.reset();
					formLogar.reset();
					document.getElementById('loga').innerText ="";
				}
				*/
				function conta_nova_senha() {
					let novaSenha = document.getElementById("campoNovaSenha");
					let tamanho = novaSenha.value.trim();
					let repitaNovaSenha = document.getElementById("campoRepitaNovaSenha");
					let novoTamanho = repitaNovaSenha.value.trim();
					let valida = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/;
					if (tamanho.length < 8){
						document.getElementById("campoNovaSenha").value ="";
						alert("A senha digitada em Nova Senha, tem menos de oito caracteres!");
						document.location.reload(true);
						return false;	
					}else{			
						if (valida.exec(novaSenha.value) == null) {
							document.getElementById("campoNovaSenha").value ="";
							alert("A Nova Senha precisa conter letra maiúscula, letra menúscula, e número!");
							document.location.reload(true);
							return false;
						};
					};	
					if (novoTamanho.length < 8){
						document.getElementById("campoRepitaNovaSenha").value ="";
						alert("A senha digitada em Repita Senha, tem menos de oito caracteres!");
						document.location.reload(true);
						return false;			
					}else{					
						if (valida.exec(repitaNovaSenha.value) == null) {
							document.getElementById("campoRepitaNovaSenha").value ="";
							alert("Repita a Senha precisa conter letra maiúscula, letra menúscula, e número!");
							document.location.reload(true);
							return false;
						};
					};	
					if(tamanho !=  novoTamanho){
						alert("A senha digitada são diferentes!");
						document.location.reload(true);
						return false;
					}else{
						return true;
					}
				};	
			</script>
		</div> 
	</body>
</html>