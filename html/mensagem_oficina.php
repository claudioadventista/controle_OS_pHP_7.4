<?php 
@session_start();
if(empty($_SESSION['logado'])){
    header("Location:home.php");
    exit;   
};
require_once '../php/conexao.php';
require_once '../php/consulta.php';
//$codigo = $_SESSION['codigo'];
date_default_timezone_set('America/Fortaleza');
$data = date("Y-m-d");
/**************************************************************************************
  
                gerencia a mensagem bíblica que mostra uma vez por dia 
 
 **************************************************************************************/
 // Muda a data da mensagem para só repetir no outro dia
if(($data<>$result_func['mensagem'])AND($resultado['checkMensagem']=="sim")){

	$id = 1;
	$sql = "UPDATE funcionario SET mensagem = ? WHERE codigo = ? ";
	$stmt = $conexao->prepare($sql);
	$stmt->execute([$data, $id]);

?>
	<div id="timeoutMensagem">
		<script type="text/javascript">  
	  		setTimeout(function() {document.getElementById("timeoutMensagem").style.display = "none";
			;}, 20000);//20000
	 	</script>
	 	<br>
	 	<div class="mascara">	
	 		<div class="mensagem_diaria">
				<?php
					require_once '../php/mensagem.php';
					echo '<center><p>' . "Leia a biblia" . '</p><h1>' . $frase[rand(0, count($frase) - 1)] . '</h1></center>' . '<center><p>' . "Texto para meditação:" . '</p></center>' . '<h3>' . '<center>' . $frase2[rand(0, count($frase2) - 1)] . '</center>' . '<h3>';
	    		?>
	  	 	</div>
		</div>
	</div>
<?php } ?>
