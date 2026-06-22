
<?php

// CONFIGURAÇÃO
$host = "localhost";
$user = "root";
$pass = "";
$banco = "ordem_servico";

$arquivo = "backup_ordem_servico.sql";

$conexao = mysqli_connect($host, $user, $pass, $banco);
if (!$conexao) {
    die("Erro conexão: ". mysqli_connect_error());
}

mysqli_set_charset($conexao, "utf8mb4");

// Abre arquivo pra escrever
$handle = fopen($arquivo, 'w+');
if (!$handle) {
    die("Erro: Não consegui criar o arquivo na pasta. Checa permissão da pasta.");
}

// Cabeçalho do SQL
fwrite($handle, "-- Backup do banco: $banco\n");
fwrite($handle, "-- Data: ". date("Y-m-d H:i:s"). "\n");
fwrite($handle, "SET NAMES utf8mb4;\n");
fwrite($handle, "SET FOREIGN_KEY_CHECKS=0;\n\n");

// 1. PEGA TODAS AS TABELAS
$tabelas = array();
$result = mysqli_query($conexao, "SHOW TABLES");
while ($row = mysqli_fetch_row($result)) {
    $tabelas[] = $row[0];
}

// 2. PASSA TABELA POR TABELA
foreach ($tabelas as $tabela) {
    fwrite($handle, "\n-- Estrutura da tabela `$tabela`\n");
    fwrite($handle, "DROP TABLE IF EXISTS `$tabela`;\n");

    // Pega CREATE TABLE
    $res_create = mysqli_query($conexao, "SHOW CREATE TABLE `$tabela`");
    $row_create = mysqli_fetch_row($res_create);
    fwrite($handle, $row_create[1]. ";\n\n");

    // Pega os dados
    $res_dados = mysqli_query($conexao, "SELECT * FROM `$tabela`");
    $num_campos = mysqli_num_fields($res_dados);

    if (mysqli_num_rows($res_dados) > 0) {
        fwrite($handle, "-- Dados da tabela `$tabela`\n");

        while ($linha = mysqli_fetch_row($res_dados)) {
            fwrite($handle, "INSERT INTO `$tabela` VALUES(");
            for ($i = 0; $i < $num_campos; $i++) {
                if (isset($linha[$i])) {
                    $linha[$i] = addslashes($linha[$i]);
                    $linha[$i] = str_replace("\n", "\\n", $linha[$i]);
                    fwrite($handle, '"'. $linha[$i]. '"');
                } else {
                    fwrite($handle, 'NULL');
                }
                if ($i < ($num_campos - 1)) {
                    fwrite($handle, ',');
                }
            }
            fwrite($handle, ");\n");
        }
    }
    fwrite($handle, "\n");
}

fwrite($handle, "SET FOREIGN_KEY_CHECKS=1;\n");
fclose($handle);
mysqli_close($conexao);

?>
<!-- VOLTA UMA PÁGINA ATUALIZANDO -->
   <script>
   	 window.location = document.referrer;
   </script>
