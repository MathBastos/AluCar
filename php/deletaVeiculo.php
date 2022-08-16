<?php
include_once "conexao.php";

$id_veiculo = $_GET["id_veiculo"];
$query = "DELETE FROM veiculo WHERE id_veiculo = :id_veiculo";
$resultado = $conn->prepare($query);
$resultado->bindParam(':id_veiculo', $id_veiculo);
$resultado->execute();

$retorno = "sucesso";

echo json_encode($retorno);