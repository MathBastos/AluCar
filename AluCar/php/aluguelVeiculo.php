<?php
include_once "conexao.php";
session_start();
$id_veiculo = $_SESSION["id_veiculo"];

if($id_acessorio > 0){
    $query = "SELECT * FROM acessorio WHERE id_acessorio = :id_acessorio";
    $resultado = $conn->prepare($query);
    $resultado->bindParam(':id_acessorio', $id_acessorio);
    $resultado->execute();


    $row = $resultado->fetch(PDO::FETCH_ASSOC);
    $retorno["id"] = $row["id_acessorio"];
    $retorno["nome"] = $row["nome"];
    $retorno["descricao"] = $row["descricao"];
    $retorno["quantidade"] = $row["qtd_acessorio"];
    $retorno["valor"] = $row['valor_acessorio'];
}else{
    $retorno["id"] = "";
    $retorno["nome"] = "";
    $retorno["descricao"] = "";
    $retorno["quantidade"] = "";
    $retorno["valor"] = "";
}
echo json_encode($retorna);