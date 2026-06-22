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
	<?php 
	@session_start();
	if((empty($_SESSION['logado']))OR($_SESSION['nivel']<>"gerente")){
        header("Location:home.php");
        exit;   
    };
	require_once 'topo.php';
	$_SESSION['pagina']="excluidos.php";
	// ordenação			 	
	if(isset($_GET['ordem'])){
		$variavel_1=$_GET['ordem'];
		if( $_SESSION['v2'] == "ASC"){
			$variavel_2 = "DESC";
		}else{
			$variavel_2 = "ASC";
		}
	}else{
		$variavel_1 = "nome";
		$variavel_2 = "ASC";
	};
	$_SESSION['v2']= $variavel_2;
	$nulo = '';
	$sqlcliente_excluido = $conexao->prepare("SELECT * FROM cliente WHERE excluiu<> ? ORDER BY $variavel_1 $variavel_2 ");
	$sqlcliente_excluido->execute([$nulo]);
	$totalListaExcluido = $sqlcliente_excluido->rowCount();
	
	// manda para a home se não tiver mais nenhum cadastro excluido
	if($totalListaExcluido == 0){
		$_SESSION["informacao"]="Cadastros retornados com sucesso";
		header("Location:home.php");
		exit;
	}
	?>
</head>
<body>
	<div class="container">  
		<div class="navegacao_vertical" >
			<div class="logomarca_home">
				<?php 
				if (file_exists("../imagem_cliente/logomarca.jpg")){
				?> 	
					<img class="logomarca_pag" src="../imagem_cliente/logomarca.jpg" title="Clique para ampliar a imagem" onclick="document.getElementById('fotoAmpliada').style.display='block';document.getElementById('foto_ampliada').src ='../imagem_cliente/logomarca.jpg' "/>	
				<?php 
				}else{; 
				
					echo "<img class='logomarca_pag logomarca_none' src='../imagem_cliente/branco_gelo.jpg'/>";
					
					};
				?>
			</div>
			<div class="div_botao_vertical relatorio">
				<?php if($numTotclientesExcluidos >1){; ?>
					<button title="Clique para marcar todos os cadastros" class="botao" onclick="marcar();" ><i class="fas fa-check-square"></i><span class="espaco">Marcar</span></button>						     
					<button title="Clique para desmarcar todos os cadastros" class="botao" onclick="desmarcar();"><i class="fas fa-square"></i><span class="espaco">Desmarcar</span></button>	
				<?php }; ?>
			</div> 	
		</div>
		<div class="div_navegacao_horizontal"><!-- no onclick da linha abaixo, manda para a pagina home resetando as informacoes -->
			<button title='Clique para ir para a página home' class="botao" onclick="document.location='../php/ordenacao.php?nome=0'"><i class="fas fa-home"></i><span class="espaco">Home</span></button>	
			<button id="relatorio" value="relatorio" <?php if($numTotalListaGeral==0){ echo 'disabled="disabled" class="botao botao_inativo"';}else{ echo 'class="botao"';};?> onclick="location.href='relatorio.php?coluna=telefone&nav=relatorio'" title="Clique para ir para a página relatório"><i class="fas fa-chart-line"></i><span class="espaco">Relatório</span></button> 	
			<button id="imprimir" value="imprimir" <?php if($numTotalListaGeral==0){ echo 'disabled="disabled" class="botao botao_inativo"';}else{ echo 'class="botao"';};?> onclick="location.href='impressao.php'" title="Clique para ir para a página imprimir"><i class="fas fa-print"></i><span class="espaco">Imprimir</span></button>  
			<?php if($_SESSION['logado']<>"Admin"){;?>	
				<span  class="campo_login">USUÁRIO : &nbsp <?php echo $_SESSION['logado']; ?></span>
			<?php } ?>
			<span class="reload_pag" title="clique para atualizar a página" onclick="document.location.reload(true);" >&#8635</span>
	 		<?php 
			// campo do cronometro, condicao que retira ou nao o cronometro
			if($result_func['semCronometro']==""){$_SESSION['cronometro']="sim";?>
				<div class="cronometro"><?php require_once '../cronometro/cronometro.php'; ?></div>
			<?php 
			}else{$_SESSION['cronometro']="nao";}				
			?>
		</div>
		<?php 
		// condição para mostrar a div login
		if((isset($_SESSION['logado'])) And($_SESSION['logado']<>"Admin")){ ;?>
			<style>
				.cronometro{display:block;}
			</style>	
		<?php }else{if($resultado['loginAuto']!="sim"){
			unset($_SESSION['logado']);
			header('location:login.php');
			exit;
		} };?>
		<div class="div_navegacao_horizontal3">
			<!--<span class="campo">Cadastro(s) excluído(s) total &nbsp <?php echo $totalExcluido ;?></span>-->
			<span class="campo">Cadastro(s) excluído(s)</span><span class="campo campo2"><?php echo $totalExcluido ;?></span>
			<span  class="campo_login campo_login"> ACESSO : &nbsp <?php echo $_SESSION['acesso']; ?></span></span>
			<?php if(isset($_SESSION['logado'])){ ;?>
				<a href="../php/expira_session.php" title="Clique para deslogar" ><button class="botao butSair" ><i class="fas fa-sign-out-alt"></i><span class="espaco" >SAIR</span></button></a>
			<?php };?>
		</div>
		<div class="div_tabela fixTableHead">         
			<form action="imprimindo.php" method="post">  
				<table class="tabela_menus" border="1" cellpadding="2" cellspacing="0">
					<thead>
						<th class="th_5">I M P</th>	
						<th class="th_5">
							<a class="titulo-head" href="excluidos.php?ordem=codigo">I D <i id="sort"  <?php if($variavel_1 <>"codigo"){echo'class="fas fa-sort fa-lg nosort"'; };if(($variavel_1 =="codigo")AND($variavel_2 =="ASC")){echo'class="fas fa-sort-up fa-lg"'; }else{echo'class="fas fa-sort-down fa-lg"'; };?> ></i></a>
						</th>	 
						<th class="th_5" >C O N T</th>
						
						<th class="th_5">
							<a class="titulo-head" href="excluidos.php?ordem=ordemServico">O.S.<i id="sort" <?php if($variavel_1 <>"ordemServico"){echo'class="fas fa-sort fa-lg nosort"'; };if(($variavel_1 =="ordemServico")AND($variavel_2=="ASC")){echo'class="fas fa-sort-up fa-lg"'; }else{echo'class="fas fa-sort-down fa-lg"'; };?> ></i></a>	
						</th>
						<th class="th_65"><a class="titulo-head" href="excluidos.php?ordem=nome">NOME<i id="sort" <?php if($variavel_1 <>"nome"){echo'class="fas fa-sort fa-lg nosort"'; };if(($variavel_1 =="nome")AND($variavel_2=="ASC")){echo'class="fas fa-sort-up fa-lg"'; }else{echo'class="fas fa-sort-down fa-lg"'; };?> ></i></a> </th>
							<th class="th_15" >FUNÇÂO</th>
						</tr>
					</thead>
					<tbody>		           		   
						<?php  if(isset($sqlcliente_excluido)){$to=0;
							while($consulta = $sqlcliente_excluido->fetch(PDO::FETCH_ASSOC)) {$to=$to+1; ?>		
							<tr class="linha_home">
								<td class="check_imprimir">
									<center><input class="checkExcluidos" type=checkbox name="numeros[]" class="check" value="<?php echo $consulta['codigo'];?>"title="Marque aqui para imprimir ou retornar"  onclick="verifica()"></center>              
								</td>
								<td class="coluna_numererica" >			
									<?php echo "<span class='t-nome'>".$consulta['codigo']."</span>"; ?>					
								</td >
								<td class="coluna_numererica">
									<?php echo "<span class='t-nome'>".$to."</span>";?>
								</td>   								
								<td class="coluna_numererica">					
									<?php echo "<span class='t-nome'>".$consulta['ordemServico']."</span>"; ?>					
								</td >
								<td class="nome_imprimir" >
									<?php echo  "<span class='t-nome t-Mausculo l-afastada'>".$consulta['nome']."</span>"; ?>
								</td>  
								<td class="acao_imprimir">	
									<?php if(($consulta['foto1']<>"")OR($consulta['foto2']<>"")OR($consulta['foto3']<>"")){; ?>
										<i title="Clique para ver informações do cadastro excluído" class="botao_tabela botao-tabela fas fa-camera" onclick="document.getElementById('codigoAlt').value='<?php echo $consulta['codigo']; ?>';document.getElementById('ver_cadastro').style.display='block';modal();"></i>
									<?php }else{ ;?>
										<i title="Clique para ver informações do cadastro excluído" class="botao_tabela botao-tabela fas fa-eye" onclick="document.getElementById('codigoAlt').value='<?php echo $consulta['codigo']; ?>';document.getElementById('botaoAlteracao').style.visibility ='hidden';document.getElementById('ver_cadastro').style.display='block';modal();"></i>
									<?php }  ?>
										<a href="../php/retornar_cliente.php?retornar_cliente=<?= $consulta['codigo']; ?>" title="Clique para retornar o cadastro excluído" OnClick="return confirm('Confirma retorno da  O.S. <?php echo $consulta['ordemServico'];?> \n<?php echo $consulta['nome']; ?>')" ><i class="botao_tabela botao-tabela fas fa-undo"></i></a> 	
										<a href="../html/imprimir_tudo.php?imprimir_tudo= <?= $consulta['codigo']; ?>" ><i class="botao_tabela botao-tabela fas fa-print" title="Clique para imprimir o cadstro excluído"></i></a>
									<?php if($_SESSION['logado'] <> "Admin"){; ?>	
										<a href="../php/excluir_cliente_excluido.php?excluir_cliente=<?php echo $consulta['codigo']; ?>" title="Clique para excluir o cadastro definitivamente"  OnClick="return confirm('Confirma exclusão definitiva da  O.S. <?php echo $consulta['ordemServico'];?> \n<?php echo $consulta['nome']; ?>')"><i class="botao_tabela botao-tabela excluir_home fas fa-trash"></i></a>   
									<?php } ?>
								</td>				  
							</tr>
						<?php } ;}; ?> 
					</tbody>
				</table>	
				<input id="txt" name="imprimir_cadastro_excluido_checkbox" class="sumido" value="imprimir_cadastro_excluido_checkbox" type="submit" >
				<input id="txt2" name="retornar_cadastro_excluido_checkbox"  OnClick="return confirm('Confirma retorno dos selecionados?')" value="retornar_cadastro_checkbox" class="sumido" type="submit" >
			</form> 
			<?php require_once 'formulario.php';?>
			<div class="col col-10 div_rodape_tabela">						 
				<button type="button" id="imprimir_cad" class="botao sumido" title="Clique para imprimir os cadastros excluídos marcados" onclick="document.getElementById('txt').click();" ><i class="fas fa-print"></i><span class="espaco">Imprimir</span></button>	
				<button tupe="button"  id="retornar_cad" title="Clique para retornar os cadastros excluídos marcados" class="botao sumido"  onclick="document.getElementById('txt2').click();"><i class="fas fa-redo-alt"></i><span class="espaco">Retornar</span></button>
			</div>
		</div>
	</div>	
	<script src="../js/funcoes.js"></script>
	</div>
	<script language="JavaScript">
		function marcar(){
			var boxes = document.getElementsByName("numeros[]");
			for(var i = 0; i < boxes.length; i++)
			boxes[i].checked = true;
		document.getElementById("imprimir_cad").style.display ="block";
		document.getElementById("retornar_cad").style.display ="block";
		
		
		}
		function desmarcar(){
			var boxes = document.getElementsByName("numeros[]");
			for(var i = 0; i < boxes.length; i++)
			boxes[i].checked = false;
		document.getElementById("imprimir_cad").style.display ="none";
		document.getElementById("retornar_cad").style.display ="none";
		}
	</script> 
	<script type="text/javascript">
		function verifica(){
			// conta a quantidade de checkbox marcados e coloca na variável checado
			let checado = document.querySelectorAll('input[class="checkExcluidos"]:checked').length;
			if(checado > 1){
					document.getElementById("imprimir_cad").style.display ="block";
					document.getElementById("retornar_cad").style.display ="block";
			}else{
					document.getElementById("imprimir_cad").style.display ="none";
					document.getElementById("retornar_cad").style.display ="none";
			}
		};	
	</script>
</body>
</html>