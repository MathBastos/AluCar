const loginLocadora = document.getElementById("loginLocadoraForm");

loginLocadora.addEventListener("submit", async (e) => {
    e.preventDefault();
    const dadosForm = new FormData(loginLocadora);
    dadosForm.append("add", 1);

    console.log("pedreiro");
    const dados = await fetch("../php/loginLocadora.php", {
        method: "POST",
        body: dadosForm,

    });
    const resposta = await dados.json();
    console.log(resposta);
});