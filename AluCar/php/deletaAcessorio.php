<?php
include_once "conexao.php";

$id_acessorio = $_GET["id_acessorio"];
$query = "DELETE FROM acessorio WHERE id_acessorio = :id_acessorio";
$resultado = $conn->prepare($query);
$resultado->bindParam(':id_acessorio', $id_acessorio);
$resultado->execute();

$retorno = "sucesso";

echo json_encode($retorno);