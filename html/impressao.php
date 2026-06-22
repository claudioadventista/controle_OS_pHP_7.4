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
		$_SESSION['pagina']="impressao.php";
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
		$nulo = '';
		$_SESSION['v2']= $variavel_2;	
		if(empty($_POST['pesquisaImprimir'])){				
			$sqlimp_cliente = $conexao->prepare("SELECT codigo, nome, foto1, foto2, foto3, excluiu, telefone_ligado1 FROM cliente WHERE excluiu = ? ORDER BY $variavel_1 $variavel_2 ");
			$sqlimp_cliente->execute([$nulo]);
			$totalimp_cliente = $sqlimp_cliente->rowCount();
			if($totalimp_cliente < 1){header("Location:home.php");};
		}else{
			$busca = $_POST['pesquisaImprimir'];
			$sqlimp_cliente = $conexao->prepare("SELECT codigo, nome, foto1, foto2, foto3, excluiu, barra_cliente, telefone_ligado1 FROM cliente WHERE excluiu = ? AND nome LIKE ? OR cpf LIKE ? OR barra_cliente LIKE ?  ORDER BY $variavel_1 $variavel_2 ");
			$sqlimp_cliente->execute([$nulo, "%$busca%", "%$busca%", "%$busca%"]);
			$totalimp_cliente = $sqlimp_cliente->rowCount();
			$controleBusca = 1;
			if($totalimp_cliente < 1){header("Location:impressao.php");};
		}
		?>
	</head>
	<body>
		<div class="container">  
			<div class="navegacao_vertical">
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
					<button class="botao but-cinza" title="Clique aqui para iniciar a pesquisa" onclick="document.getElementById('formBuscarImprimir').style.display='block';document.getElementById('pesquisaImprimir').focus();"><i class="fas fa-search"></i><span class="espaco">Pesquisar</span></button>
				<?php if($totalimp_cliente > 1){ ?>
					<button title="Clique para marcar todos" class="botao" onclick="document.getElementById('botao-imprimi').style.display = 'block';marcar();" ><i class="fas fa-check-square" ></i><span class="espaco">Marcar</span></button>						     
					<button title="Clique para desmarcar todos " class="botao"  onclick="document.getElementById('botao-imprimi').style.display = 'none';desmarcar();"><i class="fas fa-square"></i><span class="espaco">Desmarcar</span></button>	
				<?php }; ?>
				</div>
			</div>
			<div class="div_navegacao_horizontal">
				<!-- no onclick da linha abaixo, manda para a pagina home resetando as informacoes -->
					<button title="Clique para ir para a página home" class="botao" onclick="document.location='../php/ordenacao.php?nome=0'"><i class="fas fa-home"></i><span class="espaco">Home</span></button>
					<button id="relatorio" value="relatorio" <?php if($numTotalListaGeral==0){ echo 'disabled="disabled" class="botao botao_inativo"';}else{ echo 'class="botao"';};?> onclick="location.href='relatorio.php?coluna=telefone&nav=relatorio'" title="Clique para ir para a página relatório"><i class="fas fa-chart-line"></i><span class="espaco">Relatório</span></button>
					<button disabled="disabled" class="botao botao_inativo"><i class="fas fa-print icon_imp"></i><span class="espaco">Imprimir</span></button>
					<?php if($_SESSION['logado']<>"Admin"){;?>	
						<span  class="campo_login">USUÁRIO : &nbsp <?php echo $_SESSION['logado']; ?></span>
						<!--<span class="campo_login"><?php //echo $_SESSION['logado']; ?> &nbsp acesso &nbsp<?php //echo $_SESSION['acesso']; ?></span>-->
					<?php } ?>
					<span class="reload_pag" title="clique para atualizar a página" onclick="window.location.href='impressao.php';" >&#8635</span>
				
				<?php 
				// campo do cronometro, condicao que retira ou nao o cronometro
				if($result_func['semCronometro']==""){$_SESSION['cronometro']="sim";?>
					<div class="cronometro"><?php require_once '../cronometro/cronometro.php'; ?></div>
				<?php 
				}else{$_SESSION['cronometro']="nao";}				
				?>
			</div>
			<div class="div_navegacao_horizontal3">		
				<?php 
				echo '<span class="campo">Total de cadastro(s) </span><span class="campo campo2">'.$totalimp_cliente.'</span>' ;
				if((isset($_SESSION['logado'])) And($_SESSION['logado']=="Admin")){ ;
					echo'<div class="div_navegacao_horizontal_3">';
				};
				if((isset($_SESSION['logado'])) And($_SESSION['logado']<>"Admin")){ ;?>
					<style>
						.cronometro{display:block;}
					</style>
				<?php }else{if($resultado['loginAuto']!="sim"){
						unset($_SESSION['logado']);
						header('location:login.php');
						exit;
					}; 
				};?>
				<?php if((isset($_SESSION['logado'])) And($_SESSION['logado']=="Admin")){ ;	
					echo '</div>';
				};
				if((isset($_SESSION['logado'])) And($_SESSION['logado']<>"Admin")){ ;?>
					<a href="../php/expira_session.php" title="Clique para deslogar"><button class="botao butSair" ><i class="fas fa-sign-out-alt"></i><span class="espaco" >SAIR</span></button></a>
				<?php }; ?>	
				<span  class="campo_login campo_login2"> ACESSO : &nbsp <?php echo $_SESSION['acesso']; ?></span></span>
			</div>         
			<div class="div_tabela fixTableHead">
				<form action="imprimindo.php" method="post">  
					<table class="tabela_menus" border="1" cellpadding="2" cellspacing="0">
						<thead>
							<tr>
								<th class="th_5" >I M P</th>
								<th title="Clique para organizar por I.D." class="th_5 titulo-head icon-home" onclick="window.location.href='impressao.php?ordem=codigo'">I D<i id="sort"  <?php if($variavel_1 <>"codigo"){echo'class="fas fa-sort fa-lg nosort icon-home"'; };if(($variavel_1 =="codigo")AND($variavel_2 =="ASC")){echo'class="fas fa-sort-up fa-lg icon-home"'; }else{echo'class="fas fa-sort-down fa-lg icon-home"'; };?> ></i></th>
								<th class="th_5" >C O N T</th>
								<th title="Clique para organizar por nome" class="th_70 titulo-head icon-home"  onclick="window.location.href='impressao.php?ordem=nome'">N O M E<i id="sort" <?php if($variavel_1 <>"nome"){echo'class="fas fa-sort fa-lg nosort icon-home"'; };if(($variavel_1 =="nome")AND($variavel_2=="ASC")){echo'class="fas fa-sort-up fa-lg icon-home"'; }else{echo'class="fas fa-sort-down fa-lg icon-home"'; };?> ></i></th>
								<th class="th_15" >A Ç Â O</th>
							</tr> 
						</thead>
						<tbody>                                   	
							<?php $to=0;
							while($consulta = $sqlimp_cliente->fetch(PDO::FETCH_ASSOC)) {$to=$to+1  ?>
								<tr class="linha_home">  
									<td><center>				
										<input class="checkImprimi" type=checkbox name="numeros[]" value="<?php echo $consulta['codigo'];?>" title="Marque mais de um para imprimir vários" onclick="verifica();" ></center>
									</td>
									<td class="coluna_numererica" >		
										<?php echo $consulta['codigo']; ?>					
									</td >
									<td class="coluna_numererica" >
										<?php echo '&nbsp&nbsp&nbsp'.$to;?>
									</td>   
									
									<td style="cursor:pointer" title="Clique para alterar o cadastro"
										onclick="document.getElementById('codigoAlt').value='<?php echo $consulta['codigo']; ?>';
										document.getElementById('ordemServicoAlt').value = '';	
										document.getElementById('form_alteracao').style.display='block';modal();">
										<?php echo "<span class='t-nome t-Mausculo l-afastada'>".$consulta['nome']."</span>"; ?>
									</td>
									<td class="acao_imprimir" style="padding-left:0.5%;"  >
										<?php 
										if(($consulta['foto1']<>"")OR($consulta['foto2']<>"")OR($consulta['foto3']<>"")){; ?>
											<i class="botao_tabela ver_tabela fas fa-camera" 
												onclick="document.getElementById('codigoAlt').value='<?php echo $consulta['codigo']; ?>';
												document.getElementById('ver_cadastro').style.display='block';modal();">
											</i>
										<?php }else{ ;?>
											<i class="botao_tabela botao-tabela fas fa-eye" title="Clique para ver o cadastro"
												onclick="document.getElementById('codigoAlt').value='<?php echo $consulta['codigo']; ?>';
												document.getElementById('botaoAlteracao').style.visibility ='hidden';
												document.getElementById('ver_cadastro').style.display='block';modal();">
											</i>
										<?php }  if($consulta['telefone_ligado1']<>""){; ?>
												<i id="id-cadastro" class="botao_tabela botao-tabela fas fa-phone" 
													onclick="document.getElementById('codigoAlt').value='<?php echo $consulta['codigo']; ?>';
													document.getElementById('form_alteracao').style.display ='block';modal();
													document.getElementById('ordemServicoAlt').value = '';" title="Clique para alterar o cadastro">									
												</i>
											<?php }else{; ?>
												<i id="id-cadastro" class="botao_tabela botao-tabela fas fa-edit" 
													onclick="document.getElementById('codigoAlt').value='<?php echo $consulta['codigo']; ?>';
													document.getElementById('form_alteracao').style.display ='block';modal();
													document.getElementById('ordemServicoAlt').value = '';" title="Clique para alterar o cadastro">									
												</i>
											<?php }; ?>

										<!--
										<i class="botao_tabela botao-tabela fas fa-edit" title="Clique para alterar o cadastro"
											onclick="document.getElementById('codigoAlt').value='<?php //echo $consulta['codigo']; ?>';
											document.getElementById('ordemServicoAlt').value = '';					  																				
											document.getElementById('form_alteracao').style.display='block';modal();">
										</i>
										-->
										<a title="Clique para imprimir o cadastro" href="imprimir_tudo.php?imprimir_tudo=<?php echo $consulta['codigo']; ?>" ><i class="botao_tabela botao-tabela fas fa-print" ></i></a>
									</td>
									</td>
								</tr>		
							<?php }; 
							if(isset($controleBusca)){
								if(($to == 1) AND ($controleBusca == 1)){;  
									echo "<script>
										window.onload = function(){
										document.getElementById('id-cadastro').click();
										}
									</script>";
								};
							}
							?>
						</tbody>
					</table>
					<input id="txt4" name="imprimir_cadastro_excluido_checkbox" class="sumido" value="imprimir_cadastro_excluido_checkbox" type="submit" >	
				</form>
			</div>
			<div class="col col-10 div_rodape_tabela" >
				<button type="button" class="botao sumido" title="Clique para imprimir os cadastros excluídos marcados" id="botao-imprimi" onclick="document.getElementById('txt4').click();"><i class="fas fa-print"></i><span class="espaco">Imprimir</span></button>
			</div>
			<?php require_once 'formulario.php';?>
			<script type="text/javascript">
				function marcar(){
					var boxes = document.getElementsByName("numeros[]");
					for(var i = 0; i < boxes.length; i++)
						boxes[i].checked = true;
				}
				function desmarcar(){
					var boxes = document.getElementsByName("numeros[]");
					for(var i = 0; i < boxes.length; i++)
						boxes[i].checked = false;
				}
			</script>
			<script language="JavaScript">
				function verifica(){
					// conta a quantidade de checkbox marcados e coloca na variável checado
					let checado = document.querySelectorAll('input[class="checkImprimi"]:checked').length;
					if(checado > 1){
						document.getElementById("botao-imprimi").style.display = 'block';
					}else{
						document.getElementById("botao-imprimi").style.display = 'none';
					};
				};	
			</script>  
			<script src="../js/funcoes.js"></script>
		</div>
	</body>
</html>