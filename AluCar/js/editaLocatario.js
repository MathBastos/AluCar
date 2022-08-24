function editaLocatario(){
    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/buscaLocatario.php",
        success: function (resultado) {
            document.getElementById("nome").value = resultado.nome ;
            document.getElementById("cpf").value = resultado.cpf;
            document.getElementById("dataNasc").value = resultado.data_nascimento;
            document.getElementById("celular").value = resultado.celular;
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