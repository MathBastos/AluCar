function editaLocadora(){
    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/buscaLocadora.php",
        success: function (resultado) {
            document.getElementById("nome").value = resultado.nome ;
            document.getElementById("cnpj").value = resultado.cnpj;
            document.getElementById("telefone").value = resultado.telefone;
            document.getElementById("email").value = resultado.email;
            document.getElementById("cep").value = resultado.cep;
            document.getElementById("rua").value = resultado.rua;
            document.getElementById("numero").value = resultado.numero;
            document.getElementById("estado").value = resultado.estado;
            document.getElementById("bairro").value = resultado.bairro;
            document.getElementById("cidade").value = resultado.cidade;
            document.getElementById("complemento").value = resultado.complemento;
            document.getElementById("usuario").value = resultado.usuario;
        },
        error: function (){
            
        }
    });
}