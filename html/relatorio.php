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
	<style>
		.outraData{
			position:relative;
			float:right!important;
		}
	</style>
	<?php 
	@session_start();
	if((empty($_SESSION['logado']))OR($_SESSION['nivel']<>"gerente")){
		header("Location:home.php");
		exit;   
	};
	require_once 'topo.php';
	$_SESSION['pagina']="relatorio.php";
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

	if(isset($_GET['campo'])){
		$campo = $_GET['campo'];
	}else{
		$campo = "telefone";
	}
	if($campo =='aPrazo'){
		$nulo = ''; 
		$sqlRelatorio_cliente = $conexao->prepare("SELECT codigo, ordemServico, dataEntrada, estado, nome, excluiu, foto1, foto2,  foto3, dataPagamento, pagou, orcamento, valorPeca, desconto, materialAuxiliar, transporte, pecaRet1, pecaRet2, pecaRet3, telefone_ligado1  FROM cliente WHERE excluiu = ? AND pagou = ? AND  $campo != ? ORDER BY $variavel_1 $variavel_2 ");   
		$sqlRelatorio_cliente->execute([$nulo, $nulo, $nulo]);
		$totalRelatorio_cliente = $sqlRelatorio_cliente->rowCount();
	}else{
		if((isset($_POST['datas']))AND(!empty($_POST['data1']))){
			$data1 = $_POST['data1'];
			if(empty($_POST['data2'])){
				date_default_timezone_set('America/Fortaleza');
				$data2=date("Y-m-d");
			}else{
				$data2=$_POST['data2'];
			} 
			$nulo = '';
			$sqlRelatorio_cliente = $conexao->prepare("SELECT codigo, ordemServico, dataEntrada, estado, nome, excluiu, foto1, foto2,  foto3, dataPagamento, pagou, orcamento, valorPeca, desconto, materialAuxiliar, transporte, pecaRet1, pecaRet2, pecaRet3, telefone_ligado1 FROM cliente WHERE excluiu = ? AND dataSaida BETWEEN(?) AND (?) AND estado = ? ORDER BY $data1 ASC");   
			$sqlRelatorio_cliente->execute([$nulo, $data1, $data2, 'APARELHO SAIU']);
			$totalRelatorio_cliente = $sqlRelatorio_cliente->rowCount();;
		}else{
			$nulo = '';
			$sqlRelatorio_cliente = $conexao->prepare("SELECT codigo, ordemServico, dataEntrada, estado, nome, excluiu, foto1, foto2,  foto3, dataPagamento, pagou, orcamento, valorPeca, desconto, materialAuxiliar, transporte, pecaRet1, pecaRet2, pecaRet3, telefone_ligado1 FROM cliente WHERE excluiu = ? AND ($campo = ? OR $campo = ?) ORDER BY $variavel_1 $variavel_2 ");
			$sqlRelatorio_cliente->execute([$nulo, $nulo, '0.00']);
			$totalRelatorio_cliente = $sqlRelatorio_cliente->rowCount();;
		}
	}
	$sqlEstadoSaiu = $conexao->prepare("SELECT codigo FROM cliente WHERE excluiu = ? ");
	$sqlEstadoSaiu->execute([$nulo]);
	$numTotalEstadoSaiu = $sqlEstadoSaiu->rowCount();
	// retorna para a home se não houver nenhum cadastro
	if($numTotalEstadoSaiu < 1){header("Location:home.php");};
	?>
	<script>
		window.history.pushState(null, null, window.location.href);
		window.onpopstate = function(){
			window.history.pushState(null, null, window.location.href);
		};
	</script>
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
			<div class="div_botao_vertical">
				<a title='Clique para ver os cadastros sem telefone' href="relatorio.php?campo=telefone"><button class="botao"><i class="fas fa-phone"></i><span class="espaco">S. TELEFONE</span></button></a>						     
				<a title='Clique para ver os cadastros sem endereço' href="relatorio.php?campo=endereco"><button class="botao"><i class="fas fa-address-book"></i><span class="espaco">S. ENDEREÇO</span></button></a>		 		
				<a title='Clique para ver os cadastros sem orçamento' href="relatorio.php?campo=orcamento"><button class="botao"><i class="fas fa-money-bill"></i><span class="espaco">S. ORÇAMEN.</span></button></a>
				<?php if($numTotalPrazo<>0){;?>	
					<a title='Clique para ver os cadastros a prazo' href="relatorio.php?campo=aPrazo"><button class="botao" ><i class="fas fa-calendar-alt"></i><span class="espaco">A PRAZO</button></a>
				<?php }; ?>	
				<?php if($totalRelatorio_cliente >1){ ?>
					<button title="Marca todos os cadastros para imprimir" class="botao" onclick="document.getElementById('botao-imprimir').style.display = 'block';marcar()"><i class="fas fa-check-square"></i><span class="espaco">Marcar</span></button>					     
					<button id="desmarcar_relatorio_imprimir" title="Desmarca todos os cadastros" class="botao" onclick="document.getElementById('botao-imprimir').style.display = 'none';desmarcar()"><i class="fas fa-square"></i><span class="espaco">Desmarcar</span></button>						 
				<?php };if($numTotalEstadoSaiu >0){ ?>	<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
					<form class="data-relatorio"  action="relatorio.php?mostrar='" method="post"> 	
						<input type="hidden" name="datas">
						<span >
							<span class="mostraData" >PRIMEIRA DATA</span>
							<input  title='Digite uma data para ver o relatório' id="primeiraData" class="input_data" name="data1" type="date" /><br><br>
						</span>
						<span >	
							<span class="mostraData" >SEGUNDA DATA</span>
							<input title='Digite uma segunda data para ver o relatório' class="input_data" name="data2" type="date" />
						</span>
						<span style="position:relative;top:15px;" >
							<button type="submit" id="mostrar-data" title='Clique para ver os cadastros entre as datas' class="botao" onclick="return mostraData();document.getElementById('mostrar').click();" ><i class="fas fa-eye"></i><span class="espaco">MOSTRAR</span></button>
							<input type="submit" class="sumido" id="mostrar"  value="" >
						</span>
					</form>
				<?php };?>
			</div> 
		</div>
		<div class="div_navegacao_horizontal">
			<!-- no onclick da linha abaixo, manda para a pagina home resetando as informacoes -->
				<button title='Clique para ir para a página home' class="botao" onclick="document.location='../php/ordenacao.php?nome=0'"><i class="fas fa-home"></i><span class="espaco">Home</span></button>
				<button disabled="disabled" class="botao botao_inativo" title="Clique para ir para a página relatório"><i class="fas fa-chart-line"></i><span class="espaco">Relatório</span></button> 	
				<button id="imprimir" value="imprimir" <?php if($numTotalListaGeral==0){ echo 'disabled="disabled" class="botao botao_inativo"';}else{ echo 'class="botao"';};?> onclick="location.href='impressao.php'" title="Clique para ir para a página imprimir"><i class="fas fa-print print-mobile"></i><span class="espaco">Imprimir</span></button>  
				<?php 
				if($_SESSION['logado']<>"Admin"){;?>	
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
		<div class="div_navegacao_horizontal3">
			<?php 
			if((isset($_SESSION['logado'])) And($_SESSION['logado']<>"Admin")){ ;?>
				<style>
					.cronometro{display:block;}
				</style>
			<?php }else{
				if($resultado['loginAuto']!="sim"){
					unset($_SESSION['logado']);
					header('location:login.php');
					exit;
				} 
			} 
			if(empty($_POST['data1'])){
				if($campo == "aPrazo"){
					echo '<span class="campo">'.$campo.'</span><span class="campo campo2">'.$totalRelatorio_cliente.'</span>' ;
				}else{
					echo '<span class="campo">Sem '.$campo.'</span><span class="campo campo2">'.$totalRelatorio_cliente.'</span>' ;};
			}else{
				echo '<span class="campo">Total Saiu</span><span class="campo campo2">'.$totalRelatorio_cliente.' </span>';
			};
			if((isset($_SESSION['logado'])) And($_SESSION['logado']<>"Admin")){ ;?>
				<a href="../php/expira_session.php" title="Clique para deslogar"><button class="botao butSair" ><i class="fas fa-sign-out-alt"></i><span class="espaco" >SAIR</span></button></a>
			<?php }; ?>
			<span  class="campo_login campo_login"> ACESSO : &nbsp <?php echo $_SESSION['acesso']; ?></span></span>
		</div>
		<div class="div_tabela fixTableHead">
			<form action="imprimindo.php" method="post" >  
				<table class="tabela_menus" border="1" cellpadding="2" cellspacing="0"> 
					<thead>			
						<tr>
							<th class="th_5" > I M P </th>
							<th class="th_5 titulo-head icon-home" title="Clique para organizar por I.D." onclick="window.location.href='relatorio.php?ordem=codigo&campo=<?= $campo; ?>'">I D<i id="sort"  <?php if($variavel_1 <>"codigo"){echo'class="fas fa-sort fa-lg nosort icon-home"'; };if(($variavel_1 =="codigo")AND($variavel_2 =="ASC")){echo'class="fas fa-sort-up fa-lg icon-home"'; }else{echo'class="fas fa-sort-down fa-lg icon-home"'; };?> ></i></th>
							<th class="th_5" > C O N T </th>
							<th title="Clique para organizar por nome" class="th_15 titulo-head icon-home" onclick="window.location.href='relatorio.php?ordem=nome&campo=<?= $campo; ?>'">N O M E <i id="sort"  <?php if($variavel_1 <>"nome"){echo'class="fas fa-sort fa-lg nosort icon-home"'; };if(($variavel_1 =="nome")AND($variavel_2=="ASC")){echo'class="fas fa-sort-up fa-lg icon-home"'; }else{echo'class="fas fa-sort-down fa-lg icon-home"'; };?> ></i></th>
							<th title="Clique para organizar por data de pagamento" class="th_15 titulo-head icon-home" onclick="window.location.href='relatorio.php?ordem=dataPagamento&campo=<?= $campo; ?>'">D A T A  &nbsp&nbsp P A G A M E N T O <i  id="sort" <?php if($variavel_1 <>"dataPagamento"){echo'class="fas fa-sort fa-lg nosort icon-home"'; };if(($variavel_1 =="dataPagamento")AND($variavel_2 =="ASC")){echo'class="fas fa-sort-up fa-lg icon-home"'; }else{echo'class="fas fa-sort-down fa-lg icon-home"'; };?> ></i></th>
							<th class="th_10" > V E N C I M E N T O </th>
							<th class="th_20"> E S T A D O </th>
							<th class="th_10" > N A D A </th>
							<th class="th_15" > A Ç Â O </th>
						</tr> 
					</thead>
					<tbody>                        	
						<?php
						// declara as variaveis usadas na pagina
						$to=0;$t=0; $s=0; $v=0; $rt=0; $d=0;$pr=0;$m=0;$trans=0;
						while($consulta = $sqlRelatorio_cliente->fetch(PDO::FETCH_ASSOC)) {$to=$to+1; 
						?> 	
						<tr class="linha_home" >
							<td class="check_imprimir" >
								<center><input id="checkbox_relatorio"class="checkImprimir" type=checkbox name="numeros[]" value="<?php echo $consulta['codigo'];?>"title="Marque mais de um para imprimir vários" onclick="verifica();"></center>
							</td>		    
							<td class="coluna_numererica">
								<?php  echo "<span class='t-nome'>".$consulta['codigo']."</span>";?>
							</td>  
							<td class="coluna_numererica">
								<?php echo "<span class='t-nome'>".$to."</span>";?>
							</td>  
							<td class="cursor_pointer" title="Clique para alterar o cadastro"
								onclick="document.getElementById('codigoAlt').value='<?php echo $consulta['codigo']; ?>';
								document.getElementById('ordemServicoAlt').value = '';
								document.getElementById('form_alteracao').style.display='block';modal();">
								<?php echo "<span class='t-nome t-Mausculo l-afastada'>".resumo($consulta['nome'],15)."</span>"; ?>
							</td> 		 								          
							<?php 
							if(($consulta['dataPagamento']<>"0000-00-00")AND($consulta['pagou']=="")){;
								$dataHoje = date("d/m/Y");
								$dataAtual = date("Y-m-d");							
								$time_atual = strtotime($dataAtual);
								$time_expira =  strtotime($consulta['dataPagamento']);
								$dif_tempo = $time_expira - $time_atual;
								$dias = (int)floor( $dif_tempo / (60 * 60 * 24));

								if($consulta['dataPagamento']<>"0000-00-00"){
									if ($time_expira == $time_atual){
										echo '<td class="venceHoje coluna_numererica"><span class="t-nome"><center>'.date('d/m/Y',strtotime($consulta['dataPagamento'])).'</center></span></td>
										     <td class="venceHoje t-Mausculo"><span class="t-nome">Vence hoje</span></td>';
									}else if ($dias <= 30 && $dias > 0){
										echo '<td class="coluna_numererica" ><span class="t-nome"><center>'.date('d/m/Y',strtotime($consulta['dataPagamento'])).'</center></span></td>
										      <td class="estaProximo t-Mausculo"><span class="t-nome">Está próximo</span></td>';
									}else if($dias<0 && $dias >=-31){
										echo '<td class="coluna_numererica" ><span class="t-nome"><center>'.date('d/m/Y',strtotime($consulta['dataPagamento'])).'</center></span></td>
										      <td class="vencido t-Mausculo"><span class="t-nome">Vencido</span></td>';
									}else if($dias<-31){
										echo '<td class="coluna_numererica" ><span class="t-nome"><center>'.date('d/m/Y',strtotime($consulta['dataPagamento'])).'</center></span></td>
										      <td class="muitoVencido t-Mausculo"><span class="t-nome">Muito vencido</span></td>';
									}else{
										echo '<td class="coluna_numererica" ><span class="t-nome"><center>'.date('d/m/Y',strtotime($consulta['dataPagamento'])).'</center></span></td>
										      <td class="aVencer t-Mausculo"><span class="t-nome">A vencer</span></td>';
									};	
									echo '<td></td>
									      <td></td>';
								}else{
									echo '<td></td>
										  <td>'.date('d/m/Y',strtotime($consulta['dataPagamento'])).'</td>';
								};
							}else{
								echo '<td></td>
									  <td></td>
									  <td class="estado_imprimir">'.$consulta['estado'].'</td>
									  <td></td>';
							}			
							?>	
							<td>
								<?php 
								if(($consulta['foto1']<>"")OR($consulta['foto2']<>"")OR($consulta['foto3']<>"")){; ?>
									<i class="botao_tabela botao-tabela fas fa-camera" 
										onclick="document.getElementById('codigoAlt').value='<?php echo $consulta['codigo']; ?>';
										document.getElementById('ver_cadastro').style.display='block';modal();">
									</i>
								<?php 
								}else{ ;?>
									<i class="botao_tabela botao-tabela fas fa-eye" 
										title='Clique para ver o cadastros'onclick="document.getElementById('codigoAlt').value='<?php echo $consulta['codigo']; ?>';
										document.getElementById('ver_cadastro').style.display='block';modal();">
									</i>
								<?php }  

								if($consulta['telefone_ligado1']<>""){; ?>
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
								<i title='Clique para alterar o cadastro' class="botao_tabela botao-tabela fas fa-edit" 
									onclick="document.getElementById('codigoAlt').value='<?php echo $consulta['codigo']; ?>';
									document.getElementById('ordemServicoAlt').value = '';																					
									document.getElementById('form_alteracao').style.display='block';modal();">
								</i>
								-->
								<a title="Clique para imprimir o cadastro" href="imprimir_tudo.php?imprimir_tudo=<?php echo $consulta['codigo']; ?>" ><i class="botao_tabela botao-tabela fas fa-print"></i></a>
							</td>
						</tr>									
						<?php 
						$s= $s+$consulta['orcamento'];
						$v= $v+$consulta['valorPeca'];
						$d= $d+$consulta['desconto'];
						$m= $m+$consulta['materialAuxiliar'];
						$trans= $trans+$consulta['transporte'];
						$pr= $pr+$consulta['pecaRet1']+$consulta['pecaRet2']+$consulta['pecaRet3'];
						} ;?>	
					</tbody>
				</table>
				<input id="txt3" name="imprimir_cadastro_excluido_checkbox" class="sumido" value="imprimir_cadastro_excluido_checkbox" type="submit" >
			</form> 
		</div>
		<div class="col col-10 div_rodape_tabela" >
			<button type="button" id="botao-imprimir" title="Clique para imprimir os cadastros marcados" class="botao sumido" onclick="document.getElementById('txt3').click();" ><i class="fas fa-print"></i><span class="espaco" >Imprimir</span></button>
			<button title="Clique para mostrar o relatório" class="botao sumido" id="mostrar_resultado" onclick="document.getElementById('resultado2').style.display='block';document.getElementById('mostrar_resultado').style.display='none';" ><i class="fas fa-eye"></i><span class="espaco" >Mostrar</span></button>
			

			<!--<button type="button" id="botao-imprimir" title="Clique para imprimir os cadastros marcados" class="botao sumido" onclick="document.getElementById('txt3').click();" ><i class="fas fa-print"></i><span class="espaco" >Imprimir</span></button>-->
			<button type="button" id="outra-data" title='Clique para ver outra data' class="botao sumido outraData" onclick="document.location.reload(true);" ><i class="fas fa-calendar"></i><span class="espaco">OUTRA DATA</span></button>
		</div>
		<?php  
		if(!empty($_POST['data1'])){ ;?>
			<div id="resultado2">	
				<div class="formulario_cadastro">
						<div class="cabecario_padrao">             	  	            	  	    
							<span title="Clique para fechar o resultado do relatório" class="simbolo_padrao" onclick="document.getElementById('mostrar-data').style.display = 'none';document.getElementById('resultado2').style.display='none';document.getElementById('mostrar_resultado').style.display='block';document.getElementById('outra-data').style.display='block';">&times</span>
							<span class="atualizar_pagina" title="clique para atualizar a página" onclick="document.location.reload(true);" >&#8635</span>
							<span class="texto"> <?php echo "Relatório entre ".date('d/m/Y',strtotime($data1))." e ".date('d/m/Y',strtotime($data2));?></span><br><br>
						</div>
						<div class="linha">
							 
							<div class="col col-1-4">
								<!-- tabela pequena da direita em cima SAIRAM NAQUELE PERIODO -->
								<div class="fixTableHead2">
									<br><br>
									<div class="col col-10">
										<!-- relatorio da querda dos aparelhos SAIRAM NAQUELE PERIODO -->
										<br><br>
										<div class="col col-6 t-Mausculo c-div"> Resumo Geral </div><div class="col col-4 c-div">&nbsp</div>									
										<div class="col col-6 t-Mausculo c-divB"> Total Sairam</div><div class="col col-4 c-divB"><?php echo $to;?></div>																		
										<div class="col col-6 t-Mausculo  c-div"> Total Orçamento </div><div class="col col-4 c-div"><?php echo "R$ ".number_format($s,2,',','.');?></div>
										<div class="col col-6 t-Mausculo c-divB"> Total Peças </div><div class="col col-4 c-divB"><?php echo "R$ ".number_format($v,2,',','.');?></div>
										<div class="col col-6 t-Mausculo  c-div"> Total Peças R. </div><div class="col col-4 c-div"><?php echo "R$ ".number_format($pr,2,',','.');?></div>
										<div class="col col-6 t-Mausculo  c-divB"> Total Desconto </div><div class="col col-4 c-divB"><?php echo "R$ ".number_format($d,2,',','.');?></div>
										<div class="col col-6 t-Mausculo  c-div"> Total Mat. Aux. </div><div class="col col-4 c-div"><?php echo "R$ ".number_format($m,2,',','.');?></div>
										<div class="col col-6 t-Mausculo  c-divB"> Total Transporte </div><div class="col col-4 c-divB"><?php echo "R$ ".number_format($trans,2,',','.');?></div>
										<div class="col col-6 t-Mausculo c-div"> Total Lucro </div><div class="col col-4 c-div"><?php echo "R$ ".number_format(($s-$v-$d-$m-$trans),2,',','.');?></div>
									</div>
								</div>
								<div class="col col-10 tabela-relatorio">
									<div class="col col-5" style="padding:4px">Resumo Geral</div>
								</div>
							</div>
							<div class="col col-1-4">
								<!-- tabela pequena da direita em cima SAIRAM NAQUELE PERIODO -->
								<form action="imprimindo.php" method="post"> 
									<div class="fixTableHead2">
										<table class="tabela_menus"> 
											<thead>
												<tr>
													<th class="th_10" > C O N T </th>											
													<th class="th_20" > N O M E </th>
												</tr> 
											</thead>
											<tbody >                        	
												<?php											
												$ta=0;
												$nulo = '';
												$sqlRelatorio_clienteSaiu = $conexao->prepare("SELECT codigo, nome FROM cliente WHERE excluiu = ? AND dataSaida BETWEEN(?) AND (?) AND estado = ? ORDER BY  $data1 ASC");   
												$sqlRelatorio_clienteSaiu->execute([$nulo, $data1, $data2, 'APARELHO SAIU']);
												$totalRelatorio_clienteSaiu = $sqlRelatorio_clienteSaiu->rowCount();
												while($consulta2 = $sqlRelatorio_clienteSaiu->fetch(PDO::FETCH_ASSOC)) {$ta=$ta+1;
												?> 	
												<tr class="linha_home" >		    
													<td class="coluna_numererica" style="padding-right:2%;text-align:right;">
														<?php echo $ta;?>
													</td> 
													<td class="cursor_pointer t-Mausculo" title="Clique para alterar o cadastro"
														onclick="document.getElementById('codigoAlt').value='<?php echo $consulta2['codigo']; ?>';
														document.getElementById('form_alteracao').style.display='block';modal();">
														<?php echo  resumo($consulta2['nome'],20); ?>
														<input type=checkbox name="numeros5[]" class="sumido" value="<?php echo $consulta2['codigo'];?>" >
													</td>
												</tr>									
												<?php 
												} ;?>	
											</tbody>
										</table>
									</div>
									<div class="linha">
										<div class="col col-10 tabela-relatorio">
											<div class="col col-5"  style="padding:4px">Saíram</div><div class="col col-3"  style="padding:4px">Total : <?php echo $ta;?></div><?php if($ta >0){;?><div class="col col-2" ><label for="enviar5" title="Imprimir todos" style="float:right;font-size:18px;margin-right:10px;color:darkblue;" class="fas fa-print" onclick="marcarTudo5();"></label></div><?php }; ?>
											<input type="submit" id="enviar5" class="sumido" name="sairam"  value="">
										</div>
									</div>
								</form>
							</div>
							<div class="col col-1-4">
								<!-- tabela pequena da direita em cima SAIRAM NAQUELE PERIODO -->
								<form action="imprimindo.php" method="post"> 
									<div class="fixTableHead2">
										<table class="tabela_menus"> 
											<thead>
												<tr>
													<th class="th_10" > C O N T </th>											
													<th class="th_20" > N O M E </th>
												</tr> 
											</thead>
											<tbody >                        	
												<?php											
												$ta=0;
												$nulo = '';
												$sqlRelatorio_retornou = $conexao->prepare("SELECT codigo, nome FROM cliente WHERE excluiu = ? AND dataSaida BETWEEN(?) AND (?) AND dataRetorno1 != ? ORDER BY  $data1 ASC");   
												$sqlRelatorio_retornou->execute([$nulo, $data1, $data2, $nulo]);
												$totalRelatorio_retornou = $sqlRelatorio_retornou->rowCount();
												while($consulta2 = $sqlRelatorio_retornou->fetch(PDO::FETCH_ASSOC)) {$ta=$ta+1;
												?> 	
												<tr class="linha_home" >		    
													<td class="coluna_numererica" style="padding-right:2%;text-align:right;">
														<?php echo $ta;?>
													</td> 
													<td class="cursor_pointer t-Mausculo" title="Clique para alterar o cadastro"
														onclick="document.getElementById('codigoAlt').value='<?php echo $consulta2['codigo']; ?>';
														document.getElementById('form_alteracao').style.display='block';modal();">
														<?php echo  resumo($consulta2['nome'],20); ?>
														<input type=checkbox name="numeros6[]" class="sumido" value="<?php echo $consulta2['codigo'];?>" >
													</td>
												</tr>									
												<?php 
												} ;?>	
											</tbody>
										</table>
									</div>
									<div class="linha">
										<div class="col col-10 tabela-relatorio">
											<div class="col col-5"  style="padding:4px">Retornaram</div><div class="col col-3"  style="padding:4px">Total : <?php echo $ta;?></div><?php if($ta >0){;?><div class="col col-2"><label for="enviar6" title="Imprimir todos" style="float:right;font-size:18px;margin-right:10px;color:darkblue;" class="fas fa-print" onclick="marcarTudo6();"></label></div><?php }; ?>
											<input type="submit" id="enviar6" class="sumido" name="retornaram"  value="">
										</div>
									</div>
								</form>
							</div>
							<div class="col col-1-4">
								<!-- tabela pequena da direita em cima SAIRAM NAQUELE PERIODO -->
								<form action="imprimindo.php" method="post"> 
									<div class="fixTableHead2">
										<table class="tabela_menus"> 
											<thead>
												<tr>
													<th class="th_10" > C O N T </th>											
													<th class="th_20" > N O M E </th>
												</tr> 
											</thead>
											<tbody >                        	
												<?php											
												$ta=0;
												$nulo = '';
												$sqlRelatorio_prazo = $conexao->prepare("SELECT codigo, nome FROM cliente WHERE dataPagamento != ? AND excluiu = ? AND pagou = ? AND dataPagamento BETWEEN(?) AND (?) ORDER BY  $data1 ASC");   
												$sqlRelatorio_prazo->execute(['0000-00-00', $nulo, $nulo, $data1, $data2]);
												$totalRelatorio_prazo = $sqlRelatorio_prazo->rowCount();
												while($consulta2 = $sqlRelatorio_prazo->fetch(PDO::FETCH_ASSOC)) {$ta=$ta+1;
												?> 	
												<tr class="linha_home" >		    
													<td class="coluna_numererica" style="padding-right:2%;text-align:right;">
														<?php echo $ta;?>
													</td> 
													<td class="cursor_pointer t-Mausculo" title="Clique para alterar o cadastro"
														onclick="document.getElementById('codigoAlt').value='<?php echo $consulta2['codigo']; ?>';
														document.getElementById('form_alteracao').style.display='block';modal();">
														<?php echo  resumo($consulta2['nome'],20); ?>
														<input type=checkbox name="numeros7[]" class="sumido" value="<?php echo $consulta2['codigo'];?>" >
													</td>
												</tr>									
												<?php 
													
												} ;?>	
											</tbody>
										</table>
									</div>
									<div class="linha">
										<div class="col col-10 tabela-relatorio">
											<div class="col col-5"  style="padding:4px">A Prazo</div><div class="col col-3"  style="padding:4px">Total : <?php echo $ta;?></div><?php if($ta >0){;?><div class="col col-2"><label for="enviar7" title="Imprimir todos" style="float:right;font-size:18px;margin-right:10px;color:darkblue;" class="fas fa-print" onclick="marcarTudo7();"></label></div><?php }; ?>
											<input type="submit" id="enviar7" class="sumido" name="prazo"  value="">
										</div>
									</div>
								</form>
							</div>
						</div>
						<!--
						<div class="linha">
							<div class="col col-1-4 tabela-relatorio">
								<span>&nbsp</span>
							</div>
							<div class="col col-1-4 tabela-relatorio">
								<span>Sairam</span>
							</div>
							<div class="col col-1-4 tabela-relatorio" >
								<span>Retornaram</span>
							</div>
							<div class="col col-1-4 tabela-relatorio" >
								<span>A Prazo</span>
							</div>
						</div>
										-->
						
						<div class="linha" style="float:left;">
							<div class="col col-1-4">
								<!-- tabela pequena da esquerda ENTRARAM NAQUELE PERIODO -->
								<form action="imprimindo.php" method="post"> 
									<div class="fixTableHead2">
										<table class="tabela_menus"> 
											<thead>
												<tr>
													<th class="th_10" > C O N T </th>											
													<th class="th_20" > N O M E </th>
												</tr> 
											</thead>
											<tbody >                        	
												<?php
												// declara as variaveis usadas na pagina
												$ta=0;
												$sqlRelatorio_cliente = $conexao->prepare("SELECT codigo, nome FROM cliente WHERE excluiu = ? AND dataEntrada BETWEEN(?) AND (?) ORDER BY dataEntrada ASC");   
												$sqlRelatorio_cliente->execute([$nulo, $data1, $data2]);
												$totalRelatorio_cliente = $sqlRelatorio_cliente->rowCount();
												while($consulta2 = $sqlRelatorio_cliente->fetch(PDO::FETCH_ASSOC)) {$ta=$ta+1; 
												?> 	
												<tr class="linha_home" >		    
													<td class="coluna_numererica">
														<?php echo $ta;?>
													</td>  
													<td class="cursor_pointer t-Mausculo" title="Clique para alterar o cadastro"
														onclick="document.getElementById('codigoAlt').value='<?php echo $consulta2['codigo']; ?>';
														document.getElementById('form_alteracao').style.display='block';modal();">
														<?php echo  resumo($consulta2['nome'],20); ?>
														<input type=checkbox name="numeros1[]" class="sumido" value="<?php echo $consulta2['codigo'];?>" >
													</td>
												</tr>									
												<?php 
												} ;?>	
											</tbody>
										</table>
									</div>
									<div class="linha">
										<div class="col col-10 tabela-relatorio">
											<div class="col col-5"  style="padding:4px">Entraram</div><div class="col col-3" style="padding:4px">Total : <?php echo $ta;?></div><?php if($ta >0){;?><div class="col col-2"><label for="enviar" title="Imprimir todos" style="float:right;font-size:18px;margin-right:10px;color:darkblue;" class="fas fa-print" onclick="marcarTudo();"></label></div><?php }; ?>
											<input type="submit" id="enviar" class="sumido" name="entraram"  value="">
										</div>
									</div>
								</form>
							</div>
							<div class="col col-1-4">
								<!-- tabela PARA ORCAMENTO NAQUELE PERIODO -->
								<form action="imprimindo.php" method="post"> 
									<div class="fixTableHead2">
										<table class="tabela_menus"> 
											<thead>
												<tr>
													<th class="th_10" > C O N T </th>											
													<th class="th_20" > N O M E </th>
												</tr> 
											</thead>
											<tbody>                        	
												<?php
												// declara as variaveis usadas na pagina
												$ta=0;
												$nulo = '';
												$sqlRelatorio_cliente = $conexao->prepare("SELECT codigo, nome FROM cliente WHERE excluiu = ? AND estado = ? AND dataEntrada BETWEEN(?) AND (?) ORDER BY dataEntrada ASC");   
												$sqlRelatorio_cliente->execute([$nulo, 'PARA ORCAMENTO',$data1, $data2]);
												$totalRelatorio_cliente = $sqlRelatorio_cliente->rowCount();
												while($consulta2 = $sqlRelatorio_cliente->fetch(PDO::FETCH_ASSOC)) {$ta=$ta+1; 
												?> 	
												<tr class="linha_home" >		    
													<td class="coluna_numererica" style="padding-right:2%;text-align:right;">
														<?php echo $ta;?>
													</td> 
													<td class="cursor_pointer t-Mausculo" title="Clique para alterar o cadastro"
														onclick="document.getElementById('codigoAlt').value='<?php echo $consulta2['codigo']; ?>';
														document.getElementById('form_alteracao').style.display='block';modal();">
														<?php echo  resumo($consulta2['nome'],20); ?>
														<input type=checkbox name="numeros2[]" class="sumido" value="<?php echo $consulta2['codigo'];?>" >
													</td>
												</tr>									
												<?php 
									
												} ;?>	
											</tbody>
										</table>
									</div>
									<div class="linha">
										<div class="col col-10 tabela-relatorio">
											<div class="col col-5"  style="padding:4px">Para Orçamento</div><div class="col col-3"  style="padding:4px">Total : <?php echo $ta;?></div><?php if($ta >0){;?><div class="col col-2"><label for="enviar2" title="Imprimir todos" style="float:right;font-size:18px;margin-right:10px;color:darkblue;" class="fas fa-print" onclick="marcarTudo2();"></label></div><?php }; ?>
											<input type="submit" id="enviar2" class="sumido" name="orcamento"  value="">
										</div>
									</div>
								</form>
							</div>
							<div class="col col-1-4">
								<!-- tabela ORCAMENTO PRONTO NAQUELE PERIODO -->
								<form action="imprimindo.php" method="post"> 
									<div class="fixTableHead2">
										<table class="tabela_menus" > 
											<thead>
												<tr>
													<th class="th_10" > C O N T </th>											
													<th class="th_20" > N O M E </th>
												</tr> 
											</thead>
											<tbody>                        	
												<?php
												// declara as variaveis usadas na pagina
												$ta=0;
												$nulo = '';
												$sqlRelatorio_cliente = $conexao->prepare("SELECT codigo, nome FROM cliente WHERE excluiu = ? AND estado = ? AND dataEntrada BETWEEN(?) AND (?) ORDER BY dataEntrada ASC");   
												$sqlRelatorio_cliente->execute([$nulo, 'ORCAMENTO PRONTO', $data1, $data2]);
												$totalRelatorio_cliente = $sqlRelatorio_cliente->rowCount();
												while($consulta2 = $sqlRelatorio_cliente->fetch(PDO::FETCH_ASSOC)) {$ta=$ta+1; 
												?> 	
												<tr class="linha_home" >		    
													<td class="coluna_numererica" style="padding-right:2%;text-align:right;">
														<?php echo $ta;?>
													</td>   
													<td class="cursor_pointer t-Mausculo" title="Clique para alterar o cadastro"
														onclick="document.getElementById('codigoAlt').value='<?php echo $consulta2['codigo']; ?>';
														document.getElementById('form_alteracao').style.display='block';modal();">
														<?php echo  resumo($consulta2['nome'],20); ?>
														<input type=checkbox name="numeros3[]" class="sumido" value="<?php echo $consulta2['codigo'];?>" >
													</td>
												</tr>									
												<?php 								
												} ;?>	
											</tbody>
										</table>
									</div>
									<div class="linha">
										<div class="col col-10 tabela-relatorio">
											<div class="col col-5"  style="padding:4px">Orçamento Pronto</div><div class="col col-3"  style="padding:4px">Total : <?php echo $ta;?></div><?php if($ta >0){;?><div class="col col-2"><label for="enviar3" title="Imprimir todos" style="float:right;font-size:18px;margin-right:10px;color:darkblue;" class="fas fa-print" onclick="marcarTudo3();"></label></div><?php }; ?>
											<input type="submit" id="enviar3" class="sumido" name="pronto"  value="">
										</div>
									</div>
								</form>
							</div>
							<div class="col col-1-4">
								<!-- tabela SERVICO PRONTO NAQUELE PERIODO -->
								<form action="imprimindo.php" method="post">  
									<div class="fixTableHead2">
										<table class="tabela_menus"> 
											<thead>
												<tr>
													<th class="th_10" > C O N T </th>											
													<th class="th_20" > N O M E </th>
												</tr> 
											</thead>
											<tbody>                        	
												<?php
												// declara as variaveis usadas na pagina
												$ta=0;
												$nulo = '';
												$sqlRelatorio_cliente = $conexao->prepare("SELECT codigo, nome FROM cliente WHERE excluiu = ? AND estado = ? AND dataEntrada BETWEEN(?) AND (?) ORDER BY dataEntrada ASC");   
												$sqlRelatorio_cliente->execute([$nulo, 'SERVICO PRONTO', $data1, $data2]);
												$totalRelatorio_cliente = $sqlRelatorio_cliente->rowCount();
												while($consulta2 = $sqlRelatorio_cliente->fetch(PDO::FETCH_ASSOC)) {$ta=$ta+1;
												?> 	
												<tr class="linha_home" >		    
													<td class="coluna_numererica" style="padding-right:2%;text-align:right;">
														<?php echo $ta;?>
													</td>   
													<td class="cursor_pointer t-Mausculo" title="Clique para alterar o cadastro"
														onclick="document.getElementById('codigoAlt').value='<?php echo $consulta2['codigo']; ?>';
														document.getElementById('form_alteracao').style.display='block';modal();">
														<?php echo  resumo($consulta2['nome'],20); ?>
														<input type=checkbox name="numeros4[]" class="sumido" value="<?php echo $consulta2['codigo'];?>" >
													</td>
												</tr>									
												<?php 
												} ;?>	
											</tbody>
										</table>
									</div>
									<div class="linha">
										<div class="col col-10 tabela-relatorio">
											<div class="col col-5"  style="padding:4px">Serviço Pronto</div><div class="col col-3" style="padding:4px">Total : <?php echo $ta;?></div><?php if($ta >0){;?><div class="col col-2"><label for="enviar4" title="Imprimir todos" style="float:right;font-size:18px;margin-right:10px;color:darkblue;" class="fas fa-print" onclick="marcarTudo4();"></label></div><?php }; ?>
											<input type="submit" id="enviar4" class="sumido" name="servico"  value="">
										</div>
									</div>
								</form>
							</div>
						</div>
					<div class="col col-10 div_rodape" >
						<a title='Clique para ver o relatório em pdf' href="../php/relatorio_2pdf.php?data1=<?= $data1; ?>&data2=<?= $data2; ?>&aparelho=<?= $totalRelatorio_clienteSaiu; ?>&orcamento=<?php echo $s; ?>&peca=<?= $v; ?>&desconto=<?php echo $d; ?>&pecaRet=<?php echo $pr; ?>&materialAuxiliar=<?php echo $m; ?>&transporte=<?php echo $trans; ?>" ><button class="botao" ><i class="fas fa-file-pdf"></i><span class="espaco">RELATÓRIO</span></button></a>
						<a title='Clique para imprimir o relatório' href="imprimir_relatorio.php?data1=<?= $data1; ?>&data2=<?= $data2; ?>&aparelho=<?= $totalRelatorio_clienteSaiu; ?>&orcamento=<?php echo $s; ?>&peca=<?= $v; ?>&desconto=<?php echo $d; ?>&pecaRet=<?php echo $pr; ?>&materialAuxiliar=<?php echo $m; ?>&transporte=<?php echo $trans; ?>"  title="Clique para imprimir informações do cliente"><button class="botao"><i class="fas fa-print"></i><span class="espaco">RELATÓRIO</span></button></a>
						<button title='Clique para ver outra data' class="botao outraData" onclick="document.location.reload(true);" ><i class="fas fa-calendar"></i><span class="espaco">OUTRA DATA</span></button>
					</div>
				</div>
			</div>
		<?php };
		require_once 'formulario.php';
		?>
	</div>
	<script language="JavaScript">
		function marcar(){
			var boxes = document.getElementsByName("numeros[]");
			for(var i = 0; i < boxes.length; i++)
				boxes[i].checked = true;
		}
		/*
		function desmarcar(){
			var boxes = document.getElementsByName("numeros[]");
			for(var i = 0; i < boxes.length; i++)
				boxes[i].checked = false;
		}
		*/
		function marcarTudo(){
			var boxes = document.getElementsByName("numeros1[]");
			for(var i = 0; i < boxes.length; i++)
				boxes[i].checked = true;
		}
		function marcarTudo2(){
			var boxes = document.getElementsByName("numeros2[]");
			for(var i = 0; i < boxes.length; i++)
				boxes[i].checked = true;
		}
		function marcarTudo3(){
			var boxes = document.getElementsByName("numeros3[]");
			for(var i = 0; i < boxes.length; i++)
				boxes[i].checked = true;
		}
		function marcarTudo4(){
			var boxes = document.getElementsByName("numeros4[]");
			for(var i = 0; i < boxes.length; i++)
				boxes[i].checked = true;
		}
		function marcarTudo5(){
			var boxes = document.getElementsByName("numeros5[]");
			for(var i = 0; i < boxes.length; i++)
				boxes[i].checked = true;
		}
		function marcarTudo6(){
			var boxes = document.getElementsByName("numeros6[]");
			for(var i = 0; i < boxes.length; i++)
				boxes[i].checked = true;
		}
		function marcarTudo7(){
			var boxes = document.getElementsByName("numeros7[]");
			for(var i = 0; i < boxes.length; i++)
				boxes[i].checked = true;
		}
	</script>
	<script type="text/javascript">					
		function verifica(){
			// conta a quantidade de checkbox marcados e coloca na variável checado
			let checado = document.querySelectorAll('input[class="checkImprimir"]:checked').length;
			if(checado > 1){
				document.getElementById("botao-imprimir").style.display = 'block';
			}else{
				document.getElementById("botao-imprimir").style.display = 'none';
			};
		};	
	</script> 
	<script src="../js/funcoes.js"></script>
	<script>
		function mostraData(){
			const mostraData = document.getElementById("primeiraData").value;
			if(!mostraData){
				alert("Preencha ao menos a PRIMEIRA DATA para mostrar o relatório.");
				return false;
			};
		};
	//window.open('impressao.php', '_blank');
	</script>	
</body>
</html>