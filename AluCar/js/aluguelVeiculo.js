function buscaVeiculo(){
    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/buscaVeiculo.php",
        success: function (resultado) {
            document.getElementById("modelo").value = resultado.modelo;

            console.log(resultado.imagem)

            var html = "<img scr=" + resultado.imagem + " width='100px' height='100px'/>";
            $("#imagem").html(html);

        },
        error: function (){
        }
    });
}