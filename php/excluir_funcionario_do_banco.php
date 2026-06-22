<?php
require_once 'conexao.php';
@session_start();
if(empty($_SESSION['logado'])) {
	 unset ($_SESSION['logado']);
	 header('Location:../html/login.php');	  
 exit;
}	
// exclui o cadastro do banco
if((isset($_POST['confirmeSenha']))){

    $usuario = $_SESSION['logado'];
	$senha = $_POST['confirmeSenha'];
	$nulo = '';
	// pesquisa por usuario
	$query = $conexao->prepare("SELECT usuario, senha FROM funcionario WHERE excluiu = ? AND usuario = ? ");
	$query->execute([$nulo, $usuario]);
	$linha = $query->fetch();
	$row = $query->rowCount();
   
    if($row == 1) {

		$passdb = $linha['senha'];

        if(password_verify($senha, $passdb)){

            if((isset($_POST['excCad']))AND($_REQUEST['excCad']=='cadastro')){
                if(isset($_POST['codCad'])){
                    $codigo = $_POST['codCad'];

                    $sql = "DELETE FROM excluidos WHERE codigo IN(?)";
                    $stmt = $conexao->prepare($sql);
                    $stmt->execute([$codigo]);
                
                    $_SESSION["informacao"]="Toda informação sobre o cadastro foi excluído do banco";
                    header('Location:../html/home.php');
                    exit;
                }
            }
        }else{
            $_SESSION["informacao"]="Não foi possivel realizar o procedimento";
            header('Location:../html/home.php');
            exit;
        }
    
    }else{
        $_SESSION["informacao"]="Não foi possivel realizar o procedimento";
        header('Location:../html/home.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../estilo/index.css" />
    <link rel="stylesheet" type="text/css" href="../estilo/tema_escuro.css" />
    <title>Controle OS</title>
    <link href="../fonts/fontawesome-free-5.11.2-web/css/fontawesome.css" rel="stylesheet">
	<link href="../fonts/fontawesome-free-5.11.2-web/css/brands.css" rel="stylesheet">
	<link href="../fonts/fontawesome-free-5.11.2-web/css/solid.css" rel="stylesheet">
    <style>
        .usuario{
            position:relative;
            color:#fff;
            background:red;
            text-align:center;
            width:98%;
            left:1%;
            padding:10px 0;
            margin-top:20px;
            border-radius:4px;
        }
    </style>
</head>
<body>
    <?php if(((isset($_REQUEST['excluir']))AND(isset($_REQUEST['codigo']))AND(trim($_REQUEST['excluir'])=="cadastro"))OR(isset($_REQUEST['excluir']))AND(isset($_REQUEST['codigo']))AND(trim($_REQUEST['excluir'])=="funcionario")){;?>
        <div class="cabecario_padrao">             	  	            	  	    
            <a class="simbolo_padrao" href="../html/home.php">&times</a>
            <span class="simbolo_padrao atualizar_pagina" title="clique para atualizar a página" onclick="document.location.reload(true);" >&#8635</span>
            <span class="texto">EXCLUIR CADASTRO DO BANCO</span> 
        </div>
        <div class="formLogar">	                      
            <form id="formularioLogar" action="../php/excluir_funcionario_do_banco.php"  method="post" >
                <div class="usuario">			
                    <span>CONFIRME A SENHA PARA EXCLUIR</span>
                </div>					
                  <input type="hidden" name="excCad" value="<?php echo $_REQUEST['excluir'];?>">    
                  <input type="hidden" name="codCad" value="<?php echo $_REQUEST['codigo'];?>"> 
                  <div class="linha">
					<div class="col col-10" ><br></div>
				  </div>
                  <div class="linha">
					<div class="col col-10" >
						<div class="col col-1" >
						</div>	
                        <div class="col col-1" >	              
                            <i class="senha fas fa-unlock"></i>
                        </div>
                    </div>
                </div>
                <div class="linha">
						<div class="col col-10" ><br><br></div>
				  </div>
                <div class="linha">
					<div class="col col-1" >
					</div>
					<div class="col col-8" >
                        <input class="input_usuario" type="password" title="Digite aqui a senha do usuário"  id="password" name="confirmeSenha" placeholder="Digite a senha" maxlength="30" value="" required />
                    </div>
                    <div class="col col-1" >   
                        <span class="times-x"  title="Clique para limpar o campo Senha" onclick="document.getElementById('password').value='';">&times</span>					
                    </div>
                </div>
                <div class="linha">
                    <div class="col col-10" style="margin-top:38px" ></div>
                </div>
			    <div class="linha">
					<div class="col col-10 rodape_alterar_aparelho" >
						<div class="col col-1"></div>
                            <button type="button" class="botao" title="Clique para mostra ou oculta a senha" onclick="mostraOcultar2()"><i class="fas fa-eye"></i><span class="espaco">VER</span></button>				
                            <button type="submit" style="font-size:10px;" class="botao" title="Clique para confirmar a senha" onclick="document.getElementById('enviar').click();"><i class="fas fa-sign-in-alt"></i><span class="espaco">ENVIAR</button>
                            <input type="submit" class="sumido" id="enviar" />
                        </div>
                    </div>
                </div>
            </form>	
        </div>
        
        <script>
            // ver a senha
            var senha = document.getElementById("password");
            function mostraOcultar2() {
                if (senha.type === "password"){
                    senha.type = "text";
                }else{
                    senha.type = "password";
                }		
            };
        </script>
    <?php }else{
        header('Location:../html/home.php');
    };?>
</body>
</html>

