"use strict";

var cadVeiculo = document.getElementById("cadastroVeiculo");
cadVeiculo.addEventListener("submit", function _callee(e) {
  var dadosForm, dados, resposta;
  return regeneratorRuntime.async(function _callee$(_context) {
    while (1) {
      switch (_context.prev = _context.next) {
        case 0:
          e.preventDefault();
          dadosForm = new FormData(cadVeiculo);
          dadosForm.append("add", 1);
          _context.next = 5;
          return regeneratorRuntime.awrap(fetch("../php/cadastroVeiculo.php", {
            method: "POST",
            body: dadosForm
          }));

        case 5:
          dados = _context.sent;
          _context.next = 8;
          return regeneratorRuntime.awrap(dados.json());

        case 8:
          resposta = _context.sent;
          alert(resposta);

        case 10:
        case "end":
          return _context.stop();
      }
    }
  });
});