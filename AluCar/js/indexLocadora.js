function limpaId(){
    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/redirecionaAcessorio.php?id_acessorio=-1",
        success: function (resultado) {
            window.location.replace("../html/cadastroAcessorio.html?id_acessorio=-1");
        },
        error: function (){
            
        }
    });
}