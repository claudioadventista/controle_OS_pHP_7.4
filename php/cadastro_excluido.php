<?php 
    @session_start();
    // só entra nessa página se estiver logado 
     if(empty($_SESSION['logado'])) {
        $_SESSION["informacao"]="Operação não premitida!";
        header('Location:../html/home.php');
     exit;
    };
	
	$sqllistaalt = $conexao->prepare("SELECT * FROM cliente WHERE codigo = ? ");
    $sqllistaalt->execute([$codigo]);
	$linha = $sqllistaalt->fetch();
    
    if($linha['telefone']<>""){
        $telefone = ", Telefone - ".$linha['telefone'];
    }else{
        $telefone = "";
    }
    if($linha['telefone2']<>""){
        $telefone2 = ", Telefone 2 - ".$linha['telefone2'];
    }else{
        $telefone2 = "";
    }
    if($linha['cpf']<>""){
        $cpf = ", Cpf - ".$linha['cpf'];
    }else{
        $cpf = "";
    }
    if($linha['endereco']<>""){
        $endereco = ", Endereço - ".$linha['endereco'];
    }else{
        $endereco = "";
    }
    if($linha['numeroSerie']<>""){
        $numeroSerie = ", Nº série - ".$linha['numeroSerie'];
    }else{
        $numeroSerie = "";
    }
    if($linha['acessorio']<>""){
        $acessorio = ", Acessório - ".$linha['acessorio'];
    }else{
        $acessorio = "";
    }
    if($linha['observacao']<>""){
        $observacao = ", Observação - ".$linha['observacao'];
    }else{
        $observacao = "";
    }
    if($linha['material']<>""){
        $material = ", Material - ".$linha['material'];
    }else{
        $material = "";
    }
    if($linha['orcamento']<>"0.00"){
        $orcamento = ", Orçamento - ".$linha['orcamento'];
    }else{
        $orcamento = "";
    }
    if($linha['desconto']<>"0.00"){
        $desconto = ", Desconto - ".$linha['desconto'];
    }else{
        $desconto = "";
    }
    if($linha['tecnico']<>""){
        $tecnico = ", Técnico - ".$linha['tecnico'];
    }else{
        $tecnico = "";
    }
    if($linha['dataPronto']<>"0000-00-00"){
        $dataPronto = ", Dt pronto - ".date('d/m/Y',strtotime($linha['dataPronto']));
    }else{
        $dataPronto = "";
    }
    if($linha['dataSaida']<>"0000-00-00"){
        $dataSaida = ", Dt saída - ".date('d/m/Y',strtotime($linha['dataSaida']));
    }else{
        $dataSaida = "";
    }
    // coloca toda informacao numa variavel
	$cadastro_excluido = "Excluido em : ".date("d/m/Y")." - O.S. - ".
    $linha['ordemServico'].", Nome - ".$linha['nome'].$telefone.", Codigo de barra - ".$linha['barra_cliente'].
    $telefone2.$cpf.$endereco.", Dt entrada - ".date('d/m/Y',strtotime($linha['dataEntrada'])).
    ", Aparelho - ".$linha['aparelho'].", Marca - ".$linha['marca'].$numeroSerie.
    ", Def. reclamado - ".$linha['defeitoReclamado'].$acessorio.", Estado - ".$linha['estado'].
    $material.$desconto.$tecnico.$dataPronto.$dataSaida;
    // grava as informacoes da variavel no banco numa coluna aparte
	
	$sql = "INSERT INTO excluidos (cadastro) VALUES (?)";
	$stmt = $conexao->prepare($sql);
	$stmt->execute([$cadastro_excluido]);

    ?>