$(document).ready(function () {
    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/controleAcessorio.php",
        success: function (resultado) {

            var html = "<table class='table' itemborder='1'>";

            html += "<tr>";
            html += "<td align='center'>" + "ID" + "</td>";
            html += "<td align='center'>" + "Nome" + "</td>";
            html += "<td align='center'>" + "Quantidade" + "</td>";
            html += "<td align='center'>" + "Valor" + "</td>";
            html += "<td align='center'>" + "Editar" + "</td>";
            html += "<td align='center'>" + "Excluir" + "</td>";
            html += "</tr>";

            for (var i = 0; i < resultado.length; i++) {
                html += "<tr>";
                html += "<td align='center'>" + resultado[i].id + "</td>";
                html += "<td align='center'>" + resultado[i].nome + "</td>";
                html += "<td align='center'>" + resultado[i].quantidade + "</td>";
                html += "<td align='center'>" + resultado[i].valor + "</td>";
                html += "<td align='center'> <a href='indexLocadora.html' <i class='fa fa-pencil-square-o' aria-hidden='true'></i></a></td>";
                html += "<td align='center'> <a onclick='deleteAcessorio("+ resultado[i].id +")'> <i class='fas fa-trash-alt' aria-hidden='true'></i> </td>";
                html += "</tr>";
            }
            html += "</table>";
            html += "<br>";

            $("#table").html(html);
        }
    });
});


function deleteAcessorio(id){
    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/deletaAcessorio.php?id_acessorio="+id,
        success: function (resultado) {
            alert("Acessório removido com sucesso!");
            window.location.reload();
        },
        error: function (){
            
        }
    });
}