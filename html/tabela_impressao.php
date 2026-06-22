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
	if(empty($_SESSION['logado'])){
		header("Location:home.php");
		exit;   
	};
	require_once '../php/consulta.php';
	require_once '../php/funcoes_php.php';

	if(isset($_REQUEST['codigo_cliente'])){
		$codigo = $_REQUEST['codigo_cliente'];
	}
	if(empty($_REQUEST['talao'])){ 
		// Se a solicitação de imprimir vier direto do formuláario de cadastro, a Session tem a preferencia
		if(isset($_SESSION['codigo_cliente'])){
			$codigo = $_SESSION['codigo_cliente'];
		}  
		$listagem = $conexao->prepare("SELECT * FROM cliente WHERE codigo = ? "); 
		$listagem->execute([$codigo]);
		$linha = $listagem->fetch();
		// Destroi a session
		unset($_SESSION['codigo_cliente']);
		// Separa a data
		$data = $linha['dataEntrada']; 
		$array = explode("-", $data);
		$ano = $array[0];
		$mes = $array[1];
		$dia = $array[2];
		if($linha['dataSaida']<>'0000-00-00'){
			$datas = $linha['dataSaida']; 
			$array = explode("-", $datas);
			$anos = $array[0];
			$mess = $array[1];
			$dias = $array[2];
		}else{
			$anos = "";
			$mess = "";
			$dias = "";	
		}
	}
	?>
	<style>
		#conteudo{
			font-family: Helvetica, Arial, sans-serif;
			position:absolute;
			width:1010px;
			height:654px;
			top:0px;
			left:5px;
			border:1px solid darkblue;
			color:darkblue;
		}
		#conteudo2{
			font-family: Helvetica, Arial, sans-serif;
			position:absolute;
			width:1000px;
			height:705px;
			top:680px;
			left:5px;
			border:1px solid darkblue;
			color:darkblue;
			padding-left:10px;
		}
		#conteudo3{
			font-family: Helvetica, Arial, sans-serif;
			position:absolute;
			width:1000px;
			height:630px;
			top:80px;
			left:0px;
			border:1px solid darkblue;
			color:darkblue;
			padding-left:10px;
		}
		.cabecario_imprimir{
			position:absolute;
			width:1010px;
			height:102px;
			top:-1px;
			left:-1px;
			border:1px solid darkblue;
		}			
		.logomarca_imprimir{
			position:absolute;
			width:200px;
			height:90px;
			top:3px;
			left:3px;
			border:1px solid #ddd;
		}
		.oficina_imprimir{
			position:absolute;
			width:450px;
			height:90px;
			top:10px;
			left:170px;	
		}
		.telefone_imprimir{
			position:absolute;
			font-family: Helvetica, Arial, sans-serif;
			font-size: 20px;
			width:530px;
			height:25px;
			top:60px;
			left:10px;
		}
		.eletro{
			position:absolute;
			font-family: Helvetica, Arial, sans-serif;
			font-size: 25px;
			width:530px;
			height:30px;
			top:-5px;
			left:-5px;
		}
		.eletro1{
			position:absolute;
			font-family: Helvetica, Arial, sans-serif;
			font-size: 25px;
			width:530px;
			height:30px;
			top:-5px;
			left:-5px;
		}
		.data_imprimir{
			position:absolute;
			width:350px;
			height:93px;
			font-size:15px;
			top:3px;
			left:640px;
		}
		.rodape_imprimir{
			position:absolute;
			font-family: Helvetica, Arial, sans-serif;
			font-size:12px;		   
			width:1010px;
			height:22px;
			top:628px;
			left:-1px;
			border:1px solid darkblue;
			background:#fff;
			color:red;
			padding-top:7px;
		}
		.rodape_imprimir1{
			position:absolute;
			font-family: Helvetica, Arial, sans-serif;
			font-size:12px;		   
			width:1010px;
			height:21px;
			top:602px;
			left:-1px;
			border:1px solid darkblue;
			color:red;
			padding-top:5px;
		}
		.end{
			position:absolute;
			font-family: Helvetica, Arial, sans-serif;
			font-size:12px;
			width:530px;
			height:20px;
			top:35px;
			left:-5px;			
		}
		.dados_cadastro{
			position:absolute;
			font-family: Helvetica, Arial, sans-serif;
			font-size:12px;
			width:1010px;
			height:140px;
			top:102px;
			left:-1px;
			border:1px solid darkblue;			
		}
		.cabecario_dados_cadastro{
			position:absolute;
			font-family: Helvetica, Arial, sans-serif;
			font-size:12px;
			width:1010px;
			height:22px;
			top:243px;
			left:-1px;
			border:1px solid darkblue;
			padding-top:2px;	
		}
		.tabela_discriminacao{
			position:absolute;		
			width:1012px;
			height:15px;
			top:268px;
			left:-1px;
			border:1px solid darkblue;
			color:white;			
		}
		.qua{
			position:absolute;
			left:10px;
			padding-top:2px;		
		}
		.dis{
			position:absolute;
			left:330px;
			padding-top:2px;			
		}
		.uni{
			position:absolute;
			left:800px;
			padding-top:2px;			
		}
		.tot{
			position:absolute;
			left:920px;
			padding-top:2px;
		}
		.cli{
			position:absolute;
			top:10px;
			left:5px;			
		}
		.mostranome{
			position:absolute;
			top:10px;
			left:50px;			
		}
		.ende{
			position:absolute;
			left:5px;
			top:36px;			
		}
		.mostraendereco{
			position:absolute;
			top:36px;
			left:50px;			
		}
		.os{
			position:absolute;
			top:5px;
			left:810px;
			width:180px;
			height:20px;
			padding-left:10px;
			padding-top:2px;
			border:1px solid darkblue;		
		}
		.os1{
			position:absolute;
			top:5px;
			left:810px;
			width:180px;
			height:20px;
			padding-left:10px;
			padding-top:2px;
			border:1px solid darkblue;
			text-align:left;		
		}
		.mostraos{
			position:absolute;
			top:7px;
			left:870px;
			font-size:18px;						
		}
		.fon{
			position:absolute;
			left:810px;
			top:40px;			
		}
		.mostrafone{
			position:absolute;
			top:37px;
			left:850px;
			font-size:15px;	
		}
		.apa{	
			position:absolute;
			left:5px;
			top:65px;				
		}
		.defei{
			position:absolute;
			left:500px;
			top:65px;			
		}
		.mostraapa{
			position:absolute;
			top:65px;
			left:60px;			
		}
		.mostraobs{			
			position:absolute;
			top:95px;
			left:40px;			
		}
		.def{				
			position:absolute;
			left:5px;
			top:95px;	
		}
		.mostradef{				
			position:absolute;
			top:65px;
			left:550px;				
		}
		.acess{				
			position:absolute;
			left:5px;
			top:125px;				
		}
		.mostraacess{				
			position:absolute;
			top:124px;
			left:70px;					
		}
		.mostrar_dia_entrada{
			position:absolute;
			top:38px;
			left:165px;				
		}
		.mostrar_mes_entrada{
			position:absolute;
			top:38px;
			left:220px;				
		}
		.mostrar_ano_entrada{
			position:absolute;
			top:38px;
			left:270px;				
		}
		.mostrar_dia_saida{
			position:absolute;
			top:72px;
			left:165px;					
		}
		.mostrar_mes_saida{
			position:absolute;
			top:72px;
			left:220px;					
		}
		.mostrar_ano_saida{
			position:absolute;
			top:72px;
			left:270px;				
		}				
		.total{
			position:absolute;
			top:603px;
			left:809px;
			font-size:20px;		
		}
		.total1{
			position:absolute;
			top:575px;
			left:810px;
			font-size:20px;	
		}
		.material{
			position:absolute;
			top:275px;
			left:60px;
		}
		.maodeobra{
			position:absolute;
			top:575px;
			left:900px;
		}
		.mao{
			position:absolute;
			font-size:12px;
			top:577px;
			left:65px;
		}
		.mao1{
			position:absolute;
			font-size:12px;
			top:550px;
			left:60px;
		}
		.valorPeca{
			position:absolute;
			top:275px;
			left:900px;					
		}
		.cobrir_tabela{
			position:absolute;
			top:598px;
			left:-1px;
			width:760px;
			height:24px;
			padding-top:5px;
			padding-left:10px;
			border:1px solid darkblue;
			background-color:white;
		}
		.cobrir_tabela1{
			position:absolute;
			top:569px;
			left:-1px;
			width:760px;
			height:27px;
			padding-top:6px;
			padding-left:10px;
			border:1px solid darkblue;
			background-color:white;
			text-align:left;
			font-size:15px;
		}	
		a{
			color:darkblue;
		}	
	</style>
</head>		
<body>
	<a href="../html/home.php">
	<div id="conteudo">
		<div class="cabecario_imprimir">
			<div class="logomarca_imprimir">
				<?php 
				// se o arquivo existir, ou seja se já estiver sido carregado na pasta, então ele mostra
				if (($resultado['logomarca']<>"")AND(file_exists("../imagem_cliente/logomarca.jpg"))){
					echo'<img src="../imagem_cliente/logomarca.jpg" width="100%"  height="100%" >'; 
				}; 
				?> 
			</div>
			<div class="oficina_imprimir">			
				<span class="eletro"><center><strong><?php echo $resultado['oficina'] ;?></strong></center></span> 				
					<span class="end"><center><?php echo $resultado['endereco']; ?></center></span>		
				<span class="telefone_imprimir" style="color:red"><center>Fone :<?php echo $resultado['telefone']; if($resultado['telefone2']<>""){echo " - ".$resultado['telefone2'];} ?></center></span>
			</div>			
			<div class="data_imprimir">
				<span style="font-size:20px"><strong><center>NOTA DE SERVIÇO</center></strong></span><br>
				<center>Data de Entrada _____/_______/______<br><br>
					<span class="mostrar_dia_entrada"><?php if(empty($_REQUEST['talao'])){echo $dia;} ?></span>
					<span class="mostrar_mes_entrada"><?php if(empty($_REQUEST['talao'])){echo $mes;} ?></span>
					<span class="mostrar_ano_entrada"><?php if(empty($_REQUEST['talao'])){echo $ano;} ?></span>
					Data de Saida&nbsp&nbsp&nbsp _____/_______/______
				</center>
				<span class="mostrar_dia_saida"><?php if(empty($_REQUEST['talao'])){echo $dias;} ?></span>
				<span class="mostrar_mes_saida"><?php if(empty($_REQUEST['talao'])){echo $mess;} ?></span>
				<span class="mostrar_ano_saida"><?php if(empty($_REQUEST['talao'])){echo $anos;} ?></span>
			</div>
		</div>
		<div class="dados_cadastro">
			<span class="cli">Cliente:</span>
			<span class="mostranome"><?php if(empty($_REQUEST['talao'])){echo resumo($linha['nome'],65);};?></span>
			<span class="ende">End.:</span>
			<span class="mostraendereco"><?php if(empty($_REQUEST['talao'])){echo resumo($linha['endereco'],65);};?></span>
			<span class="os">OS Nº</span>
			<span class="mostraos"><strong><?php if(empty($_REQUEST['talao'])){echo $linha['ordemServico'];};?></strong></span>
			<span class="fon">Fone:</span>
			<span class="mostrafone"><?php if(empty($_REQUEST['talao'])){echo $linha['telefone'];};?></span>			
			<span class="apa">Aparelho:</span>
			<span class="defei">Defeito:</span>		
			<span class="mostraapa"><?php if(empty($_REQUEST['talao'])){if($linha['aparelho']<>"ESCOLHA"){ ; 
				echo resumo($linha['aparelho'],20). "&nbsp&nbsp&nbsp Marca: ".resumo($linha['marca'],12);};
				};?></span>
			<span class="mostraobs"><?php if(empty($_REQUEST['talao'])){if($linha['observacao']<>""){ ; echo resumo($linha['observacao'],84);
			;};};?></span>	
			<span class="def">Obs.:</span>
			<span class="mostradef"><?php if(empty($_REQUEST['talao'])){if($linha['defeitoReclamado']<>""){ ; echo resumo($linha['defeitoReclamado'],39);};};?></span>				
			<span class="acess">Acessório:</span>
			<span class="mostraacess"><?php if(empty($_REQUEST['talao'])){if($linha['acessorio']<>""){ ; echo resumo($linha['acessorio'],82);};};?></span>				
		</div>
		<div class="cabecario_dados_cadastro">
			<strong>
			<span class="qua">Quant.</span>
			<span class="dis">Discriminação dos serviços</span>
			<span class="uni">Unitário</span>
			<span class="tot">TOTAL</span>
				</strong>
		</div>		
			<table class="tabela_discriminacao" border="1" style="border-collapse: collapse" cellpadding="2" cellspacing="0" >                                
				<?php for($i = 1; $i<=13; $i++){?>
				<tr>
					<td width="35px" height="25px"></td><!-- linhas da Quantidade -->
					<td width="500px"></td><!-- linhas da Descriminacao -->
					<td width="80px"></td><!-- linhas de Unitario-->
					<td width="80px"></td><!-- linhas de TOTAL -->
				</tr>
				<?php } ?>
			</table>
			<span class="total">
				<?php echo "TOTAL :".'&nbsp&nbsp';// TOTAL geral embaixo
			if(empty($_REQUEST['talao'])){if($linha['orcamento']<>0){
				//echo "R$".$linha['orcamento'].",00";
			};}?>
				</span>		
		<span class="material">
			<?php if(empty($_REQUEST['talao'])){if($linha['material']<>""){
				//echo $linha['material']
				;};}?>
				</span>	
				<span class="valorPeca">
					<?php if(empty($_REQUEST['talao'])){if($linha['orcamento']<>0){
				//echo "R$".$linha['valorPeca'].",00";
				};}?>
				</span>
				<span class="maodeobra">
					<?php if(empty($_REQUEST['talao'])){if($linha['orcamento']<>0){
				//echo "R$".($linha['orcamento']-$linha['valorPeca']).",00";
				};}?>
				</span>
				<span class="mao">Mão de obra do serviço prestado</span>
				<span class="cobrir_tabela">Técnico responsável :&nbsp&nbsp
					<?php 
					// decide se imprimi com, ou sem o nome do tecnico
					if((isset($resultado['escolha']))AND($resultado['escolha']=="sim")){
						if((isset($linha['tecnico']))AND($linha['tecnico']<>"")){
							echo $linha['tecnico'];
						}else{				
							echo $resultado['usuario'];  	
						}
					};
					?>					
				</span>								
		<div class="rodape_imprimir">
			<center><?php echo $resultado['rodape']; if(empty($_REQUEST['talao'])){?></center>				
		</div>			
	</div>		
	<div id="conteudo2">			
		<strong><h3><?php echo $linha['nome'] ?></h3></strong>
		O S :<strong><?php echo $linha['ordemServico'] ?></strong><br>
		Endereco : <?php if($linha['endereco']<>""){echo "<textarea  style='resize: none;border-color:#ccf;color:darkblue;font-size:18px;' cols='96' rows='2' >".$linha['endereco']."</textarea>"; }else{?>______________________________________________________________________________________________<?php } ?><br>
		Telefone :<?php if($linha['telefone']<>""){echo $linha['telefone'].'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';}else{ ?>____________________<?php } ?>
		Telefone 2 :<?php if($linha['telefone2']<>""){echo $linha['telefone2'].'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';}else{ ?>____________________<?php } ?>
		CPF :<?php if($linha['cpf']<>""){echo $linha['cpf'];}else{ ?>____________________<?php } ?><br>
		Data de Entrada : <?php echo date('d/m/Y', strtotime($linha['dataEntrada'])); ?><br>
		Defeito :<?php if($linha['defeitoReclamado']<>""){echo "<textarea  style='resize: none;border-color:#ccf;color:darkblue;font-size:18px;' cols='96' rows='2' >".$linha['defeitoReclamado']."</textarea>";}else{ ?>_________________________________________________________________________________________________<?php } ?>
		Aparelho :<?php if($linha['aparelho']<>"ESCOLHA"){echo $linha['aparelho'];}else{ ?>__________________________________________________________________________________<?php } ?><br>
		Marca :<?php if($linha['marca']<>""){echo $linha['marca'];}else{ ?>______________________________________________________________________________________________<?php } ?><br>
		Modelo :<?php if($linha['modelo']<>""){echo $linha['modelo'];}else{ ?>_________________________________________________________________________________<?php } ?><br>
		Acessório :<?php if($linha['acessorio']<>""){echo "<textarea  style='resize: none;border-color:#ccf;color:darkblue;font-size:18px;' cols='96' rows='2' >".$linha['acessorio']."</textarea>";}else{ ?>_____________________________________________________________________________<?php } ?><br>
		Observação :<?php if($linha['observacao']<>""){echo "<textarea  style='resize: none;border-color:#ccf;color:darkblue;font-size:18px;' cols='96' rows='2' >".$linha['observacao']."</textarea>";}else{ ?>____________________________________________________________________________<?php } ?>		
		<br><br>		
		Estado :<?php echo $linha['estado'] ?><br>
		Material :<?php echo "<textarea  style='resize: none;border-color:#ccf;color:darkblue;font-size:18px;' cols='96' rows='3' >".$linha['material']."</textarea>" ?><br>
		Peça :R$ <?php echo $linha['valorPeca'] ?><br>
		Orçamento :R$ <?php echo $linha['orcamento'] ?><br>
		Data de Pronto :<?php echo date('d/m/Y', strtotime($linha['dataPronto'])); ?><br>
		Data de Saída :<?php echo date('d/m/Y', strtotime($linha['dataSaida'])); ?><br>
		<?php }if(isset($_REQUEST['talao'])){?>
		<div id="conteudo3">
		<div class="cabecario_imprimir">	
		<div class="logomarca_imprimir">
		<?php 
		// se o arquivo existir, ou seja se já estiver sido carregado na pasta, então ele mostra
		if (($resultado['logomarca']=="sim")AND(file_exists("../imagem_cliente/logomarca.jpg"))){
				echo'<img src="../imagem_cliente/logomarca.jpg" width="100%"  height="100%" >'; 
		}; 
		?>
		</div>
		<div class="oficina_imprimir">
			<span class="eletro1"><center><strong><?php echo $resultado['oficina'] ;?></strong></center></span> 
				<span class="end"><center><?php echo $resultado['endereco']; ?></center></span>		
			<span class="telefone_imprimir" style="color:red"><center>Fone :<?php echo $resultado['telefone'] ?></center></span>
		</div>	
		<div class="data_imprimir">
			<span style="font-size:20px"><strong><center>NOTA DE SERVIÇO</center></strong></span><br>
		<center>Data de Entrada _____/_______/______<br><br>
		<span class="mostrar_dia_entrada"><?php if(empty($_REQUEST['talao'])){echo $dia;} ?></span>
		<span class="mostrar_mes_entrada"><?php if(empty($_REQUEST['talao'])){echo $mes;} ?></span>
		<span class="mostrar_ano_entrada"><?php if(empty($_REQUEST['talao'])){echo $ano;} ?></span>
			Data de Saida&nbsp&nbsp&nbsp _____/_______/______</center>
			<span class="mostrar_dia_saida"><?php if(empty($_REQUEST['talao'])){echo $dias;} ?></span>
			<span class="mostrar_mes_saida"><?php if(empty($_REQUEST['talao'])){echo $mess;} ?></span>
			<span class="mostrar_ano_saida"><?php if(empty($_REQUEST['talao'])){echo $anos;} ?></span>
		</div>	
		</div>
		<div class="dados_cadastro">
			<span class="cli">Cliente:</span>
			<ul style="border-top: 1px darkblue solid; margin-top: 23px; margin-left:-170px; width:700px;"></ul>
			<span class="mostranome"><?php if(empty($_REQUEST['talao'])){echo $linha['nome'];};?></span>
			<span class="ende">End.:</span>
			<ul style="border-top: 1px darkblue solid; margin-top: 25px; margin-left:-180px; width:714px;"></ul>
			<span class="mostraendereco"><?php if(empty($_REQUEST['talao'])){echo $linha['endereco'];};?></span>
			<span class="os1">OS Nº</span>
			<span class="mostraos"><strong><?php if(empty($_REQUEST['talao'])){echo $linha['ordemServico'];};?></strong></span>
			<span class="fon">Fone:________________________</span>
			<span class="mostrafone"><?php if(empty($_REQUEST['talao'])){echo $linha['telefone'];};?></span>
			<span class="apa">Aparelho:</span>
			<ul style="border-top: 1px darkblue solid; margin-top: 28px; margin-left:-460px; width:390px;"></ul>
			<span class="defei">Defeito:</span>
			<ul style="border-top: 1px darkblue solid; margin-top: -13px; margin-left:545px; width:416px;"></ul>
			<span class="mostraapa"><?php if(empty($_REQUEST['talao'])){if($linha['aparelho']<>"ESCOLHA"){ ; echo $linha['aparelho'].'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';};if($linha['marca']<>"ESCOLHA"){ ;echo " Marca :".$linha['marca'].'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';};if($linha['modelo']<>""){ ;echo " Modelo :".$linha['modelo'];};};?></span>
			<span class="mostraobs"><?php if(empty($_REQUEST['talao'])){if($linha['observacao']<>""){ ; echo $linha['observacao'];};};?></span>	
			<span class="def">Obs.:</span>
			<span class="mostradef"><?php if(empty($_REQUEST['talao'])){if($linha['defeitoReclamado']<>""){ ; echo $linha['defeitoReclamado'];};};?></span>
			<ul style="border-top: 1px darkblue solid; margin-top: 29px; margin-left:37px; width:925px;"></ul>
			<span class="acess">Acessório:</span>
			<span class="mostraacess"><?php if(empty($_REQUEST['talao'])){if($linha['acessorio']<>""){ ; echo $linha['acessorio'];};};?></span>			
		</div>
		<div class="cabecario_dados_cadastro">
			<strong>
			<span class="qua">Quant.</span>
			<span class="dis">Discriminação dos serviços</span>
			<span class="uni">Unitário</span>
			<span class="tot">TOTAL</span>
				</strong>
		</div>
				<table class="tabela_discriminacao" border="1" style="border-collapse: collapse" cellpadding="2" cellspacing="0" >                              
				<?php for($i = 1; $i<=12; $i++){?>
				<tr>
					<td width="35px" height="25px"></td>
					<td width="500px"></td>
					<td width="80px"></td>
					<td width="80px"></td>
				</tr>
				<?php } ?>
			</table>
			<span class="total1">
				<?php echo "TOTAL :".'&nbsp&nbsp';if(empty($_REQUEST['talao'])){if($linha['orcamento']<>0){
				echo "R$".$linha['orcamento'].",00";};}?>
				</span>	
		<span class="material">
			<?php if(empty($_REQUEST['talao'])){if($linha['material']<>""){
				echo $linha['material'];};}?>
				</span>	
				<span class="valorPeca">
					<?php if(empty($_REQUEST['talao'])){if($linha['orcamento']<>0){
				echo "R$".$linha['valorPeca'].",00";};}?>
				</span>
				<span class="maodeobra">
					<?php if(empty($_REQUEST['talao'])){if($linha['orcamento']<>0){
				echo "R$".($linha['orcamento']-$linha['valorPeca']).",00";};}?>
				</span>
				<span class="mao1">Mão de obra do serviço prestado</span>
				<span class="cobrir_tabela1">Técnico responsável :&nbsp&nbsp
					<?php if(isset($linha['tecnico'])){
				if($linha['tecnico']<>"FIXO"){
				echo $linha['tecnico']; }else{				
				echo $resultado['usuario'];  	
					}
				}									
				?>				
				</span>		
		<div class="rodape_imprimir1">
			<center><?php echo $resultado['rodape']; ?></center>	
		</div>
	</div>
	<?php } ;echo"<script>window.print();</script>";?>		
	</div>
	</a> 
</body>
</html>