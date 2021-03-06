"use strict";

$(document).ready(function () {
  $.ajax({
    type: "GET",
    dataType: "json",
    data: "",
    url: "../php/controleAcessoLocadora.php",
    success: function success(resultado) {
      var html = "<table class='table' itemborder='1'>";
      html += "<tr>";
      html += "<td align='center'>" + "ID" + "</td>";
      html += "<td align='center'>" + "Nome" + "</td>";
      html += "<td align='center'>" + "CNPJ" + "</td>";
      html += "<td align='center'>" + "Editar" + "</td>";
      html += "<td align='center'>" + "Situação" + "</td>";
      html += "</tr>";

      for (var i = 0; i < resultado.length; i++) {
        html += "<tr>";
        html += "<td align='center'>" + resultado[i].id + "</td>";
        html += "<td align='center'>" + resultado[i].nome + "</td>";
        html += "<td align='center'>" + resultado[i].cnpj + "</td>";
        html += "<td align='center'> <i class='fa fa-pencil-square-o' aria-hidden='true'></i> </td>";

        if (resultado[i].flag_bloqueado == "N") {
          html += "<td align='center'> <a data-toggle='tooltip' data-html='true' title='Bloquear' onclick='block(" + resultado[i].id_usuario + ")'><i class='fa fa-unlock' aria-hidden='true'></i></a></td>";
        } else {
          html += "<td align='center'> <a data-toggle='tooltip' data-html='true' title='Desbloquear' onclick='unblock(" + resultado[i].id_usuario + ")'><i class='fa fa-lock' aria-hidden='true'></i></a></td>";
        }

        html += "</tr>";
      }

      html += "</table>";
      html += "<br>";
      $("#table").html(html);
    }
  });
});

function block(id) {
  $.ajax({
    type: "GET",
    dataType: "json",
    data: "",
    url: "../php/bloqueioAcesso.php?id_usuario=" + id,
    success: function success(resultado) {
      alert("Usuario bloqueado com sucesso!");
    },
    error: function error() {
      alert("Usuario bloqueado com sucesso!");
      window.location.reload();
    }
  });
}

function unblock(id) {
  $.ajax({
    type: "GET",
    dataType: "json",
    data: "",
    url: "../php/desbloqueioAcesso.php?id_usuario=" + id,
    success: function success(resultado) {
      alert("Usuario desbloqueado com sucesso!");
    },
    error: function error() {
      alert("Usuario desbloqueado com sucesso!");
      window.location.reload();
    }
  });
}