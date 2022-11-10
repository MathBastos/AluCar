<?php
include_once "conexao.php";
session_start();
$id_veiculo = $_SESSION["id_veiculo"];
if($id_veiculo > 0){
    $query = "SELECT * FROM veiculo WHERE id_veiculo = :id_veiculo";
    $resultado = $conn->prepare($query);
    $resultado->bindParam(":id_veiculo", $id_veiculo);
    $resultado->execute();

    $row = $resultado->fetch(PDO::FETCH_ASSOC);
    $retorno["id_veiculo"] = $row["id_veiculo"];
    $retorno["modelo"] = $row["modelo"];
    $retorno["marca"] = $row["marca"];
    $retorno["ano"] = $row["ano"];
    $retorno["cambio"] = $row["cambio"];
    $retorno["direcao"] = $row["direcao"];
    $retorno["categoria"] = $row["categoria"];
    $retorno["chassi"] = $row["chassi"];
    $retorno["placa"] = $row["placa"];
    $retorno["cor"] = $row["cor"];
    $retorno["motor"] = $row["motor"];
    $retorno["portas"] = $row["portas"];
    $retorno["qtd_passageiros"] = $row["qtd_passageiros"];
    $retorno["ar_condicionado"] = $row["ar_condicionado"];
    $retorno["valor_hora"] = $row["valor_hora"];
    $retorno["valor_seguro"] = $row["valor_seguro"];
    $retorno["imagem"] = $row["imagem"];
    $retorno["img_name"] = $row["img_name"];
    $retorno["flag_alugado"] = $row["flag_alugado"];
}else{
    $retorno["id_veiculo"] = "";
    $retorno["modelo"] = "";
    $retorno["marca"] = "";
    $retorno["ano"] = "";
    $retorno["cambio"] = "";
    $retorno["direcao"] = "";
    $retorno["categoria"] = "";
    $retorno["chassi"] = "";
    $retorno["placa"] = "";
    $retorno["cor"] = "";
    $retorno["motor"] = "";
    $retorno["portas"] = "";
    $retorno["qtd_passageiros"] = "";
    $retorno["ar_condicionado"] = "";
    $retorno["valor_hora"] = "";
    $retorno["valor_seguro"] = "";
    $retorno["imagem"] = "";
    $retorno["flag_alugado"] = "";
    $retorno["img_name"] = "";
}
echo json_encode($retorno);