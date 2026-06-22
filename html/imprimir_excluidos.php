<?php // A linha abaixo permite manter as configurações da sessão loggin    
    @session_start();
    if(empty($_SESSION['logado'])){
        header("Location:home.php");
        exit;   
    };
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
            a{
                text-decoration:none;
                color:#000;
            }
        </style>
    </head>		
    <body>
        <a href="../html/home.php">
            <br><br>
            <?php
            @session_start();
            require_once '../php/consulta.php';
            // imprimir cadastro excluido pelo codigo
            if(isset($_REQUEST['imprimirCad_unico'])){
                $imprimir_unico = $_REQUEST['imprimirCad_unico'];
                $listagem = $conexao->prepare("SELECT cadastro FROM excluidos WHERE codigo = ? "); 
                $listagem->execute([$imprimir_unico]);
                $linha = $listagem->fetch();

                echo "<h3><center>Cadastro excluido</center></h3>";
                echo "<div style='padding:0 5px;'>".$linha['cadastro']."</div>";
            };

            // imprimir todos os cadastros excluídos
            if((isset($_REQUEST['imprimirCad']))AND($_REQUEST['imprimirCad']=="tudo")) {
                    //echo "<br>Clique aqui pava voltar";
                echo "<h3><center>Lista de cadastros excluidos</center></h3><br>"; 
                echo "<div style='padding:0 5px;'>";
                    //$imprimir_tudo = $_REQUEST['imprimirCad'];

                    $listagem = $conexao->prepare("SELECT cadastro FROM excluidos"); 
                    $listagem->execute();
                    while($listaExcluidos = $listagem->fetch(PDO::FETCH_ASSOC)) {
                        echo $listaExcluidos['cadastro']."<br><br>";
                    };
                echo "</div>";
                
            };

            // imprimir um cadastro excluido
            if(isset($_REQUEST['imprimir_unico'])){
                $imprimir_unico = $_REQUEST['imprimir_unico'];
                $listagem = $conexao->prepare("SELECT * FROM cliente WHERE codigo = ? "); 
                $listagem->execute([$imprimir_unico]);
                $linha = $listagem->fetch();

                echo "<h3><center>Impressão de Cadastro</center></h3>";
                echo "<div style='margin-left:10px;'>O.S. : ".$linha['ordemServico']."</div>";
                echo "<div style='margin-left:10px;'>Nome : ".$linha['nome']."</div>";
                if($linha['telefone']<>''){
                    echo "<div style='margin-left:10px;'>Telefone : ".$linha['telefone']."</div>";
                }
                if($linha['telefone2']<>''){
                    echo "<div style='margin-left:10px;'>Telefone 2 : ".$linha['telefone2']."</div>";
                }
                if($linha['cpf']<>''){
                    echo "<div style='margin-left:10px;'>CPF : ".$linha['cpf']."</div>";
                }
                if($linha['endereco']<>''){
                    echo "<div style='margin-left:10px;'>Endereço : ".$linha['endereco']."</div>";
                }
                if($linha['dtNascimentoAlt']<>'0000-00-00'){
                    echo "<div style='margin-left:10px;'>Data Nascimento : ".$linha['dtNascimentoAlt']."</div>";
                }
                if($linha['email']<>''){
                    echo "<div style='margin-left:10px;'>Email : ".$linha['email']."</div>";
                }
                echo "<div style='margin-left:10px;'>Cod. Barras : ".$linha['barra_cliente']."</div>";
                echo "<div style='margin-left:10px;'>Aparelho : ".$linha['aparelho']."</div>";
                echo "<div style='margin-left:10px;'>Marca : ".$linha['marca']."</div>";
                if($linha['modelo']<>''){
                    echo "<div style='margin-left:10px;'>Modelo : ".$linha['modelo']."</div>";
                };
                if($linha['numeroSerie']<>''){
                echo "<div style='margin-left:10px;'>N. Série : ".$linha['numeroSerie']."</div>";
                };
                if($linha['chassi']<>''){
                echo "<div style='margin-left:10px;'>Chassi : ".$linha['chassi']."</div>";
                };
                if($linha['imei']<>''){
                echo "<div style='margin-left:10px;'>Imei : ".$linha['imei']."</div>";
                };
                if($linha['placa']<>''){
                echo "<div style='margin-left:10px;'>Placa : ".$linha['placa']."</div>";
                };
                if($linha['renavam']<>''){
                echo "<div style='margin-left:10px;'>Renavam : ".$linha['renavam']."</div>";
                }
                echo "<div style='margin-left:10px;'>Defeito : ".$linha['defeitoReclamado']."</div>";
                if($linha['acessorio']<>''){
                echo "<div style='margin-left:10px;'>Acessório : ".$linha['acessorio']."</div>";
                };
                if($linha['observacao']<>''){
                echo "<div style='margin-left:10px;'>OBS : ".$linha['observacao']."</div>";
                };
                echo "<div style='margin-left:10px;'>Estado : ".$linha['estado']."</div>";
                echo "<div style='margin-left:10px;'>Data Entrada : ".$linha['dataEntrada']."</div>";
                if($linha['dataPronto']<> '0000-00-00'){
                    echo "<div style='margin-left:10px;'>Data Pronto : ".$linha['dataPronto']."</div>";
                };
                if($linha['dataSaida']<> '0000-00-00'){
                    echo "<div style='margin-left:10px;'>Data Saida : ".$linha['dataSaida']."</div>";
                };
                if($linha['infoCliente']<> '0.00'){
                    echo "<div style='margin-left:10px;'>Val. Estimado : ".$linha['infoCliente']."</div>";
                };
                if($linha['material']<> ''){
                    echo "<div style='margin-left:10px;'>Material : ".$linha['material']."</div>";
                };
                if($linha['orcamento']<> '0.00'){
                    echo "<div style='margin-left:10px;'>Orçamento : ".$linha['orcamento']."</div>";
                };
                if($linha['desconto']<> '0.00'){
                    echo "<div style='margin-left:10px;'>Desconto : ".$linha['desconto']."</div>";
                };
                if($linha['valorPeca']<> '0.00'){
                    echo "<div style='margin-left:10px;'>Peça : ".$linha['valorPeca']."</div>";
                };
                if($linha['materialAuxiliar']<> '0.00'){
                    echo "<div style='margin-left:10px;'>Mat. Auxiliar : ".$linha['materialAuxiliar']."</div>";
                };
                if($linha['transporte']<> '0.00'){
                    echo "<div style='margin-left:10px;'>Transporte : ".$linha['transporte']."</div>";
                };    
            };
            echo"<script>window.print();</script>";
            exit;
            ?>
        </a>
    </body>
</html>