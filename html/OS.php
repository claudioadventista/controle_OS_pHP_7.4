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
		$codigo = $resultado['codigo'];
		if(isset($_REQUEST['codigo_cliente'])){
			$codigo = $_REQUEST['codigo_cliente'];}
		if(empty($_REQUEST['talao'])){ 
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
			.conteudo{
				font-family: Helvetica, Arial, sans-serif;
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
				width:500px;
				height:90px;
				top:10px;
				left:110px;
			}
			.telefone_imprimir{
				position:absolute;
				font-size: 20px;
				width:490px;
				height:25px;
				top:60px;
				left:95px;
			}
			.eletro{
				position:absolute;
				font-size: 25px;
				width:495px;
				height:30px;
				top:-5px;
				left:95px;
			}
			.eletro1{
				position:absolute;
				font-size: 25px;
				width:530px;
				height:30px;
				top:-5px;
				left:-5px;
			}
			.data_imprimir{
				position:absolute; 
				width:300px;
				height:93px;
				font-size:15px;
				top:3px;
				left:700px;
				border:1px solid;
				border-top-color: white;
				border-right-color: white;
				border-bottom-color: white;
				border-left-color: black;
			}
			.rodape_imprimir{
				position:absolute;
				font-size:12px;		   
				width:1010px;
				height:21px;
				top:250px;
				left:-1px;
				border:1px solid white;
				color:red;
				padding-top:5px;
			}	
			.hr{	
				width:1025px;
			}
			.pontilhado{
				position:absolute;		
				top:345px;
				left:1px;	
			}
			.pontilhado2{
				position:absolute;		
				top:690px;
				left:-1px;
			}
			.pontilhado1{
				position:absolute;		
				top:140px;
				left:-965px;
			}
			.rodape_imprimir1{
				position:absolute;
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
				font-size:12px;
				width:490px;
				height:20px;
				top:35px;
				left:97px;			
			}
			.dados_cadastro{
				position:absolute;
				font-size:12px;
				width:1010px;
				height:140px;
				top:102px;
				left:-1px;
				border:1px solid darkblue;			
			}
			.cabecario_dados_cadastro{
				position:absolute;
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
				height:20px;
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
				top:36px;
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
				top:125px;
				left:70px;		
			}
			.mostrar_dia_entrada{
				position:absolute;
				top:38px;
				left:135px;		
			}
			.mostrar_mes_entrada{
				position:absolute;
				top:38px;
				left:190px;		
			}
			.mostrar_ano_entrada{
				position:absolute;
				top:38px;
				left:240px;		
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
				top:599px;
				left:810px;
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
				top:573px;
				left:60px;
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
				top:75px;
				left:645px;
				width:300px;
				height:27px;
				padding-top:6px;
				padding-left:10px;
			}
			.cobrir_tabela1{
				position:absolute;
				top:568px;
				left:-1px;
				width:759px;
				height:27px;
				padding-top:6px;
				padding-left:10px;
				border:1px solid darkblue;
				background-color:white;
				text-align:left;
				font-size:15px;
			}
			.segunda_via{
				position:absolute;
				top:365px;
			}
			.assinatura{
				position:absolute;
				top:280px;
				left:250px;
			}
			.cliente{
				position:absolute;
				top:295px;
				left:880px;
			}
			.oficina{
				position:absolute;
				top:645px;
				left:880px;
			}
			.nome_tecnico{
				padding-left:60px;
			}
			a{
				color:darkblue;
			}
			.cod-barra{
				
				position:absolute; 
				letter-spacing: 12px ;
				left:20px ; 
				top:285px
			}
		</style>
	</head>		
	<body class="conteudo">
		<a href="../html/home.php">
			
				<!-- Imprimir 1 -->
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
						<span class="telefone_imprimir" style="color:red"><center>Fone : <?php echo $resultado['telefone'];if($resultado['telefone2']<>""){echo " & ".$resultado['telefone2'];} ?></center></span>
					</div>
					<div class="data_imprimir">
						<span style="font-size:20px"><strong><center>NOTA DE SERVIÇO</center></strong></span><br>
						<center>Data de Entrada _____/_______/______<br><br>
						<span class="mostrar_dia_entrada"><?php if(empty($_REQUEST['talao'])){echo $dia;} ?></span>
						<span class="mostrar_mes_entrada"><?php if(empty($_REQUEST['talao'])){echo $mes;} ?></span>
						<span class="mostrar_ano_entrada"><?php if(empty($_REQUEST['talao'])){echo $ano;} ?></span>
					</div>
					<span class="cobrir_tabela nome_tecnico">Técnico Responsável :&nbsp
						<span style="font-size:10px;"><?php 					
						echo strtoupper($resultado['usuario']); 				
						?></span>					
					</span>
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
					<span class="mostraapa"><?php if(empty($_REQUEST['talao'])){if($linha['aparelho']<>"ESCOLHA"){ ; echo resumo($linha['aparelho'],20).'&nbsp&nbsp&nbsp';};if($linha['marca']<>"ESCOLHA"){ ;echo " Marca :".resumo($linha['marca'],12).'&nbsp&nbsp&nbsp&nbsp';};};?></span>
					<span class="mostraobs"><?php if(empty($_REQUEST['talao'])){if($linha['observacao']<>""){ ; echo resumo($linha['observacao'],84);};};?></span>
					<span class="def">Obs.:</span>
					<span class="mostradef"><?php if(empty($_REQUEST['talao'])){if($linha['defeitoReclamado']<>""){ ; echo resumo($linha['defeitoReclamado'],39);};};?></span>
					<span class="acess">Acessório:</span>
					<span class="mostraacess"><?php if(empty($_REQUEST['talao'])){if($linha['acessorio']<>""){ ; echo resumo($linha['acessorio'],82);};};?></span>
				</div>
				<span class="cliente">Via do cliente</span>
					
				<div class="rodape_imprimir">
					<center><?php echo $resultado['rodape']; if(empty($_REQUEST['talao'])){?></center>
				</div>
				<!-- Imprimir 2 -->
				</div>
				<br>
				<span style="position:absolute; margin-left:960px ; margin-top:120px" >
				<!-- Codigo de barras -->
				<?php
				/*
				*****************************************************************************
				*	Rotina para gerar códigos de barra padrão 2of5 .
				*	Este script foi testado com o leitor de código de barras e esta OK.
				*	Basta chamar a função fbarcode("01202") com o valor
				*****************************************************************************
				*/			
				if($linha['barra_cliente']<>""){
				$valor = @$linha['barra_cliente'];	
				function fbarcode($valor){
					$fino = 2 ;
					$largo = 6 ;
					$altura = 40 ;
					$barcodes[0] = "00110" ;
					$barcodes[1] = "10001" ;
					$barcodes[2] = "01001" ;
					$barcodes[3] = "11000" ;
					$barcodes[4] = "00101" ;
					$barcodes[5] = "10100" ;
					$barcodes[6] = "01100" ;
					$barcodes[7] = "00011" ;
					$barcodes[8] = "10010" ;
					$barcodes[9] = "01010" ;
					for($f1=9;$f1>=0;$f1--){
						for($f2=9;$f2>=0;$f2--){
							$f = ($f1 * 10) + $f2 ;
							$texto = "" ;
							for($i=1;$i<6;$i++){
								$texto .=  substr($barcodes[$f1],($i-1),1) . substr($barcodes[$f2],($i-1),1);
							}
						$barcodes[$f] = $texto;
						}
				}
				//Desenho da barra
				//Guarda inicial
				?>
				<img src=p.gif width=<?=$fino?> height=<?=$altura?> border=0><img
				src=b.gif width=<?=$fino?> height=<?=$altura?> border=0><img
				src=p.gif width=<?=$fino?> height=<?=$altura?> border=0><img
				src=b.gif width=<?=$fino?> height=<?=$altura?> border=0><img
				<?php
				$texto = $valor ;
				if((strlen($texto) % 2) <> 0){
					$texto = "0" . $texto;
				}
				// Draw dos dados
				while (strlen($texto) > 0) {
				$i = round(esquerda($texto,2));
				$texto = direita($texto,strlen($texto)-2);
				$f = $barcodes[$i];
				for($i=1;$i<11;$i+=2){
					if (substr($f,($i-1),1) == "0") {
					$f1 = $fino ;
					}else{
					$f1 = $largo ;
					}
				?>
					src=p.gif width=<?=$f1?> height=<?=$altura?> border=0><img
				<?php
					if (substr($f,$i,1) == "0") {
					$f2 = $fino ;
					}else{
					$f2 = $largo ;
					}
				?>
					src=b.gif width=<?=$f2?> height=<?=$altura?> border=0><img
				<?php
				}
				}
				// Draw guarda final
				?>
				src=p.gif width=<?=$largo?> height=<?=$altura?> border=0><img
				src=b.gif width=<?=$fino?> height=<?=$altura?> border=0><img
				src=p.gif width=<?=1?> height=<?=$altura?> border=0>
				<?php
				} //Fim da fun��o
				function esquerda($entra,$comp){
					return substr($entra,0,$comp);
				}
				function direita($entra,$comp){
					return substr($entra,strlen($entra)-$comp,$comp);
				}
				if(empty($_REQUEST['codigo_cliente'])){
				// Impede que gravar um código já existente.
				$sqlbarra = $conexao->prepare("SELECT barra_cliente FROM cliente WHERE barra_cliente = ? ");
				$sqlbarra->execute([$valor]);
				$numTotalbarra = $sqlbarra->rowCount();	
				} 
				?>
				</span>
				<div class="assinatura">
						<p>Assinatura :_________________________________________________________________</p>
				</div>
				<span class="cod-barra"><?php fbarcode($valor); echo '<br><center>'.$valor;?></center></span>
				<?php }  } if($linha['barra_cliente']<>""){; ?>
					<span class="oficina">Via da oficina</span>
				<div class="hr pontilhado"> 
					<hr style="border:1px dashed;">
					
						<div class="col col-10">
							<span><?php echo "O.S. : ".$linha['ordemServico'].'<br>';
							if($linha['cpf'] != ""){
								echo "<span>Cpf : ".$linha['cpf']."</span><br>";
							};?>
							<span><?php echo "Nome : ".$linha['nome'];?></span><br>
							<?php 
							if(($linha['telefone'] != "")AND($linha['telefone2'] == "")){
								echo "<span>Telefone : ".$linha['telefone']."</span><br>";
							};
							if(($linha['telefone'] != "")AND($linha['telefone2'] != "")){
								echo "<span>Telefone 1 : ".$linha['telefone']."</span>";
								echo "<span> - Telefone 2 : ".$linha['telefone2']."</span><br>";
							};
							if($linha['endereco'] != ""){
								echo "<span>Endereço : ".$linha['endereco']."</span><br>";
							};
							?>				
							<span><?php echo "Aparelho : ".$linha['aparelho'];?></span><br>
							<span><?php echo "Marca : ".$linha['marca'];?></span><br>
							<?php
							if($linha['modelo'] != ""){
								echo "<span>Modelo : ".$linha['modelo']."</span><br>";
							};
							if($linha['numeroSerie'] != ""){
								echo "<span>Nº Série : ".$linha['numeroSerie']."</span><br>";
							};
							?>
							<span><?php echo "Defeito : ".$linha['defeitoReclamado'];?></span><br>
							<?php
							if($linha['acessorio'] != ""){
								echo "<span>Acessório : ".$linha['acessorio']."</span><br>";
							};
							if($linha['observacao'] != ""){
								echo "<span>Obs. : ".$linha['observacao']."</span><br>";
							};
							?>
							<span><?php echo "Cod. Barra : ".$linha['barra_cliente'];?></span><br>
							<span><?php  echo "Data de Entrada : " .implode("/", array_reverse(explode("-",$linha['dataEntrada'])));?></span><br>
							<span><?php echo "Técnico : "; if($linha['tecnico'] != ""){echo strtoupper($linha['tecnico']);}else{echo strtoupper($resultado['usuario']);};?></span><br>
						</div>
						</div>
				
				<div class="hr pontilhado2">
					<hr style="border:1px dashed;">
				</div>
					<?php }else{ ?>
					<div class="hr pontilhado1">
					<hr style="border:1px dashed;">
				</div>
				<?php }
					echo"<script>window.print();</script>"; ?>	
		
		</a>     
    </body>
</html>