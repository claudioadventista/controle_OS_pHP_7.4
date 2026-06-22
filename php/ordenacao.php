<?php 
  require_once '../php/consulta.php';
   $codigo=$result_func['codigo'];
   if(isset($_REQUEST['busca'])){
   	$letra = $_REQUEST['pesquisa']; 
   	$ordenacao ="nome"; $ordem = 
   	$result_func['ordem']; 
   } 
   if(isset($_GET['nome'])){
    if($_GET['nome']==0){$letra = "LISTA GERAL"; $ordenacao ="ordemServico"; $ordem = $result_func['ordem'];  } 
    if($_GET['nome']==1){$letra = "PARA ORCAMENTO"; $ordenacao ="ordemServico"; $ordem = $result_func['ordem'];  }
    if($_GET['nome']==2){$letra = "ORCAMENTO PRONTO"; $ordenacao ="nome"; $ordem = $result_func['ordem'];  }
    if($_GET['nome']==3){$letra = "AGUARDANDO"; $ordenacao ="ordemServico"; $ordem = $result_func['ordem'];  }
    if($_GET['nome']==4){$letra = "SERVICO PRONTO"; $ordenacao ="ordemServico"; $ordem = $result_func['ordem']; }
    if($_GET['nome']==5){$letra = "APARELHO SAIU"; $ordenacao ="ordemServico"; $ordem = $result_func['ordem'];  }
    if($_GET['nome']==6){$letra = "RETORNOU"; $ordenacao ="ordemServico"; $ordem = $result_func['ordem'];  }
    if($_GET['nome']==7){$letra = "DEVOLVEU"; $ordenacao ="ordemServico"; $ordem = $result_func['ordem'];  }
    if($_GET['nome']==8){$letra = "DOOU"; $ordenacao ="ordemServico"; $ordem = $result_func['ordem'];  }
    if($_GET['nome']==9){$letra = "COMPROU"; $ordenacao ="ordemServico"; $ordem = $result_func['ordem'];  }
    if($_GET['nome']==11){$letra = "VENDEU"; $ordenacao ="ordemServico"; $ordem = $result_func['ordem'];  }
    if($_GET['nome']==12){$letra = "ABANDONOU"; $ordenacao ="ordemServico"; $ordem = $result_func['ordem'];  }
    if($_GET['nome']==13){$letra = "SUMIU"; $ordenacao ="ordemServico"; $ordem = $result_func['ordem'];  }
    if($_GET['nome']==14){$letra = "ENTREGOU ERRADO"; $ordenacao ="ordemServico"; $ordem = $result_func['ordem'];  }
    if($_GET['nome']==15){$letra = "ROUBADO"; $ordenacao ="ordemServico"; $ordem = $result_func['ordem'];  }
    if($_GET['nome']==17){$letra = "DICA"; $ordenacao ="ordemServico"; $ordem = $result_func['ordem'];  }
    if($_GET['nome']==18){$letra = "LIGOU"; $ordenacao ="ordemServico"; $ordem = $result_func['ordem'];  }
    if($_GET['nome']==16){$letra = "PRAZO"; $ordenacao ="ordemServico"; $ordem = $result_func['ordem'];  }
    if($_GET['nome']==10){$letra = "FOTOS"; $ordenacao ="ordemServico"; $ordem = $result_func['ordem'];  }
    header('Location: ../html/home.php');
   }
   // ***************************** ORDENAÇÃO ***************************** //
   // por código
   if(isset($_GET['codigo'])) { $letra = $result_func['letra']; $ordenacao ="codigo"; if($result_func['ordem']=="ASC"){ $ordem ="DESC"; } else { $ordem ="ASC"; }  }
   // por O.S.  
   if(isset($_GET['os'])) {$letra = $result_func['letra']; $ordenacao ="ordemServico"; if($result_func['ordem']=="ASC"){ $ordem ="DESC"; } else { $ordem ="ASC"; }  }
   // por NOME 
   if(isset($_GET['nomes'])) { $letra = $result_func['letra']; $ordenacao ="nome"; if($result_func['ordem']=="ASC"){ $ordem ="DESC"; } else { $ordem ="ASC"; }  }
   if(isset($_GET['aparelhos'])) { $letra = $result_func['letra']; $ordenacao ="aparelho"; if($result_func['ordem']=="ASC"){ $ordem ="DESC"; } else { $ordem ="ASC"; }  }
   if(isset($_GET['marcas'])) { $letra = $result_func['letra']; $ordenacao ="marca"; if($result_func['ordem']=="ASC"){ $ordem ="DESC"; } else { $ordem ="ASC"; }  }
   if(isset($_GET['dtPgto'])) { $letra = $result_func['letra']; $ordenacao ="dataPagamento"; if($result_func['ordem']=="ASC"){ $ordem ="DESC"; } else { $ordem ="ASC"; }  }
   // *** FIM ORDENAÇÃO **** //
  
	$sql = "UPDATE funcionario SET letra = ?, ordem = ?, ordenacao = ? WHERE codigo = ? "; 
	$stmt = $conexao->prepare($sql);
	$stmt->execute([$letra, $ordem, $ordenacao, $codigo]);
   //print_r($_REQUEST); exit;

  
   header('Location: ../html/home.php');
?>