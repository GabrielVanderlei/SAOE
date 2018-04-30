
function Salvar(nome, valor){ sessionStorage.setItem(nome, valor); }
function Recuperar(nome, elemento, fn){ if(sessionStorage.getItem(nome) !== null) fn(elemento, sessionStorage.getItem(nome)); }
function Limpar(){ sessionStorage.clear(); }

function prepararSalvamentoDeTextos(){
    $("input").each(function () {
        if (!(($(this).attr("type") == "password") || ($(this).attr("type") == "hidden"))) {
            $(this).attr("autocomplete", "off");
            $(this).keydown(function () {
                Salvar(
                $(this).attr("id"),
                $(this).val()
            );
            });
        }
    });
}

function carregarTextos(){
    $("input").each(function () {
        if (!(($(this).attr("type") == "password") || ($(this).attr("type") == "hidden"))) {
            Recuperar(
                $(this).attr("id"),
                $(this),
                function (elemento, valor) { elemento.val(valor); }
            );
        }
    });

}

function meu_callback(conteudo) {
  if (!("erro" in conteudo)) {
    $('#rua').val(conteudo.logradouro);
    $('#bairro').val(conteudo.bairro);
    $('#municipio').val(conteudo.localidade);
    $('#estado').val(conteudo.uf);
  }
}

function pesquisacep(valor) {
    $('#rua').val("...");
    $('#bairro').val("...");
    $('#municipio').val("...");
    $('#estado').val("...");

    $('<script>')
    .attr({ src: 'http://viacep.com.br/ws/' + $("#cep").val() + '/json/?callback=meu_callback' })
    .appendTo($('body'));
};

function verificarFormularioVazio(){
    $(this).find("input").each(function () {
        if ($(this).val() == "") {
            $(this).addClass(".bg-error");
        }
    });
}

function TestaCPF(strCPF) {
    var Soma;
    var Resto;
    Soma = 0;
  
	if (strCPF == "00000000000") return false;
    
	for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
	Resto = (Soma * 10) % 11;
	
    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;
	
	Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;
	
    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) ) alert("CPF Inválido");
    return true;
}

$(document).ready(function () {
    $("#cep").on("blur", function () {
        pesquisacep($(this).val());
    });

    carregarTextos();
    prepararSalvamentoDeTextos();
});
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     