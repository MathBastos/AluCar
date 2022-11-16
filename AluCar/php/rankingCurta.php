<?php
include_once "conexao.php";
session_start();
$id_usuario = $_SESSION["id_usuario"];
$contador = 0;

$query = "CALL RANKING_DESC()";
$resultado = $conn->prepare($query);
$resultado ->execute();

$row = $resultado->rowCount();

while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
    
    $retorno[$contador]["modelo"] = $row["modelo"];
    $retorno[$contador]["qtde_reservas"] = $row["qtde_reservas"];
    $retorno[$contador]["media_dia"] = $row["media_dia"];
    $retorno[$contador]["imagem"] = $row["imagem"];


    $contador++;
}

echo json_encode($retorno);

