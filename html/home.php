<?php 
@session_start(); 
$_SESSION['cont'] = $_SESSION['cont']+1;
// impede acessar o sistema sem ser pelo servidor
if($_SESSION['protegido'] =='sim'){;
?>
	<script>
		//alert("protegido");
		function servidor1(){	
			fetch('http://localhost:80/controle_OS/sistema/php/busca_informacao.php?servidorHome=sim')
			.then(response => {
				if (response.ok) {
				return response.json();
				}
			})
			.then(json => {
				document.getElementById('spanGerente').innerHTML = "<span style='font-weight:bold;color:lightgreen'>Prot - " + <?php echo $_SESSION['cont'];?> + "</span>" ;
			})
			.catch(error => {
				alert('O sistema só pode ser acesado pelo servidor');
				window.location.href='../php/expira_session.php';
			}); 
		};
		servidor1();
		exit();
	</script>
<?php };?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Controle OS</title>
		<link rel="shortcut icon" href="favicon.ico" >
		<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=10,  minimum-scale=1.0" />
		<meta name="referrer" content="default" id="meta_referrer" />
		<meta http-equiv="cache-control" content="max-age=0" />
		<meta http-equiv="cache-control" content="no-cache" />
		<meta http-equiv="expires" content="0" />
		<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
		<meta http-equiv="pragma" content="no-cache" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<style>
			input[type='text'] {
				padding:2px;
				color:#555;		
			}
			#ver_excluidos{
				display:none;
			}
			input[type='text'] {
				padding:2px;
				color:#555;		
			}	
			.desconto{
				position:relative;
				font-weight:bold;
			}
			#campoCartao{
				visibility: hidden;
			}
			#dataPagou{
				visibility: hidden;
			}
			#checkPrazo{
				visibility: hidden;
			}
		</style>
		<?php 
		require_once 'topo.php';
		$_SESSION['pagina']="home.php"; 
		?>
	</head>
	</body> 
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
						
					 };?>
				</div>
				<div class="div_botao_vertical">
					<?php  // formulario de busca ;
					if($numTotalListaGeral<>0) {; ?> 
						<!-- lupa de pesquisa, obre o formulario de pesquisa ao clicar nela -->
						<button class="botao but-cinza" title="Clique aqui para iniciar a pesquisa" onclick="document.getElementById('formBuscar').style.display='block';document.getElementById('pesquisa').focus();"><i class="fas fa-search"></i><span class="espaco">Pesquisar</span></button>
						<?php 
						// condicao para mostrar o botao + botoes 
						if(($numTotalDoou<>0)OR($numTotalComprou<>0)OR($numTotalVendeu<>0)OR($numTotalAbandonou<>0)OR($numTotalSumiu<>0)OR($numTotalEntregouErrado<>0)OR($numTotalRoubado<>0)OR($numTotalDica<>0)){;
							$botoes = 0;
							if($numTotalDoou >0) $botoes = $botoes + 1 ;
							if($numTotalComprou >0) $botoes = $botoes + 1 ;
							if($numTotalVendeu >0) $botoes = $botoes + 1 ;
							if($numTotalAbandonou >0) $botoes = $botoes + 1 ;
							if($numTotalSumiu >0) $botoes = $botoes + 1 ;
							if($numTotalEntregouErrado >0) $botoes = $botoes + 1 ;
							if($numTotalRoubado >0) $botoes = $botoes + 1 ;
							if($numTotalDica >0) $botoes = $botoes + 1 ;
						?>	
							<!-- botao + botoes -->		 
							<button id="botoes" title="Clique para ver mais botões" class="botao but-mais"  onclick="maisBotoes()">BOTÕES +<div id="contaBotoes" class="resultado"><?php echo $botoes; ?></div></button>	
					<?php 
						}; 
					}; 
					// condicao para mostrar os botoes verticais
					if($numTotalListaGeral<>0){; ?>
						<button <?php if($letra=="LISTA GERAL"){echo 'disabled="disabled" class="botao botao_navegacao_vertical_desabilitado"';$geral = $listaGeral;$numerodepagina = $totalListaGeral;} else{echo 'class="botao but-cinza botao_navegacao_vertical"';};?>
							onclick="location.href='../php/ordenacao.php?nome=0'" title="Clique para ver a lista de cadastro geral" >Geral<div class="resultado"><?php echo $numTotalListaGeral; ?></div>
						</button>
					<?php 
					}; 
					if($numTotalParaOrcamento<>0){ ?>	 
						<button <?php if($letra=="PARA ORCAMENTO"){echo 'disabled="disabled" class="botao botao_navegacao_vertical_desabilitado"';$geral = $listaParaOrcamento;$numerodepagina = $totalParaOrcamento;} else{echo 'class="botao but-cinza botao_navegacao_vertical"';};?>  
							onclick="location.href='../php/ordenacao.php?nome=1'"  title="Clique para ver a lista de cadastro para orçamento" >P. Orçame.<div class="resultado"><?php echo $numTotalParaOrcamento; ?></div>
						</button>
					<?php 
					}; 
					if($numTotalPendencia<>0){; ?>
						<button <?php if($letra=="AGUARDANDO"){echo 'disabled="disabled" class="botao botao_navegacao_vertical_desabilitado"';$geral = $listaPendencia;$numerodepagina =$totalPendencia;} else{echo 'class="botao but-cinza botao_navegacao_vertical"';};?> 
							onclick="location.href='../php/ordenacao.php?nome=3'"  title="Clique para ver a lista de cadastro aguardando" >Aguardan.<div class="resultado"><?php echo $numTotalPendencia; ?></div>
						</button>
					<?php 
					}; 
					if($numTotalOrcamentoPronto<>0){; ?>	 
						<button <?php if($letra=="ORCAMENTO PRONTO"){echo 'disabled="disabled" class="botao botao_navegacao_vertical_desabilitado"';$geral = $listaOrcamentoPronto;$numerodepagina = $totalOrcamentoPronto;} else{echo 'class="botao but-cinza botao_navegacao_vertical"';};?>
							onclick="location.href='../php/ordenacao.php?nome=2'" title="Clique para ver a lista de cadastro orçamento pronto">Orç. Pron.<div class="resultado"><?php echo $numTotalOrcamentoPronto; ?></div>
						</button>
					<?php 
					};if($numTotalServicoPronto<>0){; ?>	
						<button <?php if($letra=="SERVICO PRONTO"){echo 'disabled="disabled" class="botao botao_navegacao_vertical_desabilitado"';$geral = $listaServicoPronto;$numerodepagina =$totalServicoPronto;} else{echo 'class="botao but-cinza botao_navegacao_vertical"';};?> 
							onclick="location.href='../php/ordenacao.php?nome=4'"title="Clique para ver a lista de cadastro serviço pronto" >Serv. Pro.<div class="resultado"><?php echo $numTotalServicoPronto; ?></div>
						</button>	
					<?php 
					};if($numTotalAparelhoSaiu<>0){; ?>		 
						<button <?php if($letra=="APARELHO SAIU"){echo 'disabled="disabled" class="botao botao_navegacao_vertical_desabilitado';$geral = $listaSaida;$numerodepagina =$totalAparelhoSaiu;} else{echo 'class="botao but-cinza botao_navegacao_vertical"';};?> 
							onclick="location.href='../php/ordenacao.php?nome=5'" title="Clique para ver a lista de cadastro aparelho saiu">Saiu<div class="resultado"><?php echo $numTotalAparelhoSaiu; ?></div>
						</button>
					<?php 
					};if($numTotalRetornou<>0){; ?>			 		
						<button <?php if($letra=="RETORNOU"){echo 'disabled="disabled" class="botao botao_navegacao_vertical_desabilitado"';$geral = $listaRetorno;$numerodepagina =$totalRetornou;} else{echo 'class="botao but-cinza botao_navegacao_vertical"';};?> 
							onclick="location.href='../php/ordenacao.php?nome=6'" title="Clique para ver a lista de cadastro retornou">Retornou<div class="resultado"><?php echo $numTotalRetornou; ?></div>
						</button>
					<?php 
					};if($numTotalDevolveu<>0){; ?>			 
						<button <?php if($letra=="DEVOLVEU"){echo 'disabled="disabled" class="botao botao_navegacao_vertical_desabilitado"';$geral = $listaDevolveu;$numerodepagina =$totalDevolveu;} else{echo 'class="botao but-cinza botao_navegacao_vertical"';};?> 
							onclick="location.href='../php/ordenacao.php?nome=7'" title="Clique para ver a lista de cadastro devolveu">Devolveu<div class="resultado"><?php echo $numTotalDevolveu;?></div>
						</button>
					<?php 
					};if($numTotalLigou<>0){; ?>			 
						<button <?php if($letra=="LIGOU"){echo 'disabled="disabled" class="botao botao_navegacao_vertical_desabilitado"';$geral = $listaLigou;$numerodepagina =$totalLigou;} else{echo 'class="botao but-cinza botao_navegacao_vertical"';};?> 
							onclick="location.href='../php/ordenacao.php?nome=18'" title="Clique para ver a lista de cadastro ligou">Ligou<div class="resultado"><?php echo $numTotalLigou;?></div>
						</button>
					<?php 
					};if($numTotalPrazo<>0){; ?>
						<button <?php if($letra=="PRAZO"){echo 'disabled="disabled" class="botao botao_navegacao_vertical_desabilitado"';$geral = $listaPrazo;$numerodepagina =$totalPrazo;} else{echo 'class="botao but-cinza botao_navegacao_vertical"';};?> 
							onclick="location.href='../php/ordenacao.php?nome=16'" title="Clique para ver a lista de cadastro a prazo">Prazo<div class="resultado"><?php echo $numTotalPrazo; ?></div>
						</button>
					<?php 
					}; 
					 
					if($numTotalFotos<>0){;?>	 
						<button <?php if($letra=="FOTOS"){echo 'disabled="disabled" class="botao botao_navegacao_vertical_desabilitado"';$geral = $listaFotos;$numerodepagina =$totalFotos;} else{echo 'class="botao but-cinza botao_navegacao_vertical"';};?> 
							onclick="location.href='../php/ordenacao.php?nome=10'" title="Clique para ver a lista de cadastro com foto">C. Foto<div class="resultado"><?php echo $numTotalFotos; ?></div>
						</button>	
					<?php };
					?>
					<div id="maisBotoes">
						<?php 
						if($numTotalDoou<>0){; ?>		 
							<button  <?php if($letra=="DOOU"){echo 'disabled="disabled" class="botao botao_navegacao_vertical_desabilitado"';$geral = $listaDoou;$numerodepagina =$totalDoou;} else{echo 'class="botao but-cinza botao_navegacao_vertical"';};?> 
								onclick="location.href='../php/ordenacao.php?nome=8'" title="Clique para ver a lista de cadastro doou">Doou<div class="resultado"><?php echo $numTotalDoou; ?></div>
							</button>	
						<?php 
						};
						if($numTotalComprou<>0){;?>		 
							<button  <?php if($letra=="COMPROU"){echo 'disabled="disabled" class="botao botao_navegacao_vertical_desabilitado"';$geral = $listaComprou;$numerodepagina =$totalComprou;} else{echo 'class="botao but-cinza botao_navegacao_vertical"';};?> 
								onclick="location.href='../php/ordenacao.php?nome=9'" title="Clique para ver a lista de cadastro comprou">Comprou<div class="resultado"><?php echo $numTotalComprou; ?></div>
							</button>	
						<?php 
						};
						if($numTotalVendeu<>0){;?>		 
							<button <?php if($letra=="VENDEU"){echo 'disabled="disabled" class="botao botao_navegacao_vertical_desabilitado"';$geral = $listaVendeu;$numerodepagina =$totalVendeu;} else{echo 'class="botao but-cinza botao_navegacao_vertical"';};?> 
								onclick="location.href='../php/ordenacao.php?nome=11'" title="Clique para ver a lista de cadastro vendeu">Vendeu<div class="resultado"><?php echo $numTotalVendeu; ?></div>
							</button>	
						<?php 
						};
						if($numTotalAbandonou<>0){;?>		 
							<button  <?php if($letra=="ABANDONOU"){echo 'disabled="disabled" class="botao botao_navegacao_vertical_desabilitado"';$geral = $listaAbandonou;$numerodepagina =$totalAbandonou;} else{echo 'class="botao but-cinza botao_navegacao_vertical"';};?> 
								onclick="location.href='../php/ordenacao.php?nome=12'" title="Clique para ver a lista de cadastro abandonou">Abandono.<div class="resultado"><?php echo $numTotalAbandonou; ?></div>
							</button>	
						<?php 
						};
						if($numTotalSumiu<>0){;?>		 
							<button <?php if($letra=="SUMIU"){echo 'disabled="disabled" class="botao botao_navegacao_vertical_desabilitado"';$geral = $listaSumiu;$numerodepagina =$totalSumiu;} else{echo 'class="botao but-cinza botao_navegacao_vertical"';};?> 
								onclick="location.href='../php/ordenacao.php?nome=13'" title="Clique para ver a lista de cadastro sumiu">Sumiu<div class="resultado"><?php echo $numTotalSumiu; ?></div>
							</button>	
						<?php 
						};
						if($numTotalEntregouErrado<>0){;?>		 
							<button  <?php if($letra=="ENTREGOU ERRADO"){echo 'disabled="disabled" class="botao botao_navegacao_vertical_desabilitado"';$geral = $listaEntregouErrado;$numerodepagina =$totalEntregouErrado;} else{echo 'class="botao but-cinza botao_navegacao_vertical"';};?> 
								onclick="location.href='../php/ordenacao.php?nome=14'" title="Clique para ver a lista de cadastro entregou errado">Ent. Erra.<div class="resultado"><?php echo $numTotalEntregouErrado; ?></div>
							</button>	
						<?php 
						};if($numTotalRoubado<>0){;?>		 
							<button <?php if($letra=="ROUBADO"){echo 'disabled="disabled" class="botao botao_navegacao_vertical_desabilitado"';$geral = $listaRoubado;$numerodepagina =$totalRoubado;} else{echo 'class="botao but-cinza botao_navegacao_vertical"';};?> 
								onclick="location.href='../php/ordenacao.php?nome=15'" title="Clique para ver a lista de cadastro aparelho roubado">Roubado<div class="resultado"><?php echo $numTotalRoubado; ?></div>
							</button>	
						<?php 
						};if($numTotalDica<>0){;?>		 
							<button  <?php if($letra=="DICA"){echo 'disabled="disabled" class="botao botao_navegacao_vertical_desabilitado"';$geral = $listaDica;$numerodepagina =$totalDica;} else{echo 'class="botao but-cinza botao_navegacao_vertical"';};?> 
								onclick="location.href='../php/ordenacao.php?nome=17'" title="Clique para ver a lista de cadastro dica">Dica<div class="resultado"><?php echo $numTotalDica; ?></div>
							</button>	
						<?php }; ?>
					</div>	 	
				</div>
			</div>
			<!-- campo onde fica os botoes horizontais de cima -->
			<div class="div_navegacao_horizontal" >
				<button disabled="disabled" class="botao botao_inativo"><i class="fas fa-home"></i><span class="espaco">Home</span></button>
				<button id="relatorio" value="relatorio" <?php if($numTotalListaGeral==0){ echo 'disabled="disabled" class="botao botao_inativo"';}else{ echo 'class="botao but-cinza"';};?> onclick="location.href='relatorio.php?coluna=telefone&nav=relatorio';" title="Clique para ir para a página relatório"><i class="fas fa-chart-line"></i><span class="espaco">Relatório</span></button> 	
				<button id="imprimir" value="imprimir" <?php if($numTotalListaGeral==0){ echo 'disabled="disabled" class="botao botao_inativo"';}else{ echo 'class="botao but-cinza"';};?> onclick="location.href='impressao.php';" title="Clique para ir para a página imprimir"><i class="fas fa-print"></i><span class="espaco">Imprimir</span></button>  
				<!-- botao para atualizar a pagina, ultimo botao em cima do lado direito  -->
				<span class="reload_pag" title="clique para atualizar a página" onclick="document.location.reload(true);" >&#8635</span>
				<!-- campo de informacao do usuario logado -->
				<span  class="campo_login">USUÁRIO : &nbsp <?php echo $_SESSION['logado']; ?></span>
				<?php 
				// campo do cronometro, condicao que retira ou nao o cronometro
				if($result_func['semCronometro']==""){$_SESSION['cronometro']="sim";?>
					<div class="cronometro"><?php require_once '../cronometro/cronometro.php'; ?></div>
				<?php 
				}else{$_SESSION['cronometro']="nao";}				
				?>
			</div>
			<!-- campo onde fica os botoes horizontais de baixo -->
			<div class="div_navegacao_horizontal3">
				<button class="botao" onclick="document.getElementById('ordemServicoAlt').value = '<?php echo $resultado['cont_os'];?>';novoCadastro();" title="Clique para novo cadastro" ><i class="but-verde fas fa-plus-square"></i><span class="espaco">novo</span></button>
				<button <?php echo 'class="botao but-cinza"';?>  onclick="document.getElementById('div_configuracao').style.display = 'block';<?php if($_SESSION['protegido'] =='sim'){ echo 'servidor()';};?>" title="Clique para ir para configurações"><i class="fas fa-cog"></i><span class="espaco">Configuração</span></button>			 
				<button <?php if($numTotalListaGeral==0){echo 'disabled="disabled" class="botao botao_inativo"';} else{echo 'class="botao but-cinza"';};?> onclick="location.href='../php/backup_zip.php?nome=gerar';" title="Clique para fazer backup do banco de dados"><i class="fas fa-save"></i><span  class="espaco">Backup</span></button>		 	
				
				<span  class="campo_login"> ACESSO : &nbsp <?php echo $_SESSION['acesso']; ?></span></span>
				
				<?php 
				// condicao para mostrar o cronometro e o botao sair
				if((isset($_SESSION['logado'])) AND ($_SESSION['logado']<>"Admin")){ ;?>
					<style>
						/* mostra o cronometro se logar com usuario e senha */
						.cronometro{display:block;}
					</style>
					<!-- botao sair -->
					<a href="../php/expira_session.php" title="Clique para deslogar" ><button class="botao butSair" ><i class="fas fa-sign-out-alt"></i><span class="espaco" >SAIR</span></button></a>
				<?php 
				}else{
					if($resultado['loginAuto']!="sim"){
						unset($_SESSION['logado']);
					?>
					<script>
						window.location = document.referrer;
					</script>
				<?php 
						exit;
					} 
				};
				?>
			</div>
			<?php 
			if($numTotalListaGeral>0){; ?>
				<div class="div_tabela">
					<div class="informacao informacao-mobile">	 
						<?php 
						if($letra==""){
							$letra="Todos";
						}
						if($letra=="FOTOS"){
							echo"COM FOTOS";
						}else{;
							if(isset($numTotalListaBusca)){
								echo"Busca por " .$letra. ' encontrado(s) '.$numTotalListaBusca." ocorrência(s)";
							}else{
								echo $letra;
							};
						}
						?>
					</div>
					<form action="imprimindo.php" method="post">  
						<table class="tabela_menus" border="1" cellpadding="2" cellspacing="0">
							<thead>
								<tr>
									<th class="th_5" >
										I M P
									</th>
									<th title="Ordena por I.D." class="th_5 titulo-head icon-home" onclick="window.location.href='../php/ordenacao.php?codigo='">
										I D <i id="sort"  <?php if($ordenacao <>"codigo"){echo'class="fas fa-sort fa-lg nosort icon-home"'; };if(($ordenacao =="codigo")AND($ordem=="ASC")){echo'class="fas fa-sort-up fa-lg icon-home"'; }else{echo'class="fas fa-sort-down fa-lg icon-home"'; };?> ></i>
									</th>	
									<th title="Ordena por O.S." class="th_5 titulo-head icon-home"  onclick="window.location.href='../php/ordenacao.php?os='">
										O S <i id="sort" <?php if($ordenacao <>"ordemServico"){echo'class="fas fa-sort fa-lg nosort icon-home"'; };if(($ordenacao =="ordemServico")AND($ordem=="ASC")){echo'class="fas fa-sort-up fa-lg icon-home"'; }else{echo'class="fas fa-sort-down fa-lg icon-home"'; };?> ></i>
									</th>
									<th  title="Ordena por Nome" class="th_15 titulo-head icon-home" onclick="window.location.href='../php/ordenacao.php?nomes='">
										 N O M E <i id="sort" <?php if($ordenacao <>"nome"){echo'class="fas fa-sort fa-lg nosort icon-home"'; };if(($ordenacao =="nome")AND($ordem=="ASC")){echo'class="fas fa-sort-up fa-lg icon-home"'; }else{echo'class="fas fa-sort-down fa-lg icon-home"'; };?> ></i>
									</th>	
									<?php 
									if($letra<>"PRAZO"){; 
									?> 
										<th  title="Ordena por Aparelho" class="ocultar th_15 titulo-head icon-home" onclick="window.location.href='../php/ordenacao.php?aparelhos='">
											A P A R E L H O <i id="sort"  <?php if($ordenacao <>"aparelho"){echo'class="fas fa-sort fa-lg nosort icon-home"'; };if(($ordenacao =="aparelho")AND($ordem=="ASC")){echo'class="fas fa-sort-up fa-lg icon-home"'; }else{echo'class="fas fa-sort-down fa-lg icon-home"'; };?> ></i>
										</th>	
										<th title="Ordena por Marca" class="ocultar th_10 titulo-head icon-home" onclick="window.location.href='../php/ordenacao.php?marcas='">
											M A R C A <i id="sort" <?php if($ordenacao <>"marca"){echo'class="fas fa-sort fa-lg nosort icon-home"'; };if(($ordenacao =="marca")AND($ordem=="ASC")){echo'class="fas fa-sort-up fa-lg icon-home"'; }else{echo'class="fas fa-sort-down fa-lg icon-home"'; };?> ></i>
										</th>
									<?php }else{;?>
										<th title="Ordena por Data de Pagamento" class="th_15 titulo-head icon-home" onclick="window.location.href='../php/ordenacao.php?dtPgto='"> 
											D A T A &nbsp&nbsp P A G A M E N T O <i id="sort" <?php if($ordenacao <>"dataPagamento"){echo'class="fas fa-sort fa-lg nosort icon-home"'; };if(($ordenacao =="dataPagamento")AND($ordem=="ASC")){echo'class="fas fa-sort-up fa-lg icon-home"'; }else{echo'class="fas fa-sort-down fa-lg icon-home"'; };?> ></i></a>
										</th> 
										<th class="th_10"> 
											V E N C I M E N T O
										</th> 
									<?php 
									};
									?>
									<th class="th_20"> 
										E S T A D O
									</th>         
									<th class="th_10"> 
										R E T O R N O
									</th> 
									<th class="th_15">
										A Ç Ã O				
									</th>
								</tr>  
							</thead> 
							<tbody>	
								<!-- inicio da tabela da home -->				           		   
								<?php  
								$to=0;
								if(isset($geral)){
									while($linha = $geral->fetch(PDO::FETCH_ASSOC)) {$to=$to+1 ?>	
										<tr class="linha_home" >
											<td><center>				
												<input class="checkImprimi" type=checkbox name="numeros[]" value="<?php echo $linha['codigo'];?>" title="Marque mais de um para imprimir vários" onclick="verificaImp();" ></center>
											</td>		
											<td class="coluna_numererica cursor_pointer" title="Clique para alterar o cadastro"  
												onclick="document.getElementById('codigoAlt').value='<?php echo $linha['codigo']; ?>';
												document.getElementById('ordemServicoAlt').value = '';
												document.getElementById('form_alteracao').style.display='block';modal();" >
												<?php echo "<span class='t-nome'>".$linha['codigo']."</span>"; ?>
											</td>
											<td class="coluna_numererica cursor_pointer" title="Clique para alterar o cadastro"
												onclick="document.getElementById('codigoAlt').value='<?php echo $linha['codigo']; ?>';
												document.getElementById('ordemServicoAlt').value = '';
												document.getElementById('form_alteracao').style.display='block';modal();"  >
												<?php  if($resultado['zeros']<>"sim"){ echo "<span class='t-nome'>".str_pad( $linha['ordemServico'],7,'0',STR_PAD_LEFT)."</span>";}else{echo "<span class='t-nome'>".$linha['ordemServico']."</span>"; } ?>
											</td>
											<td class="cursor_pointer t-Mausculo" title="Clique para alterar o cadastro" 
												onclick="document.getElementById('codigoAlt').value='<?php echo $linha['codigo']; ?>';
												document.getElementById('ordemServicoAlt').value = '';																
												document.getElementById('form_alteracao').style.display='block';modal();" >
												<?php echo "<span class='t-nome'>".resumo($linha['nome'],15)."</span>"; ?>
											</td>	
											<?php 
											if($letra<>"PRAZO"){; ?>   
												<td class="ocultar">     		
													<?php echo  "<span class='t-nome'>".resumo($linha['aparelho'],13)."</span>"; ?>		         
												</td>	
												<td class="ocultar" >     		
													<?php echo  "<span class='t-nome'>".resumo($linha['marca'],15)."</span>"; ?>		          
												</td>
											<?php 
											}else{;
												$dataHoje = date("d/m/Y");
												$dataAtual = date("Y-m-d");
												$time_atual = strtotime($dataAtual);
												$time_expira =  strtotime($linha['dataPagamento']);
												$dif_tempo = $time_expira - $time_atual;
												$dias = (int)floor( $dif_tempo / (60 * 60 * 24));
												if ($time_expira == $time_atual){
													echo '<td class="venceHoje coluna_numererica"><center>'.date('d/m/Y',strtotime($linha['dataPagamento'])).'</center></td>'.
													'<td class="venceHoje t-Mausculo"><span class="t-nome">Vence hoje</span></td>';
												}else if ($dias <= 30 && $dias > 0){
													echo '<td class="coluna_numererica"><center>'.date('d/m/Y',strtotime($linha['dataPagamento'])).'</center></td>'.
													'<td class="estaProximo t-Mausculo"><span class="t-nome">Está próximo</span></td>';
												}else if($dias<0 && $dias >=-31){
													echo '<td class="coluna_numererica"><center>'.date('d/m/Y',strtotime($linha['dataPagamento'])).'</center></td>'.
													'<td class="vencido t-Mausculo"><span class="t-nome">Vencido</span></td>';
												}else if($dias<-31){
													echo '<td class="coluna_numererica"><center>'.date('d/m/Y',strtotime($linha['dataPagamento'])).'</center></td>'.
													'<td class="muitoVencido t-Mausculo"><span class="t-nome">Muito vencido</span></td>';
												}else{
													echo '<td class="coluna_numererica"><center>'.date('d/m/Y',strtotime($linha['dataPagamento'])).'</center></td>'.
													'<td class="aVencer t-Mausculo"><span class="t-nome">A vencer</span></td>';
												};
											};?>			    
											<td class="ocultar" >
												<?php 
												if($linha['estado']=="PARA ORCAMENTO"){
													$estado = "PARA ORÇAMENTO";
												}else if($linha['estado']=="AGUARDANDO"){
													$estado = "AGUARDANDO";
												}else if($linha['estado']=="ORCAMENTO PRONTO"){
													$estado = "ORÇAMENTO PRONTO";
												}else if($linha['estado']=="SERVICO PRONTO"){
													$estado = "SERVIÇO PRONTO";
												}else if($linha['estado']=="APARELHO SAIU"){
													$estado = "APARELHO SAIU";
												}else if($linha['estado']=="RETORNOU"){
													$estado = "APARELHO RETORNOU";
												}else if($linha['estado']=="DEVOLVEU"){
													$estado = "DEVOLVEU";
												}else if($linha['estado']=="COMPROU"){
													$estado = "COMPROU";
												}else if($linha['estado']=="DOOU"){
													$estado = "DOOU";
												}else if($linha['estado']=="VENDEU"){
													$estado = "VENDEU";
												}else if($linha['estado']=="ABANDONOU"){
													$estado = "ABANDONOU";	
												}else if($linha['estado']=="SUMIU"){
													$estado = "SUMIU";
												}else if($linha['estado']=="ENTREGOU ERRADO"){
													$estado = "ENTREGOU ERRADO";
												}else if($linha['estado']=="ROUBADO"){
													$estado = "ROUBADO";
												}else if($linha['estado']=="DICA"){
												$estado = "DICA";
												};
												echo   "<span class='t-nome'>".$estado."</span>"; 
												?>		         
											</td>	      		    
											<td>	    	
												<?php 			    		
												if(($linha['estado']=="APARELHO SAIU")AND($linha['dataRetorno1']=="0000-00-00 00:00:00")){ ?>		    
													<i class="botao_tabela botao-tabela fas fa-undo" 
														onclick="document.getElementById('codigoAlt').value='<?php echo $linha['codigo']; ?>';
														document.getElementById('form_retorno').style.display ='block';
														document.getElementById('estadoRetAlt').value = 'PARA ORCAMENTO';
														document.getElementById('controleRetorno').value='retorno1';modal();" title="Clique para cadastrar o primeiro retorno">
													</i> 
												<?php 
												}; 
												if($linha['dataRetorno1']<>"0000-00-00 00:00:00"){ ?>
													<i class="botao_tabela botao-tabela fas fa-edit" 
														onclick="document.getElementById('codigoAlt').value='<?php echo $linha['codigo']; ?>';
														document.getElementById('form_retorno').style.display ='block';
														document.getElementById('controleRetorno').value='retorno1Alt';modal();" title="Clique para alterar o primeiro retorno">
													</i>
												<?php 
												}; 
												if(($linha['estadoRetorno1']=="APARELHO SAIU")AND($linha['dataRetorno2']=="0000-00-00 00:00:00")){; ?>
													<i class="botao_tabela botao-tabela fas fa-undo" 
														onclick="document.getElementById('codigoAlt').value='<?php echo $linha['codigo']; ?>';
														document.getElementById('form_retorno').style.display ='block';
														document.getElementById('estadoRetAlt').value = 'PARA ORCAMENTO';
														document.getElementById('controleRetorno').value='retorno2';modal();" title="Clique para cadastrar o segundo retorno">
													</i> 	
												<?php 
												}; 
												if($linha['dataRetorno2']<>"0000-00-00 00:00:00"){ ?>
													<i class="botao_tabela botao-tabela fas fa-edit" 
														onclick="document.getElementById('codigoAlt').value='<?php echo $linha['codigo']; ?>';
														document.getElementById('form_retorno').style.display ='block';
														document.getElementById('controleRetorno').value='retorno2Alt';modal();" title="Clique para alterar o alterar retorno">
													</i>
												<?php 
												}; 
												if(($linha['estadoRetorno2']=="APARELHO SAIU")AND($linha['dataRetorno3']=="0000-00-00 00:00:00")){ ?>
													<i class="botao_tabela botao-tabela fas fa-undo" 
														onclick="document.getElementById('codigoAlt').value='<?php echo $linha['codigo']; ?>';
														document.getElementById('form_retorno').style.display ='block';
														document.getElementById('estadoRetAlt').value = 'PARA ORCAMENTO';
														document.getElementById('controleRetorno').value='retorno3';modal();" title="Clique para cadastrar o terceiro retorno">
													</i>    	
												<?php 
												}; 
												if($linha['dataRetorno3']<>"0000-00-00 00:00:00"){ ?>
													<i class="botao_tabela botao-tabela fas fa-edit" 
														onclick="document.getElementById('codigoAlt').value='<?php echo $linha['codigo']; ?>';
														document.getElementById('form_retorno').style.display='block';
														document.getElementById('controleRetorno').value='retorno3Alt';modal();" title="Clique para alterar o alterar retorno">
													</i>
												<?php 
												}; 
												?>
											</td>
											<td> 
												<?php 
												if(($linha['foto1']<>"")OR($linha['foto2']<>"")OR($linha['foto3']<>"")){; ?>
													<i class="botao_tabela botao-tabela fas fa-camera" 
														onclick="document.getElementById('codigoAlt').value='<?php echo $linha['codigo']; ?>';
														document.getElementById('ver_cadastro').style.display ='block';modal();" title="Clique para ver o cadastro com foto">
													</i>
												<?php 
												}else{ ;?>
													<i class="botao_tabela botao-tabela fas fa-eye" onclick="document.getElementById('codigoAlt').value='<?php echo $linha['codigo']; ?>'; document.getElementById('ver_cadastro').style.display ='block';modal();" title="Clique para ver o cadastro"></i>
												<?php 
												}; 
												if($linha['excluiu']==''){
													if($linha['telefone_ligado1']<>""){; ?>
														<i id="id-cadastro" class="botao_tabela botao-tabela fas fa-phone" 
															onclick="document.getElementById('codigoAlt').value='<?php echo $linha['codigo']; ?>';
															document.getElementById('form_alteracao').style.display ='block';modal();
															document.getElementById('ordemServicoAlt').value = '';" title="Clique para alterar o cadastro">									
														</i>
													<?php }else{; ?>
														<i id="id-cadastro" class="botao_tabela botao-tabela fas fa-edit" 
															onclick="document.getElementById('codigoAlt').value='<?php echo $linha['codigo']; ?>';
															document.getElementById('form_alteracao').style.display ='block';modal();
															document.getElementById('ordemServicoAlt').value = '';" title="Clique para alterar o cadastro">									
														</i>
													<?php }; ?>
													<a href="../html/OS.php?codigo_cliente= <?= $linha['codigo']; ?>" ><i class="botao_tabela botao-tabela fas fa-print" title="Clique para imprimir o cadastro"></i></a>
													<a href="../php/pdf.php?busca= <?= $linha['codigo']; ?>"  ><i class="botao_tabela botao-tabela fas fa-file-pdf" title="Clique para ver o cadastro em pdf"></i></a>		
													<a href="../php/excluir_cliente.php?codigo=<?php echo $linha['codigo']; ?>"  OnClick="return confirm('Confirma Exclusão da  O.S. <?php echo $linha['ordemServico'];echo'\n'; echo $linha['nome']; ?>')" title="Clique para excluir o cadastro"><i class="botao_tabela botao-tabela excluir_home fas fa-trash"></i></a>   
												<?php
												};
												?>
											</td>				  
										</tr>
								<?php 
									};
								}; 
								?> 
								<tr>
									<td colspan="9" class="navegar_pagina"  >	
										<?php
										// se so existir apenas um cadastro, ja abre o formulario de alteracao 
										if(isset($controleBusca)){
											if(($to == 1) AND ($controleBusca == 1)){; 
												echo "<script>
													window.onload = function(){
													document.getElementById('id-cadastro').click();
													}
												</script>";
											};
										}

										if(isset($geral)){ 		
											$total = $numerodepagina;
											$max_links = 8;
											$links_laterais = ceil($max_links / 2);
											$inicio = $pagina - $links_laterais;
											$limite = $pagina + $links_laterais;
											$numero_de_pagina = "";
											if ($limite > 9) {echo "<a title='Clique para ir para a primeira página' href=\"?pagina=1 & nome=$nome\"><span class='botao-pag paginacao'>1</span></a>";if ($pagina > 6) {echo "<span class='navPag'>...</span>";};}
											for ($i = $inicio; $i <= $limite; $i++) {
											if ($i == $pagina) {echo "<span class='botao-pag num_pag'>".$i."</font>"."</span>";} else {if ($i >= 1 && $i <= $total) {echo "<a class='botao-pag paginacao' title='Clique para ir para a página $i' href=\"?pagina=$i & nome=$nome\">".$i."</a>";};};}
											if ($i <= $total) {if ($i < ($total)) {echo "<span class='navPag'>...</span>";} echo "<a class='botao-pag paginacao'  title='Clique para ir para a última página' href=\"?pagina=$total & nome=$nome\">".$total."</a>";};
										};?>				
									</td>	
								</tr> 
							</tbody>    
						</table>
						<input id="txtHome" name="imprimir_cadastro_excluido_checkbox" class="sumido" value="imprimir_cadastro_excluido_checkbox" type="submit" >	
					</form>
					<div class="informacao" >
						<?php 
						
						if($letra==""){
							$letra="Todos";
						}
						if($letra=="FOTOS"){
							echo"COM FOTO".". Mostrando ".$to." de ".$numTotalFotos." ocorrência(s)." ;
						}else{;
							if(isset($numTotalListaBusca)){
								echo"<span style='text-transform:uppercase'>" .$letra. "</span>. Mostrando ".$to." de ".$numTotalListaBusca;
							}else{
								echo $letra.'. Mostrando '.$to.' de ';
								if($letra=="LISTA GERAL"){echo $numTotalListaGeral  ;};
								if($letra=="PARA ORCAMENTO"){echo $numTotalParaOrcamento  ;};
								if($letra=="AGUARDANDO"){echo $numTotalPendencia  ;};
								if($letra=="ORCAMENTO PRONTO"){echo $numTotalOrcamentoPronto  ;};
								if($letra=="SERVICO PRONTO"){echo $numTotalServicoPronto  ;};
								if($letra=="APARELHO SAIU"){echo $numTotalAparelhoSaiu  ;};
								if($letra=="RETORNOU"){echo $numTotalRetornou  ;};
								if($letra=="DEVOLVEU"){echo $numTotalDevolveu  ;};
								if($letra=="COMPROU"){echo $numTotalComprou  ;};
								if($letra=="DOOU"){echo $numTotalDoou  ;};
								if($letra=="VENDEU"){echo $numTotalVendeu  ;};
								if($letra=="ABANDONOU"){echo $numTotalAbandonou  ;};
								if($letra=="SUMIU"){echo $numTotalSumiu  ;};
								if($letra=="ROUBADO"){echo $numTotalRoubado  ;};
								if($letra=="DICA"){echo $numTotalDica  ;};
								if($letra=="ENTREGOU ERRADO"){echo $numTotalEntregouErrado  ;};
								if($letra=="PRAZO"){echo $numTotalPrazo  ;};
								if($letra=="LIGOU"){echo $numTotalLigou  ;};
							} ;
							echo " ocorrência(s).";
						};
						// volta atulizando como GERAL, quando excluir o ultimo cadastro de algum botao lateral vertical da home  
						if ($to == 0){
							$_SESSION["informacao"]="Nenhum resultado para ".$letra;
							echo"<script>document.location='../php/ordenacao.php?nome=0'</script>";
							exit;
						};
						
						// so aparece o o formulario de mudar de pagina, se aparecer os tres pontinhos
						// ($i < $total), atua quando aparece os tres pontinhos no lado direito, enquanto 
						// ($limite > 10) atua quando aparece os tres pontinhos no lado esquerdo
						if (($i < $total) OR ($limite > 10))  {
						?>
							<form  class="form_rodape" name="form_pagina" action="home.php" method="post" >
								<div class="linha">
									<div class="col col-10">
										<div class="col col-7">
											<input class="input_rodape" title="Digite um número"  type="number" id="goPag" min="1" step="1" onkeypress=';contaCaracter();return SomenteNumero(event);' required="true"  name="pagina" value="<?= $numero_de_pagina ?>" />
										</div>
										<div class="col col-3">
										<button type="submit" title="Clique para ir para outra página" class="botao-mudar-pagina" onclick="return validar()">Ir</button>
										</div>
									</div>
								</div>
							</form>
						<?php 
						};
						?>
					</div> 
				</div>
				<div class="col col-10 div_rodape_tabela" >
				<!-- botao imprimi selecionados -->
				<button type="submit" id="botao-imprimiHome" class="botao but-azul sumido" title="Clique para imprimir os cadastros marcados" onclick="document.getElementById('txtHome').click();" ><i class="fas fa-print"></i><span class="espaco">Imprimir</span></button>
				<!--	
				<button title="Clique para marcar todos" class="botao" onclick="document.getElementById('botao-imprimiHome').style.display = 'block';marcarHome();" ><i class="fas fa-check-square" ></i><span class="espaco">Marcar</span></button>						     
				<button title="Clique para desmarcar todos " class="botao"  onclick="document.getElementById('botao-imprimiHome').style.display = 'none';desmarcarHome();"><i class="fas fa-square"></i><span class="espaco">Desmarcar</span></button>	
		-->
				</div>
			<?php 
			}; 
			?> 
			
			<script>
					
				// maximo de 5 numeros no campo 'IR' para passar de pagina 
				const myNumberInput = document.getElementById("goPag");
				const maxLength = 5; 
				myNumberInput.addEventListener('input', function(event) {
					if(this.value.length > maxLength){
						this.value = this.value.slice(0, maxLength);
						alert('Atingiu o máximo de caracteres no campo');
						this.value = '';
					}
				});
				//campon 'IR' para a pagina, da pagina HOME
				function validar(){
					var pagina = form_pagina.pagina.value;
					if(pagina =="" || pagina == <?=$pagina ?> || pagina ==0 || pagina > <?=$total ?> ){
						alert('AÇÃO   INVÁLIDA');
						return false;	
					};
				};
               
				// mostrar mais botoes
				function maisBotoes() {
					if (document.getElementById("maisBotoes").style.display == "block") {
						document.getElementById("maisBotoes").style.display = "none";
						//document.querySelector("#botoes").style.setProperty('background-color','rgb(68, 115, 153)','important');
						document.querySelector('.but-mais').classList.remove('but-menos');
						document.getElementById("botoes").innerHTML = "BOTÕES +<div id='contaBotoes' class='resultado'><?php echo $botoes; ?>";
					} else {
						document.getElementById("maisBotoes").style.display = "block";
						document.getElementById("maisBotoes").style.marginTop = "1px";
						//document.querySelector("#botoes").style.setProperty('background-color','#944','important');
						document.querySelector('.but-mais').classList.add('but-menos');
						document.getElementById("botoes").innerHTML = "BOTÕES -<div id='contaBotoes' class='resultado'><?php echo $botoes; ?>";
					};
					
				};
				
				/*
				// codigo para mudar a cor do botao BOTOES + 
				document.querySelector('.but-mais').addEventListener('click', function(){
					this.classList.toggle('but-menos');
				});
                */

				// conta a quantidade de checkbox marcados e coloca na variavel checado
				function verificaImp(){
					let checado = document.querySelectorAll('input[class="checkImprimi"]:checked').length;
					if(checado > 1){
						document.getElementById("botao-imprimiHome").style.display = 'block';
					}else{
						document.getElementById("botao-imprimiHome").style.display = 'none';
					};
				};
				/*
				function marcarHome(){
					var boxes = document.getElementsByName("numeros[]");
					for(var i = 0; i < boxes.length; i++)
						boxes[i].checked = true;
				}
				function desmarcarHome(){
					var boxes = document.getElementsByName("numeros[]");
					for(var i = 0; i < boxes.length; i++)
						boxes[i].checked = false;
				}	
				*/
			</script> 
			<?php // Codigo para mostrar a mensagem biblica
			$mensagens = $resultado['checkMensagem'];
			require_once 'mensagem_oficina.php';
			require_once 'formulario.php';
			?> 
			<script src="../js/funcoes.js"></script>
		</div>
	</body>
</html>