<?php 
// primeiro coisa a fazer antes de conectar, é pegar os valores de usuário e senha do banco de dados
// esses valores foram impressos num arquivo de texto, quando foi criado o banco
// procura o arquivo e ler o conteúdo do arquivo de texto
$file = fopen("../php/loginesenhadobanco.txt","rb");
// coloca o conteúdo do texto numa variável
$frase = fgets($file);// antes era fgetss, foi descontinuado no php 8
// separa o usuário e a senha e coloca num array
$array = explode(" ",$frase);
fclose($file);
// atribui o valor de usuário e senha separadamente em variaveis
//if(isset($array[0])){$user = $array[0];}else{$user = "";};
//if(isset($array[1])){$pass = $array[1];}else{$pass = "";};
$host = "localhost";
$user = $array[0];
$pass = $array[1];
$banco = "ordem_servico";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$banco;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];


try{

    $conexao = new PDO($dsn, $user, $pass, $options);
    //$conexao = new PDO("mysql:host=$host;dbname=$banco;charset=utf8mb4", $user, $pass);
    //$conexao->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}
catch(\PDOException $e){

   // throw new \PDOException($e->getMessage(),(int)$e->getCode());
   //  die("Erro na conexão: ".$e->getMessage());
     header('Location:../php/criar_banco_auto.php');exit;
     
}

?>