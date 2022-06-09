"use strict";

var loginLocatario = document.getElementById("loginLocatarioForm");
loginLocatario.addEventListener("submit", function _callee(e) {
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
          dadosForm = new FormData(loginLocatario);
          dadosForm.append("add", 1);
          _context.next = 6;
          return regeneratorRuntime.awrap(fetch("../php/loginLocatario.php", {
            method: "POST",
            body: dadosForm
          }));

        case 6:
          dados = _context.sent;
          _context.next = 9;
          return regeneratorRuntime.awrap(dados.json());

        case 9:
          resposta = _context.sent;

          if (resposta == "admin") {
            window.location.replace("../html/indexAdm.html");
          }

          if (resposta == "bloqueado") {
            alert("Este usuário está bloqueado! Para desbloqueio entrar em contato com administrador.");
          }

          if (resposta == "sucesso") {
            alert("Logado com sucesso!");
          }

          if (resposta == "erro") {
            alert("Oops, tem algo errado! Verifique suas credenciais.");
          }

        case 14:
        case "end":
          return _context.stop();
      }
    }
  });
});