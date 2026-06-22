<?php
@session_start();
require_once 'conexao.php';
if(empty($_SESSION['logado'])) {
	 unset ($_SESSION['logado']);
	 header('Location:../html/login.php');	  
 exit;
}	

// busca informacao para o formulario de alterar cadastro e ver cadastro
if(isset($_GET['busca'])){
   $buscarCliente = $_GET['busca'];
   $query =  $conexao->prepare("SELECT * FROM cliente WHERE codigo = ? ");	
   $query->execute([$buscarCliente]);
   $total = $query->rowCount();
   $linha = $query->fetch(); 

   echo json_encode($linha);
   exit;
};


// busca informacao para o formulario de configuracoes
if(isset($_GET['oficina'])){
   $buscarOficina = $_GET['oficina'];
   $query =  $conexao->prepare("SELECT * FROM config WHERE codigo = ? ");
   $query->execute([$buscarOficina]);
   $total = $query->rowCount();
   $linha = $query->fetch(); 
 
   echo json_encode($linha);
   exit;
};

// busca aparelho cadastrado
if(isset($_GET['aparelho'])){
   $busca = trim($_GET['aparelho']);
   $sql = $conexao->prepare("SELECT * FROM aparelho WHERE  aparelho = ? ");
   $sql->execute([$busca]);
   $tot = $sql->rowCount();
   $buscaAparelho = $sql->fetch(); 

   echo json_encode($buscaAparelho);
   exit;
 }

 // busca aparelho cadastrado
if(isset($_GET['validaEstadoAlt'])){
   $buscaEstado = $_GET['validaEstadoAlt'];
   $sql = $conexao->prepare("SELECT codigo, nome, estado FROM cliente WHERE codigo = ? ");
   $sql->execute([$buscaEstado]);
   $selectEstado = $sql->fetch();

   echo json_encode($selectEstado);
   exit;
 }

if(isset($_GET['aparelhoAlt'])){
   $sql = $conexao->prepare("SELECT codigo, aparelho FROM aparelho ORDER BY aparelho ASC");
   $sql->execute();
   $itens = array();
    if ($sql->rowCount() > 0) {
      while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $itens[] = $row;
      }
   }

   echo json_encode($itens, JSON_UNESCAPED_UNICODE);
   exit;
}

if(isset($_GET['marcaAlt'])){
   $sql = $conexao->prepare("SELECT codigo, marca FROM marca ORDER BY marca ASC");
   $sql->execute();
   $itens = array();
   if ($sql->rowCount() > 0) {
      while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $itens[] = $row;
      }
   }

   echo json_encode($itens, JSON_UNESCAPED_UNICODE);
   exit;
}

if(isset($_GET['modeloAlt'])){
   $sql = $conexao->prepare("SELECT codigo, modelo FROM modelo ORDER BY modelo ASC");
   $sql->execute();
   $itens = array();
  if ($sql->rowCount() > 0) {
      while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $itens[] = $row;
      }
   }

   echo json_encode($itens, JSON_UNESCAPED_UNICODE);
   exit;
}

if(isset($_GET['estadoAlt'])){
   $sql = $conexao->prepare("SELECT estado FROM estado");
   $sql->execute();
   $itens = array();
   if ($sql->rowCount() > 0) {
      while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $itens[] = $row;
      }
   }

   echo json_encode($itens, JSON_UNESCAPED_UNICODE);
   exit;
}

 // busca marca cadastrada
if(isset($_GET['marca'])){
   $busca = trim($_GET['marca']);
   $sql = $conexao->prepare("SELECT * FROM marca WHERE  marca = ? ");
   $sql->execute([$busca]);
   $tot = $sql->rowCount();
   $buscaMarca = $sql->fetch();

   echo json_encode($buscaMarca);
   exit;
 }
 // busca modelo cadastrado
 if(isset($_GET['modelo'])){ 
   $busca = trim($_GET['modelo']);
   $sql = $conexao->prepare("SELECT * FROM modelo WHERE  modelo = ? ");
   $sql->execute([$busca]);
   $tot = $sql->rowCount();
   $buscaModelo = $sql->fetch();

   echo json_encode($buscaModelo);
   exit;
 }
 // busca informação para o cadastrado e alteração de funcionario
 if(isset($_GET['funcionario'])){
   $busca = trim($_GET['funcionario']);
   $sql = $conexao->prepare("SELECT * FROM funcionario WHERE cpf = ? OR barra_funcionario = ? OR usuario = ? ");
   $sql->execute([$busca, $busca, $busca]);
   $tot = $sql->rowCount();
   $buscaFuncionario = $sql->fetch();

   echo json_encode($buscaFuncionario);
   exit;
}
// VERIFICA SE O CPF DIGITADO NO FORMULARIO DE CADASTRO JA ESTA CADASTRADO NO BANCO
if(isset($_GET['buscaCPF'])){
   $busca = $_GET['buscaCPF'];
   $query =  $conexao->prepare("SELECT cpf FROM cliente WHERE cpf = ? ");	
   $query->execute([$busca]);
   $total = $query->rowCount();

   echo json_encode($total);
   exit;
};
// VERIFICA SE O EMAIL DIGITADO NO FORMULARIO DE CADASTRO JA ESTA CADASTRADO NO BANCO
if(isset($_GET['buscaEmailAlt'])){
   $busca = $_GET['buscaEmailAlt'];
   $query =  $conexao->prepare("SELECT email FROM cliente WHERE email = ? ");
   $query->execute([$busca]);	
   $total = $query->rowCount();

   echo json_encode($total);
   exit;
};
// VERIFICA SE O SISTEMA ESTA SENDO ACESSADO PELO SERVIDOR
if(isset($_GET['servidorHome'])){
   $codigo = 1;
   $query =  $conexao->prepare("SELECT codigo FROM funcionario WHERE codigo = ? ");
   $query->execute([$codigo]);	
   $buscaServidor = $query->fetch();

   echo json_encode($buscaServidor);
   exit;
};
?>
