const loginLocatario = document.getElementById("loginLocatarioForm");

loginLocatario.addEventListener("submit", async (e) => {
    e.preventDefault();
    const dadosForm = new FormData(loginLocatario);
    dadosForm.append("add", 1);

    const dados = await fetch("../php/loginLocatario.php", {
        method: "POST",
        body: dadosForm,
    });
    const resposta = await dados.json();

    if(resposta == "admin"){
        window.location.replace("../html/indexAdm.html");
    }
    
    if(resposta == "bloqueado"){
        alert("Este usuário está bloqueado! Para desbloqueio entrar em contato com administrador.");
    } 

    if(resposta == "sucesso"){
        alert("Logado com sucesso!");
    }
    if(resposta == "erro"){
        alert("Oops, tem algo errado! Verifique suas credenciais.");
    }
});