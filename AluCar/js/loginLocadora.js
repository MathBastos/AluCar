const loginLocadora = document.getElementById("loginLocadoraForm");

loginLocadora.addEventListener("submit", async (e) => {
    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/conexao.php",
        success: function () {
            alert("Oops, tem algo errado! Parece que o banco está fora do ar!");
        },
        error: function (){           
        }
    });
    
    e.preventDefault();
    const dadosForm = new FormData(loginLocadora);
    dadosForm.append("add", 1);

    const dados = await fetch("../php/loginLocadora.php", {
        method: "POST",
        body: dadosForm,

    });
    const resposta = await dados.json();

    if(resposta == "bloqueado"){
        alert("Este usuário está bloqueado! Para desbloqueio entrar em contato com administrador.");
    } 
    if(resposta == "sucesso"){
        window.location.replace("../html/indexLocadora.html");
    }
    if(resposta == "erro"){
        alert("Oops, tem algo errado! Verifique suas credenciais.");
    }

});