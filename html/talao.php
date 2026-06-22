<?php 
@session_start();
if(empty($_SESSION['logado'])){
	header("Location:home.php");
    exit;   
};
require_once '../php/consulta.php';
require_once '../php/funcoes_php.php';
 if(empty($_REQUEST['talao'])){
}  
$_REQUEST['talao'] = "talao";
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

 <title>Controle OS</title>
 <link rel="shortcut icon" href="../icon/favicon.ico" >
 <meta name="viewport" content="widhth=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=10,  minimum-scale=1.0" />
 <meta name="referrer" content="default" id="meta_referrer" />
 <meta http-equiv="cache-control" content="max-age=0" />
 <meta http-equiv="cache-control" content="no-cache" />
 <meta http-equiv="expires" content="0" />
 <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
 <meta http-equiv="pragma" content="no-cache" />
		<style>
			#conteudo2{
				font-family: Helvetica, Arial, sans-serif;
				position:absolute;
				width:1000px;
				height:630px;
				top:0;
				left:0;
				border:1px solid darkblue;
				color:darkblue;
				padding-left:10px;
			}
			#conteudo3{
				font-family: Helvetica, Arial, sans-serif;
				position:absolute;
				width:1000px;
				height:630px;
                top:700px;
				left:0;
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
				padding-top:6px;
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
				top:41px;			
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
				top:593px;
				left:-1px;
				width:759px;
				height:27px;
				padding-top:6px;
				padding-left:10px;
				border:1px solid darkblue;
				background-color:white;
			}
			.cobrir_tabela1{
				position:absolute;
				top:568px;
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
			<div id="conteudo2">
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
                        <span class="telefone_imprimir" style="color:red"><center>Fone &nbsp&nbsp<?php echo $resultado['telefone'];if($resultado['telefone2']<>""){echo "&nbsp&nbsp&nbsp".$resultado['telefone2'];} ?></center></span></center></span>
                    </div>	
                    <div class="data_imprimir">
                        <span style="font-size:20px"><strong><center>NOTA DE SERVIÇO</center></strong></span><br>
                        <center>Data de Entrada _____/_______/______<br><br>
                        <span class="mostrar_dia_entrada"></span>
                        <span class="mostrar_mes_entrada"></span>
                        <span class="mostrar_ano_entrada"></span>
                        Data de Saida&nbsp&nbsp&nbsp _____/_______/______</center>
                        <span class="mostrar_dia_saida"></span>
                        <span class="mostrar_mes_saida"></span>
                        <span class="mostrar_ano_saida"></span>
                    </div>	
			    </div>
                <div class="dados_cadastro">
                    <span class="cli">Cliente:</span>
                    <ul style="border-top: 1px darkblue solid; margin-top: 26px; margin-left:50px; width:710px;"></ul>
                    <span class="mostranome"></span>
                    <span class="ende">End.:</span>
                    <ul style="border-top: 1px darkblue solid; margin-top: 26px; margin-left:37px; width:724px;"></ul>
                    <span class="mostraendereco"></span>
                    <span class="os1">OS Nº:</span>
                    <span class="mostraos"><strong></strong></span>
                    <span class="fon">Fone:________________________</span>
                    <span class="mostrafone"></span>
                    <span class="apa">Aparelho:</span>
                    <ul style="border-top: 1px darkblue solid; margin-top: 26px; margin-left:60px; width:390px;"></ul>
                    <span class="defei">Defeito:</span>
                    <ul style="border-top: 1px darkblue solid; margin-top: -13px; margin-left:545px; width:416px;"></ul>
                    <span class="mostraobs"></span>	
                    <span class="def">Marca / Modelo:</span>
                    <span class="mostradef"></span>
                    <ul style="border-top: 1px darkblue solid; margin-top: 29px; margin-left:95px; width:866px;"></ul>
                    <span class="acess">Acessório / Obs.:</span>
                    <span class="mostraacess"></span>		
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
					TOTAL :
				</span>	
			    <span class="material">
				</span>	
				<span class="valorPeca">
						R$
				</span>
				<span class="maodeobra">
						R$
				</span>
				<span class="mao1">Mão de obra do serviço prestado</span>
				<span class="cobrir_tabela1">Técnico responsável :&nbsp&nbsp<?php if($resultado['escolha'] = 'sim'){echo $resultado['usuario'];};?>
				</span>		
                <div class="rodape_imprimir1">
                    <center><?php echo $resultado['rodape']; ?></center>	
                </div>
		    </div>
            <div style="margin-top:640px;">
                <hr style="border:1px dashed;">
            </div>
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
						<span class="telefone_imprimir" style="color:red"><center>Fone &nbsp&nbsp<?php echo $resultado['telefone'];if($resultado['telefone2']<>""){echo "&nbsp&nbsp&nbsp".$resultado['telefone2'];} ?></center></span></center></span>
                    </div>	
                    <div class="data_imprimir">
                        <span style="font-size:20px"><strong><center>NOTA DE SERVIÇO</center></strong></span><br>
                        <center>Data de Entrada _____/_______/______<br><br>
                        <span class="mostrar_dia_entrada"></span>
                        <span class="mostrar_mes_entrada"></span>
                        <span class="mostrar_ano_entrada"></span>
                        Data de Saida&nbsp&nbsp&nbsp _____/_______/______</center>
                        <span class="mostrar_dia_saida"></span>
                        <span class="mostrar_mes_saida"></span>
                        <span class="mostrar_ano_saida"></span>
                    </div>	
			    </div>
                <div class="dados_cadastro">
                    <span class="cli">Cliente:</span>
                    <ul style="border-top: 1px darkblue solid; margin-top: 26px; margin-left:50px; width:710px;"></ul>
                    <span class="mostranome"></span>
                    <span class="ende">End.:</span>
                    <ul style="border-top: 1px darkblue solid; margin-top: 26px; margin-left:37px; width:724px;"></ul>
                    <span class="mostraendereco"></span>
                    <span class="os1">OS Nº:</span>
                    <span class="mostraos"><strong></strong></span>
                    <span class="fon">Fone:________________________</span>
                    <span class="mostrafone"></span>
                    <span class="apa">Aparelho:</span>
                    <ul style="border-top: 1px darkblue solid; margin-top: 26px; margin-left:60px; width:390px;"></ul>
                    <span class="defei">Defeito:</span>
                    <ul style="border-top: 1px darkblue solid; margin-top: -13px; margin-left:545px; width:416px;"></ul>
                    <span class="mostraobs"></span>	
                    <span class="def">Marca / Modelo:</span>
                    <span class="mostradef"></span>
                    <ul style="border-top: 1px darkblue solid; margin-top: 29px; margin-left:95px; width:866px;"></ul>
                    <span class="acess">Acessório / Obs.:</span>
                    <span class="mostraacess"></span>		
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
					TOTAL :
				</span>	
			    <span class="material">
				</span>	
				<span class="valorPeca">
						R$
				</span>
				<span class="maodeobra">
						R$
				</span>
				<span class="mao1">Mão de obra do serviço prestado</span>
				<span class="cobrir_tabela1">Técnico responsável :&nbsp&nbsp<?php if($resultado['escolha'] = 'sim'){echo $resultado['usuario'];};?>
				</span>		
                <div class="rodape_imprimir1">
                    <center><?php echo $resultado['rodape']; ?></center>	
                </div>
		    </div>
            <div style="margin-top:695px;">
                <hr style="border:1px dashed;">
            </div>
		    <?php  ;echo"<script>window.print();</script>";?>		
		</a> 
    </body>
</html>