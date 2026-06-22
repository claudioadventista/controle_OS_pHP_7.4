<?php
// alteração em retorno 1
if((isset($verificaAlteraaoRet1['novaOS1']))AND($novaOS1 <> $verificaAlteraaoRet1['novaOS1'])){
    
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Nova OS Ret1 antiga - ".$verificaAlteraaoRet1['novaOS1'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteraaoRet1['estadoRetorno1']))AND($estadoRetorno1 <> $verificaAlteraaoRet1['estadoRetorno1'])){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Est. Ret1 antigo - ".$verificaAlteraaoRet1['estadoRetorno1'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteraaoRet1['defRet1']))AND($defRet1 <> $verificaAlteraaoRet1['defRet1'])){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Def. Ret1 antigo - ".$verificaAlteraaoRet1['defRet1'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteraaoRet1['acessRet1']))AND($acessRet1 <> $verificaAlteraaoRet1['acessRet1'])){
    
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Acess. Ret1 antigo - ".$verificaAlteraaoRet1['acessRet1'];

    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteraaoRet1['obsRet1']))AND($obsRet1 <> $verificaAlteraaoRet1['obsRet1'])){
    
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Obs. Ret1 antigo - ".$verificaAlteraaoRet1['obsRet1'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteraaoRet1['dataRetorno1']))AND($dataRetorno1 <> $verificaAlteraaoRet1['dataRetorno1'])){
    
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Dt retorno1 antiga - ".$verificaAlteraaoRet1['dataRetorno1'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteraaoRet1['dtProntoRet1']))AND($dtProntoRet1 <> $verificaAlteraaoRet1['dtProntoRet1'])AND($verificaAlteraaoRet1['dtProntoRet1']<>'0000-00-00')){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Dt. pronto Ret1 antiga - ".$verificaAlteraaoRet1['dtProntoRet1'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteraaoRet1['saidaRetorno1']))AND($saidaRetorno1 <> $verificaAlteraaoRet1['saidaRetorno1'])AND($verificaAlteraaoRet1['saidaRetorno1']<>'0000-00-00')){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Dt. saida Ret1 antiga - ".$verificaAlteracaoRet1['saidaRetorno1'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteraaoRet1['matRet1']))AND($matRet1 <> $verificaAlteraaoRet1['matRet1'])){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Mat. Ret1 antigo - ".$verificaAlteraaoRet1['matRet1'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if(((isset($verificaAlteraaoRet1['pecaRet1']))AND($pecaRet1 <> $verificaAlteraaoRet1['pecaRet1'])AND($verificaAlteraaoRet1['pecaRet1']<>'0.00'))){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
   
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Peça. Ret1 antigo - ".$verificaAlteraaoRet1['pecaRet1'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

// alteração em retorno 2
if((isset($verificaAlteraaoRet2['novaOS2']))AND($novaOS2 <> $verificaAlteraaoRet2['novaOS2'])){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Nova OS Ret2 antiga - ".$verificaAlteraaoRet2['novaOS2'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteraaoRet2['estadoRetorno2']))AND($estadoRetorno2 <> $verificaAlteraaoRet2['estadoRetorno2'])){
    
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Est. Ret2 antigo - ".$verificaAlteraaoRet2['estadoRetorno2'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteraaoRet2['defRet2']))AND($defRet2 <> $verificaAlteraaoRet2['defRet2'])){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Def. Ret2 antigo - ".$verificaAlteraaoRet2['defRet2'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteraaoRet2['acessRet2']))AND($acessRet2 <> $verificaAlteraaoRet2['acessRet2'])){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Acess. Ret2 antigo - ".$verificaAlteraaoRet2['acessRet2'];
   
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteraaoRet2['obsRet2']))AND($obsRet2 <> $verificaAlteraaoRet2['obsRet2'])){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Obs. Ret2 antigo - ".$verificaAlteraaoRet2['obsRet2'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteraaoRet2['dataRetorno2']))AND($dataRetorno2 <> $verificaAlteraaoRet2['dataRetorno2'])){
  
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Dt retorno2 antiga - ".$verificaAlteraaoRet2['dataRetorno2'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteraaoRet2['dtProntoRet2']))AND($dtProntoRet2 <> $verificaAlteraaoRet2['dtProntoRet2'])AND($verificaAlteraaoRet2['dtProntoRet2']<>'0000-00-00')){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Dt. pronto Ret2 antiga - ".$verificaAlteraaoRet2['dtProntoRet2'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteraaoRet2['saidaRetorno2']))AND($saidaRetorno2 <> $verificaAlteraaoRet2['saidaRetorno2'])AND($verificaAlteraaoRet2['saidaRetorno2']<>'0000-00-00')){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Dt. saida Ret2 antiga - ".$verificaAlteracaoRet2['saidaRetorno2'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteraaoRet2['matRet2']))AND($matRet2 <> $verificaAlteraaoRet2['matRet2'])){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Mat. Ret2 antigo - ".$verificaAlteraaoRet2['matRet2'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if(((isset($verificaAlteraaoRet2['pecaRet2']))AND($pecaRet2 <> $verificaAlteraaoRet2['pecaRet2'])AND($verificaAlteraaoRet2['pecaRet2']<>'0.00'))){
  
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
   
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Peça. Ret2 antigo - ".$verificaAlteraaoRet2['pecaRet2'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

// alteração em retorno 3
if((isset($verificaAlteraaoRet3['novaOS3']))AND($novaOS3 <> $verificaAlteraaoRet3['novaOS3'])){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Nova OS Ret3 antiga - ".$verificaAlteraaoRet3['novaOS3'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteraaoRet3['estadoRetorno3']))AND($estadoRetorno3 <> $verificaAlteraaoRet3['estadoRetorno3'])){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Est. Ret3 antigo - ".$verificaAlteraaoRet3['estadoRetorno3'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteraaoRet3['defRet3']))AND($defRet3 <> $verificaAlteraaoRet3['defRet3'])){
    
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
   
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Def. Ret3 antigo - ".$verificaAlteraaoRet3['defRet3'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteraaoRet3['acessRet3']))AND($acessRet3 <> $verificaAlteraaoRet3['acessRet3'])){
    
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
   
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Acess. Ret3 antigo - ".$verificaAlteraaoRet3['acessRet3'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteraaoRet3['obsRet3']))AND($obsRet3 <> $verificaAlteraaoRet3['obsRet3'])){
    
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Obs. Ret3 antigo - ".$verificaAlteraaoRet3['obsRet3'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteraaoRet3['dataRetorno3']))AND($dataRetorno3 <> $verificaAlteraaoRet3['dataRetorno3'])){
  
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
   
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Dt retorno3 antiga - ".$verificaAlteraaoRet3['dataRetorno3'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteraaoRet3['dtProntoRet3']))AND($dtProntoRet3 <> $verificaAlteraaoRet3['dtProntoRet3'])AND($verificaAlteraaoRet3['dtProntoRet3']<>'0000-00-00')){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
   
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Dt. pronto Ret3 antiga - ".$verificaAlteraaoRet3['dtProntoRet3'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteraaoRet3['saidaRetorno3']))AND($saidaRetorno3 <> $verificaAlteraaoRet3['saidaRetorno3'])AND($verificaAlteraaoRet3['saidaRetorno3']<>'0000-00-00')){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Dt. saida Ret3 antiga - ".$verificaAlteracaoRet3['saidaRetorno3'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if((isset($verificaAlteraaoRet3['matRet3']))AND($matRet3 <> $verificaAlteraaoRet3['matRet3'])){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Mat. Ret3 antigo - ".$verificaAlteraaoRet3['matRet3'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};

if(((isset($verificaAlteraaoRet3['pecaRet3']))AND($pecaRet3 <> $verificaAlteraaoRet3['pecaRet3'])AND($verificaAlteraaoRet3['pecaRet3']<>'0.00'))){
   
    $nulo = '';
    $stmt = $conexao->prepare("SELECT alteracao FROM cliente WHERE codigo = ? AND excluiu = ? ");
    $stmt->execute([$codigo, $nulo]);
    $verificaAlteraca = $stmt->fetch();
    
    $ultimaAlteracao = $verificaAlteraca['alteracao']." ***** ".$_SESSION['logado']." - ".$_SESSION['nivel']." - ".date("d/m/Y H:i:s");
    $alteracao = $ultimaAlteracao.", Peça. Ret3 antigo - ".$verificaAlteraaoRet3['pecaRet3'];
    
    $sql = "UPDATE cliente SET alteracao = ? WHERE codigo = ? "; 
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$alteracao, $codigo]);

};
