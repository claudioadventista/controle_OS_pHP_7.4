<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title>Controle OS</title>
	<link rel="shortcut icon" href="favicon.ico" >
	<meta name="viewport" content="widhth=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=10,  minimum-scale=1.0" />
	<meta name="referrer" content="default" id="meta_referrer" />
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" type="text/css" href="../estilo/index.css" />
    <style>
        .container{
            width:40%;
            height:40%;
            margin:5% auto;
            background:#aaa;
            left:30%;
        }
        h1{
            text-align:center;
            margin-top:30%;
            font-size:2em;
            font-weight:bold;
            color:red;
        }
    </style>
</head>
<body>
	<div class="container"> 
        <h1>O sistema não pode ser acessado fora do servidor</h1>
    </div>
    <?php
    //require_once '../php/expira_session.php';
    @session_start();
    require_once '../php/conexao.php';
    //$codigo = $_SESSION['codigo'];
    $tentativa = 0;
    $codigo = 1;
    $sql = "UPDATE funcionario SET tentativa = ? WHERE codigo = ? "; 
	$stmt = $conexao->prepare($sql);
	$stmt->execute([$tentativa, $codigo]);
		
    unset($_SESSION['logado']);
    unset($_SESSION['nivel']);
    //unset($_SESSION['codigo']);

    unset($_SESSION['barra_funcionario']); 
    unset($_SESSION['controle']);
    unset($_SESSION['info']);
    $_SESSION = array();
    session_destroy();
    if($_SESSION['cronometro']="sim"){
        $_SESSION['cronometro']=="nao";
    };
    // header('location: ../html/home.php');
    ?>
</body>
</html> 