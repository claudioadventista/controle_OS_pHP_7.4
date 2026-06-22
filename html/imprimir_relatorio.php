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
    <?php // A linha abaixo permite manter as configurações da sessão loggin    
        @session_start();
        if(empty($_SESSION['logado'])){
            header("Location:home.php");
            exit;   
        };
    ?>
    <style>
      html, body {
        top: 0;
        width:100vw;
        height: 100%;
        left: 0;
        margin: 0;
        padding: 0;
        font-family: Helvetica, Arial, sans-serif;
        z-index:10;
        font-size:12px;
      }
      table{
        line-height:20px;	
      }
      th{
        font-weight:normal;
      }
      a{
        text-decoration:none;
        color:#000;
      }
    </style>
  </head>
  <body>
    <a href="relatorio.php">
      <br>
      <h3><center>RELATÓRIO DE CADASTRO</center></h3>
      <?php
        require_once '../php/conexao.php';
        require_once '../php/funcoes_php.php';
        $data1=$_GET['data1'];
        $data2=$_GET['data2'];
        echo "Entre o dia ".date('d/m/Y',strtotime($data1))." e ".date('d/m/Y',strtotime($data2)).'<br>';
        echo "Saíram &nbsp&nbsp".$_GET['aparelho']." aparelhos".'<br>';
        echo "Total de Orçamento &nbsp&nbsp&nbsp&nbsp&nbspR$ ".number_format($_GET['orcamento'],2,',','.').'<br>';
        echo "Total de Peças &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspR$ ".number_format($_GET['peca'],2,',','.').'<br>';
        echo "Total de Peças Ret. &nbsp&nbsp&nbsp&nbsp&nbsp&nbspR$ ".number_format($_GET['pecaRet'],2,',','.').'<br>';
        echo "Total de Desconto &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspR$ ".number_format($_GET['desconto'],2,',','.').'<br>';
        echo "Total de Mat. Aux. &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspR$ ".number_format($_GET['materialAuxiliar'],2,',','.').'<br>';
        echo "Total de Transporte &nbsp&nbsp&nbsp&nbsp&nbsp&nbspR$ ".number_format($_GET['transporte'],2,',','.').'<br>';
        echo "Total de Lucro &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspR$ ".(number_format($_GET['orcamento']-$_GET['peca']-$_GET['desconto']-$_GET['materialAuxiliar']-$_GET['transporte'],2,',','.'));
        $nulo = '';
        $listaRelatorio = $conexao->prepare("SELECT * FROM cliente WHERE excluiu = ? AND estado='APARELHO SAIU' AND dataSaida BETWEEN(?) AND (?) ORDER BY $data1 ASC");    
        $listaRelatorio->execute([$nulo, $data1, $data2]);
      ?>
      <p></p>
      <table border="1" style="border-collapse: collapse; width:710px" cellpadding="2" cellspacing="0">                                 	
        <thead>
          <tr>
            <th style="width:50px" >OS</th>
            <th style="width:100px">Orc</th>
            <th style="width:100px">Peça</th>
            <th style="width:100px">Retorn.</th>
            <th style="width:100px">Desc</th>
            <th style="width:100px">Mat. Aux.</th>
            <th style="width:100px">Transp.</th>
            <th style="width:100px">Lucro</th>
            <th style="width:150px">Nome</th>
            <th style="width:50px">Entrada</th>
            <th style="width:50px">Saída</th>
          </tr>
        </thead> 
        <tbody>
          <tr>
            <?php
              $to=0;
              $t=0;
              $s=0;
              $v=0; 
              $d=0; 
              $ma=0;
              $transp=0;
              $totalOrcamento=0;
              $totalPeca=0;
              $totalDesconto=0;
              $totalMatAux=0;
              $totalTransporte=0;
              $totalPecaRet=0;
              $totalLucro=0;  		
              while($linha = $listaRelatorio->fetch(PDO::FETCH_ASSOC)) {
                $to=$to+1;
            ?>                              
            <td style="text-align:right;padding-right:2px;" >
              <?php 
                echo $linha['ordemServico']; 
              ?>
            </td>     
            <td style="text-align:left;padding-left:2px;">
              <?php
              echo "R$ ".number_format($linha['orcamento'],2,',','.'); 
              $s= $s+$linha['orcamento']; ?>
            </td>
            <td style="text-align:left;padding-left:2px;">       	
              <?php 
              echo "R$ ".number_format($linha['valorPeca'],2,',','.');
              $v= $v+$linha['valorPeca']; ?>
            </td>
            <td style="text-align:left;padding-left:2px;">       	
              <?php 
              echo "R$ ".number_format(($linha['pecaRet1']+$linha['pecaRet2']+$linha['pecaRet3']),2,',','.');
              $v= $v+$linha['valorPeca']; ?>
            </td>
            <td style="text-align:left;padding-left:2px;">       	
              <?php 
              echo "R$ ".number_format($linha['desconto'],2,',','.');
              $v= $v+$linha['valorPeca']; ?>
            </td>
            <td style="text-align:left;padding-left:2px;">       	
              <?php 
              echo "R$ ".number_format($linha['materialAuxiliar'],2,',','.');
              $v= $v+$linha['valorPeca']; ?>
            </td>
            <td style="text-align:left;padding-left:2px;">       	
              <?php 
              echo "R$ ".number_format($linha['transporte'],2,',','.');
              $v= $v+$linha['valorPeca']; ?>
            </td>
            <td style="text-align:left;padding-left:2px;">       	
              <?php 
              echo "R$ ".number_format(($linha['orcamento']-$linha['valorPeca']-$linha['desconto']-$linha['transporte']-$linha['materialAuxiliar']),2,',','.');
              $v= $v+$linha['valorPeca']; //}?>
            </td>  
            <td style="padding-left:2px">
              <?php echo "  ".resumo($linha['nome'],10);?> 
            <td style="padding-left:2px">
              <?php echo date('d/m/Y',strtotime($linha['dataEntrada'])); ?>
            </td>
            <td style="padding-left:2px">
              <?php echo date('d/m/Y',strtotime($linha['dataSaida'])); ?>
            </td>  		                                                    
          </tr>     
          <?php 
          $totalOrcamento = $totalOrcamento + $linha['orcamento'];
          $totalPeca = $totalPeca + $linha['valorPeca'];
          $totalPecaRet = $totalPecaRet + ($linha['pecaRet1']+$linha['pecaRet2']+$linha['pecaRet3']);
          $totalDesconto = $totalDesconto + $linha['desconto'];
          $totalMatAux = $totalMatAux + $linha['materialAuxiliar'];
          $totalTransporte = $totalTransporte + $linha['transporte'];
          $totalLucro = $totalLucro + ($linha['orcamento']-$linha['valorPeca']-$linha['desconto']-$linha['materialAuxiliar']-$linha['transporte']);
          }; ?>
          <tr>
            <td></td>
            <td>Orc</td>
            <td>Peça</td>
            <td>Retorn.</td>
            <td>Desc</td>
            <td>Mat.Aux.</td>
            <td>Transp.</td>
            <td>Lucro</td>
            <td></td>
          </tr>
          <tr>
            <td>Tot.</td>
            <td><?php echo number_format($totalOrcamento,2,',','.');?></td>
            <td><?php echo number_format($totalPeca,2,',','.');;?></span></td>
            <td><?php echo number_format($totalPecaRet,2,',','.');;?></span></td>
            <td><?php echo number_format($totalDesconto,2,',','.');;?></span></td>
            <td><?php echo number_format($totalMatAux,2,',','.');;?></span></td>
            <td><?php echo number_format($totalTransporte,2,',','.');;?></span></td>
            <td><?php echo number_format($totalLucro,2,',','.');;?></span></td>
            <td colspan="3"></td>  
          </tr> 
        </tbody>	 	
      </table>
    </a> 
    <?php echo"<script>window.print();</script>"; ?>
  </body>
</html>   