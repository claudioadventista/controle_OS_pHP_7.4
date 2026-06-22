<?php
/*
		formulario de cadastro -------------- 53
		configuracao vertical --------------- 483
		tabela de funcionario --------------- 507
		formulario de configuracoes --------- 725
		tabela aparelho, marca e modelo ----- 873
		formulario alterar aparelho --------- 1081
		formulario alterar marca ------------ 1112
		formulario alterar modelo ----------- 1143
		foto ampliada ----------------------- 1174
		formulario ligar -------------------- 1189
		formulario de funcionario ----------- 1387
		Pagina Sobre ------------------------ 1667
		excluidos permanentemente ----------- 1721
		ver cadastro ------------------------ 1787
		ver alteracoes ---------------------- 2118
		formulario  de retorno -------------- 2159
		funciona bem acima de 
		whidth 1129
		height 825
		criado em 2014 por claudioadventista@hotmail.com
*/
require_once '../php/consulta.php';
@session_start();
$paginaAtiva = $_SESSION['pagina'];
?>
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
			/* essa classe serve para pintar os caracteres encontrados na tabela,  em excluidos permanentemente */
			.destaque{
				background:yellow;
			}
		</style>
	</head>
	<body>
		<!-- formulario de cadastro e alteracao -->
		<div id="form_alteracao" class="formulario_cadastro">
			<div class="cabecario_padrao">             	  	            	  	    
				<span title="Clique para fechar o formulário novo cadastro e alterar cadastro" class="simbolo_padrao" onclick="document.getElementById('form_alteracao').style.display='none';resetForm();">&times</span>
				<span class="atualizar_pagina" title="clique para atualizar a página" onclick="document.location.reload(true);" >&#8635</span>
				<b> 
					<span id="textoForm" class="texto"></span>  
				</b>
			</div>
			<div class="linha">
					<div class="col col-10">
						<form id="formulario_alteracao" name="formulario" action="../php/cadastro.php"  method="post" autocomplete="off" enctype="multipart/form-data" > 
							<input type="hidden" id="codigoAlt" name="codigo" value=""/>
							<input type="hidden" id="zerosAlt" name="zerosAlt" value="<?php echo $resultado['zeros'];?>"/>
							<div class="col col-5">
								<div class="linha">
									<div class="col col-1 topo">
										<span class="t t-vermelho" >* O.S.</span>
										<input type="text"  id="ordemServicoAlt" required name="ordemServico2" maxlength="7" autofocus autocomplete="off" value="<?php if($resultado['os_auto']<>""){ if($resultado['zeros']<>"sim"){ echo  str_pad($resultado['cont_os'],7,'0',STR_PAD_LEFT) ;}else{echo $resultado['cont_os'];};}; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57'  /> 
									</div>
									<div class="col col-9 topo">
										<span class="t t-vermelho" >* Nome</span>
										<input type="text" class="input"  id="nomeAlt" name="nome" maxlength="100" value="" onkeyup="corrigirValor(this)" />
									</div>	
								</div>
								<div class="linha">
									<div class="col col-1-3 topo">
										<span class="t">Telefone</span>
										<input type="text" id="telefoneAlt" name="telefone" placeholder="(99)99999-9999" maxlength="14" value="" onkeyup="fMasc( this, mTel );" />
									</div>
									<div class="col col-1-3 topo">
										<span class="t">Telefone 2</span>
										<input type="text" id="telefone2Alt" name="telefone2" placeholder="(99)99999-9999" maxlength="14" value="" onkeyup="fMasc( this, mTel );" />
									</div>
									<div class="col col-1-3 topo">
										<span class="t">CPF</span>
										<input type="text" id="cpfAlteracaoAlt" name="cpf" autocomplete="off"   placeholder="999.999.999-99" maxlength="14" value="" onkeypress='return event.charCode >= 48 && event.charCode <= 57;' autocomplete="off" onkeyup="fMasc( this, mCPF )" onBlur="Cpf_Alteracao();" onclick="desabilitaBotoes();" >
									</div>
								</div>	  
								<div class="linha">
									<div class="col col-6 topo">
										<span class="t">Endereço</span>
										<input type="text" id="enderecoAlt" name="endereco"  maxlength="200"   value="" onkeyup="corrigirValor(this)"/>
									</div>
									<div class="col col-4 topo">
										<span class="t">Nascimento</span>
										<input type="date" id="dtNascimentoAlt" name="dtNascimentoAlt"  value="" />
									</div>
								</div>
								<div class="linha">
									<div class="col col-5 topo">
										<span class="t"> Estado</span>
										<select id="estadoAlt" name="estado" >
										</select>
										<input type="text" id="estadoNaoModificavel" value="" class="sumido" readonly >
									</div>
									<div class="col col-5 topo">	  				
										<span class="t"> Email </span>
										<input type="text" id="emailAlt" name="email" maxlength="100" value="" onblur="validaEmailUsuario()" />
									</div>	
								</div>
								<div class="linha">
									<div id="aparelho1" class="col col-5 topo">
										<span class="t t-vermelho" >* Aparelho / Veículo</span>
										<select id="aparelhoAlt" name="aparelho" >    
											<option id="aparelhoAlt11" value=""></option>  
										</select>
										<input type="text" id="aparelhoNaoModificavel" value="" class="sumido" readonly >
									</div>
									<div class="col col-5 topo" id="campoAparelho">	  				
										<span class="t"> Novo Aparelho </span>
										<input type="text" id="novoAparelhoAlt" class="input t-Mausculo" name="novoAparelho"  maxlength="50"  value="" onblur="buscar_novo_aparelho();" />
									</div>	
								</div>  	
								<div class="linha">
									<div class="col col-10"></div>
								</div>
								<div class="linha">
									<div id="marca1" class="col col-5 topo">
										<span class="t t-vermelho">* Marca</span>
										<select id="marcaAlt" name="marca" >    
											<option id="marcaAlt11" value=""></option>  
										</select>
										<input type="text" id="marcaNaoModificavel" value="" class="sumido" readonly >
									</div>
									<div class="col col-5 topo" id="campoMarca">
										<span class="t"> Nova Marca </span>
										<input class="input t-Mausculo" inputmode="text" id="novaMarcaAlt" name="novaMarca" type="text"  maxlength="60"  value="" onblur="buscar_nova_marca();"/>
									</div>
								</div>	  
								<div class="linha">
									<div class="col col-10"></div>
								</div>	
								<div class="linha">
									<div id="modelo1" class="col col-5 topo">
										<span class="t t-vermelho">* Modelo</span>
										<select id="modeloAlt" name="modelo" >    
											<option id="modeloAlt11" value=""></option>  
										</select>
										<input type="text" id="modeloNaoModificavel" value="" class="sumido" readonly >
									</div>
									<div class="col col-5 topo" id="campoModelo">
											<span class="t"> Novo Modelo </span>
										<input class="input t-Mausculo" inputmode="text" id="novoModeloAlt" name="novoModelo" type="text"  maxlength="100"  value="" onblur="buscar_novo_modelo();" />
									</div>	
								</div>
								<div class="linha">
									<div class="col col-10"></div>
								</div>
								<div class="linha">
									<div class="col col-5 topo">
										<span class="t">Número Série</span>
										<input class="input t-Mausculo" autocomplete="off" id="numeroSerieAlt" name="numeroSerie" type="text"  maxlength="100" value="" >
									</div>
									<div class="col col-5 topo">
										<span class="t">Chassi</span>
										<input class="input t-Mausculo" id="chassiAlt" name="chassi" type="text" maxlength="100" value="" >                                    
									</div>
								</div>
								<div class="linha">
										<div class="col col-1-4 topo">
											<span class="t">Imei</span>
											<input type="text" id="imeiAlt" class="input" name="imei" maxlength="15" value="" onkeypress='return event.charCode >= 48 && event.charCode <= 57;' autocomplete="off" />
										</div>
										<div class="col col-1-4 topo">
											<span class="t">Placa Normal AAA-9999</span>
											<input type="text" id="placaNormalAlt" class="input t-Mausculo" name="placaNormal" title="Digite a placa nesse modelo AAA-9999" maxlength="8" value="" onblur="validaPlacaN();" />
										</div>
										<div class="col col-1-4 topo">
											<span class="t">Placa Mercosul AAA9A99</span>
											<input type="text" id="placaMercosulAlt" class="input t-Mausculo" name="placaMercosul" title="Digite a placa nesse modelo AAA9A99" maxlength="7" value="" onblur="validaPlacaM();" />
										</div>
										<div class="col col-1-4 topo">
											<span class="t">Renavam</span>
											<input type="text" id="renavamAlt" class="input" style="width:103%;" name="renavam" autocomplete="off"  maxlength="11" value="" onkeypress='return event.charCode >= 48 && event.charCode <= 57;' autocomplete="off" >
										</div>
								</div>	
								<div class="linha">
									<div class="col col-10 topo">
										<span class="t t-vermelho" >* Defeito</span>
										<input id="defeitoAlt" name="defeitoReclamado" type="text"  maxlength="250" value=""  onKeyup="pri_mai(this);" />
									</div>
								</div>
								<div class="linha">
									<div class="col col-10 topo">
										<span class="t" >Acessório</span>
										<input id="acessorioAlt" class="input" style="width:99%;" name="acessorio" type="text" maxlength="250"   value=""  onKeyup="pri_mai(this);" />
									</div>
								</div>
								<div class="linha">
									<div class="col col-10 topo">
										<span class="t" >Cor / Observação</span>
										<input class="input" id="observacaoAlt" style="width:99%;" name="observacao" type="text"  maxlength="250" value="" onKeyup="pri_mai(this);" />
									</div>
								</div>
								<div class="linha">
									<div class="col col-1-3 topo">
										<span class="t">Entrada</span><!--<span id="horaEntrada"></span>-->
										<input  class="input" id="dataEntradaAlt"  name="dataEntrada" type="datetime-local" value=""  />
									</div>
									<div class="col col-1-3 topo">
										<span class="t">Pronto</span>
										<input  class="input" id="dataProntoAlt" name="dataPronto"  type="datetime-local" value=""  />
									</div>
									<div class="col col-1-3 topo">
										<span class="t">Saída</span>
										<input  class="input" style="width:101%;" id="dataSaidaAlt" name="dataSaida"  type="datetime-local" value=""  />
									</div>
								</div>
							</div> 
							<div class="col col-5">
								<div class="linha">
									<div class="col col-10 topo">
										<span class="t" >Material</span>
										<textarea class="textarea" cols="10" rows="5" id="materialAlt" name="material"  autocomplete="off" maxlength="254" onKeyup="pri_mai(this);" ></textarea>
									</div>
								</div>
								<div class="linha">	
									<div class="col col-1-7 topo">
										<span class="t" >Orçamento</span>
										<input placeholder="R$" maxlength="13" class="input" id="orcamentoAlt"  name="orcamento" type="text"  autocomplete="off" ng-maxlength="10" onKeyUp="if(this.value.length > 10 && event.keyCode != 8){alert('O valor maximo é 999.999,99');this.value = '';};" onKeyPress="return(moeda(this,'.',',',event))" onblur="calcular();" value="" />
									</div>
									<div class="col col-1-7 topo">
										<span class="t">Desconto</span>
										<input placeholder="R$" class="input" id="descontoAlt" name="desconto" type="text"  maxlength="8" autocomplete="off" onKeyUp="if(this.value.length > 10 && event.keyCode != 8){alert('O valor maximo é 999.999,99');this.value = '';};" onKeyPress="return(moeda(this,'.',',',event))" onblur="calcular();" value="" />
									</div>
									<div class="col col-1-7 topo">
										<span class="t" style="font-weight:bold;">Total a Vista</span>
										<input class="input" id="comDescontoAlt" name="" type="text" placeholder="R$"  style="background: #EEE8AA;" value="" readonly />
									</div>
									<div class="col col-1-7 topo">
										<span class="t" >Peça</span>
										<input  placeholder="R$" class="input" id="valorPecaAlt" name="valorPeca" maxlength="8" autocomplete="off" onKeyUp="if(this.value.length > 10 && event.keyCode != 8){alert('O valor maximo é 999.999,99');this.value = '';};" onKeyPress="return(moeda(this,'.',',',event))" type="text" onblur="calcular();" value="" />
									</div>
									<div class="col col-1-7 topo">
										<span class="t" >Mat. Aux.</span>
										<input placeholder="R$" class="input" id="materialAuxiliarAlt" name="materialAuxiliar" maxlength="8" autocomplete="off" onKeyUp="if(this.value.length > 10 && event.keyCode != 8){alert('O valor maximo é 999.999,99');this.value = '';};" onKeyPress="return(moeda(this,'.',',',event))" type="text" onblur="calcular();" value=""/>
									</div>
									<div class="col col-1-7 topo">
										<span class="t" >Transporte</span>
										<input placeholder="R$" class="input" id="transporteAlt" name="transporte" maxlength="8" autocomplete="off" onKeyUp="if(this.value.length > 10 && event.keyCode != 8){alert('O valor maximo é 999.999,99');this.value = '';};" onKeyPress="return(moeda(this,'.',',',event))" type="text" onblur="calcular();" value=""/>
									</div>
									<div class="col col-1-7 topo">
										<span class="t" >Lucro</span>
										<input class="input" id="lucroAlt" name="lucro" type="text"  placeholder="R$"  maxlength="8" autocomplete="off" style="background: #EEE8AA;" value="" readonly />
									</div>
								</div>
								<div class="linha">
									<div class="col col-10 fiado" >	
										<div class="col col-2">
											<span class="t" >A Prazo</span>
											<input class="input-checkbox" id="aPrazoAlt" name="aPrazo" type="checkbox" onclick='
												document.getElementById("campoPagou").style.visibility ="visible";if (this.checked) {aPrazoCheked();}else{aPrazoNoCheked();};'/>
										</div>
										<div id="checkPrazo" >	
											<div class="col col-1-7">
												<span class="t">Entrada</span>
												<input placeholder="R$" class="input" id="inicialAlt" name="inicial" type="text"  maxlength="8" autocomplete="off" onKeyUp="if(this.value.length > 10 && event.keyCode != 8){alert('O valor maximo é 999.999,99');this.value = '';};" onKeyPress="return(moeda(this,'.',',',event))" onblur="calcularRestante();" value=""/>
												<span class="t" >Restante</span>
												<input placeholder="R$" class="input" id="restanteAlt" name="restante" maxlength="8" autocomplete="off" style="background: #EEE8AA;" onKeyPress="return(moeda(this,'.',',',event))" type="text" readonly value=""/>
											</div>
											<div class="col col-1-3">
												<span class="t" id="pagarRestante" >Data para pagar o restante</span>
												<input  class="input" id="dataPagamentoAlt" name="dataPagamento" type="date" value=""  />	
												<div id="dataPagou">
													<span class="t" >Data que pagou o restante</span>
													<input  id="dataPagouAlt" class="input" name="dataPagou" type="date" value=""  />
												</div>
											</div>
											<div class="col col-1-5" id="campoPagou">
												<span class="t" >Pagou</span>
												<input class="input-checkbox" id="pagouAlt" name="pagou" type="checkbox" onclick='if (this.checked) {document.getElementById("dataPagou").style.visibility ="visible";document.getElementById("dataPagouAlt").value = "";}else{document.getElementById("dataPagou").style.visibility ="hidden";};' />
											</div>
										</div>
									</div>
								</div>
								<div class="linha">	
									<div class="col col-10 cartao" >
										<div class="col col-2">
											<span class="t" >Cartão</span>
											<input class="input-checkbox" id="cartaoAlt" name="cartao" type="checkbox" onclick='if (this.checked){cartaoChecked();}else{cartaoNoChecked();};'/>
										</div>
										<div id="campoCartaoAlt" style="visibility: hidden;">
											<div class="col col-1-7">
												<span class="t t-vermelho">* Tipo</span>
												<select id="escolhaCartaoAlt" style="width:100%;" name="escolhaCartao" onchange="escolhaTipo();">
													<option></option>		
													<option name="debito" class="t" >DÉBITO</option>
													<option name="credito" class="t" >CRÉDITO</option>
												</select>
											</div>
											<div id="camposCartao" style="visibility :hidden;">
												<div class="col col-3">
													<span class="t" >Bandeira</span>
													<select id="bandeiraCartaoAlt" style="width:100%;" name="bandeira_cartao">
														<option></option>
														<option name="" >ELO</option>
														<option name="" >VISA</option>
														<option name="" >ALELO</option>
														<option name="" >HIPPERCARD</option>		
														<option name="" >MASTERCARD</option>
														<option name="" >AMERICAN EXPRESS</option>
													</select>
												</div>
												<div class="col col-1-8">
													<span class="t" >Parcelas</span>
													<input  class="input" id="parcelasCartaoAlt" name="parcelasCartao" maxlength="3" autocomplete="off" style="font-weight:bold;"type="number" min="1" max="36" step="1" value="" onblur="calculaTotalParcela();"/>
												</div>
												<div class="linha">	
											<div class="col col-10 cartao m-top" >
												<div class="col col-2">
												</div>

											<div class="col col-1-7">
													<span class="t" >Total</span>
													<input class="input" id="valorParcelas" name="" type="text" placeholder="R$" autocomplete="off" style="background: #EEE8AA;" readonly  value="" />
												</div>
												<div class="col col-1-7">
													<span class="t" >Juros / Mês</span>
													<input placeholder="R$" class="input" id="jurosCartaoAlt" name="jurosCartao" type="text"  maxlength="5" autocomplete="off" onKeyUp="if(this.value.length > 10 && event.keyCode != 8){alert('O valor maximo é 999.999,99');this.value = '';};"  onKeyPress="return(moeda(this,'.',',',event))" value="" onblur="calculajuros();" />
												</div>
												<div class="col col-1-7">
													<span class="t" >Total / Juros</span>
													<input class="input" id="somaJurosAlt" name="" type="text" placeholder="R$" autocomplete="off" style="background: #EEE8AA;" value="" readonly />
												</div>
												
												<div class="col col-1-7">
													<span class="t" >Orçam./juros</span>
													<input class="input" id="orcComJurosAlt" name="" type="text" placeholder="R$"  maxlength="5" autocomplete="off" style="background: #EEE8AA;"  value="" readonly />
												</div>
											</div>
										</div>
									</div>
									</div>
								</div>
								</div>
								<div class="linha">
									<div class="col col-1-3">
										<div class="logomarca">
											<img id="fotoCliente1" class="img_cadastro" height="100%" width="100%"  onclick="document.getElementById('fotoAmpliada').style.display='block';document.getElementById('foto_ampliada').src = fotoCliente1.src ;"/>
										</div>
									</div>
									<div class="col col-1-3">
										<div id="logomarca" class="logomarca">
											<img id="fotoCliente2" class="img_cadastro" height="100%" width="100%" onclick="document.getElementById('fotoAmpliada').style.display='block';document.getElementById('foto_ampliada').src = fotoCliente2.src ; "/>
										</div>
									</div>
									<div class="col col-1-3">
										<div class="logomarca ">
											<img id="fotoCliente3" class="img_cadastro" height="100%" width="100%" onclick="document.getElementById('fotoAmpliada').style.display='block';document.getElementById('foto_ampliada').src = fotoCliente3.src ; "/>
										</div>
									</div>
								</div>		
								<div class="linha">
									<div class="col col-10 rodape" >
										<div class="col col-1-3">
											<button type="button" title="Clique para escoher uma imagem" class="botao"  onclick="document.getElementById('foto5').click();"  ><i class="fas fa-image"></i><span class="espaco">Imagem 1</span></button>
											<button type="button" id="botaoLimpar" title="Clique para limpar o campo imagem 1" class="botao" onclick="limparCacheImagem();"><i class="fas fa-eraser"></i><span class="espaco">Limpar</span></button>
											<input id="foto5" type="file" name="foto1" >
											<span id="excluirFoto1" style="visibility:hidden;width:50px;margin-left:3px;">
												<span style="position:relative;right:10px;"> Excluir</span>
												<input style="position:relative;top:6px;right:10px;" id="excluir-foto1" name="excluir-foto1" type="checkbox" />
											</span>
										</div>
										<div class="col col-1-3">
											<button type="button" title="Clique para escolher uma segunda imagem" class="botao" onclick="document.getElementById('foto6').click();" ><i class="fas fa-image"></i><span class="espaco">Imagem 2</span></button>
											<button type="button" id="botaoLimpar2" title="Clique para limpar o campo imagem 2" class="botao" onclick="limparCacheImagem2();"><i class="fas fa-eraser espaco"></i><span class="espaco">Limpar</span></button>	
											<input id="foto6" type="file" name="foto2" >
											<span id="excluirFoto2" style="visibility:hidden;width:50px;margin-left:3px;">
												<span style="position:relative;right:10px;"> Excluir</span>
												<input style="position:relative;top:6px;right:10px;" id="excluir-foto2" name="excluir-foto2" type="checkbox" />
											</span>
										</div>
										<div class="col col-1-3">
											<button type="button" title="Clique para escolher uma terceira imagem" class="botao" onclick="document.getElementById('foto3').click();" ><i class="fas fa-image"></i><span class="espaco">Imagem 3</span></button>
											<button type="button" id="botaoLimpar3" title="Clique para limpar o campo imagem 3"  class="botao" onclick="limparCacheImagem3();"><i class="fas fa-eraser espaco"></i><span class="espaco">Limpar</span></button>	
											<input id="foto3" type="file" name="foto3" >
											<span id="excluirFoto3" style="visibility:hidden;width:50px;margin-left:3px;">
												<span style="position:relative;right:10px;"> Excluir</span>
												<input style="position:relative;top:6px;right:10px;" id="excluir-foto3" name="excluir-foto3" type="checkbox" />
											</span>	
										</div>
									</div>
								</div>
								<div class="linha">
									<div class="col col-1-4" style="text-align: center;background: white;">
										<i style="font-size:2em;cursor:default;" class="fas fa-barcode"></i>
										<input type='text' id="barraAlt" class="input" style="text-align:center;margin-left:0;width:90%;"   value="" readonly />	
									</div>
									<div class="col col-1-4 topo" >
										<span style="position:relative;top:-6px;"><center>Valor Estimado</center></span>	
										<div class="col col-10">
											<input  placeholder="R$" class="input" id="valorObjeto" title="Digite um valor estimado para o objeto" name="valorObjeto" maxlength="8" autocomplete="off" onKeyUp="if(this.value.length > 10 && event.keyCode != 8){alert('O valor maximo é 999.999,99');this.value = '';};" onKeyPress="return(moeda(this,'.',',',event))" type="text" value="" />
										</div>
									</div>
									<div class="col col-1-4 div_ligar" >
										<button type="button" id="botaoLigar" class="botao" style="visibility:hidden;"  onclick="document.getElementById('formLigar').style.display='block';" ><i class="fas fa-phone"></i><span class="espaco">Ligar</span><span class="espaco" id="qantidade_ligacao" ></span></button>  			
									</div>
									<div class="col col-1-4" >
										<input id="totalPagarAlt" name="" type="text" style="font-weight:bold;background: #EEE8AA;height:45px;font-size:2.5em;text-align:center;" value="" readonly />
									</div>	
								</div>
								<div class="linha">
									<div class="col col-10" style="background:#eee;">
										
									</div>
								</div>	
							</div>
							<!-- botoes do rodape do formulario de cadastro e alteracao -->
							<div class="linha">
								<footer class="col col-10 div_rodape">
									<button type="submit" class="botao" id="cadastroAlt" name="botaoSubmeter" value=""  onclick="return validarForm();" ></button>
									<!-- Estudei muito nesse codigo para enviar o valor para a pagina excluir -->
									<?php if($paginaAtiva=="home.php"){;?>
										<!--<a title="Clique para excluir o cadastro" id="excluir_cadastro" href="#" style="display:block;"
												OnClick="this.href='../php/excluir_cliente.php?acao=excluir&codigo='+ 
												document.getElementById('codigoAlt').value;
												return confirm('Clique em OK para confirmar a exclusão da O.S. : '+ 
												document.getElementById('ordemServicoAlt').value + '\n' +
												'Nome : ' + document.getElementById('nomeAlt').value);"><button class="botao" >
											Excluir
									</button></a>
									--> 
									<!-- pega a id do input e manda para outra página por link a href no onclick -->
									<button class="botao" href="#" id="excluirNovo" OnClick="this.href='../php/excluir_cliente.php?codigo='+document.getElementById('codigoAlt').value;return confirm('Confirma Exclusão da  O.S. '+document.getElementById('codigoAlt').value +'\n' +document.getElementById('nomeAlt').value)" title="Clique para excluir o cadastro"><i class='excluir_home fas fa-trash'></i><span class="espaco">EXCLUIR</span></button>  
									<?php };?>
									<button type="button" class="botao" title="Clique para imprimir a O.S." id="lb_salvar_imprimir_os" onclick="document.getElementById('salvar_imprimir_os').click();"><i class="fas fa-print"></i><span class="espaco">IMPR. OS</span></button>
									<input type="submit" class="sumido" name="salvar_imprimir_os"  id="salvar_imprimir_os" value="" onclick="return validarForm();" />
									<button type="button" class="botao" id="lb_salvar_imprimir" title="Clique para imprimir o cadastro no talão" onclick="document.getElementById('salvar_imprimir').click();"><i class='fas fa-print espaco'></i><span class="espaco">IMPR. TALÂO</span></button>
									<input  type="submit" class="sumido" name="salvar_imprimir" id="salvar_imprimir" value="" onclick="return validarForm();" />
									<!--<span title="Clique para fechar o formulário novo cadastro e alterar cadastro" class="simbolo_padrao" onclick="document.getElementById('form_alteracao').style.display='none';resetForm();">&times</span>-->
									<button type="button" class="botao but_fechar" title="Clique para fechar o formulário novo cadastro e alterar cadastro" onclick="document.getElementById('form_alteracao').style.display='none';resetForm();"><i class='fas fa-times but-fechar espaco'></i><span class="espaco">Fechar</span></button>
								</footer>
							</div>	   			
						</form>
					</div>
				</div>
			</div><!-- fim formulario de cadastro e alteracao -->

		<!-- div configuracao vertical -->   
		<div id="div_configuracao" class="mascara ">	
				<div class="navegacao_vertical_configuracao">	 	
					<div class="cabecario_padrao" style="left:1px;" >
						<span class="simbolo_padrao" onclick="document.getElementById('div_configuracao').style.display = 'none';" title="Clique para fechar as configurações" >&times</span>
						<span class="atualizar_pagina" title="clique para atualizar a página" onclick="document.location.reload(true);" >&#8635</span>
						<span class="texto">Config.</span>   
					</div>
					<div class="div_botoes_configuracao">
						<button title="Clique para ir para o formulário de configurações" class="botao" onclick="verificaConfiguracoes();" >Geral</button>
						<button title="Clique para ir para a tabela de aparelho, marca e modelo" class="botao" onclick="document.getElementById('div_aparelho').style.display = 'block';" >Aparelho</button>		 
						<button title="Clique para ir alterar dados pessoais" class="botao" onclick="document.getElementById('div_funcionario').style.display = 'block';" >Pessoal</button>			
						<a href="talao.php" ><button title="Clique para imprimir talão" class="botao">Talão</button></a>		
						<?php if($numTotclientesExcluidos<>0){; ?>	
						<a href="../html/excluidos.php"><button title="Clique para ir para a página de cadastro excluído" class="botao">C. Excluído</button></a>
						<?php }; ?>	
						<?php
						if($totalExcPermanente <> 0){; ?>
							<button title="Clique para a página de excluído permanentemente" class="botao" onclick="document.getElementById('ver_excluidos').style.display = 'block';document.getElementById('campoBusca').focus();">P. Excluído</button>		
						<?php } ?>
						<button class="botao" onclick="document.getElementById('sobreHome').style.display = 'block';" title="Clique para informação sobre o sistema"><i class="fas fa-exclamation-circle"></i><span  class="espaco">Sobre</span></button>
					</div>  	     		
				</div>
		</div> <!-- Fim div da tela de configuracoes -->	

		<!-- div tabela de funcionario -->
		<div id="div_funcionario" class="formulario_cadastro">	
			<div class="cabecario_padrao">             	  	            	  	    
				<span class="simbolo_padrao"  title="Clique para fechar"  onclick="document.getElementById('buscaFuncionario').value='';document.getElementById('div_funcionario').style.display = 'none';">&times</span>
				<span class="atualizar_pagina" title="clique para atualizar a página" onclick="document.location.reload(true);" >&#8635</span>
				<span class="texto">Altera dados pessoais, e o tema</span>
			</div>
			<div class="linha">
				<div class="col col-1-3"></div>
				<div class="col col-1-3">
					<?php
					$nulo = '';
						$listagerente = $conexao->prepare("SELECT codigo, usuario, barra_funcionario, nivel_acesso, excluiu   FROM funcionario WHERE excluiu = ? ORDER BY usuario ASC");
						$listagerente->execute([$nulo]);
						$totalGerente = $listagerente->rowCount();
						$linha = $listagerente->fetch();
					?>
					<form action="imprimir_funcionario.php" method="post" autocomplete="off"> 
						<div class="scroll_lateral_esquerdo">
							<input id="buscaFuncionario" type="hidden" /> 
							<?php
							if (($linha['usuario']<>"admin")AND($linha['excluiu']=="")) {; 
							?>	
								<div class="linha">	
									<div class="col col-5 cursor_pointer campo_usuario" title="Clique para alterar os dados" onclick="document.getElementById('buscaFuncionario').value='<?php echo $linha['barra_funcionario']; ?>';verificaFuncionario();">
										<span class="texto_usuario"><?php echo $linha['usuario'] ;?></span>
									</div>
									<div class="col col-2 campo_usuario">
										<i class="botao_tabela botao-tabela fas fa-edit"  title="Clique para alterar os dados"  onclick="document.getElementById('buscaFuncionario').value='<?php echo $linha['barra_funcionario']; ?>';verificaFuncionario();"></i>
										<a href="imprimir_funcionario.php?FuncCod=<?php echo $linha['codigo']; ?>&Modo=individual" title="Clique para imprimir os dados"><i class="botao_tabela botao-tabela fas fa-print"></i></a>
									</div>
								</div>
							<?php  
							;}; 
							?>	 
						</div>
					</form>
				</div>
			</div>   		
		</div>	<!-- fim div tabela de funcionario-->

		<!-- formulario de configuracoes-->
		<div id="div_form_configuracao" class="formulario_cadastro">  	
			<div class="cabecario_padrao">             	  	            	  	    
				<span title="Clique para fechar o formulário de configurações" class="simbolo_padrao" onclick="document.getElementById('div_form_configuracao').style.display='none';resetForm();" >&times</span>
				<span class="atualizar_pagina" title="clique para atualizar a página" onclick="document.location.reload(true);" >&#8635</span>
				<span class="texto">Geral</span>   
			</div>
			<!-- inicio do formulario -->  		
			<form id="formulario" name="frmEnviaDados" class="form-horizontal" action="../php/cadastro_configuracoes.php"  method="post" enctype="multipart/form-data" autocomplete="off" >  
				<div class="linha">
					<div class="col col-10"><br></div>
				</div>
			<div class="linha">  		
					<div class="col col-6">
						<input type="hidden" name="form_configuracao">
						<span class="t" >Nome da Oficina</span>
						<input class="input-1-10" inputmode="text" id="nomeOficina" name="oficina" type="text"  maxlength="50" value="" onkeyup="corrigirValor(this)" />
					</div>
					<div class="col col-2">
						<span>Telefone</span>
						<input  class="input-1-10" inputmode="text" id="telefoneOficina" name="telefone" type="text"  placeholder="(99) 9 9999-9999" maxlength="14" onkeyup="fMasc( this, mTel );" value="" />                                                                                                   
					</div>
					<div class="col col-2">
						<span>Telefone 2</span>
						<input  class="input-1-10" inputmode="text" id="telefone2Oficina" name="telefone2" type="text"  placeholder="(99) 9 9999-9999" maxlength="14" onkeyup="fMasc( this, mTel );" value="" />
					</div>
				</div>
				<div class="linha">
					<div class="col col-10"><br></div>
				</div>
				<div class="linha">
					<div class="col col-8">
						<span class="t">Endereço da Oficina</span>
						<input class="input-1-10" id="enderecoOficina" name="endereco" type="text"  maxlength="100" value="" onkeyup="corrigirValor(this)"/>
					</div>
					<div class="col col-2">
						<span >Técnico Responsável</span>
						<input class="input-1-10" id="usuarioOficina" name="usuario" type="text"  maxlength="15" value=""  onkeyup="corrigirValor(this)" />
					</div>
				</div>
				<div class="linha">
					<div class="col col-10"><br></div>
				</div>
				<div class="linha">
					<div class="col col-10">
						<hr>
					</div>
					<div class="linha">
					<div class="col col-10"><br></div>
				</div>
				</div>  			
				<div class="linha">
					<div class="col col-1">
						<label for="maiusculaOficina"  >&nbsp&nbsp&nbsp&nbsp Maiúscula</label>
						<input title="Marque para Tudo Maiúsculo"  class="input" id="maiusculaOficina" name="maiuscula" type="checkbox"  />
					</div>
					<div class="col col-1">
						<label for="zerosOficina" >&nbsp&nbsp&nbsp&nbsp&nbsp S / Zeros</label>
						<input title="Marque para com zeros a esquerda na O.S."  class="input" id="zerosOficina" name="zeros" type="checkbox" />
					</div>
					
					<div class="col col-1">
						<label for="osAutoOficina" >&nbsp&nbsp&nbsp&nbsp&nbsp OS Auto</label>
						<input class="input"  id="osAutoOficina" name="os_auto" type="checkbox" onclick="bloqueio()" />
					</div>
					<div class="col col-1" id="divContaOs" >
						<span >Iniciar OS</span>
						<input title="Digite o número da OS inicial"  class="input"  id="contaOsOficina" name="cont_os" type="text" autocomplete="off" maxlength="7" onkeyup="if(this.value.length>7){this.value=this.value.substring(0,7);if(this.value.length>0{$('#enviar').attr('disabled',false);})}" onkeypress='return SomenteNumero(event)' value="" />
					</div>		  		
					<div class="col col-1">
						<label for="tecnicoOficina" > C / Técnico</label>
						<input title="Marque para escolher o técnico"  class="input" id="tecnicoOficina" name="tecnico" type="checkbox" />
					</div>
					<div class="col col-1">
						<label for="logomarcaOficina" > C / Logo</label>
						<input title="Marque para escolher o técnico"  class="input" id="logomarcaOficina" name="logomarca" type="checkbox"  />
					</div>
					<div class="col col-1">
						<label for="acentoOficina" > S / Acento</label>
						<input title="Marque para escolher sem acento"  class="input" id="acentoOficina" name="acento" type="checkbox" />
					</div>
					<div class="col col-2">
						<fieldset>
								<legend>Idade para cadastro do Gerente</legend>
							<div class="col col-5">
								<label > Mínima</label>
								<input title="Número de linhas por página" id="idadeMinimaOficina" inputmode="text" class="input" name="idadeMinima" type="text" maxlength="2" autofocus autocomplete="off" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="" />   
							</div>
							<div class="col col-5">
								<label > Máxima</label>
								<input title="Número de linhas por página" id="idadeMaximaOficina" inputmode="text" class="input" name="idadeMaxima" type="text" maxlength="2" autofocus autocomplete="off" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="" />   
							</div>
						</fieldset>
					</div>
				</div>
				<div class="linha">
					<div class="col col-10"><br></div>
				</div>
				<div class="linha">
					<div class="col col-10">
						<span >Mensagem do Rodapé</span>
						<input class="input-1-10" id="rodapeOficina" name="rodape" type="text"  maxlength="254" onKeyup="pri_mai(this);" value="" />
					</div>		  	
				</div>
				<div class="linha">
					<div class="col col-10"><br></div>
				</div>
				<div class="linha">
					<div class="col col-3">
						<fieldset>
							<legend>Escolha a Logomarca</legend>
								<div>
									<button type="button" title="Clique para mudar a logomarca"  class="botao" onclick="document.getElementById('img_logomarca').click();"><i class='fas fa-image'></i><span class="espaco">Escolha</span></button>
									<input id="img_logomarca"  type="file" name="img_logomarca" >
								</div>
						</fieldset>
					</div>
					<div class="col col-2" >
						<div class="logomarca" id="logo_imagem" >   
							<img id="imagem_logo" class="img_cadastro"  height="100%" width="100%" title="Clique para ampliar a imagem" onclick="document.getElementById('fotoAmpliada').style.display='block';document.getElementById('foto_ampliada').src = pictureImage4.src "/>
						</div>	
					</div>
					<div class="col col-2">
					</div>
				</div>
				<div class="linha">
					<div class="col col-10 div_rodape" >
						<button type="submit" class="botao" id="enviar" value="" ><i class='but-verde fas fa-edit'></i><span class="espaco">ALTERAR</span></button>
						<button type="button" class="botao but_fechar" title="Clique para fechar o formulário de configurações" onclick="document.getElementById('div_form_configuracao').style.display='none';resetForm();"><i class='fas fa-times but-fechar espaco'></i><span class="espaco">Fechar</span></button>
					</div>	
				</div>					 							
			</form>	
		</div><!-- fim form configuracoes -->
		<!-- tabela de  aparelho, marca e modelo -->
		<div id="div_aparelho" class="formulario_cadastro">	 	
			<div class="cabecario_padrao">             	  	            	  	    
				<span title="Clique para fechar a tabela aparelho, marca e modelo" class="simbolo_padrao" onclick="limpaCampo();">&times</span>
				<span class="atualizar_pagina" title="clique para atualizar a página" onclick="document.location.reload(true);" >&#8635</span>
				<span class="texto">Aparelho, Marca e Modelo</span>   
			</div>
			<div class="linha">
				<div class="col col-1-3 nav-aparelho">
					<?php
						$listaaparelho = $conexao->prepare("SELECT * FROM aparelho ORDER BY aparelho ASC");
						$listaaparelho->execute();
						$totalAparelhos = $listaaparelho->rowCount();
					?>
					<div class="linha">
						<div class="col col-10 totalAparelhoMarcaModelo">
							<h3><center>A P A R E L H O ( S )&nbsp <?php echo $totalAparelhos;?> </center></h3>
						</div>
					</div>
					<div class="scroll_lateral_esquerdo">	
						<table class="tabela_menus" border="1" cellpadding="2" cellspacing="0">
							<thead>
								<tr>
									<th class="th_10" >
										C O N T
									</th>
									<th class="th_20" >
										N O M E &nbsp&nbsp D O &nbsp&nbsp A P A R E L H O
									</th>
									<th class="th_10">
										A Ç Ã O
									</th>
								</tr>	
							</thead>
							<tbody>
							<?php
								$i = 1;
								while($linha = $listaaparelho->fetch(PDO::FETCH_ASSOC)) {
							?>
							<tr class="linha_home">
								<td class="coluna_numererica"><?php echo $i; ?></td>		
								<td class="cursor_pointer" title="Clique para alterar o aparelho" 
									onclick="document.getElementById('altAparelho').style.display='block';
									document.getElementById('aparelho_alt').value = '<?php echo $linha['aparelho']; ?>';
									document.getElementById('codigoAparelho').value = '<?php echo $linha['codigo']; ?>';">
									<?php echo '<span style="padding-left:10px">' . $linha['aparelho'] . '</span>'; ?>
								</td>
								<td>    	
									<i class="botao_tabela botao-tabela fas fa-edit" title="Clique para alterar o aparelho"
										onclick="document.getElementById('altAparelho').style.display='block';
										document.getElementById('aparelho_alt').value = '<?php echo $linha['aparelho']; ?>';
										document.getElementById('codigoAparelho').value = '<?php echo $linha['codigo']; ?>';">
									</i>
									<a href="../php/excluir_aparelho_marca_estado.php?nome=aparelho&codigo=<?php echo $linha['codigo']; ?>"  title="Clique para excluir o aparelho" OnClick="return confirm('Confirme com ( OK ) ou cancele a exclusão do aparelho abaixo \n <?php echo $linha['aparelho']; ?>')"><i class="botao_tabela botao-tabela excluir_home fas fa-trash"></i></a>
								</td>
							</tr>
							<?php $i++;  } ?>	
							</tbody>
						</table>
					</div>	
					<div class="linha">
						<div class="col col-10 rodape-aparelho" >
							<div class="col col-1" ></div>
							<div class="col col-4  input-aparelho" >
								<input class="inputNovo" id="aparelho" title="Digite o novo aparelho e clique em cadastrar" name="novo-aparelho" type="text" maxlength="50" placeholder="Digite o novo  Aparelho"  />
							</div>
							<div class="col col-3" ></div>
							<div class="col col-1" >
								<button title="Clique para cadastrar o novo aparelho" type="button" class="botao" style="float:right;" onclick="validar_aparelho();return false;"  ><i class='but-verde fas fa-check'></i><span class="espaco">Cadastrar</span></button>
							</div>
							<div class="col col-1" ></div>
						</div>  
					</div>
					<div class="linha">
						<div class="col col-10 rodape-aparelho" >
							<div class="col col-1" ></div>
							<div class="col col-4 input-aparelho" >
								<input class="inputNovo" id="aparelho_busca" title="Digite o nome do aparelho e clique em buscar" name="aparelho_busca" type="text" maxlength="50" placeholder="Digite para Pesquisar" />
							</div>
							<div class="col col-3" ></div>
							<div class="col col-1">
								<button title="Clique para pesquisar o aparelho" type="button" class="botao" style="float:right;" onclick="buscar_aparelho(); return false;" ><i class="fas fa-search"></i><span class="espaco">Buscar</span></button>
							</div>
							<div class="col col-10 div_rodape" >
								
							</div>	
						
						</div>
					</div>
				</div>
				<div class="col col-1-3  nav-aparelho">
					<?php
						$listamarca = $conexao->prepare("SELECT * FROM marca ORDER BY marca ASC");
						$listamarca->execute();
						$totalMarca = $listamarca->rowCount();
					?>
					<div class="linha">
						<div class="col col-10 totalAparelhoMarcaModelo">
							<h3><center>M A R C A ( S )&nbsp <?php echo $totalMarca; ?></center></h3>
						</div>
					</div>
					<div class="scroll_lateral_esquerdo">
						<table class="tabela_menus" border="1" cellpadding="2" cellspacing="0">
							<thead>
								<tr>
									<th class="th_10" >
										C O N T
									</th>
									<th class="th_20" >
										N O M E &nbsp&nbsp D A &nbsp&nbsp M A R C A
									</th>
									<th class="th_10">
										A Ç Ã O
									</th>
								</tr>	
							</thead>
							<tbody>	
							<?php
							$i=1; 
								while($linha = $listamarca->fetch(PDO::FETCH_ASSOC)) { ?>
								<tr class="linha_home">		
									<td class="coluna_numererica"><?php echo $i; ?></td>		
									<td class="cursor_pointer" title="Clique para alterar a marca"
										onclick="document.getElementById('altMarca').style.display='block';
										document.getElementById('marca_alt').value = '<?php echo $linha['marca']; ?>';
										document.getElementById('codigoMarca').value = '<?php echo $linha['codigo']; ?>';">
										<?php echo '<span style="padding-left:10px">' . $linha['marca'] . '</span>'; ?>
									</td>
									<td class="cursor_pointer">
										<i class="botao_tabela botao-tabela fas fa-edit" title="Clique para alterar a marca"
											onclick="document.getElementById('altMarca').style.display='block';
											document.getElementById('marca_alt').value = '<?php echo $linha['marca']; ?>';
											document.getElementById('codigoMarca').value = '<?php echo $linha['codigo']; ?>';">
										</i>
										<a href="../php/excluir_aparelho_marca_estado.php?nome=marca&codigo=<?php echo $linha['codigo']; ?>"  title="Clique para excluir a marca" OnClick="return confirm('Confirme com ( OK ) ou cancele a exclusão da marca abaixo \n <?php echo $linha['marca']; ?>')"><i class="botao_tabela botao-tabela excluir_home fas fa-trash"></i></a>
									</td>
								</tr>
							<?php $i++; } ?>	
							</tbody>
						</table>
					</div>	
					<div class="linha">
						<div class="col col-10 rodape-aparelho" >
							<div class="col col-1" ></div>
							<div class="col col-4 input-aparelho" >
							<input class="inputNovo" id="marca"  title="Digite a nova marca e clique em cadastrar" name="nova-marca" type="text" maxlength="50" placeholder="Digite a nova marca" />
							</div>
							<div class="col col-3" ></div>
							<div class="col col-1" >
								<button title="Clique para cadastrar a nova marca" type="button" class="botao" style="float:right;" onclick="validar_marca();return false;"  ><i class='but-verde fas fa-check'></i><span class="espaco">Cadastrar</span></button>
							</div>
							<div class="col col-1" ></div>
						</div>  
					</div>
					<div class="linha">
						<div class="col col-10 rodape-aparelho" >
							<div class="col col-1" ></div>
							<div class="col col-4 input-aparelho" >
								<input class="inputNovo" id="marca_busca" title="Digite o nome da marca e clique em buscar" name="marca_busca" type="text" maxlength="50" placeholder="Digite para Pesquisar" />
							</div>
							<div class="col col-3" ></div>
							<div class="col col-1">
								<button title="Clique para pesquisar a marca" type="button" class="botao" style="float:right;" onclick="buscar_marca(); return false;" ><i class='fas fa-search'></i><span class="espaco">Buscar</span></button>
							</div>
							<div class="col col-10 div_rodape" >
								
							</div>	
						
						</div>
					</div>
				</div>
				<div class="col col-1-3  nav-aparelho">
					<?php
						$listamodelo = $conexao->prepare("SELECT * FROM modelo ORDER BY modelo ASC");
						$listamodelo->execute();
						$totalModelo = $listamodelo->rowCount();
					?>
					<div class="linha">
						<div class="col col-10 totalAparelhoMarcaModelo">
							<h3><center>M O D E L O ( S )&nbsp <?php echo $totalModelo ;?></center></h3>
						</div>
					</div>
					<div class="scroll_lateral_esquerdo">
						<table class="tabela_menus" border="1" cellpadding="2" cellspacing="0">
							<thead>
								<tr>
									<th class="th_10" >
										C O N T
									</th>
									<th class="th_20" >
										N O M E &nbsp&nbsp D O &nbsp&nbsp M O D E L O
									</th>
									<th class="th_10">
										A Ç Ã O
									</th>
								</tr>	
							</thead>
							<tbody>		
							<?php	
							$i=1; 					
								while($linha = $listamodelo->fetch(PDO::FETCH_ASSOC)) { ?>
								<tr class="linha_home">		
									<td class="coluna_numererica"><?php echo $i; ?></td>		
									<td class="cursor_pointer" title="Clique para alterar o modelo"  
										onclick="document.getElementById('altModelo').style.display='block';
										document.getElementById('modelo_alt').value = '<?php echo $linha['modelo']; ?>';
										document.getElementById('codigoModelo').value = '<?php echo $linha['codigo']; ?>';">
										<?php echo '<span style="padding-left:10px">' . $linha['modelo'] . '</span>'; ?>
									</td>
									<td class="cursor_pointer">								
										<i class="botao_tabela botao-tabela fas fa-edit" title="Clique para alterar o modelo"
											onclick="document.getElementById('altModelo').style.display='block';
											document.getElementById('modelo_alt').value = '<?php echo $linha['modelo']; ?>';
											document.getElementById('codigoModelo').value = '<?php echo $linha['codigo']; ?>';">
										</i>
										<a href="../php/excluir_aparelho_marca_estado.php?nome=modelo&codigo=<?php echo $linha['codigo']; ?>"  title="Clique para excluir a modelo" OnClick="return confirm('Confirme com ( OK ) ou cancele a exclusão do modelo abaixo \n <?php echo $linha['modelo']; ?>')"><span class="botao_tabela botao-tabela excluir_home fas fa-trash"></span></a>
									</td>
								</tr>
							<?php  $i++; }  ?>	
							</tbody>
						</table>
					</div>	
					<div class="linha">
							<div class="col col-10 rodape-aparelho" >
								<div class="col col-1" ></div>
								<div class="col col-4 input-aparelho" >
								<input class="inputNovo" id="modelo"  title="Digite o novo modelo e clique em cadastrar" class="input" name="novo-modelo" type="text" maxlength="50" placeholder="Digite o novo modelo" />
								</div>
								<div class="col col-3" ></div>
								<div class="col col-1" >
									<button title="Clique para cadastrar o novo modelo" type="button" class="botao" style="float:right;" onclick="validar_modelo();return false;"  ><i class='but-verde fas fa-check'></i><span class="espaco">Cadastrar</span></button>
								</div>
								<div class="col col-1" ></div>
							</div>  
						</div>
						<div class="linha">
							<div class="col col-10 rodape-aparelho" >
								<div class="col col-1" ></div>
								<div class="col col-4 input-aparelho" >
									<input class="inputNovo" id="modelo_busca" title="Digite o nome do modelo e clique em buscar" class="input" name="modelo_busca" type="text" maxlength="50" placeholder="Digite para Pesquisar" />
								</div>
								<div class="col col-3" ></div>
								<div class="col col-1">
									<button title="Clique para pesquisar o modelo" type="button" class="botao" style="float:right;" onclick="buscar_modelo(); return false;" ><i class='fas fa-search'></i><span class="espaco">Buscar</span></button>
								</div>
								<div class="col col-10 div_rodape" >
								<button type="button" class="botao but_fechar" title="Clique para fechar a tabela aparelho, marca e modelo" onclick="limpaCampo();"><i class='fas fa-times but-fechar espaco'></i><span class="espaco">Fechar</span></button>
							</div>	
						
							</div>
						</div>
					</div>
				</div>	
			</div>	     										
		</div><!-- fim tabela de  aparelho, marca e modelo -->
		<!-- inicio do formulário do campo busca -->
		<div id="formBuscar" class="mascara">
			<div  class="formulario_ligar formulario_menor" >
			<div class="cabecario_padrao">             	  	            	  	    
					<span class="simbolo_padrao" onclick="document.getElementById('formBuscar').style.display = 'none';document.getElementById('pesquisa').value='';document.getElementById('pesquisaExcluido').checked=false;document.getElementById('pesquisaPermanentementeExcluido').checked=false;" title="Clique para fechar o formulário de busca"  >&times</span>
					<span class="atualizar_pagina" title="clique para atualizar a página" onclick="document.location.reload(true);" >&#8635</span>
					<span class="texto" >Formulário de pesquisa </span>   
				</div> 
				<form class="form_pesquisar" name="form_pesquisar" action="../php/ordenacao.php" method="get" autocomplete="off"> 
					<div class="linha">
						<div class="col col-10"><br><br></div>
					</div>
					<div class="linha">
						<div class="col col-2"></div>
						<div class="col col-6">
							<input class="input-1-10" type="text"  title="Digite aqui para pesquisar"  name="pesquisa" autocomplete="off" id="pesquisa" required autofocus placeholder="Pesquise aqui" />
						</div>
						<div class="col col-2"></div>
					</div>
					<div class="linha">
						<div class="col col-10 rodape_alterar_aparelho" >
							<button type="submit" id="inputPesquisa" name="busca" class="botao" title="Clique para realizar a pesquisa" onclick="return validar_busca()" ><i class="fas fa-search"></i><span class="espaco">Buscar</span></button> 
						</div>
					</div>	
				</form> 
			</div>
		</div> <!--fim do formulário do campo busca -->






		<div id="formBuscarImprimir" class="mascara">
			<div  class="formulario_ligar formulario_menor" >
			<div class="cabecario_padrao">             	  	            	  	    
					<span class="simbolo_padrao" onclick="document.getElementById('formBuscarImprimir').style.display = 'none';document.getElementById('pesquisaImprimir').value='';" title="Clique para fechar o formulário de busca"  >&times</span>
					<span class="atualizar_pagina" title="clique para atualizar a página" onclick="window.location.href='impressao.php';" >&#8635</span>
					<span class="texto" >Formulário de pesquisa </span>   
				</div> 
				<form class="form_pesquisar" name="form_pesquisar_Imprimir" action="impressao.php" method="post" autocomplete="off"> 
					<div class="linha">
						<div class="col col-10"><br><br></div>
					</div>
					<div class="linha">
						<div class="col col-2"></div>
						<div class="col col-6">
							<input class="input-1-10" type="text"  title="Digite aqui para pesquisar"  name="pesquisaImprimir" autocomplete="off" id="pesquisaImprimir" required autofocus placeholder="nome, cpf ou codigo de barra" />
						</div>
						<div class="col col-2"></div>
					</div>
					<div class="linha">
						<div class="col col-10 rodape_alterar_aparelho" >
							<button type="submit" id="inputPesquisa" name="busca" class="botao" title="Clique para realizar a pesquisa" onclick="return validar_busca_imprimir()" ><i class="fas fa-search"></i><span class="espaco">Buscar</span></button> 
						</div>
					</div>	
				</form> 
			</div>
		</div> 






		<!-- formulario alterar aparelho -->
		<div id="altAparelho" class="mascara">
			<div  class="formulario_ligar formulario_menor" >
			<div class="cabecario_padrao">             	  	            	  	    
					<span class="simbolo_padrao" onclick="document.getElementById('aparelho_busca').value = '';document.getElementById('altAparelho').style.display = 'none';" title="Clique para fechar o formulário alterar aparelho"  >&times</span>
					<span class="atualizar_pagina" title="clique para atualizar a página" onclick="document.location.reload(true);" >&#8635</span>
					<span class="texto" >Alterar Aparelho </span>   
				</div> 
				<form id="formulario" name="frmEnviaDados" class="form-horizontal" action="../php/alterar_aparelho_marca_estado.php"  method="post" autocomplete="off" > 
					<div class="linha">
						<div class="col col-10"><br><br></div>
					</div>
					<div class="linha">
						<div class="col col-2"></div>
						<div class="col col-6">
							<input type="hidden" id="codigoAparelho" name="codigo" value=""/>
							<input class="input-1-10"  id="aparelho_alt" name="aparelho" type="text"  maxlength="50" required value=""/>
						</div>
						<div class="col col-2"></div>
					</div>
					<div class="linha">
						<div class="col col-10 rodape_alterar_aparelho" >
							<button class="botao" title="Clique para salvar a alteração no aparelho" type="submit" id="enviarAp" name="alterar" value="ALTERAR" ><i class='but-verde fas fa-edit'></i><span class="espaco">ALTERAR</button>	
							<button class="botao" title="Clique para excluir o aparelho" type="submit" id="excluirAp" name="excluir" value="EXCLUIR" OnClick="return confirm('Confirme com ( OK ) ou cancele a exclusão do aparelho abaixo'+ '\n'+ modelo_alt.value)" ><i class='excluir_home fas fa-trash'></i><span class="espaco">EXCLUIR</span></button>	
						</div>
					</div>	
				</form> 
		</div>
		</div><!-- fim formulario alterar aparelho -->	

		<!-- formulario alterar marca -->
		<div id="altMarca" class="mascara">
			<div  class="formulario_ligar formulario_menor">
				<div class="cabecario_padrao">             	  	            	  	    
					<span class="simbolo_padrao" onclick="document.getElementById('marca_busca').value = '';document.getElementById('altMarca').style.display = 'none';" title="Clique para fechar o formulário alterar marca" >&times</span>
					<span class="atualizar_pagina" title="clique para atualizar a página" onclick="document.location.reload(true);" >&#8635</span>
					<span class="texto" >Alterar Marca </span>                 
				</div> 
				<form id="formulario" name="frmEnviaDados" class="form-horizontal" action="../php/alterar_aparelho_marca_estado.php"  method="post" autocomplete="off"> 
					<div class="linha">
						<div class="col col-10"><br><br></div>
					</div>	
					<div class="linha">
						<div class="col col-2"></div>
						<div class="col col-6">
							<input type="hidden" id="codigoMarca" name="codigo" value=""/>
							<input class="input-1-10" id="marca_alt" name="marca" type="text"  maxlength="50" required value=""/>
						</div>
						<div class="col col-2"></div>
					</div>
					<div class="linha">
						<div class="col col-10 rodape_alterar_aparelho">
							<button class="botao" title="Clique para salvar a alteração na marca" type="submit" id="enviarMa" name="alterar" value="ALTERAR" ><i class='but-verde fas fa-edit'></i><span class="espaco">ALTERAR</button>	
							<button class="botao" title="Clique para excluir a marca" type="submit" id="excluirMa" name="excluir" value="EXCLUIR" OnClick="return confirm('Confirme com ( OK ) ou cancele a exclusão da marca abaixo'+ '\n'+ modelo_alt.value)" ><i class='excluir_home fas fa-trash'></i><span class="espaco">EXCLUIR</span></button>	
						</div>
					</div>	
				</form> 
			</div>
		</div> <!-- fim formulario alterar marca -->

		<!-- formulario alterar modelo -->
		<div id="altModelo" class="mascara">
			<div  class="formulario_ligar formulario_menor">
			<div class="cabecario_padrao">             	  	            	  	    
					<span class="simbolo_padrao" onclick="document.getElementById('modelo_busca').value = '';document.getElementById('altModelo').style.display = 'none';" title="Clique para fechar o formulário alterar modelo">&times</span>
					<span class="atualizar_pagina" title="clique para atualizar a página" onclick="document.location.reload(true);" >&#8635</span>
					<span class="texto" >Alterar Modelo </span>                 
				</div> 
				<form id="formulario" name="frmEnviaDados" class="form-horizontal" action="../php/alterar_aparelho_marca_estado.php"  method="post" autocomplete="off" > 
					<div class="linha">
						<div class="col col-10"><br><br></div>
					</div>
					<div class="linha">
						<div class="col col-2"></div>
						<div class="col col-6">
							<input type="hidden" id="codigoModelo" name="codigo" value=""/>
							<input class="input-1-10"  id="modelo_alt" name="modelo" type="text"  maxlength="50" required value=""/>
						</div>
						<div class="col col-2"></div>
					</div>
					<div class="linha">
						<div class="col col-10 rodape_alterar_aparelho" >
							<button class="botao" title="Clique para salvar a alteração no modelo" type="submit" id="enviarMo" name="alterar" value="ALTERAR" ><i class='but-verde fas fa-edit'></i><span class="espaco">ALTERAR</button>	
							<button class="botao" title="Clique para excluir o modelo" type="submit" id="excluirMo" name="excluir" value="EXCLUIR" OnClick="return confirm('Confirme com ( OK ) ou cancele a exclusão do modelo abaixo'+ '\n'+ modelo_alt.value)" ><i class='excluir_home fas fa-trash'></i><span class="espaco">EXCLUIR</span></button>					 						
						</div>
					</div>	 
				</form>
		</div>
		</div>	<!-- fim do formulário alterar modelo -->

		<!-- foto ampliada -->
		<div id="fotoAmpliada" class="formulario_cadastro foto_ampliada">
				<div class="cabecario_padrao">  			  			  	  	
					<span class="simbolo_padrao"  title="Clique para fechar a imagem" onclick="document.getElementById('fotoAmpliada').style.display='none';">&times</span>
					<span class="atualizar_pagina" title="clique para atualizar a página" onclick="document.location.reload(true);" >&#8635</span>	
					<b> 
						<span class="texto">Foto ampliada</span>  
					</b>
				</div> 
				<div class="foto-ampliada">
					<img id="foto_ampliada"  title="Clique para fechar a imagem"  class="foto" onclick="document.getElementById('fotoAmpliada').style.display='none';"  />	
				</div>
		</div> <!-- fim foto ampliada -->

		<!-- formulario  ligar -->
		<div id="formLigar" class="mascara">
			<div  class="formulario_ligar">
				<div class="cabecario_padrao">             	  	            	  	    
					<span class="simbolo_padrao"  onclick="
						document.getElementById('outroTelefone').value = '';
						document.getElementById('quem_ligou').value = '';
						document.getElementById('quem_atendeu').value = '';
						document.getElementById('atendeu').checked = false;
						document.getElementById('telefoneLigar1').checked = false;
						document.getElementById('telefoneLigar2').checked = false;
						document.getElementById('formLigar').style.display='none';" title="Clique para fechar o formulário ligar">&times
					</span>
					<span class="atualizar_pagina" title="clique para atualizar a página" onclick="document.location.reload(true);" >&#8635</span>
					<b><span class="texto" >Realizar Ligação </span></b>
				</div> 
				<form id="formulario" name="formulario_ligacao" class="form-horizontal" action="../php/cadastro_ligacao.php"  method="post" autocomplete="off" >       
					<input type="hidden" id="codigoLigar"  name="codigoLigar" value="" />
					<div class="linha">
						<div class="col col-10 div_logacao">
							<div id="Ligacao1" class="sumido">
								<div class="linha">
									
									<div class="col col-1-6">
										&nbsp&nbsp&nbsp Ligação 1 - <span id="dataLigou1" class="ligacao2" ></span>
									</div>
									<div class="col col-1-10">
										<span id="horaLigou1" class="ligacao"></span>
									</div>
									<div class="col col-1-6">
										<span id="telefoneLigou1"class="ligacao" ></span>
									</div>
									<div class="col col-1-10">
										<span id="atendeu1" class="ligacao" ></span> 
									</div>
									<div class="col col-1-5">	
										<span id="quemLigou1" class="ligacao" ></span>
									</div>
									<div class="col col-1-5">	
										<span id="quemAtendeu1" class="ligacao" ></span>
									</div>
								</div>	
								<div class="linha">
									<div class="col col-10">
										<hr>
									</div>
								</div>
							</div>
							<div id="Ligacao2" class="sumido">
								<div class="linha">
									<div class="col col-1-6">
										&nbsp&nbsp&nbsp Ligação 2 - <span id="dataLigou2" class="ligacao2" ></span>
									</div>
									<div class="col col-1-10">
										<span id="horaLigou2" class="ligacao" ></span>
									</div>
									<div class="col col-1-6">
										<span id="telefoneLigou2" class="ligacao" ></span>
									</div>
									<div class="col col-1-10">
										<span id="atendeu2" class="ligacao" ></span> 
									</div>
									<div class="col col-1-5">
										<span id="quemLigou2" class="ligacao" ></span>
									</div>
									<div class="col col-1-5">
										<span id="quemAtendeu2" class="ligacao"></span>
									</div>
								</div>
								<div class="linha">
									<div class="col col-10">
										<hr>
									</div>
								</div>
							</div>
							<div id="Ligacao3" class="sumido">
								<div class="linha">
									<div class="col col-1-6">
										&nbsp&nbsp&nbsp Ligação 3 - <span id="dataLigou3" class="ligacao2" ></span>
									</div>
									<div class="col col-1-10">
										<span id="horaLigou3" class="ligacao"></span>
									</div>
									<div class="col col-1-6">
										<span id="telefoneLigou3" class="ligacao" ></span>
									</div>
									<div class="col col-1-10">
										<span id="atendeu3" class="ligacao" ></span> 
									</div>
									<div class="col col-1-5">
										<span id="quemLigou3" class="ligacao" ></span>
									</div>
									<div class="col col-1-5">
										<span id="quemAtendeu3" class="ligacao" ></span>
									</div>
								</div>
								<div class="linha">
									<div class="col col-10">
										<hr>
									</div>
								</div>
							</div>
							<div id="Ligacao4" class="sumido">
								<div class="linha">
									<div class="col col-1-6">
										&nbsp&nbsp&nbsp Ligação 4 - <span id="dataLigou4" class="ligacao2" ></span>
									</div>
									<div class="col col-1-10">
										<span id="horaLigou4" class="ligacao" ></span>
									</div>
									<div class="col col-1-6">
										<span id="telefoneLigou4" class="ligacao" ></span>
									</div>
									<div class="col col-1-10">
										<span id="atendeu4" class="ligacao" ></span> 
									</div>
									<div class="col col-1-5">
										<span id="quemLigou4" class="ligacao" ></span>
									</div>
									<div class="col col-1-5">
										<span id="quemAtendeu4" class="ligacao" ></span>
									</div>
								</div>
								<div class="linha">
									<div class="col col-10">
										<hr>
									</div>
								</div>
							</div>
							<div id="Ligacao5" class="sumido">
								<div class="linha">
									<div class="col col-1-6">
										&nbsp&nbsp&nbsp Ligação 5 - <span id="dataLigou5" class="ligacao2" ></span>
									</div>
									<div class="col col-1-10">
										<span id="horaLigou5" class="ligacao" ></span>
									</div>
									<div class="col col-1-6">
										<span id="telefoneLigou5" class="ligacao" ></span>
									</div>
									<div class="col col-1-10">
										<span id="atendeu5" class="ligacao" ></span> 
									</div>
									<div class="col col-1-5">
										<span id="quemLigou5" class="ligacao" ></span>
									</div>
									<div class="col col-1-5">
										<span id="quemAtendeu5" class="ligacao" ></span>
									</div>
								</div>
								<div class="linha">
									<div class="col col-10">
										<hr>
									</div>
								</div>
							</div>			
						</div>	
					</div><br>
					<div class="linha">
							<div class="col col-10">
							<fieldset id="formulario_Ligacao">
								<legend>Ligar</legend>
									<div class="col col-2" >
										<label for="telefoneLigar1"  style="font-size:11px;" id="telefone11" ></label>
										<input id="telefoneLigar1" name="ligar" value="telefone1" title="telefone 1" type="radio" />
										<label for="telefoneLigar2" style="font-size:11px;" id="telefone22" ></label>
										<input id="telefoneLigar2" style="visibility:hidden;" title="telefone 2" name="ligar" value="telefone2" type="radio" />
									</div>	
									<div class="col col-2" >
										<span >Outro telefone</span>
										<input id="outroTelefone" class="input m-top" inputmode="text" name="outro_telefone" type="text"  placeholder="(99) 9 9999-9999" maxlength="14" value="" onkeyup="fMasc( this, mTel );"  /> 			  			
									</div>									
									<div class="col col-1" >
									</div>
									<div class="col col-1" >
										<label for="atendeu">Atendeu</label>
										<input id="atendeu" style="position:relative;top:5px;" name="atendeu" type="checkbox" onclick="if(document.getElementById('atendeu').checked == true){document.getElementById('quem_atendeu').setAttribute('required','required');}else{document.getElementById('quem_atendeu').removeAttribute('required','required');};" />
									</div>
									<div class="col col-2" >
										<span style="color:brown;">* Quem ligou</span>
										<input class="input m-top" id="quem_ligou" name="quem_ligou" required type="text"  maxlength="15"   /> 			  			
									</div>
									<div class="col col-2" >
										<span>&nbsp&nbsp&nbsp Quem atendeu</span>
										<input id="quem_atendeu" class="input m-top" name="quem_atendeu" type="text"  maxlength="15"  /> 			  			
									</div>
							</fieldset>
							</div>
					</div>
					<div class="linha">
						<div class="col col-10 rodape_alterar_aparelho" >  
							
							<button type="submit" class="botao" id="enviarLigacao" value="" onclick="return validaTelefone();"><i class='but-verde fas fa-check'></i><span class="espaco">CADASTRAR</span></button>	
						</div>
					</div>	
				</form>
			</div>
		</div> <!-- fim do formulario ligar -->

		<!-- formulario de funcionario -->
		<div id="cad_funcionario" class="formulario_cadastro">	 	
			<div class="cabecario_padrao"> 
				<span class="atualizar_pagina" title="clique para atualizar a página" onclick="document.location.reload(true);" >&#8635</span>
				<span class="simbolo_padrao" onclick="document.getElementById('buscaFuncionario').value =''; document.getElementById('cad_funcionario').style.display = 'none';resetForm();" title="Clique para fechar o formulário de cadastro de funcionário">&times
				</span>
				<span class="texto">Informação Pessoal</span>   
			</div>       
			<form id="formularioFunc" name="formularioFunc" class="form-horizontal" action="../php/cadastro_funcionario.php"  method="post" enctype="multipart/form-data" autocomplete="off" >  
				<div class="linha">
					<div class="col col-4"><br>
							<input type="hidden" id="codigoFunc" name="codigo" value="" >
								<script>
									// pega o codigo do input hidden com javascript
									var codigo = document.querySelector("#codigoFunc");
								</script>
						<span class="t t-vermelho" >* Nome </span>
						<input class="input" inputmode="text" id="nomeFunc" name="nome" type="text" min="5"  maxlength="50" value="" onkeyup="corrigirValor(this)"  onblur="return validarFormFunc()" />
					</div>
					<div class="col col-2"><br>
						<span>Telefone</span>
						<input  class="input" inputmode="text" id="telFunc" name="telefone" type="text"  placeholder="(99) 9 9999-9999" maxlength="14" onkeyup="fMasc( this, mTel );" value="" onBlur="validarFormFunc()" />      
					</div>
					<div class="col col-2"><br>
						<span>Telefone 2</span>
						<input  class="input" inputmode="text"  id="telFunc2"  name="telefone2" type="text"  placeholder="(99) 9 9999-9999" maxlength="14" onkeyup="fMasc( this, mTel );" value="" onBlur="validarFormFunc()" />
					</div>
					<div class="col col-2"><br>
						<span>CPF</span>
						<input class="input" type="text" id="cpfFunc" autocomplete="off" id="cpfFunc" name="cpf" placeholder="999.999.999-99" maxlength="14"  value="" onkeypress='return event.charCode >= 48 && event.charCode <= 57' autocomplete="off" onkeyup="fMasc( this, mCPF )" onBlur="Cpf_Funcionario()" >
					</div>	 
				</div>
				<div class="linha">
					<div class="col col-5"><br>
						<span class="t" >Endereço</span>
						<input class="input" id="enderecoFunc" name="endereco" type="text"  maxlength="100" onkeyup="corrigirValor(this)" value="" />
					</div>
					<div class="col col-1"><br>
						<span >Nº</span>
						<input class="input t-Mausculo" id="numeroFunc" name="numero" type="text"  maxlength="6" onKeyup="pri_mai(this);" value="" />
					</div>
					<div class="col col-2"><br>
						<span >Bairro</span>
						<input class="input" id="bairroFunc" name="bairro" type="text"  maxlength="60" onkeyup="corrigirValor(this)" value="" />
					</div>
					<div class="col col-2"><br>
						<span >Cidade</span>
						<input class="input" id="cidadeFunc" name="cidade" type="text"  maxlength="50" onkeyup="corrigirValor(this)" value="" />
					</div>
				</div>
				<div class="linha">
					<div class="col col-1-4"><br>
						<span class="t t-vermelho">* Data de Nascimento</span>
						<input  class="input" id="dataNascimentoFunc" name="data_nascimento" type="date" value="" onblur="return idadeFunc();" required />
					</div>
					<div class="col col-1-4"><br>
						<span>Idade</span>
						<div  style="background-color: #fff;min-height:20px;padding:3px;" id="idade2Func" ></div>
					</div>
					<div class="col col-1-4"><br>
						<span>Email</span>
						<input  class="input" id="emailFunc" name="email"  maxlength="60" type="text" value="" onblur="validaEmailFunc()" />
					</div>
					<div class="col col-1-4"><br>						
						<span>Código de Barras</span>
						<input  class="input" id="barraFunc"  name="barra_funcionario" type="text" readonly value="" value="" />
					</div>
				</div>  		
				<div class="linha">
					<div class="col col-10">
						<hr>
					</div>
				</div>
				<div class="linha">
					<div class="col col-10"><br></div>
				</div>  			
				<div class="linha">
					<div class="col col-1-4" id="mostraUsuario">
					<div  class="t">Usuário</div>
					<div  style="background:#fff;padding-top:3px;padding-bottom:4px;padding-left:5px;height:20px;" id="nomeFuncionario"></div>
					</div>
					<div class="col col-1-4">
						<span>Data de Cadastro</span>
						<input  class="input" id="dataCadastroFunc"  name="data_cadastro" readonly type="date" value="" />
					</div>
					<div class="col col-1-3">
						<label for="protegido" style="margin-left:20px;" >&nbsp Protegido</label>
						<input title="Marque para proteger contra acesso externo"  class="input" id="protegido" name="protegido" type="checkbox" />
					</div>
				</div>		
				<div class="linha">
					<div class="col col-10"><br>
						<span class="t" >Obs.</span>
						<input class="input-1-10" id="obsFunc" name="obs" type="text"  maxlength="100" onKeyup="pri_mai(this);" value="" />
					</div>		  	
				</div>
				<div class="linha">
					<div class="col col-1-3"><br>
						<fieldset>
							<legend>Escolha as Fotos</legend>
							<div class="linha">
								<div class="col col-10">
									<button type="button" title="Escolha a imagem 1"  class="botao" onclick="document.getElementById('img_funcionario').click();"><i class='fas fa-image'></i><span class="espaco">Imagem 1</span></button>	
									<input id="img_funcionario"  type="file" name="img_funcionario" >
									<button type="button" id="botaoLimpar4" class="botao" onclick="limparFotoFuncionario();"><i class='fas fa-eraser'></i><span class="espaco">Limpar</span></button>
									<span id="excluirFotoFuncionario1" style="visibility:hidden" >
										<span style="position:relative;left:5px;">Excluir imagem 1</span>
										<input class="input-checkbox" id="excluir-foto-funcionario1" name="excluir-foto-funcionario1" type="checkbox" />
									</span>
								</div>
							</div>
							<div class="linha">
								<div class="col col-10">
									<button type="button" title="Escolha a imagem 2"  class="botao" onclick="document.getElementById('img_funcionario2').click();"><i class='fas fa-image'></i><span class="espaco">Imagem 2</span></button>	
									<input id="img_funcionario2"  type="file" name="img_funcionario2" >
									<button type="button" id="botaoLimpar5" class="botao" onclick="limparFotoFuncionario2();"><i class='fas fa-eraser'></i><span class="espaco">Limpar</span></button>
									<span id="excluirFotoFuncionario2" style="visibility:hidden" >
										<span style="position:relative;left:5px;">Excluir imagem 2</span>
										<input class="input-checkbox" id="excluir-foto-funcionario2" name="excluir-foto-funcionario2" type="checkbox" />
									</span>
								</div>
							</div>
						</fieldset>
					</div>
					<div class="col col-1-3"><br><br>
						<div class="col col-4" >
							<div class="logomarca">
								<img id="fotoFuncionario1" class="img_cadastro" height="100%" width="100%" title="Clique para ampliar a imagem" onclick="document.getElementById('fotoAmpliada').style.display='block';document.getElementById('foto_ampliada').src = fotoFuncionario1.src ;"/>
							</div>
						</div>
						<div class="col col-4" >
							<div class="logomarca">
								<img id="fotoFuncionario2" class="img_cadastro" height="100%" width="100%" title="Clique para ampliar a imagem" onclick="document.getElementById('fotoAmpliada').style.display='block';document.getElementById('foto_ampliada').src = fotoFuncionario2.src ;"/>	
							</div>
						</div>
						
					</div>
					
					<div class="col col-1" style="top:20px;">
						<label class="cursor_default" for="cronometro" style="margin-left:20px;" >&nbsp S / Cronómetro</label>
						<input title="Marque para Sem Cronómetro" style="margin-left:70px;" class="input" id="semCronometro_func" name="semCronometro" type="checkbox" />
					</div>	  		
				</div>
				<div class="linha">
					<div class="col col-10"><hr></div>
				</div>
				<div class="linha">
					<div class="col col-10"><br></div>
				</div>
				<div id="escolha_funcionario"> 	
					<div class="linha">
						<div class="col col-1-3">
								<div class="col col-1-3">
									<span class="t" >Nº de Linhas</span>
									<input title="Número de linhas por página" id="pagina_func" inputmode="text" class="input" name="pagina" type="text" maxlength="2" autofocus autocomplete="off" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="" />   
								</div>
								<div class="col col-1-3">
									<!--<label class="cursor_default" for="colorido_func" style="margin-left:20px;" >&nbsp Botao Colorido</label>
									<input title="Marque para Tema Colorido" style="margin-left:69px;" class="input" id="colorido_func" name="coloridoFunc" type="checkbox" />-->
								</div>
								<div class="col col-1-3">
									<label class="cursor_default" for="tema" style="margin-left:35px;">Tema Escuro </label>
									<input title="Marque para tema claro" style="margin-left:68px;" class="input" id="tema_func" name="tema" type="checkbox" <?php if ($resultado['tema'] <> "escuro") { echo "checked";};?> />
								</div>
								<div class="col col-7">
								</div>
						</div>
						<div class="col col-1-3">
							<fieldset>
								<legend>Escolha a Coluna Inicial</legend>
								<div class="col col-3" style="height:37px;">
									<label for="id" class="cursor_default" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ID</label>
									<input id="col_id_func" title="Escolha ID para coluna inicial"  name="coluna" value="codigo" type="radio"   />
								</div>
								<div class="col col-3">
									<label for="os" class="cursor_default"  >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp OS</label>
									<input id="col_os_func" title="Escolha OS para coluna inicial"  name="coluna" value="ordemServico" type="radio"  />
								</div>
								<div class="col col-3">
									<label for="nome" class="cursor_default" >&nbsp&nbsp&nbsp&nbsp&nbsp NOME</label>
									<input id="col_nome_func" title="Escolha NOME para coluna inicial"  name="coluna" value="nome" type="radio" />
								</div>
							</fieldset>
						</div>
						<div class="col col-1-3" >
							<fieldset >
								<legend>Escolha a Ordem Inicial</legend>
								<div class="col col-4" style="height:37px;">
									<label class="cursor_default" for="asc"  >(A - Z) (1 - <span class="ordenacao" >&#8734</span>)</label>
									<input id="asc_func" title="Escolha A - Z  para ordem inicial"  style="position: relative;margin-left:10px;margin-right:10px;" name="ordem" value="ASC" type="radio" />
								</div>
								<div class="col col-4">
									<label class="cursor_default" for="desc"  >(Z - A) (<span class="ordenacao" >&#8734</span> - 1)</label>
									<input id="desc_func" title="Escolha Z - A  para ordem inicial" style="position: relative;margin-left:10px;"  name="ordem" value="DESC" type="radio" />
								<div>
							</fieldset>
						</div>
					</div>
				</div>  			
				<div class="linha">
					<div class="col col-10 div_rodape" >
						<button class="botao" type="submit" title="Clique para alterar ou cadastrar o funcionário" id="enviar_cadastro" name="enviar_cadastro" value="ALTERAR" onclick="return validarFormFunc();"><i class='but-verde fas fa-edit'></i><span class="espaco">ALTERAR</span></button>	
						<button class="botao" type="submit"  title="Clique para imprimir o cadastro de funcionário" id="imprimir_cadastro" name="imprimir_cadastro" value="Imprimir"><i class='fas fa-print'></i><span class="espaco">IMPRIMIR</span></button>
						<button type="button" class="botao but_fechar" title="Clique para fechar o formulário de cadastro de funcionário" onclick="document.getElementById('buscaFuncionario').value =''; document.getElementById('cad_funcionario').style.display = 'none';resetForm();"><i class='fas fa-times but-fechar espaco'></i><span class="espaco">Fechar</span></button>
					</div>
				</div>
			</form>      	     		
		</div> <!-- fim do formulario de funcionario -->

		<!-- Pagina Sobre -->
		<div id="sobreHome" class="formulario_cadastro sobre">	
			<div class="cabecario_padrao">  			  			  	  	
				<span class="simbolo_padrao" onclick="document.getElementById('sobreHome').style.display = 'none';" title="Clique para fechar a página sobre">&times</span>
				<span class="atualizar_pagina" title="clique para atualizar a página" onclick="document.location.reload(true);" >&#8635</span>
				<b> 
					<span class="texto">Sobre</span>  
				</b>
			</div> 
			<div class="imagem">
				<?php
					if($sock = @fsockopen('www.google.com.br',80)) {;?>
						<img class="img_cadastro"  src="https://i.pinimg.com/564x/53/c1/02/53c102da0be0073ac8d549fe238111d7.jpg" height="100%" width="100%" title="Clique para ampliar a imagem" onclick="document.getElementById('fotoAmpliada').style.display='block';document.getElementById('foto_ampliada').src = 'https://i.pinimg.com/564x/53/c1/02/53c102da0be0073ac8d549fe238111d7.jpg' " />
					<?php }else{ ?>
						<img class="logomarca_pag" src="../imagem_cliente/logomarca.jpg" title="Clique para ampliar a imagem" onclick="document.getElementById('fotoAmpliada').style.display='block';document.getElementById('foto_ampliada').src ='../imagem_cliente/logomarca.jpg' "/>
					<?php };
				?>
			</div>
			<p class="primeiro">
				Sistema de O.S. voltado para o controle de oficinas
			</p>
			<p class="primeiro">
				Criado por claudioadventista@hotmail.com
			</p>
			<p class="primeiro">
				Me siga nas redes sociais abaixo
			</p>
			<div class="redes_sociais">				
				<div>
					<a href="https://www.instagram.com/xavier.brito/" target="_blank"><span style="font-size:2em;color:orange;" class="fab fa-instagram"></span><span class="titulo"> xavier.brito</span></a>
				</div>
				<div>
					<a href="https://www.instagram.com/oficina.c.t.eletronica/" target="_blank"><span style="font-size:2em;color:orange;" class="fab fa-instagram"></span><span class="titulo"> C.T.Eletronica</span></a>
				</div>
				<div>
					<a href="https://www.youtube.com/channel/UClYcoL8yyFcxcSzK2L2zByw/videos" target="_blank"><span style="font-size:2em;color:red;" class="fab fa-youtube"></span><span class="titulo"> CTE-Cláudio Brito</span></a>
				</div>
				<div>
					<a href="https://www.linkedin.com/in/claudio-xavier-09960238/" target="_blank"><span style="font-size:2em;color:blue;" class="fab fa-linkedin"></span><span  class="titulo"> claudio xavier</span></a>
				</div>
				<div>
					<a href="https://www.facebook.com/claudio.xavier.37669" target="_blank"><span style="font-size:2em;color:blue;" class="fab fa-facebook-square"></span><span class="titulo"> claudio.xavier.37669 - Cláudio Brito<span></a>
				</div>
				<div>
					<a href="https://twitter.com/claudiocalebe/" target="_blank"><span style="font-size:2em;color:blue;" class="fab fa-twitter-square"></span><spam  class="titulo"> @claudiocalebe - José Cláudio Xavier</span></a>
				</div>			
				<div>
					<a href="https://gist.github.com/claudioadventista" target="_blank"><span style="font-size:2em;color:black;" class="fab fa-github-square"></span><span  class="titulo"> claudioadventista - José Cláudio Xavier </span></a>
				</div>
				<div class="sugestao">
					<span><center>Contanto, sugestão</center>
						<span><center><span style="font-size:2em;color:green;" class="fab fa-whatsapp-square"></span> <span style="position:relative;top: -5px;">(81)999246724</span></center></span><center>claudioadventista@hotmail.com</center></span> 
				</div>
			</div> 
			<div class="col col-10 div_rodape" >
				<button type="button" class="botao but_fechar" title="Clique para fechar o formulário de cadastro de funcionário" onclick="document.getElementById('sobreHome').style.display = 'none';"><i class='fas fa-times but-fechar espaco'></i><span class="espaco">Fechar</span></button>
			</div>
				
		</div> <!-- fim pagina sobre -->

		<!-- excluidos permanentemente -->
		<div id="ver_excluidos" class="formulario_cadastro" > 
			<div class="cabecario_padrao">  			  			  	  	
				<span class="simbolo_padrao" onclick="document.getElementById('ver_excluidos').style.display = 'none';" title="Clique para fechar a página excluido permanentemente">&times</span>
				<span class="atualizar_pagina" title="clique para atualizar a página" onclick="document.location.reload(true);" >&#8635</span>	
				<span class="texto">Cadastro(s) escluídos permanentemente</span>  
			</div> 
			<div class="linha">
				<div class="col col-10">
						<div class="col col-7 listaExcluidos" >
							<?php $sqlExcluidos =  $conexao->prepare("SELECT * FROM excluidos");
								  $sqlExcluidos->execute();
								  $totalExcPermanente = $sqlExcluidos->rowCount();
							?>	
							<h4>Lista de cadastros excluídos - Total <?php echo $totalExcPermanente; ?></h4>	
						</div>
						<div class="scroll_lateral_esquerdo scroll_exc">
							<table id="minhaTabela" border="1" style="border-collapse: collapse;" cellpadding="2" cellspacing="0">	
								<?php $s = 1;
								while($listaExcluidos = $sqlExcluidos->fetch(PDO::FETCH_ASSOC)) { ?>
									<tr >	
										<td class="th_5" ><div class="coluna_numererica" ><?php echo $s;?></div></td>										
										<td class="th_85"><b><?php echo $listaExcluidos["cadastro"];?></b></td>
										<td class="th_5"><a href="imprimir_excluidos.php?imprimirCad_unico=<?php echo $listaExcluidos['codigo']; ?>" onclick="document.getElementById('ver_excluidos').style.display = 'none';"><i class="botao_tabela botao-tabela fas fa-print" title="Clique para imprimir o cadastro"></i></a></td>
										<td class="th_5"><a href="../php/excluir_funcionario_do_banco.php?excluir=cadastro&codigo=<?php echo $listaExcluidos['codigo']; ?>" 
										onclick="document.getElementById('formLogar').style.display = 'none';"><i class="botao_tabela botao-tabela excluir_home fas fa-trash"></i></a></td>
									</tr>
								<?php $s++;} ;?>	
							</table>
						</div>
				</div>
			</div>
			<div class="linha">
				<div class="col col-10 div_rodape">
					<div class="col col-10">
						<?php if($totalExcPermanente > 1){;?>
							<a href="imprimir_excluidos.php?imprimirCad=tudo"  onclick="document.getElementById('ver_excluidos').style.display = 'none';"><button class="botao"  ><i class='fas fa-print'></i><span class="espaco">IMPRIMIR TUDO</span></button></a>
						<?php };?>
						<div class="col col-3"></div>
						<div class="col col-2 pesquisa_excluidos">
							<input class="" title="Clique aqui para iniciar a pesquisa" type="text" id="campoBusca" placeholder="Digite para pesquisar..." onkeyup="filtrarTabela()">
						</div>
						<button type="button" class="botao but_fechar" title="Clique para fechar a página excluido permanentemente" onclick="document.getElementById('ver_excluidos').style.display = 'none';"><i class='fas fa-times but-fechar espaco'></i><span class="espaco">Fechar</span></button>
					</div>
					
				</div>
			</div>
		</div> <!-- fim excluidos permanentemente -->

		<!-- ver cadastro -->
		<div id="ver_cadastro" class="formulario_cadastro">
			<style>
				input[type='text']{
				padding:1px;
				color:#555;	
				}
			</style>
				<div class="cabecario_padrao">  			  			  	  	
					<span class="simbolo_padrao" onclick="document.getElementById('ver_cadastro').style.display = 'none';resetForm();" title="Clique para fechar a página ver cadastro">&times</span>
					<span class="atualizar_pagina" title="clique para atualizar a página" onclick="document.location.reload(true);" >&#8635</span>
					<div class="total">Total geral <span id="totalGeral"></span></div>
					<b class="texto">Ver Cadastro</b> 	
				</div> 
			<div class="col col-5">						
				<div class="linha">
					<div class="col col-1 margem">O.S.</div>		
					<div class="col col-1">
						<input type="text" id="ordemServicoVer"  value="">
						<input type="hidden" value="" id="codigoVer">
					</div>	
					<div class="col col-1 margem">Nome</div>	
					<div class="col col-7">
						<input id="nomeVer" type="text" value="" />
					</div> 
				</div>
				<div class="linha">
					<div class="col col-10">
						<div class="col col-1-3 margem">Telefone 
							<span  id="telefoneVer"></span>
						</div> 
						<div class="col col-1-3 margem">Telefone 2 
							<span id="telefone2Ver"></span>
						</div> 
						<div class="col col-1-3 margem">CPF 
							<span id="cpfVer"></span>
						</div> 
					</div>
				</div>
				<div class="linha">
					<div class="col col-10">
						<div class="col col-1 margem" >Endereço</div>
						<div class="col col-6">
							<input id="enderecoVer" class="input" type="text" value="" />
						</div> 
						<div class="col col-3 margem">Dt. Nascimento 
							<span id="dtNascimentoVer"></span>
						</div> 
					</div>
				</div>
				<div class="linha">
					<div class="col col-10">
						<div class="col col-5 margem">Email 
							<span id="emailVer"></span>
						</div> 
						<div class="col col-5 margem">Aparelho / Veículo
							<span id="aparelhoVer"></span>
						</div> 
					</div>	
				</div>
				<div class="linha">
					<div class="col col-10">
						<div class="col col-5 margem">Marca 
							<span id="marcaVer"></span>
						</div> 
						<div class="col col-5 margem">Modelo 
							<span id="modeloVer"></span>
						</div>
					</div> 	
				</div>
				<div class="linha">
					<div class="col col-10">
						<div class="col col-5 margem">Número Série 
							<span id="numeroSerieVer"></span>
						</div> 
						<div class="col col-5 margem">Chassi 
							<span id="chassiVer"></span>
						</div> 
					</div>
				</div>
				<div class="linha">
					<div class="col col-10">
						<div class="col col-4 margem">Estado 
							<span id="estadoVer"></span>
						</div> 
						<div class="col col-3 margem">Entrada
							<span id="dataEntradaVer"></span>
						</div> 
						<div class="col col-3 margem">Técnico 
							<span id="tecnicoVer"></span>
						</div> 
					</div>
				</div>
				<div class="linha">
					<div class="col col-10">
						<div class="col col-3 margem">Imei 
							<span id="imeiVer"></span>
						</div> 
						<div class="col col-2 margem">Placa 
							<span id="placaVer"></span>
						</div> 
						<div class="col col-5 margem">Renavan 
							<span id="renavamVer"></span>
						</div>
					</div> 
				</div>
				<div class="linha">
					<div class="col col-10">
						<div class="col col-1 margem">Defeito </div>
						<div class="col col-9">
							<input id="defeitoVer" class="input" type="text" value="" />
						</div> 
					</div>
				</div>
				<div class="linha">
					<div class="col col-10">
						<div class="col col-1 margem">Acessório </div>
						<div class="col col-9">
							<input id="acessorioVer" class="input" type="text" value="" />
						</div>
					</div> 
				</div>
				<div class="linha">
					<div class="col col-10">
						<div class="col col-1 margem">Obs. </div>
						<div class="col col-9">
							<input id="obsVer" class="input" type="text" value="" />
						</div>
					</div> 
				</div>
				<div class="linha">
					<div class="col col-10">
						<div class="col col-1-4 margem">Pronto 
							<span id="dtProntoVer" ></span>
						</div> 
						<div class="col col-1-4 margem">Saida 
							<span id="dtSaidaVer" ></span>
						</div>
						<div class="col col-1-4 margem" title="Bandeira do cartão">B.
							<span  id="bandeiraCartaoVer" ></span>
						</div>
						<div class="col col-1-4 margem" >Cod. Barras: 
							<span  title="Código de barras do cadastro" id="barraVer" ></span>
						</div>
					</div>
				</div>
				<div class="linha">
					<div class="col col-10 margem">
						<div class="col col-1" title="Orçamento">Orçamento</div>
						<div class="col col-2 valor-amarelo" >
							<span id="orcamentoVer">R$ 0,00</span>
						</div>
						<div class="col col-1" title="Desconto" >Desconto</div>
						<div class="col col-2 valor-amarelo" >
							<span id="descontoVer">R$ 0,00</span>
						</div>
						<div class="col col-1">Peça</div>
						<div class="col col-3 valor-amarelo" >
							<span id="valorPecaVer">R$ 0,00</span>
						</div>
					</div>
				</div>	
				<div class="linha">
					<div class="col col-10 margem">
						<div class="col col-1" title="Material Auxiliar" >Mat. Aux</div>
						<div class="col col-2 valor-amarelo" >
							<span id="materialAuxiliarVer">R$ 0,00</span>
						</div>
						<div class="col col-1" title="Transporte">Transporte</div>
						<div class="col col-2 valor-amarelo" >
							<span id="transporteVer">R$ 0,00</span>
						</div>
						<div class="col col-1">Lucro</div>
						<div class="col col-3 valor-amarelo" >
							<span id="lucroVer">R$ 0,00</span>
						</div>
					</div>
				</div>	
				<div class="linha">
					<div class="col col-10 margem">
						<div class="col col-1" title="Tipo de cartão" >Cartão</div>
						<div class="col col-1 valor-branco" >
							<span  id="tipoCartaoVer" ></span>
						</div>
						<div class="col col-1" title="Parcelas do cartão" >Parcelas</div>
						<div class="col col-1 valor-branco" >
							<span id="parcelasCartaoVer" >0</span>
						</div>
						<div class="col col-1" title="Juros ao mês">J. Mês</div>
						<div class="col col-2 valor-amarelo" >
							<span id="jurosCartaoVer">R$ 0,00</span>
						</div>
						<div class="col col-1" title="Soma total dos juros">T. Juros</div>
						<div class="col col-2 valor-amarelo" >
							<span id="somaJurosVer">R$ 0,00</span>
						</div>
					</div>
				</div>	
				<div class="linha">
					<div class="col col-10 margem">
						<div class="col col-3">Material</div>
						<div class="col col-4"></div>
						<div class="col col-2" title="Valor do objeto">Valor do Objeto</div>
						<div class="col col-1 valor-branco" >
							<span id="valorObjetoVer">R$ 0,00</span>
						</div>
					</div>
				</div>
				<div class="linha">
					<div class="col col-10">																					
						<textarea class="textarea" cols="10" rows="5" id="materialVer" name="material"  autocomplete="off" maxlength="254" onKeyup="pri_mai(this);" ></textarea> 		
					</div>
				</div>
				<div class="linha">
					<div class="col col-10">
							<div class="col col-1-3" >
								<div class="logomarca" >   
								<center><img id="fotoCliente1Ver" class="img_cadastro" height="78px" width="100%" title="Clique para ampliar a imagem" onclick="document.getElementById('fotoAmpliada').style.display='block';document.getElementById('foto_ampliada').src = fotoCliente1Ver.src "/></center> 				
								</div>	
							</div>
							<div class="col col-1-3">
								<div class="logomarca" >
								<center><img id="fotoCliente2Ver" class="img_cadastro" height="78px" width="100%" title="Clique para ampliar a imagem" onclick="document.getElementById('fotoAmpliada').style.display='block';document.getElementById('foto_ampliada').src = fotoCliente2Ver.src "/></center>
								</div>	
							</div>
							<div class="col col-1-3">
								<div class="logomarca" >
									<center><img id="fotoCliente3Ver" class="img_cadastro" height="78px" width="100%" title="Clique para ampliar a imagem" onclick="document.getElementById('fotoAmpliada').style.display='block';document.getElementById('foto_ampliada').src = fotoCliente3Ver.src "/></center>
								</div>	
							</div>		
					</div>
				</div>
			</div>		
			<div class="col col-5">
				<!-- Inicio retorno 1 -->
				<div id="verRet1" class="sumido">
					<div class="linha">
						<div class="col col-2 retorno" >Retorno 1</div>
						<div id="novaOSRet1" class="col col-2 margem"></div>
						<div id="dataEntradaRetorno1Ver" class="col col-3 margem"></div> 
						<div id="dataProntoRetorno1Ver" class="col col-3 margem"></div> 			
					</div>
					<div class="linha">			
						<div id="dataSaidaRetorno1Ver" class="col col-3 margem"></div> 
						<div id="estadoRet1" class="col col-4 margem"></div> 
						<div class="col col-3 margem"  id="pecaRet1" ></div>	  			
					</div>
					<div class="linha">
						<div class="col col-1 margem">Def.</div>
						<div class="col col-9"><input id="defeitoRet1"  type="text" value="" ></div> 
					</div>
					<div class="linha">
						<div class="col col-1 margem">Acess.</div>
						<div class="col col-9"><input id="acessorioRet1" type="text" value="" ></div> 
					</div>
					<div class="linha">
						<div class="col col-1 margem">Obs.</div>
						<div class="col col-9"><input id="obsRet1" type="text" value="" ></div> 
					</div>
					<div class="linha">
						<div class="col col-1 margem2">Mat.</div>
						<div class="col col-9">                                                                                       
							<textarea class="textarea" cols="10" rows="3" id="matRet1" name="material"  autocomplete="off" maxlength="254" onKeyup="pri_mai(this);" ></textarea> 		
						</div>
					</div>	
				</div>
				<!-- Inicio retorno 2 -->
				<div id="verRet2" class="sumido">		
					<div class="linha">
							<div class="col col-2 retorno" >Retorno 2</div>
							<div id="novaOSRet2" class="col col-2 margem"></div>
							<div id="dataEntradaRetorno2Ver" class="col col-3 margem"></div> 
							<div id="dataProntoRetorno2Ver" class="col col-3 margem"></div> 			
						</div>
						<div class="linha">			
							<div id="dataSaidaRetorno2Ver" class="col col-3 margem"></div> 
							<div id="estadoRet2" class="col col-4 margem"></div> 
							<div class="col col-3 margem" id="pecaRet2" ></div>	  			
						</div>
						<div class="linha">
							<div class="col col-1 margem">Def.</div>
							<div class="col col-9"><input id="defeitoRet2"  type="text" value="" /></div> 
						</div>
						<div class="linha">
							<div class="col col-1 margem">Acess.</div>
							<div class="col col-9"><input id="acessorioRet2" type="text" value="" /></div> 
						</div>
						<div class="linha">
							<div class="col col-1 margem">Obs.</div>
							<div class="col col-9"><input id="obsRet2" type="text" value="" /></div> 
						</div>
						<div class="linha">
							<div class="col col-1 margem2">Mat.</div>
							<div class="col col-9">                                                                                       
							<textarea class="textarea" cols="10" rows="3" id="matRet2" name="material"  autocomplete="off" maxlength="254" onKeyup="pri_mai(this);" ></textarea> 		
						</div>	
					</div>
				</div>
				<!-- Inicio retorno 3 -->
				<div id="verRet3" class="sumido">	
					<div class="linha">
							<div class="col col-2 retorno" >Retorno 3</div>
							<div id="novaOSRet3" class="col col-2 margem"></div>
							<div id="dataEntradaRetorno3Ver" class="col col-3 margem"></div> 
							<div id="dataProntoRetorno3Ver" class="col col-3 margem"></div> 			
						</div>
						<div class="linha">			
							<div id="dataSaidaRetorno3Ver" class="col col-3 margem"></div> 
							<div id="estadoRet3" class="col col-4 margem"></div> 
							<div class="col col-3 margem"  id="pecaRet3" ></div>	  			
						</div>
						<div class="linha">
							<div class="col col-1 margem">Def.</div>
							<div class="col col-9"><input id="defeitoRet3"  type="text" value="" /></div> 
						</div>
						<div class="linha">
							<div class="col col-1 margem">Acess.</div>
							<div class="col col-9"><input id="acessorioRet3" type="text" value="" /></div> 
						</div>
						<div class="linha">
							<div class="col col-1 margem">Obs.</div>
							<div class="col col-9"><input id="obsRet3" type="text" value="" /></div> 
						</div>
						<div class="linha">
							<div class="col col-1 margem2">Mat.</div>
							<div class="col col-9">                                                                                       
							<textarea class="textarea" cols="10" rows="3" id="matRet3" name="material"  autocomplete="off" maxlength="254" onKeyup="pri_mai(this);" ></textarea> 		
						</div>	
					</div>
				</div>		
				<!-- ver alteracoes na pagina ver cadastro -->
				<div class="formulario_cadastro" id="ver_alteraçoes">
					<div class="cabecario_padrao">  			  			  	  	
						<span title="Clique para fechar a página alterações no cadastro " class="simbolo_padrao" onclick="document.getElementById('ver_alteraçoes').style.display = 'none';">&times</span>
						<span class="atualizar_pagina" title="clique para atualizar a página" onclick="document.location.reload(true);" >&#8635</span>	
						<b class="texto">Ver Alterações</b> 
					</div> 
					<div class="scroll_lateral_esquerdo" style="height: 460px;">	
						<table  border="1" style="border-collapse: collapse;" cellpadding="2" cellspacing="0">
							<tr class="linha_home">										
								<td id="verAlteracao" style="padding:10px;font-size:12px;" >
									<!-- mostra aqui as alteracoes feitas no cadastro -->
								</td>
								<form id="formularioFunc" name="formularioVerAlteracao" class="form-horizontal" action="../html/imprimindo.php"  method="post" enctype="multipart/form-data" autocomplete="off" > 
									<input type="hidden" id="idAlteracao" value="" name="idAlteracao"> 
									<input type="submit" id="imp_ver" name="imprimir_ver_alteracao" class="sumido"  value="" />
								</form>									
							</tr>	
						</table>
					</div>			
						<div class="col col-10 div_rodape" >
							<button type="button"  class="botao" onclick="document.getElementById('imp_ver').click();"><i class="fas fa-print"></i><span class="espaco">Imprimir</span></button>
							<button type="button" class="botao but_fechar" title="Clique para fechar o formulário de retorno" onclick="document.getElementById('ver_alteraçoes').style.display='none';resetForm();"><i class='fas fa-times but-fechar espaco'></i><span class="espaco">Fechar</span></button>
						</div>			
				</div>
			</div>
			<div class="linha">
				<div class="col col-10 div_rodape">
					<form id="formularioFunc" name="formularioFunc" class="form-horizontal" action="../html/imprimir_tudo.php"  method="post" enctype="multipart/form-data"  > 
						<input type="hidden" id="imprimir_ver" value="" name="imprimir_tudo"> 
						<button type="submit" name="imprimir_tudo_ver" id="impVer" class="botao" value="IMPRIMIR" ><i class="fas fa-print"></i><span class="espaco">IMPRIMIR</span></button>
					</form>	
					<button id="botaoAlteracao" class="botao"  onclick="document.getElementById('ver_alteraçoes').style.display = 'block';"><i class="fas fa-edit"></i><span class="espaco">ALTERAÇÃO</span></button>				
					<button type="button" class="botao but_fechar" title="Clique para fechar o formulário novo cadastro e alterar cadastro" onclick="document.getElementById('ver_cadastro').style.display='none';resetForm();"><i class='fas fa-times but-fechar espaco'></i><span class="espaco">Fechar</span></button>
				</div>
			</div>
		</div> <!-- fim ver alteracoes na pagina ver cadastro -->

		<!-- formulario de retorno -->
		<div id="form_retorno" class="formulario_cadastro" >
				<div class="cabecario_padrao">             	  	            	  	    
					<span title="Clique para fechar o formulário de retorno" class="simbolo_padrao" onclick="document.getElementById('form_retorno').style.display='none';resetForm()">&times</span>
					<span class="atualizar_pagina" title="clique para atualizar a página" onclick="document.location.reload(true);" >&#8635</span>
					<b> 
						<span id="textoRetorno" class="texto"></span>  
					</b>
				</div>
				<form id="formularioRetorno" name="frmEnviaDados" class="form-horizontal" action="../php/cadastro_retorno.php"  method="post" enctype="multipart/form-data" autocomplete="off" >       
					<div class="col col-5">
						<div class="linha">
							<input id="controleRetorno" name="controleRetorno" type="hidden" value="" />  
							<input id="codigoRetorno" name="codigoRetorno" type="hidden" value="" /> 
							<div class="col col-10">  
								<div class="col col-1 margem">O.S.</div>
								<div class="col col-1">
									<input id="osRetorno"  readonly="readonly"  type="text" value="" /> 		
								</div>
								<div class="col col-1 margem">Nome</div>
								<div class="col col-7 ">
									<input id="nomeRetorno"  readonly="readonly"  type="text" value="" /> 		
								</div>
							</div> 
						</div>
						<div class="linha">
							<div class="col col-10">
								<div class="col col-1 margem">Aparelho</div>
								<div class="col col-4">
									<input id="aparelhoRetorno" class="input" type="text" readonly="readonly"  value="" />
								</div>
								<div class="col col-5 margem" style="height:20px;"></div>
							</div>
						</div>
						<div class="linha">
							<div class="col col-10">
								<br><hr>
							</div>
						</div>
						<div class="linha">
							<div class="col col-10"><br>
								<div class="col col-1">Nova O.S.</div>
								<div class="col col-4 t-vermelho">* Estado</div>
								<div class="col col-5"></div>
							</div>
						</div>
						<div class="linha">
							<div class="col col-10">
								<div class="col col-1">
									<input title="Nova O.S." id="novaOSRetorno" inputmode="text" class="input" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="novaOSRetorno" type="text" maxlength="7" autofocus autocomplete="off"  value="" />
								</div>
								<div class="col col-4">
									<select id="estadoRetAlt" name="estadoRetorno" required >
									</select>
									<input type="text" id="estadoNaoModificavelRet" value="" class="sumido" readonly >
								</div>
								<div class="col col-5"></div>
							</div>
						</div>
						<div class="linha">
							<div class="col col-10"><br>
								<div class="col col-1 t-vermelho ">* Defeito</div>
								<div class="col col-9">
								</div>
							</div>
						</div>
						<div class="linha">
							<div class="col col-10">
								<input id="defeitoRetorno" class="input-1-10"  name="defeitoRetorno" type="text"  maxlength="80" value="" required onKeyup="pri_mai(this);" onblur="validarRetorno();"/>
							</div>
						</div>
						<div class="linha">
							<div class="col col-10"><br>
								<div class="col col-1">Acessório</div>
								<div class="col col-9">
								</div>
							</div>
						</div>
						<div class="linha">
							<div class="col col-10">
								<input id="acessorioRetorno" class="input-1-10" name="acessorioRetorno" type="text" maxlength="80"   value=""  onKeyup="pri_mai(this);" />                               
							</div>
						</div>
						<div class="linha">
							<div class="col col-10"><br>
								<div class="col col-2">Observação</div>
								<div class="col col-8">
								</div>
							</div>
						</div>
						<div class="linha">
							<div class="col col-10">
								<input class="input-1-10" id="obsRetorno" name="obsRetorno" type="text"  maxlength="100" value="" onKeyup="pri_mai(this);" />
							</div>
						</div>
						<div class="linha">
							<div class="col col-10"><br>
								<div class="col col-1-3">
									<div class="col col-5 top-data" >Data de Entrada</div>
									<div class="col col-5">
									</div>
								</div>
								<div class="col col-1-3">
									<div class="col col-5 top-data" >Data de Pronto</div>
									<div class="col col-5">
									</div>
								</div>
								<div class="col col-1-3">
									<div class="col col-5 top-data" >Data de Saída</div>
									<div class="col col-5">
									</div>
								</div>
							</div>		
						</div>
						<div class="linha">
							<div class="col col-10">
								<div class="col col-1-3">
									<input  id="dataEntradaRetorno" name="dataEntradaRetorno" type="datetime-local" value=""  />
								</div>
								<div class="col col-1-3">
									<input id="dataProntoRetorno"  class="input"  name="dataProntoRetorno" type="datetime-local" value=""  />
								</div>
								<div class="col col-1-3">
									<input id="dataSaidaRetorno" class="input" name="dataSaidaRetorno" type="datetime-local" value=""  />
								</div>
							</div>		
						</div>		
						<div class="linha">
							<div class="col col-10"><br>
								<div class="col col-1">Material</div>
								<div class="col col-9"></div>
							</div>
						</div> 
						<div class="linha">
							<div class="col col-10">
								<textarea class="textarea" cols="10" rows="7" id="materialRetorno" name="materialRetorno"  autocomplete="off" maxlength="254" onKeyup="pri_mai(this);" ></textarea>
							</div>
						</div>
						<div class="linha">
							<div class="col col-10"><br>
								<div class="col col-1-3">
									<div class="col col-1">Peça</div>
									<div class="col col-9">	
									</div>
								</div>
								<div class="col col-1-3" ></div>
								<div class="col col-1-3" ></div>
							</div>
						</div>
						<div class="linha">
							<div class="col col-10">
								<div class="col col-1-3">
									<input placeholder="R$" class="input" id="pecaRetorno" name="pecaRetorno" maxlength="5" autocomplete="off" onKeyUp="if(this.value.length > 10 && event.keyCode != 8){alert('O valor maximo é 999.999,99');this.value = '';};" onKeyPress="return(moeda(this,'.',',',event))" type="text" value=""/>
								</div>
								<div class="col col-1-3" ></div>
								<div class="col col-1-3" ></div>
							</div>
						</div>		
					</div> 
					<div class="col col-5">
						<div class="linha">
							<div class="col col-10">
								<div class="col col-1 margem">Modelo</div>
								<div class="col col-4">
									<input id="modeloRetorno" class="input" readonly="readonly"  type="text" value=""  >                               
								</div>
								<div class="col col-1 margem">N. Série</div>
								<div class="col col-4">
									<input id="numeroSerieRetorno" class="input" readonly="readonly"  type="text" value="" >
								</div>
							</div>
						</div>
						<div class="linha">
							<div class="col col-10">
								<div class="col col-1 margem">Marca</div>
								<div class="col col-4">
									<input id="marcaRetorno" class="input" type="text" readonly="readonly"  value="" />
								</div>
								<div class="col col-5 margem" style="height:20px;"></div>
							</div>
						</div>
						<div class="linha">
							<div class="col col-10">
								<br><hr>
							</div>
						</div>
					</div>
					<div class="linha">
						<div class="col col-10 div_rodape" >
							<button type="submit"  title="Clique para alterar o retorno" id="retorno_sub" class="botao" id="enviarRetorno" value="" onclick="return validarRetorno()" ><span class="espaco"></span></button>
							<button type="button" class="botao but_fechar" title="Clique para fechar o formulário de retorno" onclick="document.getElementById('form_retorno').style.display='none';resetForm();"><i class='fas fa-times but-fechar espaco'></i><span class="espaco">Fechar</span></button>
						</div>
					</div>
				</form>
		</div> <!-- fim formulario retorno -->

		<script>
			
			//********** FUNCAO QUE SO PERMITE ACESSAR O SISTEMA PELO SERVIDOR

			let contaSession = 0;
			function servidor(){	
				fetch('http://localhost:80/controle_OS/sistema/php/busca_informacao.php?servidorHome=sim')
				.then(response => {
					if (response.ok) {
					return response.json();
					}
				})
				.then(json => {
					document.getElementById('spanGerente2').innerHTML = "<span style='font-weight:bold;color:orange'> &nbsp&nbsp Prot - " + contaSession + "</span>";
				})
				.catch(error => {
					alert('O sistema só pode ser acesado pelo servidor');
					window.location.href='../php/expira_session.php';
				}); 
				contaSession++;
			};	

			// FUNCAO VALIDA A IDADE PARA CADASTRAR O FUNCIONARIO

			function idadeFunc(){
				let dataInformada = document.getElementById('dataNascimentoFunc').value;
				let mostraIdade =  document.getElementById('idade2Func');
				let nova = new Date(dataInformada);
				let idade = Math.floor((Date.now() - nova)/(31557600000));
				let idadeMinima = '<?php echo $resultado['idadeMinima'];?>';
				let idadeMaxima = '<?php echo $resultado['idadeMaxima'];?>';
				// valida o campo data
				if((!parseInt(idade) && idade !=0) || idade < 0){
					alert("A data é inválida!");
					document.getElementById('dataNascimentoFunc').value = "";
					return false;			
				}else if(idade <  idadeMinima || idade > idadeMaxima){					
					alert(idade + " anos, Só cadastra com " + idadeMinima + " até "+ idadeMaxima + " anos!");
					document.getElementById('dataNascimentoFunc').value = "";
					document.getElementById('idade2Func').innerHTML = "";
					return false;
				}else{
					mostraIdade.innerHTML = idade;
				};
			};
			let codigoFunc = '<?php echo $_SESSION["controle"];?>';
		</script>
	</body>
</html>