<?php 
@session_start();
// só entra nessa página se estiver logado 
 if(empty($_SESSION['logado'])) {
 	$_SESSION["informacao"]="Operação não premitida!";
 	header('Location:../html/home.php');
 exit;
};
require_once 'consulta.php';
date_default_timezone_set('America/Fortaleza');
$data = date("Y-m-d");
$codigo = 1;
$oficina = $_POST['oficina'];
$endereco = $_POST['endereco'];
$rodape = $_POST['rodape'];	
$usuario = $_POST['usuario'];
//$cont_os = $resultado['cont_os'];
$cont_os = $_POST['cont_os'];
$telefone = $_POST['telefone'];
$telefone2 = $_POST['telefone2'];
// impede cadastrar o primeiro telefone com telefone 2 
if (($_POST['telefone']=="")AND($_POST['telefone2']<>"")){
$telefone         = $_POST['telefone2'];
$telefone2        = "";
}
if ($_POST['idadeMinima'] < 10)  {
	$idadeMinima = 10;
}else{
	$idadeMinima = $_POST['idadeMinima'];
};

if ($_POST['idadeMaxima'] < 10)  {
	$idadeMaxima = 10;
}else{
	$idadeMaxima = $_POST['idadeMaxima'];
}	
if (isset($_POST['os_auto'])) {
	$os_auto = "sim";
}else{
	$os_auto = "";
}
/*
if (isset($_POST['protegido'])) {
	$protegido = "sim";
}else{
	$protegido = "";
}
*/
if (isset($_POST['zeros'])) {
	$zeros = 'sim';
	while($cont_os[0] == "0"){
		$cont_os = substr($cont_os,1,strlen($cont_os));
	}
}else{
	$zeros = '';
	$cont_os = str_pad($cont_os,7,'0',STR_PAD_LEFT);
}
if (isset($_POST['logomarca'])) {
	$logomarca ="sim";	
}else{
	$logomarca ="";	
}
if (isset($_POST['tema'])) {
	$tema ="claro";	
}else{
	$tema ="escuro";	
}
if (isset($_POST['descanso'])) {
	$descanso ="sim";	
}else{
	$descanso ="";	
}
if (isset($_POST['tecnico'])) {
	$tecnico ="sim";	
}else{
	$tecnico ="";	
}
if (isset($_POST['loginAuto'])) {
	$loginAuto ="sim";
}else{
	$loginAuto ="";
}
if (isset($_POST['semCronometro'])) {
	$semCronometro ="sim";
}else{
	$semCronometro ="";
}	
if (isset($_POST['maiuscula'])) {
	$maiuscula ="sim";
}else{
	$maiuscula ="";
}
if (isset($_POST['acento'])) {
	$acento = 1;
}else{
	$acento = 0;
}		
if (isset($_POST['form_configuracao'])){
	if($_FILES['img_logomarca']['name']<>""){
		$img_logomarca = "logomarca.jpg";
		$img_logomarca_name=$_FILES['img_logomarca']['tmp_name'];
		move_uploaded_file($img_logomarca_name,"../imagem_cliente/$img_logomarca");

		$sql = "UPDATE config SET img_logo = ? WHERE codigo = ? "; 
		$stmt = $conexao->prepare($sql);
		$stmt->execute([$img_logomarca, $codigo]);
		
		$_SESSION["informacao"]="Logomarca";	
		  header('Location:backup.php');
		 exit;
	   }	

	
	$sql = "UPDATE config 
	SET pagina =:pagina, ordem =:ordem, zeros =:zeros, os_auto =:os_auto, cont_os =:cont_os,
	usuario =:usuario, logomarca =:logomarca, oficina =:oficina, endereco =:endereco, 
	telefone =:telefone, telefone2 =:telefone2, rodape =:rodape, sem_acento =:sem_acento, semCronometro =:semCronometro, 
	maiuscula =:maiuscula, escolha =:escolha, tema =:tema, idadeMinima =:idadeMinima, idadeMaxima =:idadeMaxima  WHERE codigo =:codigo"; 
	$stmt = $conexao->prepare($sql);
	$stmt->execute(['pagina'=>$pagina, 'ordem'=>$ordem, 'zeros'=>$zeros, 'os_auto'=>$os_auto, 'cont_os'=>$cont_os,
	'usuario'=>$usuario, 'logomarca'=>$logomarca, 'oficina'=>$oficina, 'endereco'=>$endereco, 
	'telefone'=>$telefone, 'telefone2'=>$telefone2, 'rodape'=>$rodape, 'sem_acento'=>$acento, 'semCronometro'=>$semCronometro, 
	'maiuscula'=>$maiuscula, 'escolha'=>$tecnico, 'tema'=>$tema, 'idadeMinima'=>$idadeMinima, 'idadeMaxima'=>$idadeMaxima, 'codigo'=>$codigo]);

	$_SESSION["informacao"]="As configurações foram alteradas";
    header('Location:backup.php');
}

?>
