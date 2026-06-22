<?php
// CONFIGURAÇÃO
$host = "localhost";
$user = "root";
$pass = "";
$banco = "ordem_servico";

// Só executa se clicou no botão
if (isset($_REQUEST['nome']) && $_REQUEST['nome'] == 'gerar') {

    if(ob_get_level()) ob_end_clean();

    $tmp_dir = sys_get_temp_dir(). DIRECTORY_SEPARATOR;
    $pc_nome = gethostname();
    $data = date("Y-m-d_H-i-s");

    $nome_sql = "backup_". $banco. "_". $data. ".sql";
    $nome_zip = "backup_". $banco. "_". $pc_nome. "_". $data. ".zip";

    $arquivo_sql = $tmp_dir. $nome_sql;
    $arquivo_zip = $tmp_dir. $nome_zip;

    // 1. CRIA O ARQUIVO SQL COM MYSQLI
    $conexao = mysqli_connect($host, $user, $pass, $banco);
    if (!$conexao) die("Erro conexão: ". mysqli_connect_error());

    mysqli_set_charset($conexao, "utf8mb4");
    $handle = fopen($arquivo_sql, 'w+');

    fwrite($handle, "-- Backup do banco: $banco\n");
    fwrite($handle, "-- Data: ". date("Y-m-d H:i:s"). "\n");
    fwrite($handle, "SET NAMES utf8mb4;\n");
    fwrite($handle, "SET FOREIGN_KEY_CHECKS=0;\n\n");

    $result = mysqli_query($conexao, "SHOW TABLES");
    while ($row = mysqli_fetch_row($result)) {
        $tabela = $row[0];

        fwrite($handle, "\n-- Tabela `$tabela`\n");
        fwrite($handle, "DROP TABLE IF EXISTS `$tabela`;\n");

        $res_create = mysqli_query($conexao, "SHOW CREATE TABLE `$tabela`");
        $row_create = mysqli_fetch_row($res_create);
        fwrite($handle, $row_create[1]. ";\n\n");

        $res_dados = mysqli_query($conexao, "SELECT * FROM `$tabela`");
        $num_campos = mysqli_num_fields($res_dados);

        if (mysqli_num_rows($res_dados) > 0) {
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
                    if ($i < ($num_campos - 1)) fwrite($handle, ',');
                }
                fwrite($handle, ");\n");
            }
        }
        fwrite($handle, "\n");
    }

    fwrite($handle, "SET FOREIGN_KEY_CHECKS=1;\n");
    fclose($handle);
    mysqli_close($conexao);

    // 2. COMPACTA PRA ZIP USANDO ZipArchive
    $zip = new ZipArchive();
    if ($zip->open($arquivo_zip, ZipArchive::CREATE) === TRUE) {
        $zip->addFile($arquivo_sql, $nome_sql); // Adiciona o.sql dentro do zip
        $zip->close();

        unlink($arquivo_sql); // Apaga o.sql, deixa só o.zip 
    } else {
       die("Erro ao criar arquivo ZIP");
    }

    // Força o download no navegador
header('Content-Description: File Transfer');
header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="' . $nome_zip. '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($arquivo_zip));

readfile($arquivo_zip);
unlink($arquivo_zip); // Apaga o .zip temporário depois de enviar
exit;
}
?>
<script>
   window.location = document.referrer;
</script>
