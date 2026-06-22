//********** FUNCAO PARA AS MASCARAS

function fMasc(objeto, mascara) {
	obj = objeto
	masc = mascara
	setTimeout("fMascEx()", 1)
}
function fMascEx() {
	obj.value = masc(obj.value)
}

//********** MASCARA DO TELEFONE

function mTel(tel) {
	tel = tel.replace(/\D/g, "")
	tel = tel.replace(/^(\d)/, "($1")
	tel = tel.replace(/(.{3})(\d)/, "$1)$2")
	if (tel.length == 9) {
		tel = tel.replace(/(.{1})$/, "-$1")
	} else if (tel.length == 10) {
		tel = tel.replace(/(.{2})$/, "-$1")
	} else if (tel.length == 11) {
		tel = tel.replace(/(.{3})$/, "-$1")
	} else if (tel.length == 12) {
		tel = tel.replace(/(.{4})$/, "-$1")
	} else if (tel.length > 12) {
		tel = tel.replace(/(.{4})$/, "-$1")
	}
	return tel;
}

//********** MASCARA DO CPF

function mCPF(cpf) {
	cpf = cpf.replace(/\D/g, "")
	cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2")
	cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2")
	cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2")
	return cpf;
}

//********** MASCARA DA PLACA NORMAL 

 document.getElementById('placaNormalAlt').addEventListener('input', function (e) {

	let value = e.target.value.toUpperCase();
	value = value.replace(/[^A-Z0-9]/g, ''); // Remove caracteres nao permitidos

	let formattedValue = '';

	// 3 primeiras posicoes: apenas letras
	for (let i = 0; i < Math.min(value.length, 3); i++) {
		if (/[A-Z]/.test(value[i])) {
			formattedValue += value[i];
		} else {
			// Se o caractere nao for letra, pare a iteracao ou ignore
			break;
		}
	}
	// Pega o restante da string original para processar os numeros
	value = value.substring(3); 
	// 5 ultimas posicoes (com o hifen): apenas numeros
	for (let i = 0; i < Math.min(value.length, 4); i++) {

		if (/[0-9]/.test(value[i])) {
			// Adiciona o hifen antes do primeiro numero
			if (formattedValue.length === 3) {
				formattedValue += '-';
			};
			formattedValue += value[i];
		} else {
			// Se o caractere nao for numero, pare a iteracao ou ignore
			break;
		}
	}

	e.target.value = formattedValue;
});

//********** MASCARA DA PLACA MERCOSUL 

 document.getElementById('placaMercosulAlt').addEventListener('input', function (e) {
	let value = e.target.value.toUpperCase();
	value = value.replace(/[^A-Z0-9]/g, ''); 
	let formattedValue = '';
	// tres primeiras
	for (let i = 0; i < Math.min(value.length, 3); i++) {
		if (/[A-Z]/.test(value[i])) {
			formattedValue += value[i];
		} else {
			break;
		}
	}
	value = value.substring(3); 
	// um numero
	for (let i = 0; i < Math.min(value.length, 1); i++) {
		if (/[0-9]/.test(value[i])) {
			formattedValue += value[i];
		} else {
			break;
		}
	}
	value = value.substring(1);
	// mais uma letra
	for (let i = 0; i < Math.min(value.length, 1); i++) {
		if (/[A-Z]/.test(value[i])) {
			formattedValue += value[i];
		} else {
			break;
		}
	}
	value = value.substring(1); 
	// mais dois numeros
	for (let i = 0; i < Math.min(value.length, 2); i++) {
		if (/[0-9]/.test(value[i])) {
			formattedValue += value[i];
		} else {
			break;
		}
	}
	e.target.value = formattedValue;
});

//********** FUNCAO VALIDA CAMPO SOMENTE NUMERO

function SomenteNumero(e) {
	var tecla = (window.event) ? event.keyCode : e.which;
	if ((tecla > 47 && tecla < 58))
		return true;
	else {
		if (tecla == 8 || tecla == 0 || tecla == 46 || tecla == 44)
			return true;
		else
			return false;
	}
}

// ***** funcao que limpa os campos na pagina aparelho marca e modelo

function limpaCampo(){
	const inputs = document.querySelectorAll('.inputNovo');
	inputs.forEach(inputNovo => {
		inputNovo.value = '';
	});
	document.getElementById('div_aparelho').style.display = 'none';
};


function desmarcar(){
	var boxes = document.getElementsByName("numeros[]");
	for(var i = 0; i < boxes.length; i++)
		boxes[i].checked = false;
}

// ***** impede auto complete em todos os formularios

document.addEventListener("DOMContentLoaded", function(){
    var inputs = document.querySelectorAll('input');
    inputs.forEach(function(input){
        input.setAttribute('autocomplete','off');
    });
});


//********** FUNCAO VALIDA O CAMPO PLACA MERCOSUL

function validaPlacaM(){
	var regex = '[A-Z]{3}[0-9][A-Z][0-9]{2}';// AAA9A99
	let placa = document.getElementById("placaMercosulAlt").value.toUpperCase();
	//let placa = placaMercosulAlt.value.toUpperCase();
	if (document.getElementById("placaMercosulAlt").value.length > 0 ){
	//if (placaMercosulAlt.value.length > 0 ){
	    if (placa.match(regex)) {
		}else{
			alert("Placa inválida! Digite a placa nesse modelo AAA9A99");
			document.getElementById("renavamAlt").focus();
			document.getElementById("placaMercosulAlt").value = "";
			//placaMercosulAlt.value = "";
		}
		if(document.getElementById("placaMercosulAlt").value != "" && document.getElementById("placaNormalAlt").value != ""){
		//if(placaMercosulAlt.value != "" && placaNormalAlt.value != ""){	
			alert("Campos Placa Normal e Placa Mercosul estão preenchidos");
			document.getElementById("placaMercosulAlt").value = "";
			//placaMercosulAlt.value = "";
			document.getElementById("placaNormalAlt").value = "";
			//placaNormalAlt.value = "";
			document.getElementById("renavamAlt").focus();
		}
	}
}

//********** FUNCAO VALIDA O CAMPO PLACA NORMAL

function validaPlacaN(){
	let regex = '[A-Z]{3}[-][0-9]{4}';// AA9999
	let placa = document.getElementById("placaNormalAlt").value.toUpperCase();
	//let placa = placaNormalAlt.value.toUpperCase();
	if (document.getElementById("placaNormalAlt").value.length > 0 ){
	//if (placaNormalAlt.value.length > 0 ){
		if (placa.match(regex)) {
		}else{
			alert("Placa inválida! Digite a placa nesse modelo AAA-9999");
			document.getElementById("renavamAlt").focus();
			document.getElementById("placaNormalAlt").value = "";
			//placaNormalAlt.value = "";
		}
		if(document.getElementById("placaMercosulAlt").value != "" && document.getElementById("placaNormalAlt").value != ""){
		//if(placaMercosulAlt.value != "" && document.getElementById("placaNormalAlt").value != ""){	
			alert("Campos Placa Normal e Placa Mercosul estão preenchidos");
			document.getElementById("placaMercosulAlt").value = "";
			//placaMercosulAlt.value = "";
			document.getElementById("placaNormalAlt").value = "";
			//placaNormalAlt.value = "";
			document.getElementById("renavamAlt").focus();
		}
	}
}

//********** FUNCAO PRIMEIRA LETRA DO TEXTO MAIUSCULA  

var ignorar = [ "d", "da", "de", "do", "das", "dos"];
function caixaAlta(string) {
    let habilia = "sim";// informação do banco mysql vindo por php
    if(habilia == "sim"){
        return String(string).toLowerCase().replace(/([^a-zà-ú]?)([a-zà-ú]+)/g, function(match, separator, word) {
            if (ignorar.indexOf(word) != -1) return separator + word;
            return separator + word.charAt(0).toUpperCase() + word.slice(1);// Só as iniciais maiúsculas
        });
    }else{
        return string.toUpperCase();// Tudo maiúsculo
    }
};
function corrigirValor(el) {
    el.value = caixaAlta(el.value);
}

//********** FUNCAO PRIMEIRA LETRA DO TEXTO MAIUSCULA  EM JQUERY

 function pri_mai(obj) {
	str = obj.value;
	qtd = obj.value.length;
	prim = str.substring(0, 1);
	resto = str.substring(1, qtd);
	str = prim.toUpperCase() + resto;
	obj.value = str;
}		

//********** FUNCAO DESABILITA BOTOES

function desabilitaBotoes(){
	document.getElementById("cadastroAlt").style.visibility ="hidden";
	document.getElementById("lb_salvar_imprimir").style.visibility ="hidden";
	document.getElementById("lb_salvar_imprimir_os").style.visibility ="hidden";
	
}

//********** FUNCAO REABILITA BOTOES

function reabilitaBotoes(){
	document.getElementById("cadastroAlt").style.visibility ="visible";//hidden
	document.getElementById("lb_salvar_imprimir_os").style.visibility ="visible";
	document.getElementById("lb_salvar_imprimir").style.visibility ="visible";
}	

//********** FUNCAO MODAL

function modal(){
	document.getElementById("cadastroAlt").innerHTML="<i class='but-verde fas fa-edit'></i><span class='espaco'>ALTERAR</span>";
	document.getElementById("fotoCliente1Ver").style.display="none";
	document.getElementById("fotoCliente2Ver").style.display="none";
	document.getElementById("fotoCliente3Ver").style.display="none";
	document.getElementById('verRet1').style.display = "none";
	document.getElementById('verRet2').style.display = "none";
	document.getElementById('verRet3').style.display = "none";
	document.getElementById("camposCartao").style.visibility = "hidden";
	document.getElementById("campoCartaoAlt").style.visibility = "hidden";
	buscaNoBanco();
}

//********** MASCARA DO CAMPO MOEDA

function moeda(a, e, r, t) {
    let n = ""
      , h = j = 0
      , u = tamanho2 = 0
      , l = ajd2 = ""
      , o = window.Event ? t.which : t.keyCode;
    if (13 == o || 8 == o)
        return !0;
    if (n = String.fromCharCode(o),
    -1 == "0123456789".indexOf(n))
        return !1;
    for (u = a.value.length,
    h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
        ;
    for (l = ""; h < u; h++)
        -1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
    if (l += n,
    0 == (u = l.length) && (a.value = ""),
    1 == u && (a.value = "0" + r + "0" + l),
    2 == u && (a.value = "0" + r + l),
    u > 2) {
        for (ajd2 = "",
        j = 0,
        h = u - 3; h >= 0; h--)
            3 == j && (ajd2 += e,
            j = 0),
            ajd2 += l.charAt(h),
            j++;
        for (a.value = "",
        tamanho2 = ajd2.length,
        h = tamanho2 - 1; h >= 0; h--)
            a.value += ajd2.charAt(h);
        a.value += r + l.substr(u - 2, u)
    }
    return !1
}

//********** FORMATAR EM REAL

  function formatReal( int )
{
	var tmp = int+'';
	tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
	if( tmp.length > 6 )
			tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
	if( tmp.length > 9 )
			tmp = tmp.replace(/([0-9]{3}),([0-9]{3}),([0-9]{2}$)/g, ".$1.$1,$2");
	return tmp;
}

//********** FUNCAO CALCULAR O VALOR DOS CAMPOS MONETARIOS

function calcular(){
	let AltOrcamento = document.getElementById("orcamentoAlt").value.replace(/[^\d]+/g,'');
	let AltDesconto = document.getElementById("descontoAlt").value.replace(/[^\d]+/g,'');
	let AltValorPeca = document.getElementById("valorPecaAlt").value.replace(/[^\d]+/g,'');
	let AltMaterial = document.getElementById("materialAuxiliarAlt").value.replace(/[^\d]+/g,'');
	let AltTransporte = document.getElementById("transporteAlt").value.replace(/[^\d]+/g,'');
	let AltInicial = document.getElementById("inicialAlt").value.replace(/[^\d]+/g,'');
	let comDesconto = (AltOrcamento - AltDesconto);
	let lucro = (AltOrcamento - AltDesconto - AltValorPeca - AltMaterial - AltTransporte);
	document.getElementById("lucroAlt").value =  formatReal(lucro);
	let MostraTotal = formatReal(comDesconto);
	comDescontoAlt.value = formatReal(comDesconto);
	document.getElementById("totalPagarAlt").value = MostraTotal;
	if(AltInicial){
		let AltInicial = document.getElementById("inicialAlt").value.replace(/[^\d]+/g,'');
		let AltOrcamento = orcamentoAlt.value.replace(/[^\d]+/g,'');
		let AltDesconto = document.getElementById("descontoAlt").value.replace(/[^\d]+/g,'');
		let restante = (AltOrcamento - AltDesconto - AltInicial);
		document.getElementById("restanteAlt").value =  formatReal(restante);
	}
	calculaTotalParcela();
	calculajuros();
}
																							 
//********** VALIDA O CPF DIGITADO                             

 function isValidCPF(cpf) {
    if (typeof cpf !== 'string') return false
    if (cpf == "12345678909") return false
   	if (cpf == "01234567890") return false
    
    cpf = cpf.replace(/[^\d]+/g, '')
    if (cpf.length !== 11 || !!cpf.match(/(\d)\1{10}/)) return false
    
    cpf = cpf.split('')
    const validator = cpf
        .filter((digit, index, array) => index >= array.length - 2 && digit)
        .map( el => +el )
    const toValidate = pop => cpf
        .filter((digit, index, array) => index < array.length - pop && digit)
        .map(el => +el)
    const rest = (count, pop) => (toValidate(pop)
        .reduce((soma, el, i) => soma + el * (count - i), 0) * 10) % 11 % 10
    return !(rest(10,2) !== validator[0] || rest(11,1) !== validator[1])
}

//-----------------------------------------------------------------------------------------------------------

//********** BUSCA POR NOVO APARELHO A SER CADASTRADO                         
 																						
function buscar_novo_aparelho(){
    var campo_aparelho = document.getElementById("cadastroNovoAparelho").value.trim();		
		fetch('http://localhost:81/controle_OS/sistema/php/busca_informacao.php?aparelho=' + campo_aparelho)
		.then(response => {// retorna a requisição fetch
			if (response.ok) {// se reornar ok
			return response.json();// converte num objeto json
			}
		})
		.then(json => {
			 if(json){
				alert("O aparelho já é cadastrado!");
				 document.getElementById("cadastroNovoAparelho").value = "";
			 };	
		})
		.catch(error => {	
			//alert('O sistema só pode ser acesado pelo servidor');
			//window.location.href='../php/expira_session.php';
		}); 
};

//********** VALIDA O APARELHO A SER CADASTRADO NO FORMULARIO DE NOVO APARELHO

function validar_aparelho(){
    var campo_aparelho = document.getElementById("aparelho").value.trim();
	if(campo_aparelho =="" || campo_aparelho.length < 2 ){
		alert('Digite pelo menos dois caracteres para cadastrar o novo aparelho!');
		return false;	
	}else{		
		fetch('http://localhost:81/controle_OS/sistema/php/busca_informacao.php?aparelho=' + campo_aparelho)
		.then(response => {// retorna a requisição fetch
			if (response.ok) {// se reornar ok
			return response.json();// converte num objeto json
			}
		})
		.then(json => {
			 if(json){
				alert("O aparelho já é cadastrado!");
				document.getElementById("aparelho").value = "";
				return false;	
			 }else{
			 	window.location.href = 'http://localhost:81/controle_OS/sistema/php/cadastrar_aparelho_marca_estado.php?novo-aparelho=' + campo_aparelho;
			 };	
		})
		.catch(error => {
			//alert('O sistema só pode ser acesado pelo servidor');
			//window.location.href='../php/expira_session.php';
		}); 
	};
};

//********** BUSCA PELO APARELHO PESQUISADO

function buscar_aparelho(){
	let texto5 = document.getElementById('aparelho_busca').value.trim();
	if(texto5 =="" || texto5.length < 2 ){
		alert('Digite pelo menos dois caracteres para pesquisar pelo aparelho!');
		return false;	
	}else{
		fetch('http://localhost:81/controle_OS/sistema/php/busca_informacao.php?aparelho=' + texto5)
		.then(response => {// retorna a requisição fetch
			if (response.ok) {// se reornar ok
			return response.json();// converte num objeto json
			}
		})
		.then(json => {
			let codigo_aparelho = document.getElementById('codigoAparelho');
			let mascara_aparelho = document.getElementById('altAparelho');
			let nome_aparelho = document.getElementById('aparelho_alt');
			 if(json){
				mascara_aparelho.style.display = "block";
				nome_aparelho.value = json.aparelho ;
				codigo_aparelho.value = json.codigo;
			 }else{
				document.getElementById('aparelho_busca').value = "";
				mascara_aparelho.style.display = "none";
				alert("O aparelho não foi encontrado!");
			 }	
		})
		.catch(error => {
			//alert('O sistema só pode ser acesado pelo servidor');
			//window.location.href='../php/expira_session.php';
		}); 
	};
};

//-----------------------------------------------------------------------------------------------------------

//********** BUSCA POR NOVA MARCA A SER CADASTRADA

function buscar_nova_marca(){
    var campo_marca = document.getElementById("cadastroNovaMarca").value.trim();		
		fetch('http://localhost:81/controle_OS/sistema/php/busca_informacao.php?marca=' + campo_marca)
		.then(response => {// retorna a requisição fetch
			if (response.ok) {// se reornar ok
			return response.json();// converte num objeto json
			}
		})
		.then(json => {
			 if(json){
				alert("A marca já é cadastrada!");
				 document.getElementById("cadastroNovaMarca").value = "";
			 };	
		})
		.catch(error => {	
			//alert('O sistema só pode ser acesado pelo servidor');
			//window.location.href='../php/expira_session.php';
		}); 
};

//********** VALIDA A MARCA A SER CADASTRADA NO FORMULARIO DE NOVA MARCA

function validar_marca(){
    var campo_marca = document.getElementById("marca").value.trim();
	if(campo_marca =="" || campo_marca.length < 2 ){
		alert('Digite pelo menos dois caracteres para cadastrar a nova marca!');
		return false;	
	}else{		
		fetch('http://localhost:81/controle_OS/sistema/php/busca_informacao.php?marca=' + campo_marca)
		.then(response => {// retorna a requisição fetch
			if (response.ok) {// se reornar ok
			return response.json();// converte num objeto json
			}
		})
		.then(json => {
			 if(json){
				alert("A marca já é cadastrada!");
				document.getElementById("marca").value = "";
				return false;	
			 }else{
			 	window.location.href = 'http://localhost:81/controle_OS/sistema/php/cadastrar_aparelho_marca_estado.php?nova-marca=' + campo_marca;
			 };	
		})
		.catch(error => {
			//alert('O sistema só pode ser acesado pelo servidor');
			//window.location.href='../php/expira_session.php';
		}); 
	};
};

//********** BUSCA PELA MARCA PESQUISADA

function buscar_marca(){
	let texto5 = document.getElementById('marca_busca').value;
	if(texto5 =="" || texto5.length < 2 ){
		alert('Digite pelo menos dois caracteres para pesquisar pela marca!');
		return false;	
	}else{
		fetch('http://localhost:81/controle_OS/sistema/php/busca_informacao.php?marca=' + texto5)
		.then(response => {// retorna a requisição fetch
			if (response.ok) {// se reornar ok
			return response.json();// converte num objeto json
			}
		})
		.then(json => {
			let codigo_marca = document.getElementById('codigoMarca');
			let mascara_marca = document.getElementById('altMarca');
			let nome_marca = document.getElementById('marca_alt');
			 if(json){
				mascara_marca.style.display = "block";
				nome_marca.value = json.marca ;
				codigo_marca.value = json.codigo;
			 }else{
				document.getElementById('marca_busca').value = "";
				mascara_marca.style.display = "none";
				alert("A marca não foi encontrada!");
			 }		
		})
		.catch(error => {
			//alert('O sistema só pode ser acesado pelo servidor');
			//window.location.href='../php/expira_session.php';
		}); 
	};
};

//------------------------------------------------------------------------------------------------------------

//********** BUSCA POR NOVO MODELO A SER CADASTRADO

function buscar_novo_modelo(){
    var campo_modelo = document.getElementById("cadastroNovoModelo").value.trim();		
		fetch('http://localhost:81/controle_OS/sistema/php/busca_informacao.php?modelo=' + campo_modelo)
		.then(response => {// retorna a requisição fetch
			if (response.ok) {// se reornar ok
			return response.json();// converte num objeto json
			}
		})
		.then(json => {
			 if(json){
				alert("O modelo já é cadastrado!");
				 document.getElementById("cadastroNovoModelo").value = "";
			 };	
		})
		.catch(error => {	
			//alert('O sistema só pode ser acesado pelo servidor');
			//window.location.href='../php/expira_session.php';
		}); 
};

//********** VALIDA O MODELO A SER CADASTRADO NO FORMULARIO DE NOVO MODELO

function validar_modelo(){
    var campo_modelo = document.getElementById("modelo").value.trim();
	if(campo_modelo =="" || campo_modelo.length < 2 ){
		alert('Digite pelo menos dois caracteres para cadastrar o novo modelo!');
		return false;	
	}else{		
		fetch('http://localhost:81/controle_OS/sistema/php/busca_informacao.php?modelo=' + campo_modelo)
		.then(response => {// retorna a requisição fetch
			if (response.ok) {// se reornar ok
			return response.json();// converte num objeto json
			}
		})
		.then(json => {
			 if(json){
				alert("O modelo já é cadastrado!");
				document.getElementById("modelo").value = "";
				return false;	
			 }else{
			 	window.location.href = 'http://localhost:81/controle_OS/sistema/php/cadastrar_aparelho_marca_estado.php?novo-modelo=' + campo_modelo;
			 };	
		})
		.catch(error => {
			//alert('O sistema só pode ser acesado pelo servidor');
			//window.location.href='../php/expira_session.php';
		}); 
	};
};

//********** BUSCA PELO MODELO PESQUISADO

function buscar_modelo(){
	let texto5 = document.getElementById('modelo_busca').value;
	if(texto5 =="" || texto5.length < 2 ){
		alert('Digite pelo menos dois caracteres para pesquisar pelo modelo!');
		return false;	
	}else{
		fetch('http://localhost:81/controle_OS/sistema/php/busca_informacao.php?modelo=' + texto5)
		.then(response => {// retorna a requisição fetch
			if (response.ok) {// se reornar ok
			return response.json();// converte num objeto json
			}
		})
		.then(json => {
			let codigo_modelo = document.getElementById('codigoModelo');
			let mascara_modelo = document.getElementById('altModelo');
			let nome_modelo = document.getElementById('modelo_alt');
			 if(json){
				mascara_modelo.style.display = "block";
				nome_modelo.value = json.modelo ;
				codigo_modelo.value = json.codigo;
			 }else{
				document.getElementById('modelo_busca').value = "";
				mascara_modelo.style.display = "none";
				alert("O modelo não foi encontrado!");
			 }		
		})
		.catch(error => {
			//alert('O sistema só pode ser acesado pelo servidor');
			//window.location.href='../php/expira_session.php';
		}); 
	};
};

//----------------------------------------------------------------------------------------------------------

//********** MOSTRA INFORMACOES NO MODAL DE CONFIGURACOES GERAL

function verificaConfiguracoes(){
	let codigoConfig = '1';
	fetch('http://localhost:81/controle_OS/sistema/php/busca_informacao.php?oficina=' + codigoConfig)
	.then(response => {// retorna a requisição fetch
		if (response.ok) {// se reornar ok
			return response.json();// converte num objeto json
		}
	})
	.then(json => {
		if(json.nome != ""){
			document.getElementById('div_form_configuracao').style.display = 'block';
			document.getElementById('nomeOficina').value = json.oficina;
			document.getElementById('telefoneOficina').value = json.telefone;
			document.getElementById('telefone2Oficina').value = json.telefone2;
			document.getElementById('enderecoOficina').value = json.endereco;
			document.getElementById('usuarioOficina').value = json.usuario;
			document.getElementById('rodapeOficina').value = json.rodape;
			document.getElementById('contaOsOficina').value = json.cont_os;
			document.getElementById('idadeMinimaOficina').value = json.idadeMinima;
			document.getElementById('idadeMaximaOficina').value = json.idadeMaxima;
			document.getElementById("logo_imagem").style.display = "block";
			document.getElementById("imagem_logo").src = '../imagem_cliente/'+json.img_logo;
			if(json.maiuscula =="sim"){
				document.getElementById('maiusculaOficina').checked = true;
			}else{
				document.getElementById('maiusculaOficina').checked = false;
			};
			if(json.zeros =="sim"){
				document.getElementById('zerosOficina').checked = true;
			}else{
				document.getElementById('zerosOficina').checked = false;
			};
			if(json.os_auto =="sim"){
				document.getElementById('osAutoOficina').checked = true;
				document.getElementById('divContaOs').style.display = "block";
			}else{
				document.getElementById('osAutoOficina').checked = false;
				document.getElementById('divContaOs').style.display = "none";
			};
			if(json.escolha =="sim"){
				document.getElementById('tecnicoOficina').checked = true;
			}else{
				document.getElementById('tecnicoOficina').checked = false;
			};
			if(json.logomarca =="sim"){
				document.getElementById('logomarcaOficina').checked = true;
			}else{
				document.getElementById('logomarcaOficina').checked = false;
			};
			if(json.sem_acento =="1"){
				document.getElementById('acentoOficina').checked = true;
			}else{
				document.getElementById('acentoOficina').checked = false;
			};
		}
	})
	.catch(error => {
	}); 
};

//------------------------------------------------------------------------------------------------------------

//********** VALIDA O FORMULARIO DE INFORMACAO PESSOAL

function validarFormFunc(){
	let nomeFunc = document.getElementById("nomeFunc").value;
	let telFunc = document.getElementById("telFunc").value;
	let telFunc2 = document.getElementById('telFunc2').value;
	if(telFunc != "" && telFunc.length < 13){
		document.getElementById("telFunc").value = "";
		alert("O telefone está incompleto!");
		return false;
	};
	if(telFunc2 != "" && telFunc2.length < 13){
		document.getElementById('telFunc2').value = "";
		alert("O telefone 2 está incompleto!");
		return false;
	};	
	if(nomeFunc.length < 5 ){
		document.getElementById("nomeFunc").value = "";
		alert("O nome do funcionário está com menos de cinco caracteres!");
		return false;
	};	
};

//********** VALIDA O CAMPO CPF DO FORMULARIO PESSOAL

function Cpf_Funcionario(){
	let cpfFuncionario = document.getElementById("cpfFunc"); 
	if(cpfFuncionario.value.length < 14){
		if(cpfFuncionario.value.length > 0 ){
			alert("Digite novamente o cpf, dessa vez, digite completo!");
		}
		document.getElementById("cpfFunc").value ="";
		return false;
	}else{
		if(cpfFuncionario.value.length >0){
			if(cpfFuncionario.value.length == 14){
				cpfFuncionario2 = cpfFuncionario.value.replace(/[^\d]+/g,"");
				if (!isNaN(cpfFuncionario2)){
					var resultado2 = isValidCPF(cpfFuncionario2);
					if(resultado2 ===true){
						buscaCpfFuncionario();     
					}else{
						alert("O cpf " + cpfFuncionario.value + " é inválido!");
						document.getElementById("cpfFunc").value ="";
						return false;
					}; 
				};
			}else{
				cpfFuncionario.style.background = "#fff";
				cpfFuncionario.style.color ="#000";
			};
		};
	};
};

//********** FUNCAO VALIDA EMAIL DO FORMULARIO PESSOAL

function validaEmailFunc(){
	let email = document.getElementById("emailFunc").value.trim();
	if(email.length > 0){
		let re = /\S+@\S+\.\S+/;
		if(re.test(email)== false){
			alert("Email inválido!");
			document.getElementById("emailFunc").value = "";
		}
	}
}

//********** MOSTRA INFORMACOES PESSOAIS

function verificaFuncionario(){
	let texto = document.getElementById('buscaFuncionario').value;
	document.querySelector("#fotoFuncionario1").style.display ="none";
	document.querySelector("#fotoFuncionario2").style.display ="none";
	document.getElementById("excluirFotoFuncionario1").style.visibility ="hidden";
	document.getElementById("excluirFotoFuncionario2").style.visibility ="hidden";	
	let texto5 = texto.trim(); 
	fetch('http://localhost:81/controle_OS/sistema/php/busca_informacao.php?funcionario=' + texto5)
	.then(response => {// retorna a requisição fetch
		if (response.ok) {// se reornar ok
			return response.json();// converte num objeto json
		}
	})
	.then(json => {
		if(json.nome != ""){
			document.getElementById('cad_funcionario').style.display = "block";
			document.getElementById('codigoFunc').value = json.codigo;
			document.getElementById("nomeFunc").value = json.nome;
			document.getElementById("nomeFuncionario").innerHTML = json.usuario;
			
			document.getElementById("telFunc").value = json.telefone;
			document.getElementById('telFunc2').value = json.telefone2;
			document.getElementById("cpfFunc").value = json.cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/,"$1.$2.$3-$4");
			document.getElementById('enderecoFunc').value = json.endereco;
			document.getElementById('bairroFunc').value = json.bairro;
			document.getElementById('numeroFunc').value = json.numero;
			document.getElementById('cidadeFunc').value = json.cidade;
			document.getElementById('dataNascimentoFunc').value = json.data_nascimento;
			document.getElementById("emailFunc").value = json.email;
			document.getElementById('barraFunc').value = json.barra_funcionario;
			document.getElementById('dataCadastroFunc').value = json.data_cadastro;
			document.getElementById('obsFunc').value = json.obs;
			document.getElementById('pagina_func').value = json.pagina;
			if(json.protegido =="sim"){
				servidor();
			}
			if(json.ordem =="DESC"){
				document.getElementById('desc_func').checked = true;
				document.getElementById('asc_func').checked = false;
			}else{
				document.getElementById('desc_func').checked = false;
				document.getElementById('asc_func').checked = true;
			};
			if(json.semCronometro =="sim"){
				document.getElementById('semCronometro_func').checked = true;
			}else{
				document.getElementById('semCronometro_func').checked = false;
			};
			if(json.protegido =="sim"){
				document.getElementById('protegido').checked = true;
			}else{
				document.getElementById('protegido').checked = false;
			};
			if(json.tema =="claro"){
				document.getElementById('tema_func').checked = true;
			}else{
				document.getElementById('tema_func').checked = false;
			};
			if(json.ordenacao =="nome"){
				document.getElementById('col_nome_func').checked = true;
			};
			if(json.ordenacao =="ordemServico"){
				document.getElementById('col_os_func').checked = true;
			};
			if(json.ordenacao =="codigo"){
				document.getElementById('col_id_func').checked = true;
			};
			
			let nova = new Date(json.data_nascimento);
			let idade = Math.floor((Date.now() - nova)/(31557600000));
			document.getElementById('idade2Func').innerText = idade;			
			document.getElementById("botaoLimpar4").style.display = "block";
			document.getElementById("botaoLimpar5").style.display = "block";
			document.getElementById("nomeFunc").innerText = json.usuario;
			if(json.foto_funcionario != ""){
				document.getElementById("fotoFuncionario1").style.display="block";
				document.getElementById("fotoFuncionario1").src = '../imagem_funcionario/'+json.foto_funcionario;
				document.getElementById("excluirFotoFuncionario1").style.visibility ="visible";
			}
			if(json.foto_funcionario2 != ""){
				document.getElementById("fotoFuncionario2").style.display="block";
				document.getElementById("fotoFuncionario2").src = '../imagem_funcionario/'+json.foto_funcionario2;
				document.getElementById("excluirFotoFuncionario2").style.visibility ="visible";
			}
		}
	})
	.catch(error => {
		alert("Erro ao buscar o funcionário!");
		document.getElementById('buscaFuncionario').value ="";
		document.getElementById('buscaFuncionario').focus();
		//alert('O sistema só pode ser acesado pelo servidor');
		//window.location.href='../php/expira_session.php';
	}); 
};

//-----------------------------------------------------------------------------------------------------------

//********** VALIDA O CAMPO CPF DO FORMULARIO DE CADASTRO

function Cpf_Alteracao(){
	
	if(document.getElementById("cpfAlteracaoAlt").value.length < 14){
		if(document.getElementById("cpfAlteracaoAlt").value.length > 0 ){
			alert("Digite novamente o cpf, dessa vez, digite completo!");
		}
		document.getElementById("cpfAlteracaoAlt").value ="";
		document.getElementById("cpfAlteracaoAlt").style.background = "#fff";		
		reabilitaBotoes();
	}else{
		if(document.getElementById("cpfAlteracaoAlt").value.length >0){
			if(document.getElementById("cpfAlteracaoAlt").value.length == 14){
				cpfAlteracao2 = document.getElementById("cpfAlteracaoAlt").value.replace(/[^\d]+/g,"");
				if (!isNaN(cpfAlteracao2)){
					var resultado2 = isValidCPF(cpfAlteracao2);
					if(resultado2 ===true){
						buscaCpfAlteracao();
					}else{
						alert("O cpf " + cpfAlteracao.value +", é inválido!");
						reabilitaBotoes();
						cpfAlteracao.value ="";						
					}; 
				};
			}else{
				cpfAlteracao.style.background = "#fff";
				cpfAlteracao.style.color ="#000";
			};
		};
	};
};

//********** BUSCA NO BANCO POR CPF CADASTRADO

function buscaCpfAlteracao(){
	
	let cpfAlteracao = document.getElementById("cpfAlteracaoAlt").value;
	cpfAlteracao = cpfAlteracao.replace(/[^\d]+/g, '');
	fetch('http://localhost:81/controle_OS/sistema/php/busca_informacao.php?buscaCPF=' + cpfAlteracao)
	.then(response => {
		if (response.ok) {
		return response.json();
		}
	})
	.then(json => {
		if(json > 0){
			reabilitaBotoes();
			
			document.getElementById("cpfAlteracaoAlt").value ="";
			alert("O cpf - "+ cpfAlteracao +", já é cadastrado!");

		}else{
			reabilitaBotoes();
		};
	})
	.catch(error => {
		//alert('O sistema só pode ser acesado pelo servidor');
		//window.location.href='../php/expira_session.php';
	}); 
};

//********** VALIDA O CAMPO DATA DE ENTRADA DO FORMULARIO DE CADASTRO

function validaDtEntrada(d){
   	let data = document.getElementById("dtEntrada").value; // pega o valor do input
   	let nova = new Date(data);

   	let idade = Math.floor((Date.now() - nova)/(31557600000));
    if(idade > 5){	
    	document.getElementById("dtEntrada").value = "";
		document.getElementById("dtEntrada").style.background = "#fff";			
		alert("Não cadastra aparelho com data de entrada há mais cinco anos atráz");
		exit;
	};	
   	if(data.length < 10){
	 alert("Data de entrada inválida");
	   	document.getElementById("dtEntrada").value = "";
	   	document.getElementById("dtEntrada").style.background = "#fff";
	   	exit;
   	};
   	data = data.replace(/\//g, "-"); 
   	var data_array = data.split("-"); 
   	var dia = data_array[2];
   	var mes = data_array[1];
   	var ano = data_array[0];
   	if(data_array[0].length != 4){
   		dia = data_array[0];
      	mes = data_array[1];
      	ano = data_array[2];
   	}
   	var hoje = new Date();
   	var d1 = hoje.getDate();
   	var m1 = hoje.getMonth()+1;
   	var a1 = hoje.getFullYear();
   	var d1 = new Date(a1, m1, d1);
   	var d2 = new Date(ano, mes, dia);
   	var diff = d2.getTime() - d1.getTime();
   	diff = diff / (1000 * 60 * 60 * 24);
   	if(diff > 0){
      	alert("Data de entrada não pode ser maior ao dia de hoje!");
      	document.getElementById("dtEntrada").value = "";
      	document.getElementById("dtEntrada").style.background = "#fff";
   	};
};

//********** FUNCAO VALIDA EMAIL NO FORMULARIO DE CADASTRO

function validaEmailUsuario(){
	let emailAlt = document.getElementById("emailAlt").value.trim();
	
	if(emailAlt.length > 0){
		let re = /\S+@\S+\.\S+/;
		if(re.test(emailAlt)== true){
			//emailAlt = document.getElementById("emailAlt").value.trim();
			fetch('http://localhost:81/controle_OS/sistema/php/busca_informacao.php?buscaEmailAlt=' + emailAlt)
			.then(response => {
				if (response.ok) {
				return response.json();
				}
			})
			.then(json => {
				if(json > 0){
					alert("O e-mail - "+ emailAlt +", já é cadastrado!");
					document.getElementById("emailAlt").value ="";
				};
			})
			.catch(error => {
				//alert('O sistema só pode ser acesado pelo servidor');
				//window.location.href='../php/expira_session.php';
			}); 
		}else{
			alert("Email inválido!");
			document.getElementById("emailAlt").value = "";
		}
	}
}  

//********** VALIDA O FORMULARIO DE CADASTRO

function validarForm(){
	
	let placaN = document.getElementById("placaNormalAlt").value;
	let placaM = document.getElementById("placaMercosulAlt").value;
	let renavam = document.getElementById("renavamAlt").value;
	let imeiAlt = document.getElementById("imeiAlt").value;

	// valida os campos imei e renavam
	if(imeiAlt.length > 0 && (placaN.length > 0 ||  placaM.length > 0 || renavam.length > 0) ){
		document.getElementById("imeiAlt").value = "";
		alert("O campo imei não pode ser aceitável,\nse o(s) campo(s) placa normal ou placa mercosul,\nou renavam estiver(em) preenchido(s) ");
		return false;
	}
	// valida o campo imei
	if(imeiAlt.length > 0 && imeiAlt.length < 15 ){
		document.getElementById("imeiAlt").value = "";
		alert("imei inválido");
		return false;
	}
	// valida o campo renavam
	if(renavam.length > 0 && renavam.length < 9){
		document.getElementById("renavamAlt").value="";
		alert("Renavam inválido");
		return false;
	}
	
	// valida o campo ordem de servico
	let ordemServicoAlt = document.getElementById('ordemServicoAlt').value;
	if(ordemServicoAlt.trim() == ""){
		document.getElementById('ordemServicoAlt').value = "";
		alert("O campo ordem de serviço não foi preenchido");
		return false;
	};

	// valida o campo telefone 1
	let telefoneAlt = document.getElementById('telefoneAlt').value;
	if(telefoneAlt != "" && telefoneAlt.length < 13){
		document.getElementById("telefoneAlt").value = "";
		alert("O telefone está incompleto");
		return false;
	};

	// valida o campo telefone 2
	let telefone2Alt = document.getElementById('telefone2Alt').value;
	if(telefone2Alt != "" && telefone2Alt.length < 13){
		document.getElementById("telefone2Alt").value = "";
		alert("O telefone 2 está incompleto");
		return false;
	};
	
	// valida o campo defeito
	let defeitoAlt = document.getElementById('defeitoAlt').value;
	if(defeitoAlt.trim() == "" || defeitoAlt.length < 5){
		document.getElementById('defeitoAlt').value = "";
		alert("Campo defeito com menos de cinco caracteres!");
		return false;
	};
	
	// valida o campo nome
	let nomeAlt = document.getElementById('nomeAlt').value;
	if(nomeAlt.trim() == "" || nomeAlt.length < 3){
		document.getElementById("nomeAlt").value = "";
		alert("Campo nome com menos de tres caracteres!");
		return false;
	};
	
	// valida os campos aparelho e novo aparelho
	let aparelhoAlt = document.getElementById('aparelhoAlt').value;
	let novoAparelhoAlt = document.getElementById('novoAparelhoAlt').value;
	// primeira validacao de aparelho
	if(aparelhoAlt != "" && novoAparelhoAlt != ""){
		alert("Campo aparelho e novo aparelho em uso!");
		return false;
	};
	// segunda validacao de aparelho
	if(aparelhoAlt.trim() == "" && novoAparelhoAlt.trim() == ""){
		alert("Campos aparelho e novo aparelho em branco!");
		return false;
	};
	// terceira validacao de aparelho
	if(aparelhoAlt.trim() == "" && novoAparelhoAlt.length < 2){
		document.getElementById('novoAparelhoAlt').value = "";
		alert("Campo novo aparelho com menos de dois caracteres!");
		return false;
	};
	
	// valida os campos marca e nova marca
	let marcaAlt = document.getElementById("marcaAlt").value;
	let novaMarcaAlt = document.getElementById("novaMarcaAlt").value;
	// primeira validacao de marca
	if(marcaAlt != "" && novaMarcaAlt != ""){
		alert("Campo marca e novo marca em uso!");
		return false;
	};
	//segunda validacao de marca
	if(marcaAlt.trim() == "" && novaMarcaAlt.trim() == ""){
		alert("Campo marca e nova marca em branco!");
		return false;
	};
	// terceira validacao de marca
	if(marcaAlt.trim() == "" && novaMarcaAlt.length < 2){
		document.getElementById("novaMarcaAlt").value = "";
		alert("Campo nova marca com menos de dois caracteres!");
		return false;
	};
	
	// valida os campos modelo e novo modelo
	let modeloAlt = document.getElementById('modeloAlt').value;
	let novoModeloAlt = document.getElementById('novoModeloAlt').value;
	// primeira validacao de modelo
	if(modeloAlt != "" && novoModeloAlt != ""){
		alert("Campo modelo e novo modelo em uso!");
		return false;
	};
	// segunda validacao de modelo
	if(modeloAlt.trim() == "" && novoModeloAlt.trim() == ""){
		alert("Campo modelo e novo modelo em branco!");
		return false;
	};
	// terceira validacao de modelo
	if(modeloAlt.trim() == "" && novoModeloAlt.length < 2){
		document.getElementById('novoModeloAlt').value = "";
		alert("Campo novo modelo com menos de dois caracteres!");
		return false;
	};
}
	  
//********** FUNÇÃO QUE BUSCA INFORMAÇÃO DO CADASTRO DE USUÁRIO NO BANCO

function buscaNoBanco(){
	document.getElementById('campoAparelho').style.display='none';
	document.getElementById('campoMarca').style.display='none';
	document.getElementById('campoModelo').style.display='none';
	document.getElementById("fotoCliente1").style.display='none';
	document.getElementById("fotoCliente2").style.display='none';
	document.getElementById("fotoCliente3").style.display='none';
	// Pega o valor do Codigo para preencher os formularios Ver Cadastro, Alterar Cadastro e Aterar retorno 1, 2, 3
	let texto = document.getElementById('codigoAlt').value;

	fetch('http://localhost:81/controle_OS/sistema/php/busca_informacao.php?busca=' + texto)
	.then(response => {// retorna a requisição fetch
		if (response.ok) {// se reornar ok

		return response.json();// converte num objeto json
		}
	})
	.then(json => {
		
		//********** INICIO DO FORMULARIO ALTERAR CADASTRO **********

		// filtra as horas de entrada que vem do banco no formato datetime
	/*	let controleEntrada = json.controle_entrada;
		let controleEntradaObj = new Date(controleEntrada.replace(" ","T"));
		let controleEntradaHora = controleEntradaObj.getHours();
		let controleEntradaMinuto = controleEntradaObj.getMinutes();
		let controleEntradaFormatada = String(controleEntradaHora).padStart(2, '0') + ':'+ String(controleEntradaMinuto).padStart(2, '0');
		*/
		//document.getElementById("horaEntrada").style.visibility = "visible";
		//document.getElementById("horaEntrada").innerHTML = controleEntradaFormatada;
		//document.getElementById("horaVerEntrada").innerHTML = controleEntradaFormatada;
		// filtra as horas de saida que vem do banco no formato datetime
		//let entradaFormatada = json.controle_entrada.date('d-m-Y H:i');
/*
		let controleSaidaFormatada = '';
		if(json.controle_saida != '0000-00-00 00:00:00'){
			let controleSaida = json.controle_saida;
			let controleSaidaObj = new Date(controleSaida.replace(" ","T"));
			let controleSaidaHora = controleSaidaObj.getHours();
			let controleSaidaMinuto = controleSaidaObj.getMinutes();
			controleSaidaFormatada = String(controleSaidaHora).padStart(2, '0') + ':'+ String(controleSaidaMinuto).padStart(2, '0');
			
			//document.getElementById("horaSaida").style.visibility = "visible";
			//document.getElementById("horaSaida").innerHTML = controleSaidaFormatada;
			//document.getElementById("horaVerSaida").innerHTML = controleSaidaFormatada;
		};
		*/

		
		

		document.getElementById("textoForm").innerHTML = "Alterar Cadastro";
		if(document.getElementById('form_alteracao').style.display=='block'){
			let resultadoOS = document.getElementById('zerosAlt').value;
			if(resultadoOS = document.getElementById('zerosAlt').value == "sim"){
				// mostra a OS sem zeros
				document.getElementById("ordemServicoAlt").value = json.ordemServico;
			}else{
				// mostra a OS com zeros a esquerda
				document.getElementById("ordemServicoAlt").value = ("0000000" + json.ordemServico).slice(-7);
			}		
			document.getElementById("nomeAlt").value = json.nome;
			document.getElementById("telefoneAlt").value = json.telefone;
			document.getElementById("telefone2Alt").value = json.telefone2;
			document.getElementById("codigoLigar").value = json.codigo;
			if(json.telefone !=""){
				document.getElementById('botaoLigar').style.visibility ="visible";
				document.getElementById('telefone11').innerText = json.telefone;
			}
			if((json.telefone2 !="") && (json.data_ligacao5 == "0000-00-00")){
				document.getElementById('botaoLigar').style.visibility ="visible";
				document.getElementById('telefoneLigar2').style.visibility = "visible";
				document.getElementById('telefone22').innerText = json.telefone2;
			}else{
				document.getElementById('telefoneLigar2').style.visibility = "hidden";
				//document.getElementById('telefone22').innerText = json.telefone2;
			}
			document.getElementById("cpfAlteracaoAlt").value = json.cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/,"$1.$2.$3-$4");
			document.getElementById('enderecoAlt').value = json.endereco;
			document.getElementById('dtNascimentoAlt').value = json.dtNascimentoAlt;
			document.getElementById("emailAlt").value = json.email;
			document.getElementById("estadoAlt").value = json.estado;			
			if(json.estado != "APARELHO SAIU" && json.estado != "DEVOLVEU" && json.estado != "COMPROU" && json.estado != "DOOU" && json.estado != "SUMIU" && json.estado != "ABANDONOU" && json.estado != "VENDEU" && json.estado != "DICA"){	
			}else{
				document.getElementById("estadoAlt").style.display='none';
				document.getElementById("estadoNaoModificavel").style.display='block';
				document.getElementById("estadoNaoModificavel").value = json.estado;
				document.getElementById("aparelhoAlt").style.display='none';
				document.getElementById("aparelhoNaoModificavel").style.display='block';
				document.getElementById("aparelhoNaoModificavel").value = json.aparelho;
				document.getElementById("marcaAlt").style.display='none';
				document.getElementById("marcaNaoModificavel").style.display='block';
				document.getElementById("marcaNaoModificavel").value = json.marca;
				document.getElementById("modeloAlt").style.display='none';
				document.getElementById("modeloNaoModificavel").style.display='block';
				document.getElementById("modeloNaoModificavel").value = json.modelo;
				
			}
			
			document.getElementById("aparelhoAlt").value = json.aparelho;
			document.getElementById("marcaAlt").value = json.marca;
			document.getElementById("modeloAlt").value = json.modelo;
			document.getElementById('numeroSerieAlt').value = json.numeroSerie;
			document.getElementById('chassiAlt').value = json.chassi;
			document.getElementById("imeiAlt").value = json.imei;
			if(json.placa.length < 8){
				document.getElementById('placaMercosulAlt').value = json.placa;
				//placaMercosulAlt.value = json.placa;

			}else{
				document.getElementById('placaNormalAlt').value = json.placa;
				//placaNormalAlt.value = json.placa;
			};
			document.getElementById("renavamAlt").value = json.renavam;
			document.getElementById("defeitoAlt").value = json.defeitoReclamado;
			document.getElementById('acessorioAlt').value = json.acessorio;
			document.getElementById('observacaoAlt').value = json.observacao;
			document.getElementById("barraAlt").value = json.barra_cliente;
			document.getElementById('dataEntradaAlt').value = json.dataEntrada;
			document.getElementById('dataProntoAlt').value = json.dataPronto;
			document.getElementById('dataSaidaAlt').value = json.dataSaida;
			document.getElementById('materialAlt').value = json.material;
			document.getElementById("orcamentoAlt").value = (json.orcamento - 0).toLocaleString('pt-br', {minimumFractionDigits: 2});
			document.getElementById("descontoAlt").value = (json.desconto - 0).toLocaleString('pt-br', {minimumFractionDigits: 2});
			document.getElementById('valorObjeto').value = (json.infoCliente - 0).toLocaleString('pt-br', {minimumFractionDigits: 2});
			let totalPagamento =  (json.orcamento - json.desconto).toLocaleString('pt-br', {minimumFractionDigits: 2});
			comDescontoAlt.value = totalPagamento;
			document.getElementById("totalPagarAlt").value = totalPagamento;
			document.getElementById("valorPecaAlt").value = (json.valorPeca - 0).toLocaleString('pt-br', {minimumFractionDigits: 2});
			document.getElementById("materialAuxiliarAlt").value = (json.materialAuxiliar - 0).toLocaleString('pt-br', {minimumFractionDigits: 2});
			document.getElementById("transporteAlt").value = (json.transporte - 0).toLocaleString('pt-br', {minimumFractionDigits: 2}); 
			document.getElementById("lucroAlt").value = (json.orcamento - json.desconto - json.valorPeca - json.materialAuxiliar - json.transporte).toLocaleString('pt-br', {minimumFractionDigits: 2});
			if(json.aPrazo != ""){
				document.getElementById("aPrazoAlt").checked = true;
				document.getElementById("checkPrazo").style.visibility ="visible";
				document.getElementById("inicialAlt").value = (json.inicial - 0).toLocaleString('pt-br', {minimumFractionDigits: 2});
				document.getElementById("restanteAlt").value = (json.restante - 0).toLocaleString('pt-br', {minimumFractionDigits: 2});
				document.getElementById("dataPagamentoAlt").value = json.dataPagamento;
				document.getElementById("dataPagamentoAlt").style.visibility ="visible";
				document.getElementById("pagarRestante").style.visibility ="visible";
				document.getElementById("campoPagou").style.visibility ="visible";				
			}
			if(json.pagou != ""){
				document.getElementById("pagouAlt").checked = true;
				document.getElementById("dataPagou").style.visibility ="visible";
				document.getElementById("dataPagouAlt").value = json.dataPagou;
				
			}
			if(json.cartao != ""){
				document.getElementById("cartaoAlt").checked = true;
				document.getElementById("campoCartaoAlt").style.visibility ="visible";
				document.getElementById("escolhaCartaoAlt").options[0].text = json.tipoCartao;
				document.getElementById("bandeiraCartaoAlt").options[0].text = json.bandeira_cartao;
				document.getElementById("parcelasCartaoAlt").value = json.parcelasCartao;
				document.getElementById("valorParcelas").value = (json.restante / json.parcelasCartao).toLocaleString('pt-br', {maximumFractionDigits: 2});	    
				document.getElementById("jurosCartaoAlt").value = (json.jurosCartao - 0).toLocaleString('pt-br', {minimumFractionDigits: 2}); 
				document.getElementById("somaJurosAlt").value = (json.jurosCartao * json.parcelasCartao).toLocaleString('pt-br', {minimumFractionDigits: 2});
				document.getElementById("orcComJurosAlt").value = ((json.orcamento - json.desconto)+(json.jurosCartao * json.parcelasCartao)).toLocaleString('pt-br', {minimumFractionDigits: 2});	
				document.getElementById("inicialAlt").value = (json.inicial - 0).toLocaleString('pt-br', {minimumFractionDigits: 2});
				document.getElementById("restanteAlt").value = (json.restante - 0).toLocaleString('pt-br', {minimumFractionDigits: 2});;
				document.getElementById("inicialAlt").setAttribute("required","required");
				document.getElementById("restanteAlt").setAttribute("required","required");
				document.getElementById("checkPrazo").style.visibility ="visible";
				document.getElementById("campoPagou").style.visibility ="hidden";
				document.getElementById("pagarRestante").style.visibility ="hidden";
				document.getElementById("dataPagamentoAlt").removeAttribute("required","required");
				document.getElementById("dataPagamentoAlt").style.visibility ="hidden";
				if(json.tipoCartao == "CRÉDITO"){
					document.getElementById("camposCartao").style.visibility = "visible";
				}
				if(json.tipoCartao == "CRÉDITO" || json.tipoCartao == ""){
					document.getElementById("escolhaCartaoAlt").setAttribute("required","required");
					document.getElementById("parcelasCartaoAlt").setAttribute("required","required");
					document.getElementById("valorParcelas").setAttribute("required","required");
					document.getElementById("jurosCartaoAlt").setAttribute("required","required");
					document.getElementById("dataPagamentoAlt").removeAttribute("required","required");
					document.getElementById("inicialAlt").setAttribute("required","required");
					document.getElementById("restanteAlt").setAttribute("required","required");
				}
			}else{
				document.getElementById("escolhaCartaoAlt").value = "";
				document.getElementById("bandeiraCartaoAlt").value = "";
			}
			if(json.foto1 != ""){
				document.getElementById("fotoCliente1").style.display='block';
				document.getElementById("fotoCliente1").src = '../imagem_cliente/'+json.foto1;
				document.getElementById("excluirFoto1").style.visibility ="visible"; 
				document.getElementById("fotoCliente1").title ="Clique para ampliar a imagem";	
			}
			if(json.foto2 != ""){
				document.getElementById("fotoCliente2").style.display='block';
				document.getElementById("fotoCliente2").src ='../imagem_cliente/'+ json.foto2; 
				document.getElementById("excluirFoto2").style.visibility ="visible";
				document.getElementById("fotoCliente2").title ="Clique para ampliar a imagem";
			}			
			if(json.foto3 != ""){
				document.getElementById("fotoCliente3").style.display='block';
				document.getElementById("fotoCliente3").src ='../imagem_cliente/'+ json.foto3; 
				document.getElementById("excluirFoto3").style.visibility ="visible"; 
				document.getElementById("fotoCliente3").title ="Clique para ampliar a imagem";
			}
			if(json.data_ligacao1 != "0000-00-00"){
				document.getElementById("Ligacao1").style.display="block";
				document.getElementById("telefone11").innerText = json.telefone;
				document.getElementById("qantidade_ligacao").innerText = "1";
				document.getElementById("dataLigou1").innerText ="Data : " + json.data_ligacao1.split('-').reverse().join('/');
				document.getElementById("horaLigou1").innerText ="Hora : " + json.hora_ligacao1.split('-').reverse().join('/');;
				document.getElementById("telefoneLigou1").innerText ="Telefone : " + json.telefone_ligado1;			
				if(json.atendeu1 == "sim"){
					document.getElementById("atendeu1").innerText ="Atendeu : "+ json.atendeu1;
				}else{
					document.getElementById("atendeu1").innerText ="Atendeu : não";
				}				
				document.getElementById("quemLigou1").innerText ="Q. Ligou: "+ json.quem_ligou1;				
				if(json.quem_atendeu1 != ""){
					document.getElementById("quemAtendeu1").innerText ="Q. Atendeu : "+ json.quem_atendeu1;
				}else{
					document.getElementById("quemAtendeu1").innerText ="Q. Atendeu : ninguém";
				}		
			}else{
				document.getElementById("Ligacao1").style.display="none";
			}
			if(json.data_ligacao2 != "0000-00-00"){
				document.getElementById("Ligacao2").style.display="block";
				document.getElementById("dataLigou2").innerText ="Data : " + json.data_ligacao2.split('-').reverse().join('/');;
				document.getElementById("horaLigou2").innerText ="Hora : " + json.hora_ligacao2.split('-').reverse().join('/');;
				document.getElementById("qantidade_ligacao").innerText = "2";
				document.getElementById("telefoneLigou2").innerText ="Telefone : " + json.telefone_ligado2;
				if(json.atendeu2 == "sim"){
					document.getElementById("atendeu2").innerText ="Atendeu : " + json.atendeu2;
				}else{
					document.getElementById("atendeu2").innerText ="Atendeu : não";
				};	
				document.getElementById("quemLigou2").innerText ="Q. Ligou : " + json.quem_ligou2;				
				if(json.quem_atendeu2 != ""){
					document.getElementById("quemAtendeu2").innerText ="Q. Atendeu : " + json.quem_atendeu2;
				}else{
					document.getElementById("quemAtendeu2").innerText ="Q. Atendeu : ninguém";
				};
			}else{
				document.getElementById("Ligacao2").style.display="none";
			}
			if(json.data_ligacao3 != "0000-00-00"){
				document.getElementById("Ligacao3").style.display="block";
				document.getElementById("dataLigou3").innerText ="Data : " + json.data_ligacao3.split('-').reverse().join('/');;
				document.getElementById("horaLigou3").innerText ="Hora : " + json.hora_ligacao3.split('-').reverse().join('/');;
				document.getElementById("qantidade_ligacao").innerText = "3";
				document.getElementById("telefoneLigou3").innerText ="Telefone : " + json.telefone_ligado3;
				if(json.atendeu3 == "sim"){
					document.getElementById("atendeu3").innerText ="Atendeu : " + json.atendeu3;
				}else{
					document.getElementById("atendeu3").innerText ="Atendeu : não";
				};
				document.getElementById("quemLigou3").innerText ="Q. Ligou : "+ json.quem_ligou3;				
				if(json.quem_atendeu3 != ""){
					document.getElementById("quemAtendeu3").innerText ="Q. Atendeu : " + json.quem_atendeu3;
				}else{
					document.getElementById("quemAtendeu3").innerText ="Q. Atendeu : ninguém";
				};
			}else{
				document.getElementById("Ligacao3").style.display="none";
			}
			if(json.data_ligacao4 != "0000-00-00"){
				document.getElementById("Ligacao4").style.display="block";
				document.getElementById("dataLigou4").innerText ="Data : " + json.data_ligacao4.split('-').reverse().join('/');;
				document.getElementById("horaLigou4").innerText ="Hora : " + json.hora_ligacao4.split('-').reverse().join('/');;
				document.getElementById("qantidade_ligacao").innerText = "4";
				document.getElementById("telefoneLigou4").innerText ="Telefone : " + json.telefone_ligado4;
				if(json.atendeu4 == "sim"){
					document.getElementById("atendeu4").innerText ="Atendeu : " + json.atendeu4;
				}else{
					document.getElementById("atendeu4").innerText ="Atendeu : não";
				};				
				document.getElementById("quemLigou4").innerText ="Q. Ligou : " + json.quem_ligou4;
				
				if(json.quem_atendeu4 != ""){
					document.getElementById("quemAtendeu4").innerText ="Q. Atendeu : " + json.quem_atendeu4;
				}else{
					document.getElementById("quemAtendeu4").innerText ="Q. Atendeu : ninguém";
				};
			}else{
				document.getElementById("Ligacao4").style.display="none";
			}
			if(json.data_ligacao5 != "0000-00-00"){
				document.getElementById("Ligacao5").style.display="block";
				document.getElementById("dataLigou5").innerText ="Data : " + json.data_ligacao5.split('-').reverse().join('/');
				document.getElementById("horaLigou5").innerText ="Hora : " + json.hora_ligacao5.split('-').reverse().join('/');
				document.getElementById("telefoneLigou5").innerText ="Telefone : " + json.telefone_ligado5;
				document.getElementById("qantidade_ligacao").innerText = "5";
				document.getElementById("formulario_Ligacao").style.visibility = "hidden";
				if(json.atendeu5 == "sim"){
					document.getElementById("atendeu5").innerText ="Atendeu : " + json.atendeu5;
				}else{
					document.getElementById("atendeu5").innerText ="Atendeu : não";
				};				
				document.getElementById("quemLigou5").innerText ="Q. Ligou : " + json.quem_ligou5;
				
				if(json.quem_atendeu5 != ""){
					document.getElementById("quemAtendeu5").innerText ="Q. Atendeu : " + json.quem_atendeu5;
				}else{
					document.getElementById("quemAtendeu5").innerText ="Q. Atendeu : ninguém";
				};
			}else{
				document.getElementById("Ligacao5").style.display="none";
				document.getElementById("formulario_Ligacao").style.visibility = "visible";
			}			
			document.getElementById("barraAlt").innerText = json.barra_cliente;
		}
		  
		//********** INICIO DE VER CADASTRO **********
		  
		if(document.getElementById('ver_cadastro').style.display =='block'){
			if(resultadoOS = document.getElementById('zerosAlt').value == "sim"){
				document.getElementById('ordemServicoVer').value = json.ordemServico;
			}else{
				document.getElementById('ordemServicoVer').value = ("0000000" + json.ordemServico).slice(-7);
			}
			document.getElementById('codigoVer').value = json.codigo;
			document.getElementById('nomeVer').value = json.nome;
			document.getElementById('telefoneVer').innerText = json.telefone;
			document.getElementById('telefone2Ver').innerText = json.telefone2;
			document.getElementById('cpfVer').innerText = json.cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/,"$1.$2.$3-$4");
			document.getElementById('enderecoVer').value = json.endereco;
			if(json.dtNascimentoAlt != "0000-00-00"){
				document.getElementById('dtNascimentoVer').innerText = json.dtNascimentoAlt.split('-').reverse().join('/');
			}
			document.getElementById('emailVer').innerText = json.email;
			document.getElementById('aparelhoVer').innerText = json.aparelho;
			document.getElementById('marcaVer').innerText = json.marca;
			document.getElementById('modeloVer').innerText = json.modelo;
			document.getElementById('numeroSerieVer').innerText = json.numeroSerie;
			document.getElementById('chassiVer').innerText = json.chassi;
			document.getElementById('imeiVer').innerText = json.imei;
			document.getElementById('placaVer').innerText = json.placa;
			document.getElementById('renavamVer').innerText = json.renavam;
			document.getElementById('estadoVer').innerText = json.estado;
			let dataEnt = json.dataEntrada;
			let dataEntInvertida = dataEnt.replace(/(\d{4})-(\d{2})-(\d{2}) (\d{2}:\d{2}).*/, '$3/$2/$1 $4');
			document.getElementById('dataEntradaVer').innerText = dataEntInvertida;
			document.getElementById('tecnicoVer').innerText = json.tecnico;
			document.getElementById('defeitoVer').value = json.defeitoReclamado;
			document.getElementById('acessorioVer').value = json.acessorio;
			document.getElementById('obsVer').value = json.observacao;
			if(json.dataPronto != "0000-00-00 00:00:00"){
				let dataPron = json.dataPronto;
				let dataPronInvertida = dataPron.replace(/(\d{4})-(\d{2})-(\d{2}) (\d{2}:\d{2}).*/, '$3/$2/$1 $4');
				document.getElementById('dtProntoVer').innerText = dataPronInvertida;
			}
			if(json.dataSaida != "0000-00-00 00:00:00"){
				let dataSai = json.dataPronto;
				let dataSaiInvertida = dataSai.replace(/(\d{4})-(\d{2})-(\d{2}) (\d{2}:\d{2}).*/, '$3/$2/$1 $4');
				document.getElementById('dtSaidaVer').innerText = dataSaiInvertida;
			}
			document.getElementById('barraVer').innerText = json.barra_cliente;
			document.getElementById('orcamentoVer').innerText =  Intl.NumberFormat('pt-br',{style:'currency',currency: 'BRL'}).format(json.orcamento);
			document.getElementById('valorObjetoVer').innerText =  Intl.NumberFormat('pt-br',{style:'currency',currency: 'BRL'}).format(json.infoCliente);
			document.getElementById('valorPecaVer').innerText =  Intl.NumberFormat('pt-br',{style:'currency',currency: 'BRL'}).format(json.valorPeca);
			document.getElementById('descontoVer').innerText =  Intl.NumberFormat('pt-br',{style:'currency',currency: 'BRL'}).format(json.desconto);
			document.getElementById('materialVer').value = json.material;
			document.getElementById('materialAuxiliarVer').innerText = Intl.NumberFormat('pt-br',{style:'currency',currency: 'BRL'}).format(json.materialAuxiliar) ;
			document.getElementById('transporteVer').innerText =  Intl.NumberFormat('pt-br',{style:'currency',currency: 'BRL'}).format(json.transporte); 
			document.getElementById('lucroVer').innerText = Intl.NumberFormat('pt-br',{style:'currency',currency: 'BRL'}).format((json.orcamento - json.desconto - json.valorPeca - json.materialAuxiliar - json.transporte)+(json.jurosCartao * json.parcelasCartao));
			document.getElementById('tipoCartaoVer').innerText = json.tipoCartao;
			document.getElementById('bandeiraCartaoVer').innerText = json.bandeira_cartao;
			document.getElementById('parcelasCartaoVer').innerText = json.parcelasCartao;
			document.getElementById('jurosCartaoVer').innerText =  Intl.NumberFormat('pt-br',{style:'currency',currency: 'BRL'}).format(json.jurosCartao);
			document.getElementById('somaJurosVer').innerText =	 Intl.NumberFormat('pt-br',{style:'currency',currency: 'BRL'}).format(json.jurosCartao * json.parcelasCartao);
			if(json.orcamento != '0.00'){
				document.getElementById('totalGeral').innerText = Intl.NumberFormat('pt-br',{style:'currency',currency: 'BRL'}).format((json.orcamento - json.desconto) + parseFloat(json.pecaRet1)+ parseFloat(json.pecaRet2)+ parseFloat(json.pecaRet3) + parseFloat(json.jurosCartao * json.parcelasCartao));
			
			}else{
				document.getElementById('totalGeral').innerText ='';
			}
			document.getElementById('verAlteracao').innerText = json.alteracao;
			document.getElementById('imprimir_ver').value = json.codigo;
			document.getElementById('idAlteracao').value = json.codigo;
			if(json.alteracao != ""){
				document.getElementById('botaoAlteracao').style.display ="block";
			}else{
				document.getElementById('botaoAlteracao').style.display ="none";
			}	
			// ********** VER RETORNO 1	
			if(json.dataRetorno1 != "0000-00-00 00:00:00"){	
				let dataRe1 = json.dataRetorno1;
				let dataRe1Invertida = dataRe1.replace(/(\d{4})-(\d{2})-(\d{2}) (\d{2}:\d{2}).*/, '$3/$2/$1 $4');		
				document.getElementById('dataEntradaRetorno1Ver').innerHTML = "Dt. Entrada " + dataRe1Invertida;
				if(json.dtProntoRet1 != "0000-00-00 00:00:00"){	
					let dataPr1 = json.dtProntoRet1;
					let dataPr1Invertida = dataPr1.replace(/(\d{4})-(\d{2})-(\d{2}) (\d{2}:\d{2}).*/, '$3/$2/$1 $4');
					document.getElementById('dataProntoRetorno1Ver').innerHTML = "Dt. Pronto " + dataPr1Invertida;
				}else{
					document.getElementById('dataProntoRetorno1Ver').innerHTML = "Dt. Pronto";	
				}
				if(json.saidaRetorno1 != "0000-00-00 00:00:00"){
					let dataSa1 = json.saidaRetorno1;
					let dataSa1Invertida = dataSa1.replace(/(\d{4})-(\d{2})-(\d{2}) (\d{2}:\d{2}).*/, '$3/$2/$1 $4');
					document.getElementById('dataSaidaRetorno1Ver').innerHTML = "Dt. Saída " + dataSa1Invertida;
				}else{
					document.getElementById('dataSaidaRetorno1Ver').innerHTML = "Dt. Saída";	
				}
				document.getElementById('novaOSRet1').innerHTML = "Nova OS " + json.novaOS1;
				document.getElementById('defeitoRet1').value = json.defRet1;
				document.getElementById('acessorioRet1').value = json.acessRet1;
				document.getElementById('obsRet1').value = json.obsRet1;
				document.getElementById('estadoRet1').innerHTML = "Est. " + json.estadoRetorno1 + '</span>';
				document.getElementById('pecaRet1').innerHTML = "Peça <span style='padding: 0 3%;background:#fffccc;'>" + Intl.NumberFormat('pt-br',{style:'currency',currency: 'BRL'}).format(json.pecaRet1)+ '</span>';
				document.getElementById('matRet1').value = json.matRet1;
				document.getElementById('verRet1').style.display = "block";
			}
			// ********** VER RETORNO 2
			if(json.dataRetorno2 != "0000-00-00 00:00:00"){	
				let dataRe2 = json.dataRetorno2;
				let dataRe2Invertida = dataRe2.replace(/(\d{4})-(\d{2})-(\d{2}) (\d{2}:\d{2}).*/, '$3/$2/$1 $4');				
				document.getElementById('dataEntradaRetorno2Ver').innerHTML = "Dt. Entrada " + dataRe2Invertida;
				if(json.dtProntoRet2 != "0000-00-00 00:00:00"){	
					let dataPr2 = json.dtProntoRet2;
					let dataPr2Invertida = dataPr2.replace(/(\d{4})-(\d{2})-(\d{2}) (\d{2}:\d{2}).*/, '$3/$2/$1 $4');
					document.getElementById('dataProntoRetorno2Ver').innerHTML = "Dt. Pronto " + dataPr2Invertida;
				}else{
					document.getElementById('dataProntoRetorno2Ver').innerHTML = "Dt. Pronto";	
				}
				if(json.saidaRetorno2 != "0000-00-00 00:00:00"){
					let dataSa2 = json.saidaRetorno2;
					let dataSa2Invertida = dataSa2.replace(/(\d{4})-(\d{2})-(\d{2}) (\d{2}:\d{2}).*/, '$3/$2/$1 $4');
					document.getElementById('dataSaidaRetorno2Ver').innerHTML = "Dt. Saída " + dataSa2Invertida ;
				}else{
					document.getElementById('dataSaidaRetorno2Ver').innerHTML = "Dt. Saída";	
				}
				document.getElementById('novaOSRet2').innerHTML = "Nova OS " + json.novaOS2;
				document.getElementById('defeitoRet2').value = json.defRet2;
				document.getElementById('acessorioRet2').value = json.acessRet2;
				document.getElementById('obsRet2').value = json.obsRet2;
				document.getElementById('estadoRet2').innerHTML = "Est. "  + json.estadoRetorno2;
				document.getElementById('pecaRet2').innerHTML = "Peça <span style='padding: 0 3%;background:#fffccc;'>" + Intl.NumberFormat('pt-br',{style:'currency',currency: 'BRL'}).format(json.pecaRet2) + '</span>';
				document.getElementById('matRet2').value = json.matRet2;
				document.getElementById('verRet2').style.display = "block";
			}	
			// ********** VER RETORNO 3		
			if(json.dataRetorno3 != "0000-00-00 00:00:00"){
				let dataRe3 = json.dataRetorno3;
				let dataRe3Invertida = dataRe3.replace(/(\d{4})-(\d{2})-(\d{2}) (\d{2}:\d{2}).*/, '$3/$2/$1 $4');	
				document.getElementById('dataEntradaRetorno3Ver').innerHTML = "Dt. Entrada " + dataRe3Invertida;
				if(json.dtProntoRet3 != "0000-00-00 00:00:00"){
					let dataPr3 = json.dtProntoRet3;
					let dataPr3Invertida = dataPr3.replace(/(\d{4})-(\d{2})-(\d{2}) (\d{2}:\d{2}).*/, '$3/$2/$1 $4');	
					document.getElementById('dataProntoRetorno3Ver').innerHTML = "Dt. Pronto " + dataPr3Invertida;
				}else{
					document.getElementById('dataProntoRetorno3Ver').innerHTML = "Dt. Pronto";	
				}
				if(json.saidaRetorno3 != "0000-00-00 00:00:00"){
					let dataSa3 = json.saidaRetorno3;
					let dataSa3Invertida = dataSa3.replace(/(\d{4})-(\d{2})-(\d{2}) (\d{2}:\d{2}).*/, '$3/$2/$1 $4');
					document.getElementById('dataSaidaRetorno3Ver').innerHTML = "Dt. Saída " + dataSa3Invertida;
				}else{
					document.getElementById('dataSaidaRetorno3Ver').innerHTML = "Dt. Saída";	
				}
				document.getElementById('novaOSRet3').innerHTML = "Nova OS " + json.novaOS3 ;
				document.getElementById('defeitoRet3').value = json.defRet3;
				document.getElementById('acessorioRet3').value = json.acessRet3;
				document.getElementById('obsRet3').value = json.obsRet3;
				document.getElementById('estadoRet3').innerHTML = "Est. "  + json.estadoRetorno3;
				document.getElementById('pecaRet3').innerHTML = "Peça <span style='padding: 0 3%;background:#fffccc;'>" +  Intl.NumberFormat('pt-br',{style:'currency',currency: 'BRL'}).format(json.pecaRet3) + '</span>';
				document.getElementById('matRet3').value = json.matRet3;
				document.getElementById('verRet3').style.display = "block";	
			}			
			if(json.foto1 != ""){
				document.getElementById("fotoCliente1Ver").style.display="block";
				document.getElementById("fotoCliente1Ver").src = '../imagem_cliente/'+json.foto1;
			}			
			if(json.foto2 != ""){
				document.getElementById("fotoCliente2Ver").style.display="block";
				document.getElementById("fotoCliente2Ver").src ='../imagem_cliente/'+ json.foto2; 
			}
			if(json.foto3 != ""){
				document.getElementById("fotoCliente3Ver").style.display="block";
				document.getElementById("fotoCliente3Ver").src ='../imagem_cliente/'+ json.foto3;
			}			
		}
		    
		//********** INICIO DE ALTERAR RETORNO 1,2 E 3 **********
		
		// início formulário de retorno
		if(document.getElementById('form_retorno').style.display =='block'){
			// Preenche a parte dos formulários de retorno que não pode ser alterado
			if(resultadoOS = document.getElementById('zerosAlt').value == "sim"){
				document.getElementById('osRetorno').value = json.ordemServico;
			}else{
				document.getElementById('osRetorno').value = ("0000000" + json.ordemServico).slice(-7);
			}
			document.getElementById('nomeRetorno').value = json.nome;
			document.getElementById('aparelhoRetorno').value = json.aparelho;
			document.getElementById('marcaRetorno').value = json.marca;
			document.getElementById('modeloRetorno').value = json.modelo;
			document.getElementById('numeroSerieRetorno').value = json.numeroSerie;
			document.getElementById("estadoRetAlt").value="PARA ORCAMENTO";
			// fim Preenche a parte dos formulários de retorno que não pode ser alterado

			// inicio formulário retorno 1 
			if(document.getElementById('controleRetorno').value=='retorno1' || document.getElementById('controleRetorno').value=='retorno1Alt' ){	
				document.getElementById('codigoRetorno').value = json.codigo;
				if(document.getElementById('controleRetorno').value=='retorno1Alt'){
					document.getElementById('textoRetorno').innerText = 'Alterar o primeiro retorno';
					document.getElementById('retorno_sub').innerHTML = "<i class='but-verde fas fa-edit'></i><span class='espaco'>ALTERAR</span>";
				}else{
					document.getElementById('textoRetorno').innerText = 'Cadastrar o primeiro retorno';
					document.getElementById('retorno_sub').innerHTML="<i class='but-verde fas fa-check'></i><span class='espaco'>CADASTRAR</span>";
				};
				if(json.estadoRetorno1 != "APARELHO SAIU" && json.estadoRetorno1 != "DEVOLVEU" && json.estadoRetorno1 != "COMPROU" && json.estadoRetorno1 != "DOOU" && json.estadoRetorno1 != "VENDEU"){
					document.getElementById('estadoRetAlt').style.display='block';
					if(json.dataRetorno1 != '0000-00-00 00:00:00'){
						document.getElementById('estadoRetAlt').value = json.estadoRetorno1;
					}
					document.getElementById('estadoNaoModificavelRet').style.display ="none";		
				}else{
					document.getElementById('estadoRetAlt').style.display='none';
					//document.getElementById('estadoRetAlt').value = json.estadoRetorno1;
					document.getElementById('estadoNaoModificavelRet').value = json.estadoRetorno1;
					document.getElementById('estadoNaoModificavelRet').style.display ="block";	
				}			
				document.getElementById('novaOSRetorno').value = json.novaOS1;
			};
			if(document.getElementById('controleRetorno').value=='retorno1Alt'){			
				document.getElementById('defeitoRetorno').value = json.defRet1;
				document.getElementById('acessorioRetorno').value = json.acessRet1;
				document.getElementById('obsRetorno').value = json.obsRet1;
				document.getElementById('dataEntradaRetorno').value = json.dataRetorno1;
				document.getElementById('dataProntoRetorno').value = json.dtProntoRet1;
				document.getElementById('dataSaidaRetorno').value = json.saidaRetorno1;
				document.getElementById('materialRetorno').value = json.matRet1;
				document.getElementById('pecaRetorno').value = (json.pecaRet1 - 0).toLocaleString('pt-br', {minimumFractionDigits: 2});
			};

			// inicio formulário retorno 2 
			if(document.getElementById('controleRetorno').value=='retorno2' || document.getElementById('controleRetorno').value=='retorno2Alt'){
				document.getElementById('codigoRetorno').value = json.codigo;
				if(document.getElementById('controleRetorno').value=='retorno2Alt'){
					document.getElementById('textoRetorno').innerText = 'Alterar o segundo retorno';
					document.getElementById('retorno_sub').innerHTML="<i class='but-verde fas fa-edit'></i><span class='espaco'>ALTERAR</span>";
				}else{
					document.getElementById('textoRetorno').innerText = 'Cadastrar o segundo retorno';
					document.getElementById('retorno_sub').innerHTML="<i class='but-verde fas fa-check'></i><span class='espaco'>CADASTRAR</span>";
				};
				if(json.estadoRetorno2 != "APARELHO SAIU" && json.estadoRetorno2 != "DEVOLVEU" && json.estadoRetorno2 != "COMPROU" && json.estadoRetorno2 != "DOOU" && json.estadoRetorno2 != "VENDEU"){
					document.getElementById('estadoRetAlt').style.display='block';
					if(json.dataRetorno2 != '0000-00-00 00:00:00'){
						document.getElementById('estadoRetAlt').value = json.estadoRetorno2;
					}
					document.getElementById('estadoNaoModificavelRet').style.display ="none";			
				}else{
					document.getElementById('estadoRetAlt').style.display='none';
					//document.getElementById('estadoRetAlt').value = json.estadoRetorno2;
					document.getElementById('estadoNaoModificavelRet').value = json.estadoRetorno2;
					document.getElementById('estadoNaoModificavelRet').style.display ="block";	
				}
				document.getElementById('novaOSRetorno').value = json.novaOS2;
			};
			if(document.getElementById('controleRetorno').value=='retorno2Alt'){
				document.getElementById('codigoRetorno').value = json.codigo;
				document.getElementById('defeitoRetorno').value = json.defRet2;
				document.getElementById('acessorioRetorno').value = json.acessRet2;
				document.getElementById('obsRetorno').value = json.obsRet2;
				document.getElementById('dataEntradaRetorno').value = json.dataRetorno2;
				document.getElementById('dataProntoRetorno').value = json.dtProntoRet2;
				document.getElementById('dataSaidaRetorno').value = json.saidaRetorno2;
				document.getElementById('materialRetorno').value = json.matRet2;
				document.getElementById('pecaRetorno').value = (json.pecaRet2 - 0).toLocaleString('pt-br', {minimumFractionDigits: 2});
			} 
			 
			// inicio formulário retorno 3 
			if(document.getElementById('controleRetorno').value=='retorno3' || document.getElementById('controleRetorno').value=='retorno3Alt' ){
				document.getElementById('codigoRetorno').value = json.codigo;
				if(document.getElementById('controleRetorno').value=='retorno3Alt'){
					document.getElementById('textoRetorno').innerText = 'Alterar o terceiro retorno';
					document.getElementById('retorno_sub').innerHTML="<i class='but-verde fas fa-edit'></i><span class='espaco'>ALTERAR</span>";
				}else{
					document.getElementById('textoRetorno').innerText = 'Cadastrar o terceiro retorno';
					document.getElementById('retorno_sub').innerHTML="<i class='but-verde fas fa-check'></i><span class='espaco'>CADASTRAR</span>";
				};
				if(json.estadoRetorno3 != "APARELHO SAIU" && json.estadoRetorno3 != "DEVOLVEU" && json.estadoRetorno3 != "COMPROU" && json.estadoRetorno3 != "DOOU" && json.estadoRetorno3 != "VENDEU"){
					document.getElementById('estadoRetAlt').style.display='block';
					if(json.dataRetorno3 != '0000-00-00 00:00:00'){
						document.getElementById('estadoRetAlt').value = json.estadoRetorno3;
					}
					document.getElementById('estadoNaoModificavelRet').style.display ="none";
				}else{
					document.getElementById('estadoRetAlt').style.display='none';
					//document.getElementById('estadoRetAlt').value = json.estadoRetorno3;
					document.getElementById('estadoNaoModificavelRet').value = json.estadoRetorno3;
					document.getElementById('estadoNaoModificavelRet').style.display ="block";	
				}
				document.getElementById('novaOSRetorno').value = json.novaOS3;
			};
			if(document.getElementById('controleRetorno').value=='retorno3Alt'){
				document.getElementById('codigoRetorno').value = json.codigo;
				document.getElementById('defeitoRetorno').value = json.defRet3;
				document.getElementById('acessorioRetorno').value = json.acessRet3;
				document.getElementById('obsRetorno').value = json.obsRet3;
				document.getElementById('dataEntradaRetorno').value = json.dataRetorno3;
				document.getElementById('dataProntoRetorno').value = json.dtProntoRet3;
				document.getElementById('dataSaidaRetorno').value = json.saidaRetorno3;
				document.getElementById('materialRetorno').value = json.matRet3;
				document.getElementById('pecaRetorno').value = (json.pecaRet3 - 0).toLocaleString('pt-br', {minimumFractionDigits: 2});;
			}
		}
	})	
	.catch(error => {
		//alert('O sistema só pode ser acesado pelo servidor');
		//window.location.href='../php/expira_session.php';
	});  
};// fim da busca de informacao de cadastro no banco

//********** FUNCAO QUE PREPARA E MOSTRA O FORMULARIO PARA UM NOVO CADASTRO

function novoCadastro(){
	document.getElementById("excluirNovo").style.display = "none";
	document.getElementById("textoForm").innerText="Novo Cadastro";
	document.getElementById("estadoAlt").value="";
	document.getElementById("estadoAlt").value="PARA ORCAMENTO";
	document.getElementById("cadastroAlt").innerHTML="<i class='but-verde fas fa-check'></i><span class='espaco'>CADASTRAR</span>";
	document.getElementById('form_alteracao').style.display='block';
	document.getElementById("fotoCliente1").style.display='none';
	document.getElementById("fotoCliente2").style.display='none';
	document.getElementById("fotoCliente3").style.display='none';
}

//********** LIMPA TODOS OS CAMPOS DOS FORMULARIOS

function resetForm(){	
	
	// Limpa o formulario de Funcionario
	//document.getElementById("horaEntrada").style.visibility = "hidden";
	//document.getElementById("horaEntrada").innerHTML = "";
	
	//document.getElementById("horaSaida").style.visibility = "hidden";
	//document.getElementById("horaVerSaida").innerHTML = "";
	//document.getElementById("horaSaida").innerHTML = "";
	document.getElementById('codigoFunc').value = "";
	document.getElementById('pagina_func').value = "";
	document.getElementById("nomeFuncionario").innerHTML = "";
	limparFotoFuncionario();
	limparFotoFuncionario2();
	document.getElementById("nomeFunc").value = "";	
	document.getElementById("telFunc").value = "";	
	document.getElementById('telFunc2').value = "";	
	document.getElementById("cpfFunc").value = "";	
	document.getElementById('enderecoFunc').value = "";	
	document.getElementById('numeroFunc').value = "";	
	document.getElementById('bairroFunc').value = "";	
	document.getElementById('cidadeFunc').value = "";	
	document.getElementById('dataNascimentoFunc').value = "";
	document.getElementById('idade2Func').value = "";	
	document.getElementById("emailFunc").value = "";	
	document.getElementById('barraFunc').value = "";		
	document.getElementById('dataCadastroFunc').value = "";	
	document.getElementById('obsFunc').value = "";
	document.getElementById('tema_func').checked = false;	
	document.getElementById('semCronometro_func').checked = false;
	document.getElementById('col_id_func').checked = false;
	document.getElementById('col_os_func').checked = false;
	document.getElementById('col_nome_func').checked = false;
	document.getElementById('asc_func').checked = false;
	document.getElementById('desc_func').checked = false;
	document.getElementById("excluirFotoFuncionario1").style.visibility = "hidden";
	document.getElementById("excluirFotoFuncionario2").style.visibility = "hidden";
	document.getElementById('excluir-foto-funcionario1').checked = false;
	document.getElementById('excluir-foto-funcionario2').checked = false;
	// Limpa o formulario para Novo Cadastro e Alteracao de cadastro
	document.getElementById("camposCartao").style.visibility = "hidden";
	document.getElementById("campoCartaoAlt").style.visibility = "hidden";
	document.getElementById("botaoLigar").style.visibility = "hidden";
	document.getElementById("excluirFoto1").style.visibility ="hidden";
	document.getElementById("excluirFoto2").style.visibility ="hidden";
	document.getElementById("excluirFoto3").style.visibility ="hidden";
	document.getElementById("campoPagou").style.visibility ="hidden";
	document.getElementById("checkPrazo").style.visibility ="hidden";
	document.getElementById("dataPagou").style.visibility ="hidden";
	document.getElementById("pagarRestante").style.visibility ="hidden";
	document.getElementById("dataPagamentoAlt").style.visibility ="hidden";
	document.getElementById("fotoCliente1").style.display="none";
	document.getElementById("fotoCliente2").style.display="none";
	document.getElementById("fotoCliente3").style.display="none";	
	document.getElementById("campoAparelho").style.display='block';
	document.getElementById("campoMarca").style.display="block";
	document.getElementById("campoModelo").style.display="block";
	document.getElementById("botaoLimpar").style.display = "block";
	document.getElementById("botaoLimpar2").style.display = "block";
	document.getElementById("botaoLimpar3").style.display = "block";
	document.getElementById("inicialAlt").removeAttribute("required","required");
	document.getElementById("restanteAlt").removeAttribute("required","required");
	document.getElementById("escolhaCartaoAlt").removeAttribute("required","required");
	document.getElementById("parcelasCartaoAlt").removeAttribute("required","required");
	document.getElementById("valorParcelas").removeAttribute("required","required");
	document.getElementById("jurosCartaoAlt").removeAttribute("required","required");	
	document.getElementById("codigoAlt").value = "";
	document.getElementById("nomeAlt").value = "";
	document.getElementById("telefoneAlt").value="";
	document.getElementById("telefone2Alt").value="";
	document.getElementById("cpfAlteracaoAlt").value="";
	document.getElementById("enderecoAlt").value="";
	document.getElementById("dtNascimentoAlt").value="";
	document.getElementById("emailAlt").value="";
	document.getElementById("estadoAlt").value="";
	document.getElementById("estadoNaoModificavel").style.display = "none";
	document.getElementById("estadoNaoModificavel").value="";
	document.getElementById("aparelhoNaoModificavel").style.display = "none";
	document.getElementById("aparelhoNaoModificavel").value="";
	document.getElementById("marcaNaoModificavel").style.display = "none";
	document.getElementById("marcaNaoModificavel").value="";
	document.getElementById("modeloNaoModificavel").style.display = "none";
	document.getElementById("modeloNaoModificavel").value="";
	// volta os selects normais do formulário de cadastro
	document.getElementById("aparelhoAlt").style.display='block';
	document.getElementById("aparelhoAlt").value="";
	document.getElementById("marcaAlt").style.display='block';
	document.getElementById("marcaAlt").value="";
	document.getElementById("modeloAlt").style.display='block';
	document.getElementById("modeloAlt").value="";
	document.getElementById("estadoAlt").style.display="block";
	document.getElementById("excluirNovo").style.display = "block";
	document.getElementById("checkPrazo").style.visibility ="hidden";
	document.getElementById("pagarRestante").style.visibility ="hidden";
	document.getElementById("novoAparelhoAlt").value="";
	document.getElementById("novaMarcaAlt").value="";
	document.getElementById("novoModeloAlt").value="";
	document.getElementById("numeroSerieAlt").value="";
	document.getElementById("chassiAlt").value="";
	document.getElementById("imeiAlt").value="";
	document.getElementById("placaNormalAlt").value="";
	//placaNormalAlt.value="";
	document.getElementById("placaMercosulAlt").value="";
	//placaMercosulAlt.value="";
	document.getElementById("renavamAlt").value="";
	document.getElementById("defeitoAlt").value="";
	document.getElementById("acessorioAlt").value="";
	document.getElementById("observacaoAlt").value="";
	document.getElementById("dataEntradaAlt").value="";
	document.getElementById("dataProntoAlt").value="";
	document.getElementById("dataSaidaAlt").value="";
	document.getElementById("materialAlt").value="";
	document.getElementById("orcamentoAlt").value="";
	document.getElementById("valorObjeto").value="";
	document.getElementById("descontoAlt").value="";
	document.getElementById("comDescontoAlt").value="";
	document.getElementById("valorPecaAlt").value="";
	document.getElementById("materialAuxiliarAlt").value="";
	document.getElementById("transporteAlt").value="";
	document.getElementById("lucroAlt").value="";
	document.getElementById("aPrazoAlt").checked = false;
	document.getElementById("inicialAlt").value="";
	document.getElementById("restanteAlt").value="";
	document.getElementById("dataPagamentoAlt").value="";
	document.getElementById("dataPagouAlt").value="";
	document.getElementById("pagouAlt").value="";
	document.getElementById("cartaoAlt").checked = false;
	document.getElementById("escolhaCartaoAlt").value="";
	document.getElementById("bandeiraCartaoAlt").value="";
	document.getElementById("parcelasCartaoAlt").value="";
	document.getElementById("valorParcelas").value="";
	document.getElementById("jurosCartaoAlt").value="";
	document.getElementById("somaJurosAlt").value="";
	document.getElementById("orcComJurosAlt").value="";
	document.getElementById("barraAlt").value="";
	document.getElementById("totalPagarAlt").value="";
	document.getElementById("qantidade_ligacao").innerHTML ="";
	// Limpa o formulario de Retorno
	document.getElementById("osRetorno").value="";
	document.getElementById("nomeRetorno").value="";
	document.getElementById("aparelhoRetorno").value="";
	document.getElementById("modeloRetorno").value="";
	document.getElementById("numeroSerieRetorno").value="";
	document.getElementById("marcaRetorno").value="";
	document.getElementById("novaOSRetorno").value="";
	document.getElementById("defeitoRetorno").value="";
	document.getElementById("acessorioRetorno").value="";
	document.getElementById("obsRetorno").value="";
	document.getElementById("dataEntradaRetorno").value="";
	document.getElementById("dataProntoRetorno").value="";
	document.getElementById("dataSaidaRetorno").value="";
	document.getElementById("materialRetorno").value="";
	document.getElementById("pecaRetorno").value="";
	// div configuração aparelho, marca e modelo
	document.getElementById("aparelho_busca").value="";
	document.getElementById("marca_busca").value="";
	document.getElementById("modelo_busca").value="";
	document.querySelector("#imagem_logo").innerHTML = "";
	//document.querySelector("#estadoAlt").style.display="none";
	document.querySelector("#foto5").value = "";
	document.querySelector("#foto6").value = "";
	document.querySelector("#foto3").value = "";
	// formulário de retorno
	document.getElementById('textoRetorno').innerText ="";
	// limpa o formulário de cadastro e alteração	
	document.getElementById("campoCartaoAlt").style.visibility ="hidden";
	document.getElementById("pagarRestante").style.visibility ="hidden";
	document.getElementById("campoPagou").style.visibility ="hidden";
	document.getElementById("excluirFoto1").style.visibility ="hidden";
	document.getElementById("excluirFoto2").style.visibility ="hidden";
	document.getElementById("excluirFoto3").style.visibility ="hidden";
	document.getElementById("checkPrazo").style.visibility ="hidden";
	document.getElementById("dataPagou").style.visibility ="hidden";
	document.getElementById('botaoLigar').style.visibility ="hidden";
	document.getElementById("dataPagamentoAlt").removeAttribute("required","required");
	document.getElementById("inicialAlt").removeAttribute("required","required");
	document.getElementById("restanteAlt").removeAttribute("required","required");
	document.getElementById("escolhaCartaoAlt").removeAttribute("required","required");
	document.getElementById("parcelasCartaoAlt").removeAttribute("required","required");
	document.getElementById("valorParcelas").removeAttribute("required","required");
	document.getElementById("jurosCartaoAlt").removeAttribute("required","required");
	// limpa o formulario de ligação
	document.getElementById('telefone11').innerText = "";
	document.getElementById('telefone22').innerText = "";
	document.getElementById('Ligacao1').style.display = "none";
	document.getElementById('Ligacao2').style.display = "none";
	document.getElementById('Ligacao3').style.display = "none";
	document.getElementById('Ligacao4').style.display = "none";
	document.getElementById('Ligacao5').style.display = "none";
	document.getElementById('telefoneLigar1').checked = false;
	document.getElementById('telefoneLigar2').checked = false;
	document.getElementById("pagouAlt").checked=false;
	// limpa o formulario de ver cadastro
	document.getElementById('nomeVer').value = '';
	document.getElementById('enderecoVer').value = '';
	document.getElementById('defeitoVer').value = '';
	document.getElementById('acessorioVer').value = '';
	document.getElementById('obsVer').value = '';
	document.getElementById('materialVer').value = '';
	document.getElementById('ordemServicoVer').value = '';
	document.getElementById('totalGeral').innerText ='';
	document.getElementById('telefoneVer').innerText = '';
	document.getElementById('telefone2Ver').innerText = '';
	document.getElementById('cpfVer').innerText = '';
	document.getElementById('dtNascimentoVer').innerText = '';
	document.getElementById('emailVer').innerText = '';
	document.getElementById('aparelhoVer').innerText = '';
	document.getElementById('marcaVer').innerText = '';
	document.getElementById('modeloVer').innerText = '';
	document.getElementById('numeroSerieVer').innerText = '';
	document.getElementById('chassiVer').innerText = '';
	document.getElementById('estadoVer').innerText = '';
	document.getElementById('dataEntradaVer').innerText = '';
	document.getElementById('imeiVer').innerText = '';
	document.getElementById('placaVer').innerText = '';
	document.getElementById('renavamVer').innerText = '';
	document.getElementById('dtProntoVer').innerText = '';
	document.getElementById('dtSaidaVer').innerText = '';
	document.getElementById('barraVer').innerText = '';
	document.getElementById('orcamentoVer').innerText = 'R$ 0,00';
	document.getElementById('descontoVer').innerText = 'R$ 0,00';
	document.getElementById('valorPecaVer').innerText = 'R$ 0,00';
	document.getElementById('materialAuxiliarVer').innerText = 'R$ 0,00';
	document.getElementById('transporteVer').innerText = 'R$ 0,00';
	document.getElementById('lucroVer').innerText = 'R$ 0,00';
	document.getElementById('tipoCartaoVer').innerText = '';
	document.getElementById('parcelasCartaoVer').innerText = '0';
	document.getElementById('jurosCartaoVer').innerText = 'R$ 0,00';
	document.getElementById('somaJurosVer').innerText = 'R$ 0,00';
	// limpa o formulario de retorno 1
	document.getElementById('novaOSRet1').innerText = '';
	document.getElementById('dataEntradaRetorno1Ver').innerText = '';
	document.getElementById('dataProntoRetorno1Ver').innerText = '';
	document.getElementById('dataSaidaRetorno1Ver').innerText = '';
	document.getElementById('estadoRet1').innerText = '';
	document.getElementById('pecaRet1').innerText = '';
	document.getElementById('defeitoRet1').value = '';
	document.getElementById('acessorioRet1').value = '';
	document.getElementById('obsRet1').value = '';
	document.getElementById('matRet1').value = '';
	// limpa o formulario de retorno 2
	document.getElementById('novaOSRet2').innerText = '';
	document.getElementById('dataEntradaRetorno2Ver').innerText = '';
	document.getElementById('dataProntoRetorno2Ver').innerText = '';
	document.getElementById('dataSaidaRetorno2Ver').innerText = '';
	document.getElementById('estadoRet2').innerText = '';
	document.getElementById('pecaRet2').innerText = '';
	document.getElementById('defeitoRet2').value = '';
	document.getElementById('acessorioRet2').value = '';
	document.getElementById('obsRet2').value = '';
	document.getElementById('matRet2').value = '';
	// limpa o formulario de retorno 3
	document.getElementById('novaOSRet3').innerText = '';
	document.getElementById('dataEntradaRetorno3Ver').innerText = '';
	document.getElementById('dataProntoRetorno3Ver').innerText = '';
	document.getElementById('dataSaidaRetorno3Ver').innerText = '';
	document.getElementById('estadoRet3').innerText = '';
	document.getElementById('pecaRet3').innerText = '';
	document.getElementById('defeitoRet3').value = '';
	document.getElementById('acessorioRet3').value = '';
	document.getElementById('obsRet3').value = '';
	document.getElementById('matRet3').value = '';
	// limpa campos no formulario de configuracoes
	document.getElementById('nomeOficina').value = "";
	document.getElementById('telefoneOficina').value = "";
	document.getElementById('telefone2Oficina').value = "";
	document.getElementById('enderecoOficina').value = "";
	document.getElementById('usuarioOficina').value = "";
	document.getElementById('rodapeOficina').value = "";
	document.getElementById('contaOsOficina').value = "";
	document.getElementById('idadeMinimaOficina').value = "";
	document.getElementById('idadeMaximaOficina').value = "";
	document.getElementById("logo_imagem").style.display = "none";
	document.getElementById('maiusculaOficina').checked = false;
	document.getElementById('zerosOficina').checked = false;
	document.getElementById('osAutoOficina').checked = false;
	document.getElementById('divContaOs').style.display = "none";
	document.getElementById('tecnicoOficina').checked = false;			
	document.getElementById('logomarcaOficina').checked = false;
	document.getElementById('acentoOficina').checked = false;	
}

//********** FUNCAO CALCULAR O RESTANTE NO FORMULARIO DE CADASTRO

function calcularRestante(){
	let AltInicial = document.getElementById("inicialAlt").value.replace(/[^\d]+/g,'');
	let AltOrcamento = document.getElementById("orcamentoAlt").value.replace(/[^\d]+/g,'');
	let AltDesconto = document.getElementById("descontoAlt").value.replace(/[^\d]+/g,'');
	let restante = (AltOrcamento - AltDesconto - AltInicial);
	document.getElementById("restanteAlt").value =  formatReal(restante);
	calculaTotalParcela();
	calculajuros();
}

//********** FUNCAO CALCULAR O PARCELAS NO FORMULARIO DE CADASTRO

function calculaTotalParcela(){
	let valorRestante = document.getElementById("restanteAlt").value.replace(/[^\d]+/g,'');
	let parcelaCartao = document.getElementById("parcelasCartaoAlt").value;
	if(parcelaCartao == 0){
		parcelaCartao = 1;
	}
	document.getElementById("valorParcelas").value = formatReal(Math.round(valorRestante / parcelaCartao));
};

//********** FUNCAO CALCULAR JUROS NO FORMULARIO DE CADASTRO

function calculajuros(){
	let jurosCartaoAlte = document.getElementById("jurosCartaoAlt").value.replace(/[^\d]+/g,'');
	let AltOrcamentoJuros = document.getElementById("orcamentoAlt").value.replace(/[^\d]+/g,'');
	let AltDescontoJuros = document.getElementById("descontoAlt").value.replace(/[^\d]+/g,'');
	let parcelaCartaoAlt = document.getElementById("parcelasCartaoAlt").value;
	let resultado = (jurosCartaoAlte * parcelaCartaoAlt)
	document.getElementById("somaJurosAlt").value = formatReal(resultado);
	document.getElementById("orcComJurosAlt").value = formatReal(AltOrcamentoJuros - AltDescontoJuros + parseFloat(resultado));
}
			
//------------------------------------------------------------------------------------------------------------


//********** FUNCAO QUE VALIDA O CAMPO BUSCA NA PAGINA HOME

function validar_busca(){
	var campo_busca = form_pesquisar.pesquisa.value.trim();
	if(campo_busca =="" || campo_busca.length < 2 ){
		alert('Digite pelo menos dois caracteres para pesquisar');
		return false;	
	};
};	


function validar_busca_imprimir(){
	var campo_busca_imprimir = document.getElementById('pesquisaImprimir').value.trim();
	if(campo_busca_imprimir =="" || campo_busca_imprimir.length < 2 ){
		alert('Digite pelo menos dois caracteres para pesquisar');
		return false;	
	};
};	

//********** FUNCAO PARA PESQUISAR EM CADASTRO(S) EXCLUIDOS PERMANETEMENTE

function filtrarTabela(){
	const input = document.getElementById("campoBusca");
	const filtro = input.value.toUpperCase();
	const tabela = document.getElementById("minhaTabela");
	const linhas = tabela.getElementsByTagName("tr");
	for(let i = 0; i < linhas.length; i++) {
		let linhaVisivel = false;
		const celulas = linhas[i].getElementsByTagName("b");
		for(let j = 0; j < celulas.length; j++) {
			let celula = celulas[j];
			celula.innerHTML = celula.textContent;
			const textoCelula = celula.textContent || celula.innerText;
			if(textoCelula.toUpperCase().includes(filtro) && filtro.length > 0){
				linhaVisivel = true;
				const textoDestacado = textoCelula.replace(
					new RegExp(filtro, 'gi'),
					(match) => `<span class="destaque">${match}</span>`
				);   
				celula.innerHTML = textoDestacado;
			}
		}
		if (linhaVisivel || filtro.length === 0){
			linhas[i].style.display = "";
		}else{
			linhas[i].style.display = "none";
		}
	}
}

//********** FUNCAO VALIDA O CAMPO DEFEITO E ESTADO NO FORMULARIO DE RETORNO

function validarRetorno(){
	let defeitoRetorno = document.getElementById('defeitoRetorno').value;
	//let estadoRetorno = document.getElementById('estadoRetorno').value;
	if(defeitoRetorno.trim() == "" || defeitoRetorno.length < 5){
		document.getElementById('defeitoRetorno').value = "";
		alert("Campo defeito com menos de cinco caracteres!");
		return false;
	};
};


//********** funcao escolhe o tipo de cartao no cadastro de usuario

function escolhaTipo(){
	//const select = document.getElementById('escolhaCartaoAlt');
	const opcaoTexto = document.getElementById("escolhaCartaoAlt").options[escolhaCartaoAlt.selectedIndex].text;
	if(opcaoTexto == "CRÉDITO"){
		document.getElementById("camposCartao").style.visibility ="visible";
		document.getElementById("bandeiraCartaoAlt").setAttribute("required","required");
	}else{
		//document.getElementById("bandeiraCartaoAlt").removeAttribute("required","required");
		document.getElementById("parcelasCartaoAlt").removeAttribute("required","required");
		document.getElementById("valorParcelas").removeAttribute("required","required");
		document.getElementById("jurosCartaoAlt").removeAttribute("required","required");
		document.getElementById("dataPagamentoAlt").removeAttribute("required","required");
		document.getElementById("inicialAlt").removeAttribute("required","required");
		document.getElementById("restanteAlt").removeAttribute("required","required");
		document.getElementById("camposCartao").style.visibility ="hidden";
		document.getElementById("somaJurosAlt").value = "";
		document.getElementById("orcComJurosAlt").value = "";
		document.getElementById("parcelasCartaoAlt").value= "1";
		document.getElementById("valorParcelas").value = "";
		document.getElementById("jurosCartaoAlt").value="";
		document.getElementById("dataPagamentoAlt").value="";
		
	}	
}

//**********  funcao valida o telefone no cadastro de usuario

function validaTelefone(){
	let fone1 = document.getElementById('telefoneLigar1');
	let fone2 = document.getElementById('telefoneLigar2');
	let fone3 = document.getElementById('outroTelefone');
	let quem_ligou = document.getElementById('quem_ligou').value.trim();
	if(fone1.checked == false && fone2.checked == false && fone3.value == "" ){
		alert("Escolha um telefone para cadastrar");
		return false;
	}
	if(quem_ligou.length == 0){
		alert("Campo Quem ligou está em branco");
		return false;
	}
	if(quem_ligou.length < 2){
		alert("Campo Quem ligou com menos de dois caracteres");
		return false;
	}
	if(fone1.checked == false && fone2.checked == false && fone3.value.length < 14){
		alert("Campo novo telefone incompleto");
		return false;
	}
}

//**********  funcao mostra campos a prazo checado

function aPrazoCheked(){
	document.getElementById("escolhaCartaoAlt").value = "";
	document.getElementById("bandeiraCartaoAlt").value = "";
	document.getElementById("parcelasCartaoAlt").value= "1";
	document.getElementById("valorParcelas").value = "";
	document.getElementById("jurosCartaoAlt").value="";
	document.getElementById("dataPagamentoAlt").value="";
	document.getElementById("somaJurosAlt").value = "";
	document.getElementById("dataPagouAlt").value = "";
	document.getElementById("orcComJurosAlt").value = "";
	document.getElementById("inicialAlt").value = "";
	document.getElementById("restanteAlt").value = "";
	document.getElementById("checkPrazo").style.visibility ="visible";
	document.getElementById("pagarRestante").style.visibility ="visible";
	document.getElementById("dataPagamentoAlt").style.visibility ="visible";
	document.getElementById("campoCartaoAlt").style.visibility ="hidden";
	document.getElementById("camposCartao").style.visibility ="hidden";
	document.getElementById("cartaoAlt").checked=false; 
	document.getElementById("pagouAlt").checked=false;
	document.getElementById("dataPagamentoAlt").setAttribute("required","required");
	document.getElementById("inicialAlt").setAttribute("required","required");	
	document.getElementById("escolhaCartaoAlt").removeAttribute("required","required");
	document.getElementById("parcelasCartaoAlt").removeAttribute("required","required");
	document.getElementById("valorParcelas").removeAttribute("required","required");
	document.getElementById("jurosCartaoAlt").removeAttribute("required","required");
}

//********** funcao mostra campos a prazo nao checado 

function aPrazoNoCheked(){
	document.getElementById("dataPagamentoAlt").removeAttribute("required","required");
	document.getElementById("inicialAlt").removeAttribute("required","required");
	document.getElementById("campoPagou").style.visibility ="hidden";
	document.getElementById("checkPrazo").style.visibility ="hidden";
	document.getElementById("dataPagou").style.visibility ="hidden";
	document.getElementById("pagarRestante").style.visibility ="hidden";
	document.getElementById("dataPagamentoAlt").style.visibility ="hidden";
	document.getElementById("pagou").checked=false;
	document.getElementById("dataPagouAlt").removeAttribute("required","required");
}

//********** funcao mostra campo cartao de credito checado

function cartaoChecked(){
	document.getElementById("checkPrazo").style.visibility ="visible";
	document.getElementById("campoCartaoAlt").style.visibility ="visible";
	document.getElementById("campoPagou").style.visibility ="hidden";
	document.getElementById("pagarRestante").style.visibility ="hidden";
	document.getElementById("dataPagamentoAlt").style.visibility ="hidden";
	document.getElementById("dataPagou").style.visibility ="hidden";
	document.getElementById("aPrazoAlt").checked =false;
	document.getElementById("inicialAlt").value = "";
	document.getElementById("restanteAlt").value = "";				
	const opcaoTextos = document.getElementById("escolhaCartaoAlt").options[escolhaCartaoAlt.selectedIndex].text;
	if(opcaoTextos == "CRÉDITO"){
		document.getElementById("camposCartao").style.visibility ="visible";
	}else{
		document.getElementById("restanteAlt").value = "";
		document.getElementById("somaJurosAlt").value = "";
		document.getElementById("orcComJurosAlt").value = "";
		document.getElementById("parcelasCartaoAlt").value= "1";
		document.getElementById("valorParcelas").value = "";
		document.getElementById("jurosCartaoAlt").value="";
		document.getElementById("dataPagamentoAlt").value="";
	}
	if(opcaoTextos == "CRÉDITO" || opcaoTextos == ""){
		document.getElementById("inicialAlt").setAttribute("required","required");
		document.getElementById("escolhaCartaoAlt").setAttribute("required","required");
		document.getElementById("bandeiraCartaoAlt").setAttribute("required","required");
		document.getElementById("jurosCartaoAlt").setAttribute("required","required");
		document.getElementById("dataPagamentoAlt").removeAttribute("required","required");
		
		
	}
}

//********** funcao mostra campo cartao de credito nao checado

function cartaoNoChecked(){
	document.getElementById("escolhaCartaoAlt").removeAttribute("required","required");
	document.getElementById("bandeiraCartaoAlt").removeAttribute("required","required");
	document.getElementById("jurosCartaoAlt").removeAttribute("required","required");
	document.getElementById("dataPagamentoAlt").removeAttribute("required","required");
	document.getElementById("inicialAlt").removeAttribute("required","required");
	

	document.getElementById("escolhaCartaoAlt").value = "";
	document.getElementById("bandeiraCartaoAlt").value = "";
	document.getElementById("camposCartao").style.visibility ="hidden";
	document.getElementById("checkPrazo").style.visibility ="hidden";
	document.getElementById("campoPagou").style.visibility ="hidden";
	document.getElementById("campoCartaoAlt").style.visibility ="hidden";
	document.getElementById("dataPagou").style.visibility ="hidden";
	
	document.getElementById("parcelasCartaoAlt").value= "1";
	document.getElementById("valorParcelas").value = "";
	document.getElementById("jurosCartaoAlt").value="";
	document.getElementById("dataPagamentoAlt").value="";
	document.getElementById("inicialAlt").value = "";
	document.getElementById("restanteAlt").value = "";
	document.getElementById("somaJurosAlt").value = "";
	document.getElementById("orcComJurosAlt").value = "";
}

// id do botao que carrrega a imagem 
const inputFile = document.querySelector("#foto5");
const inputFile2 = document.querySelector("#foto6");
const inputFile3 = document.querySelector("#foto3");	
const inputFile4 = document.querySelector("#img_logomarca");
const inputFile5 = document.querySelector("#img_funcionario");
const inputFile6 = document.querySelector("#img_funcionario2");
// id do campo para visualizar a imagem que sera salva	no cadastro inicial
const pictureImage4 = document.querySelector("#imagem_logo");
const pictureImage5 = document.querySelector("#fotoFuncionario1");
const pictureImage6 = document.querySelector("#fotoFuncionario2");
// id do campo para visualizar a imagem que sera salva ou alterada no cadastro de alteracao
const fotoCliente1 = document.querySelector("#fotoCliente1");
const fotoCliente2 = document.querySelector("#fotoCliente2");
const fotoCliente3 = document.querySelector("#fotoCliente3");
			
//********** funcao que carrega a primeira imagem no formulario de cadastro

inputFile.addEventListener("change", function (e) {
	const inputTarget = e.target;
	const file = inputTarget.files[0];
	if (file) {
		const reader = new FileReader();
		reader.addEventListener("load", function (e) {
			const readerTarget = e.target;
			const img = document.createElement("img");
			img.src = readerTarget.result;
			img.classList.add("picture__img");
			fotoCliente1.style.display = "block";
			fotoCliente1.src = img.src;
		});
		reader.readAsDataURL(file);
	}
});
			
//**********  funcao que carrega a segunda imagem no formulario de cadastro

inputFile2.addEventListener("change", function (e) {
	const inputTarget2 = e.target;
	const file2 = inputTarget2.files[0];
	if (file2) {
		const reader = new FileReader();
		reader.addEventListener("load", function (e) {
			const readerTarget2 = e.target;
			const img2 = document.createElement("img");
			img2.src = readerTarget2.result;
			img2.classList.add("picture__img");
			fotoCliente2.style.display = "block";
			fotoCliente2.src = img2.src;
		});
		reader.readAsDataURL(file2);
	}
});
			
//**********  funcao que carrega a terceira imagem no formulario de cadastro

inputFile3.addEventListener("change", function (e) {
	const inputTarget3 = e.target;
	const file3 = inputTarget3.files[0];
	if (file3) {
		const reader = new FileReader();
		reader.addEventListener("load", function (e) {
			const readerTarget3 = e.target;
			const img3 = document.createElement("img");
			img3.src = readerTarget3.result;
			img3.classList.add("picture__img");
			fotoCliente3.style.display = "block";
			fotoCliente3.src = img3.src;
		});
		reader.readAsDataURL(file3);
	}
});
			
//**********  funcao que muda a logomarca no formulario de configuracoes

inputFile4.addEventListener("change", function (e) {
	const inputTarget4 = e.target;
	const file4 = inputTarget4.files[0];
	if (file4) {
		const reader = new FileReader();
		reader.addEventListener("load", function (e) {
			const readerTarget4 = e.target;
			const img4 = document.createElement("img");
			img4.src = readerTarget4.result;
			img4.classList.add("picture__img");
			pictureImage4.innerHTML = "";
			pictureImage4.src = img4.src;
			pictureImage4.appendChild(img4);
		});
		reader.readAsDataURL(file4);
	}
});
			
//**********  funcao que carrega ou altera a imagem 1 do funcionario

inputFile5.addEventListener("change", function (e) {
	const inputTarget5 = e.target;
	const file5 = inputTarget5.files[0];
	if (file5) {
		const reader = new FileReader();
		reader.addEventListener("load", function (e) {
			const readerTarget5 = e.target;
			const img5 = document.createElement("img");
			img5.src = readerTarget5.result;
			img5.classList.add("picture__img");
			pictureImage5.style.display = "block";
			pictureImage5.src = img5.src;
			pictureImage5.appendChild(img5);
		});
		reader.readAsDataURL(file5);
	}
});
			
//**********  funcao que carrega ou altera a imagem 1 do funcionario

inputFile6.addEventListener("change", function (e) {
	const inputTarget6 = e.target;
	const file6 = inputTarget6.files[0];
	if (file6) {
		const reader = new FileReader();
		reader.addEventListener("load", function (e) {
			const readerTarget6 = e.target;
			const img6 = document.createElement("img");
			img6.src = readerTarget6.result;
			img6.classList.add("picture__img");
			pictureImage6.style.display = "block";
			pictureImage6.src = img6.src;
			pictureImage6.appendChild(img6);
		});
		reader.readAsDataURL(file6);
	}
});	

//**********  funcao limpa imagem no cadastro de usuario

function limparCacheImagem(){
	inputFile.value = "";
	fotoCliente1.style.display = "none";
}
function limparCacheImagem2(){
	inputFile2.value = "";
	fotoCliente2.style.display = "none";;
}
function limparCacheImagem3(){
	inputFile3.value = "";
	fotoCliente3.style.display = "none";
}
function limparFotoFuncionario(){
	inputFile5.value = "";
	pictureImage5.style.display = "none";
}
function limparFotoFuncionario2(){
	inputFile6.value = "";
	pictureImage6.style.display = "none";
}	

//**********  Função para carregar o select Aparelho usando Fetch API

async function carregarSelectAparelho() {
	try {
		// Faz a requisição para o script PHP
		const response = await fetch('http://localhost:81/controle_OS/sistema/php/busca_informacao.php?aparelhoAlt=')
		const itens = await response.json(); // Converte a resposta para objeto JavaScript

		//const selectElement = aparelhoAlt;
		// Itera sobre os dados e cria as opções
		itens.forEach(item => {
			const option = document.createElement('option');
			option.textContent = item.aparelho;
			//selectElement.appendChild(option);
			document.getElementById("aparelhoAlt").appendChild(option);
		});

	} catch (error) {
		console.error('Erro ao buscar os itens:', error);
		document.getElementById("aparelhoAlt").innerHTML = '<option value="">Erro ao carregar</option>';
	}
}

// chama a funcao criada acima
carregarSelectAparelho();

//**********  Função para carregar o select Marca usando Fetch API

async function carregarSelectMarca() {
	try {
		// Faz a requisição para o script PHP
		const response = await fetch('http://localhost:81/controle_OS/sistema/php/busca_informacao.php?marcaAlt=')
		const itens = await response.json(); // Converte a resposta para objeto JavaScript

		//const selectElement = marcaAlt;
		// Itera sobre os dados e cria as opções
		itens.forEach(item => {
			const option = document.createElement('option');
			option.textContent = item.marca;
			//selectElement.appendChild(option);
			document.getElementById("marcaAlt").appendChild(option);
		});

	} catch (error) {
		console.error('Erro ao buscar os itens:', error);
		document.getElementById("marcaAlt").innerHTML = '<option value="">Erro ao carregar</option>';
	}
}

// chama a funcao criada acima
carregarSelectMarca();

async function carregarSelectModelo() {
	try {
		// Faz a requisição para o script PHP
		const response = await fetch('http://localhost:81/controle_OS/sistema/php/busca_informacao.php?modeloAlt=')
		const itens = await response.json(); // Converte a resposta para objeto JavaScript

		//const selectElement = document.getElementById('modeloAlt');
		// Itera sobre os dados e cria as opções
		itens.forEach(item => {
			const option = document.createElement('option');
			option.textContent = item.modelo;
			//selectElement.appendChild(option);
			document.getElementById("modeloAlt").appendChild(option);
		});

	} catch (error) {
		//console.error('Erro ao buscar os itens:', error);
		document.getElementById("modeloAlt").innerHTML = '<option value="">Erro ao carregar</option>';
	}
}

// chama a funcao criada acima
carregarSelectModelo();

//**********  Função para carregar o select Estado no formulario de novo cadastro e alteracao usando Fetch API

async function carregarSelectEstado() {
	try {
		const response = await fetch('http://localhost:81/controle_OS/sistema/php/busca_informacao.php?estadoAlt=')
		const itens = await response.json();
		//const selectElement = document.getElementById('estadoAlt');
		itens.forEach(item => {
			const option = document.createElement('option');
			option.textContent = item.estado;
			document.getElementById("estadoAlt").appendChild(option);
		});
	} catch (error) {
		//console.error('Erro ao buscar os itens:', error);
		document.getElementById("estadoAlt").innerHTML = '<option value="">Erro ao carregar</option>';
	}
}
carregarSelectEstado();

//**********  Função para carregar o select Estado no formulario de retorno

async function carregarSelectEstadoRet() {
	try {
		const response = await fetch('http://localhost:81/controle_OS/sistema/php/busca_informacao.php?estadoAlt=')
		const itens = await response.json();
		//const selectElementRet = document.getElementById('estadoRetAlt');
		itens.forEach(item => {
			const option = document.createElement('option');
			option.textContent = item.estado;
			//selectElementRet.appendChild(option);
			document.getElementById("estadoRetAlt").appendChild(option);
		});
	} catch (error) {
		//console.error('Erro ao buscar os itens:', error);
		document.getElementById('estadoRetAlt').innerHTML = '<option value="">Erro ao carregar</option>';
	}
}
carregarSelectEstadoRet();