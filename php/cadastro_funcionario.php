<?php	
@session_start();
require_once '../php/conexao.php';

//require_once '../php/consulta.php';

require_once '../php/funcoes_php.php';
//print_r($_REQUEST);exit;
date_default_timezone_set('America/Fortaleza');

// manda o codigo para a página imprimir funcionario
if(isset($_POST['imprimir_cadastro'])){
	// pega o valor de duas variaveis e envia para outra página
	header('Location:../html/imprimir_funcionario.php?FuncCod='.$_REQUEST['codigo']."&Modo=individual");
	exit;
}

/****************************************************************************************
  
                             primeiro cadastro de gerente                                         
 
****************************************************************************************/

if((isset($_POST['primeiroGerente']))AND($_POST['primeiroGerente']=='CADASTRAR')){
	if((empty($_POST['primeiroUsuario']))AND(empty($_POST['primeiraSenha']))){	
	 	header('Location:../html/home.php');
	  	exit; 
	}
	$array= rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
	$nome           = $_POST['nomePrimeiroGerente'];
	$usuario           = menuscula(eliminaAcentos($_POST['primeiroUsuario']));
	$usuarioConfig     = $_POST['primeiroUsuario'];
	//$senha             = MD5($_POST['primeiraSenha']);
	$senha             = password_hash($_POST['primeiraSenha'], PASSWORD_DEFAULT);
	$nivel_acesso      = "gerente";
	$data_nascimento = $_POST['data_nascimento'];
	$data_cadastro  = date("Y-m-d");
	$barra_funcionario = $array;
	$ultimo_acesso = 'sim';
	$pagina = 5;
	$tema = "escuro";
	$letra = "LISTA GERAL";
	$ordenacao = "codigo";
	$ordem = "DESC";
	
	$sql = "INSERT INTO funcionario (nome, data_nascimento, usuario, senha, data_cadastro, barra_funcionario, nivel_acesso, ultimo_acesso, pagina, tema, letra, ordenacao, ordem) VALUES (:nome,:data_nascimento,:usuario,:senha,:data_cadastro,:barra_funcionario,:nivel_acesso,:ultimo_acesso,:pagina,:tema,:letra,:ordenacao,:ordem)";
	$stmt = $conexao->prepare($sql);
	$stmt->execute(['nome'=>$nome,'data_nascimento'=>$data_nascimento,'usuario'=>$usuario,'senha'=>$senha,'data_cadastro'=>$data_cadastro,'barra_funcionario'=>$barra_funcionario,'nivel_acesso'=>$nivel_acesso,'ultimo_acesso'=>$ultimo_acesso,'pagina'=>$pagina,'tema'=>$tema,'letra'=>$letra,'ordenacao'=>$ordenacao,'ordem'=>$ordem]);

	$id = 1;
	$sql = "UPDATE config SET usuario =:usuarioConfig WHERE codigo =:id"; 
	$stmt = $conexao->prepare($sql);
	$stmt->execute(['usuarioConfig'=>$usuarioConfig,'id'=>$id]);

	header('Location:../html/login.php');
	exit;
} 

/****************************************************************************************
  
                             alterar um cadastro                                         
 
****************************************************************************************/ 	

if(($_POST['enviar_cadastro']=="ALTERAR")AND(isset($_POST['codigo']))AND($_POST['codigo']== 1)){
	// se houver imagem carregada em imagem 1 ou imagem 2, faz a consulta
	if(($_FILES['img_funcionario']['name']<>"")OR($_FILES['img_funcionario2']['name']<>"")){
		$id = 1;
		$sqlImagem = $conexao->prepare("SELECT * FROM funcionario WHERE codigo = ? ");
		$sqlImagem->execute([$id]);	
		$linhaImagem = $sqlImagem->fetch();
	}
	// se houver imagem carregada em imagem 1 entra aqui	
	if($_FILES['img_funcionario']['name']<>""){
		if($linhaImagem['foto_funcionario']<>""){
			$foto_funcionario = $linhaImagem['foto_funcionario'];
	 	}else{
	 		$foto_funcionario = md5(microtime()).'.jpg';
	 	}
	
		$id = 1;
   		$sql = "UPDATE funcionario SET foto_funcionario = ? WHERE codigo = ? "; 
		$stmt = $conexao->prepare($sql);
		$stmt->execute([$foto_funcionario, $id]);
	
		$foto_name=$_FILES['img_funcionario']['tmp_name'];
		move_uploaded_file($foto_name,"../imagem_funcionario/$foto_funcionario");	
	}
	// se houver imagem carregada em imagem 1 entra aqui	
	if($_FILES['img_funcionario2']['name']<>""){
		if($linhaImagem['foto_funcionario2']<>""){
			$foto_funcionario2 = $linhaImagem['foto_funcionario2'];
	 	}else{
	 		$foto_funcionario2 = md5(microtime()).'.jpg';
	 	}
		
		$id = 1;
   		$sql = "UPDATE funcionario SET foto_funcionario2 = ? WHERE codigo = ? "; 
		$stmt = $conexao->prepare($sql);
		$stmt->execute([$foto_funcionario2, $id]);

		$foto_name2=$_FILES['img_funcionario2']['tmp_name'];
		move_uploaded_file($foto_name2,"../imagem_funcionario/$foto_funcionario2");	
	}
   	if($_SESSION['maiuscula']=="sim"){
	   $nome             = tirarAcentos($_POST['nome']);
	   $endereco         = tirarAcentos($_POST['endereco']);
	   $obs              = tirarAcentos($_POST['obs']);
	   $bairro           = tirarAcentos($_POST['bairro']);
	   $cidade           = tirarAcentos($_POST['cidade']);
	}else if($resultado['sem_acento']<>0){
		$nome             = eliminaAcentos($_POST['nome']);
		$endereco         = eliminaAcentos($_POST['endereco']);
		$obs              = eliminaAcentos($_POST['obs']);
		$bairro           = eliminaAcentos($_POST['bairro']);
		$cidade           = eliminaAcentos($_POST['cidade']);
   	}else{
	   $nome             = $_POST['nome'];
	   $endereco         = $_POST['endereco'];
	   $obs              = $_POST['obs'];
	   $bairro           = $_POST['bairro'];
	   $cidade           = $_POST['cidade'];
   	}
   	$numero            = tirarAcentos($_POST['numero']);
   	$telefone          = $_POST['telefone'];
   	$telefone2         = $_POST['telefone2'];
	// impede que seja cadastrado o telefone 2, antes do telefone 1
	if (($_POST['telefone']=="")AND($_POST['telefone2']<>"")){
   		$telefone         = $_POST['telefone2'];
    	$telefone2        = "";
   	}
   	$data_nascimento   = $_POST['data_nascimento'];
   	$email             = $_POST['email'];  
   	$cpf               = retMascara($_POST['cpf']);
   	// excluir foto funcionario
   	if ((isset($_POST['excluir-foto-funcionario1']))OR(isset($_POST['excluir-foto-funcionario2']))) {
		$id = 1;
		$sqlfoto = $conexao->prepare("SELECT foto_funcionario, foto_funcionario2 FROM funcionario WHERE codigo = ?");
		$sqlfoto->execute([$id]);
		$linhafoto = $sqlfoto->fetch();

		if (isset($_POST['excluir-foto-funcionario1'])){
			$foto1 = $linhafoto['foto_funcionario'];
			$branco= "";
			$pasta ="../imagem_funcionario/";
			unlink($pasta.$foto1);

			$id = 1;
   			$sql = "UPDATE funcionario SET foto_funcionario = ? WHERE codigo = ? "; 
			$stmt = $conexao->prepare($sql);
			$stmt->execute([$branco, $id]);

		};
		if (isset($_POST['excluir-foto-funcionario2'])){
			$foto2 = $linhafoto['foto_funcionario2'];
			$branco= "";
			$pasta ="../imagem_funcionario/";
			unlink($pasta.$foto2);

			$id = 1;
   			$sql = "UPDATE funcionario SET foto_funcionario2 = ? WHERE codigo = ? "; 
			$stmt = $conexao->prepare($sql);
			$stmt->execute([$branco, $id]);

		};
	};
	$pagina = $_POST['pagina'];	
	if ($_POST['pagina'] < 5)  {
		$pagina = 5;
	};
	if ($_POST['pagina'] > 14)  {
		$pagina = 14;
	};
	if ($_POST['pagina'] > 100) {
		$pagina = 100;
	};
	if (isset($_POST['tema'])) {
		$tema ="claro";	
	}else{
		$tema ="escuro";	
	};
	if (isset($_POST['protegido'])) {
		$protegido ="sim";	
	}else{
		$protegido ="";	
	};
	if (isset($_POST['semCronometro'])) {
		$semCronometro ="sim";
	}else{
		$semCronometro ="";
	}	
	if (isset($_POST['funcLogado'])) {
		$funcLogado = "1";
	}else{
		$funcLogado = "0";
	}
	$ordenacao = $_POST['coluna'];
	$ordem = $_POST['ordem'];
	 
	$id = 1;
	$sql = "UPDATE funcionario 
	SET nome =:nome, endereco =:endereco, obs =:obs, bairro =:bairro, tentativa =:tentativa,
	cidade =:cidade, numero =:numero, telefone =:telefone, data_nascimento =:data_nascimento, 
	email =:email, cpf =:cpf, telefone2 =:telefone2, pagina =:pagina, protegido =:protegido, 
	tema =:tema, semCronometro =:semCronometro, ordenacao =:ordenacao, ordem =:ordem  WHERE codigo =:id"; 
	$stmt = $conexao->prepare($sql);
	$stmt->execute(['nome'=>$nome, 'endereco'=>$endereco, 'obs'=>$obs, 'bairro'=>$bairro, 'tentativa'=>$tentativa,
	'cidade'=>$cidade, 'numero'=>$numero, 'telefone'=>$telefone, 'data_nascimento'=>$data_nascimento, 
	'email'=>$email, 'cpf'=>$cpf, 'telefone2'=>$telefone2, 'pagina'=>$pagina, 'protegido'=>$protegido, 
	'tema'=>$tema, 'semCronometro'=>$semCronometro, 'ordenacao'=>$ordenacao, 'ordem'=>$ordem, 'id'=>$id]);

	// COM TODAS AS INFORMAÇÕES JÁ ALTERADAS NA ARRAY,AGORA É FEITA A ALTERAÇÃO NO BANCO MYSQL, CONFERIDA A CONEXÃO, TODAS AS INFORMAÇÕES DA ARRAY $sql É ENVIADA NA SEQUÊNCIA DOS CÓDIGOS DIGITADOS.  
	//SE TUDO CORRER BEM, O CÓDIGO AVANÇA PARA AS PRÓXIMAS LINHAS, CASO CONTRÁRIO, EXIBE UMA MENSAGEM DE ERRO, ONDE INFORMA ALGUMA COISA ERRADA RELACIONADA COM A CONEXÃO, OU COM AS ALTERAÇÕES.
   
    $_SESSION["informacao"]="Dados pessoais foi alterado";
     header('Location:backup.php');
	exit;   
    // Fim de alterar um cadastro //  
};
?> 