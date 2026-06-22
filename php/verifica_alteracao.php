<?php

if((isset($verificaAlteracao['ordemServico']))AND($ordemServico <> $verificaAlteracao['ordemServico'])){
    
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();

    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao =  $ultimaAlteracao.", OS antiga - ".$verificaAlteracao['ordemServico'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);
   
};

if((isset($verificaAlteracao['nome']))AND($nome <> $verificaAlteracao['nome'])){
    
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
  
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Nome antigo - ".$verificaAlteracao['nome'];

    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteracao['telefone']))AND($telefone <> $verificaAlteracao['telefone'])){
 
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();

    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Telefone antigo - ".$verificaAlteracao['telefone'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);
    
};

if((isset($verificaAlteracao['telefone2']))AND($telefone2 <> $verificaAlteracao['telefone2'])){
  
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();

    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Telefone 2 antigo - ".$verificaAlteracao['telefone2'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);
   
};

if((isset($verificaAlteracao['cpf']))AND($cpf <> $verificaAlteracao['cpf'])){
 
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();

    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", CPF antigo - ".$verificaAlteracao['cpf'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);
    
};

if((isset($verificaAlteracao['email']))AND($email <> $verificaAlteracao['email'])){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();

    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Email antigo - ".$verificaAlteracao['email'];

    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);
   
};

if((isset($verificaAlteracao['endereco']))AND($endereco <> $verificaAlteracao['endereco'])){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();

    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Endereço antigo - ".$verificaAlteracao['endereco'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteracao['aparelho']))AND($aparelho <> $verificaAlteracao['aparelho'])){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();

    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Aparelho antigo - ".$verificaAlteracao['aparelho'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteracao['marca']))AND($marca <> $verificaAlteracao['marca'])){
  
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();

    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Marca antiga - ".$verificaAlteracao['marca'];

    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteracao['modelo']))AND($modelo <> $verificaAlteracao['modelo'])){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();

    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Modelo antigo - ".$verificaAlteracao['modelo'];

    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteracao['numeroSerie']))AND($numeroSerie <> $verificaAlteracao['numeroSerie'])){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();

    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Nº Série antigo - ".$verificaAlteracao['numeroSerie'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteracao['chassi']))AND($chassi <> $verificaAlteracao['chassi'])){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();

    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Chassi antigo - ".$verificaAlteracao['chassi'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteracao['estado']))AND($estado <> $verificaAlteracao['estado'])){
    
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();

    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Estado antigo - ".$verificaAlteracao['estado'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteracao['defeitoReclamado']))AND($defeitoReclamado <> $verificaAlteracao['defeitoReclamado'])){
    
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Defeito antigo - ".$verificaAlteracao['defeitoReclamado'];
   
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteracao['acessorio']))AND($acessorio <> $verificaAlteracao['acessorio'])){
    
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Acessório antigo - ".$verificaAlteracao['acessorio'];

    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteracao['observacao']))AND($observacao <> $verificaAlteracao['observacao'])){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Obs. antiga - ".$verificaAlteracao['observacao'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteracao['dataEntrada']))AND($dataEntrada <> $verificaAlteracao['dataEntrada'])){
    
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Dt entrada antiga - ".$verificaAlteracao['dataEntrada'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if(((isset($verificaAlteracao['dataPronto']))AND($dataPronto <> $verificaAlteracao['dataPronto'])AND($verificaAlteracao['dataPronto']<>'0000-00-00'))){
    
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Dt. pronto antiga - ".$verificaAlteracao['dataPronto'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if(((isset($verificaAlteracao['dataSaida']))AND($dataSaida <> $verificaAlteracao['dataSaida'])AND($verificaAlteracao['dataSaida']<>'0000-00-00'))){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
   
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Dt. saida antiga - ".$verificaAlteracao['dataSaida'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteracao['material']))AND($material <> $verificaAlteracao['material'])){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();

    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Mat. antigo - ".$verificaAlteracao['material'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if(((isset($verificaAlteracao['orcamento']))AND($orcamento <> $verificaAlteracao['orcamento'])AND($verificaAlteracao['orcamento']<>'0.00'))){
    
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Orç. antigo - ".$verificaAlteracao['orcamento'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if(((isset($verificaAlteracao['valorPeca']))AND($valorPeca <> $verificaAlteracao['valorPeca'])AND($verificaAlteracao['valorPeca']<>'0.00'))){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Valor peça antigo - ".$verificaAlteracao['valorPeca'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if(((isset($verificaAlteracao['desconto']))AND($desconto <> $verificaAlteracao['desconto'])AND($verificaAlteracao['desconto']<>'0.00'))){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Desc. antigo - ".$verificaAlteracao['desconto'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};
/*
if((isset($verificaAlteracao['tecnico']))AND($tecnico <> $verificaAlteracao['tecnico'])){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Técnico antigo - ".$verificaAlteracao['tecnico'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};
*/

?>