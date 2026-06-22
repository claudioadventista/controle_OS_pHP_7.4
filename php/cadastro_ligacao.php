<?php	
require_once '../php/consulta.php';	
require_once '../php/funcoes_php.php';
$codigo = $_POST['codigoLigar'];
@session_start();
if(empty($_SESSION['logado'])) {
	 unset ($_SESSION['logado']);
	 header('Location:../html/login.php');	  
 exit;
}	
// pega o horário atual de são paulo
date_default_timezone_set('America/Fortaleza');	

$sqlTelefone = $conexao->prepare("SELECT * FROM cliente WHERE codigo = ? ");
$sqlTelefone->execute([$codigo]);
$linha = $sqlTelefone->fetch();
$totalEncontrado = $sqlTelefone->rowCount();

// escolhe o telefone que foi selecionado para ligar
if((isset($_POST['ligar']))AND($_POST['ligar'] == "telefone1")){
	$telefone_ligado = $linha['telefone'];
};		
if((isset($_POST['ligar']))AND($_POST['ligar'] == "telefone2")){
	$telefone_ligado = $linha['telefone2'];
}; 	
if((empty($_POST['ligar']))AND(isset($_POST['outro_telefone']))AND($_POST['outro_telefone']<>"")){
	$telefone_ligado = $_POST['outro_telefone'];
};
if (empty($telefone_ligado)){
	$_SESSION["informacao"]="Cadastro de ligação faltou o telefone";
    header('Location:../html/home.php');
	exit;
};		
// pega a data atual
$data_ligacao = date("Y-m-d");
// pega o horário atual
$hora_ligacao = date('H:i:s');
$quem_ligou = retiraEspaco(menuscula(eliminaAcentos($_POST['quem_ligou'])));		
if ((empty($quem_ligou))OR(trim($quem_ligou)=="")){
	$_SESSION["informacao"]="Cadastro de ligação faltou quem ligou";
    header('Location:../html/home.php');
	exit;
};
// escolhe se atendeu ou não
if(isset($_POST['atendeu'])){
	$atendeu = "sim";
	$quem_atendeu = retiraEspaco(menuscula(eliminaAcentos($_POST['quem_atendeu'])));
}else{
	$atendeu = "";
	$quem_atendeu = "";
};	   
 
// altera o ligação 1
if($linha['telefone_ligado1']==""){

	$sql = "UPDATE cliente SET telefone_ligado1 = ?, atendeu1 = ?, data_ligacao1 = ?, hora_ligacao1 = ?, quem_ligou1 = ?, quem_atendeu1 = ? WHERE codigo = ? "; 
	$stmt = $conexao->prepare($sql);
	$stmt->execute([$telefone_ligado, $atendeu, $data_ligacao, $hora_ligacao, $quem_ligou, $quem_atendeu, $codigo]);

	$_SESSION["informacao"]="Cadastro de ligação 1 foi alterado";
	 header('Location:backup.php');
	exit;
};   
// altera o ligação 2  
if(($linha['telefone_ligado1']<>"")AND($linha['telefone_ligado2']=="")){		   
	
	$sql = "UPDATE cliente SET telefone_ligado2 = ?, atendeu2 = ?, data_ligacao2 = ?, hora_ligacao2 = ?, quem_ligou2 = ?, quem_atendeu2 = ? WHERE codigo = ? "; 
	$stmt = $conexao->prepare($sql);
	$stmt->execute([$telefone_ligado, $atendeu, $data_ligacao, $hora_ligacao, $quem_ligou, $quem_atendeu, $codigo]);

	$_SESSION["informacao"]="Cadastro de ligação 2 foi alterado";
	 header('Location:backup.php');
	exit;
};   
// altera o ligação 3
if(($linha['telefone_ligado2']<>"")AND($linha['telefone_ligado3']=="")){		   

	$sql = "UPDATE cliente SET telefone_ligado3 = ?, atendeu3 = ?, data_ligacao3 = ?, hora_ligacao3 = ?, quem_ligou3 = ?, quem_atendeu3 = ? WHERE codigo = ? "; 
	$stmt = $conexao->prepare($sql);
	$stmt->execute([$telefone_ligado, $atendeu, $data_ligacao, $hora_ligacao, $quem_ligou, $quem_atendeu, $codigo]);

	$_SESSION["informacao"]="Cadastro de ligação 3 foi alterado";
	 header('Location:backup.php');
	exit;	
};
// altera o ligação 4
if(($linha['telefone_ligado3']<>"")AND($linha['telefone_ligado4']=="")){		   
	
	$sql = "UPDATE cliente SET telefone_ligado4 = ?, atendeu4 = ?, data_ligacao4 = ?, hora_ligacao4 = ?, quem_ligou4 = ?, quem_atendeu4 = ? WHERE codigo = ? "; 
	$stmt = $conexao->prepare($sql);
	$stmt->execute([$telefone_ligado, $atendeu, $data_ligacao, $hora_ligacao, $quem_ligou, $quem_atendeu, $codigo]);
	
	$_SESSION["informacao"]="Cadastro de ligação 4 foi alterado";
	 header('Location:backup.php');
	exit;
};   
// altera o ligação 5
if(($linha['telefone_ligado4']<>"")AND($linha['telefone_ligado5']=="")){		   
	
	$sql = "UPDATE cliente SET telefone_ligado5 = ?, atendeu5 = ?, data_ligacao5 = ?, hora_ligacao5 = ?, quem_ligou5 = ?, quem_atendeu5 = ? WHERE codigo = ? "; 
	$stmt = $conexao->prepare($sql);
	$stmt->execute([$telefone_ligado, $atendeu, $data_ligacao, $hora_ligacao, $quem_ligou, $quem_atendeu, $codigo]);

	$_SESSION["informacao"]="Cadastro de ligação 5 foi alterado";
	 header('Location:backup.php');
	exit;
};
   
   