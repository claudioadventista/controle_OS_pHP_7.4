<?php
@session_start();
/*
if(empty($_SESSION['logado'])) {
	 unset ($_SESSION['logado']);
	 header('Location:../html/login.php');	  
 exit;
}	
*/
// validar senha, tem que ter letra maiúscula, letra menúscula, numero e ter pelo menos 8 caractere
function senhaValida($senha){
   	return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[\w$@]{8,}$/', $senha);
}
// Função maiuscula, tira acento, troca cedilha
function tirarAcentos($string){
	return preg_replace(array("/(a|á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(e|é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(i|í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(o|ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(u|ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/","/(b)/","/(c)/","/(d)/","/(f)/","/(g)/","/(h)/","/(j)/","/(k)/","/(l)/","/(m)/","/(n)/","/(p)/","/(q)/","/(r)/","/(s)/","/(t)/","/(v)/","/(w)/","/(y)/","/(x)/","/(z)/"),explode(" ","A A E E I I O O U U N N C C B C D F G H J K L M N P Q R S T V W Y X Z"),$string);
} 
// Função maiuscula, tira acento, troca cedilha
function eliminaAcentos($string){
	return preg_replace(array("/(a|á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(e|é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(i|í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(o|ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(u|ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$string);
} 
function retiraEspaco($string){
	return trim(preg_replace('/( )+/', ' ',$string));   
};
function retiraTodosEspacos($string){
	return trim(preg_replace('/( )+/', '',$string));   
};
function maiusculo($term){
	$palavra = strtr(strtoupper($term),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿbcdefghijklmnopqrstuvwxyz","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞßBCDEFGHIJKLMNOPQRSTUVWXYZ");
	return $palavra;
}
function menuscula($term){
	$palavra = strtr(strtolower($term),"ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß","àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ");
	return $palavra;
}
// função para limitar os caracteres na linha 
function resumo($string,$chars){	
	if (strlen($string) > $chars)
		return substr($string,0,$chars)."...";// retorna a palavra limitada com os pontinhos
	else
	    return $string;// retorna a palavra inteira
};
// função para limitar os caracteres na linha 
function resumo2($string,$chars){	
	if (strlen($string) > $chars)
		return substr($string,0,$chars);// retorna a palavra limitada com os pontinhos
	else
	    return $string;// retorna a palavra inteira
};
/*
function resumo($string,$chars){	
	if (strlen($string) > $chars) {
		while (substr($string,$chars,1) <> ' ' && ($chars < strlen($string))){
			$chars++;
		};
		return substr($string,0,$chars)."...";// retorna a palavra limitada com os pontinhos
	};
	return substr($string,0,$chars);// retorna a palavra inteira
};
*/
// retira a máscara do cpf para cadastrar no banco
function retMascara($valor){
	$valor = trim($valor);
	$valor = str_replace(".", "", $valor);
	$valor = str_replace(",", "", $valor);
	$valor = str_replace("-", "", $valor);
	$valor = str_replace("/", "", $valor);
	return $valor;
}
// função troca a virgula pelo pornto na string
function trocaVirgula($money){
	$money = trim($money);
	$money = str_replace(",", ".", $money);
	return $money;
}
// funçã para cadastrar no banco no formato abaixo 
// Ex. 592,45 fica 592.45  
// Ex. 12.276,95 fica 12276.95
// 0,50 fica 0.50
function limpaValor($money){
	$limpa = trim($money);
	// retira ponto e virgula da sttring
	//$result = str_replace(['.',','],'', $limpa );
	// retira tudo e deixa somento numeros de 0 a 9
	$result = preg_replace("/[^0-9]/", "", $limpa);
	// coloca um ponto decimal depois do segundo número da direita para a esquerda Ex. 12345678.90
	return substr_replace($result , '.',-2, 0);
	// coloca um ponto decimal depois do segundo número da esquerda direita para a Ex. 12.34567890
	//return substr_replace($result , '.',-2, 0);
}
// colocar a máscara no cpf para mostrar
function formata_cpf($cpf){
    $cpf = preg_replace("/[^0-9]/", "", $cpf);
            $bloco_1 = substr($cpf,0,3);
            $bloco_2 = substr($cpf,3,3);
            $bloco_3 = substr($cpf,6,3);
            $dig_verificador = substr($cpf,-2);
            $cpf_formatado = $bloco_1.".".$bloco_2.".".$bloco_3."-".$dig_verificador;  
    return $cpf_formatado;
}
?>