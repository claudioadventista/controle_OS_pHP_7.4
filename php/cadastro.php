<?php	
@session_start();
// só entra nessa página se estiver logado 
 if(empty($_SESSION['logado'])) {
 	$_SESSION["informacao"]="Operação não premitida!";
 	header('Location:../html/home.php');
 exit;
}
// necessário para pegar o horário atual de são paulo
date_default_timezone_set('America/Fortaleza');
require_once '../php/funcoes_php.php';
require_once '../php/consulta.php';
/****************************************************************************************
  
                             incluir novo cadastro                                         
 
 ****************************************************************************************/	
// condição para entrar aqui e realizar um novo cadastro		
if(empty($_POST['codigo'])) {	 
   if((empty($_POST['aparelho']))AND(empty($_POST['novoAparelho']))AND(empty($_POST['marca']))AND(empty($_POST['novaMarca']))){
   	$_SESSION["informacao"]="Campos aparelhos e marca em branco!";	
    header('Location:../html/home.php');
 	exit;
   }
   // Salva no banco com acento
   $ordemServico     = $_POST['ordemServico2'];
   if($_SESSION['maiuscula']=="sim"){
	   $nome             = tirarAcentos($_POST['nome']);
	   $endereco         = tirarAcentos($_POST['endereco']);
	   $defeitoReclamado = tirarAcentos($_POST['defeitoReclamado']);
	   $acessorio        = tirarAcentos($_POST['acessorio']);
	   $observacao       = tirarAcentos($_POST['observacao']);
	   $material         = tirarAcentos($_POST['material']);
	   $modelo           = tirarAcentos($_POST['modelo']);
   }else if($resultado['sem_acento']<>0){
	   $nome             = eliminaAcentos($_POST['nome']);
	   $endereco         = eliminaAcentos($_POST['endereco']);
	   $defeitoReclamado = eliminaAcentos($_POST['defeitoReclamado']);
	   $acessorio        = eliminaAcentos($_POST['acessorio']);
	   $observacao       = eliminaAcentos($_POST['observacao']);
	   $material         = eliminaAcentos($_POST['material']);
	   $modelo           = eliminaAcentos($_POST['modelo']);
     }else{
	   $nome             = $_POST['nome'];
	   $endereco         = $_POST['endereco'];
	   $defeitoReclamado = $_POST['defeitoReclamado'];
	   $acessorio        = $_POST['acessorio'];
	   $observacao       = $_POST['observacao'];
	   $material         = $_POST['material'];
   }
   $nome             = retiraEspaco($nome);   
   $endereco         = retiraEspaco($endereco); 
   $email            = retiraTodosEspacos(menuscula($_POST['email']));   
   $defeitoReclamado = ucfirst(retiraEspaco($defeitoReclamado));
   $acessorio        = ucfirst(retiraEspaco($acessorio));   
   $observacao       = ucfirst(retiraEspaco($observacao));   
   $material         = ucfirst(retiraEspaco($material));   
   $estado           = $_POST['estado'];
   $telefone         = $_POST['telefone'];
   $telefone2        = $_POST['telefone2'];
   // impede cadastrar o primeiro telefone com telefone 2 
   if (($_POST['telefone']=="")AND($_POST['telefone2']<>"")){
   	$telefone  = $_POST['telefone2'];
    $telefone2 = "";
   }
   	// data de entrada automático
   	if(empty($_POST['dataEntrada'])){
		$dataEntrada = date("Y-m-d\TH:i");// pega a hora e os minutos
	}else{
		$dataEntrada = $_POST['dataEntrada'];
	};

   //$dataEntrada      = $_POST['dataEntrada'];
   $dtNascimentoAlt  = $_POST['dtNascimentoAlt'];
   $controle_entrada = date("Y-m-d H:i:s");// pega a hora, os minutos e os segundos
   $aparelho         = $_POST['aparelho'];
   $inicial          = limpaValor($_POST['inicial']);
   $restante         = limpaValor($_POST['restante']);
   $dataPagamento    = $_POST['dataPagamento'];
 	if(empty($_POST['aparelho'])){
		if(empty($_POST['novoAparelho'])){
			$_SESSION["informacao"]="Campo aparelho é obrigatório!";
			header('location: ../html/home.php');
			exit;
		}else if(trim($_POST['novoAparelho'])==""){
			$_SESSION["informacao"]="Campo novo aparelho em branco!";
			header('location: ../html/home.php');
			exit;
		}else{
			$novoAparelho = trim($_POST['novoAparelho']);
		
			// Identifica se o aparelho ja é cadastrado
			$listaaparelho = $conexao->prepare("SELECT * FROM aparelho WHERE aparelho = ? ");
			$listaaparelho->execute([$novoAparelho]);
			$resultadoap = $listaaparelho->rowCount();
			
			// Se não for encontrado nenhum aparelho com o nome que foi enviado...
			$aparelho = tirarAcentos($_POST['novoAparelho']);
			if ($resultadoap == 0) {
				
				$sql = "INSERT INTO aparelho (aparelho) VALUES (?)";
				$stmt = $conexao->prepare($sql);
				$stmt->execute([$aparelho]);

			}
	 	}
     }
   $marca = $_POST['marca'];
    if(empty($_POST['marca'])){
		if(empty($_POST['novaMarca'])){
		 	$_SESSION["informacao"]="Campo marca é obrigatório!";
			header('Location:../html/home.php');
			exit;
		}else if(trim($_POST['novaMarca'])==""){
			$_SESSION["informacao"]="Campo nova marca em branco!";
			header('location: ../html/home.php');
			exit;
	    }else{
		    $novaMarca = trim($_POST['novaMarca']);
			// Identifica se a narca ja é cadastrada

			$listamarca = $conexao->prepare("SELECT * FROM marca WHERE marca = ? ");
			$listamarca->execute([$novaMarca]);
			$resultadoma = $listamarca->rowCount();
			// Se não for encontrado nenhum aparelho com o nome que foi enviado...
			$marca = tirarAcentos($_POST['novaMarca']);
			if ($resultadoma == 0) {
				
				$sql = "INSERT INTO marca (marca) VALUES (?)";
				$stmt = $conexao->prepare($sql);
				$stmt->execute([$marca]);
			}
		}
    }
	$modelo = $_POST['modelo'];
    if((empty($_POST['modelo']))AND(trim($_POST['novoModelo'])<>"")){
		     	$novoModelo = $_POST['novoModelo'];
				// Identifica se o aparelho ja é cadastrado
				
				$listamodelo = $conexao->prepare("SELECT * FROM modelo WHERE modelo = ? ");
				$listamodelo->execute([$novoModelo]);
				$resultadomo = $listamodelo->rowCount();
				// Se não for encontrado nenhum aparelho com o nome que foi enviado...
				$modelo = tirarAcentos($_POST['novoModelo']);
				if ($resultadomo == 0) {
					
					$sql = "INSERT INTO modelo (modelo) VALUES (?)";
					$stmt = $conexao->prepare($sql);
					$stmt->execute([$modelo]);
				}
		 	}
	// cadastra ou não uma imagem
	if($_FILES['foto1']['name']<>""){
		$foto1 = md5(microtime()).'.jpg';
		$foto_name1 = $_FILES['foto1']['tmp_name'];
		move_uploaded_file($foto_name1,"../imagem_cliente/$foto1");	
	 }else{
	 	$foto1 = "";
	 };
	 if($_FILES['foto2']['name']<>""){
		$foto2 = md5(microtime()) . '.jpg';
		$foto_name2 = $_FILES['foto2']['tmp_name'];
		move_uploaded_file($foto_name2,"../imagem_cliente/$foto2");		
	 }else{
	 	$foto2 = "";
	 };
	 if($_FILES['foto3']['name']<>""){
		$foto3 = md5(microtime()) . '.jpg';
		$foto_name3 = $_FILES['foto3']['tmp_name'];
		move_uploaded_file($foto_name3,"../imagem_cliente/$foto3");	
	 }else{
	 	$foto3 = "";
	 };
	   if((isset($_POST['placaNormal']))AND($_POST['placaNormal']<>"")){
			$placa = tirarAcentos($_POST['placaNormal']);
	   }else if((isset($_POST['placaMercosul']))AND($_POST['placaMercosul']<>"")){
			$placa = tirarAcentos($_POST['placaMercosul']);
	   }else{
		$placa = "";
	   };
	   $numeroSerie      = tirarAcentos($_POST['numeroSerie']);
	   $bandeira_cartao  = tirarAcentos($_POST['bandeira_cartao']);
	   $chassi           = tirarAcentos($_POST['chassi']);
	   $imei          	 = $_POST['imei'];
	   $placaMercosul    = tirarAcentos($_POST['placaMercosul']);
	   $renavam 		 = $_POST['renavam'];
	   //$tecnico          = $_POST['tecnico'];
	   //if($_SESSION['nivel']=="tecnico"){
			//$tecnico = $_SESSION['logado'];
	   //}
	   $orcamento        = limpaValor($_POST['orcamento']);
	   // $valorObjeto vai ser setado no banco no campo infoCliente
	   $valorObjeto      = limpaValor($_POST['valorObjeto']);
	   $desconto         = limpaValor($_POST['desconto']);
	   $materialAuxiliar = limpaValor($_POST['materialAuxiliar']);
	   $transporte       = limpaValor($_POST['transporte']);
	   if (isset($_POST['aPrazo'])) {
			$aPrazo = "sim";	
		}else{
			$aPrazo = "";	
		};
    	if (isset($_POST['pagou'])) {
			$pagou 	="sim";
			if(empty($_POST['dataPagou'])){
				$dataPagou = $dataPagamento;	
			}else{
				$dataPagou = $_POST['dataPagou'];
			};
		}else{
				$pagou 		="";
				$dataPagou  = "";	
				
		};
	    if (isset($_POST['cartao'])) {
			$cartao ="sim";
			$tipoCartao     = $_POST['escolhaCartao'];
			$parcelasCartao = $_POST['parcelasCartao'];
			
			if($parcelasCartao==0){
				$parcelasCartao =1;
			};
			if($restante   = ""){
				$restante  = limpaValor($_POST['orcamento']);
			}else{
				$restante  = limpaValor($_POST['restante']);
			}
			$jurosCartao   = limpaValor($_POST['jurosCartao']);	
			$inicial       = limpaValor($_POST['inicial']);
			$dataPagamento = $_POST['dataPagamento'];
		}else{
				$cartao         = "";
				$tipoCartao	    = "";
				$parcelasCartao = 0;
				$jurosCartao    = 0;
		};
	   // Seta data de pronto automaticamente
	if((($_POST['estado']=="SERVICO PRONTO")OR($_POST['estado']=="SERVIÇO PRONTO")OR($_POST['estado']=="APARELHO SAIU")OR($_POST['estado']=="DEVOLVEU")OR($_POST['estado']=="DOOU")OR($_POST['estado']=="COMPROU"))AND(empty($_POST['dataPronto']))){
			$dataPronto = date("Y-m-d\TH:i");// pega a hora e os minutos
	
	}else{
			$dataPronto = $_POST['dataPronto'];
	}
		// Seta data de saida automaticamente
	if((($_POST['estado']=="APARELHO SAIU")OR($_POST['estado']=="DEVOLVEU")OR($_POST['estado']=="DOOU")OR($_POST['estado']=="COMPROU"))AND(empty($_POST['dataSaida']))){
			$dataSaida = date("Y-m-d\TH:i");
	} else{
			$dataSaida = $_POST['dataSaida'];
	}
	$valorPeca = limpaValor($_POST['valorPeca']);
	// Gera 10 numeros aleatórios de 0 a 9, e coloca numa array 
	geraBarra:
	$array = rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
	$barra = $array;
	// verifica se o código de barras gerado já foi cadastrado
	$codigoBarra = $conexao->prepare("SELECT barra_cliente FROM cliente WHERE barra_cliente = ? ");
	$codigoBarra->execute([$barra]);
	$contaBarra = $codigoBarra->rowCount();
	if ($contaBarra <> 0) {
		goto geraBarra;
		exit;
	}; 
	$cpf              = retMascara($_POST['cpf']);

	
	$sql = "INSERT INTO cliente (ordemServico, nome, endereco, email, telefone, telefone2, 
	dataEntrada, dtNascimentoAlt, controle_entrada, aparelho, marca, modelo, numeroSerie, chassi, imei, placa, renavam, defeitoReclamado, 
	acessorio, observacao, estado, material, orcamento, infoCliente, desconto, materialAuxiliar, transporte, inicial, restante, dataPagamento, pagou, cartao, tipoCartao, parcelasCartao, jurosCartao, dataPronto, dataSaida, 
	valorPeca, barra_cliente, cpf, foto1, foto2, foto3, dataPagou, aPrazo, bandeira_cartao) 
	VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	$stmt = $conexao->prepare($sql);
	$stmt->execute([$ordemServico,$nome,$endereco,$email,$telefone,$telefone2,$dataEntrada,$dtNascimentoAlt,
	$controle_entrada,$aparelho,$marca,$modelo,$numeroSerie,$chassi,$imei,$placa,$renavam,$defeitoReclamado,
	$acessorio,$observacao,$estado,$material,$orcamento,$valorObjeto,$desconto,$materialAuxiliar,$transporte,$inicial,$restante,$dataPagamento,$pagou,$cartao,$tipoCartao,$parcelasCartao,$jurosCartao,$dataPronto,
	$dataSaida,$valorPeca,$barra,$cpf,$foto1,$foto2,$foto3,$dataPagou,$aPrazo,$bandeira_cartao]);
	   
	// completa com zeros a esquerda no banco ex 0002
	if ($resultado['zeros'] ==''){
		$cont_os = str_pad($resultado['cont_os']+1,5,'0',STR_PAD_LEFT);
	}else{
		$cont_os = $resultado['cont_os']+1;
	}
		
	$codigo  = $resultado['codigo'];
	$sqla = "UPDATE config SET cont_os = ? WHERE codigo = ? "; 
	$stmt = $conexao->prepare($sqla);
	$stmt->execute([$cont_os, $codigo]);
	  
	// verifica se foi mandado salvar e imprimir na O.S. ou no talao
	if((isset($_POST['salvar_imprimir'])) OR (isset($_POST['salvar_imprimir_os']))){
		$ordem = $_POST['ordemServico2'];
		$nome  = $_POST['nome'];

		$sql = $conexao->prepare("SELECT codigo FROM cliente WHERE ordemServico = ? AND nome = ? ");
		$sql->execute([$ordem, $nome]);	
		$linha = $sql->fetch();
		$codigo = $linha['codigo'];

		if(isset($_POST['salvar_imprimir'])){
			header('Location:../html/tabela_impressao.php?codigo_cliente='.$codigo);
			exit;
		}
		if(isset($_POST['salvar_imprimir_os'])){
			header('Location:../html/OS.php?codigo_cliente='.$codigo);
			exit;
		}
	}
	
	$_SESSION["informacao"]="O cadastro foi feito com sucesso!";
	header('Location:backup.php');
 	exit; 
}// Fim de Incluir novo cadastro //
/****************************************************************************************
  
                             alterar um cadastro                                         
 
 ****************************************************************************************/
// condição para entrar aqui e alterar o cadastro
if((isset($_POST['codigo']))AND($_POST['codigo']<>"")){

	$codigo = $_POST['codigo'];
	if(($_FILES['foto1']['name']<>"")OR($_FILES['foto2']['name']<>"")OR($_FILES['foto3']['name']<>"")){

		$sqlImagem = $conexao->prepare("SELECT foto1, foto2, foto3 FROM cliente WHERE codigo = ? ");
		$sqlImagem->execute([$codigo]);
		$linhaImagem = $sqlImagem->fetch();
		
		if($_FILES['foto1']['name']<>""){
			if($linhaImagem['foto1']<>""){
				$foto1 = $linhaImagem['foto1'];
	 		}else{
	 			$foto1 = md5(microtime()).'.jpg';
	 		};

   			$sql = "UPDATE cliente SET foto1 = ? WHERE codigo = ?";   
			$stmt = $conexao->prepare($sql);
			$stmt->execute([$foto1, $codigo]);
				
			$foto_name1=$_FILES['foto1']['tmp_name'];
			move_uploaded_file($foto_name1,"../imagem_cliente/$foto1");	
		}

		if($_FILES['foto2']['name']<>""){
			if($linhaImagem['foto2']<>""){
				$foto2 = $linhaImagem['foto2'];
	 		}else{
	 			$foto2 = md5(microtime()).'.jpg';
	 		}

			$sql = "UPDATE cliente SET foto2 = ? WHERE codigo = ?";   
			$stmt = $conexao->prepare($sql);
			$stmt->execute([$foto2, $codigo]);

			$foto_name2=$_FILES['foto2']['tmp_name'];
			move_uploaded_file($foto_name2,"../imagem_cliente/$foto2");	
		}

		if($_FILES['foto3']['name']<>""){
			if($linhaImagem['foto3']<>""){
				$foto3 = $linhaImagem['foto3'];
	 		}else{
	 			$foto3 = md5(microtime()).'.jpg';
	 		}	

			$sql = "UPDATE cliente SET foto3 = ? WHERE codigo = ?";   
			$stmt = $conexao->prepare($sql);
			$stmt->execute([$foto3, $codigo]);	

			$foto_name3=$_FILES['foto3']['tmp_name'];
			move_uploaded_file($foto_name3,"../imagem_cliente/$foto3");	
		}
	}

   	   // Salva no banco com acento
   	   $ordemServico     = $_POST['ordemServico2']; 
    if($_SESSION['maiuscula']=="sim"){
	   $nome             = tirarAcentos($_POST['nome']);
	   $endereco         = tirarAcentos($_POST['endereco']);
	   $defeitoReclamado = tirarAcentos($_POST['defeitoReclamado']);
	   $acessorio        = tirarAcentos($_POST['acessorio']);
	   $observacao       = tirarAcentos($_POST['observacao']);
	   $material         = tirarAcentos($_POST['material']);	
	 }else if($resultado['sem_acento']<>0){
	   $nome             = eliminaAcentos($_POST['nome']);
	   $endereco         = eliminaAcentos($_POST['endereco']);
	   $defeitoReclamado = eliminaAcentos($_POST['defeitoReclamado']);
	   $acessorio        = eliminaAcentos($_POST['acessorio']);
	   $observacao       = eliminaAcentos($_POST['observacao']);
	   $material         = eliminaAcentos($_POST['material']);
     }else{
	   $nome             = $_POST['nome'];
	   $endereco         = $_POST['endereco'];
	   $defeitoReclamado = $_POST['defeitoReclamado'];
	   $acessorio        = $_POST['acessorio'];
	   $observacao       = $_POST['observacao'];
	   $material         = $_POST['material'];
	}
	$bandeira_cartao  = tirarAcentos($_POST['bandeira_cartao']);
	$nome             = retiraEspaco($nome);   
   	$endereco         = retiraEspaco($endereco);
    $email            = retiraTodosEspacos(menuscula($_POST['email']));    
   	$defeitoReclamado = ucfirst(retiraEspaco($defeitoReclamado));   
   	$acessorio        = ucfirst(retiraEspaco($acessorio));   
   	$observacao       = ucfirst(retiraEspaco($observacao));   
 	$material         = ucfirst(retiraEspaco($material));   
   $telefone          = $_POST['telefone'];
   $telefone2         = $_POST['telefone2'];
    // impede cadastrar o primeiro telefone com telefone 2 
   if (($_POST['telefone']=="")AND($_POST['telefone2']<>"")){
   	$telefone        = $_POST['telefone2'];
    $telefone2       = "";
   }
   // data de entrada automático
   	if(empty($_POST['dataEntrada'])){
		$dataEntrada = date("Y-m-d\TH:i");// pega a hora e os minutos
	}else{
		$dataEntrada = $_POST['dataEntrada'];
	};
   $dtNascimentoAlt  = $_POST['dtNascimentoAlt'];
   $aparelho         = $_POST['aparelho'];
   $marca            = $_POST['marca'];
   $modelo           = tirarAcentos($_POST['modelo']);
   $numeroSerie      = $_POST['numeroSerie'];
   $chassi           = $_POST['chassi'];
   $imei          	 = $_POST['imei'];
	if((isset($_POST['placaNormal']))AND($_POST['placaNormal']<>"")){
		$placa = tirarAcentos($_POST['placaNormal']);
	}else if((isset($_POST['placaMercosul']))AND($_POST['placaMercosul']<>"")){
		$placa = tirarAcentos($_POST['placaMercosul']);
	}else{
		$placa = "";
	};
   	$renavam = $_POST['renavam'];
   	$estado  = $_POST['estado'];
	
   $orcamento        = limpaValor($_POST['orcamento']);
   // $valorObjeto vai ser setado no banco no campo infoCliente
   $valorObjeto      = limpaValor($_POST['valorObjeto']);
   $desconto         = limpaValor($_POST['desconto']);
   $materialAuxiliar = limpaValor($_POST['materialAuxiliar']);
   $transporte       = limpaValor($_POST['transporte']);
   $inicial       	 = limpaValor($_POST['inicial']);
   $restante         = limpaValor($_POST['restante']);
   $dataPagamento    = $_POST['dataPagamento'];
   if (isset($_POST['aPrazo'])) {
		$aPrazo = "sim";	
   }else{
		$aPrazo = "";	
   };
    if ((isset($_POST['excluir-foto1']))OR(isset($_POST['excluir-foto2']))OR(isset($_POST['excluir-foto3']))) {
    	
		$sqlfoto = $conexao->prepare("SELECT foto1, foto2, foto3 FROM cliente WHERE codigo = ? ");
		$sqlfoto->execute([$codigo]);
    	$linhafoto = $sqlfoto->fetch();

    	if (isset($_POST['excluir-foto1'])){
			$foto1  = $linhafoto['foto1'];
			$branco = "";
			$pasta  ="../imagem_cliente/";
			unlink($pasta.$foto1);

			$sql = "UPDATE cliente SET foto1 = ? WHERE codigo = ? ";
			$stmt = $conexao->prepare($sql);
			$stmt->execute([$branco, $codigo]);
			
		};
		if (isset($_POST['excluir-foto2'])){
			$foto2  = $linhafoto['foto2'];
			$branco = "";
			$pasta  ="../imagem_cliente/";
			unlink($pasta.$foto2);
			
			$sql = "UPDATE cliente SET foto2 = ? WHERE codigo = ? ";
			$stmt = $conexao->prepare($sql);
			$stmt->execute([$branco, $codigo]);
		};
		if (isset($_POST['excluir-foto3'])){
			$foto3  = $linhafoto['foto3'];
			$branco = "";
			$pasta  ="../imagem_cliente/";
			unlink($pasta.$foto3);
			
			$sql = "UPDATE cliente SET foto3 = ? WHERE codigo = ? ";
			$stmt = $conexao->prepare($sql);
			$stmt->execute([$branco, $codigo]);
		};
    };
    if (isset($_POST['pagou'])) {
		$pagou ="sim";
		if(empty($_POST['dataPagou'])){
			$dataPagou = $dataPagamento;	
   		}else{
   			$dataPagou = $_POST['dataPagou'];
   		};
   }else{
		$pagou 	   = "";
		$dataPagou = "";		
   };
   if (isset($_POST['cartao'])) {
		$cartao ="sim";
		$tipoCartao     = $_POST['escolhaCartao'];
   		$parcelasCartao = $_POST['parcelasCartao'];
   		if($parcelasCartao == 0){
   			$parcelasCartao = 1;
   		};
		   if($restante = ""){
			$restante = limpaValor($_POST['orcamento']);
		}else{
			$restante = limpaValor($_POST['restante']);
		}
   		$jurosCartao  = limpaValor($_POST['jurosCartao']);	
   }else{
		$cartao         = "";
		$tipoCartao	    = "";
		$parcelasCartao = 0;
		$jurosCartao    = 0;
   };
   // Seta data de pronto automaticamente
   if((($_POST['estado']=="SERVICO PRONTO")OR($_POST['estado']=="SERVIÇO PRONTO")OR($_POST['estado']=="APARELHO SAIU")OR($_POST['estado']=="DEVOLVEU")OR($_POST['estado']=="DOOU")OR($_POST['estado']=="COMPROU"))AND(empty($_POST['dataPronto']))){
   		$dataPronto = date("Y-m-d\TH:i");
   }else{
   		$dataPronto = $_POST['dataPronto'];
   }
    // Seta data de saida automaticamente
   if((($_POST['estado']=="APARELHO SAIU")OR($_POST['estado']=="DEVOLVEU")OR($_POST['estado']=="DOOU")OR($_POST['estado']=="COMPROU"))AND(empty($_POST['dataSaida']))){
   		$dataSaida = date("Y-m-d\TH:i");
   } else{
   		$dataSaida = $_POST['dataSaida'];
   }
   $cpf = retMascara($_POST['cpf']);

  // caso seja digitado uma virgula no lugar do ponto, aqui substitui pelo ponto para não dá erro nos cáldulos
  // $valorPeca        = str_replace(",",".", $_POST['valorPeca']);
   $valorPeca = limpaValor($_POST['valorPeca']); 
   $nulo      = '';

   $sqlAlteracao = $conexao->prepare("SELECT * FROM cliente WHERE codigo = ? AND excluiu = ? ");
   $sqlAlteracao->execute([$codigo, $nulo]);
   $verificaAlteracao = $sqlAlteracao->fetch();


	if(($_POST['estado']=="APARELHO SAIU")AND($verificaAlteracao['controle_saida']=="0000-00-00 00:00:00")){
   		$controle_saida = date("Y-m-d H:i:s");
		//$controle_saida = CURTIME();
	}else{	
		$controle_saida = $verificaAlteracao['controle_saida'];
	} 


	if($inicial == '.'){
		$inicial = '0.00';
		
	}
	if($restante == '.'){
		$restante = '0.00';
		
	}
	if(empty($dtNascimentoAlt)){
		$dtNascimentoAlt = '0000-00-00';
	}
	if(empty($dataPronto)){
		$dataPronto      = '0000-00-00 00:00:00';
	}
	if(empty($dataSaida)){
		$dataSaida       = '0000-00-00 00:00:00';
	}
	if(empty($dataPagou)){
		$dataPagou       = '0000-00-00';
	}

	// verifica se houve alteracao no cadastro
	if(($ordemServico == $verificaAlteracao['ordemServico']) AND ($nome ==  $verificaAlteracao['nome'] ) AND ($endereco ==  $verificaAlteracao['endereco'] ) AND
		($email ==  $verificaAlteracao['email'] ) AND ($telefone ==  $verificaAlteracao['telefone'] ) AND ($telefone2 ==  $verificaAlteracao['telefone2'] ) AND
		($dataEntrada ==  $verificaAlteracao['dataEntrada'] ) AND ($dtNascimentoAlt ==  $verificaAlteracao['dtNascimentoAlt'] ) AND ($aparelho ==  $verificaAlteracao['aparelho'] ) AND 
		($marca ==  $verificaAlteracao['marca'] ) AND ($modelo ==  $verificaAlteracao['modelo'] ) AND ($numeroSerie ==  $verificaAlteracao['numeroSerie'] ) AND
		($chassi ==  $verificaAlteracao['chassi'] ) AND ($imei ==  $verificaAlteracao['imei'] ) AND ($placa ==  $verificaAlteracao['placa'] ) AND
		($renavam ==  $verificaAlteracao['renavam'] ) AND ($defeitoReclamado ==  $verificaAlteracao['defeitoReclamado'] ) AND ($acessorio ==  $verificaAlteracao['acessorio'] ) AND
		($observacao ==  $verificaAlteracao['observacao'] ) AND ($estado ==  $verificaAlteracao['estado'] ) AND ($material ==  $verificaAlteracao['material'] ) AND
		($orcamento ==  $verificaAlteracao['orcamento'] ) AND ($valorObjeto ==  $verificaAlteracao['infoCliente'] ) AND ($desconto ==  $verificaAlteracao['desconto'] ) AND
		($materialAuxiliar ==  $verificaAlteracao['materialAuxiliar'] ) AND ($transporte ==  $verificaAlteracao['transporte'] ) AND ($inicial ==  $verificaAlteracao['inicial'] ) AND
		($restante ==  $verificaAlteracao['restante'] ) AND ($pagou ==  $verificaAlteracao['pagou'] ) AND
		($cartao ==  $verificaAlteracao['cartao'] ) AND ($tipoCartao ==  $verificaAlteracao['tipoCartao'] ) AND ($parcelasCartao ==  $verificaAlteracao['parcelasCartao'] ) AND
		($jurosCartao ==  $verificaAlteracao['jurosCartao'] ) AND ($dataPronto ==  $verificaAlteracao['dataPronto'] ) AND ($dataSaida ==  $verificaAlteracao['dataSaida'] ) AND
		($controle_saida ==  $verificaAlteracao['controle_saida'] ) AND ($valorPeca ==  $verificaAlteracao['valorPeca'] ) AND ($cpf ==  $verificaAlteracao['cpf'] ) AND
		($aPrazo ==  $verificaAlteracao['aPrazo'] ) AND ($dataPagou ==  $verificaAlteracao['dataPagou'] ) AND ($bandeira_cartao ==  $verificaAlteracao['bandeira_cartao'] )) {
			
			// se nada foi alterado, verifica se foi apenas mandado imprimir
			if(isset($_POST['salvar_imprimir'])){
					header('Location:../html/tabela_impressao.php?codigo_cliente='.$codigo);
					exit;
			}
			if(isset($_POST['salvar_imprimir_os'])){ 	  	
				header('Location:../html/OS.php?codigo_cliente='.$codigo);
				exit;
			}
	
			// se nada foi alterado e não foi mandado imprimir, manda a mensagem que nada foi alterado
			$_SESSION["informacao"]="<span style='color:red'>Nada foi alterado!</span>";
			header('Location:../html/home.php');
			exit;

	}

	// se alguma coisa foi alterada, o codigo abaixo e para gravar as alteracoes feitas, numa tabela, antes de alterar as informacoes no banco
   	require_once 'verifica_alteracao.php';
	
	// altera no banco as alteracoes na tabela cliente
   	$sql = "UPDATE cliente SET ordemServico=?,nome=?,endereco=?,email=?,telefone=?, 
	telefone2=?,dataEntrada=?,dtNascimentoAlt=?,aparelho=?,marca=?, 
	modelo=?,numeroSerie=?,chassi=?,imei=?,placa=?, 
	renavam=?,defeitoReclamado=?,acessorio=?,observacao=?,estado=?, 
	material=?,orcamento=?,infoCliente=?,desconto=?,materialAuxiliar=?,transporte=?,inicial=?, 
	restante=?,dataPagamento=?,pagou=?,cartao=?,tipoCartao=?,parcelasCartao=?, 
	jurosCartao=?,dataPronto=?,dataSaida=?,controle_saida=?,valorPeca=?,cpf=?,aPrazo=?,dataPagou=?,bandeira_cartao=? 
	WHERE codigo = ? "; 
	$stmt = $conexao->prepare($sql);
	$stmt->execute([$ordemServico,$nome,$endereco,$email,$telefone, 
	$telefone2,$dataEntrada,$dtNascimentoAlt,$aparelho,$marca, 
	$modelo,$numeroSerie,$chassi,$imei,$placa, 
	$renavam,$defeitoReclamado,$acessorio,$observacao,$estado, 
	$material,$orcamento,$valorObjeto,$desconto,$materialAuxiliar,$transporte,$inicial, 
	$restante,$dataPagamento,$pagou,$cartao,$tipoCartao,$parcelasCartao, 
	$jurosCartao,$dataPronto,$dataSaida,$controle_saida,$valorPeca,$cpf,$aPrazo,$dataPagou,$bandeira_cartao,$codigo]);

   // COM TODAS AS INFORMAÇÕES JÁ ALTERADAS NA ARRAY,AGORA É FEITA A ALTERAÇÃO NO BANCO MYSQL, CONFERIDA A CONEXÃO, TODAS AS INFORMAÇÕES DA ARRAY $sql É ENVIADA NA SEQUÊNCIA DOS CÓDIGOS DIGITADOS.  
   //SE TUDO CORRER BEM, O CÓDIGO AVANÇA PARA AS PRÓXIMAS LINHAS, CASO CONTRÁRIO, EXIBE UMA MENSAGEM DE ERRO, ONDE INFORMA ALGUMA COISA ERRADA RELACIONADA COM A CONEXÃO, OU COM AS ALTERAÇÕES.
 
   // verifica nmais uma vez se foi mandado salvar e imprimir 
   	if(isset($_POST['salvar_imprimir'])){
			header('Location:../html/tabela_impressao.php?codigo_cliente='.$codigo);
			exit;
	}
	if(isset($_POST['salvar_imprimir_os'])){ 	  	
		header('Location:../html/OS.php?codigo_cliente='.$codigo);
		exit;
	}

    $_SESSION["informacao"]="O cadastro foi alterado com sucesso!";
     header('Location:backup.php');
	 exit;
}// Fim de alterar um cadastro //
$_SESSION["informacao"]="<span style='color:red'>Operação não foi realizada com sucesso!";
  header('Location:../html/home.php');
  exit;
?> 