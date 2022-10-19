<?php
include_once "conexao.php";

$filtro = $_GET['filtro'];

$query = "SELECT * FROM veiculo WHERE modelo LIKE '%$filtro%'";
$resultado = $conn->prepare($query);
$resultado->execute();
$contador = 0;

$row = $resultado->rowCount();

if ($row == 0){
    $retorno[$row]["msg"] = "Nenhum registro encontrado";
}

while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
    $retorno[$contador]["id"] = $row["id_veiculo"];
    $retorno[$contador]["imagem"] = $row["imagem"];
    $retorno[$contador]["modelo"] = $row["modelo"];
    $retorno[$contador]["marca"] = $row['marca'];
    $retorno[$contador]["valor"] = $row['valor_hora'];
    $retorno[$contador]["cor"] = $row['cor'];
    $contador++;
}

echo json_encode($retorno);