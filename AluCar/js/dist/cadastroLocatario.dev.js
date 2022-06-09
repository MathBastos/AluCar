"use strict";

var cadLocatario = document.getElementById("cadastroLocatario");
cadLocatario.addEventListener("submit", function _callee(e) {
  var dadosForm, dados, resposta;
  return regeneratorRuntime.async(function _callee$(_context) {
    while (1) {
      switch (_context.prev = _context.next) {
        case 0:
          $.ajax({
            type: "GET",
            dataType: "json",
            data: "",
            url: "../php/conexao.php",
            success: function success() {
              alert("Oops, tem algo errado! Parece que o banco está fora do ar!");
            },
            error: function error() {}
          });
          e.preventDefault();
          dadosForm = new FormData(cadLocatario);
          dadosForm.append("add", 1);
          _context.next = 6;
          return regeneratorRuntime.awrap(fetch("../php/cadastroLocatario.php", {
            method: "POST",
            body: dadosForm
          }));

        case 6:
          dados = _context.sent;
          _context.next = 9;
          return regeneratorRuntime.awrap(dados.json());

        case 9:
          resposta = _context.sent;
          alert(resposta);

          if (resposta == "Usuário cadastrado com sucesso!") {
            location.href = 'loginLocatario.html';
          }

        case 12:
        case "end":
          return _context.stop();
      }
    }
  });
}); //CEP Automatico

function limpa_formulario_cep() {
  //Limpa valores do formulário de cep.
  document.getElementById('rua').value = "";
  document.getElementById('bairro').value = "";
  document.getElementById('cidade').value = "";
  document.getElementById('estado').value = "";
}

function meu_callback(conteudo) {
  if (!("erro" in conteudo)) {
    //Atualiza os campos com os valores.
    document.getElementById('rua').value = conteudo.logradouro;
    document.getElementById('bairro').value = conteudo.bairro;
    document.getElementById('cidade').value = conteudo.localidade;
    document.getElementById('estado').value = conteudo.uf;
  } //end if.
  else {
      //CEP não Encontrado.
      limpa_formulario_cep();
      alert("CEP não encontrado.");
      document.getElementById('cep').value = "";
    }
}

function pesquisacep(valor) {
  //Nova variável "cep" somente com dígitos.
  var cep = valor.replace(/\D/g, ''); //Verifica se campo cep possui valor informado.

  if (cep !== "") {
    //Expressão regular para validar o CEP.
    var validacep = /^[0-9]{8}$/; //Valida o formato do CEP.

    if (validacep.test(cep)) {
      //Preenche os campos com "..." enquanto consulta webservice.
      document.getElementById('rua').value = "...";
      document.getElementById('bairro').value = "...";
      document.getElementById('cidade').value = "...";
      document.getElementById('estado').value = "..."; //Cria um elemento javascript.

      var script = document.createElement('script');
      console.log(script); //Sincroniza com o callback.

      script.src = '//viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';
      console.log(script); //Insere script no documento e carrega o conteúdo.

      document.body.appendChild(script);
    } //end if.
    else {
        //cep é inválido.
        limpa_formulario_cep();
        alert("Formato de CEP inválido.");
      }
  } //end if.
  else {
      //cep sem valor, limpa formulário.
      limpa_formulario_cep();
    }
}

function formatar(mascara, documento) {
  var i = documento.value.length;
  var saida = mascara.substring(0, 1);
  var texto = mascara.substring(i);

  if (texto.substring(0, 1) != saida) {
    documento.value += texto.substring(0, 1);
  }
}