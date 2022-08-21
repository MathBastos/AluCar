const loginLocadora = document.getElementById("loginLocadoraForm");

loginLocadora.addEventListener("submit", async (e) => {
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

function limpaId() {
    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/redirecionaLocadora.php?id_locadora=-1",
        success: function (resultado) {
            window.location.replace("../html/cadastroLocadora.html?id_locadora=-1");
        },
        error: function () {

        }
    });
}