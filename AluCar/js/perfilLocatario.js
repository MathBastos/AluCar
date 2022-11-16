$(document).ready(function () {
    $.ajax({
        type: "GET",
        dataType: "json",
        data: "",
        url: "../php/perfilLocatario.php",
        success: function (resultado) {
            document.getElementById("nome").value = resultado.nome;
            document.getElementById("celular").value = resultado.celular;
            document.getElementById("email").value = resultado.email;
            document.getElementById("moeda").value = resultado.moeda;
            
            var divisao;
            var xpMax;

            if (resultado.xp < 5000){
                divisao = "Bronze"
                xpMax = 5000
                src = 'https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/null/external-bronze-medal-achievements-flaticons-lineal-color-flat-icons.png'
            } else if (5000 < resultado.xp < 10000){
                divisao = "Prata"
                xpMax = 10000
                src = 'https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/null/external-medals-achievements-flaticons-lineal-color-flat-icons.png'
            } else if (10000 < resultado.xp < 20000) {
                divisao = "Ouro"
                xpMax = 20000
                src = 'https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/null/external-gold-medal-achievements-flaticons-lineal-color-flat-icons.png'
            } else if (20000 < resultado.xp < 40000) {
                divisao = "Platina"
                xpMax = 40000
                src = 'https://img.icons8.com/external-bearicons-blue-bearicons/64/null/external-Platinum-miscellany-texts-and-badges-bearicons-blue-bearicons.png'
            } else if (resultado.xp > 40000) {
                divisao = "Diamante"
                src = 'https://img.icons8.com/external-nawicon-outline-color-nawicon/64/null/external-diamond-business-nawicon-outline-color-nawicon.png'
            }

            
            
            document.getElementById("xp").value = (resultado.xp == null ? "0" : resultado.xp)+" / "+xpMax;
            document.getElementById("divisao").value = divisao;

            var html = "<img src='"+ src +"' width='10%' height='15%'/>";
            $("#imagem").html(html);
        },
        error: function () {
        }
    });
});