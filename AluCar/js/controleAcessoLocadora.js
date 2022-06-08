$(document).ready(function () {
    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/controleAcessoLocadora.php",
        success: function (resultado) {

            var html = "<table border='1'>";

            html += "<tr>";
            html += "<th align='center'>" + "ID" + "</th>";
            html += "<th align='center'>" + "Nome" + "</th>";
            html += "<th align='center'>" + "CNPJ" + "</th>";
            html += "<th align='center'>" + "Editar" + "</th>";
            html += "<th align='center'>" + "Bloqueado" + "</th>";
            html += "</tr>";

            for (var i = 0; i < resultado.length; i++) {
                html += "<tr>";
                html += "<td align='center'>" + resultado[i].id + "</td>";
                html += "<td align='center'>" + resultado[i].nome + "</td>";
                html += "<td align='center'>" + resultado[i].cnpj + "</td>";
                html += "<td align='center'> <i class='fa fa-pencil-square-o' aria-hidden='true'></i> </td>";
                if (resultado[i].flag_bloqueado == "N"){
                    html += "<td align='center'> <a onclick='block(" + resultado[i].id_usuario + ")'><i class='fa fa-ban' aria-hidden='true'></i></a> </td>";
                }else{
                    html += "<td align='center'> <a onclick='block(" + resultado[i].id_usuario + ")'></td>";
                }
                html += "</tr>";
            }
            html += "</table>";
            html += "<br>";

            $("#table").html(html);
        }
    });
});

function block(id){
    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/bloqueioAcesso.php?id_usuario="+id,
        success: function (resultado) {
            alert("Usuario Bloqueado com sucesso");
        },
        error: function (){
            alert("Usuario Bloqueado com sucesso");
        }
    });
}