$(document).ready(function () {
    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/controleAcessoLocadora.php",
        success: function (resultado) {

            var html = "<table class='table' itemborder='1'>";

            html += "<tr>";
            html += "<td align='center'>" + "ID" + "</td>";
            html += "<td align='center'>" + "Nome" + "</td>";
            html += "<td align='center'>" + "CNPJ" + "</td>";
            html += "<td align='center'>" + "Editar" + "</td>";
            html += "<td align='center'>" + "Bloqueado" + "</td>";
            html += "</tr>";

            for (var i = 0; i < resultado.length; i++) {
                html += "<tr>";
                html += "<td align='center'>" + resultado[i].id + "</td>";
                html += "<td align='center'>" + resultado[i].nome + "</td>";
                html += "<td align='center'>" + resultado[i].cnpj + "</td>";
                html += "<td align='center'> <a onclick='editLocadora(" + resultado[i].id + ")'> <i class='fa fa-pencil-square-o' aria-hidden='true'></i></td>";
                if (resultado[i].flag_bloqueado == "N"){
                    html += "<td align='center'> <a onclick='block(" + resultado[i].id_usuario + ")'><i class='fa fa-lock' aria-hidden='true'></i></a></td>";
                }else{
                    html += "<td align='center'> <a onclick='unblock(" + resultado[i].id_usuario + ")'><i class='fa fa-unlock' aria-hidden='true'></i></a></td>";
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
            alert("Usuario bloqueado com sucesso!");
        },
        error: function (){
            alert("Usuario bloqueado com sucesso!");
            window.location.reload();
            
        }
    });
}

function unblock(id){
    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/desbloqueioAcesso.php?id_usuario="+id,
        success: function (resultado) {
            alert("Usuario desbloqueado com sucesso!");
        },
        error: function (){
            alert("Usuario desbloqueado com sucesso!");
            window.location.reload();
        }
    });
}

function editLocadora(id) {
    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/redirecionaLocadora.php?id_locadora=" + id,
        success: function (resultado) {
            window.location.replace("../html/cadastroLocadora.html?id_locadora=" + id);
        },
        error: function () {

        }
    });


}