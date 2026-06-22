<?php 
@session_start();
require_once '../php/consulta.php';
require_once '../php/funcoes_php.php';
$nome = 0; 
date_default_timezone_set('America/Fortaleza');
$data = date("Y-m-d");
// proteção para não acessar o sistema sem estar logado 2

if(empty($_SESSION['logado'])) {
	 unset ($_SESSION['logado']);
	 header('Location:login.php');	  
 exit;
}	
// Tudo maiúsculo
if($_SESSION['maiuscula']=="sim"){ ?>
  <style>
    input[type='text'] {
      text-transform: uppercase;
    }
    textarea {
      text-transform: uppercase;
    }
  </style>
<?php } ?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="stylesheet" type="text/css" href="../estilo/index.css" />
	<?php 
	if($_SESSION['tema']=="claro"){
		echo '<link rel="stylesheet" type="text/css" href="../estilo/tema_escuro.css" />';
	}
	?>
	
	<!--<link rel="stylesheet" type="text/css" href="../estilo/colorido.css" />-->

	<link href="../fonts/fontawesome-free-5.11.2-web/css/fontawesome.css" rel="stylesheet">
	<link href="../fonts/fontawesome-free-5.11.2-web/css/brands.css" rel="stylesheet">
	<link href="../fonts/fontawesome-free-5.11.2-web/css/solid.css" rel="stylesheet">		
	<script>
		/*
	   	function prepareMenu() {
	     	// first lets make sure the browser understands the DOM methods we will be using
		 	if (!document.getElementsByTagName)
		   		return false;
		 	if (!document.getElementById)
		   		return false;
		 	// lets make sure the element exists
		 	if (!document.getElementById("menu"))
		   		return false;
		 	var menu = document.getElementById("menu");
		   	// for each of the li on the root level check if the element has any children
		   	// if so append a function that makes the element appear when hovered over
		 	var root_li = menu.getElementsByTagName("li");
			for (var i = 0; i < root_li.length; i++) {
			   	var li = root_li[i];
			   	// search for children
			   	var child_ul = li.getElementsByTagName("ul");
			    if (child_ul.length >= 1) {
					// we have children - append hover function to the parent
				   	li.onmouseover = function() {
				    	if (!this.getElementsByTagName("ul"))
					   		return false;
				    	var ul = this.getElementsByTagName("ul");
						ul[0].style.display = "block";
						return true;
				   }
				   li.onmouseout = function() {
				     	if (!this.getElementsByTagName("ul"))
					   		return false;
					 	var ul = this.getElementsByTagName("ul");
					 	ul[0].style.display = "none";
					 	return true;
				   }
				}
			}
		 return true;
		 console.log("menu Caregado");
		}
	   addLoadEvent(prepareMenu);
	  // document.addEventListener('DOMContentLoaded', prepareMenu);
	  */
	</script>
</head>
<body onload="__loadEsconde();" >
	<?php 	
	if(($data==$resultado['mensagem'])AND($resultado['checkMensagem']=="sim")){
		?>
		<div id="carregador_pai">
		<div id="carregador">	
			<center>
				<div class="loading" />&#8635</div>
			</center>
		</div>
		</div>
	<?php  } ?>
	<!-- ---------------------- Mensagem-------------------------- -->
		<script type="text/javascript">
			setTimeout(function() {
				// some a id div info em 5 segundos
				document.getElementById("div_informacao").style.display="none";
				// some a class mascara
				document.getElementById("mascarado").style.display="none";		
			}, 4500);
		</script>
		<?php 
			if (isset($_SESSION["informacao"])){
				echo'<div id="mascarado" class="mascara"><div id="div_informacao" style="z-index:1000;">'.$_SESSION["informacao"].'</div></div>';
				unset($_SESSION["informacao"]);
				unset($_SESSION["controle_backup"]);
				unset($_SESSION["funcionario"]);
			};
			if (isset($_SESSION["infoServidor"])){
				unset($_SESSION["infoServidor"]);
				unset($_SESSION["controle_backup"]);
				unset($_SESSION["funcionario"]);
			};
	?>		
	<!--<img class="div-imagem" src="../imagem_cliente/imagem_de_fundo.jpg"></img>-->
</body>
</html>
